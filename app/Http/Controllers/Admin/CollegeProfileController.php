<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CollegeProfile;
use Illuminate\Http\Request;

class CollegeProfileController extends Controller
{
    public function index()
    {
        $collegeProfile = CollegeProfile::first();

        if (!$collegeProfile) {
            $collegeProfile = CollegeProfile::create([
                'about_badge' => 'About the College',

                'about_title' =>
                    'Empowering Women Through Education, Values and Academic Excellence.',

                'about_description_one' =>
                    'Ganga Devi Mahila Mahavidyalaya is an established women’s college located in Kankarbagh, Patna. The institution focuses on providing higher education in a disciplined, supportive and student-friendly academic environment.',

                'about_description_two' =>
                    'The college promotes intellectual growth, personality development, social responsibility and leadership among students through academics, co-curricular activities, seminars, workshops, cultural programmes and student support services.',

                'image_badge_title' => 'Since 1971',

                'image_badge_subtitle' =>
                    'Women’s Higher Education',

                'about_points' => [
                    [
                        'text'   => 'NAAC accredited institution',
                        'status' => 1,
                    ],
                    [
                        'text'   => 'Women-focused higher education',
                        'status' => 1,
                    ],
                    [
                        'text'   => 'Academic and student support',
                        'status' => 1,
                    ],
                    [
                        'text'   => 'Discipline, values and empowerment',
                        'status' => 1,
                    ],
                ],

                'vision_title' => 'Our Vision',

                'vision_description' =>
                    'To create an inclusive, disciplined and progressive academic environment that empowers women through quality higher education, knowledge, values and confidence.',

                'vision_points' => [
                    [
                        'text'   => 'Quality higher education',
                        'status' => 1,
                    ],
                    [
                        'text'   => 'Women empowerment',
                        'status' => 1,
                    ],
                    [
                        'text'   => 'Inclusive academic growth',
                        'status' => 1,
                    ],
                ],

                'mission_title' => 'Our Mission',

                'mission_description' =>
                    'To provide accessible education, promote academic excellence, encourage discipline and develop responsible, skilled and confident women citizens.',

                'mission_points' => [
                    [
                        'text'   => 'Student-centered learning',
                        'status' => 1,
                    ],
                    [
                        'text'   => 'Discipline and values',
                        'status' => 1,
                    ],
                    [
                        'text'   => 'Career and life readiness',
                        'status' => 1,
                    ],
                ],

                'core_value_title' => 'Our Core Values',

                'core_value_description' =>
                    'Our institutional values guide academic life, student development and responsible participation in society.',

                'core_value_points' => [
                    [
                        'text'   => 'Integrity and ethics',
                        'status' => 1,
                    ],
                    [
                        'text'   => 'Equality and inclusion',
                        'status' => 1,
                    ],
                    [
                        'text'   => 'Respect and responsibility',
                        'status' => 1,
                    ],
                ],

                'status' => 1,
            ]);
        }

        return view(
            'admin.collegeProfiles.index',
            compact('collegeProfile')
        );
    }

    public function update(Request $request)
    {
        $collegeProfile = CollegeProfile::first();

        if (!$collegeProfile) {
            $collegeProfile = CollegeProfile::create([]);
        }

        $request->validate([
            'about_badge' => [
                'nullable',
                'string',
                'max:255',
            ],

            'about_title' => [
                'nullable',
                'string',
                'max:500',
            ],

            'about_description_one' => [
                'nullable',
                'string',
            ],

            'about_description_two' => [
                'nullable',
                'string',
            ],

            'image_badge_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'image_badge_subtitle' => [
                'nullable',
                'string',
                'max:255',
            ],

            'profile_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'remove_profile_image' => [
                'nullable',
                'boolean',
            ],

            'about_points' => [
                'nullable',
                'array',
            ],

            'about_points.*.text' => [
                'nullable',
                'string',
                'max:255',
            ],

            'about_points.*.status' => [
                'nullable',
            ],

            'vision_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'vision_description' => [
                'nullable',
                'string',
            ],

            'vision_points' => [
                'nullable',
                'array',
            ],

            'vision_points.*.text' => [
                'nullable',
                'string',
                'max:255',
            ],

            'vision_points.*.status' => [
                'nullable',
            ],

            'mission_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'mission_description' => [
                'nullable',
                'string',
            ],

            'mission_points' => [
                'nullable',
                'array',
            ],

            'mission_points.*.text' => [
                'nullable',
                'string',
                'max:255',
            ],

            'mission_points.*.status' => [
                'nullable',
            ],

            'core_value_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'core_value_description' => [
                'nullable',
                'string',
            ],

            'core_value_points' => [
                'nullable',
                'array',
            ],

            'core_value_points.*.text' => [
                'nullable',
                'string',
                'max:255',
            ],

            'core_value_points.*.status' => [
                'nullable',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        $aboutPoints = $this->preparePoints(
            $request->input('about_points', [])
        );

        $visionPoints = $this->preparePoints(
            $request->input('vision_points', [])
        );

        $missionPoints = $this->preparePoints(
            $request->input('mission_points', [])
        );

        $coreValuePoints = $this->preparePoints(
            $request->input('core_value_points', [])
        );

        $collegeProfile->update([
            'about_badge' => $request->about_badge,

            'about_title' => $request->about_title,

            'about_description_one' =>
                $request->about_description_one,

            'about_description_two' =>
                $request->about_description_two,

            'image_badge_title' =>
                $request->image_badge_title,

            'image_badge_subtitle' =>
                $request->image_badge_subtitle,

            'about_points' => $aboutPoints,

            'vision_title' =>
                $request->vision_title,

            'vision_description' =>
                $request->vision_description,

            'vision_points' => $visionPoints,

            'mission_title' =>
                $request->mission_title,

            'mission_description' =>
                $request->mission_description,

            'mission_points' => $missionPoints,

            'core_value_title' =>
                $request->core_value_title,

            'core_value_description' =>
                $request->core_value_description,

            'core_value_points' => $coreValuePoints,

            'status' => $request->boolean('status'),
        ]);

        /*
         * Remove existing image.
         */
        if ($request->boolean('remove_profile_image')) {
            $collegeProfile->clearMediaCollection(
                'college_profile_image'
            );
        }

        /*
         * Uploading a new image automatically replaces the old image
         * when the collection is configured as singleFile().
         */
        if ($request->hasFile('profile_image')) {
            $collegeProfile
                ->addMediaFromRequest('profile_image')
                ->toMediaCollection('college_profile_image');
        }

        return redirect()
            ->route('admin.college-profiles.index')
            ->with(
                'success',
                'College profile updated successfully.'
            );
    }

    private function preparePoints(array $submittedPoints): array
    {
        $preparedPoints = [];

        foreach ($submittedPoints as $point) {
            $text = trim($point['text'] ?? '');

            if ($text === '') {
                continue;
            }

            $preparedPoints[] = [
                'text'   => $text,
                'status' => isset($point['status']) ? 1 : 0,
            ];
        }

        return $preparedPoints;
    }
}