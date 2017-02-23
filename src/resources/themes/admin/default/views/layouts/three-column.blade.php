
@include('themes.admin.'.config('omoikane.admin_theme').'.layouts.header')

<div class="container">

    <div class="row">

        <div class="col-md-2">@include('themes.admin.'.config('omoikane.admin_theme').'.layouts.sidebar')</div>
        <div class="col-md-7"> @yield('content') </div>
        <div class="col-md-3"> @yield('right-sidebar') </div>

    </div>

</div>

@include('themes.admin.'.config('omoikane.admin_theme').'.layouts.footer')
