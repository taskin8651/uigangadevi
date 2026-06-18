<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GalleriesController extends Controller
{
    public function index()
    {
        abort_if(
            Gate::denies('gallery_access'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $galleries = Gallery::query()
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        abort_if(
            Gate::denies('gallery_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $categories = $this->categories();

        return view('admin.galleries.create', compact('categories'));
    }

    public function store(Request $request)
    {
        abort_if(
            Gate::denies('gallery_create'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $data = $this->validateGallery($request);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['status'] = $request->boolean('status');

        unset($data['image']);

        $gallery = Gallery::create($data);
        $this->saveImage($request, $gallery);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery item created successfully.');
    }

    public function show(Gallery $gallery)
    {
        abort_if(
            Gate::denies('gallery_show'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        return view('admin.galleries.show', compact('gallery'));
    }

    public function edit(Gallery $gallery)
    {
        abort_if(
            Gate::denies('gallery_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $categories = $this->categories();

        return view('admin.galleries.edit', compact('gallery', 'categories'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        abort_if(
            Gate::denies('gallery_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $data = $this->validateGallery($request, $gallery->id);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['status'] = $request->boolean('status');

        unset($data['image'], $data['remove_image']);

        $gallery->update($data);

        if ($request->boolean('remove_image')) {
            $gallery->clearMediaCollection('gallery_image');
        }

        $this->saveImage($request, $gallery);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        abort_if(
            Gate::denies('gallery_delete'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $gallery->clearMediaCollection('gallery_image');
        $gallery->delete();

        return back()->with('success', 'Gallery item deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(
            Gate::denies('gallery_delete'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:galleries,id'],
        ]);

        Gallery::query()
            ->whereIn('id', $request->input('ids', []))
            ->get()
            ->each(function (Gallery $gallery) {
                $gallery->clearMediaCollection('gallery_image');
                $gallery->delete();
            });

        return response(null, Response::HTTP_NO_CONTENT);
    }

    private function validateGallery(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:image,video'],
            'description' => ['nullable', 'string'],
            'video_url' => ['nullable', 'url', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
        ]);
    }

    private function saveImage(Request $request, Gallery $gallery): void
    {
        if ($request->hasFile('image')) {
            $gallery
                ->addMediaFromRequest('image')
                ->toMediaCollection('gallery_image');
        }
    }

    private function categories(): array
    {
        return [
            'Campus Events',
            'Academic Activities',
            'Cultural Programmes',
            'Seminar & Workshop',
            'Sports',
            'NSS / NCC',
            'Infrastructure',
            'Video Gallery',
        ];
    }
}
