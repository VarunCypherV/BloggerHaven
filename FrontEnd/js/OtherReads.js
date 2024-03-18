// Get the blog cards and the Other Reads title
const blogCards = document.querySelectorAll('.blog-card');
const otherReadsTitle = document.getElementById('other-reads-title');

// Function to toggle visibility of blog cards based on scroll position
function toggleCardVisibility() {
  const titleRect = otherReadsTitle.getBoundingClientRect();
  const titleBottom = titleRect.top + titleRect.height;

  // Toggle visibility for each blog card
  blogCards.forEach(card => {
    const cardRect = card.getBoundingClientRect();
    if (cardRect.top+ 20 < titleBottom ) {
      card.style.visibility = 'hidden';
    } else {
      card.style.visibility = 'visible';
    }
  });
}

// Add scroll event listener to toggle visibility
window.addEventListener('scroll', toggleCardVisibility);

// Call the function initially to set visibility based on initial scroll position
toggleCardVisibility();
