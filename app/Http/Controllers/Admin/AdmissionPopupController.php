<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionPopup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdmissionPopupController extends Controller
{
    public function index()
    {
        abort_if(
            Gate::denies('admission_popup_access'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $admissionPopup = AdmissionPopup::query()
            ->first();

        if (!$admissionPopup) {
            $admissionPopup = AdmissionPopup::create([
                'title' => 'Admission Open',
                'url'   => 'https://gdmm.tcspatna.in/',
            ]);
        }

        return view(
            'admin.admission-popups.index',
            compact('admissionPopup')
        );
    }

    public function update(Request $request)
    {
        abort_if(
            Gate::denies('admission_popup_edit'),
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'url' => [
                'required',
                'url',
                'max:2000',
            ],

            'popup_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);

        $admissionPopup = AdmissionPopup::query()
            ->first();

        if (!$admissionPopup) {
            $admissionPopup = AdmissionPopup::create([
                'title' => $validated['title'],
                'url'   => $validated['url'],
            ]);
        } else {
            $admissionPopup->update([
                'title' => $validated['title'],
                'url'   => $validated['url'],
            ]);
        }

        if ($request->hasFile('popup_image')) {
            $admissionPopup
                ->addMediaFromRequest('popup_image')
                ->toMediaCollection(
                    'admission_popup_image'
                );
        }

        return redirect()
            ->route('admin.admission-popups.index')
            ->with(
                'success',
                'Admission popup updated successfully.'
            );
    }
}