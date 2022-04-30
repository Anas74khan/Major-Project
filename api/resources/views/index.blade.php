
<!DOCTYPE html>
<html dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
        <title>ShopPe - {{ 'page name' }}</title>
        
        @yield('style')
        
        <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
        <link href="{{ asset('icons/material-design-iconic-font/css/materialdesignicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('icons/flag-icon-css/flag-icon.min.css') }}" rel="stylesheet">
        <link href="{{ asset('icons/font-awesome/css/fontawesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('icons/themify-icons/themify-icons.css') }}" rel="stylesheet">
    </head>

    <body>
        <div class="main-wrapper">
            
            <div class="preloader">
                <div class="lds-ripple">
                    <div class="lds-pos"></div>
                    <div class="lds-pos"></div>
                </div>
            </div>
            
            @yield('content')

        </div>
        
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

        <script>

            const loader = {
                show: () => $(document).find('.preloader').css('opacity','0.7').css('display','unset'),
                hide: () => $(document).find('.preloader').css('display','none').css('opacity','1')
            };

        </script>
        
        @yield('script')

    </body>

</html>
