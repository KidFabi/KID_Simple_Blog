require('./bootstrap');

// Bootstrap tooltips
$(function () {
    $('[data-bs-title="tooltip"]').tooltip()
});

// Call delete confirmation modal
$(function () {
    $('.confirm-delete').click(function () {
        let url = $(this).attr('data-url');
        $('.confirm-delete-modal-form').attr('action', url);
    });
    $('.remove-data-from-delete-form').click(function () {
        $('body').find('.confirm-delete-modal-form').attr('action', '');
    });
});

// Logout
$(function () {
    $('#logout-button').click(function (event) {
        event.preventDefault();
        $('#logout-form').submit();
    });
});
