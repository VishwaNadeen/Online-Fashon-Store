const productData = [
    // Replace with your actual product data or fetch it from a server
    {
      id: 0,
      image: '../Images/image2.jpg',
      title: 'Sleeve Collar T-Shirt',
      price:  2690.00,
    },
    {
      id: 1,
      image: '../Images/image4.jpg',
      title: 'Printed Casual Shirt', // Corrected capitalization
      price: 2190,
    },
    {
      id: 2,
      image:'../Images/dot-croup-top-1890.jpg',
      title: 'Dot Croup Top', // Corrected capitalization
      price: 1890,
    },
    {
      id: 3,
      image: '../Images/image6.jpg',
      title: 'Printed Brown Sarong', // Corrected capitalization
      price: 1100,
    },
    {
      id: 4,
      image: '../Images/image9.jpg',
      title: 'Curve Neck T-Shirt', // Corrected capitalization
      price: 995,
    },
    {
      id: 5,
      image:'../Images/image10.jpg',
      title: 'Classic Polo T-Shirt', // Corrected capitalization
      price: 1995,
    },
    {
      id: 6,
      image: '../Images/image12.jpg',
      title: 'Plain Slim Fit Shirt', // Corrected capitalization
      price: 2100,
    },
    {
      id: 7,
      image: '../Images/image5.jpg',
      title: 'Slevee Polo T-shirt', // Corrected capitalization
      price: 3690,
    },
    {
      id: 8,
      image: '../Images/double pocket denim jacket 2790.jpg',
      title: 'Double Pocket Denimt', // Corrected capitalization
      price: 2790,
    },
    {
      id: 9,
      image:'../Images/floral-print-strappy-midi-dress-2090.jpg',
      title: 'Strappy Midi Dress', // Corrected capitalization
      price: 2090,
    },
    {
      id: 10,
      image:'../Images/short-sleeve-crop-top-1490.jpg',
      title: 'Short Sleeve Crop Top', // Corrected capitalization
      price: 1490,
    },
    {
      id: 11,
      image:'../Images/strap-long-dress-2990.jpg',
      title: 'Strap Long Dress', // Corrected capitalization
      price: 2990,
    },

  ];
  
  
  let cart = [];
  
  function generateProductList() {
    const rootElement = document.getElementById('root');
    rootElement.innerHTML = productData.map(product => `
      <div class='box'>
        <div class='img-box'>
          <img class='images' src='${product.image}' alt='${product.title}'>
        </div>
        <div class='bottom'>
          <p>${product.title}</p>
          <h2>Rs ${product.price}.00</h2>
          <button onclick='addToCart(${product.id})'>Add to Cart</button>
        </div>
      </div>`
    ).join('');
  }
  
  function addToCart(productId) {
    const product = productData.find(item => item.id === productId);
    if (product) {
      const existingCartItem = cart.find(item => item.id === productId);
      existingCartItem ? existingCartItem.quantity++ : cart.push({ ...product, quantity: 1 });
      updateCartItems();
    } else console.error("Product not found:", productId);
  }
  
  function updateCartItems() {
    const cartItemsElement = document.getElementById('cart-items');
    if (!cart.length) cartItemsElement.textContent = 'Your cart is empty';
    else {
      cartItemsElement.innerHTML = cart.map(product => `
        <div class="cart-item">
          <p>${product.title} (Quantity: ${product.quantity})</p>
          <h2>Rs ${product.price * product.quantity}.00</h2>
          <button class="remove-button" data-product-id="${product.id}">Remove</button>
        </div>`
      ).join('');
      calculateTotal();
      document.getElementById('deleteButton').disabled = false;
      document.querySelectorAll('.remove-button').forEach(button => button.addEventListener('click', handleRemoveItem));
    }
  }
  
  function handleRemoveItem(event) {
    const productId = parseInt(event.target.dataset.productId);
    const existingCartItem = cart.find(item => item.id === productId);
    if (existingCartItem) {
      existingCartItem.quantity === 1 ? cart = cart.filter(item => item.id !== productId) : existingCartItem.quantity--;
      updateCartItems();
    }
  }
  
  function clearCart() {
    cart = [];
    calculateTotal();
    updateCartItems();
  }
  
  function calculateTotal() {
    let totalPrice = 0;
    cart.forEach((product) => (totalPrice += product.price));
    document.getElementById('total').textContent = `Rs ${totalPrice}.00`;
    total1 = totalPrice;
  }
  
  function proceed(){
    var total=total1;
    var sub =total1+324;
    var newwin = window.open("../place order/order.php");
    newwin.onload= function(){
      this.total=total;
      this.sub=sub;
    }
  }
  
  document.getElementById('deleteButton').addEventListener('click', clearCart);
  
  generateProductList();
  
  