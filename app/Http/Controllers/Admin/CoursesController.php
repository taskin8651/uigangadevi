<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CoursesController extends Controller
{
    public function index()
    {
        abort_if(
            Gate::denies('course_access'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $courses = Course::with(['subjects'])
            ->withCount('subjects')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'admin.courses.index',
            compact('courses')
        );
    }

    public function create()
    {
        abort_if(
            Gate::denies('course_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $subjects = Subject::query()
            ->where('status', true)
            ->orderBy('name')
            ->pluck('name', 'id');

        return view(
            'admin.courses.create',
            compact('subjects')
        );
    }

    public function store(Request $request)
    {
        abort_if(
            Gate::denies('course_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $data = $request->validate($this->validationRules());

        $data['slug'] = $this->generateUniqueSlug(
            $request->input('slug') ?: $request->input('name')
        );

        $data['highlights'] = $this->prepareList(
            $request->input('highlights', [])
        );

        $data['status'] = $request->boolean('status');
        $data['sort_order'] = $request->input('sort_order', 0);

        unset(
            $data['subjects'],
            $data['course_image'],
            $data['remove_course_image']
        );

        $course = Course::create($data);

        $course->subjects()->sync(
            $request->input('subjects', [])
        );

        if ($request->hasFile('course_image')) {
            $course
                ->addMediaFromRequest('course_image')
                ->toMediaCollection('course_image');
        }

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        abort_if(
            Gate::denies('course_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $subjects = Subject::query()
            ->where('status', true)
            ->orderBy('name')
            ->pluck('name', 'id');

        $course->load('subjects');

        return view(
            'admin.courses.edit',
            compact('course', 'subjects')
        );
    }

    public function update(
        Request $request,
        Course $course
    ) {
        abort_if(
            Gate::denies('course_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $data = $request->validate($this->validationRules());

        $data['slug'] = $this->generateUniqueSlug(
            $request->input('slug') ?: $request->input('name'),
            $course->id
        );

        $data['highlights'] = $this->prepareList(
            $request->input('highlights', [])
        );

        $data['status'] = $request->boolean('status');
        $data['sort_order'] = $request->input('sort_order', 0);

        unset(
            $data['subjects'],
            $data['course_image'],
            $data['remove_course_image']
        );

        $course->update($data);

        $course->subjects()->sync(
            $request->input('subjects', [])
        );

        if ($request->boolean('remove_course_image')) {
            $course->clearMediaCollection('course_image');
        }

        if ($request->hasFile('course_image')) {
            $course
                ->addMediaFromRequest('course_image')
                ->toMediaCollection('course_image');
        }

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function show(Course $course)
    {
        abort_if(
            Gate::denies('course_show'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $course->load('subjects');

        return view(
            'admin.courses.show',
            compact('course')
        );
    }

    public function destroy(Course $course)
    {
        abort_if(
            Gate::denies('course_delete'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $course->subjects()->detach();
        $course->clearMediaCollection('course_image');
        $course->delete();

        return back()->with(
            'success',
            'Course deleted successfully.'
        );
    }

    public function massDestroy(Request $request)
    {
        abort_if(
            Gate::denies('course_delete'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:courses,id'],
        ]);

        $courses = Course::whereIn(
            'id',
            $request->input('ids', [])
        )->get();

        foreach ($courses as $course) {
            $course->subjects()->detach();
            $course->clearMediaCollection('course_image');
            $course->delete();
        }

        return response(
            null,
            Response::HTTP_NO_CONTENT
        );
    }

    private function validationRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'short_name' => ['nullable', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'max:255'],
            'duration' => ['nullable', 'string', 'max:255'],
            'course_type' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'eligibility' => ['nullable', 'string'],
            'admission_process' => ['nullable', 'string'],
            'highlights' => ['nullable', 'array'],
            'highlights.*.text' => ['nullable', 'string'],
            'highlights.*.status' => ['nullable'],
            'subjects' => ['nullable', 'array'],
            'subjects.*' => ['integer', 'exists:subjects,id'],
            'course_image' => ['nullable', 'image', 'max:5120'],
            'remove_course_image' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
        ];
    }

    private function prepareList(array $items): array
    {
        $preparedItems = [];

        foreach ($items as $item) {
            $text = trim($item['text'] ?? '');

            if ($text === '') {
                continue;
            }

            $preparedItems[] = [
                'text' => $text,
                'status' => isset($item['status']) ? 1 : 0,
            ];
        }

        return $preparedItems;
    }

    private function generateUniqueSlug(
        string $value,
        ?int $ignoreId = null
    ): string {
        $baseSlug = Str::slug($value);
        $slug = $baseSlug;
        $counter = 1;

        if ($slug === '') {
            $slug = 'course';
            $baseSlug = 'course';
        }

        while (
            Course::query()
                ->where('slug', $slug)
                ->when(
                    $ignoreId,
                    function ($query) use ($ignoreId) {
                        $query->where('id', '!=', $ignoreId);
                    }
                )
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
