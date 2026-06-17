<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class NoticesController extends Controller
{
    public function index()
    {
        abort_if(
            Gate::denies('notice_access'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $notices = Notice::query()
            ->orderByDesc('is_latest')
            ->orderByDesc('notice_date')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view(
            'admin.notices.index',
            compact('notices')
        );
    }

    public function create()
    {
        abort_if(
            Gate::denies('notice_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $categories = $this->categories();

        return view(
            'admin.notices.create',
            compact('categories')
        );
    }

    public function store(Request $request)
    {
        abort_if(
            Gate::denies('notice_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $validated = $this->validateNotice($request);

        $validated['slug'] = $this->generateUniqueSlug(
            $request->input('slug') ?: $request->input('title')
        );

        $validated['is_latest'] = $request->boolean('is_latest');
        $validated['status'] = $request->boolean('status');
        $validated['sort_order'] = $request->input('sort_order', 0);

        unset(
            $validated['notice_file'],
            $validated['remove_notice_file']
        );

        $notice = Notice::create($validated);

        if ($request->hasFile('notice_file')) {
            $notice
                ->addMediaFromRequest('notice_file')
                ->toMediaCollection('notice_document');
        }

        return redirect()
            ->route('admin.notices.index')
            ->with('success', 'Notice created successfully.');
    }

    public function show(Notice $notice)
    {
        abort_if(
            Gate::denies('notice_show'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        return view(
            'admin.notices.show',
            compact('notice')
        );
    }

    public function edit(Notice $notice)
    {
        abort_if(
            Gate::denies('notice_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $categories = $this->categories();

        return view(
            'admin.notices.edit',
            compact(
                'notice',
                'categories'
            )
        );
    }

    public function update(Request $request, Notice $notice)
    {
        abort_if(
            Gate::denies('notice_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $validated = $this->validateNotice(
            $request,
            $notice->id
        );

        $validated['slug'] = $this->generateUniqueSlug(
            $request->input('slug') ?: $request->input('title'),
            $notice->id
        );

        $validated['is_latest'] = $request->boolean('is_latest');
        $validated['status'] = $request->boolean('status');
        $validated['sort_order'] = $request->input('sort_order', 0);

        unset(
            $validated['notice_file'],
            $validated['remove_notice_file']
        );

        $notice->update($validated);

        if ($request->boolean('remove_notice_file')) {
            $notice->clearMediaCollection('notice_document');
        }

        if ($request->hasFile('notice_file')) {
            $notice
                ->addMediaFromRequest('notice_file')
                ->toMediaCollection('notice_document');
        }

        return redirect()
            ->route('admin.notices.index')
            ->with('success', 'Notice updated successfully.');
    }

    public function destroy(Notice $notice)
    {
        abort_if(
            Gate::denies('notice_delete'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $notice->clearMediaCollection('notice_document');
        $notice->delete();

        return back()->with('success', 'Notice deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(
            Gate::denies('notice_delete'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:notices,id',
        ]);

        $notices = Notice::query()
            ->whereIn('id', $request->input('ids', []))
            ->get();

        foreach ($notices as $notice) {
            $notice->clearMediaCollection('notice_document');
            $notice->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    private function validateNotice(
        Request $request,
        ?int $noticeId = null
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
                'unique:notices,slug,' . $noticeId,
            ],
            'category' => [
                'nullable',
                'string',
                'max:100',
            ],
            'notice_date' => [
                'nullable',
                'date',
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
            'notice_file' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:15360',
            ],
            'remove_notice_file' => [
                'nullable',
                'boolean',
            ],
            'is_latest' => [
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
            $baseSlug = 'notice';
        }

        $slug = $baseSlug;
        $counter = 1;

        while (
            Notice::query()
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
            'Admission' => 'Admission',
            'Examination' => 'Examination',
            'Academic' => 'Academic',
            'Student' => 'Student',
            'Tender' => 'Tender',
            'Scholarship' => 'Scholarship',
            'Recruitment' => 'Recruitment',
            'Holiday' => 'Holiday',
            'Government' => 'Government',
            'Circular' => 'Circular',
            'Other' => 'Other',
        ];
    }
}
