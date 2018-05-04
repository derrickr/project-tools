Notify = function(text, callback, close_callback, style) {

	var time = '10000';
	var $container = $('#notifications');
	var icon = '<i class="fa fa-info-circle "></i>';
 
	if (typeof style == 'undefined' ) style = 'warning'
  
	var html = $('<div class="alert alert-' + style + '  hide">' + icon +  " " + text + '</div>');
  
	$('<a>',{
		text: '×',
		class: 'button close',
		style: 'padding-left: 10px; text-decoration: none;',
		href: '#',
		click: function(e){
			e.preventDefault()
			close_callback && close_callback()
			remove_notice()
		}
	}).prependTo(html)

	$container.prepend(html)
	html.removeClass('hide').hide().fadeIn('slow')

	function remove_notice() {
		html.stop().fadeOut('slow').remove()
	}
	
	var timer =  setInterval(remove_notice, time);

	$(html).hover(function(){
		clearInterval(timer);
	}, function(){
		timer = setInterval(remove_notice, time);
	});
	
	html.on('click', function () {
		clearInterval(timer)
		callback && callback()
		remove_notice()
	});  
}
$.fn.exists = function(callback) {
  var args = [].slice.call(arguments, 1);
  if (this.length) {
    callback.call(this, args);
  }
  return this;
};
_.templateSettings = {
  interpolate: /\{\{(.+?)\}\}/g
};
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};
var logs = function(obj){
    if(capp.jdebug == true || capp.jdebug == 'true' || capp.jdebug == 1){
        console.log(obj);
    }
}
var autocompleteajax = {
    url: capp.base_url+"/auto-lookup/contact",
    timeout: 500,
    displayField: "name",
    valueField: 'value',
    triggerLength: 3,
    method: "get",
    loadingClass: "loading-circle",
    preDispatch: function (query) {
        //showLoadingMask(true);
        var f = {};
        f.name = query;
        return {
            f:f
        };
    },
    preProcess: function (data) {
        //showLoadingMask(false);
        if (data.success === false) {
            // Hide the list, there was some error
            return false;
        }
        // We good!
        return data;
    }
};
var navsearchajax = {   
    url: capp.base_url+"/nav-search/client",
    timeout: 500,
    displayField: "name",
    valueField: 'value',
    triggerLength: 3,
    method: "get",
    loadingClass: "loading-circle",
    preDispatch: function (query) {
        var f = {};
        f.name = query;
        return {
            f:f
        };
    },
    preProcess: function (data) {
        //showLoadingMask(false);
        if (data.success === false) {
            // Hide the list, there was some error
            return false;
        }
        // We good!
        return data;
    }
};
$('input#navbar-search-input').typeahead({
    onSelect: function (item) {
        if(item.value){
            window.location.href = capp.base_url+"/client/"+item.value;
        }
    },
    ajax: navsearchajax
});
var $overlay_div = $('<div />',{class:'overlay'}).html('<i class="fa fa-refresh fa-spin"></i>');
var uppercase = function (str)
{
    var array1 = str.split(' ');
    var newarray1 = [];

    for (var x = 0; x < array1.length; x++) {
        newarray1.push(array1[x].charAt(0).toUpperCase() + array1[x].slice(1));
    }
    return newarray1.join(' ');
}

