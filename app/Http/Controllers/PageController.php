<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    

    public function index($slug = null)
    {
        return view('page', ['slug']);
    }
}
