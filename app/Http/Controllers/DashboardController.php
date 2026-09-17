<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $ownPages = $user->memorialPages()->withCount(['memories', 'photos'])->latest()->get();
        $administeredPages = $user->administeredMemorialPages()->withCount(['memories', 'photos'])->latest()->get();

        return view('dashboard', [
            'ownPages' => $ownPages,
            'administeredPages' => $administeredPages,
        ]);
    }
}
