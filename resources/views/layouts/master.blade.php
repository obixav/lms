@php
$company=company_info();
@endphp
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$company->store_name}}</title>
{{--    <link rel=icon href="{{asset('assets/images/favicon.png')}}" sizes="20x20" type="image/png">--}}

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/nice-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/flaticon.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/slick.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css">
    @livewireStyles
    @yield('stylesheets')
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>

<body>
    <div class="page-wrapper">



        <!-- search popup start-->
        <div class="td-search-popup" id="td-search-popup">
            <form action="index.html" class="search-form">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search....." required>
                </div>
                <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <!-- search popup end-->
        <div class="body-overlay" id="body-overlay"></div>


        <!--Form Back Drop-->
        <div class="form-back-drop"></div>

        <!-- Hidden Sidebar -->
        <section class="hidden-bar">
            <div class="inner-box text-center">
                <div class="cross-icon"><span class="fa fa-times"></span></div>
                <div class="title">
                    <h4>Get Appointment</h4>
                </div>

                <!--Appointment Form-->
                <div class="appointment-form">
                    <form method="post" action="contact.html">
                        <div class="form-group">
                            <input type="text" name="text" value="" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" value="" placeholder="Email Address" required>
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Message" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="theme-btn">Submit now</button>
                        </div>
                    </form>
                </div>

                <!--Social Icons-->
                <div class="social-style-one">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div>
        </section>
        <!--End Hidden Sidebar -->

        @include('layouts.header')
        @yield('content')

        @include('layouts.footer')
    </div>
    <!--End pagewrapper-->

    <!-- all plugins here -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/isotope.min.js')}}"></script>
    <script src="{{asset('assets/js/appear.min.js')}}"></script>
    <script src="{{asset('assets/js/imageload.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/circle-progress.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('assets/js/skill.bars.jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/slick.min.js')}}"></script>
    <script src="{{asset('assets/js/wow.min.js')}}"></script>
    @yield('scripts')
    <!-- For Contact Form -->
    <script src="{{asset('assets/js/jquery.ajaxchimp.min.js')}}"></script>
{{--    <script src="{{asset('assets/js/form-validator.min.js')}}"></script>--}}
{{--    <script src="{{asset('assets/js/contact-form-script.js')}}"></script>--}}

    <!-- main js  -->
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>
    <script>

        function submitForm(formid, url,reload_url=false,progress='progress') {
            formdata = new FormData($('#' + formid)[0]);

            $('button').attr('disabled', true);

            return $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data, status, xhr) {

                    $('button').attr('disabled', false);

                    if(data.success==true){
                        displayMessage('success',data)
                        $('.modal').modal('hide');

                        if(reload_url){
                            window.location=data.url;
                        }
                        return;
                    }else if(data.success==false)
                    {
                        displayValidationError(data.data);
                    }
                    // displayMessage('error',data)
                },
                xhr: function () {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) {
// For handling the progress of the upload
                        myXhr.upload.addEventListener('progress', function (e) {
                            if (e.lengthComputable) {
                                percent = Math.round((e.loaded / e.total) * 100, 2);
                                $('#' + progress).css('width', percent + '%').attr('aria-valuenow',percent);
                                $('#' + progress + '_text').text(percent + '%');
                            }
                        }, false);
                    }
                    return myXhr;
                }
            });

        }
        function displayMessage(type,data){
            Swal.fire(
                `${type}!`,
                data.message,
                `${type}`
            )
            if(type=='success'){
                toastr.success(data.message)
            }
            if(type=='error'){
                toastr.error(data.message)
            }
        }
        function displayValidationError(errors){

            let list = '';
            $.each(errors, function (index, element) {
                // toastr.error(element)
                list += element[0] + '\n';

            });
            Swal.fire(
                `Error!`,
                list,'error'

            )
        }

        $('.shopping-cart').each(function() {
            var delay = $(this).index() * 50 + 'ms';
            $(this).css({
                '-webkit-transition-delay': delay,
                '-moz-transition-delay': delay,
                '-o-transition-delay': delay,
                'transition-delay': delay
            });
        });
        $('#cart, .shopping-cart').hover(function(e) {
            $(".shopping-cart").stop(true, true).addClass("active");
        }, function() {
            $(".shopping-cart").stop(true, true).removeClass("active");
        });
    </script>
    @livewireScripts


</body>
</body>

</html>
