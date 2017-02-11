/**
 * Created by mockie on 01/02/17.
 */


$('.delete-article').submit(function () {
    var result = confirm("Are you sure you want to delete this article ?");
    if (!result) {
        return false;
    }
});