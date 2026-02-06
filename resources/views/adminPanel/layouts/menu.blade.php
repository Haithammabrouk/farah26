@can('admins view')
<li class="nav-item {{ Request::is('adminPanel/admins*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.admins.index') }}">
        <i class="nav-icon icon-user"></i>
        <span>@lang('models/admins.plural')</span>
    </a>
</li>
@endcan

@can('roles view')
<li class="nav-item {{ Request::is('adminPanel/roles*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.roles.index') }}">
        <i class="nav-icon icon-check "></i>
        <span>@lang('models/roles.plural')</span>
    </a>
</li>
@endcan

@can('metas view')
<li class="nav-item {{ Request::is('adminPanel/metas*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.metas.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/metas.plural')</span>
    </a>
</li>
@endcan

<li class="nav-item">
    <a class="nav-link" href="{{ route('adminPanel.coupon') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Coupons</span>
    </a>
</li>

@can('countries view')
<li class="nav-item {{ Request::is('adminPanel/countries*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.countries.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/countries.plural')</span>
    </a>
</li>
@endcan

@can('users view')
<li class="nav-item {{ Request::is('adminPanel/users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.users.index') }}">
        <i class="nav-icon icon-user"></i>
        <span>@lang('models/users.plural')</span>
    </a>
</li>
@endcan

@can('pages view')
<li class="nav-item {{ Request::is('adminPanel/pages*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.pages.index') }}">
        <i class="nav-icon icon-docs"></i>
        <span>@lang('models/pages.plural')</span>
    </a>
</li>
@endcan

@can('tripCategories view')
<li class="nav-item {{ Request::is('adminPanel/tripCategories*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.tripCategories.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/tripCategories.plural')</span>
    </a>
</li>
@endcan

@can('trips view')
<li class="nav-item {{ Request::is('adminPanel/trips*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.trips.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/trips.plural')</span>
    </a>
</li>
@endcan

@can('reservations view')
<li class="nav-item {{ Request::is('adminPanel/reservations*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.reservations.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/reservations.plural')</span>
    </a>
</li>
@endcan

@can('additionalTrips view')
<li class="nav-item {{ Request::is('adminPanel/additionalTrips*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.additionalTrips.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/additionalTrips.plural')</span>
    </a>
</li>
@endcan


@can('additionalTripsPhotos view')
<li class="nav-item {{ Request::is('adminPanel/additionalTripsPhotos*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.additionalTripsPhotos.index') }}" style="width: 300px;">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/additionalTripsPhotos.plural')</span>
    </a>
</li>
@endcan

@can('galleries view')
<li class="nav-item {{ Request::is('adminPanel/galleries*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.galleries.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/galleries.plural')</span>
    </a>
</li>
@endcan

@can('galleryPhotos view')
<li class="nav-item {{ Request::is('adminPanel/galleryPhotos*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.galleryPhotos.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/galleryPhotos.plural')</span>
    </a>
</li>
@endcan

@can('contactuses view')
<li class="nav-item {{ Request::is('adminPanel/contactuses*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.contactuses.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/contactuses.plural')</span>
    </a>
</li>
@endcan

@can('facilities view')
<li class="nav-item {{ Request::is('adminPanel/facilities*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.facilities.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/facilities.plural')</span>
    </a>
</li>
@endcan

{{-- @can('facilityPhotos view')
<li class="nav-item {{ Request::is('adminPanel/facilityPhotos*') ? 'active' : '' }}">
<a class="nav-link" href="{{ route('adminPanel.facilityPhotos.index') }}">
    <i class="nav-icon icon-cursor"></i>
    <span>@lang('models/facilityPhotos.plural')</span>
</a>
</li>
@endcan --}}

@can('infos view')
<li class="nav-item {{ Request::is('adminPanel/infos*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.infos.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/infos.plural')</span>
    </a>
</li>
@endcan

@can('itineraries view')
<li class="nav-item {{ Request::is('adminPanel/itineraries*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.itineraries.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/itineraries.plural')</span>
    </a>
</li>
@endcan

@can('itineraryDetails view')
<li class="nav-item {{ Request::is('adminPanel/itineraryDetails*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.itineraryDetails.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/itineraryDetails.plural')</span>
    </a>
</li>
@endcan

@can('newsletters view')
<li class="nav-item {{ Request::is('adminPanel/newsletters*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.newsletters.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/newsletters.plural')</span>
    </a>
</li>
@endcan

{{-- @can('reservedAdditionalTrips view')
<li class="nav-item {{ Request::is('adminPanel/reservedAdditionalTrips*') ? 'active' : '' }}">
<a class="nav-link" href="{{ route('adminPanel.reservedAdditionalTrips.index') }}">
    <i class="nav-icon icon-cursor"></i>
    <span>@lang('models/reservedAdditionalTrips.plural')</span>
</a>
</li>
@endcan --}}

@can('decks view')
<li class="nav-item {{ Request::is('adminPanel/decks*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.decks.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/decks.plural')</span>
    </a>
</li>
@endcan

@can('partners view')
<li class="nav-item {{ Request::is('adminPanel/partners*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.partners.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/partners.plural')</span>
    </a>
</li>
@endcan

@can('uniques view')
<li class="nav-item {{ Request::is('adminPanel/uniques*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.uniques.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/uniques.plural')</span>
    </a>
</li>
@endcan

@can('tripadvisors view')
<li class="nav-item {{ Request::is('adminPanel/tripadvisors*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.tripadvisors.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/tripadvisors.plural')</span>
    </a>
</li>
@endcan
@can('sliderPhotos view')
<li class="nav-item {{ Request::is('adminPanel/sliderPhotos*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.sliderPhotos.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/sliderPhotos.plural')</span>
    </a>
</li>
@endcan

@can('closedDates view')
<li class="nav-item {{ Request::is('adminPanel/closedDates*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('adminPanel.closedDates.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>@lang('models/closedDates.plural')</span>
    </a>
</li>
@endcan
