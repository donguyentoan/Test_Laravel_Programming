<aside class="flex-shrink-0 hidden w-64 bg-white border-r dark:border-primary-darker dark:bg-darker md:block">
  <div class="flex flex-col h-full">
    <!-- Sidebar links -->
    <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
      <!-- Dashboards links -->
      <div x-data="{ isActive: true, open: true}">
        <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
        <a
          href="#"
          @click="$event.preventDefault(); open = !open"
          class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
          :class="{'bg-primary-100 dark:bg-primary': isActive || open}"
          role="button"
          aria-haspopup="true"
          :aria-expanded="(open || isActive) ? 'true' : 'false'"
        >
          <span aria-hidden="true">
            <svg
              class="w-5 h-5"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
              />
            </svg>
          </span>
          <span class="ml-2 text-sm"> Dashboards </span>
          <span class="ml-auto" aria-hidden="true">
            <!-- active class 'rotate-180' -->
            <svg
              class="w-4 h-4 transition-transform transform"
              :class="{ 'rotate-180': open }"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </span>
        </a>
       
      </div>

      <!-- Components links -->
      <div x-data="{ isActive: false, open: false }">
        <!-- active classes 'bg-primary-100 dark:bg-primary' -->
        <a
          href="#"
          @click="$event.preventDefault(); open = !open"
          class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
          :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }"
          role="button"
          aria-haspopup="true"
          :aria-expanded="(open || isActive) ? 'true' : 'false'"
        >
          <span aria-hidden="true">
            <svg
              class="w-5 h-5"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
              />
            </svg>
          </span>
          <span class="ml-2 text-sm"> Components </span>
          <span aria-hidden="true" class="ml-auto">
            <!-- active class 'rotate-180' -->
            <svg
              class="w-4 h-4 transition-transform transform"
              :class="{ 'rotate-180': open }"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </span>
        </a>
        <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Components">
          <!-- active & hover classes 'text-gray-700 dark:text-light' -->
          <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
          <a
            href="/dashboard/product"
            role="menuitem"
            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"
          >
            Product
          </a>
          <a
            href="#"
            role="menuitem"
            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"
          >
            Categories
          </a>
          <a
            href="#"
            role="menuitem"
            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"
          >
            Roles
          </a>
         
        
          
        </div>
      </div>

      

     
    </nav>

   
  </div>
</aside>