/**
 * Created by mockie on 11/02/17.
 */


function initializeMenuVariables() {
    buttonRemoveMenuMember      = jQuery('.remove-menu-member');
    buttonEditMenuMember        = jQuery('.edit-menu-member');
    addMenuButton               = jQuery('#add-menu-button');
    editMenuButton              = jQuery('#edit-menu-button');
    buttonSaveMenuMember        = jQuery('#edit-menu-member');
    mockMenuParent              = jQuery('#menu-select-parent');
    mockMenuTitle               = jQuery('#menu-title');
    menuTextTarget              = jQuery('#menu-text-target');
    mockMenuSelectType          = jQuery('#menu-select-type');
    buttonAddMenuMember         = jQuery('#add-menu-member');
}


function buttonPressed() {

    initializeMenuVariables();

    buttonRemoveMenuMember.click(function (e) {
        e.preventDefault();
        mockMenuParent.find("option[value='"+jQuery(this).parent().attr('id')+"']").remove();

        jQuery(this).parent().remove();
    });

    buttonEditMenuMember.click(function (e) {
        e.preventDefault();

        menuId = jQuery(this).attr('data-menu-id');
        idForUpdateSelect = jQuery(this).parent('li').attr('id');

        title = jQuery('input[name="' + menuId + '[title]"]');
        targetMenu = jQuery('input[name="' + menuId + '[target]"]');
        menuType = jQuery('input[name="' + menuId + '[type]"]');

        addMenuButton.hide(200);
        editMenuButton.show(200);

        buttonSaveMenuMember.attr('data-edit-id', menuId);
        buttonSaveMenuMember.attr('data-id-for-update-select', idForUpdateSelect); // used to update the menu text in select

        mockMenuTitle.val(title.val());
        menuTextTarget.val(targetMenu.val());
        mockMenuSelectType.val(menuType.val());
    })

}

var buttonObserver = new MutationObserver(function (mutationRecords, observer) {
    mutationRecords.forEach(function (mutation) {

        // console.log("mutation change in ", mutation.type, " name: ",mutation.target);
        buttonPressed();

    });
});

var target = document.getElementById("tree-menu-member");

var config = {
    childList: true,
    subtree: true,
    attributes: true,
    characterData: true
};

//note this observe method
buttonObserver.observe(target, config);

function targetAutoComplete(url, value) {

    // Set the Options for "Bloodhound" suggestion engine
    var engine = new Bloodhound({
        remote: {
            url: url,
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('title'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    menuTextTarget.typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        source: engine.ttAdapter(),

        // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
        name: 'menuList',

        // the key from the array we want to display (name,id,email,etc...)
        templates: {
            empty: [
                '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
            ],
            suggestion: function (data) {
                return '<div class="list-group-item">' + data.title + '</div>';
            }
        }
    });

    menuTextTarget.bind('typeahead:select', function (ev, suggestion) {
        theValue = value.replace(/{id}/g, suggestion.id);
        theValue = theValue.replace(/{title}/g, suggestion.title);
        menuTextTarget.typeahead('val', theValue);
    });


}

jQuery(document).ready(function () {

    buttonPressed();

    mockMenuSelectType.change(function () {
        menuTextTarget.typeahead('destroy');

        $typeToText = ['Http://example.com', 'Route name', 'Page', 'Category', 'Tag', 'Article'];
        menuTextTarget.val('');
        menuTextTarget.attr('placeholder', $typeToText[jQuery(this).val()]);

        if (jQuery(this).val()==0) {

            menuTextTarget.val('http://');

        } else if (jQuery(this).val()==1) {

            menuTextTarget.val('route()');

        } else if(jQuery(this).val()==2) {
            typeaheadValue = 'page({id}, {title})';
            targetURL = '/blog/admin/page/autocomplete?keyword=%QUERY%';

            targetAutoComplete(targetURL, typeaheadValue);

        } else if(jQuery(this).val()==3) {
            typeaheadValue = 'category({id}, {title})';
            targetURL = '/blog/admin/category/autocomplete?keyword=%QUERY%';

            targetAutoComplete(targetURL, typeaheadValue);

        } else if(jQuery(this).val()==4) {
            typeaheadValue = 'tag({id}, {title})';
            targetURL = '/blog/admin/tag/autocomplete?keyword=%QUERY%';

            targetAutoComplete(targetURL, typeaheadValue);

        } else if(jQuery(this).val()==5) {
            typeaheadValue = 'article({id}, {title})';
            targetURL = '/blog/admin/article/autocomplete?keyword=%QUERY%';

            targetAutoComplete(targetURL, typeaheadValue);

        }


    });

    buttonSaveMenuMember.click(function (e) {
        e.preventDefault();
        dataEditId = jQuery(this).attr('data-edit-id');
        idForUpdateSelect = jQuery(this).attr('data-id-for-update-select');
        jQuery('input[name="' + dataEditId + '[title]"]').val(mockMenuTitle.val());
        jQuery('input[name="' + dataEditId + '[target]"]').val(menuTextTarget.val());
        jQuery('input[name="' + dataEditId + '[type]"]').val(mockMenuSelectType.find(":selected").val());
        jQuery('span[data-id="' + dataEditId+'"]').text(mockMenuTitle.val() + ' - '+  menuTextTarget.val());
        mockMenuParent.find('option[value="' + idForUpdateSelect +'"]').text(mockMenuTitle.val());

        addMenuButton.show(200);
        editMenuButton.hide(200);
    });

    buttonAddMenuMember.click(function () {

        totalAddedMembers   = jQuery('ul.tree-menu-member').find('.the-members');

        parentElementMenu = (mockMenuParent.val()=='parent')
            ? '.tree-menu-member'
            : '#' + mockMenuParent.val() +' > ul';

        elementIndex = jQuery(parentElementMenu).children('li').length;
        dataArrayKeyParent = jQuery(parentElementMenu).parent('li').attr('data-array-key');

        if (dataArrayKeyParent==null || typeof dataArrayKeyParent == "undefined") {
            dataArrayKey = '['+ elementIndex+']';
        } else {
            dataArrayKey = dataArrayKeyParent + '[children]['+ elementIndex+']';
        }

        jQuery(parentElementMenu).append(
            '<li class="the-members" id="'+ totalAddedMembers.length + '"' +
            ' data-array-key="'+ dataArrayKey +'"'+
            '>'+

            '<a href="#" data-menu-id="menu-members' + dataArrayKey +'" ' +
            'class="glyphicon glyphicon-remove remove-menu-member" aria-hidden="true"></a> ' +

            '<a href="#" data-menu-id="menu-members' + dataArrayKey +'" ' +
            'class="glyphicon glyphicon-edit edit-menu-member" aria-hidden="true"></a> ' +

            '<span data-id="menu-members'+ dataArrayKey +'">' + mockMenuTitle.val() + ' - ' + menuTextTarget.val() +'</span>' +

            '<input type="hidden" name="menu-members' + dataArrayKey +'[title]" ' +
            'value="' + mockMenuTitle.val() +'" />'+

            '<input type="hidden" name="menu-members' + dataArrayKey +'[target]" ' +
            'value="' + menuTextTarget.val() +'" />'+

            '<input type="hidden" name="menu-members' + dataArrayKey +'[type]" ' +
            'value="' + mockMenuSelectType.find(":selected").val() +'" />'+

            '<ul></ul></li>'
        );

        mockMenuParent.append(
            '<option value="'+ totalAddedMembers.length +'">' +
            mockMenuTitle.val() + '</option>'
        );
    });

});