<?php

namespace App\Http\Controllers;

use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('super_admin')) {
                return redirect('/admin');
            }

            return redirect()->route('dashboard');
        }

        return view('welcome', [
            'setting' => WebsiteSetting::current(),
        ]);
    }
}
