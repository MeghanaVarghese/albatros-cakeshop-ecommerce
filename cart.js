let cart = [];

        function addToCart(id, name, price) {
            cart.push({ id, name, price });
            updateCart();
        }

        function updateCart() {
            const cartItemsElement = document.getElementById('cart-items');
            const cartTotalElement = document.getElementById('cart-total');
            let total = 0;

            cartItemsElement.innerHTML = '';
            cart.forEach(item => {
                const listItem = document.createElement('li');
                listItem.textContent = `${item.name} - $${item.price}`;
                cartItemsElement.appendChild(listItem);
                total += item.price;
            });

            cartTotalElement.textContent = total.toFixed(2);
        }


        function showPaymentDetails(paymentMethod) {
            const paymentOptions = document.querySelectorAll('.payment-option');
            paymentOptions.forEach(option => {
                if (option.id === paymentMethod) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        }

        function proceedPayment() {
            // Here you can add code to process the payment
            // For demonstration purpose, let's just show an alert
            alert("Payment Successful!");
        }