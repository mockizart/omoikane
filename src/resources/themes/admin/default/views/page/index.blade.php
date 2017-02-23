@extends('themes.admin.'.config('omoikane.admin_theme').'.layouts.two-column-left')

@section('content')

    <h3> Manage Page </h3>

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
            <th><a href="{{ route('indexPage') }}?orderBy=id&order={{ $orderLink }}">ID</a></th>
            <th><a href="{{ route('indexPage') }}?orderBy=name&order={{ $orderLink }}">Author</a></th>
            <th><a href="{{ route('indexPage') }}?orderBy=title&order={{ $orderLink }}">Title</a></th>
            <th><a href="{{ route('indexPage') }}?orderBy=slug&order={{ $orderLink }}">Slug</a></th>
            <th><a href="{{ route('indexPage') }}?orderBy=view&order={{ $orderLink }}">View</a></th>
            <th><a href="{{ route('indexPage') }}?orderBy=view&order={{ $orderLink }}">Status</a></th>
            <th><a href="{{ route('indexPage') }}?orderBy=view&order={{ $orderLink }}">Order</a></th>
            <th>&nbsp;</th>
        </thead>
        <tbody>

        @php($no = 1)
        @foreach($pages as $page)

            <tr>
                <td>{{ $no }}</td>
                <td>{{ $page->id }}</td>
                <td>{{ $page->user->name }}</td>
                <td>{{ $page->title }}</td>
                <td>{{ $page->slug }}</td>
                <td>{{ $page->view }}</td>
                <td>{{ $page->status }}</td>
                <td>{{ $page->order }}</td>
                <td>
                    <form method="post" class="delete-page" action="{{ route('deletePage', $page->id) }}" class="form-inline">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-xs btn-primary">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                        <a href="{{ route('editPage', $page->id) }}" class="glyphicon glyphicon-edit" aria-hidden="true"></a>
                    </form>
                </td>
            </tr>

        @php( $no++ )
        @endforeach

        </tbody>
    </table>

    {{ $pages->links() }}


@endsection

@section('footer-js')
    <script type="text/javascript" src="{{ URL::to('themes/admin/'.config('omoikane.admin_theme').'/js/page.js') }}"></script>
    @endsection