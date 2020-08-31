<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index(): void
    {
        dd('Hi!');
        //return view('admin.tests.index');
    }
}