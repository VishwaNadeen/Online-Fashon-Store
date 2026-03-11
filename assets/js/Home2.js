const images = [
    'images/bgimage6.webp',
    'images/bgimage5.webp',
    'images/bgimage7.webp'
  ];
  
  let currentIndex = 0;
  
  function changeBackground() {
    const slideshowElement = document.querySelector('.bgimage2');
    
    slideshowElement.style.backgroundImage = `url('${images[currentIndex]}')`;
  
    currentIndex = (currentIndex + 1) % images.length;
  }
  
  setInterval(changeBackground, 5000);
  
  changeBackground();