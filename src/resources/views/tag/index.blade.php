@extends('two-column-left')

@section('content')

    <h3> Manage Tag </h3>

    <form class="form-inline">
        <div class="form-group">
            <label class="sr-only" for="exampleInputEmail3">Keyword</label>
            <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Keyword" name="q">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
    </form>

    <table class="table table-striped">
        <thead>
            <th>No</th>
            <th><a href="{{ route('indexTag') }}?orderBy=id&order={{ $orderLink }}">ID</a></th>
            <th><a href="{{ route('indexTag') }}?orderBy=name&order={{ $orderLink }}">Author</a></th>
            <th><a href="{{ route('indexTag') }}?orderBy=title&order={{ $orderLink }}">Title</a></th>
            <th><a href="{{ route('indexTag') }}?orderBy=slug&order={{ $orderLink }}">Slug</a></th>
            <th><a href="{{ route('indexTag') }}?orderBy=view&order={{ $orderLink }}">View</a></th>
            <th>&nbsp;</th>
        </thead>
        <tbody>
        @foreach($tags as $tag)
        @php($no = 1)

            <tr>
                <td>{{ $no }}</td>
                <td>{{ $tag->id }}</td>
                <td>{{ $tag->user->name }}</td>
                <td>{{ $tag->title }}</td>
                <td>{{ $tag->slug }}</td>
                <td>{{ $tag->view }}</td>
                <td>
                    <form method="post" class="delete-tag" action="{{ route('deleteTag', $tag->id) }}" class="form-inline">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-xs btn-primary">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                        <a href="{{ route('editTag', $tag->id) }}" class="glyphicon glyphicon-edit" aria-hidden="true"></a>
                    </form>
                </td>
            </tr>

        @php( $no++ )
        @endforeach

        </tbody>
    </table>

    {{ $tags->links() }}


@endsection

@section('footer-js')
    <script type="text/javascript" src="{{ URL::to('omoikane/js/tag.js') }}"></script>
    @endsection