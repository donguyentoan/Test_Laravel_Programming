@extends('customer.layout.app')

@section('content')
<div class="bg-gray-100 h-screen py-8 rounded-xl">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-4">Shopping Cart</h1>
        <div class="flex flex-col md:flex-row gap-4">
            <div class="md:w-3/4">
                <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                    <div class="cart-container w-full">
                        <div class="cart-header flex justify-between font-semibold text-left py-4 border-b">
                            <div class="w-1/4">Product</div>
                            <div class="w-1/4">Price</div>
                            <div class="w-1/4">Quantity</div>
                            <div class="w-1/4">Total</div>
                            
                        </div>
                        
                        <div class="listCart">

                        </div>
                        <div class="flex justify-between">
                            <button class="bg-red-500 p-2 rounded-xl text-white font-medium m-4 ">Go Back</button>
                            <button class="updateCart hidden bg-blue-500 p-2 rounded-xl text-white font-medium m-4 ">Update Cart</button>
                        </div>
                       
                       
                    </div>
                    
                </div>
            </div>
            <div class="md:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold mb-4">Summary</h2>
                    <div class="flex justify-between mb-2">
                        <span>Subtotal</span>
                        <span>$19.99</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Taxes</span>
                        <span>$1.99</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Shipping</span>
                        <span>$0.00</span>
                    </div>
                    <hr class="my-2">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Total</span>
                        <span class="font-semibold">$21.98</span>
                    </div>
                    <button class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full">
                     <a href="/checkout">Checkout</a>   
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
       renderCart();
       const dataCart = JSON.stringify(miniCart); // This should be an array, not a JSON string
const listCart = document.querySelector('.listCart'); // Corrected the spelling from querySlector to querySelector
let vuivui = ''; // Use let for vuivui to allow reassignment

miniCart.forEach(element => { // Iterate over miniCart directly, not dataCart
    vuivui += `
     <div class="cart-item flex justify-between py-4 border-b">
         
                            <div class="flex w-1/4 items-center">
                                
                                <img class="h-16 w-16 mr-4" src="/upload/${element.image}" alt="Product image">
                                <span class="font-semibold">${element.name}</span>                                
                            </div>
                            <div class="w-1/4 flex items-center">$${element.price}</div>
                            <div class="w-1/4 flex items-center">
                                <button  class="decrease border rounded-md py-2 px-4 mr-2">-</button>
                                <span class="number_quantity text-center w-8">${element.quantity}</span>
                                <button class="increase border rounded-md py-2 px-4 ml-2">+</button>
                            </div>
                            <div class="w-1/4 flex items-center">$${(element.price * element.quantity).toFixed(2)} </div> 
                                             <div onclick="removeCart(${element.id})" class="w-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                            </svg></div>
                        </div>  
        `;
});

// Set the inner HTML of the listCart
listCart.innerHTML = vuivui;



const updateCart = document.querySelector('.updateCart');

function bindQuantityChangeEvents() {

    let increase = document.querySelectorAll('.increase'); 
    let decrease = document.querySelectorAll('.decrease'); 
    let number_quantity = document.querySelectorAll('.number_quantity'); 

    increase.forEach((item, index) => {
        item.addEventListener('click', function() {
            updateCart.style.display = 'block';
            let currentVal = parseInt(number_quantity[index].textContent);
            number_quantity[index].textContent = currentVal + 1;
          
        });
    });

    decrease.forEach((item, index) => {
        item.addEventListener('click', function() {
            updateCart.style.display = 'block';
            let currentVal = parseInt(number_quantity[index].textContent);
            if (currentVal > 1) {
                number_quantity[index].textContent = currentVal - 1;
                
            }
           
        });
    });
}

