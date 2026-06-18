<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HeroSlidesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('hero_slide_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $heroSlides = HeroSlide::query()
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.hero-slides.index', compact('heroSlides'));
    }

    public function create()
    {
        abort_if(Gate::denies('hero_slide_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('hero_slide_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $this->validateSlide($request);
        $data['status'] = $request->boolean('status');

        unset($data['image']);

        $heroSlide = HeroSlide::create($data);
        $this->saveImage($request, $heroSlide);

        return redirect()
            ->route('admin.hero-slides.index')
            ->with('success', 'Hero slide created successfully.');
    }

    public function show(HeroSlide $heroSlide)
    {
        abort_if(Gate::denies('hero_slide_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.hero-slides.show', compact('heroSlide'));
    }

    public function edit(HeroSlide $heroSlide)
    {
        abort_if(Gate::denies('hero_slide_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.hero-slides.edit', compact('heroSlide'));
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        abort_if(Gate::denies('hero_slide_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = $this->validateSlide($request);
        $data['status'] = $request->boolean('status');

        unset($data['image'], $data['remove_image']);

        $heroSlide->update($data);

        if ($request->boolean('remove_image')) {
            $heroSlide->clearMediaCollection('hero_image');
        }

        $this->saveImage($request, $heroSlide);

        return redirect()
            ->route('admin.hero-slides.index')
            ->with('success', 'Hero slide updated successfully.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        abort_if(Gate::denies('hero_slide_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $heroSlide->clearMediaCollection('hero_image');
        $heroSlide->delete();

        return back()->with('success', 'Hero slide deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('hero_slide_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:hero_slides,id'],
        ]);

        HeroSlide::query()
            ->whereIn('id', $request->input('ids', []))
            ->get()
            ->each(function (HeroSlide $heroSlide) {
                $heroSlide->clearMediaCollection('hero_image');
                $heroSlide->delete();
            });

        return response(null, Response::HTTP_NO_CONTENT);
    }

    private function validateSlide(Request $request): array
    {
        return $request->validate([
            'badge_text' => ['nullable', 'string', 'max:255'],
            'badge_icon' => ['nullable', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'primary_button_text' => ['nullable', 'string', 'max:100'],
            'primary_button_url' => ['nullable', 'string', 'max:2000'],
            'secondary_button_text' => ['nullable', 'string', 'max:100'],
            'secondary_button_url' => ['nullable', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
        ]);
    }

    private function saveImage(Request $request, HeroSlide $heroSlide): void
    {
        if ($request->hasFile('image')) {
            $heroSlide
                ->addMediaFromRequest('image')
                ->toMediaCollection('hero_image');
        }
    }
}
