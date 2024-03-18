document.addEventListener('DOMContentLoaded', function() {
    const hearts = document.querySelectorAll('.heart');
    hearts.forEach(heart => {
        heart.addEventListener('click', function() {
            this.classList.toggle('invert');
        });
    });
});