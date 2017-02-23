@extends('themes.'.config('omoikane.admin_layout').'.admin.two-column-left')

@section('content')

    <h3> Manage Article </h3>

    <form class="form-inline">
        <div class="form-group">
            <label class="sr-only" for="exampleInputEmail3">Keyword</label>
            <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Keyword" name="q">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>


    <table class="table table-striped">
        <thead>
            <th>No</th>
            <th><a href="{{ route('indexArticle') }}?orderBy=name&order={{ $orderLink }}">ID</a></th>
            <th><a href="{{ route('indexArticle') }}?orderBy=name&order={{ $orderLink }}">Author</a></th>
            <th><a href="{{ route('indexArticle') }}?orderBy=title&order={{ $orderLink }}">Title</a></th>
            <th><a href="{{ route('indexArticle') }}?orderBy=slug&order={{ $orderLink }}">Slug</a></th>
            <th><a href="{{ route('indexArticle') }}?orderBy=view&order={{ $orderLink }}">View</a></th>
            <th>&nbsp;</th>
        </thead>
        <tbody>
        @php($no = 1)

        @foreach($articles as $article)

            <tr>
                <td>{{ $no }}</td>
                <td>{{ $article->id }}</td>
                <td>{{ $article->user->name }}</td>
                <td>{{ $article->title }}</td>
                <td>{{ $article->slug }}</td>
                <td>{{ $article->view }}</td>
                <td>
                    <form method="post" class="delete-article" action="{{ route('deleteArticle', $article->id) }}" class="form-inline">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-xs btn-primary">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                        <a href="{{ route('editArticle', $article->id) }}" class="glyphicon glyphicon-edit" aria-hidden="true"></a>
                    </form>
                </td>
            </tr>

        @php( $no++ )
        @endforeach

        </tbody>
    </table>

    {{ $articles->links() }}


@endsection

@section('footer-js')
    <script type="text/javascript" src="{{ URL::to('default/js/article.js') }}"></script>
    @endsection