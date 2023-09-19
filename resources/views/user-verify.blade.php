@extends('layouts.app')

@section('content')
<main class="w-11/12 md:max-w-[767px] lg:max-w-[1000px] xl:max-w-[1200px] container mx-auto mt-10 md:mt-8 mb-10">
  <div class="flex justify-evenly items-center gap-10">
    <div class="w-11/12 md:w-1/2 lg:w-5/12">
      <div class="space-y-6 w-full">
        <div class="space-y-4">
          <h3 class="text-black font-semibold">Veriy mail</h3>
        </div>
        <form method="POST" action="{{ route('user_verify') }}" class="space-y-3">@csrf
          <div class="">
            <label for="" class="font-medium" required>Email</label>
            <input name="username" type="text" class="input-class">
          </div>
          <div>
            <button type="submit" class="bg-button rounded-xl text-white py-2 px-4 w-full">Verify</button>
          </div>
        </form>
        <p class="font-roboto text-center">already have an account? <a href="{{route('home')}}" class="text-[#008D96] underline">Sign In</a>
        </p>
      </div>
    </div>
  </div>
</main>
@endsection