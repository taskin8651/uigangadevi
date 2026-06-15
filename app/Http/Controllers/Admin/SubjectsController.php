<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class SubjectsController extends Controller
{
    public function index()
    {
        abort_if(
            Gate::denies('subject_access'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $subjects = Subject::with(['courses'])
            ->withCount('courses')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'admin.subjects.index',
            compact('subjects')
        );
    }

    public function create()
    {
        abort_if(
            Gate::denies('subject_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $courses = Course::query()
            ->where('status', true)
            ->orderBy('name')
            ->pluck('name', 'id');

        return view(
            'admin.subjects.create',
            compact('courses')
        );
    }

    public function store(Request $request)
    {
        abort_if(
            Gate::denies('subject_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $data = $request->validate($this->validationRules());

        $data['slug'] = $this->generateUniqueSlug(
            $request->input('slug') ?: $request->input('name')
        );

        $data['academic_areas'] = $this->prepareList(
            $request->input('academic_areas', [])
        );

        $data['learning_outcomes'] = $this->prepareList(
            $request->input('learning_outcomes', [])
        );

        $data['career_opportunities'] = $this->prepareList(
            $request->input('career_opportunities', [])
        );

        $data['status'] = $request->boolean('status');
        $data['sort_order'] = $request->input('sort_order', 0);

        unset(
            $data['courses'],
            $data['subject_image'],
            $data['syllabus_file'],
            $data['remove_subject_image'],
            $data['remove_syllabus_file']
        );

        $subject = Subject::create($data);

        $subject->courses()->sync(
            $request->input('courses', [])
        );

        if ($request->hasFile('subject_image')) {
            $subject
                ->addMediaFromRequest('subject_image')
                ->toMediaCollection('subject_image');
        }

        if ($request->hasFile('syllabus_file')) {
            $subject
                ->addMediaFromRequest('syllabus_file')
                ->toMediaCollection('subject_syllabus');
        }

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Subject created successfully.');
    }

    public function edit(Subject $subject)
    {
        abort_if(
            Gate::denies('subject_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $courses = Course::query()
            ->where('status', true)
            ->orderBy('name')
            ->pluck('name', 'id');

        $subject->load('courses');

        return view(
            'admin.subjects.edit',
            compact('subject', 'courses')
        );
    }

    public function update(
        Request $request,
        Subject $subject
    ) {
        abort_if(
            Gate::denies('subject_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $data = $request->validate($this->validationRules());

        $data['slug'] = $this->generateUniqueSlug(
            $request->input('slug') ?: $request->input('name'),
            $subject->id
        );

        $data['academic_areas'] = $this->prepareList(
            $request->input('academic_areas', [])
        );

        $data['learning_outcomes'] = $this->prepareList(
            $request->input('learning_outcomes', [])
        );

        $data['career_opportunities'] = $this->prepareList(
            $request->input('career_opportunities', [])
        );

        $data['status'] = $request->boolean('status');
        $data['sort_order'] = $request->input('sort_order', 0);

        unset(
            $data['courses'],
            $data['subject_image'],
            $data['syllabus_file'],
            $data['remove_subject_image'],
            $data['remove_syllabus_file']
        );

        $subject->update($data);

        $subject->courses()->sync(
            $request->input('courses', [])
        );

        if ($request->boolean('remove_subject_image')) {
            $subject->clearMediaCollection('subject_image');
        }

        if ($request->boolean('remove_syllabus_file')) {
            $subject->clearMediaCollection('subject_syllabus');
        }

        if ($request->hasFile('subject_image')) {
            $subject
                ->addMediaFromRequest('subject_image')
                ->toMediaCollection('subject_image');
        }

        if ($request->hasFile('syllabus_file')) {
            $subject
                ->addMediaFromRequest('syllabus_file')
                ->toMediaCollection('subject_syllabus');
        }

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Subject updated successfully.');
    }

    public function show(Subject $subject)
    {
        abort_if(
            Gate::denies('subject_show'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $subject->load('courses');

        return view(
            'admin.subjects.show',
            compact('subject')
        );
    }

    public function destroy(Subject $subject)
    {
        abort_if(
            Gate::denies('subject_delete'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $subject->courses()->detach();
        $subject->clearMediaCollection('subject_image');
        $subject->clearMediaCollection('subject_syllabus');
        $subject->delete();

        return back()->with(
            'success',
            'Subject deleted successfully.'
        );
    }

    public function massDestroy(Request $request)
    {
        abort_if(
            Gate::denies('subject_delete'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:subjects,id'],
        ]);

        $subjects = Subject::whereIn(
            'id',
            $request->input('ids', [])
        )->get();

        foreach ($subjects as $subject) {
            $subject->courses()->detach();
            $subject->clearMediaCollection('subject_image');
            $subject->clearMediaCollection('subject_syllabus');
            $subject->delete();
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
            'department_name' => ['nullable', 'string', 'max:255'],
            'short_name' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'academic_areas' => ['nullable', 'array'],
            'academic_areas.*.text' => ['nullable', 'string'],
            'academic_areas.*.status' => ['nullable'],
            'learning_outcomes' => ['nullable', 'array'],
            'learning_outcomes.*.text' => ['nullable', 'string'],
            'learning_outcomes.*.status' => ['nullable'],
            'career_opportunities' => ['nullable', 'array'],
            'career_opportunities.*.text' => ['nullable', 'string'],
            'career_opportunities.*.status' => ['nullable'],
            'courses' => ['nullable', 'array'],
            'courses.*' => ['integer', 'exists:courses,id'],
            'subject_image' => ['nullable', 'image', 'max:5120'],
            'syllabus_file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'remove_subject_image' => ['nullable', 'boolean'],
            'remove_syllabus_file' => ['nullable', 'boolean'],
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
            $slug = 'subject';
            $baseSlug = 'subject';
        }

        while (
            Subject::query()
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
