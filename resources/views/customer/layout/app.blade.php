<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body >
    @include('customer.layout.Header')

    <main>
        <div class="container mx-auto">
            @yield('content')
        </div>
        
      </main>

 
    @include('customer.layout.Footer')
    <script src="build/js/script.js"></script>
</body>
</html>