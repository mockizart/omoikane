@extends('themes.'.config('omoikane.admin_layout').'.admin.two-column-left')

@section('header-assets')
    <script type="text/javascript" src="{{ URL::to('default/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')

    <h3>Edit page</h3>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('updatePage', $page->id) }}" method="post" >
        {{ csrf_field() }}

        <input type="hidden" name="_method" value="PUT">


        <div class="form-group">
            <label for="exampleInputEmail1">Status</label>
            <select name="status"  class="form-control">
                <option value="1" {{ ($page->status==1) ? 'SELECTED' : '' }}>Published</option>
                <option value="0" {{ ($page->status==0) ? 'SELECTED' : '' }}>Draft</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input name="title" value="{{ $page->title }}" class="form-control" id="exampleInputEmail1" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">slug</label>
            <input name="slug"  value="{{ $page->slug }}" class="form-control" id="exampleInputEmail1" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Keyword</label>
            <input name="keyword"  value="{{ $page->meta_keyword }}" class="form-control" id="exampleInputEmail1" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">body</label> <br />
            <textarea name="body" cols="100" rows="7"> {{ $page->body }}</textarea>
            <script>
                CKEDITOR.replace( 'body' );
            </script>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Description</label> <br />
            <textarea name="description" cols="100" rows="5">{{ $page->meta_description }}</textarea>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

@endsection