<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;

class ContactController extends Controller
{
    public function index()
    {
        $websiteSetting = WebsiteSetting::current();

        return view(
            'frontend.contact',
            compact('websiteSetting')
        );
    }
}
