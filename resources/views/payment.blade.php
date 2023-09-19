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
                  <h4 class="text-button">ELITE</h4>
                  <button class="bg-primary/50 text-sm text-[#A7A7A7] rounded-2xl px-3 py-2">100 credit</button>
                  <div class="space-y-4">
                    <p>Pay $100</p>
                  </div>
                </div>
                <p class="text-sm text-bodyText">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Animi, minima.</p>
              </div>
              <div class="hidden md:block space-y-2 w-1/4 "><a href="{{ route('stripe', ['amount' => 'payment']) }}">
                <button class="btn-button lg:48 xl:w-52 h-12">Buy Plan</button></a>
              </div>
            </div>
            {{-- <p class="text-sm text-bodyText flex justify-start items-center gap-2">Status :
              <button>
                <svg   fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 stroke-2 bg-button rounded-full p-1 ml-2 text-white">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
              </button>
              Active</p>
            <p class="text-sm text-bodyText">Renew subscription by <span class="font-medium text-[#4C4C4C]">January 26, 2024</span></p>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
              <div class="flex justify-start items-start gap-10 md:gap-4 xl:gap-10">
                <div class="">
                  <p class="text-sm text-bodyText">Payment Method</p>
                  <div class="flex justify-start items-center gap-2">
                    <img src="/src/img/visapro.png" alt="" srcset="" class="w-10 h-10">
                    <p class="text-bodyText font-semibold text-sm">****5702</p>
                  </div>
                </div>
                <div class="space-y-2">
                  <p class="text-sm text-bodyText">Expiry Date</p>
                  <p class="text-sm text-bodyText">12/2027</p>
                </div>
              </div>
              <button class="btn-white border-button w-full md:w-72 text-bodyText font-semibold py-3">Change payment Method</button>
            </div>
            <div class="md:hidden space-y-2 w-full flex flex-col">
              <button class="btn-button w-full  md:w-52 h-12">Change Plan</button>
              <button class="btn-white border-black w-full md:w-52 h-12 text-button font-semibold">Cancel Subscription</button>
            </div> --}}
          </div>
            
        </div>
    </main>
@endsection