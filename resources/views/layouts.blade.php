<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{!! csrf_token() !!}">
        <title>Laravel</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
        <style>
            .toast {
                opacity: 1 !important;
                background-color: #323232 !important;
                color: #fff !important;
            }

            .toast-success {
                background-color: #28a745 !important;
            }

            .toast-error {
                background-color: #dc3545 !important;
            }

        </style>

    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                @endif
            </div>

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                @yield('content')                
            </div>
        </div>
    </body>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap CSS (Bundle) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JavaScript (Bundle) - Popper.js and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Toastr CSS and JavaScript -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @yield('script')


    @if (session('status'))
        <script>
            $(function() {
                toastr.options.positionClass = 'toast-bottom-right';
                toastr.success("{{ session('status') }}");
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            $(function() {
                toastr.options.positionClass = 'toast-bottom-right';
                toastr.error("{{ session('error') }}");
            });
        </script>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $key => $error)
            <script>
                $(function() {
                    toastr.options.positionClass = 'toast-bottom-right';
                    toastr.error("{{ $error }}");
                });
            </script>
        @endforeach
    @endif

</html>
