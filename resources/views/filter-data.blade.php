@extends('layouts.app')

@section('content')
    <main class="container mx-auto my-10">

        {{-- Search Zip Code toggle show Div --}}
        <!-- The modal -->
        <div id="myModal" class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-900 bg-opacity-50 z-50 hidden">
            <div class="bg-white rounded-lg p-8 shadow-md w-[30%] h-[25%] m-auto inset-0 relative mt-[15%]">
                <button id="closeModal" class="absolute top-0 right-0 m-3 text-gray-500 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="text-center mt-8">
                    <p class="text-lg font-semibold mb-4">Click Yes to Delete the Data or click No</p>
                    <div class="flex justify-center">
                    <button id="modalYes" class="bg-green-500 hover:bg-green-700 text-white font-bold rounded-md px-4 py-2 mx-2">Yes</button>
                    <button id="modalNo" class="bg-red-500 hover:bg-red-700 text-white font-bold rounded-md px-4 py-2 mx-2">No</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="myModaldel" class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-900 bg-opacity-50 z-50 hidden">
            <div class="bg-white rounded-lg p-8 shadow-md w-[30%] h-[25%] m-auto inset-0 relative mt-[15%]">
                <button id="closeModaldel" class="absolute top-0 right-0 m-3 text-gray-500 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="text-center mt-8">
                    <p class="text-lg font-semibold mb-4">Do you really want to delete all Data?</p>
                    <div class="flex justify-center">
                    <button id="modalYesdel" class="bg-green-500 hover:bg-green-700 text-white font-bold rounded-md px-4 py-2 mx-2">Yes</button>
                    <button id="modalNodel" class="bg-red-500 hover:bg-red-700 text-white font-bold rounded-md px-4 py-2 mx-2">No</button>
                    </div>
                </div>
            </div>
        </div>  
        <div id="myModaldel1" class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-900 bg-opacity-50 z-50 hidden">
            <div class="bg-white rounded-lg p-8 shadow-md w-[30%] h-[25%] m-auto inset-0 relative mt-[15%]">
                <button id="closeModaldel1" class="absolute top-0 right-0 m-3 text-gray-500 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="text-center mt-8">
                    <p class="text-lg font-semibold mb-4">Click Yes to Delete All Data or click No</p>
                    <div class="flex justify-center">
                    <button id="modalYesdel1" class="bg-green-500 hover:bg-green-700 text-white font-bold rounded-md px-4 py-2 mx-2">Yes</button>
                    <button id="modalNodel1" class="bg-red-500 hover:bg-red-700 text-white font-bold rounded-md px-4 py-2 mx-2">No</button>
                    </div>
                </div>
            </div>
        </div>  


        <div id="myContainer" class="shadow-custom pl-8 pt-8 pr-8 pb-8 flex flex-col rounded space-y-3 h-fit mb-8 pb-5 hidden"
            style=" width: 100%; ">
            <label class="text-gray-600 text-sm font-semibold">Type Zip Code:</label>
            <form action="{{ route('location') }}" method="POST">@csrf
                <input id="location" name="location" type="text" placeholder="Enter Zip Code" required
                    class="py-2 w-full px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><button
                    class="bg-green-300 hover:bg-green-400 text-gray-600 mt-2 font-bold py-2 px-4 rounded-md shadow-md">Enter</button>
            </form>
        </div>
        @if (Session::has('upload_success'))
            <small class="block text-center text-green-500 mt-5 mb-5">{{ Session::get('upload_success') }}</small>
        @endif
        @if (Session::has('error_in_request'))
            <small class="block text-center text-red-500 mt-5 mb-5">{{ Session::get('error_in_request') }}</small>
        @endif

        {{-- Info/Main Container --}}


        <div class="flex justify-between items-start">
            <div class="shadow-custom pt-8 pb-8 flex flex-col rounded space-y-3 h-fit"
                style=" width: 100%; ">


                {{-- Search Zip & other Buttons  --}}


                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-2 px-2 md:px-0" style="padding-left: 2rem; padding-right: 2rem;">
                    <div class="relative fWIMV" style="width: 100%;">
                        <button id="myButton" class="bg-gradient text-gray-500 font-bold py-2 px-4 rounded">Search Zip
                            Code</button>
                        @if (!Session::has('csvready'))
                            <form id="all_del" class='ml-2 float-right' action="{{ route('location') }}" method="POST">@csrf
                                <input id="dataDrop" name="dataDrop" type="text" class="hidden" value='deleteall'>
                                <button class="all_del_btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md shadow-md">Delete All Data</button>
                            </form>
                            <a href="{{ route('AllexportCsv')}}"
                                class="float-right bg-green-300 hover:bg-green-400 text-gray-600 font-bold py-2 px-4 rounded"
                                download>Download As CSV</a>

                                    {{-- Form for  selecting data and adding to list --}}

                            <form id="list-form" method="post" action="{{ route('record-selected') }}" class="float-right flex ">
                                @csrf


                                <input name="list-name" placeholder="Enter New List Name"
                                class="border pl-3 h-10 mr-3 rounded-lg">
                            {{-- </input> --}}
                            <input name="listsubmit" onclick="changeFormAttributesForCreateList()" type="submit" value="Create"
                            class="border w-max px-2 text-white font-bold h-10 mr-3 rounded-lg bg-slate-400  hover:bg-slate-300 hover:cursor-pointer">

                            {{-- <input type="checkbox" name="selected[]" value="{{ $item->id }}"> --}}

                            </form>
                            <form id="list-form-add" method="post" action="{{ route('record-selected') }}" class="float-right flex ">@csrf
                            {{-- </input> --}}
                            
                            <div class="relative inline-flex mr-3">
                                <select class="border border-gray-300 bg-white rounded-md px-4 py-2 pr-8 w-48 appearance-none focus:outline-none focus:border-blue-500" name="add_data_to_list">
                                  <option value="" disabled selected>Select a List</option>
                                  @foreach ($post_list as $list)
                                    <option value="{{ $list->id }}">{{ $list->name }}</option>
                                  @endforeach
                                </select>
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  class="h-5 w-5 text-gray-600 absolute top-1/2 right-2 transform -translate-y-1/2 pointer-events-none"
                                  viewBox="0 0 20 20"
                                  fill="currentColor"
                                >
                                  <path
                                    fill-rule="evenodd"
                                    d="M7.293 8.293a1 1 0 011.414 0L10 9.586l1.293-1.293a1 1 0 111.414 1.414l-2 2a1 1 0 01-1.414 0l-2-2a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                  />
                                </svg>
                              </div>
                              
                            <input id="addlistbtm" name="listsubmit" onclick="changeFormAttributes()" type="submit" value="Add Data to List"
                            class="border w-max px-2 text-white font-bold h-10 mr-3 rounded-lg bg-slate-400  hover:bg-slate-300 hover:cursor-pointer">

                            {{-- <input type="checkbox" name="selected[]" value="{{ $item->id }}"> --}}

                            </form>
                        @endif






                        @if (Session::has('csvready'))
                            <a href="/filter-data"
                                class="float-right bg-blue-300 hover:bg-blue-400 text-gray-600 font-bold py-2 px-4 rounded ml-2">Clear
                                Search</a>
                            <a href="<?php echo asset('storage/resumes/' . Session::get('csvready')); ?>"
                                class="float-right bg-green-300 hover:bg-green-400 text-gray-600 font-bold py-2 px-4 rounded"
                                download>Download As CSV</a>
                        @endif
                    </div>
                </div>

                <div class='partgt '>


                    {{-- Table Head --}}


                    <div class="partgt_stgt flex justify-between items-center shadow-custom p-4 text-button text-xs gap-8">
                        {{-- last engagement date --}}
                        <div class="w-1/4 text-righ flex items-center">
                            <span class="sdc-last_engagement_date <?php if (!Session::has('csvready')) {
                                echo 'sort-by';
                            } ?> asc cursor-default"
                                data-sort="last_engagement_date">Last Engagement Date</span>
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
                        {{-- salary --}}
                        <div class="w-1/4 text-righ flex items-center">
                            <span class="sdc-salary <?php if (!Session::has('csvready')) {
                                echo 'sort-by';
                            } ?> desc cursor-default"
                                data-sort="salary">Salary</span>
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
                        {{-- Notes --}}
                        <div class="w-1/4 text-righ flex items-center">
                            <span class="sdc-notes
            <?php if (!Session::has('csvready')) {
                echo 'sort-by';
            } ?>
             desc cursor-default"
                                data-sort="notes">Notes</span>
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
                    @if (empty($data_for_filter[0]))
                        <small class="block text-center text-red-500 mt-5">No Data Found</small>
                    @endif




                    @foreach ($data_for_filter as $data)
                        <div class="sfc">
                            <div class='sfc_pagi relative' style="display: none;">
                                <input class="postinpcls absolute  -left-5 top-[50%] -translate-y-[50%] w-4 h-4 hover:cursor-pointer dynamic-checkbox" type="checkbox" name="selected[]" value="{{ $data->id}}">
                                <form action="{{ route('update') }}" method="POST">@csrf
                                    <div class="flex cursor-default justify-between items-center px-4 py-5 border-b border-b-[#A7A7A7] gap-4">
                                        {{-- Last Engagement --}}
                                        <div class="w-1/4 text-righ">
                                            <input id="last_engagement_date" name="last_engagement_date" type="date"
                                                class="inp hidden border w-full text-xs py-1 px-2 border-gray-400"
                                                value='<?php echo $data->last_engagement_date; ?>'>
                                            <span
                                                class="inp sfc_last_engagement_date <?php if ($data->prev_comps_with_pos != '') {
                                                    echo '';
                                                } ?> text-xs font-bold"><?php if ($data->last_engagement_date == '') {
                                                    echo '<small class="block text-red-500 mt-5 mb-5">Not Available</small>';
                                                } else {
                                                    echo $data->last_engagement_date;
                                                } ?></span>
                                        </div>
                                        {{-- name --}}
                                        <div class="w-1/4 text-righ">
                                            <input id="name" name="name" type="text"
                                                class="inp hidden border w-full text-xs py-1 px-2 border-gray-400"
                                                value='<?php echo $data->name; ?>'>
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
                                            <input id="current_position" name="current_position" type="text"
                                                class="inp hidden border w-full text-xs py-1 px-2 border-gray-400"
                                                value='<?php echo $data->current_position; ?>'>
                                            <span class="inp sfc_title text-xs font-bold"><?php if ($data->current_position == '') {
                                                echo '<small class="block text-red-500 mt-5 mb-5">Not Available</small>';
                                            } else {
                                                echo $data->current_position;
                                            } ?></span>
                                        </div>
                                        {{-- company --}}
                                        <div class="w-1/4 text-righ">
                                            <input id="current_company" name="current_company" type="text"
                                                class="inp hidden border w-full text-xs py-1 px-2 border-gray-400"
                                                value='<?php echo $data->current_company; ?>'>
                                            <span class="inp sfc_company text-xs font-bold"><?php if ($data->current_company == '') {
                                                echo '<small class="block text-red-500 mt-5 mb-5">Not Available</small>';
                                            } else {
                                                echo $data->current_company;
                                            } ?></span>
                                        </div>
                                        {{-- avg stay --}}
                                        <div class="w-1/4 text-righ">
                                            <input id="average_stay" name="average_stay" type="text"
                                                class="inp hidden border w-full text-xs py-1 px-2 border-gray-400"
                                                value='<?php echo $data->average_stay; ?>'>
                                            <span
                                                class="inp sfc_average_stay text-xs font-bold"><?php if ($data->average_stay == '') {
                                                    echo '<small class="block text-red-500 mt-5 mb-5">Not Available</small>';
                                                } else {
                                                    echo $data->average_stay;
                                                } ?></span>
                                        </div>
                                        {{-- work exp --}}
                                        <div class="w-1/4 text-righ">
                                            <input id="work_experience" name="work_experience" type="text"
                                                class="inp hidden border w-full text-xs py-1 px-2 border-gray-400"
                                                value='<?php echo $data->work_experience; ?>'>
                                            <span
                                                class="inp sfc_work_experience text-xs font-bold"><?php if ($data->work_experience == '') {
                                                    echo '<small class="block text-red-500 mt-5 mb-5">Not Available</small>';
                                                } else {
                                                    echo $data->work_experience;
                                                } ?></span>
                                        </div>
                                        {{-- Salary --}}
                                        <div class="w-1/4 text-righ">
                                            <input id="salary" name="salary" type="text"
                                                class="inp hidden border w-full text-xs py-1 px-2 border-gray-400"
                                                value='<?php echo $data->salary; ?>'>
                                            <span class="inp sfc_salary text-xs font-bold"><?php if ($data->salary == '') {
                                                echo '<small class="block text-red-500 mt-5 mb-5">Not Available</small>';
                                            } else {
                                                echo $data->salary;
                                            } ?></span>
                                        </div>
                                        {{-- city --}}
                                        <div class="w-1/4 text-righ">
                                            <input id="city" name="city" type="text"
                                                class="inp hidden border w-full text-xs py-1 px-2 border-gray-400"
                                                value='<?php echo $data->city; ?>'>
                                            <span class="inp sfc_city text-xs font-bold"><?php if ($data->city == '') {
                                                echo '<small class="block text-red-500 mt-5 mb-5">Not Available</small>';
                                            } else {
                                                echo $data->city;
                                            } ?></span>
                                        </div>
                                        {{-- zip/location --}}
                                        <div class="w-1/4 text-righ">
                                            <input id="location" name="location" type="text"
                                                class="inp hidden border w-full text-xs py-1 px-2 border-gray-400"
                                                value='<?php echo $data->location; ?>'>
                                            <span class="inp sfc_location text-xs font-bold"><?php if ($data->location == '') {
                                                echo '<small class="block text-red-500 mt-5 mb-5">Not Available</small>';
                                            } else {
                                                echo $data->location;
                                            } ?></span>
                                        </div>
                                        {{-- notes --}}
                                        <div class="w-1/4 text-righ">
                                            <input id="notes" name="notes" type="text"
                                                class="inp hidden border w-full text-xs py-1 px-2 border-gray-400"
                                                value='<?php echo $data->notes; ?>'>
                                            <span class="inp sfc_notes text-xs font-bold"><?php if ($data->notes == '') {
                                                echo '<small class="block text-red-500 mt-5 mb-5">Not Available</small>';
                                            } else {
                                                echo $data->notes;
                                            } ?></span>
                                        </div>
                                        <div class="w-1/4 text-righ">
                                                <a href="{{route('admin_download',['id' => $data->id])}}">
                                              <svg xmlns="http://www.w3.org/2000/svg" height="2em" class="m-auto" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 232V334.1l31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31V232c0-13.3 10.7-24 24-24s24 10.7 24 24z"/></svg></a>
                                        </div>
                                        {{-- This button is for editng data --}}
                                        <button type="submit"
                                            class=" inp hidden data-del-btn bg-red-500 hover:bg-red-700 text-white font-bold rounded-md shadow-md"
                                            style="padding: 2px 5px;">Y</button>
                                        {{-- This form is for delteing data --}}
                                        <input id="id" name="id" type="text" class="hidden"
                                            value='<?php echo $data->id; ?>'>
                                    </div>
                                </form>
                                <div class="inp absolute -right-[20px] top-[50%] -translate-y-[55%]">
                                    <form id="form{{$data->id}}" action="{{ route('location') }}" method="POST"
                                        style="margin-left: -50px; margin-right: -15px">@csrf
                                        <input id="singleDataDrop" name="singleDataDrop" type="text" class="hidden"
                                            value='<?php echo $data->id; ?>'>
                                        <button data-form="{{$data->id}}" type="submit" class="data-del-btn data-del-btnx bg-red-500 hover:bg-red-700 text-white font-bold rounded-md shadow-md" style="padding: 2px 5px;">X</button>
                                    </form>
                                </div>
                                {{-- edit button --}}
                                <button class="editButton absolute -right-[25px] top-[50%] -translate-y-[55%]"><img src="https://cdn4.iconfinder.com/data/icons/basic-user-interface-elements/700/edit-change-pencil-256.png" class="w-7 pr-2" alt=""></button>
                                {{-- Details div --}}


                                <?php if($data->prev_comps_with_pos != ''){ ?>
                                <div class='spddcls hidden'
                                    style="border-radius: 5px; border: 1px solid gray; margin-top: -5px; background: white;">
                                    <div
                                        class="flex justify-between items-center shadow-custom p-4 text-button text-xs gap-8 w-[90%]">
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
                                    $ccsptr = count($csptr) - 2;
                                    echo '<div class="relative w-[90%] exp_parent_div"><form action="' . route('update_exp') . '" method="POST">';
                                    echo csrf_field();
                                    echo '<input name="id" type="text" class="hidden" value="'.$data->id.'">';
                                    for ($x = 0; $x <= $ccsptr; $x++) {
                                        $stxt = '<div class="flex justify-between items-center px-4 py-5 gap-4">';
                                        $csptri = explode('***', $csptr[$x]);
                                        $ccsptri = count($csptri) - 1;
                                        for ($y = 0; $y <= $ccsptri; $y++) {
                                            $stxt = $stxt . '<input name="'.$y.'[]" type="text" class="inp hidden border w-full text-xs py-1 px-2 border-gray-400" value="' . $csptri[$y] . '"><div class="w-1/4 text-righ inp"><span class="text-xs font-medium">' . $csptri[$y] . '</span></div>';
                                        }
                                        echo $stxt . '</div>';
                                    }
                                    echo '<button type="submit" class=" inp hidden bg-red-500 hover:bg-red-700 text-white font-bold rounded-md shadow-md absolute -right-[15px] z-10 top-[50%] -translate-y-[55%]" style="padding: 2px 5px;">Y</button><div class="exp_add_btn inp hidden cursor-pointer bg-red-500 hover:bg-red-700 text-white font-bold rounded-md shadow-md absolute -right-[54px] z-10 top-[50%] -translate-y-[55%]" style="padding: 2px 5px;">+</div></form><button class="editButton_exp absolute -right-[100px] z-10 top-[50%] -translate-y-[55%]"><img src="https://cdn4.iconfinder.com/data/icons/basic-user-interface-elements/700/edit-change-pencil-256.png" class="w-7 pr-2" alt=""></button></div>'
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
    </main>
<script>
    function delete_single_item(){
            const modal = $("#myModal");
            const closeModalBtn = $("#closeModal");
            const modalYesBtn = $("#modalYes");
            const modalNoBtn = $("#modalNo");
            let currentFormId = null;
            function openModal() {modal.show();}
            function closeModal() {modal.hide();}
            closeModalBtn.click(closeModal);
            modalNoBtn.click(closeModal);
            modalYesBtn.click(function () {
                var form = $("#form" + currentFormId);
                form.submit();
                // closeModal();
            });
            $(".data-del-btnx").each(function () {
                $(this).click(function (event) {
                    currentFormId = $(this).data("form");
                    event.preventDefault();
                    openModal();
                });
            });
            }
    function changeFormAttributes() {
        var formId = "list-form-add"; // Replace with the desired form ID
        var checkboxes = document.querySelectorAll(".dynamic-checkbox");

        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
            checkbox.setAttribute("form", formId);
            }
        });
    }
    function changeFormAttributesForCreateList() {
        var formIdList = "list-form"; // Replace with the desired form ID
        var checkboxes = document.querySelectorAll(".dynamic-checkbox");

        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
            checkbox.setAttribute("form", formIdList);
            }
        });
    }
    function runediButtonfunciton_exp(){
        var acc_exp = document.getElementsByClassName("editButton_exp");
            var i;

        for (i = 0; i < acc_exp.length; i++) {
            acc_exp[i].addEventListener("click", function() {
                $(this).parent().find(".inp").toggle();
            });
        }
    }
    function runediButtonfunciton(){
        var acc = document.getElementsByClassName("editButton");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                $(this).parent().find(".inp").toggle();
            });
        }
    }
    runediButtonfunciton();
    runediButtonfunciton_exp();
    function addInputToExtraData(){
        $(".exp_add_btn").on("click", function() {                
    const targetDivs = $(this).closest(".exp_parent_div").find(".flex.justify-between.items-center.px-4.py-5.gap-4");
    
    if (targetDivs.length > 0) {
        const lastTargetDiv = targetDivs.last(); // Get the last matching div
        
        const newContent = `
            <div class="inp flex justify-between items-center px-4 py-5 gap-4">
                <input name="0[]" type="text" class="inp hidden border w-full text-xs py-1 px-2 border-gray-400" value="" style="display: inline-block;">
                <input name="1[]" type="text" class="inp hidden border w-full text-xs py-1 px-2 border-gray-400" value="" style="display: inline-block;">
                <input name="2[]" type="text" class="inp hidden border w-full text-xs py-1 px-2 border-gray-400" value="" style="display: inline-block;">
                <input name="3[]" type="text" class="inp hidden border w-full text-xs py-1 px-2 border-gray-400" value="" style="display: inline-block;">
            </div>
        `;
        lastTargetDiv.after(newContent);
    }
    });
    }
    addInputToExtraData();
