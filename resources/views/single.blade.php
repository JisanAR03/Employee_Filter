@extends('layouts.app')

@section('content')
<?php function removeFourNotAvailable($element){return substr_count($element, "not available") !== 4;} ?>
<main class="w-11/12 md:max-w-[767px] lg:max-w-[1000px] xl:max-w-[1200px] container mx-auto my-10">
  <div class="mb-4">
    <form action="{{ route('single', ['id' => request()->route('id')]) }}" method="GET">
        <input
            type="text"
            name="search_data"
            class="px-4 py-2 border border-gray-300 rounded w-full"
            placeholder="Search resumes..."
            value=""
        >
        <button type="submit" class="mt-3 px-4 py-2 bg-gray-500 text-white rounded">Search</button>
    </form>
  </div>
  <div class="flex justify-between items-start">
    <div class="shadow-custom pt-8 pb-8 flex flex-col rounded space-y-3 h-fit"
        style=" width: 100%; ">
        <div class='partgt '>
            {{-- Table Head --}}
            <div class="partgt_stgt flex justify-between items-center shadow-custom p-4 text-button text-xs gap-8">
                {{-- name --}}
                <div class="w-1/4 text-righ flex items-center">
                    <span class="sdc-name <?php if (!Session::has('csvready')) {
                        echo 'sort-by';
                    } ?> asc cursor-default" data-sort="name">Name</span>
                    <?php if(!Session::has('csvready')) { ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="float-left asc_svg hidden">
                        <path d="M7 14l5-5 5 5z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="desc_svg">
                        <path d="M7 10l5 5 5-5z" />
                    </svg>
                    <?php } ?>
                </div>
                {{-- title --}}
                <div class="w-1/4 text-righ flex items-center">
                    <span class="sdc-title <?php if (!Session::has('csvready')) {
                        echo 'sort-by';
                    } ?> desc cursor-default" data-sort="title">Title</span>
                    <?php if(!Session::has('csvready')) { ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="float-left asc_svg hidden">
                        <path d="M7 14l5-5 5 5z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="desc_svg">
                        <path d="M7 10l5 5 5-5z" />
                    </svg>
                    <?php } ?>
                </div>
                {{-- company --}}
                <div class="w-1/4 text-righ flex items-center">
                    <span class="sdc-company <?php if (!Session::has('csvready')) {
                        echo 'sort-by';
                    } ?> desc cursor-default"
                        data-sort="company">Company</span>
                    <?php if(!Session::has('csvready')) { ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="float-left asc_svg hidden">
                        <path d="M7 14l5-5 5 5z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="desc_svg">
                        <path d="M7 10l5 5 5-5z" />
                    </svg>
                    <?php } ?>
                </div>
                {{-- avg stay --}}
                <div class="w-1/4 text-righ flex items-center">
                    <span class="sdc-average_stay <?php if (!Session::has('csvready')) {
                        echo 'sort-by';
                    } ?> desc cursor-default"
                        data-sort="average_stay">Average stay</span>
                    <?php if(!Session::has('csvready')) { ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="float-left asc_svg hidden">
                        <path d="M7 14l5-5 5 5z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="desc_svg">
                        <path d="M7 10l5 5 5-5z" />
                    </svg>
                    <?php } ?>
                </div>
                {{-- work exp --}}
                <div class="w-1/4 text-righ flex items-center">
                    <span class="sdc-work_experience <?php if (!Session::has('csvready')) {
                        echo 'sort-by';
                    } ?> desc cursor-default"
                        data-sort="work_experience">Total Experience</span>
                    <?php if(!Session::has('csvready')) { ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="float-left asc_svg hidden">
                        <path d="M7 14l5-5 5 5z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="desc_svg">
                        <path d="M7 10l5 5 5-5z" />
                    </svg>
                    <?php } ?>
                </div>
                {{-- city --}}
                <div class="w-1/4 text-righ flex items-center">
                    <span class="sdc-city <?php if (!Session::has('csvready')) {
                        echo 'sort-by';
                    } ?> desc cursor-default" data-sort="city">City</span>
                    <?php if(!Session::has('csvready')) { ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="float-left asc_svg hidden">
                        <path d="M7 14l5-5 5 5z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="desc_svg">
                        <path d="M7 10l5 5 5-5z" />
                    </svg>
                    <?php } ?>
                </div>
                {{-- zip code --}}
                <div class="w-1/4 text-righ flex items-center">
                    <span class="sdc-location <?php if (!Session::has('csvready')) {
                        echo 'sort-by';
                    } ?> desc cursor-default" data-sort="location">Zip
                        Code</span>
                    <?php if(!Session::has('csvready')) { ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="float-left asc_svg hidden">
                        <path d="M7 14l5-5 5 5z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="desc_svg">
                        <path d="M7 10l5 5 5-5z" />
                    </svg>
                    <?php } ?>
                </div>
                <div class="w-1/4 text-righ flex items-center">
                    <span class="sdc-notes">Download</span>
                </div>
            </div>
            @if(empty($resumes[0]))<small class="block text-center text-red-500 mt-5">No Data Found</small>@endif
            @foreach($resumes as $data)
                <div class="sfc">
                    <div class='sfc_pagi relative' style="display: none;">
                            <div class="flex cursor-default justify-between items-center px-4 py-5 border-b border-b-[#A7A7A7] gap-4">
                                {{-- name --}}
                                <div class="w-1/4 text-righ">
                                    <span
                                        class="inp spddtgtcls sfc_name <?php if ($data->prev_comps_with_pos != '') {
                                            echo 'cursor-pointer';
                                        } ?> text-xs font-bold"><?php if ($data->name == '') {
                                            echo '<small class="block text-red-500 mt-5 mb-5">Not Available</small>';
                                        } else {
                                            echo $data->name;
                                        } ?></span>
                                </div>
                                {{-- title --}}
                                <div class="w-1/4 text-righ">
                                    <span class="inp sfc_title text-xs font-bold"><?php if ($data->current_position == '') {
                                        echo '<small class="block text-red-500 mt-5 mb-5">Not Available</small>';
                                    } else {
                                        echo $data->current_position;
                                    } ?></span>
                                </div>
                                {{-- company --}}
                                <div class="w-1/4 text-righ">
                                    <span class="inp sfc_company text-xs font-bold"><?php if ($data->current_company == '') {
                                        echo '<small class="block text-red-500 mt-5 mb-5">Not Available</small>';
                                    } else {
                                        echo $data->current_company;
                                    } ?></span>
                                </div>
                                {{-- avg stay --}}
                                <div class="w-1/4 text-righ">
                                    <span
                                        class="inp sfc_average_stay text-xs font-bold"><?php if ($data->average_stay == '') {
                                            echo '<small class="block text-red-500 mt-5 mb-5">Not Available</small>';
                                        } else {
                                            echo $data->average_stay;
                                        } ?></span>
                                </div>
                                {{-- work exp --}}
                                <div class="w-1/4 text-righ">
                                    <span
                                        class="inp sfc_work_experience text-xs font-bold"><?php if ($data->work_experience == '') {
                                            echo '<small class="block text-red-500 mt-5 mb-5">Not Available</small>';
                                        } else {
                                            echo $data->work_experience;
                                        } ?></span>
                                </div>
                                {{-- city --}}
                                <div class="w-1/4 text-righ">
                                    <span class="inp sfc_city text-xs font-bold"><?php if ($data->city == '') {
                                        echo '<small class="block text-red-500 mt-5 mb-5">Not Available</small>';
                                    } else {
                                        echo $data->city;
                                    } ?></span>
                                </div>
                                {{-- zip/location --}}
                                <div class="w-1/4 text-righ">
                                    <span class="inp sfc_location text-xs font-bold"><?php if ($data->location == '') {
                                        echo '<small class="block text-red-500 mt-5 mb-5">Not Available</small>';
                                    } else {
                                        echo $data->location;
                                    } ?></span>
                                </div>
                                <div class="w-1/4 text-right">
                                  <form class='' action="{{ route('download') }}" method="POST">@csrf
                                    <input type="hidden" name="id" value="{{$data->id}}">
                                    <button type="submit" class="text-button">
                                  <svg xmlns="http://www.w3.org/2000/svg" height="2em" class="m-auto" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 232V334.1l31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31V232c0-13.3 10.7-24 24-24s24 10.7 24 24z"/></svg></button></form>
                                </div>
                            </div>
                        {{-- Details div --}}

                        <?php $csptr = explode('///', $data->prev_comps_with_pos); $csptr = array_filter($csptr, "removeFourNotAvailable"); if(!empty($csptr[0])){ ?>
                          <div class='spddcls hidden'
                              style="border-radius: 5px; border: 1px solid gray; margin-top: -5px; background: white;">
                              <div
                                  class="flex justify-between items-center shadow-custom p-4 text-button text-xs gap-8">
                                  <div class="w-1/4 text-righ">
                                      <span class="cursor-default">Title</span>
                                  </div>
                                  <div class="w-1/4 text-righ">
                                      <span class="cursor-default">Company</span>
                                  </div>
                                  <div class="w-1/4 text-righ">
                                      <span class="cursor-default">Duration</span>
                                  </div>
                                  <div class="w-1/4 text-righ">
                                      <span class="cursor-default">Dates Worked</span>
                                  </div>
                              </div>
                              <?php
                              $csptr = explode('///', $data->prev_comps_with_pos);
                              $csptr = array_filter($csptr, "removeFourNotAvailable");
                              $ccsptr = count($csptr) - 2;
                              for ($x = 0; $x <= $ccsptr; $x++) {
                                  $stxt = '<div class="flex justify-between items-center px-4 py-5 gap-4">';
                                  $csptri = explode('***', $csptr[$x]);
                                  $ccsptri = count($csptri) - 1;
                                  for ($y = 0; $y <= $ccsptri; $y++) {
                                      $stxt = $stxt . '<div class="w-1/4 text-righ"><span class="text-xs font-medium">' . $csptri[$y] . '</span></div>';
                                  }
                                  echo $stxt . '</div>';
                              }
                              ?>
                          </div>
                          <?php } ?>
                    </div>
                </div>
            @endforeach
            <div class="pagination mt-5">
                <button class='pagi_b_prev'>«</button>
                <button class="pagi_b active">1</button>
                <button class="pagi_b_nxt">»</button>
            </div>
        </div>
    </div>
    </div>
  </div>
