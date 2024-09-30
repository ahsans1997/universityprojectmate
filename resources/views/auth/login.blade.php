<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/victory/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 26 Jun 2019 09:43:04 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>University Project Mate</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('/') }}vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="{{ asset('/') }}vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('/') }}css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('/') }}images/favicon.png" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <div class="row">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth">
                    <div class="row w-100">
                        <div class="col-lg-8 mx-auto">
                            <div class="row">
                                <div class="col-lg-6 bg-white">
                                    <div class="auth-form-light text-left p-5">
                                        <h2>Login</h2>
                                        <h4 class="font-weight-light">Hello! let's get started</h4>
                                        <form class="pt-5" method="POST" action="{{ route('login.store') }}">
                                            @csrf
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">University Email</label>
                                                    <input type="email" class="form-control" name="email" placeholder="University Email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Password</label>
                                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                                </div>
                                                <div class="mt-5">
                                                    <button type="submit" class="btn btn-block btn-success btn-lg font-weight-medium">Login</button>
                                                </div>
                                                <div class="mt-3 text-center">
                                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6 login-half-bg d-flex flex-row">
                                    <p class="text-white font-weight-medium text-center flex-grow align-self-end">
                                        Copyright &copy; 2018 All rights reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('/') }}vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('/') }}js/off-canvas.js"></script>
    <script src="{{ asset('/') }}js/hoverable-collapse.js"></script>
    <script src="{{ asset('/') }}js/misc.js"></script>
    <script src="{{ asset('/') }}js/settings.js"></script>
    <script src="{{ asset('/') }}js/todolist.js"></script>
    <!-- endinject -->
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        @endif
    </script>


    {!! Toastr::message() !!}
</body>


<!-- Mirrored from www.urbanui.com/victory/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 26 Jun 2019 09:43:04 GMT -->

</html>
