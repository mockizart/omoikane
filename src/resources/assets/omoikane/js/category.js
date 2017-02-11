/**
 * Created by mockie on 01/02/17.
 */


$('.delete-category').submit(function () {
    var result = confirm("Are you sure you want to delete this category and all descendants ?");
    if (!result) {
        return false;
    }
});