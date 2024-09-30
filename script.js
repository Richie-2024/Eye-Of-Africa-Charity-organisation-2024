// JavaScript for Sliding Carousel
let currentIndex = 0;
const imgs = document.querySelectorAll('.carousel img');
const totalImages = imgs.length;

function moveToNextImage() {
  // Move current image out of the view (to the left)
  imgs[currentIndex].style.transform = 'translateX(100%)';

  // Move to the next image
  currentIndex = (currentIndex + 1) % totalImages;

  // Move the next image into view (from the right)
  imgs[currentIndex].style.transform = 'translateX(0)';

  // Reset the position of all other images (move them to the right side off-screen)
  imgs.forEach((img, index) => {
    if (index !== currentIndex) {
      img.style.transform = 'translateX(100%)';
    }
  });
}

// Start the sliding carousel (every 3 seconds)
setInterval(moveToNextImage, 3000);
// Get the button
const backToTopBtn = document.getElementById('backToTopBtn');

// Show the button when the user scrolls to the bottom of the page
window.onscroll = function () {
  if (
    window.innerHeight + window.pageYOffset >=
    document.body.offsetHeight - 50
  ) {
    backToTopBtn.style.display = 'block'; // Show the button
  } else {
    backToTopBtn.style.display = 'none'; // Hide the button
  }
};

// When the button is clicked, scroll to the top of the page
backToTopBtn.addEventListener('click', function () {
  window.scrollTo({
    top: 0,
    behavior: 'smooth', // Smooth scrolling
  });
});

// const pay = document
//   .querySelector('#pay')
//   .addEventListener('click', makePayment());
