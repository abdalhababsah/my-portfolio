<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Skill;
use App\Models\Blog;
use App\Models\Certificate;
use App\Models\SiteSetting;
use App\Models\SocialLink;
class HomeController extends Controller
{
    public function index()
    {
        $services      = Service::with('images')->latest()->take(6)->get();
        $experiences   = Experience::latest('start_date')->get();
        $education     = Education::latest('start_date')->get();
        $projects      = Project::with(['technologies', 'tags', 'images' => function ($q) {
                                $q->where('is_main', true);
                            }])->latest()->take(6)->get();
        $testimonials  = Testimonial::latest('date_given')->take(5)->get();
        $skills        = Skill::with('category')->get();
        $blogs         = Blog::latest()->take(3)->get();
        $certificates  = Certificate::latest('date_issued')->get();
        $settings      = SiteSetting::all()->pluck('value_en', 'key_name');
        $socialLinks   = SocialLink::all();

        return view('frontend.index', compact(
            'services', 'experiences', 'education', 'projects',
            'testimonials', 'skills', 'blogs', 'certificates',
            'settings', 'socialLinks'
        ));
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
        return view('frontend.projects');
    }

    public function portfolioDetail()
    {
        return view('frontend.project-detail');
    }

}