var firstuppercase = function (str)
{
    logs(str)
    return str.charAt(0).toUpperCase() + str.slice(1);
}
var fulluppercase = function (str)
{
    return str.toUpperCase();
}
var fulllowercase = function (str)
{
    return str.toLowerCase();
}
$(function () {
    $(document).on('focus', 'input.datetimepicker', function () {
        $(this).datetimepicker({
            format: capp.datetime_format,
        });
    });
    $(document).on('focus', 'input[kk-mask="phone"]', function () {
        $(this).mask(capp.phone_mask);
    });
    $(document).on('keypress', 'input.numeric', function (evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    });
    $(document).on('keypress', 'input.decimal', function (evt) {

        var charCode = (evt.which) ? evt.which : event.keyCode;
        var value = $(this).val();
        var dotcontains = value.indexOf(".") != -1;
        if (dotcontains)
            if (charCode == 46)
                return false;
        if (charCode == 46)
            return true;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    });

    $(document).on('focus', 'input.datepicker', function () {
        $(this).datepicker({
            format: capp.date_format,
            todayHighlight: true,
            autoclose: true,
        });
    });
    $(document).on('focus', 'input.daterange', function () {
        var format = ($(this).data('formate'))?$(this).data('formate'):'DD/MM/YYYY';
        $(this).daterangepicker({
            timePicker: false,
            locale: {
                format: format
            },
        }).change(function (e) {
            $(this).trigger('blur');
        });
    });
    $('select[kp-bind="select2"]').each(function () {
        $(this).select2({
            width: '100%',
            containerCssClass: ':all:'
        });
    });
    $(document).on('keyup blur change', '.str-first-up', function () {
        $(this).val(uppercase($(this).val()));
    });
    $(document).on('keyup blur change', '.sen-first-up', function () {
        $(this).val(firstuppercase($(this).val()));
    });
    $(document).on('keyup blur change', '.str-full-up', function () {
        $(this).val(fulluppercase($(this).val()));
    });
    $(document).on('keyup blur change', '.str-full-lo', function () {
        $(this).val(fulllowercase($(this).val()));
    });
    $(document).on('ifChanged', 'input.address_copy', function (e) {
        var lookfor = $(this).attr('kep-ac');
        if (this.checked) {
            $('[ac-' + lookfor + ']').each(function () {
                $(this).val($($(this).attr('ac-' + lookfor)).val()).change();
                $(this).prop('readonly', true);
            });
        } else {
            $('[ac-' + lookfor + ']').each(function () {
                $(this).prop('readonly', false);
            });
        }
    });
    /*
     * For rrmoving alert
     */
    setInterval(function(){
        var $target = $('div.alert');
        $target.slideUp('normal', function(){ $target.remove(); });
    }, 5000);
});
var calculateAge = function () {
    var calAge = function (obj) {
        if ('dob' in obj) {
            $('#' + obj.dob).on('change', function () {
                putAge(obj);
            });
        }
        if ('dod' in obj) {
            $('#' + obj.dod).on('change', function () {
                putAge(obj);
            });
        }
    };
    var putAge = function (obj) {
        var to_d = moment(), date_dob = $('#' + obj.dob).val();
        // var iso_date_f = new Date($('#'+obj.bob).val()).toISOString();
        var from_d = moment(date_dob, fulluppercase(capp.date_format));
        if ('dod' in obj) {
            var date_dod = $('#' + obj.dod).val();
            if (date_dod == '') {
                to_d = moment();
            } else {
                to_d = moment(date_dod, fulluppercase(capp.date_format));
            }
        }
        var age = to_d.diff(from_d, 'years', true);
        if (isNaN(age))
            age = 0;
        $('#' + obj.age).val(parseInt(age));
    };
    return{
        init: function (obj) {
            calAge(obj);
        }
    };
}();
var dbLookUp_var = '';
var dbLookUp_popup;
var dbLookUp_call_back;
var dbLookUp_obj;
var dbLookUp = function () {
    var call_from_obj;
    var bind_element = function () {
        $('[db-lookup]').on('click', function (e) {
            e.preventDefault();
            if (dbLookUp_popup)
                dbLookUp_popup.close();
            dbLookUp_popup = window.open($(this).attr('href'), "Popup", "width=" + (window.outerWidth / 2) + " +,height=" + (window.outerHeight / 2));
            dbLookUp_popup.focus();
            window.onbeforeunload = function () {
                dbLookUp_popup.close()
            }
            dbLookUp_var = '';
            dbLookUp_call_back = $(this).attr('db-lookup-callback');
            return false;
        });
    };
    var afterChildClose = function () {
        if (dbLookUp_call_back) {
            window[call_from_obj][dbLookUp_call_back](jQuery.parseJSON(dbLookUp_var));
            dbLookUp_call_back = '';
            dbLookUp_var = '';
        }
    };
    var bind_element_child = function () {
        $(document).on('ifChanged', 'input[name="dblookup-selected"]', function (e) {
            if (this.checked) {
                if (window.opener != null && !window.opener.closed) {
                    window.opener.dbLookUp_var = $(this).val();
                }
                window.opener.dbLookUp.afterChildClose();
                window.close();
            } else {
            }
        });
    };
    return {
        init: function (obj) {
            call_from_obj = obj;
            bind_element();
        },
        init_child: function () {
            bind_element_child();
        },
        afterChildClose: function () {
            afterChildClose();
        },
    }
}();
var gb_popup_xhr = null,gb_modal_obj=$('#gb-modal'),gb_popup_xhr_post;
var gb_get_popup_html = function (url, data,large) {
    $overlay_div.appendTo('div.content-wrapper');
    gb_modal_obj.find('.modal-lg').removeClass('modal-lg');
    gb_modal_obj.find('div.modal-content').children().remove();
    if(large){
        gb_modal_obj.find('.modal-dialog').addClass('modal-lg');
    }
    gb_popup_xhr = $.post(url,data, function () {
        $overlay_div.remove();
    })
            .done(function (ht) {
                gb_modal_obj.find('div.modal-content').html(ht);
                disableEnterKey();
                $overlay_div.remove();
                commonjs.reinit();
            })
            .fail(function () {
                $overlay_div.remove();
                alert("Some error occur on displaying pop-up!!");
            });
};
var gb_post_popup_form = function (url, data, errorObj) {
    $overlay_div.appendTo(gb_modal_obj.find('div.modal-content'));
    gb_popup_xhr_post = $.post(url, data, function (ret) {
        $overlay_div.remove();
    }).fail(function (jqXhr) {
        if (jqXhr.status === 401) //redirect if not authenticated user.
            $(location).prop('pathname', 'auth/login');
        if (jqXhr.status === 422) {
            //process validation errors here.
            $errors = jqXhr.responseJSON; //this will get the errors response data.
            //show them somewhere in the markup
            //e.g
            var $div = $('<div />', {class: 'alert alert-danger', id: 'pop-error-div'}), $ul = $('<ul />');

            $.each($errors, function (key, value) {
                var $li = $('<li />', {
                    text: value[0]
                });
                $li.appendTo($ul);
            });
            $ul.appendTo($div);
            gb_modal_obj.find('#pop-error-div').remove();
            if (errorObj) {
                gb_modal_obj.find(errorObj).prepend($div); //appending to a <div id="form-errors"></div> inside form
            }
        } else {
            alert("error");
        }
        $overlay_div.remove();
    });
}
var disableEnterKey = function () {
    gb_modal_obj.find('form').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
//        if (keyCode === 13) {
//            e.preventDefault();
//            return false;
//        }
    });
};

