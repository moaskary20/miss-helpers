<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * عرض صفحة الخدمات
     */
    public function index()
    {
        return view('service.index');
    }
}
