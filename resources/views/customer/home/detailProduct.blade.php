@extends('customer.layout.app')
@section('content')
<section class="text-gray-600 body-font overflow-hidden">
  <div class="container px-5 py-24 mx-auto">
    <div class="lg:w-4/5 mx-auto flex flex-wrap">
      <div class="lg:w-1/2 w-full lg:pr-10 lg:py-6 mb-6 lg:mb-0">
        <h2 class="text-sm title-font text-gray-500 tracking-widest">{{$product->manufacturer}}</h2>
        <h1 class="text-gray-900 text-3xl title-font font-medium mb-4">{{$product->name}}</h1>
        <div class="flex mb-4">
          <a class="flex-grow text-indigo-500 border-b-2 border-indigo-500 py-2 text-lg px-1">Description</a>
          <a class="flex-grow border-b-2 border-gray-300 py-2 text-lg px-1">Reviews</a>
          <a class="flex-grow border-b-2 border-gray-300 py-2 text-lg px-1">Details</a>
        </div>
        <p class="leading-relaxed mb-4 text-xl font-bold">Thông Tin Kỹ Thuật</p>
        <div class="flex border-t border-gray-200 py-2">
          <span class="text-gray-500">Engine Capacity</span>
          <span class="ml-auto text-gray-900">{{$product->engine_capacity}}</span>
        </div>
        <div class="flex border-t border-gray-200 py-2">
          <span class="text-gray-500">model</span>
          <span class="ml-auto text-gray-900">{{$product->model}}</span>
        </div>
        <div class="flex border-t border-b mb-6 border-gray-200 py-2">
          <span class="text-gray-500">tags</span>
          <span class="ml-auto text-gray-900">{{$product->tags }}</span>
        </div>
        <div class="">
          <span class="title-font font-medium text-2xl text-gray-900">${{$product->price}}</span>
          <button onclick="addToMiniCart({{$product->id}}, {{$product->price}}, '{{$product->name}}', '{{$product->image}}')" class="addtocartButton w-full p-2 bg-gray-400 rounded-md text-white">
            Add To Cart
        </button>
        
         
        </div>
      </div>
      <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded border-2 p-2" src="/upload/{{$product->image}}">
    </div>
  </div>
</section>
@endsection