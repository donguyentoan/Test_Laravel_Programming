<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Product List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap"
        rel="stylesheet" />
 
    <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.5.x/dist/component.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    <script src="/build/js/app.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    
</head>


<body>
    <div class="div flex">
        <div class="w-1/7">
            @include('admin.layout.slider')
        </div>
        <div class="main-content w-full  ">
           
            <section class="section ">
               

                <div class="flex flex-wrap my-4">
                    <div class=" sm:w-1/2 lg:w-1/4 p-2">
                        <div class="w-full bg-white rounded-lg shadow-md flex">
                            <div class=" w-1/3 m-6 flex items-center justify-center h-16 bg-blue-500 text-white rounded-lg">
                                <i class="fas fa-file-alt text-3xl"></i>
                            </div>
                            <div class="p-4">
                                <div class="text-gray-600 font-bold">
                                    Total Quizzes
                                </div>
                                <div class="text-2xl font-semibold">
                                    7
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4 p-2 ">
                        <div class="bg-white rounded-lg shadow-md flex">
                            <div class=" w-1/3 m-6 flex items-center justify-center h-16 bg-yellow-500 text-white rounded-lg">
                                <i class="fas fa-clipboard-check text-3xl"></i>
                            </div>
                            <div class="p-4">
                                <div class="text-gray-600 font-bold">
                                    Active Quizzes
                                </div>
                                <div class="text-2xl font-semibold">
                                    7
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4 p-2">
                        <div class="bg-white rounded-lg shadow-md flex">
                            <div class=" w-1/3 m-6 flex items-center justify-center h-16 bg-blue-400 text-white rounded-lg">
                                <i class="fas fa-users text-3xl"></i>
                            </div>
                            <div class="p-4">
                                <div class="text-gray-600 font-bold">
                                    Total Students
                                </div>
                                <div class="text-2xl font-semibold">
                                    1
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/4 p-2">
                        <div class="bg-white rounded-lg shadow-md flex">
                            <div class="  w-1/3 m-6 flex items-center justify-center h-16 bg-green-500 text-white rounded-lg">
                                <i class="fas fa-user-check text-3xl"></i>
                            </div>
                            <div class="p-4">
                                <div class="text-gray-600 font-bold">
                                    Total Passed Students
                                </div>
                                <div class="text-2xl font-semibold">
                                    1
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="section-body ">

                    <section class="bg-white rounded-lg shadow-md my-4">
                        <div class="p-6">
                            <form action="/admin/quizzes" method="get" class="flex flex-wrap mb-0">
                                <div class="w-full md:w-1/4 p-2">
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2">Search</label>
                                        <input type="text" class="form-input w-full border-2 p-2 rounded-md" name="title" value="" />
                                    </div>
                                </div>

                                <div class="w-full md:w-1/4 p-2">
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2">Start Date</label>
                                        <input type="date" id="fsdate" class="border-2 p-2 rounded-md form-input w-full text-center" name="from" value="" placeholder="Start Date" />
                                    </div>
                                </div>

                                <div class="w-full md:w-1/4 p-2">
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2">End Date</label>
                                        <input type="date" id="lsdate" class="border-2 p-2 rounded-md form-input w-full text-center" name="to" value="" placeholder="End Date" />
                                    </div>
                                </div>

                             

                                <div class="w-full md:w-1/4 p-2">
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2">Instructor</label>
                                        <select name="webinar_ids[]" class="border-2 p-2 rounded-md form-select w-full" placeholder="Search classes"></select>
                                    </div>
                                </div>

                               

                                <div class="w-full md:w-1/4 p-2">
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-bold mb-2">Status</label>
                                        <select name="statue" class="border-2 p-2 rounded-md form-select w-full">
                                            <option value="">All Statuses</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Disable</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="w-full md:w-1/4 p-3 flex items-center justify-end">

                                    <button type="submit" class="btn bg-red-500 text-white  btn-primary w-full p-2 rounded-md">Show Results</button>
                                </div>
                            </form>
                        </div>
                    </section>
                    <div class="row">
                        <a class="bg-red-500 p-2 text-white " href="/addProduct">Thêm Sản Phẩm </a>
                        <div class="w-full">
                            
                            <div class="card">
                                
                                <div class="card-body bg-white">
                                  
                                    <div class="table-responsive pb-4 pt-1">
                                        
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th class="text-left w-1/6 p-3">Image</th>
                                                    <th class="text-left w-1/6 p-3">Name</th>
                                                    <th class="text-center w-1/6">Manufacturer</th>
                                                    <th class="text-center w-1/6">Model</th>
                                                    <th class="text-center w-1/7">Engine_capacity</th>
                                                    <th class="text-center w-1/6">Price</th>
                                                    <th class="text-center w-1/6">Status</th>
                                                    <th class="text-center w-1/6">Action</th>
                                                   
                      

                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                                @foreach($products as $value)
                                                    <tr  class="bg-white even:bg-gray-100">
                                                        <td class="text-left">
                                                            <img class="w-20 h-20" src="/upload/{{$value->image}}" alt="">
                                                        </td>
                                                        <td class="text-left">{{$value->name}}</td>
                                                        <td class="text-center">
                                                       
                                                            <span class="text-primary text-xs">{{$value->manufacturer}}</span>
                                                        </td>
                                                        <td class="text-center">{{$value->model}}</td>
                                                        <td class="text-center">
                                                            {{$value->engine_capacity}} 
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="text-success">{{$value->price}}</span>
                                                        </td>
                                                        <td class="text-center">
                                                            @if($value->is_active == 0)
                                                            <span class="text-success text-red-400 font-bold">Inactive</span>
                                                            @else
                                                            <span class="text-success text-green-400 font-bold">Active</span>
                                                            @endif
                                                           
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="flex justify-center items-center">
                                                                <a href="/dashboard/product/edit/{{$value->id}}" class="btn-transparent btn-sm text-primary pr-2" title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a  href="/dashboard/product/delete/{{$value->id}}" class="btn-transparent text-primary btn-sm" title="Delete">
                                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card-footer text-center">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
    
</body>


</html>