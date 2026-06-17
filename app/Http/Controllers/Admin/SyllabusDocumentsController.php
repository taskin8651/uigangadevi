<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\SyllabusDocument;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class SyllabusDocumentsController extends Controller
{
    public function index()
    {
        abort_if(
            Gate::denies('syllabus_document_access'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $syllabusDocuments = SyllabusDocument::query()
            ->with([
                'course',
                'subject',
            ])
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view(
            'admin.syllabus-documents.index',
            compact('syllabusDocuments')
        );
    }

    public function create()
    {
        abort_if(
            Gate::denies('syllabus_document_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $courses = Course::query()
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->pluck('name', 'id');

        $subjects = Subject::query()
            ->where('status', true)
            ->with('courses:id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $documentTypes = $this->documentTypes();
        $curriculumTypes = $this->curriculumTypes();

        return view(
            'admin.syllabus-documents.create',
            compact(
                'courses',
                'subjects',
                'documentTypes',
                'curriculumTypes'
            )
        );
    }

    public function store(Request $request)
    {
        abort_if(
            Gate::denies('syllabus_document_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $validated = $this->validateDocument($request);

        $validated['slug'] = $this->generateUniqueSlug(
            $request->input('slug')
                ?: $request->input('title')
        );

        $validated['subject_id'] =
            $request->filled('subject_id')
                ? $request->input('subject_id')
                : null;

        $validated['is_featured'] =
            $request->boolean('is_featured');

        $validated['status'] =
            $request->boolean('status');

        $validated['sort_order'] =
            $request->input('sort_order', 0);

        unset(
            $validated['syllabus_file'],
            $validated['remove_syllabus_file']
        );

        $syllabusDocument = SyllabusDocument::create(
            $validated
        );

        if ($request->hasFile('syllabus_file')) {
            $syllabusDocument
                ->addMediaFromRequest('syllabus_file')
                ->toMediaCollection('syllabus_document');
        }

        return redirect()
            ->route('admin.syllabus-documents.index')
            ->with(
                'success',
                'Syllabus document created successfully.'
            );
    }

    public function show(
        SyllabusDocument $syllabusDocument
    ) {
        abort_if(
            Gate::denies('syllabus_document_show'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $syllabusDocument->load([
            'course',
            'subject',
        ]);

        return view(
            'admin.syllabus-documents.show',
            compact('syllabusDocument')
        );
    }

    public function edit(
        SyllabusDocument $syllabusDocument
    ) {
        abort_if(
            Gate::denies('syllabus_document_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $courses = Course::query()
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->pluck('name', 'id');

        $subjects = Subject::query()
            ->where('status', true)
            ->with('courses:id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $documentTypes = $this->documentTypes();
        $curriculumTypes = $this->curriculumTypes();

        return view(
            'admin.syllabus-documents.edit',
            compact(
                'syllabusDocument',
                'courses',
                'subjects',
                'documentTypes',
                'curriculumTypes'
            )
        );
    }

    public function update(
        Request $request,
        SyllabusDocument $syllabusDocument
    ) {
        abort_if(
            Gate::denies('syllabus_document_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $validated = $this->validateDocument(
            $request,
            $syllabusDocument->id
        );

        $validated['slug'] = $this->generateUniqueSlug(
            $request->input('slug')
                ?: $request->input('title'),
            $syllabusDocument->id
        );

        $validated['subject_id'] =
            $request->filled('subject_id')
                ? $request->input('subject_id')
                : null;

        $validated['is_featured'] =
            $request->boolean('is_featured');

        $validated['status'] =
            $request->boolean('status');

        $validated['sort_order'] =
            $request->input('sort_order', 0);

        unset(
            $validated['syllabus_file'],
            $validated['remove_syllabus_file']
        );

        $syllabusDocument->update($validated);

        if ($request->boolean('remove_syllabus_file')) {
            $syllabusDocument->clearMediaCollection(
                'syllabus_document'
            );
        }

        if ($request->hasFile('syllabus_file')) {
            $syllabusDocument
                ->addMediaFromRequest('syllabus_file')
                ->toMediaCollection('syllabus_document');
        }

        return redirect()
            ->route('admin.syllabus-documents.index')
            ->with(
                'success',
                'Syllabus document updated successfully.'
            );
    }

    public function destroy(
        SyllabusDocument $syllabusDocument
    ) {
        abort_if(
            Gate::denies('syllabus_document_delete'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $syllabusDocument->clearMediaCollection(
            'syllabus_document'
        );

        $syllabusDocument->delete();

        return back()->with(
            'success',
            'Syllabus document deleted successfully.'
        );
    }

    public function massDestroy(Request $request)
    {
        abort_if(
            Gate::denies('syllabus_document_delete'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'integer|exists:syllabus_documents,id',
        ]);

        $syllabusDocuments = SyllabusDocument::query()
            ->whereIn(
                'id',
                $request->input('ids', [])
            )
            ->get();

        foreach ($syllabusDocuments as $syllabusDocument) {
            $syllabusDocument->clearMediaCollection(
                'syllabus_document'
            );

            $syllabusDocument->delete();
        }

        return response(
            null,
            Response::HTTP_NO_CONTENT
        );
    }

    private function validateDocument(
        Request $request,
        ?int $documentId = null
    ): array {
        return $request->validate([
            'course_id' => [
                'required',
                'integer',
                'exists:courses,id',
            ],

            'subject_id' => [
                'nullable',
                'integer',
                'exists:subjects,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:syllabus_documents,slug,' . $documentId,
            ],

            'academic_session' => [
                'required',
                'string',
                'max:50',
            ],

            'semester' => [
                'nullable',
                'string',
                'max:100',
            ],

            'document_type' => [
                'nullable',
                'string',
                'max:100',
            ],

            'curriculum_type' => [
                'nullable',
                'string',
                'max:100',
            ],

            'effective_from' => [
                'nullable',
                'string',
                'max:100',
            ],

            'short_description' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'external_url' => [
                'nullable',
                'url',
                'max:2000',
            ],

            'button_text' => [
                'nullable',
                'string',
                'max:255',
            ],

            'syllabus_file' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:15360',
            ],

            'remove_syllabus_file' => [
                'nullable',
                'boolean',
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
        ]);
    }

    private function generateUniqueSlug(
        string $value,
        ?int $ignoreId = null
    ): string {
        $baseSlug = Str::slug($value);

        if ($baseSlug === '') {
            $baseSlug = 'syllabus-document';
        }

        $slug = $baseSlug;
        $counter = 1;

        while (
            SyllabusDocument::query()
                ->where('slug', $slug)
                ->when(
                    $ignoreId,
                    function ($query) use ($ignoreId) {
                        $query->where(
                            'id',
                            '!=',
                            $ignoreId
                        );
                    }
                )
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private function documentTypes(): array
    {
        return [
            'Complete Syllabus' => 'Complete Syllabus',
            'Subject Syllabus' => 'Subject Syllabus',
            'Semester Syllabus' => 'Semester Syllabus',
            'Revised Syllabus' => 'Revised Syllabus',
            'CBCS Syllabus' => 'CBCS Syllabus',
            'NEP Syllabus' => 'NEP Syllabus',
            'Practical Syllabus' => 'Practical Syllabus',
            'Other' => 'Other',
        ];
    }

    private function curriculumTypes(): array
    {
        return [
            'CBCS' => 'CBCS',
            'NEP 2020' => 'NEP 2020',
            'Semester System' => 'Semester System',
            'Annual Pattern' => 'Annual Pattern',
            'University Curriculum' => 'University Curriculum',
            'Other' => 'Other',
        ];
    }
}