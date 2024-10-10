<header class="text-gray-600 body-font">
    <div class="container mx-auto flex flex-wrap py-5 flex-col md:flex-row items-center">
      <a href="/" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
        <img class="w-15 h-12" src="./image/logon.png" alt="">
       
      </a>
      <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center pr-4">
        <a class="mr-5 hover:text-gray-900">HOME</a>
        <a class="mr-5 hover:text-gray-900">ABOUT</a>
        <a class="mr-5 hover:text-gray-900">CONTACT</a>
        @auth
        <a href="/login" class="mr-5 hover:text-gray-900">{{ auth()->user()->name }}</a>
        <a  href="/logout" class="mr-5 hover:text-gray-900">LOGOUT</a>
        @else
            <a href="/login" class="mr-5 hover:text-gray-900">LOGIN</a>
        @endauth
    
        <button class="search_item">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
              </svg>
        </button>
       
      </nav>
      <a href="/cart" class="group relative inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
          </svg>
          <div class=" minicart--item-count text-center absolute top-[-15px] left-[-4px] w-6 h-6 rounded-full bg-red-500 text-white">0</div>
        </a>

    </div>
    
  </header>

  <script>
     const miniCart = JSON.parse(localStorage.getItem('miniCartss')) || [];
                const itemCount = document.querySelector('.minicart--item-count');
                itemCount.textContent = miniCart.length;
                
    const search_item = document.querySelector('.search_item');
    const searchProduct = document.querySelector('.searchProduct');
    search_item.addEventListener('click' , function(){
        searchProduct.style.display = 'block';
    })
  </script>