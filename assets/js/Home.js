const images = [
  '/Online-Fashon-Store/assets/images/bgimage1.webp',
  '/Online-Fashon-Store/assets/images/bgimage2.webp',
  '/Online-Fashon-Store/assets/images/bgimage3.webp',
  '/Online-Fashon-Store/assets/images/bgimage4.webp'
];

let currentIndex = 0;

function changeBackground() {
  const slideshowElement = document.querySelector('.bgimage1');
  
  slideshowElement.style.backgroundImage = `url('${images[currentIndex]}')`;

  currentIndex = (currentIndex + 1) % images.length;
}

setInterval(changeBackground, 5000);

changeBackground();