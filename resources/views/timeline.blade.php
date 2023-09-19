@extends('layouts.app')

@section('content')
<main class="w-11/12 md:max-w-[767px] lg:max-w-[1000px] xl:max-w-[1200px] container mx-auto mt-10 md:mt-8 mb-10">
  <div class="flex justify-center">
    <div class="max-w-screen-lg grid grid-cols-2 gap-4">
      @foreach ($all_post as $item)
      @if($item->item_amount > 0)
      <div class="flex justify-center items-center gap-5 rounded-lg shadow-md p-6">
        <div class="flex justify-start items-start gap-2">
          <div class="w-full xl:w-[400px]">
            <div class="space-y-1 border-b border-[#A7A7A7] pb-4 mb-1">
              <a href="{{ route('single', ['id' => $item->id]) }}">
              <h5 class="text-base">{{$item->name}}</h5></a>
              <p class="text-xs text-bodyText">{{$item->item_amount}} item</p>
            </div>
          </div>
        </div>
      </div>
      @endif
      @endforeach
    </div>
  </div>
</main>
@endsection