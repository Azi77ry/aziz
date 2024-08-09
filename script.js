let cart = [];

function addToCart(productName, price) {
    const userName = document.getElementById('user_name').value;
    const phoneNumber = document.getElementById('phone_number').value;

    if (!userName || !phoneNumber) {
        alert('Please enter your full name and phone number before adding items to the cart.');
        return;
    }

    // Add product to cart
    cart.push({ productName, price, userName, phoneNumber });

    // Update cart summary
    updateCartSummary();
}

function removeFromCart(index) {
    // Remove item from cart array
    cart.splice(index, 1);

    // Update cart summary
    updateCartSummary();
}

function updateCartSummary() {
    const cartItemsElement = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');

    if (cart.length === 0) {
        cartItemsElement.innerText = 'No items in cart';
        cartTotalElement.innerText = 'Total: TZ 0.00';
    } else {
        let itemsHTML = '';
        let total = 0;

        cart.forEach((item, index) => {
            itemsHTML += `
                <div>
                    ${item.productName} - TZ ${item.price.toFixed(2)} 
                    <button onclick="removeFromCart(${index})">Remove</button>
                </div>
            `;
            total += item.price;
        });

        cartItemsElement.innerHTML = itemsHTML;
        cartTotalElement.innerText = `Total: TZ ${total.toFixed(2)}`;
    }
}

function submitCart() {
    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    cart.forEach(item => {
        // Send cart data to server for each item
        fetch('add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                'product_name': item.productName,
                'price': item.price,
                'user_name': item.userName,
                'phone_number': item.phoneNumber
            })
        }).then(response => response.text())
          .then(data => console.log(data))
          .catch(error => console.error('Error:', error));
    });

    alert("Cart submitted successfully!");
}
let slideIndex = 0;
showSlides();

function showSlides() {
    let slides = document.getElementsByClassName("slide");
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) { slideIndex = 1 }    
    slides[slideIndex-1].style.display = "block";  
    setTimeout(showSlides, 3000); // Change image every 3 seconds
}
