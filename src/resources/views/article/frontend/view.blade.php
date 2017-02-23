@extends('themes.'.config('omoikane.admin_layout').'.admin.two-column-left')

@section('content')

    <h1 id="post-title">{{ $article->title }}</h1>

    <div id="post-info">
        <span id="post-info-posted"><strong>Posted:</strong> {{ $article->created_at }}</span>
        <span id="post-info-updated"><strong>Last updated:</strong> {{ $article->updated_at }}</span>
        <span id="post-info-author"><strong>Author:</strong> {{ $article->user->name }}</span>
    </div>

    <div id="post-body">
        <p>
            {!! $article->body !!}
        </p>
    </div>

    <div id="post-tags">
        <h5>Categories:</h5>
        @foreach($article->category as $category)
                <a href="{{ route('frontendViewCategory', $category->slug) }}" class="btn btn-primary" type="button">{{ $category->title }}</a>
            @endforeach
    </div>
    <div id="post-tags">
        <h5>Tags:</h5>
        @foreach($article->tag as $tag)
                <a href="{{ route('frontendViewTag', $tag->slug) }}" class="btn btn-primary" type="button">{{ $tag->title }}</a>
            @endforeach
    </div>

    @endsection