</script>
    <script>
        jQuery(document).ready(function() {
    // manupolate Total Experience behalf of duration start
            jQuery('.spddcls').each(function() {
                var totalMonths = 0;
                var inputcount = 0;
                jQuery(this).find('input[name="2[]"]').each(function() {
                    inputcount++;
                    var inputValue = jQuery(this).val();
                    var regex = /(\d+\s*year(s)?)?(?:\s*(\d+\s*month(s)?))?/;
                    var match = inputValue.match(regex);
                    if (match) {
                        var years = match[1] ? parseInt(match[1], 10) : 0;
                        var months = match[3] ? parseInt(match[3], 10) : 0;
                        totalMonths += years * 12 + months;
                    }
                });
                var average_stay_month = totalMonths / inputcount;
                var avr_years = Math.floor(average_stay_month / 12);
                var avr_remainingMonths = Math.floor(average_stay_month % 12);
                var avr_result = "";
                if (avr_years > 0) {
                    avr_result += avr_years + (avr_years === 1 ? " year" : " years");
                    if (avr_remainingMonths > 0) {
                        avr_result += " ";
                    }
                }
                if (avr_remainingMonths > 0) {
                    avr_result += avr_remainingMonths + (avr_remainingMonths === 1 ? " month" : " months");
                }
                var years = Math.floor(totalMonths / 12);
                var remainingMonths = totalMonths % 12;
                var result = "";
                if (years > 0) {
                    result += years + (years === 1 ? " year" : " years");
                    if (remainingMonths > 0) {
                        result += " ";
                    }
                }
                if (remainingMonths > 0) {
                    result += remainingMonths + (remainingMonths === 1 ? " month" : " months");
                }
                if(result != jQuery(this).parent().find('input[name="work_experience"]').val() || avr_result != jQuery(this).parent().find('input[name="average_stay"]').val()) {
                    jQuery(this).parent().find('input[name="work_experience"]').val(result);
                    jQuery(this).parent().find('input[name="average_stay"]').val(avr_result);
                    var forms_list = jQuery(this).parent().find('form');
                    forms_list[0].submit();
                }
            });
    // manupolate Total Experience behalf of duration end
    // show model when click on X button code start
            const modaldel = $("#myModaldel");
            const closeModalBtndel = $("#closeModaldel");
            const modalYesBtndel = $("#modalYesdel");
            const modalNoBtndel = $("#modalNodel");
            function openModaldel() {modaldel.show();}
            function closeModaldel() {modaldel.hide();}
            closeModalBtndel.click(closeModaldel);
            modalNoBtndel.click(closeModaldel);
            modalYesBtndel.click(function () {
                closeModaldel();
                openModaldel1();
            });
            $(".all_del_btn").click(function (event) {
                event.preventDefault();
                openModaldel();
            });
            const modaldel1 = $("#myModaldel1");
            const closeModalBtndel1 = $("#closeModaldel1");
            const modalYesBtndel1 = $("#modalYesdel1");
            const modalNoBtndel1 = $("#modalNodel1");
            function openModaldel1() {modaldel1.show();}
            function closeModaldel1() {modaldel1.hide();}
            closeModalBtndel1.click(closeModaldel1);
            modalNoBtndel1.click(closeModaldel1);
            modalYesBtndel1.click(function () {
                var formdel = $("#all_del");
                formdel.submit();
                closeModaldel1();
            });
    // show model when click on X button code end
            sessionStorage.removeItem('pgnval');
            jQuery('.spddtgtcls').click(function() {
                if (jQuery(this).parent().parent().parent().parent().find('.spddcls').length>0) {
                    jQuery(this).parent().parent().parent().parent().find('.spddcls, input.postinpcls, button.editButton, div.inp>form>button.data-del-btn').slideToggle();
                }
            })
        })
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
            runediButtonfunciton();
            runediButtonfunciton_exp();
            addInputToExtraData();
            delete_single_item();
        });
        jQuery(document).ready(function() {
            if (sessionStorage.hasOwnProperty('lastSortKey') && sessionStorage.hasOwnProperty('lastSortKeyOrder')) {
                jQuery('.sdc-' + sessionStorage.getItem('lastSortKey')).parent().find('svg').toggle();
                sortF(sessionStorage.getItem('lastSortKey'), sessionStorage.getItem('lastSortKeyOrder'));
                runediButtonfunciton();
                runediButtonfunciton_exp();
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
            var orcntvlprpg =
                50;
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
    <script>
        jQuery(document).ready(function() {
            const button = document.getElementById('myButton');
            const container = document.getElementById('myContainer');
            button.addEventListener('click', () => {
                container.classList.toggle('hidden');
            });
            delete_single_item();
            addInputToExtraData();
        });
    </script>
@endsection
