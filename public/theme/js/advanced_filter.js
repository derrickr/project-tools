function filterEmpty()
{
    var myForm = document.getElementById('form-advanced-search');
    var allInputs = myForm.getElementsByTagName('input');
    var allSelects = myForm.getElementsByTagName('select');
    var input, select, i;

    for (i = 0; input = allInputs[i]; i++) {
        if (input.getAttribute('name') && !input.value) {
            input.setAttribute('name', '');
        }
    }
    for (i = 0; select = allSelects[i]; i++) {
        if (select.getAttribute('name') && !select.value) {
            select.setAttribute('name', '');
        }
    }
}
var AdvancedSearch = function () {
    var bindElement = function () {
        $(document).on('click', '[kp-action="reset"]', function () {
            $(this).closest('div.form-group').find('[kp-action="reset-to"]').val('').trigger('change');
        });
    };

    return {
        init: function () {
            bindElement();
        }
    };
}();

