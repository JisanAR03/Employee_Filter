@extends('layouts.app')

@section('content')
    <main class="w-11/12 md:max-w-[767px] lg:max-w-[1000px] xl:max-w-[1360px] container mx-auto my-10">
<div class="border w-[500px] p-2 mb-9">
    <h3 class="border-b border-gray-300 mb-2 pb-2 text-2xl">Lists</h3>
    <div class="">
        <p class="border-b pb-1 mb-1 hover:cursor-pointer hover:text-gray-500">Web Developer</p>
    </div>
    <div class="">
        <p class="border-b pb-1 mb-1 hover:cursor-pointer hover:text-gray-500">Web Developer</p>
    </div>
    <div class="">
        <p class="border-b pb-1 mb-1 hover:cursor-pointer hover:text-gray-500">Web Developer</p>
    </div>
</div>

{{-- <div class="border h-screen"></div> --}}


                    {{-- Table Head --}}


                    <div class="partgt_stgt flex justify-between items-center shadow-custom p-4 text-button text-xs gap-8">
                        {{-- last engage --}}
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
            <?php if (!Session::has('csvready')) {echo 'sort-by';} ?>
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
                    </div>
                    @if (empty($data_for_filter[0]))
                        <small class="block text-center text-red-500 mt-5">No Data Found</small>
                    @endif









    </main>
@endsection
