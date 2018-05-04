var Settings = function () {
    var gb_setting_xhr = {}, container = $('#setting-content');
    var bindElement = function () {
        $(document).on('click', 'a[kp-setting]', function (e) {
            e.preventDefault();
            current_obj = this;
            $overlay_div.appendTo('#setting-content div.box');
            gb_setting_xhr = $.get($(this).attr('kp-setting-url'), function () {
                $overlay_div.remove();
            })
                    .done(function (ht) {
                        container.html(ht);
                        commonjs.reinit();
                        $overlay_div.remove();
                    })
                    .fail(function () {
                        $overlay_div.remove();
                        alert("error");
                    });
        })
        $(document).on('click', 'button[kp-action="save"]', function () {
            var $form = container.find('form');
            submit_form($form.attr('action'), $form.serialize(), 'div.box-body');
        });
        $(document).on('click', 'a[kp-action="remove"]', function () {
            $(this).closest('div.form-group').remove();
        });
        $(document).on('click', 'button[kp-action="dropdown_details"]', function (e) {
            e.preventDefault();
            var key = $(this).attr('kp-refernce'),
            tpl = _.template($('noscript[kp-template="dropdown_details"]').text().replaceAll('#key#','<%= key %>'));
            var tpl_html = tpl({key: key});
            $('[kp-template-destination="dropdown_details"]').append(tpl_html);
            $(this).attr('kp-refernce',parseInt(key)+1);
        });
    };
    var submit_form = function (url, data) {
        $overlay_div.appendTo(container);
        gb_popup_xhr_post = $.post(url, data, function (ret) {
            container.html(ret);
            commonjs.reinit();
            $overlay_div.remove();
        }).fail(function (jqXhr) {
            if (jqXhr.status === 401) //redirect if not authenticated user.
                $(location).prop('pathname', 'auth/login');
            if (jqXhr.status === 422) {
                //process validation errors here.
                $errors = jqXhr.responseJSON; //this will get the errors response data.
                //show them somewhere in the markup
                //e.g
                var $div = $('<div />', {class: 'alert alert-danger', id: 'error-div'}), $ul = $('<ul />');

                $.each($errors, function (key, value) {
                    var $li = $('<li />', {
                        text: value[0]
                    });
                    $li.appendTo($ul);
                });
                $ul.appendTo($div);
                container.find('#error-div').remove();
                if (container) {
                    container.prepend($div); //appending to a <div id="form-errors"></div> inside form
                }
            } else {
                alert("error");
            }
            $overlay_div.remove();
        });
    };

    return {
        init: function () {
            bindElement();
        }
    };
}();

