<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use App\Http\Requests\DesignRequest;
use App\Models\Client;
use App\Models\CustomerDesignRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Service;
use App\Models\Tag;
use App\Models\TeamMember;
use App\Services\ProductService;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    //
    public function index()
    {
        $project_categories=ProjectCategory::all();
        $featured_products=Product::where('is_featured',1)->inRandomOrder()->take(4)->get();
        $clients=Client::all();
        return view('welcome',compact('clients','featured_products','project_categories'));
    }

    public function contact(Request $request)
    {
        $project_categories=ProjectCategory::all();
        return view('pages.contact',compact('project_categories'));
    }
    public function designRequest(Request $request)
    {
        $project_categories=ProjectCategory::all();
        return view('pages.design_request',compact('project_categories'));
    }

    public function trackDesignRequest(Request $request)
    {
        $design_request=CustomerDesignRequest::where(['preview_code'=>$request->tracking_id])->first();
        return view('pages.track_design_request',compact('design_request'));
    }

    public function saveDesignRequest(DesignRequest $request, ProjectService $projectService)
    {
        return $projectService->saveDesignRequest($request);
    }

    public function services(Request $request)
    {
        $services=Service::all();
        return view('services.list',compact('services'));
    }
    public function singleService(Request $request,$service_id)
    {
        $services=Service::all();
        $service=Service::findOrFail($service_id);
        return view('services.details',compact('service','services'));

    }

    public function products(Request $request, ProductService $productService)
    {
        $featured_products=Product::where('is_featured',1)->inRandomOrder()->take(4)->get();
        $categories=ProductCategory::withCount('products')->get();
        $products=Product::where('id','!=',0);
         $products=$productService->publicFilter($request,$products);
        if(!$request->filled('sortby')){
            $products=$products->orderBy('id','desc')->paginate(10);
        }else{
            $products=$products->paginate(10);

        }


        $tags=Tag::has('products')->get();
        return view('products.list',compact('products','categories','featured_products','tags'));
    }

    public function product(Request $request,$product_id)
    {
        $product=Product::findOrFail($product_id);
        $related_products=Product::where('product_category_id',$product->product_category_id)->where('id','!=',$product->id)
            ->inRandomOrder()->take(4)->get();
        return view('products.single',compact('product','related_products'));
    }
    public function cart()
    {

        return view('products.cart');
    }
    public function checkout()
    {
        $cart_content=Cart::content();

        $cart_discount=Cart::total_discount();
        $cart_total=Cart::total()+Cart::total_discount();


        $tax=((company_info()->tax_rate/100)* $cart_total);
        $payable=Cart::total()+$tax;


        return view('products.checkout',compact('cart_content','cart_discount'
            ,'cart_total','tax','payable'));
    }
    public function projects()
    {
        $projects=Project::all();
        $project_categories=ProjectCategory::all();
        return view('projects.list',compact('projects','project_categories'));
    }
    public function singleProject($project_id)
    {
        $projects=Project::all();
        $project=Project::findOrFail($project_id);
        return view('projects.details',compact('projects','project'));
    }
    public function about(Request $request)
    {
        $clients=Client::all();
        $team_members=TeamMember::all();
        return view('pages.about',compact('clients','team_members'));
    }
}
