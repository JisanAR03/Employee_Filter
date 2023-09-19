@extends('layouts.app')

@section('content')
<main class="w-11/12 md:max-w-[767px] lg:max-w-[1000px] xl:max-w-[1200px] container mx-auto my-10">
  <h4 class="my-14">My Profile</h4>
  <button class="showSidebar btn-button flex md:hidden justify-start items-center mb-4">
    <svg   fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
    </svg> Show Sidebar </button>
  <div class="flex justify-center items-start gap-4 ">
    @include('layouts.nav_for_profile')
    <div class="w-full md:w-3/4 shadow-custom pl-8 pt-8 pr-8 pb-8 flex flex-col rounded space-y-3 h-fit">
      <div>
        <div class="flex justify-between items-center shadow-custom p-4 text-button text-xs">
        <div id="sort-icon" class="cursor-pointer">
            <span>Name</span>
            <span class="ml-2 float-right"></span>
        </div>
          <div class="flex justify-end md:justify-start items-center w-56 gap-8 sm:gap-16 md:gap-16 lg:gap-20">
            <div class="">
              <span>Download</span>
            </div>
          </div>
        </div>
        @if(empty($own_resume))<small class="block text-center text-red-500 mt-5">No Data Found</small>@endif
        <div id="table-body">
        @foreach($own_resume as $item)
        <div class="sfc_pagi flex justify-between items-center px-4 py-5 border-b border-b-[#A7A7A7] data-row" data-name="{{ $item->name }}">
          <div>
            <div class="flex justify-start items-center gap-3">
              {{-- <div class="w-9 h-9 bg-bodyText rounded-md"></div> --}}
              <div class="space-y-1">
                <p class="text-xs font-medium">{{$item->name}}</p>
                <div class="flex justify-start items-center gap-1 md:gap-4">
                  <div class="flex justify-center items-center">
                    <span class="text-xs text-bodyText">Title : {{$item->current_position}}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="flex justify-end md:justify-start gap-4 sm:gap-12 md:gap-16 lg:gap-20 w-56">
            <div class="flex justify-around items-center gap-3">
              <form action="{{ route('download') }}" method="POST">@csrf
                <input type="hidden" name="id" value="{{$item->id}}">
                <input type="hidden" name="owned" value="1">
                <button type="submit" class="text-button">
              <svg xmlns="http://www.w3.org/2000/svg" height="2em" class="m-auto" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 232V334.1l31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31V232c0-13.3 10.7-24 24-24s24 10.7 24 24z"/></svg></button></form>
            </div>
          </div>
          </div>
        @endforeach
        </div>
        <div class="pagination mt-5">
          <button class='pagi_b_prev'>«</button>
          <button class="pagi_b active">1</button>
          <button class="pagi_b_nxt">»</button>
        </div>
        {{-- <div class="pagination mt-5">
          @if ($own_resume->onFirstPage())
              <button disabled>&laquo;</button>
          @else
              <a href="{{ $own_resume->appends(request()->except('page'))->previousPageUrl() }}">&laquo;</a>
          @endif
      
          @php
              $start = max(1, $own_resume->currentPage() - 5);
              $end = min($start + 9, $own_resume->lastPage());
          @endphp
      
          @if ($start > 1)
              <span class="px-2">...</span>
          @endif
      
          @for ($i = $start; $i <= $end; $i++)
              @if ($i == $own_resume->currentPage())
                  <button class="active">{{ $i }}</button>
              @else
                  <a href="{{ $own_resume->appends(request()->except('page'))->url($i) }}">{{ $i }}</a>
              @endif
          @endfor
      
          @if ($end < $own_resume->lastPage())
              <span class="px-2">...</span>
          @endif
      
          @if ($own_resume->hasMorePages())
              <a href="{{ $own_resume->appends(request()->except('page'))->nextPageUrl() }}">&raquo;</a>
          @else
              <button disabled>&raquo;</button>
          @endif
      </div> --}}
      </div>
    </div>
  </div>
</main>
<script>
  $(document).ready(function () {
    let ascending = true; // Initially, set ascending sorting

    // Function to toggle sorting icons
    function toggleSortIcon() {
      const icon = $("#sort-icon");
      icon.html(
        ascending
          ? '<span>Name</span><span class="ml-2 float-right"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><path d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"/></svg></span>'
          : '<span>Name</span><span class="ml-2 float-right"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><path d="M182.6 137.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z"/></svg></span>'
      );
    }

    // Sort function for Name column
    function sortNameColumn() {
      const rows = $('.data-row');
      console.log(rows);
      rows.sort(function (a, b) {
        const nameA = $(a).data('name').toUpperCase(); // Assuming you have a data attribute 'data-name' for each row
        const nameB = $(b).data('name').toUpperCase();
        return ascending ? (nameA < nameB ? -1 : 1) : nameA > nameB ? -1 : 1;
      });
      $('#table-body').html(rows); // Assuming your table body has an ID "table-body"
    }

    // Initial sorting when the page loads
    sortNameColumn();
    toggleSortIcon();

    // Click event handler for sorting
    $('#sort-icon').click(function () {
      ascending = !ascending; // Toggle the sorting direction
      sortNameColumn();
      toggleSortIcon();
    });


    var orcntvlprpg = 10;
          if (jQuery('.data-row').length / orcntvlprpg > 0) {
              var pgnncntf = Math.floor(jQuery('.data-row').length / orcntvlprpg);
              var pgnncnts = (jQuery('.data-row').length % orcntvlprpg > 0) ? 1 : 0;
              var pgnncntr = (jQuery('.data-row').length % orcntvlprpg > 0) ? jQuery('.data-row').length % orcntvlprpg : 0;
              if (pgnncntf > 0) {
                  var nmbrofpgnbtn = pgnncntf + pgnncnts;
                  for (let i = 2; i <= nmbrofpgnbtn; i++) {
                      jQuery('.pagi_b_nxt').before("<button class='pagi_b'>" + i + "</button>")
                  }
              }
              pagiF(1, orcntvlprpg, true);
          }
          jQuery('.pagi_b').on('click', function() {
              var pgnval = jQuery(this).text();
              pagiF(pgnval, orcntvlprpg, false);
          })
          jQuery('.pagi_b_prev').click(function() {
              jQuery('.pagination>button.active').prev('.pagi_b').click();
          })
          jQuery('.pagi_b_nxt').click(function() {
              jQuery('.pagination>button.active').next('.pagi_b').click();
          })

          function pagiF(pgnval, orcntvlprpg, targ) {
          jQuery('.sfc_pagi').hide();
          if (targ == false) {
              jQuery('.pagination> button.active').removeClass('active');
              var pgnvalbtn = jQuery('button.pagi_b').filter(function() {
                  return jQuery(this).text() === pgnval;
              })
              pgnvalbtn.addClass('active');
          }
          for (let i = (pgnval - 1) * orcntvlprpg; i < (pgnval * orcntvlprpg); i++) {
              jQuery('.sfc_pagi').eq(i).show();
          }
          sessionStorage.setItem('pgnval', pgnval);
          sessionStorage.setItem('orcntvlprpg', orcntvlprpg);
      }
  });
</script>

@endsection