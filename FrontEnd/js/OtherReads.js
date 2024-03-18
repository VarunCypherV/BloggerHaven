const blogCards = document.querySelectorAll('.blog-card');
const otherReadsTitle = document.getElementById('other-reads-title');
function toggleCardVisibility() {
  const titleRect = otherReadsTitle.getBoundingClientRect();
  const titleBottom = titleRect.top + titleRect.height;
  blogCards.forEach(card => {
    const cardRect = card.getBoundingClientRect();
    if (cardRect.top+ 20 < titleBottom ) {
      card.style.visibility = 'hidden';
    } else {
      card.style.visibility = 'visible';
    }
  });
}

window.addEventListener('scroll', toggleCardVisibility);
toggleCardVisibility();
