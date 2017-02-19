@extends('two-column-left')

@section('content')


    <h4 class="most-viewed-tags-body">Most viewed tags</h4>

    <div class="most-viewed-tags-body">
       <ul>
           @foreach($mostViewed as $tag)
               <li>
                   <p>
                       <a href="{{route('frontendViewTag', $tag->slug)}}" class="btn btn-primary" type="button">
                           {{ $tag->title }} <span class="badge"> {{ $tag->view }}</span>
                       </a>
                       <div id="post-info">
                           <span id="post-info-posted"><strong>Posted:</strong> {{ $tag->created_at }}</span>
                           <span id="post-info-updated"><strong>Last updated:</strong> {{ $tag->updated_at }}</span>
                           <span id="post-info-author"><strong>Author:</strong> {{ $tag->user->name }}</span>
                       </div>
                   </p>
                   <p>
                       {{ str_limit(strip_tags($tag->body), 200) }}
                   </p>
               </li>
           @endforeach
       </ul>
    </div>

@endsection