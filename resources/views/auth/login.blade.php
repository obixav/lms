@php
    $company=company_info();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
{{--    <base href="../../../">--}}
    <meta charset="utf-8">
    <meta name="author" content="{{ config('app.name', 'Leave Management System') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./admin_assets/images/favicon.png">
    <!-- Page Title  -->
    <title>{{ config('app.name', 'Leave Management System') }}</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="./admin_assets/css/dashlite.css?ver=3.2.0">
    <link id="skin-default" rel="stylesheet" href="./admin_assets/css/theme.css?ver=3.2.0">
    <link id="skin-theme" rel="stylesheet" href="./admin_assets/css/skins/theme-green.css?ver=3.2.0">
</head>

<body class="nk-body bg-white npc-default pg-auth">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap nk-wrap-nosidebar">
            <!-- content @s -->
            <div class="nk-content ">
                <div class="nk-split nk-split-page nk-split-lg">
                    <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
                        <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                            <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
                        </div>
                        <div class="nk-block nk-block-middle nk-auth-body">
                            <div class="brand-logo pb-5">
                                <a href="#" class="logo-link"  >
{{--                                   <img class="logo-light logo-img logo-img-lg" src="./admin_assets/images/logo.png" srcset="./admin_assets/images/logo2x.png 2x" alt="logo">--}}
                                    <img class="logo-dark logo-img logo-img-lg" src="./admin_assets/images/logo.png" srcset="./admin_assets/images/logo-dark2x.png 2x" alt="logo-dark">
                                </a>
                            </div>
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h5 class="nk-block-title">Login </h5>
                                    <div class="nk-block-des">
                                        <p>Access Leave System using your username and password.</p>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <form  method="POST" action="{{ route('login') }}" class="form-validate is-alter" autocomplete="off">
                               @csrf
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="email-address">Username</label>

                                    </div>
                                    <div class="form-control-wrap">
                                        <input autocomplete="off" name="login" type="text" class="form-control form-control-lg" required id="email-address" placeholder="Enter your email or Staff Id">
                                    </div>
                                </div><!-- .form-group -->
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="password">Password</label>
                                        @if (Route::has('password.request'))
                                        <a class="link link-primary link-sm" tabindex="-1" href="{{ route('password.request') }}">Forgot Password?</a>
                                        @endif
                                    </div>
                                    <div class="form-control-wrap">
                                        <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input autocomplete="new-password" name="password" type="password" class="form-control form-control-lg" required id="password" placeholder="Enter your password">
                                    </div>
                                </div><!-- .form-group -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
                                </div>
                            </form><!-- form -->

                        </div><!-- .nk-block -->
                        <div class="nk-block nk-auth-footer">
                            <div class="nk-block-between">
                                <ul class="nav nav-sm">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Terms & Condition</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Privacy Policy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Help</a>
                                    </li>
                                    <li class="nav-item dropup">
                                        <a class="dropdown-toggle dropdown-indicator has-indicator nav-link" data-bs-toggle="dropdown" data-offset="0,10"><small>English</small></a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                            <ul class="language-list">
                                                <li>
                                                    <a href="#" class="language-item">
                                                        <img src="./admin_assets/images/flags/english.png" alt="" class="language-flag">
                                                        <span class="language-name">English</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="language-item">
                                                        <img src="./admin_assets/images/flags/spanish.png" alt="" class="language-flag">
                                                        <span class="language-name">Español</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="language-item">
                                                        <img src="./admin_assets/images/flags/french.png" alt="" class="language-flag">
                                                        <span class="language-name">Français</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="language-item">
                                                        <img src="./admin_assets/images/flags/turkey.png" alt="" class="language-flag">
                                                        <span class="language-name">Türkçe</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul><!-- .nav -->
                            </div>
                            <div class="mt-3">
                                <p>&copy; 2023 {{$company->company_name}}. All Rights Reserved.</p>
                            </div>
                        </div><!-- .nk-block -->
                    </div><!-- .nk-split-content -->
                    <div class="nk-split-content nk-split-stretch bg-lighter d-flex " data-toggle-body="true" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
                        <div class="nk-block nk-block-middle nk-auth-body">
                            <img class="" src="./admin_assets/images/unn-logo.png" alt="UNN Logo">
                        </div>
                    </div><!-- .nk-split-content -->
                </div><!-- .nk-split -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- content @e -->
    </div>
    <!-- main @e -->
</div>
<!-- app-root @e -->
<!-- JavaScript -->
<script src="./admin_assets//js/bundle.js?ver=3.2.0"></script>
<script src="./admin_assets//js/scripts.js?ver=3.2.0"></script>
<!-- select region modal -->
</body>

</html>
