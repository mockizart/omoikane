@extends('themes.admin.'.config('omoikane.admin_theme').'.layouts.three-column')

@section('header-assets')
    <link href="{{ URL::to('themes/admin/'.config('omoikane.admin_theme').'/css/article.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ URL::to('themes/admin/'.config('omoikane.admin_theme').'/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')


    <form action="{{ route('saveArticle') }}" method="post" >
        {{ csrf_field() }}

        <h3>Create Article</h3>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input name="title"  class="form-control" id="exampleInputEmail1" placeholder="Article Title">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">slug</label>
            <input name="slug" class="form-control" id="exampleInputEmail1" placeholder="Slug (leave it blank to use title as slug)">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Keyword</label>
            <input name="keyword"  class="form-control" id="exampleInputEmail1" placeholder="Meta keyword (optional)">
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>Tags:</label> <br />
                <input type="text" style="width: 400px" class="typeahead form-control">
                <div id="secret-tags-list">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">body</label> <br />
            <textarea name="body" cols="100" rows="7"></textarea>
            <script>
                CKEDITOR.replace( 'body' );
            </script>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Description</label> <br />
            <textarea name="description" cols="100" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>

@endsection

@section('right-sidebar')

    <h4>Choose the category of the article</h4>
    <ul class="clt">
        @foreach( $categories as $category )
            {!! $category !!}
        @endforeach
    </ul>
    @endsection

    </form>


@section('footer-js')
    <script type="text/javascript" src="{{ URL::asset('themes/admin/'.config('omoikane.admin_theme').'/typeahead.js/bloodhound.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('themes/admin/'.config('omoikane.admin_theme').'/typeahead.js/typeahead.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('themes/admin/'.config('omoikane.admin_theme').'/js/tagging.js') }}"></script>
@endsection