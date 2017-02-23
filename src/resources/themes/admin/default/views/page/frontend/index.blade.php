@extends('themes.admin.'.config('omoikane.admin_theme').'.layouts.two-column-left')

@section('content')

    <h1>{{ $page->title }}</h1>
    <div id="post-info">
        <span><strong>Posted:</strong> {{ $page->created_at }}</span>
        <span><strong>Last updated:</strong> {{ $page->updated_at }}</span>
        <span><strong>Author:</strong> {{ $page->user->name }}</span>
    </div>

    <div id="post-body">
        <p>
            {!! $page->body !!}
        </p>
    </div>

    @endsection