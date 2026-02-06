<!DOCTYPE html>
<html>
<head>
 


    <meta charset="UTF-8">
    <title>{{config('app.name')}}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 4.1.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
    <!-- Theme style -->
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/css/coreui.min.css">-->
    <link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/css/coreui.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://fastly.jsdelivr.net/npm/@icon/coreui-icons-free@1.0.1-alpha.1/coreui-icons-free.css">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@icon/coreui-icons-free@1.0.1-alpha.1/coreui-icons-free.css">-->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">
    <link href='{{ asset('vendor/choosen/css/chosen.min.css') }}' rel='stylesheet' type='text/css'>
    {{-- <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script> --}}
    <script src="https://fastly.ckeditor.com/4.14.1/full/ckeditor.js"></script>
    <link href="https://fastly.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />-->
 <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WC3SSBB');</script>
<!-- End Google Tag Manager -->

</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WC3SSBB"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <img class="navbar-brand-full" src="{{asset('uploads/images/original/logo.png')}}" height="30" alt="Farah Logo">
            <img class="navbar-brand-minimized" src="{{asset('uploads/images/original/logo.png')}}" width="30" height="30" alt="Farah Logo">
        </a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item d-md-down-none">
                {{-- <a class="nav-link" href="#">
                <i class="icon-bell"></i>
                <span class="badge badge-pill badge-danger">5</span>
            </a> --}}
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" style="margin-right: 10px" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    {{-- <div class="dropdown-header text-center">
                    <strong>Account</strong>
                </div>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-envelope-o"></i> @lang('auth.app.messages')
                    <span class="badge badge-success">42</span>
                </a>
                <div class="dropdown-header text-center">
                    <strong>@lang('auth.app.settings')</strong>
                </div>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-user"></i> @lang('auth.app.profile')</a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-wrench"></i> @lang('auth.app.settings')</a>  --}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/" target="/">
                        <i class="fa fa-eye"></i> @lang('auth.app.view_site')
                    </a>
                    <a class="dropdown-item" href="{{ route('adminPanel.logout') }}" class="btn btn-default btn-flat">
                        <i class="fa fa-lock"></i>@lang('auth.sign_out')
                    </a>
                </div>
            </li>
        </ul>
    </header>

    <div class="app-body">
        @include('adminPanel.layouts.sidebar')
        <main class="main">
            @yield('content')
        </main>
    </div>
    <footer class="app-footer">
        <div>
            <a href="https://www.techvillageco.com/" target="_blanck">Tech Village Egypt </a>
            <span>&copy; {{date('Y')}}.</span>
        </div>
        <div class="ml-auto">
            <span>Powered by</span>
            <a href="#">Farah Nile Cruise</a>
        </div>
    </footer>
</body>
<!-- jQuery 3.1.1 -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://fastly.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://fastly.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>-->
<script src='{{ asset('vendor/choosen/js/chosen.jquery.min.js') }}'></script>
<script>
    $(".chosen-select").chosen({
        no_results_text: "Oops, nothing found!"
    });

</script>
<script src='{{ asset('vendor/customs/js/dynamic-form-fields.js') }}'></script>

@stack('scripts')

<script>
    $(function() {
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
    $(document).ready(function() {
        $('.select2').select2({
            closeOnSelect: false
        });
    });

</script>
</html>