// Event listener for updating the cart
updateCart.addEventListener('click', function() {
    let number_quantity = document.querySelectorAll('.number_quantity');
    number_quantity.forEach((el, index) => {
        miniCart[index].quantity = parseInt(el.textContent);
        const productId = miniCart[index].id;
        updateCartInDBtoCart(productId , miniCart[index].quantity);
    });
    localStorage.setItem('miniCartss', JSON.stringify(miniCart));

    renderCart();
    bindQuantityChangeEvents();  // Gán lại sự kiện sau khi render
});

// Initial binding of increase/decrease buttons
bindQuantityChangeEvents();

function removeCart(id) {
    // Find the index of the item with the specified id in miniCart
    if(id){

        Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
        if (result.isConfirmed) {
            const index = miniCart.findIndex(item => item.id === id);
    if (index !== -1) {
        miniCart.splice(index, 1); 
        localStorage.setItem('miniCartss', JSON.stringify(miniCart));
        removeCartInDB(id);
        loadMiniCart();
        renderCart(); 
        
    } else {
        Swal.fire({
        title: "Item not found in cart",
        showClass: {
            popup: `
            animate__animated
            animate__fadeInUp
            animate__faster
            `
        },
        hideClass: {
            popup: `
            animate__animated
            animate__fadeOutDown
            animate__faster
            `
        }
        });
    }
    renderCart();
            Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
            });
        }
        });
    }
    
}

function removeCartInDB(cartId,) {
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  fetch('/del/cart', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken // Sử dụng CSRF token
      },
      body: JSON.stringify({
          cart_id: cartId,
      })
  })
  .then(response => response.json()) // Chuyển đổi phản hồi sang JSON
  .then(data => {
      if(data.code == 201){
        Swal.fire({
          position: "top-center",
          icon: "success",
          title: "Remove Cart Success",
          showConfirmButton: false,
          timer: 1500
        });
      }

  })
  .catch(error => {
      console.error('Error:', error);
      alert("Lỗi khi kết nối tới server.");
  });
}

function renderCart() {
    const listCart = document.querySelector('.listCart');
    listCart.innerHTML = ''; // Clear current cart UI

    miniCart.forEach(element => {
        listCart.innerHTML += `
             <div class="cart-item flex justify-between py-4 border-b">
         
                            <div class="flex w-1/4 items-center">
                                
                                <img class="h-16 w-16 mr-4" src="/upload/${element.image}" alt="Product image">
                                <span class="font-semibold">${element.name}</span>                                
                            </div>
                            <div class="w-1/4 flex items-center">$${element.price}</div>
                            <div class="w-1/4 flex items-center">
                                <button  class="decrease border rounded-md py-2 px-4 mr-2">-</button>
                                <span class="number_quantity text-center w-8">${element.quantity}</span>
                                <button class="increase border rounded-md py-2 px-4 ml-2">+</button>
                            </div>
                            <div class="w-1/4 flex items-center">$${(element.price * element.quantity).toFixed(2)} </div> 
                                             <div onclick="removeCart(${element.id})" class="w-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                            </svg></div>
                        </div>  
        `;
    });
}
function loadMiniCart(){
    const miniCart = JSON.parse(localStorage.getItem('miniCartss')) || [];
    const itemCount = document.querySelector('.minicart--item-count');
    itemCount.textContent = miniCart.length;

}

function updateCartInDBtoCart(productId, quantity){
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Lấy CSRF token từ thẻ meta
  fetch('/update/cart', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken // Sử dụng CSRF token
    },
    body: JSON.stringify({
      product_id: productId,
      quantity: quantity
    })
  })
    .then(response => response.json()) // Chuyển đổi phản hồi sang JSON
    .then(data => {
      if (data.code == 201) {
        Swal.fire({
          position: "top-center",
          icon: "success",
          title: " Update Cart Success",
          showConfirmButton: false,
          timer: 1500
        });
      }

    })
    .catch(error => {
      console.error('Error:', error);
      alert("Lỗi khi kết nối tới server.");
    });
}
                
</script>
@endsection