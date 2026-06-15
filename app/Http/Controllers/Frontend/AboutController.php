<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CollegeProfile;
use App\Models\PrincipalMessage;

class AboutController extends Controller
{
    public function index()
    {
        $collegeProfile = CollegeProfile::query()
            ->where('status', 1)
            ->first();

        $principalMessage = PrincipalMessage::query()
            ->where('status', 1)
            ->first();

        return view(
            'frontend.about',
            compact(
                'collegeProfile',
                'principalMessage'
            )
        );
    }

   public function mission()
    {
        $collegeProfile = CollegeProfile::query()
            ->where('status', 1)
            ->first();

        return view(
            'frontend.mission',
            compact('collegeProfile')
        );
    }

    public function principal()
    {
        $principalMessage = PrincipalMessage::query()
            ->where('status', 1)
            ->first();

        return view(
            'frontend.principal',
            compact('principalMessage')
        );
    }

    public function college()
    {
        $collegeProfile = CollegeProfile::query()
            ->where('status', 1)
            ->first();

        return view(
            'frontend.college',
            compact('collegeProfile')
        );
    }   
}