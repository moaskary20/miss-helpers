<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * عرض صفحة الاتصال بنا
     */
    public function index()
    {
        return view('contact.index');
    }
}
