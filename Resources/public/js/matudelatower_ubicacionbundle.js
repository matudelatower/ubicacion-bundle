/**
 * Created by matias on 15/7/16.
 */
//llamada ajax para todos los combos dependientes de country -> city
$(document).on('change', '.select_pais', function () {
    var data = {
        id: $(this).val()
    };
    $.ajax({
        type: 'post',
        url: '{{ path("get_provincias") }}',
        data: data,
        success: function (data) {

            $('.select_provincia').html(data);
        }
    });
});

//llamada ajax para todos los combos dependientes de country -> city
$(document).on('change', '.select_provincia', function () {
    var data = {
        id: $(this).val()
    };
    $.ajax({
        type: 'post',
        url: '{{ path("get_departamentos") }}',
        data: data,
        success: function (data) {

            $('.select_departamento').html(data);
        }
    });
});
//llamada ajax para todos los combos dependientes de country -> city
$(document).on('change', '.select_departamento', function () {
    var data = {
        id: $(this).val()
    };
    $.ajax({
        type: 'post',
        url: '{{ path("get_localidades") }}',
        data: data,
        success: function (data) {

            $('.select_localidad').html(data);
        }
    });
});
