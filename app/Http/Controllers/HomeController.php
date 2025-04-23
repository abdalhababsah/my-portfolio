<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function blog()
    {
        return view('frontend.blog');
    }

    public function blogDetail()
    {
        return view('frontend.blog-detail');
    }

    public function services()
    {
        return view('frontend.services');
    }

    public function serviceDetail()
    {
        return view('frontend.service-detail');
    }

    public function portfolio()
    {
        return view('frontend.portfolio');
    }

    public function portfolioDetail()
    {
        return view('frontend.portfolio-detail');
    }

    public function hireMe()
    {
        return view('frontend.hire-me');
    }
}