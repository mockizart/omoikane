@extends('two-column-left')

@section('content')

    <h3> Manage MenuGroup </h3>

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
            <th><a href="{{ route('indexMenuGroup') }}?orderBy=id&order={{ $orderLink }}">ID</a></th>
            <th><a href="{{ route('indexMenuGroup') }}?orderBy=title&order={{ $orderLink }}">Name</a></th>
            <th><a href="{{ route('indexMenuGroup') }}?orderBy=slug&order={{ $orderLink }}">Menu Members</a></th>
            <th>&nbsp;</th>
        </thead>
        <tbody>

        @php($no = 1)
        @foreach($menuGroups as $menuGroup)

            <tr>
                <td>{{ $no }}</td>
                <td>{{ $menuGroup->id }}</td>
                <td>{{ $menuGroup->name }}</td>
                <td>
                    <?php $limit=5; $a=0; ?>
                    @foreach($menuGroup->menuMember as $menu)
                        {{ $menu->name }},
                        <?php
                            if ($a==$limit) {
                                break;
                            }
                            $a++;
                        ?>
                        @endforeach
                </td>
                <td>
                    <form method="post" class="delete-menu-group" action="{{ route('deleteMenuGroup', $menuGroup->id) }}" class="form-inline">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-xs btn-primary">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                        <a href="{{ route('editMenuGroup', $menuGroup->id) }}" class="glyphicon glyphicon-edit" aria-hidden="true"></a>
                    </form>
                </td>
            </tr>

        @php( $no++ )
        @endforeach

        </tbody>
    </table>

    {{ $menuGroups->links() }}


@endsection

@section('footer-js')
    <script type="text/javascript" src="{{ URL::to('omoikane/js/menu-group.js') }}"></script>
    @endsection