@extends('customer.layout.app')

@section('content')
   <div class="pt-4 w-full   h-[500px] p-4">
      <img class="w-full h-full" src="./image/images.jpeg" alt="">
   </div>
      @include('customer.home.Component.Search')
   <section class="text-gray-600 body-font">
      <div class="container   mx-auto">
         <div class="pt-4">
            <h1 class="text-2xl py-6 text-blue-500 font-bold ">Ô TÔ</h1>
            <div class="flex flex-wrap -m-4">
               {{-- {{dd($products)}} --}}
             @foreach($products as $value)

             <?php $tagsArray = json_decode($value->tags, true); ?>
              <div class="lg:w-1/4 md:w-1/2 p-4 w-full hover:border-2 rounded-xl">
                <a href="/product/{{$value->id}}" class="block relative h-48 rounded overflow-hidden">
                  <img alt="ecommerce" class="object-cover object-center w-full h-full block" src="./upload/{{$value->image}}">
                </a>
                <div class="mt-4">
           
                  <h3 class="text-gray-500   text-[10px] mb-1 bg-red-300 w-fit p-1 text-white rounded-xl">{{$value->tags}}</h3>
               
                  <h2 class="text-gray-900 title-font text-lg font-medium">{{$value->name}}</h2>
                  <p class="mt-1">${{$value->price}}</p>
                  <div>
                    <button onclick="addToMiniCart({{$value->id}}, {{$value->price}}, '{{$value->name}}', '{{$value->image}}')" class="addtocartButton w-full p-2 bg-gray-400 rounded-md text-white">
                      Add To Cart
                  </button>
                  
                  </div>
                </div>
              </div>
             @endforeach
         </div>
        
         
        
         
        </div>
      </div>

      
   </section>

   @include('customer.home.Component.Gallery')
@endsection