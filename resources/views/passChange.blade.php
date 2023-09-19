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
          <div class="w-full md:w-3/4 space-y-10 ">
            <form action="{{route('passChangePost')}}" method="POST" class="space-y-8  py-12 px-4 md:px-8 lg:px-16 shadow-custom">@csrf
              <p class="font-semibold ">My Account</p>
              <div class="flex flex-col md:flex-row justify-around items-start md:items-center w-full">
                <label for="" class="w-60 font-medium">Current Password</label>
                <input type="password" class="input-class w-full  md:w-[500px]"name="current_password" placeholder="**********">
              </div>
              <div class="flex flex-col md:flex-row justify-around items-start md:items-center w-full">
                <label for="" class="w-60 font-medium">New Password</label>
                <input type="password" class="input-class w-full  md:w-[500px]" name="new_password" placeholder="**********">
              </div>
              <div class="flex flex-col md:flex-row justify-around items-start md:items-center w-full">
                <label for="" class="w-60 font-medium">Confirm Password</label>
                <input type="password" class="input-class w-full  md:w-[500px]" name="new_password_conf" placeholder="**********">
              </div>
              <div class="text-right">
                <button class="bg-button rounded-xl text-white py-3 px-4 w-40 mr-20 fWIMV">Save</button>
              </div>
            </form>
          </div>
            
        </div>
    </main>
@endsection