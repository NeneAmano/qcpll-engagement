$(document).ready(function () {
    $('body').on('click', '.edit', function (event) {
        var $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        // Check if the modal type is 'password' or 'user'
        var modalType = $(this).data('modal-type');

        $('#edit_entry_check').val(data[0]).change();
        $('#edit_qt_id').val(data[5]);

        if (modalType === 'user') {
            $('#edit_user_modal').modal('show');
        } else if(modalType === 'password') {
            $('#edit_user_password_modal').modal('show');
        }
    });
});

$(document).ready(function () {

    $('body').on('click', '.delete', function(event) {

        $('#deactivate_user_modal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#deactivate_user_id').val(data[1]);

    });
});