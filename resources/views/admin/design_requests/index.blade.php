@extends('admin.layouts.master')
@section('stylesheets')
<style>
.dropzone .dz-preview .dz-error-message {
    top: 150px!important;
  }
    </style>
@endsection
@section('content')
 <!-- content @s -->
 <div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Design Requests</h3>

                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <form action="">
                                        <li>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-search"></em>
                                                </div>
                                                <input type="text" name="q" class="form-control" id="default-04" placeholder="Quick search by name or SKU">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-control-wrap">

                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-link-group"></em>
                                                </div>
                                                <select name="category" class="form-control" id="">
                                                    <option value="0">Select Project Category</option>
                                                    @foreach ($projectCategories as $category)
                                                    <option value="{{$category->id}}" {{request()->category==$category->id?'selected':''}}>{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </li>
                                            <li>
                                                <div class="form-control-wrap">

                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-users"></em>
                                                    </div>
                                                <select name="customer" class="form-control select2" id="">
                                                    <option value="0">Select Customers</option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{$customer->id}}" {{request()->customer==$customer->id?'selected':''}}>{{$customer->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </li>


                                        <li>
                                            <div class="form-control-wrap">

                                                <button type="submit" class="btn btn-info d-none d-md-inline-flex">Filter</button>
                                            </div>
                                        </li>

                                    </form>
{{--                                        <li class="nk-block-tools-opt">--}}
{{--                                            <a href="#" data-target="addProject" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>--}}
{{--                                            <a href="#" data-target="addProject" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Project</span></a>--}}
{{--                                        </li>--}}
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                <div class="nk-tb-list">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="pid">
                                                <label class="custom-control-label" for="pid"></label>
                                            </div>
                                        </div>

                                        <div class="nk-tb-col"><span>Category</span></div>
                                        <div class="nk-tb-col tb-col-md"><span>Customer Name</span></div>
                                        <div class="nk-tb-col"><span>Request Date</span></div>
                                        <div class="nk-tb-col"><span>Budget</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="me-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .nk-tb-item -->

                                    @foreach ($design_requests as $dr )
                                    @php
                                        $mediaItems = $dr->getMedia("request_images");
                                    @endphp
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="pid4">
                                                <label class="custom-control-label" for="pid4"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                                <img src="{{count($mediaItems)>1?$dr->getFirstMedia("request_images")->preview_url:''}}" alt="" class="thumb">
                                                <span class="title">{{$dr->project_category->name}}</span>
                                            </span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-lead"> {{$dr->customer?$dr->customer->name:''}}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub">{{date('F j, Y',strtotime($dr->created_at))}}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub">{{($dr->budget)}}</span>
                                        </div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="me-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="{{url('admin/design_requests/'.$dr->id)}}"><em class="icon ni ni-eye"></em><span>View Request</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                    @endforeach


                                </div><!-- .nk-tb-list -->
                            </div>
                            <div class="card-inner">
                                <div class="nk-block-between-md g-3">
                                    <div class="g">


                                    </div>

                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
     </div>
        </div>
    </div>
</div>
<!-- content @e -->
@endsection
@section('scripts')


</script>
@endsection
