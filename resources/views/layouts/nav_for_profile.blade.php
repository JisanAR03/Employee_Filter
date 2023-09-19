<nav class="sidebar hidden md:block min-w-[270px] md:min-w-2/6 lg:w-2/5 xl:w-1/4 shadow-custom pt-8 fixed md:static top-0 left-0 z-40 bg-white h-screen md:h-full overflow-y-auto md:overflow-y-hidden">
    <ul>
      <li class="closeSidebar flex md:hidden justify-center items-center cursor-pointer text-sm font-bold text-red-600">
        <svg   fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg> Close
      </li>
      @if(session()->has('basicUser'))
      <li class="@if(request()->routeIs('profile')) shadow-custom bg-primary/10 border-r-8 border-r-primary @endif w-full">
        <a href="{{route('profile')}}" class="flex justify-start items-center gap-3 h-16 w-full px-8">
          <div class="">
            <svg   fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
            </svg>
          </div>
          <div>
            <p class="font-semibold">My Data</p>
            <p class="text-sm font-medium text-bodyText hidden md:block">view data you paid for</p>
          </div>
        </a>
      </li>
      <li class="@if(request()->routeIs('passChange')) shadow-custom bg-primary/10 border-r-8 border-r-primary @endif w-full">
        <a href="{{route('passChange')}}" class="flex justify-start items-center gap-3 h-16 w-full px-8">
          <div class="">
            <svg   fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
            </svg>
          </div>
          <div>
            <p class="font-semibold">Change Password</p>
            <p class="text-sm font-medium text-bodyText hidden md:block">Change your password</p>
          </div>
        </a>
      </li>
      <li class="hidden @if(request()->routeIs('credit')) shadow-custom bg-primary/10 border-r-8 border-r-primary @endif w-full">
        <a href="{{route('credit')}}" class="flex justify-start items-center gap-3 h-16 w-full px-8">
          <div class="">
            <svg   fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
            </svg>
          </div>
          <div>
            <p class="font-semibold">My Credit</p>
            <p class="text-sm font-medium text-bodyText hidden md:block">view remaining credit</p>
          </div>
        </a>
      </li>
      <li class="hidden @if(request()->routeIs('payment')) shadow-custom bg-primary/10 border-r-8 border-r-primary @endif w-full">
        <a href="{{route('payment')}}" class="flex justify-start items-center gap-3 h-16 w-full px-8">
          <div class="">
            <svg   fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
            </svg>
          </div>
          <div>
            <p class="font-semibold">Subscription</p>
            <p class="text-sm font-medium text-bodyText hidden md:block">add payment details</p>
          </div>
        </a>
      </li>
      @endif
    </ul>
  </nav>
