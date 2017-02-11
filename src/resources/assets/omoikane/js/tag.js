/**
 * Created by mockie on 01/02/17.
 */


$('.delete-tag').submit(function () {
    var result = confirm("Are you sure you want to delete this tag ?");
    if (!result) {
        return false;
    }
});