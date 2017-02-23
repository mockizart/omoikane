
@include('themes.admin.'.config('omoikane.admin_theme').'.layouts.header')

<div class="container">

    <div class="row">

        <div class="col-md-2">
            @include('themes.admin.'.config('omoikane.admin_theme').'.layouts.sidebar')
        </div>

        <div class="col-md-10"> @yield('content') </div>

    </div>

</div>

@include('themes.admin.'.config('omoikane.admin_theme').'.layouts.footer')
