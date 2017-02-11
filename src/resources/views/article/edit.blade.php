@extends('three-column')


@section('header-assets')
    <link href="{{ URL::to('omoikane/css/article.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ URL::to('omoikane/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')

    <form action="{{ route('updateArticle', $article->id) }}" method="post" >
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put">

        <h3>Update Article</h3>

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
            <input name="title" value="{{ $article->title }}"  class="form-control" id="exampleInputEmail1" placeholder="Article Title">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">slug</label>
            <input name="slug" value="{{ $article->slug }}" class="form-control" id="exampleInputEmail1" placeholder="Slug (leave it blank to use title as slug)">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Keyword</label>
            <input name="keyword" value="{{ $article->keyword }}" class="form-control" id="exampleInputEmail1" placeholder="Meta keyword (optional)">
        </div>
        <div class="form-group">
            <div class="form-group">
                <label>Tags:</label> <br />
                <input type="text" style="width: 400px" class="typeahead form-control">
                <div id="secret-tags-list">
                    @foreach($article->tag as $tags)
                        @if($tags->tag)
                            <span class="tag tag-primary">
                            <input type="checkbox" name="tag[]" class="checked-tag"
                                   id="{{ $tags->tag->id }}tag"
                                   value="{{ $tags->tag->id }}" CHECKED/>
                            {{ (isset($tags->tag->title)) ? $tags->tag->title : '' }}
                            </span>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">body</label> <br />
            <textarea name="body" cols="100" rows="7">{{ $article->body }}</textarea>
            <script>
                CKEDITOR.replace( 'body' );
            </script>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Description</label> <br />
            <textarea name="description" cols="100" rows="5">{{ $article->description }}</textarea>
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
    <script type="text/javascript" src="{{ URL::asset('omoikane/typeahead.js/bloodhound.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('omoikane/typeahead.js/typeahead.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('omoikane/js/tagging.js') }}"></script>
@endsection
