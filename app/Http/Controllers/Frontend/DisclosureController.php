<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DisclosureDocument;

class DisclosureController extends Controller
{
    public function rti()
    {
        return $this->renderSection('rti', 'RTI', 'frontend.rti');
    }

    public function naac()
    {
        return $this->renderSection('naac', 'NAAC / IQAC', 'frontend.naac');
    }

    private function renderSection(string $section, string $sectionTitle, string $view)
    {
        $documents = DisclosureDocument::query()
            ->where('section', $section)
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        $categories = $documents
            ->pluck('category')
            ->filter()
            ->unique()
            ->values();

        return view($view, compact('documents', 'categories', 'sectionTitle'));
    }
}
