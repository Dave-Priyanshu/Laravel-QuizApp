<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index(){
        $testimonials = Testimonial::with('user')->latest()->take(10)->get();
        return view('landing_page',compact('testimonials'));
    }

    public function store(Request $request){
        $request->validate([
            'review' => 'required|min:10|max:255',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Testimonial::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'review' => $request->review,
            'rating' => $request->rating ?? 0,
        ]);

        return redirect()->back()->with('success','Thank you for your feedback!');
    }
}
