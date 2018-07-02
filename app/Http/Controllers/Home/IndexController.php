<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('home.index.index');
    }

    public function blog()
    {
        return view('home.index.blog');
    }

    public function contact()
    {
        return view('home.index.contact');
    }

    public function gallery()
    {
        return view('home.index.gallery');
    }

    public function single()
    {
        return view('home.index.single');
    }
}
