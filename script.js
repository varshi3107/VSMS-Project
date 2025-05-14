document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        // Simple client-side validation example
        const name = document.getElementById('name').value;
        if (name.trim() === '') {
            alert('Name is required.');
            event.preventDefault(); // Prevent form submission
        }
    });
});
