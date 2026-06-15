<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrincipalMessage;
use Illuminate\Http\Request;

class PrincipalMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:principal_message_access')->only([
            'index',
        ]);

        $this->middleware('can:principal_message_edit')->only([
            'update',
        ]);
    }

    public function index()
    {
        $principalMessage = PrincipalMessage::first();

        if (!$principalMessage) {
            $principalMessage = PrincipalMessage::create([
                   'principal_name' => 'Prof. Dr. Shyama Roy',
                   'college_name' => 'Ganga Devi Mahila Mahavidyalaya',
                'title' => 'Dear Students, Parents and Stakeholders,',

                'description' => '
                    <p>
                        It gives me immense pleasure to welcome you to Ganga Devi Mahila
                        Mahavidyalaya, an institution dedicated to the academic growth,
                        confidence and empowerment of women through quality higher education.
                    </p>

                    <p>
                        Our college believes that education is not limited to classroom
                        learning. It is a complete process of developing knowledge,
                        discipline, character, confidence, communication skills,
                        leadership qualities and social responsibility among students.
                    </p>

                    <p>
                        We are committed to providing a supportive, safe and value-based
                        academic environment where students can explore their potential,
                        strengthen their abilities and prepare themselves for future
                        opportunities.
                    </p>

                    <p>
                        The institution continuously works to improve academic standards,
                        student support services, transparency, co-curricular activities
                        and quality assurance practices.
                    </p>
                ',

                'status' => 1,
            ]);
        }

        return view(
            'admin.principal-messages.index',
            compact('principalMessage')
        );
    }

    public function update(Request $request)
    {
        $principalMessage = PrincipalMessage::first();

        if (!$principalMessage) {
            $principalMessage = PrincipalMessage::create([]);
        }

        $request->validate([
            'principal_name' => 'nullable|string|max:255',
            'college_name' => 'nullable|string|max:255',
            'title' => [
                'nullable',
                'string',
                'max:500',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'principal_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'remove_principal_image' => [
                'nullable',
                'boolean',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        $principalMessage->update([
            'title' => $request->title,
            'description' => $request->description,
            'principal_name' => $request->principal_name,
            'college_name' => $request->college_name,
            'status' => $request->boolean('status'),
        ]);

        if ($request->boolean('remove_principal_image')) {
            $principalMessage->clearMediaCollection(
                'principal_image'
            );
        }

        if ($request->hasFile('principal_image')) {
            $principalMessage
                ->addMediaFromRequest('principal_image')
                ->toMediaCollection('principal_image');
        }

        return redirect()
            ->route('admin.principal-messages.index')
            ->with(
                'success',
                'Principal message updated successfully.'
            );
    }
}