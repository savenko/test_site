//Actions
$('#add-btn').click(function () {
    $('#btn-modal-delete').hide();
    $('#modal-form').modal('show');
    $('#modal-form form')[0].reset();
    $('#billoflading-id').val("");
    return false;
});

$('#bill-of-lading-pjax').on('click', '.btn-edit', function () {
    var id = $(this).data('id');
    $.getJSON('/admin/bill-of-lading/find', {
        id: id
    }, function (data) {
        for (var key in data) {
            $('#modal-form #billoflading-' + key).val(data[key]);
            $('#btn-modal-delete').show();
            $('#modal-form').modal('show');
        }
    });
    return false;
});

$('#bill-of-lading-pjax').on('click', '.btn-delete', function () {
    if (confirm('Вы точно уверены, что хотите удалить эту запись?')) {
        $('#modal-form').modal('hide');
        var id = $(this).data('id');
        deleteRows([id]);
    }
    return false;
});

$('#btn-modal-delete').click(function () {
    var id = $('#modal-form #billoflading-id').val();
    $('#bill-of-lading-pjax .btn-delete[data-id=' + id + ']').click();
});


$('#run-action').click(function () {
    var ids = $('#bill-of-lading-grid').yiiGridView('getSelectedRows');
    var action = $('select[name=action] option:selected').attr('value');
    if (ids && action) {
        if (confirm('Вы точно уверены, что хотите удалить эту записи?')) {
            if (action === "delete") {
                deleteRows(ids);
            }
        }
    } else {
        alert('Пожалуйста, выберите строки и дествие');
    }
    return false;
});


//Break POST send and run AJAX request
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

//Helper function
function deleteRows(ids) {
    $.getJSON('/admin/bill-of-lading/delete', {
        ids: ids
    }, function (data) {
        if (data.result == "ok") {
            updateGrid();
        } else {
            alert('Произошла ошибка');
        }
    });
}
function updateGrid() {
    $.pjax.reload({container: "#bill-of-lading-pjax"});
}