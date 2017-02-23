
@include('themes.'.config('omoikane.admin_layout').'.admin.header')

<div class="container">

    <div class="row">

        <div class="col-md-2">@include('themes.'.config('omoikane.admin_layout').'.admin.sidebar')</div>
        <div class="col-md-7"> @yield('content') </div>
        <div class="col-md-3"> @yield('right-sidebar') </div>

    </div>

</div>

@include('themes.'.config('omoikane.admin_layout').'.admin.footer')
