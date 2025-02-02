<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogContent;
use App\Models\Category;
use App\Models\ClientReview;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public $categories;
    public function __construct()
    {
        $this->categories = Category::where('root', Category::categoryRoot)->get();
    }

    public function aboutUs()
    {
        $reviews = ClientReview::where('status', 'active')->get();
        return view('frontend.pages.about', ['categories' => $this->categories, 'reviews' => $reviews]);
    }
    public function blog()
    {
        $blogCategories = BlogCategory::where('status', 'active')->get();
        $blogContents = BlogContent::where('status', 'active')->latest()->paginate(15);
        return view('frontend.pages.blog', compact('blogCategories', 'blogContents'));
    }
    public function blog_single($slug)
    {
        $slugId = BlogCategory::where('slug', $slug)->pluck('id');

        $blogCategories = BlogCategory::where('status', 'active')->get();
        $blogContents = BlogContent::whereIn('blog_category_id', $slugId)->where('status', 'active')->latest()->paginate(15);

        return view('frontend.pages.blog', compact('blogCategories', 'blogContents'));
    }
    public function contactUs()
    {
        return view('frontend.pages.contactUs', ['categories' => $this->categories]);
    }
}