</main>
<script>
  jQuery(document).ready(function() {
      jQuery('.spddtgtcls').click(function() {
          if (jQuery(this).parent().parent().parent().find('.spddcls').length>0) {
              jQuery(this).parent().parent().parent().find('.spddcls').slideToggle();
          }
      })
  })
</script>
  <script>
      jQuery(document).on('click', '.sort-by', function() {
          const sortKey = $(this).data('sort');
          jQuery(this).parent().find('svg').toggle();
          if (sessionStorage.hasOwnProperty('lastSortKey') && (sessionStorage.getItem('lastSortKey') !=
                  sortKey)) {
              jQuery('.sdc-' + sessionStorage.getItem('lastSortKey')).parent().find('.asc_svg').hide();
              jQuery('.sdc-' + sessionStorage.getItem('lastSortKey')).parent().find('.desc_svg').show();
          }
          if (!sessionStorage.hasOwnProperty(sortKey)) {
              sortF(sortKey, "ASC");
              sessionStorage.setItem(sortKey, "ASC");
          } else if (sessionStorage.getItem('lastSortKey') == sortKey) {
              if (sessionStorage.getItem(sortKey) == "ASC") {
                  sortF(sortKey, "DESC");
                  sessionStorage.setItem(sortKey, "DESC");
              } else if (sessionStorage.getItem(sortKey) == "DESC") {
                  sortF(sortKey, "ASC");
                  sessionStorage.setItem(sortKey, "ASC");
              }
          } else if (sessionStorage.getItem('lastSortKey') != sortKey) {
              sortF(sortKey, "ASC");
              sessionStorage.setItem(sortKey, "ASC");
          }
      });
      jQuery(document).ready(function() {
          if (sessionStorage.hasOwnProperty('lastSortKey') && sessionStorage.hasOwnProperty('lastSortKeyOrder')) {
              jQuery('.sdc-' + sessionStorage.getItem('lastSortKey')).parent().find('svg').toggle();
              sortF(sessionStorage.getItem('lastSortKey'), sessionStorage.getItem('lastSortKeyOrder'));
          }
      })

      function sortF(sortKey, sortC) {
          var srtarr = {};
          var nsht = '';
          for (let i = 0; i < (jQuery('.sfc').length); i++) {
              srtarr[`'${i}'`] = jQuery('.sfc').eq(i).find('div:first-child .sfc_' + sortKey).text();
          }
          var entries = Object.entries(srtarr);
          entries.sort(function(a, b) {
              if (sortC == "ASC") {
                  if (sortKey == 'location') {
                      var valueA = a[1];
                      var valueB = b[1];
                      if (valueA === valueB) {
                          return b[0] - a[0];
                      }
                      if (!isNaN(valueA) && !isNaN(valueB)) {
                          return Number(valueA) - Number(valueB);
                      }
                      return valueA.localeCompare(valueB, undefined, {
                          numeric: true,
                          sensitivity: 'base'
                      });
                  } else if (sortKey == 'average_stay' || sortKey == 'work_experience') {
                      var aValue = parseDuration(a[1]);
                      var bValue = parseDuration(b[1]);
                      return aValue - bValue;
                  } else {
                      return a[1].localeCompare(b[1], undefined, {
                          sensitivity: 'base'
                      });
                  }
              } else if (sortC == "DESC") {
                  if (sortKey == 'location') {
                      var valueA = a[1];
                      var valueB = b[1];
                      if (valueA === valueB) {
                          return a[0] - b[0];
                      }
                      if (!isNaN(valueA) && !isNaN(valueB)) {
                          return Number(valueB) - Number(valueA);
                      }
                      return valueB.localeCompare(valueA, undefined, {
                          numeric: true,
                          sensitivity: 'base'
                      });
                  } else if (sortKey == 'average_stay' || sortKey == 'work_experience') {
                      var aValue = parseDuration(a[1]);
                      var bValue = parseDuration(b[1]);
                      return bValue - aValue;
                  } else {
                      return b[1].localeCompare(a[1], undefined, {
                          sensitivity: 'base'
                      });
                  }
              }
          });
          var sortedArray = Object.fromEntries(entries);
          for (const key in sortedArray) {
              if (sortedArray.hasOwnProperty(key)) {
                  nsht += '<div class="sfc">' + jQuery('.sfc').eq(parseInt(key.replace(/'/g, ''))).html() + '</div>';
              }
          }
          jQuery('.partgt .sfc').remove();
          jQuery('.partgt .partgt_stgt').after(nsht);
          jQuery('.spddtgtcls').click(function() {
              if (jQuery(this).parent().parent().parent().parent().find('.spddcls').length>0) {
                  jQuery(this).parent().parent().parent().parent().find('.spddcls, input.postinpcls, button.editButton, div.inp>form>button.data-del-btn').slideToggle();
              }
          })
          sessionStorage.setItem('lastSortKey', sortKey);
          sessionStorage.setItem('lastSortKeyOrder', sortC);
          if (sessionStorage.hasOwnProperty('pgnval')) {
              pagiF(sessionStorage.getItem('pgnval'), sessionStorage.getItem('orcntvlprpg'), false);
          } else {
              pagiF(1, sessionStorage.getItem('orcntvlprpg'), true);
          }
      }

      function parseDuration(duration) {
          var match = duration.match(/(\d+)\s+(\w+)/);
          if (match) {
              var value = parseInt(match[1]);
              var unit = match[2].toLowerCase();
              if (unit === 'year' || unit === 'years') {
                  return value * 12;
              } else if (unit === 'month' || unit === 'months') {
                  return value;
              }
          }
          return 0;
      }
      jQuery(document).ready(function() {
          var orcntvlprpg = 50;
          if (jQuery('.sfc').length / orcntvlprpg > 0) {
              var pgnncntf = Math.floor(jQuery('.sfc').length / orcntvlprpg);
              var pgnncnts = (jQuery('.sfc').length % orcntvlprpg > 0) ? 1 : 0;
              var pgnncntr = (jQuery('.sfc').length % orcntvlprpg > 0) ? jQuery('.sfc').length % orcntvlprpg : 0;
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
  </script>
@endsection
