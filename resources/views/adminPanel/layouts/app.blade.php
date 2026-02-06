<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name') }} - Admin Dashboard</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('uploads/images/original/logo.png') }}">
    
    <!-- Bootstrap 4.6.2 (Latest 4.x version) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    
    <!-- Bootstrap Datetimepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    
    <!-- CoreUI 2.1.16 - Admin Template -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/css/coreui.min.css">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/icons@1.0.1/css/coreui-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icon.min.css">
    
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- Chosen -->
    <link href="{{ asset('vendor/choosen/css/chosen.min.css') }}" rel="stylesheet" type="text/css">
    
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #4a90e2;
            --primary-dark: #357abd;
            --secondary-color: #50c878;
            --sidebar-bg: #2c3e50;
            --sidebar-hover: #34495e;
            --header-bg: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --text-primary: #2c3e50;
            --text-secondary: #7f8c8d;
            --border-color: #e0e6ed;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 20px rgba(0,0,0,0.15);
        }
        
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        body {
            background: #f5f7fa;
            font-size: 14px;
            color: var(--text-primary);
        }
        
        /* Header Improvements */
        .app-header {
            background: var(--header-bg);
            border-bottom: none;
            box-shadow: var(--shadow-md);
            height: 60px;
            padding: 0 1rem;
        }
        
        .app-header .navbar-brand {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }
        
        .app-header .navbar-brand:hover {
            transform: scale(1.05);
        }
        
        .app-header .navbar-brand-full {
            max-height: 40px;
            width: auto;
        }
        
        .app-header .navbar-brand-minimized {
            max-height: 35px;
            width: auto;
        }
        
        .navbar-toggler {
            border: none;
            background: rgba(255,255,255,0.2);
            padding: 0.5rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .navbar-toggler:hover {
            background: rgba(255,255,255,0.3);
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        /* User Dropdown Styling */
        .app-header .nav-link {
            color: #ffffff !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            margin-right: 0.5rem;
        }
        
        .app-header .nav-link:hover {
            background: rgba(255,255,255,0.15);
        }
        
        .app-header .dropdown-menu {
            border: none;
            box-shadow: var(--shadow-lg);
            border-radius: 8px;
            margin-top: 0.5rem;
            min-width: 200px;
        }
        
        .app-header .dropdown-item {
            padding: 0.75rem 1.25rem;
            transition: all 0.2s ease;
            color: var(--text-primary);
        }
        
        .app-header .dropdown-item:hover {
            background: #f8f9fa;
            color: var(--primary-color);
            transform: translateX(5px);
        }
        
        .app-header .dropdown-item i {
            margin-right: 0.5rem;
            width: 20px;
        }
        
        .dropdown-divider {
            margin: 0.5rem 0;
        }
        
        /* Sidebar Improvements */
        .sidebar {
            background: var(--sidebar-bg);
            box-shadow: var(--shadow-md);
        }
        
        .sidebar .sidebar-nav {
            padding: 1rem 0;
        }
        
        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 0.85rem 1.25rem;
            margin: 0.25rem 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        
        .sidebar .nav-link:hover {
            background: var(--sidebar-hover);
            color: #ffffff;
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            font-weight: 600;
            box-shadow: var(--shadow-sm);
        }
        
        .sidebar .nav-icon {
            width: 20px;
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }
        
        .sidebar-minimizer {
            background: var(--sidebar-hover);
            border-top: 1px solid rgba(255,255,255,0.1);
            transition: all 0.3s ease;
        }
        
        .sidebar-minimizer:hover {
            background: #1a252f;
        }
        
        /* Main Content Area */
        .main {
            padding: 1.5rem;
            background: #f5f7fa;
        }
        
        .main .container-fluid {
            max-width: 1400px;
        }
        
        /* Breadcrumb Styling */
        .breadcrumb {
            background: #ffffff;
            padding: 1rem 1.25rem;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
        }
        
        .breadcrumb-item {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }
        
        .breadcrumb-item.active {
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .breadcrumb-item a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        .breadcrumb-item a:hover {
            color: var(--primary-color);
        }
        
        /* Card Improvements */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .card:hover {
            box-shadow: var(--shadow-md);
        }
        
        .card-header {
            background: #ffffff;
            border-bottom: 2px solid #f8f9fa;
            padding: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            border-radius: 10px 10px 0 0 !important;
        }
        
        .card-header i {
            color: var(--primary-color);
            margin-right: 0.5rem;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        /* Button Improvements */
        .btn {
            border-radius: 6px;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-primary {
            background: var(--primary-color);
            box-shadow: 0 4px 6px rgba(74, 144, 226, 0.3);
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(74, 144, 226, 0.4);
        }
        
        .btn-success {
            background: var(--secondary-color);
            box-shadow: 0 4px 6px rgba(80, 200, 120, 0.3);
        }
        
        .btn-success:hover {
            background: #45b369;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(80, 200, 120, 0.4);
        }
        
        /* Footer Improvements */
        .app-footer {
            background: #ffffff;
            border-top: 1px solid var(--border-color);
            padding: 1rem 1.5rem;
            font-size: 0.875rem;
            color: var(--text-secondary);
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
        }
        
        .app-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }
        
        .app-footer a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        /* Table Improvements */
        .table {
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table thead th {
            background: #f8f9fa;
            color: var(--text-primary);
            font-weight: 600;
            border: none;
            padding: 1rem;
        }
        
        .table tbody tr {
            transition: all 0.2s ease;
        }
        
        .table tbody tr:hover {
            background: #f8f9fa;
        }
        
        .table td {
            padding: 0.875rem 1rem;
            vertical-align: middle;
        }
        
        /* Form Improvements */
        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 0.625rem 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.15);
        }
        
        /* Alert Improvements */
        .alert {
            border: none;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            box-shadow: var(--shadow-sm);
        }
        
        /* Animation Classes */
        .animated {
            animation-duration: 0.5s;
            animation-fill-mode: both;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .fadeIn {
            animation-name: fadeIn;
        }
        
        /* Pagination Improvements */
        .pagination {
            margin-top: 1.5rem;
        }
        
        .page-link {
            color: var(--primary-color);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            margin: 0 0.25rem;
            transition: all 0.2s ease;
        }
        
        .page-link:hover {
            background: var(--primary-color);
            color: #ffffff;
            transform: translateY(-2px);
        }
        
        .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        /* Responsive Improvements */
        @media (max-width: 991.98px) {
            .app-header {
                height: 55px;
            }
            
            .main {
                padding: 1rem;
            }
            
            .card-body {
                padding: 1rem;
            }
            
            .breadcrumb {
                padding: 0.75rem 1rem;
            }
        }
        
        /* Loading State */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.9);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }
        
        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Dashboard-Specific Enhancements */
        .stats-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .stats-card .card-body {
            padding: 1.5rem;
        }

        .stats-icon {
            opacity: 0.3;
            transition: opacity 0.3s ease;
        }

        .stats-card:hover .stats-icon {
            opacity: 0.5;
        }

        /* Gradient Backgrounds */
        .bg-gradient-purple {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-gradient-danger {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .bg-gradient-dark {
            background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
        }

        .bg-gradient-orange {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        /* Chart Container */
        .chart-container {
            position: relative;
            height: 300px;
        }

        /* List Group Enhancements */
        .list-group-item {
            transition: all 0.2s ease;
        }

        .list-group-item:hover {
            transform: translateX(3px);
        }

        /* Dashboard Cards */
        .dashboard-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        /* Quick Stats Grid */
        .quick-stat {
            padding: 1rem;
            border-radius: 8px;
            background: #f8f9fa;
            text-align: center;
        }

        .quick-stat h3 {
            margin: 0;
            color: var(--primary-color);
            font-size: 2rem;
        }

        .quick-stat p {
            margin: 0;
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        /* Animation for cards */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animated-card {
            animation: slideInUp 0.5s ease;
        }

        /* Responsive Dashboard */
        @media (max-width: 768px) {
            .stats-card {
                margin-bottom: 1rem;
            }

            .chart-container {
                height: 200px;
            }
        }
    </style>
    
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WC3SSBB');</script>
    <!-- End Google Tag Manager -->
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WC3SSBB" 
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>
    
    <!-- Header -->
    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <a class="navbar-brand" href="{{ route('adminPanel.dashboard') }}">
            <img class="navbar-brand-full" src="{{ asset('uploads/images/original/logo.png') }}" alt="{{ config('app.name') }} Logo">
            <img class="navbar-brand-minimized" src="{{ asset('uploads/images/original/logo.png') }}" alt="{{ config('app.name') }} Logo">
        </a>
        
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle mr-2"></i>
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>{{ Auth::user()->email }}</strong>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/" target="_blank">
                        <i class="fas fa-eye"></i> @lang('auth.app.view_site')
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('adminPanel.logout') }}">
                        <i class="fas fa-sign-out-alt"></i> @lang('auth.sign_out')
                    </a>
                </div>
            </li>
        </ul>
    </header>

    <!-- App Body -->
    <div class="app-body">
        @include('adminPanel.layouts.sidebar')
        
        <main class="main">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="app-footer">
        <div>
            <a href="https://www.techvillageco.com/" target="_blank">Tech Village Egypt</a>
            <span class="ml-2">&copy; {{ date('Y') }}. All rights reserved.</span>
        </div>
        <div class="ml-auto">
            <span>Powered by</span>
            <a href="{{ url('/') }}" class="ml-1">Farah Nile Cruise</a>
        </div>
    </footer>

    <!-- Scripts -->
    <!-- jQuery 3.6.3 -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    
    <!-- Bootstrap 4.6.2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    
    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    
    <!-- Bootstrap Datetimepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <!-- CoreUI -->
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
    
    <!-- Chosen -->
    <script src="{{ asset('vendor/choosen/js/chosen.jquery.min.js') }}"></script>
    
    <!-- Dynamic Form Fields -->
    <script src="{{ asset('vendor/customs/js/dynamic-form-fields.js') }}"></script>

    <!-- Custom Scripts -->
    <script>
        $(document).ready(function() {
            // Initialize Chosen
            $(".chosen-select").chosen({
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
            
            // Initialize Select2
            $('.select2').select2({
                closeOnSelect: false,
                width: '100%',
                theme: 'default'
            });
            
            // Initialize Datetimepicker
            $('.datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                icons: {
                    time: 'fa fa-clock',
                    date: 'fa fa-calendar',
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down',
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-calendar-check',
                    clear: 'fa fa-trash',
                    close: 'fa fa-times'
                }
            });
            
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
            
            // Add smooth scrolling to all links
            $('a[href^="#"]').on('click', function(event) {
                var target = $(this.getAttribute('href'));
                if(target.length) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 70
                    }, 1000);
                }
            });
            
            // Loading overlay for forms
            $('form').on('submit', function() {
                $('#loadingOverlay').css('display', 'flex');
            });
            
            // Confirm delete actions
            $('.delete-confirm').on('click', function(e) {
                if (!confirm('Are you sure you want to delete this item?')) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>