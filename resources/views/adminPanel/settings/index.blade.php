@extends('adminPanel.layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Settings</li>
    </ol>

    <div class="container-fluid">
        <div class="animated fadeIn">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon-header">
                                <i class="fas fa-cog"></i>
                                <span>Site Settings</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('adminPanel.settings.update') }}">
                                @csrf
                                @method('PUT')

                                <!-- Tabs Navigation -->
                                <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab">
                                            <i class="fas fa-globe mr-2"></i>General
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="integrations-tab" data-toggle="tab" href="#integrations" role="tab">
                                            <i class="fas fa-plug mr-2"></i>Integrations
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab">
                                            <i class="fas fa-search mr-2"></i>SEO
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="social-tab" data-toggle="tab" href="#social" role="tab">
                                            <i class="fas fa-share-alt mr-2"></i>Social Media
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="booking-tab" data-toggle="tab" href="#booking" role="tab">
                                            <i class="fas fa-calendar-check mr-2"></i>Booking
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tabs Content -->
                                <div class="tab-content" id="settingsTabsContent">
                                    <!-- General Settings -->
                                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                                        <div class="row mt-4">
                                            @if($settings->has('general'))
                                                @foreach($settings['general'] as $setting)
                                                    <div class="col-md-6">
                                                        @include('adminPanel.settings.partials.field', ['setting' => $setting])
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-12">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle mr-2"></i>
                                                        No general settings configured yet.
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Integrations Settings -->
                                    <div class="tab-pane fade" id="integrations" role="tabpanel">
                                        <div class="row mt-4">
                                            @if($settings->has('integrations'))
                                                @foreach($settings['integrations'] as $setting)
                                                    <div class="col-md-6">
                                                        @include('adminPanel.settings.partials.field', ['setting' => $setting])
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-12">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle mr-2"></i>
                                                        No integration settings configured yet.
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- SEO Settings -->
                                    <div class="tab-pane fade" id="seo" role="tabpanel">
                                        <div class="row mt-4">
                                            @if($settings->has('seo'))
                                                @foreach($settings['seo'] as $setting)
                                                    <div class="col-md-6">
                                                        @include('adminPanel.settings.partials.field', ['setting' => $setting])
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-12">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle mr-2"></i>
                                                        No SEO settings configured yet.
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Social Media Settings -->
                                    <div class="tab-pane fade" id="social" role="tabpanel">
                                        <div class="row mt-4">
                                            @if($settings->has('social'))
                                                @foreach($settings['social'] as $setting)
                                                    <div class="col-md-6">
                                                        @include('adminPanel.settings.partials.field', ['setting' => $setting])
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-12">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle mr-2"></i>
                                                        No social media settings configured yet.
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Booking Settings -->
                                    <div class="tab-pane fade" id="booking" role="tabpanel">
                                        <div class="row mt-4">
                                            @if($settings->has('booking'))
                                                @foreach($settings['booking'] as $setting)
                                                    <div class="col-md-6">
                                                        @include('adminPanel.settings.partials.field', ['setting' => $setting])
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-12">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle mr-2"></i>
                                                        No booking settings configured yet.
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Save Button -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-save mr-2"></i>Save Settings
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Remember active tab
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            localStorage.setItem('activeSettingsTab', $(e.target).attr('href'));
        });

        // Restore active tab
        var activeTab = localStorage.getItem('activeSettingsTab');
        if (activeTab) {
            $('#settingsTabs a[href="' + activeTab + '"]').tab('show');
        }
    });
</script>
@endpush
