/* ---------------------------------------------------------------------- */
/* Form Campaign02 */

var checks = 0;

$("#allpromo").on('ifChecked', function () {
    for (var i = 0; i < paramarr.length; i++) {
        $('#' + paramarr[i]).iCheck('check');
    }
    paramadd = paramarr.length;
    checks = 0;
});

$("#allpromo").on('ifUnchecked', function () {
    if (checks === 0) {
        for (var i = 0; i < paramarr.length; i++) {
            $('#' + paramarr[i]).iCheck('uncheck');
        }
        paramadd = 0;
    }
});

for (var i = 0; i < paramarr.length; i++) {
    $('#' + paramarr[i]).on('ifUnchecked', function () {
        checks = 1;
        $('#allpromo').iCheck('uncheck');
        paramadd--;
        define_step_by_step_promo_parameter();

    });
    $('#' + paramarr[i]).on('ifChecked', function () {
        paramadd++;
        if(paramadd === paramarr.length){
            $('#allpromo').iCheck('check');
        }
        define_step_by_step_promo_parameter();
    });
}

$("#tipepromo").change(function () {

    var valuenya = $(this).val();
    var explodes = valuenya.split(",");
    paramprm = 1;
    for (var i = 0; i < paramarr.length; i++) {
        $('#' + paramarr[i]).iCheck('uncheck');
    }

    for (var i = 0; i < explodes.length; i++) {
        $('#' + explodes[i]).iCheck('check');
    }
    /* console.log(valuenya); */
    if (valuenya === "") {
        paramprm = 0;
    }
    /* console.log($(this).val()); */
});