<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveSettingRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Tag;
use App\Services\ClientService;
use App\Services\TeamMemberService;
use App\Services\ProductService;
use App\Services\ProjectService;
use App\Services\ServiceService;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    function dashboard(Request $request)
    {
        $sales=Order::sum('total_payable');
        $orders_count=Order::count();
        $customers_count=Customer::count();
        $products_count=Product::count();
       $product_categories_count=ProductCategory::count();
         $current_week_sales=Order::whereBetween('created_at',
            [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
        )->sum('total_payable');
        $last_week_sales=Order::whereBetween('created_at',
            [Carbon::now()->subMonth()->startOfWeek(), Carbon::now()->subMonth()->endOfWeek()]
        )->sum('total_payable');
        $week_percentage_difference=$current_week_sales>0?(($current_week_sales-$last_week_sales)/$current_week_sales)*100:-100;

        $current_week_average_sales=Order::whereBetween('created_at',
            [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
        )->avg('total_payable');
        $last_30_days_sales = Order::where('created_at','>=',Carbon::now()->subdays(30))->sum('total_payable');
       $top_products=DB::table('order_lines')
           ->selectRaw('sum(order_lines.quantity) as number_of_orders,sum(order_lines.total) as sum_total, product_id, products.name as name,
           products.price as price')
           ->join('products','order_lines.product_id','products.id')
           ->groupBy('product_id','products.name','products.price')
           ->orderByDesc('sum_total');
          if($request->product_time=='weekly')
          {
              $top_products->whereBetween('order_lines.created_at',
              [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
          );
          }
        if($request->product_time=='monthly')
        {
            $top_products->whereBetween('order_lines.created_at',
                [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]
            );
        }
        if($request->product_time=='daily')
        {
            $top_products->where('order_lines.created_at',Carbon::now());
        }

          $top_products=$top_products->limit(5)
           ->get();
        $last_five_orders=Order::orderByDesc('id')->limit(5)->get();
        return view('admin.dashboard',compact('sales','orders_count','current_week_sales',
        'current_week_average_sales','last_30_days_sales','top_products','last_five_orders','week_percentage_difference',
            'last_week_sales','customers_count','products_count','product_categories_count'));
    }
    function settings(Request $request, SettingService $settingService)
    {
        // return view('admin.settings.index');
        return $settingService->viewSetting();
    }

    function saveSettings(SaveSettingRequest $saveSettingRequest, SettingService $settingService)
    {
       return $settingService->saveSetting($saveSettingRequest);
    }

    function products(Request $request, ProductService $productService) {
        return $productService->viewProducts($request);

    }

    public function editProduct(Request $request,ProductService $productService,$product_id)
    {
        return $productService->editProduct($product_id);
    }
    function productCategories(Request $request, ProductService $productService) {
        return $productService->viewProductcategories();

    }
    function saveProductCategories(Request $request, ProductService $productService) {
        return $productService->saveProductCategory($request);

    }
    function saveProducts(Request $request, ProductService $productService) {
        return $productService->saveProduct($request);

    }
    function deleteProduct(Request $request, ProductService $productService,$product_id) {
        return $productService->deleteProduct($product_id);

    }
    function updateProducts(Request $request, ProductService $productService) {
        return $productService->updateProduct($request);

    }

    function projectCategories(Request $request, ProjectService $projectService) {
        return $projectService->viewProjectcategories();

    }
    function saveProjectCategories(Request $request, ProjectService $projectService) {
        return $projectService->saveProjectCategory($request);

    }
    function projects(Request $request, ProjectService $projectService) {
        return $projectService->viewProjects($request);

    }
    public function editProject(Request $request, ProjectService $projectService, $project_id)
    {
        return $projectService->editProject($project_id);
    }
    function saveProjects(Request $request, ProjectService $projectService) {
        return $projectService->saveProject($request);

    }
    function deleteProject(Request $request, ProjectService $projectService, $project_id) {
        return $projectService->deleteProject($project_id);

    }
    function updateProjects(Request $request, ProjectService $projectService) {
        return $projectService->updateProject($request);

    }
    //

    function services(Request $request, ServiceService $serviceService) {
        return $serviceService->viewServices($request);

    }
    public function editService(Request $request, ServiceService $serviceService, $service_id)
    {
        return $serviceService->editService($service_id);
    }
    function saveServices(Request $request, ServiceService $serviceService) {
        return $serviceService->saveService($request);

    }
    function deleteService(Request $request, ServiceService $serviceService, $service_id) {
        return $serviceService->deleteService($service_id);

    }
    function updateServices(Request $request, ServiceService $serviceService) {
        return $serviceService->updateService($request);

    }
//
    function clients(Request $request, ClientService $clientService) {
        return $clientService->viewClients($request);

    }
    public function editClient(Request $request, ClientService $clientService, $client_id)
    {
        return $clientService->editClient($client_id);
    }
    function saveClients(Request $request, ClientService $clientService) {
        return $clientService->saveClient($request);

    }
    function deleteClient(Request $request, ClientService $clientService, $client_id) {
        return $clientService->deleteClient($client_id);

    }
    function updateClients(Request $request, ClientService $clientService) {
        return $clientService->updateClient($request);

    }
    function designRequests(Request $request, ProjectService $projectService) {
        return $projectService->viewDesignRequests($request);

    }
    function saveDesignRequests(Request $request, ProjectService $projectService) {
        return $projectService->saveDesignRequestResponse($request);

    }
    function viewDesignRequest(Request $request, ProjectService $projectService,$design_request_id) {
        return $projectService->viewDesignRequest($design_request_id);

    }
    function customers(Request $request) {
        $customers=Customer::where('id','!=',0);
        if($request->filled('q'))
        {
            $q = $request->input('q');

            $customers->where(function ($query) use ($q) {
                $query->where('name', 'like', '%' . $q . '%')
                    ->where('email', 'like', '%' . $q . '%')
                    ->orWhere('phone', $q);
            });
        }
        $customers=$customers->get();
        return view('admin.customers.index',compact('customers'));

    }
    //
    function team_members(Request $request, TeamMemberService $TeamMemberService) {
        return $TeamMemberService->viewTeamMembers($request);

    }
    public function editTeamMember(Request $request, TeamMemberService $TeamMemberService, $team_member_id)
    {
        return $TeamMemberService->editTeamMember($team_member_id);
    }
    function saveTeamMembers(Request $request, TeamMemberService $TeamMemberService) {
        return $TeamMemberService->saveTeamMember($request);

    }
    function deleteTeamMember(Request $request, TeamMemberService $TeamMemberService, $team_member_id) {
        return $TeamMemberService->deleteTeamMember($team_member_id);

    }
    function updateTeamMembers(Request $request, TeamMemberService $TeamMemberService) {
        return $TeamMemberService->updateTeamMember($request);

    }

    function tagSearch(Request $request)
    {

        if($request->q==""){
            return "";
        }
       else{
        $name=Tag::where('name','LIKE','%'.$request->q.'%')
                        ->select('name as id','name as text')
                        ->get();
            }


        return $name;
    }
}
