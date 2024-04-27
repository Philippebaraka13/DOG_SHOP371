document.addEventListener('DOMContentLoaded', function() {
    var adoptionForm = document.getElementById('adoptionForm');
    var historyNoteTextArea = document.getElementById('historyNote');
    var adoptionResponse = document.getElementById('adoptionResponse');

    adoptionForm.addEventListener('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        fetch('submit_adoption.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            adoptionResponse.innerText = data.message;
            if (data.message.includes('successfully')) {
                // Clear the textarea if the message indicates success
                historyNoteTextArea.value = '';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            adoptionResponse.innerText = 'There was an error processing your request.';
        });
    });
});
