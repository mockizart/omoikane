@extends('themes.admin.'.config('omoikane.admin_theme').'.layouts.two-column-left')

@section('header-assets')
    <script type="text/javascript" src="{{ URL::to('themes/admin/'.config('omoikane.admin_theme').'/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')

    <h3>Edit Tag</h3>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('updateTag', $tag->id) }}" method="post" >
        {{ csrf_field() }}

        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input name="title" value="{{ $tag->title }}" class="form-control" id="exampleInputEmail1" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">slug</label>
            <input name="slug"  value="{{ $tag->slug }}" class="form-control" id="exampleInputEmail1" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Keyword</label>
            <input name="keyword"  value="{{ $tag->meta_keyword }}" class="form-control" id="exampleInputEmail1" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">body</label> <br />
            <textarea name="body" cols="100" rows="7"> {{ $tag->body }}</textarea>
            <script>
                CKEDITOR.replace( 'body' );
            </script>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Description</label> <br />
            <textarea name="description" cols="100" rows="5">{{ $tag->meta_description }}</textarea>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

@endsection