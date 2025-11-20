<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon" />
    <title>PlainAdmin Demo | Bootstrap 5 Admin Template</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lineicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/materialdesignicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    @stack('styles')
</head>

<body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->
    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
        <!-- ========== header start ========== -->
        @include('partials.header')
        <!-- ========== header end ========== -->

        <!-- ========== section start ========== -->
        @yield('content')
        <!-- ========== section end ========== -->

        <!-- ========== footer start =========== -->
        @include('partials.footer')
        <!-- ========== footer end =========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->
    <div class="modal fade" id="commonModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commonModalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="commonModalBody"></div>
                {{-- <div class="modal-footer" id="commonModalFooter"></div> --}}
            </div>
        </div>
    </div>

    <!-- Common Modal -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/dynamic-pie-chart.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/fullcalendar.js') }}"></script>
    <script src="{{ asset('assets/js/jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/world-merc.js') }}"></script>
    <script src="{{ asset('assets/js/polyfill.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    @stack('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '.open-modal', function(e) {
            e.preventDefault();
            let url = $(this).data('url'); 
            const title = $(this).data('title') || 'Modal';
            $('#commonModal .modal-title').text(title);
            $('#commonModal .modal-body').load(url, function() {
                $('#commonModal').modal('show');
            });
        });
    </script>
</body>



</html>
