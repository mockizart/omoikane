/**
 * Created by mockie on 10/02/17.
 */

buttonRemoveMenuMember = jQuery('.remove-menu-member');

    function buttonPressed() {

        buttonEditMenuMember = jQuery('.edit-menu-member');
        console.log(jQuery(this).parent().attr('id'));

        buttonRemoveMenuMember.click(function (e) {
            e.preventDefault();
            jQuery("#menu-select-parent option[value='"+jQuery(this).parent().attr('id')+"']").each(function() {
                $(this).remove();
            });

            jQuery(this).parent().remove();
        });

        buttonEditMenuMember.click(function (e) {
            e.preventDefault();
            menuId = jQuery(this).attr('data-menu-id');
            idForUpdateSelect = jQuery(this).parent('li').attr('id');

            title = jQuery('input[name="' + menuId + '[title]"]');
            targetMenu = jQuery('input[name="' + menuId + '[target]"]');
            menuType = jQuery('input[name="' + menuId + '[type]"]');

            jQuery('#add-menu-button').hide(200);
            jQuery('#edit-menu-button').show(200);

            jQuery('#edit-menu-member').attr('data-edit-id', menuId);
            jQuery('#edit-menu-member').attr('data-id-for-update-select', idForUpdateSelect); // used to update the menu text in select

            jQuery('#menu-title').val(title.val());
            jQuery('#menu-text-target').val(targetMenu.val());
            jQuery('#menu-select-type').val(menuType.val());
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

function targetAutoComplete() {

    menuTextTarget      = jQuery('#menu-text-target');

    // Set the Options for "Bloodhound" suggestion engine
    var engine = new Bloodhound({
        remote: {
            url: '/blog/admin/tag/autocomplete?keyword=%QUERY%',
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
            header: [
                '<div class="list-group search-results-dropdown">'
            ],
            suggestion: function (data) {
                return '<div class="list-group-item">' + data.title + '- @' + data.title + '</div>'
            }
        }
    });

    mockMenuSelectType  = jQuery('#menu-select-type');
    menuTextTarget.bind('typeahead:select', function (ev, suggestion) {

        if (mockMenuSelectType.val()==1) {
            typeaheadValue = 'route(' + suggestion.id + ')';
        } else if(mockMenuSelectType==2) {
            typeaheadValue = 'page(' + suggestion.id + ')';
        } else if(mockMenuSelectType==3) {
            typeaheadValue = 'category(' + suggestion.id + ')';
        } else if(mockMenuSelectType==4) {
            typeaheadValue = 'tag(' + suggestion.id + ')';
        } else if(mockMenuSelectType==5) {
            typeaheadValue = 'article(' + suggestion.id + ')';
        }
        //
        // if ($('#'+suggestion.id+'tag').length==0) {
        //
        //     secretTag.html(secretTag.html() +
        //         '<span class="tag tag-primary">' +
        //         '<input type="checkbox" name="tag[]" id="'+suggestion.id+'tag" class="checked-tag" value="' + suggestion.id + '" CHECKED/> '
        //         + suggestion.title
        //         + '</span>'
        //     );
        //
        // }

        menuTextTarget.typeahead('val', typeaheadValue);
    });

}

jQuery(document).ready(function () {

    buttonPressed();

    buttonAddMenuMember = jQuery('#add-menu-member');
    buttonSaveMenuMember = jQuery('#edit-menu-member');

    mockMenuTitle       = jQuery('#menu-title');
    mockMenuSelectType  = jQuery('#menu-select-type');
    mockMenuParent      = jQuery('#menu-select-parent');
    menuTextTarget      = jQuery('#menu-text-target');

    mockMenuSelectType.change(function () {
        $typeToText = ['Http://example.com', 'Route name', 'Page', 'Category', 'Tag', 'Article'];
        menuTextTarget.val('');
        menuTextTarget.attr('placeholder', $typeToText[jQuery(this).val()]);
        targetAutoComplete();
    });
    
    buttonSaveMenuMember.click(function (e) {
        e.preventDefault();
        dataEditId = jQuery(this).attr('data-edit-id');
        idForUpdateSelect = jQuery(this).attr('data-id-for-update-select');
        jQuery('input[name="' + dataEditId + '[title]"]').val(mockMenuTitle.val());
        jQuery('input[name="' + dataEditId + '[target]"]').val(menuTextTarget.val());
        jQuery('input[name="' + dataEditId + '[type]"]').val(mockMenuSelectType.find(":selected").val());
        jQuery('span[data-id="' + dataEditId+'"]').text(mockMenuTitle.val());
        jQuery('#menu-select-parent').find('option[value="' + idForUpdateSelect +'"]').text(mockMenuTitle.val());
        console.log(idForUpdateSelect);

        jQuery('#add-menu-button').show(200);
        jQuery('#edit-menu-button').hide(200);
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

            '<span data-id="menu-members'+ dataArrayKey +'">' + mockMenuTitle.val() + '</span>' +

            '<input type="hidden" name="menu-members' + dataArrayKey +'[title]" ' +
            'value="' + mockMenuTitle.val() +'" />'+

            '<input type="hidden" name="menu-members' + dataArrayKey +'[target]" ' +
            'value="' + menuTextTarget.val() +'" />'+

            '<input type="hidden" name="menu-members' + dataArrayKey +'[type]" ' +
            'value="' + mockMenuSelectType.find(":selected").val() +'" />'+

            '<ul></ul></li>'
        );

        mockMenuParent.append(
            '<option value="'+ totalAddedMembers.length +'">' + mockMenuTitle.val() + '</option>'
        );
    });

});