var setmessage = function (data, type, obj) {
    var alert = 'alert alert-success', $li = '';
    if (type == 'error') {
        alert = 'alert alert-danger'
    }
    var $div = $('<div />', {class: alert, id: 'pop-error-div'}), $ul = $('<ul />');
    if (typeof data == 'string') {
        $li = $('<li />', {
                text: data
            });
        $li.appendTo($ul);
    } else {
        $.each(data, function (key, value) {
            $li = $('<li />', {
                text: value[0]
            });
            $li.appendTo($ul);
        });
    }
    $ul.appendTo($div);
    obj.find('#pop-error-div').remove();
    if (obj) {
        obj.prepend($div); //appending to a <div id="form-errors"></div> inside form
    }
};
var mailjs = function(){
    var bindElement=function(){
        $('[kp-mail="simple"]').on('click',function(e){
            var data = {};
            data.mail = 'simple';
            data.mail_type = $(this).attr('kp-mail-type');
            data.client_id = $(this).attr('kp-mail-id');
            e.preventDefault();
            gb_get_popup_html(capp.base_url+'/mail',data,false);
            gb_popup_xhr.done(function () {
                gb_modal_obj.modal('show');
                
            });
        });
        $(document).on('click','button[kp-mail-action="send"]',function(e){
            e.preventDefault();
            $overlay_div.appendTo(gb_modal_obj.find('div.modal-content'));
            var $form = gb_modal_obj.find('form')
            gb_post_popup_form($form.attr('action'),$form.serialize(),$('#messageDiv'));
            gb_popup_xhr_post.done(function (res) {
                if (res.success == 1) {
                    setmessage(res.successmsg,'success',$('#messageDiv'));
                }
                if (res.error == 1) {
                    setmessage(res.errormsg,'error',$('#messageDiv'));
                }
            });
            
        })
    }
    return {
      init : function(){
          bindElement();
      },  
      reinit : function(){
          bindElement();
      }  
    };
}();
$('[data-toggle="tooltip"]').tooltip(); 
var commonjs = function(){
    var icheck=function(){
        $('input[type="checkbox"], input[type="radio"]').not('[kp-binded="icheck"]').each(function () {
            $(this).attr('kp-binded', 'icheck');
            $(this).iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });     
    };
    var getAddressio=function(){
        if ($('div.postcode_lookup div.postcode_lookup_contaner').length) {
            $('div.postcode_lookup div.postcode_lookup_contaner').not('[kp-binded="getaddress"]').each(function () {
                $(this).attr('kp-binded','getaddress');
                $(this).getAddress({
                    api_key: capp.ga_api_key,
                    output_fields: {
                        postcode: '#postcode'
                    },
                    onAddressSelected: function (elem, index) {
                        if (elem) {
                            var address = elem.split(',');
                            var street = "";
                            street = address[0].trim() || "";
                            if (address[1].trim() != '') {
                                street += ', '
                                street += address[1].trim();
                            }
                            if (address[2].trim() != '') {
                                street += ', '
                                street += address[2].trim();
                            }
                            if (address[3].trim() != '') {
                                street += ', '
                                street += address[3].trim();
                            }
                            var city = address[5];
                            var state = address[6];
                            var outer_div = $(this[0]).closest('div.lookup-container');
                            outer_div.find('textarea[lookup-street]').val(street);
                            outer_div.find('input[lookup-city]').val(city);
                            outer_div.find('input[lookup-state]').val(state);
                            outer_div.find('input[lookup-postalcode]').val(outer_div.find('input#opc_input').val()).change();
                        }
                    },
                    input_label: 'Enter your Postcode',
                    input_class: 'form-control str-full-up',
                    button_label: 'Find address',
                    button_class: 'btn btn-primary btn-teplok',
                    button_disabled_message: 'Working....',
                    dropdown_class: 'form-control',
                    dropdown_select_message: 'Select your address',
                    error_message_class: 'help-block'
                });

            });
        }
    };
    var slimScroll= function(){
        $('div[kp-slimscroll]').not('[kp-binded="slimscroll"]').each(function () {
            var obj = $(this);
            obj.attr('kp-binded', 'slimscroll');
            $(this).slimScroll({
                height: obj.attr('kp-slimscroll')+'px'
            });
        });
    };
    var trClickable= function(){
        $('tr[kp-trclickable]').not('[kp-binded="trclickable"]').each(function () {
            var obj = $(this);
            obj.attr('kp-binded', 'trclickable');
            obj.on('mouseenter',function(e){
                obj.addClass('tr-hover');
            }).on('mouseleave',function(e){
                obj.removeClass('tr-hover');
            }).on('click',function(e){
                e.preventDefault();
                window.location.href = $(this).attr('kp-trclickable');
            })
              
        });
    };
    var textareaResize = function () {
        $(document).on('keyup click', 'textarea.resize', function (evt) {
            this.style.height = "0";//was 1px
            this.style.height = (this.scrollHeight + 5) + "px"; //was o.style.height = (25+o.scrollHeight)+"px"
        });
        var inital_resize = function () {
            $('textarea.resize').each(function (i, obj) {
                $(obj).trigger('click');
            });
        };
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            inital_resize();
        });
        inital_resize();
    };
    return {
        init: function () {
            icheck();
            getAddressio();
            slimScroll();
            trClickable();
//            textareaResize();
        },
        reinit: function () {
            icheck();
            getAddressio();
            slimScroll();
            trClickable();
        }
    };
}();
var filelookup = function () {
    var file_popup;
    var bind_element = function () {
        $('[file-lookup]').on('click', function (e) {
            e.preventDefault();
            if (file_popup)
                file_popup.close();
            file_popup = window.open($(this).attr('href'), "Popup", "width=" + (window.outerWidth / 2) + " +,height=" + (window.outerHeight / 2));
            file_popup.focus();
            window.onbeforeunload = function () {
                file_popup.close()
            }
            return false;
        });
    };
    return {
        init: function () {
            bind_element();
        },
    }
}();
filelookup.init();
commonjs.init();
mailjs.init();
function currentDateTime() {
        var d = new Date();
        var n = d.toUTCString();
        document.getElementById("currentDateTime").innerHTML = n.slice(0,-3);
        var t = setTimeout(currentDateTime, 1000);
}