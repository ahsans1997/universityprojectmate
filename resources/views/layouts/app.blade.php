@include('layouts.partials.head')

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('layouts.partials.nav_top')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="row row-offcanvas row-offcanvas-right">

                <!-- partial:partials/_sidebar.html -->
                @include('layouts.partials.sidebar')
                <!-- partial -->
                <div class="content-wrapper">
                    <div class="row">
                        @isset($title)
                            <div class="col-md-12 mb-4">
                                <div class="card">
                                    <div class="card-body" style="padding: 10px;">
                                        <p style="margin: 0;">{{ $title }}</p>
                                    </div>
                                </div>
                            </div>
                        @endisset
                        @yield('content')
                    </div>

                    <!-- partial:partials/_footer.html -->
                    @include('layouts.partials.footer')
                    <!-- partial -->
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row-offcanvas ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    @include('layouts.partials.scripts')
