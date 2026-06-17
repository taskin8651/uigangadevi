<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentActivity;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class StudentActivitiesController extends Controller
{
    public function index()
    {
        abort_if(
            Gate::denies('student_activity_access'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $studentActivities = StudentActivity::query()
            ->orderBy('sort_order')
            ->orderByDesc('activity_date')
            ->orderByDesc('id')
            ->get();

        return view(
            'admin.student-activities.index',
            compact('studentActivities')
        );
    }

    public function create()
    {
        abort_if(
            Gate::denies('student_activity_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $categories = $this->categories();

        return view(
            'admin.student-activities.create',
            compact('categories')
        );
    }

    public function store(Request $request)
    {
        abort_if(
            Gate::denies('student_activity_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $data = $this->validateActivity($request);

        $data['slug'] = $this->generateUniqueSlug(
            $request->input('slug') ?: $request->input('title')
        );

        $data = $this->prepareDynamicLists($data, $request);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['status'] = $request->boolean('status');
        $data['sort_order'] = $request->input('sort_order', 0);

        unset(
            $data['activity_image'],
            $data['gallery_images'],
            $data['activity_document'],
            $data['remove_activity_image'],
            $data['remove_activity_document'],
            $data['remove_gallery_ids']
        );

        $studentActivity = StudentActivity::create($data);

        $this->saveMedia($request, $studentActivity);

        return redirect()
            ->route('admin.student-activities.index')
            ->with('success', 'Student activity created successfully.');
    }

    public function show(StudentActivity $studentActivity)
    {
        abort_if(
            Gate::denies('student_activity_show'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        return view(
            'admin.student-activities.show',
            compact('studentActivity')
        );
    }

    public function edit(StudentActivity $studentActivity)
    {
        abort_if(
            Gate::denies('student_activity_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $categories = $this->categories();

        return view(
            'admin.student-activities.edit',
            compact('studentActivity', 'categories')
        );
    }

    public function update(
        Request $request,
        StudentActivity $studentActivity
    ) {
        abort_if(
            Gate::denies('student_activity_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $data = $this->validateActivity(
            $request,
            $studentActivity->id
        );

        $data['slug'] = $this->generateUniqueSlug(
            $request->input('slug') ?: $request->input('title'),
            $studentActivity->id
        );

        $data = $this->prepareDynamicLists($data, $request);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['status'] = $request->boolean('status');
        $data['sort_order'] = $request->input('sort_order', 0);

        unset(
            $data['activity_image'],
            $data['gallery_images'],
            $data['activity_document'],
            $data['remove_activity_image'],
            $data['remove_activity_document'],
            $data['remove_gallery_ids']
        );

        $studentActivity->update($data);

        if ($request->boolean('remove_activity_image')) {
            $studentActivity->clearMediaCollection('activity_image');
        }

        if ($request->boolean('remove_activity_document')) {
            $studentActivity->clearMediaCollection('activity_document');
        }

        foreach ($request->input('remove_gallery_ids', []) as $mediaId) {
            $media = $studentActivity
                ->getMedia('activity_gallery')
                ->firstWhere('id', (int) $mediaId);

            if ($media) {
                $media->delete();
            }
        }

        $this->saveMedia($request, $studentActivity);

        return redirect()
            ->route('admin.student-activities.index')
            ->with('success', 'Student activity updated successfully.');
    }

    public function destroy(StudentActivity $studentActivity)
    {
        abort_if(
            Gate::denies('student_activity_delete'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $studentActivity->clearMediaCollection('activity_image');
        $studentActivity->clearMediaCollection('activity_gallery');
        $studentActivity->clearMediaCollection('activity_document');

        $studentActivity->delete();

        return back()->with(
            'success',
            'Student activity deleted successfully.'
        );
    }

    public function massDestroy(Request $request)
    {
        abort_if(
            Gate::denies('student_activity_delete'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'integer|exists:student_activities,id',
        ]);

        $activities = StudentActivity::query()
            ->whereIn('id', $request->input('ids', []))
            ->get();

        foreach ($activities as $activity) {
            $activity->clearMediaCollection('activity_image');
            $activity->clearMediaCollection('activity_gallery');
            $activity->clearMediaCollection('activity_document');
            $activity->delete();
        }

        return response(
            null,
            Response::HTTP_NO_CONTENT
        );
    }

    private function validateActivity(
        Request $request,
        ?int $activityId = null
    ): array {
        return $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:student_activities,slug,' . $activityId,
            ],

            'category' => [
                'nullable',
                'string',
                'max:100',
            ],

            'activity_date' => [
                'nullable',
                'date',
            ],

            'venue' => [
                'nullable',
                'string',
                'max:255',
            ],

            'organizer' => [
                'nullable',
                'string',
                'max:255',
            ],

            'guest_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'short_description' => [
                'nullable',
                'string',
                'max:1500',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'activity_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'gallery_images' => [
                'nullable',
                'array',
            ],

            'gallery_images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'activity_document' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:10240',
            ],

            'activity_highlights' => [
                'nullable',
                'array',
            ],

            'activity_highlights.*.text' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'activity_highlights.*.status' => [
                'nullable',
            ],

            'learning_outcomes' => [
                'nullable',
                'array',
            ],

            'learning_outcomes.*.text' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'learning_outcomes.*.status' => [
                'nullable',
            ],

            'participants' => [
                'nullable',
                'array',
            ],

            'participants.*.text' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'participants.*.status' => [
                'nullable',
            ],

            'is_featured' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],

            'remove_activity_image' => [
                'nullable',
                'boolean',
            ],

            'remove_activity_document' => [
                'nullable',
                'boolean',
            ],

            'remove_gallery_ids' => [
                'nullable',
                'array',
            ],

            'remove_gallery_ids.*' => [
                'integer',
            ],
        ]);
    }

    private function prepareDynamicLists(
        array $data,
        Request $request
    ): array {
        $fields = [
            'activity_highlights',
            'learning_outcomes',
            'participants',
        ];

        foreach ($fields as $field) {
            $data[$field] = $this->prepareList(
                $request->input($field, [])
            );
        }

        return $data;
    }

    private function prepareList(array $items): array
    {
        $prepared = [];

        foreach ($items as $item) {
            $text = trim($item['text'] ?? '');

            if ($text === '') {
                continue;
            }

            $prepared[] = [
                'text'   => $text,
                'status' => isset($item['status']) ? 1 : 0,
            ];
        }

        return $prepared;
    }

    private function saveMedia(
        Request $request,
        StudentActivity $studentActivity
    ): void {
        if ($request->hasFile('activity_image')) {
            $studentActivity
                ->addMediaFromRequest('activity_image')
                ->toMediaCollection('activity_image');
        }

        if ($request->hasFile('activity_document')) {
            $studentActivity
                ->addMediaFromRequest('activity_document')
                ->toMediaCollection('activity_document');
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images', []) as $file) {
                $studentActivity
                    ->addMedia($file)
                    ->toMediaCollection('activity_gallery');
            }
        }
    }

    private function generateUniqueSlug(
        string $value,
        ?int $ignoreId = null
    ): string {
        $baseSlug = Str::slug($value);

        if ($baseSlug === '') {
            $baseSlug = 'student-activity';
        }

        $slug = $baseSlug;
        $counter = 1;

        while (
            StudentActivity::query()
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

    private function categories(): array
    {
        return [
            'Academic'      => 'Academic',
            'Cultural'      => 'Cultural',
            'Social'        => 'Social',
            'Sports'        => 'Sports',
            'Empowerment'   => 'Empowerment',
            'Career'        => 'Career',
            'NSS'           => 'NSS',
            'NCC'           => 'NCC',
            'Awareness'     => 'Awareness',
            'Workshop'      => 'Workshop',
            'Seminar'       => 'Seminar',
            'Administration'=> 'Administration',
            'Other'         => 'Other',
        ];
    }
}