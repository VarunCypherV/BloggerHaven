document.addEventListener('DOMContentLoaded', function() {
    const hearts = document.querySelectorAll('.heart');
    const userId = sessionStorage.getItem('userId'); // Retrieve user ID from session storage
    const urlParams = new URLSearchParams(window.location.search);
    const blogId = urlParams.get('slug'); // Retrieve blog ID from slug

    hearts.forEach(heart => {
        heart.addEventListener('click', function() {
            this.classList.toggle('invert');
            // Construct FormData object
            const formData = new FormData();
            formData.append('UserId', userId);
            formData.append('BlogId', blogId);

            // Send POST request with FormData
            fetch('http://localhost:80/BlogWebsite/BackEnd/UpdateLiked.php', {
                method: 'POST',
                body: formData // Send form data
            })
            .then(response => {
                if (response.ok) {
                    console.log('Liked status updated successfully');
                } else {
                    console.error('Failed to update liked status');
                }
            })
            .catch(error => {
                console.error('Error updating liked status:', error);
            });
        });
    });
});
