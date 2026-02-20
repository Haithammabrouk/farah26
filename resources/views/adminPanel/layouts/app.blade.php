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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet" type="text/css">
    
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

        /* ========================================
           ENHANCED DESIGN IMPROVEMENTS
           ======================================== */

        /* Dark Mode Support */
        [data-theme="dark"] {
            --primary-color: #5ba3f5;
            --primary-dark: #4a8cd4;
            --secondary-color: #5ed68f;
            --sidebar-bg: #1a1d24;
            --sidebar-hover: #252932;
            --text-primary: #e4e7eb;
            --text-secondary: #9ca3af;
            --border-color: #2d3748;
            --card-bg: #252932;
            --body-bg: #1a1d24;
        }

        [data-theme="dark"] body {
            background: var(--body-bg);
            color: var(--text-primary);
        }

        [data-theme="dark"] .main {
            background: var(--body-bg);
        }

        [data-theme="dark"] .card {
            background: var(--card-bg);
            color: var(--text-primary);
        }

        [data-theme="dark"] .card-header {
            background: var(--card-bg);
            border-bottom-color: var(--border-color);
        }

        [data-theme="dark"] .table {
            background: var(--card-bg);
            color: var(--text-primary);
        }

        [data-theme="dark"] .table thead th {
            background: #1a1d24;
            color: var(--text-primary);
        }

        [data-theme="dark"] .table tbody tr:hover {
            background: #2d3748;
        }

        [data-theme="dark"] .breadcrumb {
            background: var(--card-bg);
            border-color: var(--border-color);
        }

        [data-theme="dark"] .form-control {
            background: #1a1d24;
            border-color: var(--border-color);
            color: var(--text-primary);
        }

        [data-theme="dark"] .form-control:focus {
            background: #1a1d24;
            border-color: var(--primary-color);
        }

        [data-theme="dark"] .app-footer {
            background: var(--card-bg);
            border-top-color: var(--border-color);
        }

        [data-theme="dark"] .sidebar {
            background: var(--sidebar-bg);
        }

        [data-theme="dark"] .app-header {
            background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
        }

        [data-theme="dark"] .sidebar .nav-link.active {
            background: linear-gradient(135deg, #5ba3f5 0%, #4a8cd4 100%);
        }

        [data-theme="dark"] .page-link {
            background: var(--card-bg);
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        [data-theme="dark"] .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        [data-theme="dark"] .alert-info {
            background: #1e3a5f;
            color: #93c5fd;
            border-color: #2d5282;
        }

        [data-theme="dark"] .alert-success {
            background: #1e4d2b;
            color: #86efac;
            border-color: #2d6a3e;
        }

        [data-theme="dark"] .alert-warning {
            background: #4d3800;
            color: #fcd34d;
            border-color: #6b5300;
        }

        [data-theme="dark"] .alert-danger {
            background: #4d1f1f;
            color: #fca5a5;
            border-color: #6b2c2c;
        }

        [data-theme="dark"] .dropdown-menu {
            background: var(--card-bg);
            border-color: var(--border-color);
        }

        [data-theme="dark"] .dropdown-item {
            color: var(--text-primary);
        }

        [data-theme="dark"] .dropdown-item:hover {
            background: #2d3748;
            color: var(--primary-color);
        }

        [data-theme="dark"] .dropdown-header {
            color: var(--text-secondary);
        }

        [data-theme="dark"] .dropdown-divider {
            border-color: var(--border-color);
        }

        [data-theme="dark"] .badge-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #fff;
        }

        [data-theme="dark"] .badge-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: #fff;
        }

        [data-theme="dark"] .badge-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: #fff;
        }

        [data-theme="dark"] .badge-info {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #fff;
        }

        [data-theme="dark"] .stats-card {
            background: var(--card-bg);
        }

        [data-theme="dark"] .empty-state i,
        [data-theme="dark"] .empty-state h4,
        [data-theme="dark"] .empty-state p {
            color: var(--text-primary);
        }

        [data-theme="dark"] .select2-container--default .select2-selection--single,
        [data-theme="dark"] .select2-container--default .select2-selection--multiple {
            background: #1a1d24;
            border-color: var(--border-color);
            color: var(--text-primary);
        }

        [data-theme="dark"] .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: var(--text-primary);
        }

        [data-theme="dark"] .select2-dropdown {
            background: var(--card-bg);
            border-color: var(--border-color);
        }

        [data-theme="dark"] .select2-results__option {
            color: var(--text-primary);
        }

        [data-theme="dark"] .select2-results__option--highlighted {
            background: #2d3748 !important;
        }

        /* Dark Mode Toggle */
        .theme-toggle {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
            cursor: pointer;
        }

        .theme-toggle input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .theme-toggle-slider {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255,255,255,0.2);
            transition: 0.4s;
            border-radius: 30px;
        }

        .theme-toggle-slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        .theme-toggle input:checked + .theme-toggle-slider {
            background: var(--primary-color);
        }

        .theme-toggle input:checked + .theme-toggle-slider:before {
            transform: translateX(30px);
        }

        .theme-toggle-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px;
            transition: 0.3s;
        }

        .theme-toggle-icon-sun {
            left: 8px;
            color: #fbbf24;
        }

        .theme-toggle-icon-moon {
            right: 8px;
            color: #fff;
        }

        /* Enhanced Table Styling */
        .table-hover tbody tr {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .table-hover tbody tr:hover {
            background: #f0f7ff !important;
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        [data-theme="dark"] .table-hover tbody tr:hover {
            background: #2d3748 !important;
        }

        .table-responsive {
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
        }

        .table td, .table th {
            border-color: var(--border-color);
        }

        /* Status Badges */
        .badge {
            padding: 0.4rem 0.8rem;
            font-weight: 500;
            font-size: 0.75rem;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
            color: #0f5132;
        }

        .badge-danger {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: #842029;
        }

        .badge-warning {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            color: #664d03;
        }

        .badge-info {
            background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
            color: #055160;
        }

        .badge-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
        }

        .badge-secondary {
            background: linear-gradient(135deg, #e0e0e0 0%, #bdbdbd 100%);
            color: #2c3e50;
        }

        /* Action Buttons in Tables */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.8rem;
            border-radius: 5px;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }

        .btn-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }

        .btn-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffa751 0%, #ffe259 100%);
            border: none;
            color: #fff;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 167, 81, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 87, 108, 0.4);
        }

        /* Enhanced Form Styling */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-group label.required:after {
            content: " *";
            color: #f5576c;
        }

        .form-control-lg {
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
            border-radius: 8px;
        }

        .input-group {
            box-shadow: var(--shadow-sm);
            border-radius: 6px;
            overflow: hidden;
        }

        .input-group-text {
            background: #f8f9fa;
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
        }

        [data-theme="dark"] .input-group-text {
            background: #1a1d24;
            border-color: var(--border-color);
            color: var(--text-primary);
        }

        /* Form Validation States */
        .was-validated .form-control:valid,
        .form-control.is-valid {
            border-color: #50c878;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2350c878' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .was-validated .form-control:invalid,
        .form-control.is-invalid {
            border-color: #f5576c;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23f5576c'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23f5576c' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .valid-feedback, .invalid-feedback {
            font-size: 0.875rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        .valid-feedback {
            color: #50c878;
        }

        .invalid-feedback {
            color: #f5576c;
        }

        /* Enhanced Select2 Styling */
        .select2-container--default .select2-selection--single {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            height: 38px;
            padding: 0.375rem 0;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 38px;
            padding-left: 1rem;
            color: var(--text-primary);
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            min-height: 38px;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple,
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.15);
        }

        .select2-dropdown {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            box-shadow: var(--shadow-lg);
        }

        /* Search & Filter Section */
        .search-filter-section {
            background: #ffffff;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
        }

        [data-theme="dark"] .search-filter-section {
            background: var(--card-bg);
        }

        .search-input-wrapper {
            position: relative;
        }

        .search-input-wrapper .form-control {
            padding-left: 2.5rem;
        }

        .search-input-wrapper i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        /* Advanced Card Hover Effects */
        .card-interactive {
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .card-interactive:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .card-interactive:hover:before {
            left: 100%;
        }

        /* Tooltip Enhancements */
        .tooltip-inner {
            background: #2c3e50;
            border-radius: 6px;
            padding: 0.5rem 0.75rem;
            font-size: 0.8rem;
        }

        /* Progress Bars */
        .progress {
            height: 10px;
            border-radius: 10px;
            background: #e9ecef;
            overflow: hidden;
        }

        [data-theme="dark"] .progress {
            background: #1a1d24;
        }

        .progress-bar {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            transition: width 0.6s ease;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--text-secondary);
            opacity: 0.5;
            margin-bottom: 1rem;
        }

        .empty-state h4 {
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
        }

        /* Loading Button State */
        .btn-loading {
            position: relative;
            pointer-events: none;
        }

        .btn-loading:after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            top: 50%;
            left: 50%;
            margin-left: -8px;
            margin-top: -8px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 0.6s linear infinite;
        }

        /* Notification Badge */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #f5576c;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(245, 87, 108, 0.4);
        }

        /* Improved Breadcrumb with Icons */
        .breadcrumb-item + .breadcrumb-item::before {
            content: "\f105";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: var(--text-secondary);
        }

        /* Card with Icon Header */
        .card-icon-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-icon-header i {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        /* Statistic Number Animation */
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Responsive Enhancements */
        @media (max-width: 576px) {
            .action-buttons {
                flex-direction: column;
            }

            .btn-sm {
                width: 100%;
            }

            .theme-toggle {
                width: 50px;
                height: 26px;
            }

            .theme-toggle-slider:before {
                height: 18px;
                width: 18px;
            }

            .theme-toggle input:checked + .theme-toggle-slider:before {
                transform: translateX(24px);
            }
        }

        /* Print Styles */
        @media print {
            .sidebar, .app-header, .app-footer, .btn, .action-buttons {
                display: none !important;
            }

            .main {
                padding: 0 !important;
            }

            .card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
        }
    </style>
    
    <!-- Google Tag Manager -->
    @php
        $gtm_id = App\Models\Setting::get('google_tag_manager_id');
    @endphp
    @if($gtm_id)
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','{{ $gtm_id }}');</script>
    @endif
    <!-- End Google Tag Manager -->
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <!-- Initialize theme immediately to prevent flash -->
    <script>
        // Apply theme immediately on page load
        (function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
        })();
    </script>

    <!-- Google Tag Manager (noscript) -->
    @if($gtm_id ?? App\Models\Setting::get('google_tag_manager_id'))
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id={{ $gtm_id ?? App\Models\Setting::get('google_tag_manager_id') }}"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    @endif
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
            <!-- Dark Mode Toggle -->
            <li class="nav-item d-flex align-items-center mr-3">
                <label class="theme-toggle mb-0">
                    <input type="checkbox" id="darkModeToggle">
                    <span class="theme-toggle-slider">
                        <i class="fas fa-sun theme-toggle-icon theme-toggle-icon-sun"></i>
                        <i class="fas fa-moon theme-toggle-icon theme-toggle-icon-moon"></i>
                    </span>
                </label>
            </li>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    
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

            // Dark Mode Toggle
            const darkModeToggle = document.getElementById('darkModeToggle');
            const htmlElement = document.documentElement;

            if (darkModeToggle) {
                // Check for saved theme preference or default to light mode
                const currentTheme = localStorage.getItem('theme') || 'light';

                // Apply saved theme on page load
                if (currentTheme === 'dark') {
                    htmlElement.setAttribute('data-theme', 'dark');
                    darkModeToggle.checked = true;
                    console.log('Dark mode enabled from localStorage');
                } else {
                    htmlElement.setAttribute('data-theme', 'light');
                    console.log('Light mode active');
                }

                // Theme toggle functionality
                darkModeToggle.addEventListener('change', function() {
                    if (this.checked) {
                        htmlElement.setAttribute('data-theme', 'dark');
                        localStorage.setItem('theme', 'dark');
                        console.log('Switched to dark mode');
                    } else {
                        htmlElement.setAttribute('data-theme', 'light');
                        localStorage.setItem('theme', 'light');
                        console.log('Switched to light mode');
                    }
                });

                // Add smooth transitions after page load
                setTimeout(function() {
                    document.body.style.transition = 'background-color 0.3s ease, color 0.3s ease';
                    $('*').css('transition', 'background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease');
                }, 100);
            } else {
                console.error('Dark mode toggle not found!');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>