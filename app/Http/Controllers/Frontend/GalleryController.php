<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleryItems = Gallery::query()
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        $imageGalleries = $galleryItems
            ->where('type', 'image')
            ->values();

        $videoGalleries = $galleryItems
            ->where('type', 'video')
            ->values();

        $galleryCategories = $galleryItems
            ->pluck('category')
            ->filter()
            ->unique()
            ->values();

        return view(
            'frontend.gallery',
            compact('galleryItems', 'imageGalleries', 'videoGalleries', 'galleryCategories')
        );
    }
}
