jQuery(function($) {

    var _oldShow = $.fn.hide;

    $.fn.hide = function(speed, oldCallback) {
        return $(this).each(function() {
            var obj         = $(this),
                newCallback = function() {
                    if ($.isFunction(oldCallback)) {
                        oldCallback.apply(obj);
                    }
                    obj.trigger('afterShow');
                };

            // you can trigger a before show if you want
            obj.trigger('beforeShow');

            // now use the old function to show the element passing the new callback
            _oldShow.apply(obj, [speed, newCallback]);
        });
    }
});
$(document).ready(function() {

    var GLOBAL_URL = $("#base_url").val();
    $("#fileupload").fileupload({
        disableImageResize: 1,
        autoUpload: 1,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
    }), $("#fileupload").fileupload("option", "redirect",
        window.location.href.replace(/\/[^\/]*$/,
            "/cors/result.html?%s")), $.support.cors && $.ajax({
        type: "HEAD"
    }).fail(function () {
        $('<div class="alert alert-danger"/>').text(
            "Upload server currently unavailable - " +
            new Date).appendTo("#fileupload")
    }), $("#fileupload").addClass("fileupload-processing")
    $('#right-panel-link').click(function () {
        if ($("body").hasClass('ps-active-right')) {
            $("body").removeClass('ps-active-right');
        } else {
            $("body").addClass('ps-active-right');
        }
    });

    $('#close-panel-bt').click(function () {
        $("body").removeClass('ps-active-right');
    });

    var a = new Bloodhound({
        datumTokenizer: function (e) {
            return e.tokens
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: GLOBAL_URL + "mailling/autocomplete/%QUERY/"
    });
    a.initialize();


    $("#user_autocomplete").typeahead(null, {
        onselect: function (selection) {
            console.log("You selected: " + selection)
        },
        name: "datypeahead_example_3",
        displayKey: "value",
        source: a.ttAdapter(),
        hint: 1,
        templates: {
            suggestion: Handlebars.compile([
                '<div class="media">',
                '<div class="pull-left">',
                '<div class="media-object">',
                '<img src="{{img}}" width="50" height="50"/>',
                "</div>", "</div>",
                '<div class="media-body">',
                '<h4 class="media-heading">{{value}}</h4>',
                "<p>{{desc}}</p>", "</div>",
                "</div>"
            ].join(""))
        }
    });

    $('#user_autocomplete').bind('typeahead:selected', function (obj, datum, name) {
        $("input[name='user_id']").val(datum.user_id);
    });

    function clearForm(){
        $("#sendMail").find("input, textarea").val("");
        $("#fileupload").find("input, textarea").val("");
        document.getElementById('fileupload').reset();
        document.getElementById('sendMail').reset();
        $("tbody.files").html('');

    }
    $("#form_send").click(function(){
         clearForm();
        toastr["success"]("Wiadomośc została wysłana poprawnie. Kopia wiadomości została przesłana na twoją skrzynkę.");
        $("body").removeClass('ps-active-right');
    });
});