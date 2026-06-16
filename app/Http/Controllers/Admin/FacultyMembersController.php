<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FacultyMember;
use App\Models\Subject;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class FacultyMembersController extends Controller
{
    public function index()
    {
        abort_if(
            Gate::denies('faculty_member_access'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $facultyMembers = FacultyMember::query()
            ->with('subject')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'admin.faculty-members.index',
            compact('facultyMembers')
        );
    }

    public function create()
    {
        abort_if(
            Gate::denies('faculty_member_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $subjects = Subject::query()
            ->where('status', true)
            ->orderBy('name')
            ->pluck('name', 'id');

        $categories = $this->categories();

        return view(
            'admin.faculty-members.create',
            compact('subjects', 'categories')
        );
    }

    public function store(Request $request)
    {
        abort_if(
            Gate::denies('faculty_member_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $validated = $this->validateFaculty($request);

        $validated['slug'] = $this->generateUniqueSlug(
            $request->input('slug') ?: $request->input('name')
        );

        $validated = $this->prepareDynamicLists(
            $validated,
            $request
        );

        $validated['status'] = $request->boolean('status');
        $validated['sort_order'] = $request->input('sort_order', 0);

        unset(
            $validated['faculty_image'],
            $validated['faculty_cv'],
            $validated['remove_faculty_image'],
            $validated['remove_faculty_cv']
        );

        $facultyMember = FacultyMember::create($validated);

        if ($request->hasFile('faculty_image')) {
            $facultyMember
                ->addMediaFromRequest('faculty_image')
                ->toMediaCollection('faculty_image');
        }

        if ($request->hasFile('faculty_cv')) {
            $facultyMember
                ->addMediaFromRequest('faculty_cv')
                ->toMediaCollection('faculty_cv');
        }

        return redirect()
            ->route('admin.faculty-members.index')
            ->with('success', 'Faculty member created successfully.');
    }

    public function show(FacultyMember $facultyMember)
    {
        abort_if(
            Gate::denies('faculty_member_show'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $facultyMember->load('subject');

        return view(
            'admin.faculty-members.show',
            compact('facultyMember')
        );
    }

    public function edit(FacultyMember $facultyMember)
    {
        abort_if(
            Gate::denies('faculty_member_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $subjects = Subject::query()
            ->where('status', true)
            ->orderBy('name')
            ->pluck('name', 'id');

        $categories = $this->categories();

        $facultyMember->load('subject');

        return view(
            'admin.faculty-members.edit',
            compact(
                'facultyMember',
                'subjects',
                'categories'
            )
        );
    }

    public function update(
        Request $request,
        FacultyMember $facultyMember
    ) {
        abort_if(
            Gate::denies('faculty_member_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $validated = $this->validateFaculty(
            $request,
            $facultyMember->id
        );

        $validated['slug'] = $this->generateUniqueSlug(
            $request->input('slug') ?: $request->input('name'),
            $facultyMember->id
        );

        $validated = $this->prepareDynamicLists(
            $validated,
            $request
        );

        $validated['status'] = $request->boolean('status');
        $validated['sort_order'] = $request->input('sort_order', 0);

        unset(
            $validated['faculty_image'],
            $validated['faculty_cv'],
            $validated['remove_faculty_image'],
            $validated['remove_faculty_cv']
        );

        $facultyMember->update($validated);

        if ($request->boolean('remove_faculty_image')) {
            $facultyMember->clearMediaCollection('faculty_image');
        }

        if ($request->boolean('remove_faculty_cv')) {
            $facultyMember->clearMediaCollection('faculty_cv');
        }

        if ($request->hasFile('faculty_image')) {
            $facultyMember
                ->addMediaFromRequest('faculty_image')
                ->toMediaCollection('faculty_image');
        }

        if ($request->hasFile('faculty_cv')) {
            $facultyMember
                ->addMediaFromRequest('faculty_cv')
                ->toMediaCollection('faculty_cv');
        }

        return redirect()
            ->route('admin.faculty-members.index')
            ->with('success', 'Faculty member updated successfully.');
    }

    public function destroy(FacultyMember $facultyMember)
    {
        abort_if(
            Gate::denies('faculty_member_delete'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $facultyMember->clearMediaCollection('faculty_image');
        $facultyMember->clearMediaCollection('faculty_cv');
        $facultyMember->delete();

        return back()->with(
            'success',
            'Faculty member deleted successfully.'
        );
    }

    public function massDestroy(Request $request)
    {
        abort_if(
            Gate::denies('faculty_member_delete'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:faculty_members,id',
        ]);

        $facultyMembers = FacultyMember::query()
            ->whereIn('id', $request->input('ids', []))
            ->get();

        foreach ($facultyMembers as $facultyMember) {
            $facultyMember->clearMediaCollection('faculty_image');
            $facultyMember->clearMediaCollection('faculty_cv');
            $facultyMember->delete();
        }

        return response(
            null,
            Response::HTTP_NO_CONTENT
        );
    }

    private function validateFaculty(
        Request $request,
        ?int $facultyMemberId = null
    ): array {
        return $request->validate([
            'subject_id' => [
                'nullable',
                'integer',
                'exists:subjects,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:faculty_members,slug,' . $facultyMemberId,
            ],

            'faculty_category' => [
                'nullable',
                'string',
                'max:100',
            ],

            'designation' => [
                'nullable',
                'string',
                'max:255',
            ],

            'employee_id' => [
                'nullable',
                'string',
                'max:100',
                'unique:faculty_members,employee_id,' . $facultyMemberId,
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'joining_date' => [
                'nullable',
                'date',
            ],

            'teaching_experience' => [
                'nullable',
                'string',
                'max:255',
            ],

            'research_experience' => [
                'nullable',
                'string',
                'max:255',
            ],

            'short_description' => [
                'nullable',
                'string',
                'max:1500',
            ],

            'biography' => [
                'nullable',
                'string',
            ],

            'faculty_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'faculty_cv' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:10240',
            ],

            'remove_faculty_image' => [
                'nullable',
                'boolean',
            ],

            'remove_faculty_cv' => [
                'nullable',
                'boolean',
            ],

            'qualifications' => 'nullable|array',
            'qualifications.*.text' => 'nullable|string|max:500',
            'qualifications.*.status' => 'nullable',

            'specializations' => 'nullable|array',
            'specializations.*.text' => 'nullable|string|max:500',
            'specializations.*.status' => 'nullable',

            'subjects_taught' => 'nullable|array',
            'subjects_taught.*.text' => 'nullable|string|max:500',
            'subjects_taught.*.status' => 'nullable',

            'research_interests' => 'nullable|array',
            'research_interests.*.text' => 'nullable|string|max:500',
            'research_interests.*.status' => 'nullable',

            'publications' => 'nullable|array',
            'publications.*.text' => 'nullable|string|max:1000',
            'publications.*.status' => 'nullable',

            'awards' => 'nullable|array',
            'awards.*.text' => 'nullable|string|max:1000',
            'awards.*.status' => 'nullable',

            'responsibilities' => 'nullable|array',
            'responsibilities.*.text' => 'nullable|string|max:1000',
            'responsibilities.*.status' => 'nullable',

            'memberships' => 'nullable|array',
            'memberships.*.text' => 'nullable|string|max:1000',
            'memberships.*.status' => 'nullable',

            'seminars' => 'nullable|array',
            'seminars.*.text' => 'nullable|string|max:1000',
            'seminars.*.status' => 'nullable',

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);
    }

    private function prepareDynamicLists(
        array $validated,
        Request $request
    ): array {
        $listFields = [
            'qualifications',
            'specializations',
            'subjects_taught',
            'research_interests',
            'publications',
            'awards',
            'responsibilities',
            'memberships',
            'seminars',
        ];

        foreach ($listFields as $field) {
            $validated[$field] = $this->prepareList(
                $request->input($field, [])
            );
        }

        return $validated;
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
                'text' => $text,
                'status' => isset($item['status']) ? 1 : 0,
            ];
        }

        return $prepared;
    }

    private function generateUniqueSlug(
        string $value,
        ?int $ignoreId = null
    ): string {
        $baseSlug = Str::slug($value);

        if ($baseSlug === '') {
            $baseSlug = 'faculty-member';
        }

        $slug = $baseSlug;
        $counter = 1;

        while (
            FacultyMember::query()
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
            'Arts' => 'Arts',
            'Science' => 'Science',
            'Commerce' => 'Commerce',
            'Language' => 'Language',
            'Administration' => 'Administration',
            'Other' => 'Other',
        ];
    }
}