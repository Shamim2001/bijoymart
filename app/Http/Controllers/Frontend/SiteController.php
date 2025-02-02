<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Http\Controllers\Controller;
use App\Models\SingleBanner;
use App\Models\Banner;
use App\Models\HomeSlider;
use App\Models\Section;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $sections = Section::where('status', 'active')
            ->where('title', 'scroll')
            ->with(['SectionProduct' => function ($query) {
                $query->where('status', 'active')
                    ->orderBy('updated_at', 'desc'); // Order within the relationship query
            }])
            ->get();

        $sections->each(function ($item) {
            // Ensure the relationship is loaded before accessing it
            $item->products = Product::whereIn('id', $item->SectionProduct->pluck('product_id'))
                ->select('id', 'name', 'slug', 'thumbnail', 'selling_price', 'discount_price', 'discount_from', 'discount_to', 'discount_type')
                ->get();

                // ->map(function ($product) {
                //     if ($product->discount_type === 'flat') {
                //         $product->main_price = $product->selling_price - $product->discount_price;
                //     } elseif ($product->discount_type === 'percent') {
                //         $product->main_price = $product->selling_price - ($product->selling_price * ($product->discount_price / 100));
                //     } else {
                //         // No discount
                //         $product->main_price = $product->selling_price;
                //     }
                //     return $product;
                // })






        });


        $sectionsNew = Section::where('status', 'active')
            ->where('title', 'new_arrival')
            ->with(['SectionProduct' => function ($query) {
                $query->where('status', 'active')
                    ->orderBy('id', 'desc'); // Order within the relationship query
            }])
            ->get();

            // ->map(function ($product) {
            //     if ($product->discount_type === 'flat') {
            //         $product->main_price = $product->selling_price - $product->discount_price;
            //     } elseif ($product->discount_type === 'percent') {
            //         $product->main_price = $product->selling_price - ($product->selling_price * ($product->discount_price / 100));
            //     } else {
            //         // No discount
            //         $product->main_price = $product->selling_price;
            //     }
            //     return $product;
            // })



        $sectionsNew->each(function ($item) {
            // Ensure the relationship is loaded before accessing it
            $item->products = Product::whereIn('id', $item->SectionProduct->pluck('product_id'))
                ->select('id', 'name', 'slug', 'thumbnail', 'selling_price', 'discount_price', 'discount_from', 'discount_to', 'discount_type')
                ->get();
        });

        $sliders = HomeSlider::where('status', 'active')->orderBy('serial')->get();
        $banners = Banner::where('status', 'active')->orderBy('serial')->get();
        $categories = Category::where('status', 'active')
            ->where('home_category', 'active')
            ->get();

        $singleBanner = SingleBanner::where('status', 'active')->latest()->first();
        $singleCard = Section::where('status', 'active')
            ->where('title', 'single_card')
            ->latest()
            ->first()->SectionProduct->pluck('product_id');
        $singleCardProduct = Product::whereIn('id', $singleCard)->first();
        // $featured   = product::select('id', 'name', 'slug', 'selling_price', 'special_price', 'special_price_from', 'special_price_to', 'thumbnail')->where('featured', 1)->active()->get();
        return view('frontend.index', compact('sections', 'sectionsNew', 'sliders', 'banners', 'categories', 'singleBanner', 'singleCardProduct'));
    }


    public function products($slug1, $slug2, $slug3 = null)
    {
        if ($slug3) {
            $category = Category::where('slug', $slug3)->pluck('id');

            $categories = Category::with('productCount')->where('id', $category)->where('status', 'active')->get();
            $products   = Product::where('category_id', $category)->active()->select('id', 'name', 'slug', 'thumbnail', 'selling_price', 'discount_price')->get();
            $brand      = $products->pluck('brand_id')->unique();
            $brands     = Brand::select('id', 'name', 'slug')
                ->whereIn('id', $brand)->where('status', 'active')
                ->get()
                ->map(function ($brand) use ($products) {
                    $brand->products = $products->where('brand_id', $brand->id);

                    return $brand;
                });
        } else {
            $category     = Category::where('slug', $slug2)->pluck('id');
            $categories   = Category::with('productCount')->where('root', $category)->get();
            $category_ids = $categories->pluck('id');
            $products     = Product::whereIn('category_id', collect($category)->merge(collect($category_ids)))
                ->active()->orderBy('id', 'Desc')->select('id', 'name', 'slug', 'thumbnail', 'selling_price', 'discount_price')->get();
            $brand        = $products->pluck('brand_id')->unique();
            // $brands       = Brand::with('countProducts')
            //     ->select('id', 'name', 'slug')
            //     ->whereIn('id', $brand)
            //     ->where('status', 'active')
            //     ->get();

            $brands       = Brand::select('id', 'name', 'slug')
                ->whereIn('id', $brand)
                ->where('status', 'active')
                ->get()
                ->map(function ($brand) use ($products) {
                    $brand->products = $products->where('brand_id', $brand->id);

                    return $brand;
                });
        }
        // return $brands;
        $featured   = product::where('featured', 1)->active()->get();
        $topmenucat = Category::where('root', Category::categoryRoot)->get();

        // return view('frontend.products', compact('brands', 'categories', 'featured', 'category'));
        return view('frontend.products', compact('products', 'brands', 'categories', 'featured', 'topmenucat'));
    }


    public function product($slug)

    {
        // $product = product::where('slug', $slug)->first();


        // new
        $product = Product::where('slug', $slug)->first();

        if ($product) {
            // Calculate the main price based on discount type
            if ($product->discount_type === 'flat') {
                $product->main_price = $product->selling_price - $product->discount_price;
            } elseif ($product->discount_type === 'percent') {
                $product->main_price = $product->selling_price - ($product->selling_price * ($product->discount_price / 100));
            } else {
                $product->main_price = $product->selling_price;
            }
        } else {
            // Product not found
            return abort(404, 'Product not found');
        }



        $product_id = $product->id;

        //review collect.
        $reviews = Review::with('customer')
            ->where('product_id', $product_id)->orderBy('id', 'desc')->get();

        $product_check = Order::where('user_id', session('user_id'))
            ->where('status', 'Success')
            ->select('id', 'user_id', 'status')
            ->first();

        //average rating
        $ratings = Review::with('customer')->where('product_id', $product_id)->pluck('rating');
        $avg_rating = collect($ratings)->avg();

        // related product sort
        $related_product = product::where('category_id', $product->category_id)->pluck('category_id')->unique();
        $relproducts     = product::where('category_id', $related_product)->select('id', 'name', 'slug', 'thumbnail', 'selling_price', 'discount_price')->get();

        // marge thumbnail and images
        $thumbnail = json_decode($product->thumbnail);
        $images    = json_decode($product->images);
        // array_merge($images, $thumbnail);  //insert the thumbnail in the first position
        // dd($product);
        return view('frontend.product', compact('product', 'relproducts', 'images', 'reviews', 'avg_rating', 'product_check'));
    }

    public function productByCategory($slug, $slug2 = null, $slug3 = null)
    {
        $category     = Category::where('slug', $slug)->pluck('id');
        $categories   = Category::where('root', $category)->get();
        $category_ids = $categories->pluck('id');


        // $category = Category::where('slug', $slug)->first();
        $productsQuery = product::whereIn('category_id', $category_ids)
            ->select('id', 'name', 'slug', 'thumbnail', 'selling_price', 'discount_price', 'discount_from', 'discount_to', 'discount_type', 'category_id', 'brand_id', 'size');

        $brand = $productsQuery->get()->pluck('brand_id')->unique();
        $brands = Brand::select('id', 'name', 'slug')
            ->whereIn('id', $brand)
            ->where('status', 'active')
            ->get();

        $size = $productsQuery->get()->pluck('size')->unique();

        $sizes = $mergedArray = collect($size)
            ->map(function ($item) {
                return json_decode($item, true); // Decode JSON string to array
            })
            ->flatten() // Flatten the collection into a single array
            ->unique()  // Get unique values
            ->values()  // Reindex the array
            ->all();

        // Filter by subcategory if it's provided
        if ($slug2 == 'subcategory' && $slug3 != null) {
            $categoryId = Category::where('slug', $slug3)->first();
            $productsQuery->where('category_id', $categoryId->id);
        }

        if ($slug2 == 'brand' && $slug3 != null) {
            $brandid = Brand::where('slug', $slug3)->first();
            $productsQuery->where('brand_id', $brandid->id);
        }

        if ($slug2 == 'size' && $slug3 != null) {
            $productsQuery->whereJsonContains('size', $slug3);
        }

        $products = $productsQuery->paginate(20);



        return view('frontend.productbycategory', compact('products', 'categories', 'brands', 'sizes', 'slug', 'slug2'));
    }

    public function product_review(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'id' => 'required',
            'rating' => 'required|in:1,2,3,4,5',
            'message' => 'required',
        ]);

        //review collect.
        $review_exist = Review::where('customer_id', session('customer_id'))
            ->where('product_id', $request->id)->first();
        if ($review_exist) {
            return response()->json([
                'status' => 0,
                'message' => 'Duplicate Review Found!',
            ]);
        } else {

            try {
                Review::create([
                    'product_id'     => $request->id,
                    'customer_id'    => session('customer_id'),
                    'rating'         => $request->rating,
                    'product_review' => $request->message
                ]);
                return response()->json([
                    'status' => 1,
                    'message' => 'The product Review successfuly Submited',
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'status' => 0,
                    'message' => $e->getMessage()
                ]);
            }
        }
    }

    public function product_review_reload(Request $request)
    {

        $product_id = $request->id;
        //review collect.
        $reviews = Review::with('customer')
            ->where('product_id', $product_id)->orderBy('id', 'desc')->get();

        return view('frontend.customer.reload-review', compact('reviews'));
    }



    public function productquickview($slug)
    {

        $product = Product::where('slug', $slug)->first();

        // marge thumbnail and images
        $thumbnail = $product->thumbnail;
        $images    = json_decode($product->images);
        $image2    = array_unshift($images, $thumbnail);  //insert the thumbnail in the first position

        return view('frontend.ajax.productquickview', compact('product', 'images'));
    }

    public function loadmore(Request $request)
    {
        if ($request->ajax()) {
            if ($request->id) {
                $category     = $request->cat_id;
                $categories   = Category::with('productCount')->where('root', $category)->get();
                $category_ids = $categories->pluck('id');
                $loadproducts = Product::where('id', '<', $request->id)->whereIn('category_id', collect($category)->merge(collect($category_ids)))
                    ->active()->orderBy('id', 'Desc')->limit(8)->get();
            } else {
                $category     = $request->cat_id;
                $categories   = Category::with('productCount')->where('root', $category)->get();
                $category_ids = $categories->pluck('id');
                $loadproducts = Product::whereIn('category_id', collect($category)->merge(collect($category_ids)))
                    ->active()->orderBy('id', 'Desc')->limit(16)->get();
            }
            return view('frontend.loadmoredata', compact('loadproducts'));
        }
    }

    public function product_search_ajax(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->searchText . '%')->take(10)->get();
        return $products;
    }

    public function product_search(Request $request)
    {
        $request->validate([
            'search_text' => 'required'
        ]);

        $products = Product::where('name', 'like', '%' . $request->search_text . '%')->paginate(16);
        $products->appends($request->all());
        return view('frontend.searchproducts', compact('products'));
    }
}
