@extends('themes.'.config('omoikane.admin_layout').'.admin.two-column-left')

@section('header-assets')
    <script type="text/javascript" src="{{ URL::to('default/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')

    <h3>Create page</h3>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('savePage') }}" method="post" >
        {{ csrf_field() }}

        <div class="form-group">
            <label for="exampleInputEmail1">Status</label>
            <select name="status"  class="form-control">
                <option value="1">Published</option>
                <option value="0">Draft</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input name="title"  class="form-control" id="exampleInputEmail1" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">slug</label>
            <input name="slug" class="form-control" id="exampleInputEmail1" placeholder="Slug { leave it blank to use title as slug)">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Keyword</label>
            <input name="keyword"  class="form-control" id="exampleInputEmail1" placeholder="Keyword">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">body</label> <br />
            <textarea name="body" cols="100" rows="7"></textarea>
            <script>
                CKEDITOR.replace( 'body' );
            </script>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Description</label> <br />
            <textarea name="description" cols="100" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

@endsection