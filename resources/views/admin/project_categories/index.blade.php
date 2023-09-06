@extends('admin.layouts.master')
@section('stylesheets')
<link rel="stlysheet" href="./admin_assets/css/draw-modal.css">
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
                            <h3 class="nk-block-title page-title">Project Categories</h3>
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

                                                <button type="submit" class="btn btn-info d-none d-md-inline-flex">Filter</button>
                                            </div>
                                        </li>

                                    </form>
                                        <li class="nk-block-tools-opt">
                                            <a href="#" data-target="addProjectCategory" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Project Category</span></a>
                                        </li>
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
                                        <div class="nk-tb-col tb-col-sm"><span>Name</span></div>
                                      <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="me-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Selected</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    @foreach ($projectCategories as $category )
                                    <!-- .nk-tb-item -->
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="pid1">
                                                <label class="custom-control-label" for="pid1"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">

                                                <span class="title">{{$category->name}}</span>
                                            </span>
                                        </div>

                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="me-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a  onclick="editCategory({{$category}})"><em class="icon ni ni-edit"></em><span>Edit Project Category</span></a></li>
                                                                <li><a href="#" onclick="deleteCategory({{$category->id}})"><em class="icon ni ni-trash"></em><span>Remove Project Category</span></a></li>
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
                        </div>
                    </div>
                </div><!-- .nk-block -->
                <div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProjectCategory" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title">New Project Category</h5>
                            <div class="nk-block-des">
                                <p>Add information and add new project category.</p>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-3">
                            <form id="addProjectCategoryForm">
                                @csrf
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="product-title">Category Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit"><em class="icon ni ni-plus"></em><span>Save New</span></button>
                            </div>
                            </form>
                        </div>
                    </div><!-- .nk-block -->
                </div>
                <div class="nk-add-product toggle-slide toggle-slide-right" id="editProjectCategory" data-content="editProjectCategory" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title">Edit Project Category</h5>
                            <div class="nk-block-des">
                                <p>edit information and edit new project category.</p>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-3">
                            <form id="editProjectCategoryForm">
                                @csrf
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="product-title">Category Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit"><em class="icon ni ni-plus"></em><span>Save New</span></button>
                            </div>
                            </form>
                        </div>
                    </div><!-- .nk-block -->
                </div>
                 <!-- Modal Default -->
    <div class="modal fade " tabindex="-1" id="modalDefault" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Title</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem similique earum necessitatibus nesciunt! Quia id expedita asperiores voluptatem odit quis fugit sapiente assumenda sunt voluptatibus atque facere autem, omnis explicabo.</p>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Modal Footer Text</span>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
</div>
<!-- content @e -->
@endsection
@section('scripts')
<script>
    $('#addProjectCategoryForm').submit(function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to Save changes?!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Save it!'
    }).then((result) => {
        if (result.isConfirmed) {
            submitForm('addProjectCategoryForm', '{{url('admin/project_categories')}}', false)
            .then(() => {
                location.reload();
            })
        }
    })
});

function editCategory(category) {
    // alert('works');
    $("#modalDefault").toggle();
    // NioApp.Toggle.trigger('editProjectCategory', attr);
}
</script>
@endsection
