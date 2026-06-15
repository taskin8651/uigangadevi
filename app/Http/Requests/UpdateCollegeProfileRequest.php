<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCollegeProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'about_badge'            => ['nullable', 'string', 'max:255'],
            'about_title'            => ['required', 'string', 'max:500'],
            'about_description_one'  => ['nullable', 'string'],
            'about_description_two'  => ['nullable', 'string'],
            'image_badge_title'      => ['nullable', 'string', 'max:255'],
            'image_badge_subtitle'   => ['nullable', 'string', 'max:255'],
            'about_points'           => ['nullable', 'array'],
            'about_points.*'         => ['nullable', 'string', 'max:255'],

            'vision_title'           => ['required', 'string', 'max:255'],
            'vision_description'     => ['nullable', 'string'],
            'vision_points'          => ['nullable', 'array'],
            'vision_points.*'        => ['nullable', 'string', 'max:255'],

            'mission_title'          => ['required', 'string', 'max:255'],
            'mission_description'    => ['nullable', 'string'],
            'mission_points'         => ['nullable', 'array'],
            'mission_points.*'       => ['nullable', 'string', 'max:255'],

            'core_value_title'       => ['required', 'string', 'max:255'],
            'core_value_description' => ['nullable', 'string'],
            'core_value_points'      => ['nullable', 'array'],
            'core_value_points.*'    => ['nullable', 'string', 'max:255'],

            'profile_image'          => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'remove_profile_image'   => ['nullable', 'boolean'],
            'status'                 => ['nullable', 'boolean'],
        ];
    }
}