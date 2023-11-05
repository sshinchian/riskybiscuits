// delete-modal.js
console.log('hellooo');
console.log('Script loaded and executed.');

$('#deleteRecordModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recordId = button.attr('data-record-id'); // Extract record ID from data attribute
    console.log('Record ID:', recordId);
    var form = $(this).find('#record-delete-form');
    var actionUrl = form.attr('action'); // Get the form's original action URL
    var newActionUrl = actionUrl.replace(/\/\d+$/, '/' + recordId); // Update the ID in the action URL
    form.attr('action', newActionUrl); // Set the updated action URL in the form
});


