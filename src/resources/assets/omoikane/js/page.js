/**
 * Created by mockie on 01/02/17.
 */


$('.delete-page').submit(function () {
    var result = confirm("Are you sure you want to delete this page ?");
    if (!result) {
        return false;
    }
});