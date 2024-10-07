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
  
          <form>
            <div class="space-y-6">
              <div>
                <label class="text-gray-800 text-sm mb-2 block">Email Id</label>
                <input name="email" type="text" class="text-gray-800 bg-white border border-gray-300 w-full text-sm px-4 py-3 rounded-md outline-blue-500" placeholder="Enter email" />
              </div>
              <div>
                <label class="text-gray-800 text-sm mb-2 block">Password</label>
                <input name="password" type="password" class="text-gray-800 bg-white border border-gray-300 w-full text-sm px-4 py-3 rounded-md outline-blue-500" placeholder="Enter password" />
              </div>
            </div>
  
            <div class="!mt-12">
              <button type="button" class="w-full py-3 px-4 text-sm tracking-wider font-semibold rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                Login Account
              </button>
            </div>
            <p class="text-gray-800 text-sm mt-6 text-center">Already have an account? <a href="javascript:void(0);" class="text-blue-600 font-semibold hover:underline ml-1"><a class="text-blue-600 font-semibold hover:underline ml-1" href="/register">Register here</a> </a></p>
          </form>
        </div>
      </div>
</body>
</html>