<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Skill;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'artworkCount' => Artwork::count(),
            'serviceCount' => Service::count(),
            'skillCount' => Skill::count(),
            'messageCount' => ContactMessage::count(),
            'settingsCount' => Setting::count(),
        ]);
    }
}
