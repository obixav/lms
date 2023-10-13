<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
{{--    <base href="">--}}
    <meta charset="utf-8">
    <meta name="author" content="Tobe Obiakor">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="leave management system">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{asset('admin_assets/images/favicon.png')}}">
    <!-- Page Title  -->
    <title>Error 404 | DashLite Admin Template</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/dashlite.css?ver=3.2.0')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('admin_assets/css/theme.css?ver=3.2.0')}}">
</head>

<body class="nk-body bg-white npc-default pg-error">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap nk-wrap-nosidebar">
            <!-- content @s -->
            <div class="nk-content ">
                <div class="nk-block nk-block-middle wide-md mx-auto">
                    <div class="nk-block-content nk-error-ld text-center">
                        <img class="nk-error-gfx" src="{{asset('admin_assets/images/gfx/error-404.svg')}}" alt="">
                        <div class="wide-xs mx-auto">
                            <h3 class="nk-error-title">Oops! Why you’re here?</h3>
                            <p class="nk-error-text">We are very sorry for inconvenience. It looks like you’re try to access a page that either has been deleted or never existed.</p>
                            <a href="{{url('dashboard')}}" class="btn btn-lg btn-primary mt-2">Back To Home</a>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- content @e -->
    </div>
    <!-- main @e -->
</div>
<!-- app-root @e -->
<!-- JavaScript -->
<script src="{{asset('admin_assets/js/bundle.js?ver=3.2.0')}}"></script>
<script src="{{asset('admin_assets/js/scripts.js?ver=3.2.0')}}"></script>
<!-- select region modal -->


</html>
