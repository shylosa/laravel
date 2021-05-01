<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Class TestController
 * @package App\Http\Controllers\Admin
 */
class TestController extends Controller
{
    public function index(): void
    {
        dd('Hi!');
        //return view('admin.tests.index');
    }
}