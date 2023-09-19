@extends('layouts.app')

@section('content')
<main class="w-11/12 md:max-w-[767px] lg:max-w-[1000px] xl:max-w-[1200px] container mx-auto my-10">
      <h4 class="my-14">My Profile</h4>
      <button class="showSidebar btn-button flex md:hidden justify-start items-center mb-4">
        <svg   fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        Show Sidebar
      </button>
        <div class="flex justify-between items-start md:w-11/12 lg:w-full gap-4">
          @include('layouts.nav_for_profile')
          <div class="w-full md:w-4/6 xl:w-3/4 shadow-custom rounded-xl p-8 xl:pr-14 space-y-5">
            
            <div class="flex justify-between items-center">
              <div class="space-y-4 w-full md:w-3/5 lg:w-3/4">
                <div class="flex justify-start items-center gap-3 xl:gap-7">
                  <h4 class="text-button">Credit</h4>
                  {{-- <button class="bg-primary/50 text-sm text-[#A7A7A7] rounded-2xl px-3 py-2">100 credit</button> --}}
                  <div class="space-y-4">
                    <p>{{$user_credit}} Left</p>
                  </div>
                </div>
                <p class="text-sm text-bodyText">you can use this credit to buy data</p>
              </div>
            </div>
          </div>
            
        </div>
    </main>
@endsection