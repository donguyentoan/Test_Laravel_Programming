<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex flex-col justify-center font-[sans-serif] sm:h-screen p-4">
        <div class="max-w-md w-full mx-auto border border-gray-300 rounded-2xl p-8">
          <div class="text-center mb-12">
            <a href="javascript:void(0)"><img
              src="./image/logon.png" alt="logo" class='w-40 inline-block' />
            </a>
          </div>
  
          <form method="post" action="/register" >
            @csrf
            <div class="space-y-6">
              <div>
                <label class="text-gray-800 text-sm mb-2 block">Email</label>
                <input name="email" type="text" class="text-gray-800 bg-white border border-gray-300 w-full text-sm px-4 py-3 rounded-md outline-blue-500" placeholder="Enter email" />
              </div>
              @error('email')
                <div class="invalid-feedback text-red-500">
                    {{ $message }}
                </div>
                @enderror
              <div>
                <label class="text-gray-800 text-sm mb-2 block">Phone</label>
                <input name="phone" type="text" class="text-gray-800 bg-white border border-gray-300 w-full text-sm px-4 py-3 rounded-md outline-blue-500" placeholder="Enter phone" />
              </div>
              @error('phone')
              <div class="invalid-feedback text-red-500">
                  {{ $message }}
              </div>
              @enderror
              <div>
                <label class="text-gray-800 text-sm mb-2 block">Username</label>
                <input name="name" type="text" class="text-gray-800 bg-white border border-gray-300 w-full text-sm px-4 py-3 rounded-md outline-blue-500" placeholder="Enter usename" />
              </div>
              @error('name')
              <div class="invalid-feedback text-red-500">
                  {{ $message }}
              </div>
              @enderror
              <div>
                <label class="text-gray-800 text-sm mb-2 block">Password</label>
                <input name="password" type="password" class="text-gray-800 bg-white border border-gray-300 w-full text-sm px-4 py-3 rounded-md outline-blue-500" placeholder="Enter password" />
              </div>
              @error('password')
              <div class="invalid-feedback text-red-500">
                  {{ $message }}
              </div>
              @enderror
              <div>
                <label class="text-gray-800 text-sm mb-2 block">Confirm Password</label>
                <input name="cpassword" type="password" class="text-gray-800 bg-white border border-gray-300 w-full text-sm px-4 py-3 rounded-md outline-blue-500" placeholder="Enter confirm password" />
              </div>
  
             
            </div>
  
            <div class="!mt-12">
              <button type="submit" class="w-full py-3 px-4 text-sm tracking-wider font-semibold rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                Create an account
              </button>
            </div>
            <p class="text-gray-800 text-sm mt-6 text-center">Already have an account? <a href="/login" class="text-blue-600 font-semibold hover:underline ml-1"> Login here</a> </p>
          </form>
        </div>
      </div>
</body>
</html>