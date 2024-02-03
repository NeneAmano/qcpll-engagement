$(document).ready(function () {
    // $('body').on('click', '.edit', function(event) {
    $('body').on('click', '.edit', function(event) {

        $('#edit_user_modal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#edit_user_role').val(data[0]).change();
        $('#edit_user_id').val(data[1])
        $('#edit_username').val(data[3]);
    });
});