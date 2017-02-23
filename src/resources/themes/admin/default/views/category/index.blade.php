@extends('themes.admin.'.config('omoikane.admin_theme').'.layouts.two-column-left')


@section('header-assets')
    <link href="{{ URL::to('themes/admin/'.config('omoikane.admin_theme').'/css/category-tree.css') }}" rel="stylesheet">
@endsection

@section('content')

    <h3>Create new category</h3>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

   <ul class="clt">
       @foreach($data['categories'] as $val)
           {!! $val !!}
           @endforeach
   </ul>

@endsection


@section('footer-js')
    <script type="text/javascript" src="{{ URL::to('themes/admin/'.config('omoikane.admin_theme').'/js/category.js') }}"></script>
@endsection