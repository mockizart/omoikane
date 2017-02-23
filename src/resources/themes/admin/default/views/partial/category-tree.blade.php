
<?php if (in_array('checkbox', $options)): ?>
<input type="checkbox" name="category[]" value="{{ $category->id }}"
<?php echo (in_array($category->id, $selected)) ? ' CHECKED' : ''; ?> />
<?php endif ?>

<?php if (in_array('delete', $options)): ?>

<form method="post" class="delete-category" action="{{ route('deleteCategory', $category->id) }}" class="form-inline">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="delete">

    <button type="submit" class="btn btn-xs btn-primary">
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
    </button>

</form>

<?php endif ?>


<?php if (in_array('edit', $options)): ?>
<a href="{{ route('editCategory', $category->id) }}" class="glyphicon glyphicon-edit" aria-hidden="true"></a>
<?php endif ?>