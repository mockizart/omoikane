@extends('themes.'.config('omoikane.admin_layout').'.admin.two-column-left')

@section('content')

    <h1 id="post-title">{{ $tag->title }}</h1>

    <div id="post-info">
        <span id="post-info-posted"><strong>Posted:</strong> {{ $tag->created_at }}</span>
        <span id="post-info-updated"><strong>Last updated:</strong> {{ $tag->updated_at }}</span>
        <span id="post-info-author"><strong>Author:</strong> {{ $tag->user->name }}</span>
    </div>

    <div id="post-body">
        <p>
            {!! $tag->body !!}
        </p>
    </div>

    <div id="tag-articles">

        @foreach($articles as $article)

            <div class="tag-articles">
                <a href="{{ route('frontendViewArticle', $article->slug) }}" class="post-title-link">
                    <h4 class="post-title">
                        {{ $article->title }}
                    </h4>
                </a>
                <div id="post-info">
                    <span id="post-info-posted"><strong>Posted:</strong> {{ $article->created_at }}</span>
                    <span id="post-info-updated"><strong>Last updated:</strong> {{ $article->updated_at }}</span>
                    <span id="post-info-author"><strong>Author:</strong> {{ $article->user->name }}</span>
                </div>
            </div>

            <div class="post-body-headline">
                {{ str_limit(strip_tags($article->body), 200) }}
            </div>

        @endforeach

        {{ $articles->links() }}

    </div>

    @endsection