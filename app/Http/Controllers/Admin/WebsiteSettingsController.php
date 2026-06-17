<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WebsiteSettingsController extends Controller
{
    public function index()
    {
        abort_if(
            Gate::denies('website_setting_access'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $websiteSetting = WebsiteSetting::current();

        return view(
            'admin.website-settings.index',
            compact('websiteSetting')
        );
    }

    public function update(Request $request)
    {
        abort_if(
            Gate::denies('website_setting_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $websiteSetting = WebsiteSetting::current();

        $validated = $request->validate([
            'site_name' => ['nullable', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'site_url' => ['nullable', 'url', 'max:255'],
            'footer_description' => ['nullable', 'string'],
            'copyright_text' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'address_line' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:50'],
            'primary_email' => ['nullable', 'email', 'max:255'],
            'admission_email' => ['nullable', 'email', 'max:255'],
            'exam_email' => ['nullable', 'email', 'max:255'],
            'documents_email' => ['nullable', 'email', 'max:255'],
            'primary_phone' => ['nullable', 'string', 'max:100'],
            'admission_phone' => ['nullable', 'string', 'max:100'],
            'exam_phone' => ['nullable', 'string', 'max:100'],
            'documents_phone' => ['nullable', 'string', 'max:100'],
            'office_days' => ['nullable', 'string', 'max:255'],
            'office_time' => ['nullable', 'string', 'max:255'],
            'calling_hours' => ['nullable', 'string', 'max:255'],
            'closed_days' => ['nullable', 'string', 'max:255'],
            'map_embed_url' => ['nullable', 'string'],
            'map_link' => ['nullable', 'url', 'max:2000'],
            'facebook_url' => ['nullable', 'url', 'max:2000'],
            'twitter_url' => ['nullable', 'url', 'max:2000'],
            'instagram_url' => ['nullable', 'url', 'max:2000'],
            'youtube_url' => ['nullable', 'url', 'max:2000'],
            'linkedin_url' => ['nullable', 'url', 'max:2000'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'favicon' => ['nullable', 'image', 'mimes:ico,png,jpg,jpeg,webp', 'max:2048'],
            'remove_logo' => ['nullable', 'boolean'],
            'remove_favicon' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ]);

        unset(
            $validated['logo'],
            $validated['favicon'],
            $validated['remove_logo'],
            $validated['remove_favicon']
        );

        $validated['status'] = $request->boolean('status');

        $websiteSetting->update($validated);

        if ($request->boolean('remove_logo')) {
            $websiteSetting->clearMediaCollection('website_logo');
        }

        if ($request->boolean('remove_favicon')) {
            $websiteSetting->clearMediaCollection('website_favicon');
        }

        if ($request->hasFile('logo')) {
            $websiteSetting
                ->addMediaFromRequest('logo')
                ->toMediaCollection('website_logo');
        }

        if ($request->hasFile('favicon')) {
            $websiteSetting
                ->addMediaFromRequest('favicon')
                ->toMediaCollection('website_favicon');
        }

        return redirect()
            ->route('admin.website-settings.index')
            ->with('success', 'Website settings updated successfully.');
    }
}
