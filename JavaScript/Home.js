const images = [
  'images/bgimage1.webp',
  'images/bgimage2.webp',
  'images/bgimage3.webp',
  'images/bgimage4.webp'
];

let currentIndex = 0;

function changeBackground() {
  const slideshowElement = document.querySelector('.bgimage1');
  
  slideshowElement.style.backgroundImage = `url('${images[currentIndex]}')`;

  currentIndex = (currentIndex + 1) % images.length;
}

setInterval(changeBackground, 5000);

changeBackground();