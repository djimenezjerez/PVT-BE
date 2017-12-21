<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Muserpol - @yield('title') </title>
   
    <link rel="stylesheet" href="{!! asset('css/vendor.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/inspinia.css') !!}" />
    <style>
        .toast-title {
            font-weight: 700
        }

        .toast-message {
            -ms-word-wrap: break-word;
            word-wrap: break-word
        }

        .toast-message a, .toast-message label {
            color: #fff
        }

        .toast-message a:hover {
            color: #ccc;
            text-decoration: none
        }

        .toast-close-button {
            position: relative;
            right: -.3em;
            top: -.3em;
            float: right;
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            -webkit-text-shadow: 0 1px 0 #fff;
            text-shadow: 0 1px 0 #fff;
            opacity: .8;
            -ms-filter: alpha(Opacity=80);
            filter: alpha(opacity=80)
        }

        .toast-close-button:focus, .toast-close-button:hover {
            color: #000;
            text-decoration: none;
            cursor: pointer;
            opacity: .4;
            -ms-filter: alpha(Opacity=40);
            filter: alpha(opacity=40)
        }

        button.toast-close-button {
            padding: 0;
            cursor: pointer;
            background: 0 0;
            border: 0;
            -webkit-appearance: none
        }

        .toast-top-center {
            top: 0;
            right: 0;
            width: 100%
        }

        .toast-bottom-center {
            bottom: 0;
            right: 0;
            width: 100%
        }

        .toast-top-full-width {
            top: 0;
            right: 0;
            width: 100%
        }

        .toast-bottom-full-width {
            bottom: 0;
            right: 0;
            width: 100%
        }

        .toast-top-left {
            top: 12px;
            left: 12px
        }

        .toast-top-right {
            top: 12px;
            right: 12px
        }

        .toast-bottom-right {
            right: 12px;
            bottom: 12px
        }

        .toast-bottom-left {
            bottom: 12px;
            left: 12px
        }

        #toast-container {
            position: fixed;
            z-index: 999999
        }

        #toast-container * {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box
        }

        #toast-container > div {
            position: relative;
            overflow: hidden;
            margin: 0 0 6px;
            padding: 15px 15px 15px 50px;
            width: 300px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            background-position: 15px center;
            background-repeat: no-repeat;
            -moz-box-shadow: 0 0 12px #999;
            -webkit-box-shadow: 0 0 12px #999;
            box-shadow: 0 0 12px #999;
            color: #fff;
            opacity: .8;
            -ms-filter: alpha(Opacity=80);
            filter: alpha(opacity=80)
        }

        #toast-container > :hover {
            -moz-box-shadow: 0 0 12px #000;
            -webkit-box-shadow: 0 0 12px #000;
            box-shadow: 0 0 12px #000;
            opacity: 1;
            -ms-filter: alpha(Opacity=100);
            filter: alpha(opacity=100);
            cursor: pointer
        }

    

        #toast-container.toast-bottom-center > div, #toast-container.toast-top-center > div {
            width: 300px;
            margin: auto
        }

        #toast-container.toast-bottom-full-width > div, #toast-container.toast-top-full-width > div {
            width: 96%;
            margin: auto
        }

        /*.toast {
            background-color: #030303
        }

        .toast-success {
            background-color: #51a351
        }

        .toast-error {
            background-color: #bd362f
        }

        .toast-info {
            background-color: #2f96b4
        }

        .toast-warning {
            background-color: #f89406
        }
*/
        .toast-progress {
            position: absolute;
            left: 0;
            bottom: 0;
            height: 4px;
            background-color: #000;
            opacity: .4;
            -ms-filter: alpha(Opacity=40);
            filter: alpha(opacity=40)
        }

        @media all and (max-width: 240px) {
            #toast-container > div {
                padding: 8px 8px 8px 50px;
                width: 11em
            }

            #toast-container .toast-close-button {
                right: -.2em;
                top: -.2em
            }
        }

        @media all and (min-width: 241px) and (max-width: 480px) {
            #toast-container > div {
                padding: 8px 8px 8px 50px;
                width: 18em
            }

            #toast-container .toast-close-button {
                right: -.2em;
                top: -.2em
            }
        }

        @media all and (min-width: 481px) and (max-width: 768px) {
            #toast-container > div {
                padding: 15px 15px 15px 50px;
                width: 25em
            }
        }
    </style>
</head>
<body class="md-skin fixed-nav no-skin-config">

  <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            <!-- Page wrapper -->
            @include('layouts.topnavbar')

            <!-- Main view  -->
            <div id="app">
                
            @yield('content')
            <flash message="{{ session('flash') }}"></flash>
            </div>
            <!-- Footer -->
            @include('layouts.footer')

        </div>
        <!-- End page wrapper-->

    </div>
    <!-- End wrapper-->

<script src="{!! asset('js/app.js') !!}" type="text/javascript"></script>
{{-- <script src="{!! asset('js/app.js') !!}" type="text/javascript"></script> --}}

@section('scripts')
@show

</body>
</html>
