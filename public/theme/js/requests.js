
var Requests = function () {
    var req = null;var url = capp.base_url+'/request/action/{{ action }}'+'?id={{ id }}';
    var bindCreateElement = function () {
        $(document).on('click','[kp-toggle="fasttrack"]',function(){
            $(this).toggleClass('active');
            $('input[name="fasttrack"').val($('input[name="fasttrack"').val()=='active'?'inactive':'active');
            $('[kp-toggle-bind="fasttrack"]').toggleClass('hide');
        });
    };
    var bindEditElement = function () {
        $(document).on('click', '[kp-request-action]', function () {
            var action = $(this).attr('kp-request-action');
            var action_url = _.template(url);
            action_url = action_url({action: action, id: req.id});
            gb_get_popup_html(action_url, {}, false);
            gb_popup_xhr.done(function () {
                gb_modal_obj.modal('show');

            });
            gb_popup_xhr.complete(function(){
                
            })
        });
        $(document).on('click', '[kp-request-direct-action]', function () {
            var action_url = $(this).attr('kp-request-direct-action'),$form = $(this).closest('form');
            if ($form[0].checkValidity()) {
                $form.attr('action', action_url).submit();
            }
            else{
                alert('This Field is mandatory.');
            }
        });
        //kp-action-form="request"
        $(document).on('click', '[kp-submit="request-action"]', function (e) {
            e.preventDefault();
            var $mform = gb_modal_obj.find('form'), more_fields = $mform.serializeArray(), $form = $('form#' + $('[name="_form_hidden"]').val()), $div = $form.find('div[kp-action-form="request"]');
            if ($mform[0].checkValidity()) {
                $div.html('');
                $.each(more_fields, function (i, field) {
                    if (field.name != '_token') {
                        var hidden = $('<input/>', {
                            type: 'hidden',
                            name: field.name,
                            value: field.value
                        });
                        console.log(hidden);
                        hidden.appendTo($div);
                    }
                });
                if($form.length)
                    $form.attr('action', $mform.attr('action')).submit();
                else{
                    $mform.submit();
                }
                    
            } else{
                alert('This Field is mandatory.');
            }
        });
    };
    return {
        init_create: function () {
            bindCreateElement();
        },
        init_edit: function (option) {
            req = option;
            bindEditElement();
        }
    };
}();

