//Действия
$('#add-btn').click(function () {
    $('#modal-form').modal('show');
    $('#modal-form form')[0].reset();
    return false;
});

$('#bill-of-lading-pjax').on('click', '.btn-edit', function () {
    var id = $(this).data('id');
    $.getJSON('/admin/bill-of-lading/find', {
        id: id
    }, function (data) {
        for (var key in data) {
            $('#modal-form #billoflading-' + key).val(data[key]);
            $('#modal-form').modal('show');
        }
    });
    return false;
});

$('#bill-of-lading-pjax').on('click', '.btn-delete', function () {
    var id = $(this).data('id');
    $.getJSON('/admin/bill-of-lading/delete', {
        ids: [id]
    }, function (data) {
        if (data.result == "ok") {
            updateGrid();
        } else {
            alert('Произошла ошибка');
        }
    });
    return false;
});


$('#run-action').click(function () {
    var keys = $('#bill-of-lading-grid').yiiGridView('getSelectedRows');
    if (keys) {
        var action = $('select[name=action] option:selected').attr('value');
        if (action === "delete") {
            $.getJSON('/admin/bill-of-lading/delete', {
                ids: keys
            }, function (data) {
                if (data.result == "ok") {
                    updateGrid();
                } else {
                    alert('Произошла ошибка');
                }
            });
        }
    } else {
        alert('Пожалуйста, выберите строки');
    }
    return false;
});


//Прерываем отправку через POST и отправляем через AJAX
$(document).on('beforeSubmit', '#modal-form form', function (e) {
    var btn = $('#btn-modal-save'),
        id = $('#modal-form #billoflading-id').val(),
        actionUrl = "";

    btn.attr('disabled', false);

    if (id) {
        actionUrl = '/admin/bill-of-lading/update?id=' + id;
    } else {
        actionUrl = '/admin/bill-of-lading/create';
    }

    $.post(actionUrl, $('#modal-form form').serialize(), function (data) {
        btn.attr('disabled', false);
        $('#modal-form').modal('hide');
        if (data.result == "ok") {
            updateGrid();
        } else {
            alert('Произошла ошибка');
        }
    }, 'json');

    return false;
});

function updateGrid() {
    $.pjax.reload({container: "#bill-of-lading-pjax"});
}