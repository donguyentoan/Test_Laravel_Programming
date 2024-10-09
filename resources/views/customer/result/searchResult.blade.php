@extends('customer.layout.app')

@section('content')
<section class="text-gray-600 body-font">
    <div class="container   mx-auto">
       <div class="pt-4">
          <h1 class="text-2xl py-6 text-blue-500 font-bold ">Ô TÔ</h1>
          <div class="flex flex-wrap -m-4">
           @foreach($products as $product)
            <div class="lg:w-1/4 md:w-1/2 p-4 w-full hover:border-2 rounded-xl">
              <a href="/product/{{$product->id}}" class="block relative h-48 rounded overflow-hidden">
                <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="/upload/{{$product->source['image'] }}">
              </a>
              <div class="mt-4">
                <h3 class="text-gray-500   text-[10px] mb-1 bg-red-300 w-fit p-1 text-white rounded-xl">CATEGORY</h3>
                <h2 class="text-gray-900 title-font text-lg font-medium">{{ $product->source['name'] }}</h2>
                <p class="mt-1">${{ $product->source['price'] }}</p>
                <div>
                  {{-- <button onclick="addToMiniCart({{$value->id}}, {{$value->price}}, '{{$value->name}}', '{{$value->image}}')" class="addtocartButton w-full p-2 bg-gray-400 rounded-md text-white">
                    Add To Cart
                </button> --}}
                
                </div>
              </div>
            </div>
           @endforeach
       </div>
      
       
      
       
      </div>
    </div>

    <script>
               function addToMiniCart(id, price, name, image) {

              const product = {
                  id: id,
                  name: name,
                  image: image,
                  price: price, 
                  quantity: 1
              };
              const miniCart = JSON.parse(localStorage.getItem('miniCartss')) || [];
              const existingProductIndex = miniCart.findIndex(item => item.id === id);
              if (existingProductIndex !== -1) {
                  // Nếu sản phẩm đã tồn tại, tăng quantity lên
                  miniCart[existingProductIndex].quantity += 1;
              } else {
                  // Nếu sản phẩm chưa tồn tại, thêm vào giỏ hàng
                  miniCart.push(product);
              }

              localStorage.setItem('miniCartss', JSON.stringify(miniCart));

              // Cập nhật số lượng sản phẩm trong mini cart
            
              const itemCount = document.querySelector('.minicart--item-count');
              itemCount.textContent = miniCart.length;
          }





    </script>
</section>
@endsection
