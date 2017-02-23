@extends('themes.'.config('omoikane.admin_layout').'.admin.two-column-left')

@section('header-assets')
    <script type="text/javascript" src="{{ URL::to('default/ckeditor/ckeditor.js') }}"></script>
@endsection


@section('content')

    <h3>Create new category</h3>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('updateCategory', $category->id) }}" method="post" >
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input name="title" value="{{ $category->title }}"  class="form-control" id="exampleInputEmail1" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Parent Category</label>
            <select name="parent_id" class="form-control">
                <option value="0">No Parent</option>
                @foreach( $categories as $cat )
                    <option value="{{ $cat->id }}" <?php echo ($category->parent_id==$cat->id) ? ' SELECTED' : ''; ?>>
                        <?php echo str_repeat(' &nbsp; ', $categories->getDepth()); ?>
                        {{ $cat->title }}
                    </option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">slug</label>
            <input name="slug" value="{{ $category->slug }}" class="form-control" id="exampleInputEmail1" placeholder="Slug">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Keyword</label>
            <input name="keyword" value="{{ $category->meta_keyword }}" class="form-control" id="exampleInputEmail1" placeholder="Keyword">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">body</label> <br />
            <textarea name="body" cols="100" rows="7">{{ $category->body }}</textarea>
            <script>
                CKEDITOR.replace( 'body' );
            </script>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Description</label> <br />
            <textarea name="description" cols="100" rows="5">{{ $category->meta_description }}</textarea>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

@endsection