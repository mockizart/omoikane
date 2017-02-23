@extends('themes.'.config('omoikane.admin_layout').'.admin.two-column-left')

@section('content')

    <h3>Create menu group</h3>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('saveMenuGroup') }}" method="post" >
        {{ csrf_field() }}

        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input name="name"  class="form-control" id="exampleInputEmail1" placeholder="Name">
        </div>

        <div id="group-members" style="margin: 40px 0 40px 0">
            <p><h5>Menu members</h5></p>

            <div class="form-inline">

                <div class="form-group">
                    <input type="text" class="form-control" id="menu-title" placeholder="Title menu (for example: home)">
                </div>

                <div class="form-group">
                    <select class="form-control class-form-menu" id="menu-select-type">
                        <option value="0">Custom Url</option>
                        <option value="1">Route</option>
                        <option value="2">Page</option>
                        <option value="3">Category</option>
                        <option value="4">Tag</option>
                        <option value="5">Article</option>
                    </select>
                </div>

                <div class="form-group">

                    <div id="route-type" class="member-type">
                        {{--<label for="exampleInputName2">Route Name</label>--}}
                        <input type="text" class="form-control menu-text-target" id="menu-text-target"
                               placeholder="">
                    </div>

                </div>

                <div class="form-group">
                    <select class="form-control class-form-menu" id="menu-select-parent">
                        <option value="parent">Parent menu</option>
                    </select>
                </div>
                <div class="form-group" id="add-menu-button">
                    <button type="button" id="add-menu-member" class="btn btn-primary">Add</button>
                </div>
                <div class="form-group" id="edit-menu-button" style="display: none">
                    <button type="button" id="edit-menu-member" data-edit-id="" class="btn btn-info">Save</button>
                    <button type="button" class="btn btn-default">Cancel</button>
                </div>
            </div>

            {{--empty ul for tree--}}
            <ul class="clt tree-menu-member" id="tree-menu-member" data-array-key-parent=""></ul>


        </div>

        <button type="submit" class="btn btn-default">Submit</button>

    </form>

@endsection


@section('footer-js')
    <script type="text/javascript" src="{{ URL::asset('omoikane/typeahead.js/bloodhound.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('omoikane/typeahead.js/typeahead.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('default/js/menu-group-menu-member.js') }}"></script>
@endsection