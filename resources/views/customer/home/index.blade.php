@extends('customer.layout.app')

@section('content')
   <div class="pt-4 bg-red-400 h-[500px] p-4">
      <p>Slider </p>
   </div>
      @include('customer.home.Component.Search')
   <section class="text-gray-600 body-font">
      <div class="container   mx-auto">
         <div class="pt-4">
            <h1 class="text-2xl py-6 text-blue-500 font-bold ">Ô TÔ</h1>
            <div class="flex flex-wrap -m-4">
             @for($i = 0 ; $i < 12 ; $i++)
              <div class="lg:w-1/4 md:w-1/2 p-4 w-full hover:border-2 rounded-xl">
                <a href="/product/{{$i}}" class="block relative h-48 rounded overflow-hidden">
                  <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="./image/oto.jpeg">
                </a>
                <div class="mt-4">
                  <h3 class="text-gray-500   text-[10px] mb-1 bg-red-300 w-fit p-1 text-white rounded-xl">CATEGORY</h3>
                  <h2 class="text-gray-900 title-font text-lg font-medium">The Catalyzer</h2>
                  <p class="mt-1">$16.00</p>
                  <div>
                    
                       <button class="w-full p-2 bg-gray-400 rounded-md text-white">Add To Cart </button>
                      
                   
                  </div>
                </div>
              </div>
             @endfor
         </div>
         <div class="pt-4">
            <h1 class="text-2xl py-6 text-blue-500 font-bold ">Phụ Kiện</h1>
            <div class="flex flex-wrap -m-4">
             @for($i = 0 ; $i < 12 ; $i++)
              <div class="lg:w-1/4 md:w-1/2 p-4 w-full hover:border-2 rounded-xl">
                <a class="block relative h-48 rounded overflow-hidden">
                  <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="./image/oto.jpeg">
                </a>
                <div class="mt-4">
                  <h3 class="text-gray-500   text-[10px] mb-1 bg-red-300 w-fit p-1 text-white rounded-xl">CATEGORY</h3>
                  <h2 class="text-gray-900 title-font text-lg font-medium">The Catalyzer</h2>
                  <p class="mt-1">$16.00</p>
                  <div>
                    
                       <button class="w-full p-2 bg-gray-400 rounded-md text-white">Add To Cart </button>
                      
                   
                  </div>
                </div>
              </div>
             @endfor
         </div>
         <div class="pt-4">
            <h1 class="text-2xl py-6 text-blue-500 font-bold ">Quà Tặng</h1>
            <div class="flex flex-wrap -m-4">
             @for($i = 0 ; $i < 12 ; $i++)
              <div class="lg:w-1/4 md:w-1/2 p-4 w-full hover:border-2 rounded-xl">
                <a class="block relative h-48 rounded overflow-hidden">
                  <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="./image/oto.jpeg">
                </a>
                <div class="mt-4">
                  <h3 class="text-gray-500   text-[10px] mb-1 bg-red-300 w-fit p-1 text-white rounded-xl">CATEGORY</h3>
                  <h2 class="text-gray-900 title-font text-lg font-medium">The Catalyzer</h2>
                  <p class="mt-1">$16.00</p>
                  <div>
                    
                       <button class="w-full p-2 bg-gray-400 rounded-md text-white">Add To Cart </button>
                      
                   
                  </div>
                </div>
              </div>
             @endfor
         </div>
         
        
         
        </div>
      </div>
   </section>

   @include('customer.home.Component.Gallery')
@endsection