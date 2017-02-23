
@include('themes.'.config('omoikane.admin_layout').'.admin.header')

<div class="container">

    <div class="row">

        <div class="col-md-2">
            @include('themes.'.config('omoikane.admin_layout').'.admin.sidebar')
        </div>

        <div class="col-md-10"> @yield('content') </div>

    </div>

</div>

@include('themes.'.config('omoikane.admin_layout').'.admin.footer')
