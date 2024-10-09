<div class="searchProduct  mt-4">
    <p class="text-xl font-bold py-3">Tìm Kiếm Sản Phẩm</p>
    <form action="{{ route('products.search') }}" method="GET">
      <div class="flex">
         <input class="border-2 w-full p-2 rounded-l-xl" type="text" name="query" placeholder="Search products...">
         <button class="bg-red-400 p-3 rounded-r-xl text-white" type="submit">Search</button>
      </div>
  
  </form>


</div>