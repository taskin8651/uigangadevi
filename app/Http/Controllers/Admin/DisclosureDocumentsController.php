<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DisclosureDocument;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DisclosureDocumentsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('disclosure_document_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $documents = DisclosureDocument::query()
            ->orderBy('section')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.disclosure-documents.index', compact('documents'));
    }

    public function create()
    {
        abort_if(Gate::denies('disclosure_document_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.disclosure-documents.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('disclosure_document_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $this->validateDocument($request);
        $data['status'] = $request->boolean('status');

        unset($data['document_file']);

        $document = DisclosureDocument::create($data);
        $this->saveFile($request, $document);

        return redirect()
            ->route('admin.disclosure-documents.index')
            ->with('success', 'Document created successfully.');
    }

    public function show(DisclosureDocument $disclosureDocument)
    {
        abort_if(Gate::denies('disclosure_document_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.disclosure-documents.show', compact('disclosureDocument'));
    }

    public function edit(DisclosureDocument $disclosureDocument)
    {
        abort_if(Gate::denies('disclosure_document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.disclosure-documents.edit', compact('disclosureDocument'));
    }

    public function update(Request $request, DisclosureDocument $disclosureDocument)
    {
        abort_if(Gate::denies('disclosure_document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $this->validateDocument($request);
        $data['status'] = $request->boolean('status');

        unset($data['document_file'], $data['remove_document']);

        $disclosureDocument->update($data);

        if ($request->boolean('remove_document')) {
            $disclosureDocument->clearMediaCollection('disclosure_document');
        }

        $this->saveFile($request, $disclosureDocument);

        return redirect()
            ->route('admin.disclosure-documents.index')
            ->with('success', 'Document updated successfully.');
    }

    public function destroy(DisclosureDocument $disclosureDocument)
    {
        abort_if(Gate::denies('disclosure_document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disclosureDocument->clearMediaCollection('disclosure_document');
        $disclosureDocument->delete();

        return back()->with('success', 'Document deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('disclosure_document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:disclosure_documents,id'],
        ]);

        DisclosureDocument::query()
            ->whereIn('id', $request->input('ids', []))
            ->get()
            ->each(function (DisclosureDocument $document) {
                $document->clearMediaCollection('disclosure_document');
                $document->delete();
            });

        return response(null, Response::HTTP_NO_CONTENT);
    }

    private function validateDocument(Request $request): array
    {
        return $request->validate([
            'section' => ['required', 'in:rti,naac'],
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'string', 'max:50'],
            'external_url' => ['nullable', 'url', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
            'document_file' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,webp', 'max:15360'],
            'remove_document' => ['nullable', 'boolean'],
        ]);
    }

    private function saveFile(Request $request, DisclosureDocument $document): void
    {
        if ($request->hasFile('document_file')) {
            $document
                ->addMediaFromRequest('document_file')
                ->toMediaCollection('disclosure_document');
        }
    }
}
