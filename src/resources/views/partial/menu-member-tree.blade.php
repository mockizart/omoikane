
<?php if (in_array('checkbox', $options)): ?>
<input type="checkbox" name="category[]" value="{{ $menuMember->id }}"
<?php echo (in_array($menuMember->id, $selected)) ? ' CHECKED' : ''; ?> />
<?php endif ?>

<?php if (in_array('delete', $options)): ?>
<a href="#"  data-menu-id="menu-members<?php echo $menuMember->dataArrayKey ?>" class="glyphicon glyphicon-remove remove-menu-member" aria-hidden="true"></a>
<?php endif ?>


<?php if (in_array('edit', $options)): ?>
<a href="#"  data-menu-id="menu-members<?php echo $menuMember->dataArrayKey ?>" class="glyphicon glyphicon-edit edit-menu-member" aria-hidden="true"></a>
<?php endif ?>