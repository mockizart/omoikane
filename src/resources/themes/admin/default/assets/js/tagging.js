/**
 * Created by mockie on 06/02/17.
 */

function checkedTag() {
    $('.checked-tag').change(function () {
        $(this).parent().hide(200, function () {
            $(this).remove();
        });
    });
}

jQuery.noConflict();
jQuery(document).ready(function ($) {

    checkedTag();

    theTypeahead = $(".typeahead");
    secretTag = $("#secret-tags-list");

    // Set the Options for "Bloodhound" suggestion engine
    var engine = new Bloodhound({
        remote: {
            url: '/blog/admin/tag/autocomplete?keyword=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('title'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    theTypeahead.typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        source: engine.ttAdapter(),

        // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
        name: 'usersList',

        // the key from the array we want to display (name,id,email,etc...)
        templates: {
            empty: [
                '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
            ],
            suggestion: function (data) {
                return '<div class="list-group-item">' + data.title + '- @' + data.title + '</div>'
            }
        }
    });

    theTypeahead.bind('typeahead:select', function (ev, suggestion) {


        if ($('#'+suggestion.id+'tag').length==0) {

            secretTag.html(secretTag.html() +
                '<span class="tag tag-primary">' +
                '<input type="checkbox" name="tag[]" id="'+suggestion.id+'tag" class="checked-tag" value="' + suggestion.id + '" CHECKED/> '
                + suggestion.title
                + '</span>'
            );

        }

        theTypeahead.typeahead('val', '');
    });

    var target = document.getElementById("secret-tags-list");
    var config = {
        childList: true,
        subtree: true,
        attributes: true,
        characterData: true
    };
//note this observe method
    observer.observe(target, config);
    console.log("registered");

});

    var observer = new MutationObserver(function (mutationRecords, observer) {
        mutationRecords.forEach(function (mutation) {

           console.log("mutation change in ", mutation.type, " name: ",mutation.target);
            checkedTag();

        });
    });
