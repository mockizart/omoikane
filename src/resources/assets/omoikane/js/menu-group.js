/**
 * Created by mockie on 10/02/17.
 */

$('.delete-menu-group').submit(function () {
    var result = confirm("Are you sure you want to delete this menu group and all menu members ?");
    if (!result) {
        return false;
    }
});
