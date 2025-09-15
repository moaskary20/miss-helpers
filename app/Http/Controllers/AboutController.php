<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * عرض صفحة عنا
     */
    public function index()
    {
        return view('about.index');
    }
}
