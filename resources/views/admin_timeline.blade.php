@extends('layouts.app')

@section('content')
<main class="w-11/12 md:max-w-[767px] lg:max-w-[1000px] xl:max-w-[1200px] container mx-auto mt-10 md:mt-8 mb-10">
  <div id="myModal" class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-900 bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg p-8 shadow-md w-[30%] h-[25%] m-auto inset-0 relative mt-[15%]">
        <button id="closeModal" class="absolute top-0 right-0 m-3 text-gray-500 hover:text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div class="text-center mt-8">
            <p class="text-lg font-semibold mb-4">Click Yes to Delete the List or click No</p>
            <div class="flex justify-center">
            <button id="modalYes" class="bg-green-500 hover:bg-green-700 text-white font-bold rounded-md px-4 py-2 mx-2">Yes</button>
            <button id="modalNo" class="bg-red-500 hover:bg-red-700 text-white font-bold rounded-md px-4 py-2 mx-2">No</button>
            </div>
        </div>
    </div>
  </div>
  <div class="flex justify-center">
    <div class="max-w-screen-lg">
      @foreach ($all_post as $item)
      @if($item->item_amount > 0)
      <div class="flex justify-center items-center gap-5 rounded-lg shadow-md p-3 mb-4 relative">
        <div class="flex justify-between w-full items-start gap-2">
          <div class="w-[15rem] sm:w-[30rem] md:w-[45rem] xl:w-[60rem]">
            <div class="space-y-1 mb-1 flex items-center justify-between">
              <a href="{{ route('admin_single', ['id' => $item->id]) }}" class="flex items-center gap-2">
                <h5 class="text-base">{{$item->name}}</h5>
                <p class="text-xs text-bodyText">{{$item->item_amount}} item</p>
              </a>
              <button class="text-red-500">
                <a class="text-red-500 font-bold text-xl del_list_btn" data-list="{{$item->id}}">×</a>
              </button>
            </div>
          </div>
        </div>
      </div>
      @endif
      @endforeach
    </div>
  </div>
</main>
<script>
  jQuery(document).ready(function() {
    const modal = $("#myModal");
    const closeModalBtn = $("#closeModal");
    const modalYesBtn = $("#modalYes");
    const modalNoBtn = $("#modalNo");
    let currentListId = null;
    function openModal() {modal.show();}
    function closeModal() {modal.hide();}
    closeModalBtn.click(closeModal);
    modalNoBtn.click(closeModal);
    modalYesBtn.click(function () {
      var deleteUrl = "{{ route('delete_single', ['id' => ':id']) }}";
      deleteUrl = deleteUrl.replace(':id', currentListId);
      $.get(deleteUrl)
        .done(function(response) {
          location.reload();
        })
        .fail(function(error) {
        });
      closeModal();
    });
    $(".del_list_btn").each(function () {
        $(this).click(function (event) {
            currentListId = $(this).data("list");
            event.preventDefault();
            openModal();
        });
    });
  });
</script>
@endsection
