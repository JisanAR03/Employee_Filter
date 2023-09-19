<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Resume;
use GuzzleHttp\Client;
use App\Models\ListData;
use App\Models\ListModel;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class EDMyJobController extends Controller
{
    public function developerlook_index(Request $request)
    {
        Session::forget('error_in_request');
        Session::forget('csvready');
        if (session()->has('username')) {
            $post_list = DB::table('lists')->get();
            $list_data = DB::table('list_datas')->get();
            foreach ($post_list as $list) {
                $list->data_count = $list_data->where('list_id', $list->id)->count();
            }
            if ($request->isMethod('post')) {
                if ($request->input('dataDrop')) {
                    DB::table('resumes')->delete();
                    return redirect()->route('home');
                }
                if ($request->input('singleDataDrop')) {
                    DB::table('resumes')->where('id', $request->input('singleDataDrop'))->delete();
                    return redirect()->route('filterData');
                }
                if ($request->input('location')) {
                    try {
                        $address = $request->input('location');
                        $backclient = new Client();
                        $zipcodereq = "https://www.zipcodeapi.com/rest/WVboucKB3k1LO78RjKIzS8Iib8nWurNyolwSyEUFF5v1Oawxs7iQsLt7PIs05OCO/radius.json/{$address}/10000/km";
                        $zipcoderesp = $backclient->request('GET', $zipcodereq);
                        $zipcoderesult = json_decode($zipcoderesp->getBody(), true);
                        $zipcoderesultlength = count($zipcoderesult['zip_codes']);
                        $zipcodersort;
                        for ($x = 0; $x < $zipcoderesultlength; $x++) {
                            $zipcodersort[$zipcoderesult['zip_codes'][$x]['zip_code']] = $zipcoderesult['zip_codes'][$x]['distance'];
                        }
                        asort($zipcodersort);
                        $matches = [];
                        $matches = DB::table('resumes')->whereIn('location', array_keys($zipcodersort))->orderByRaw("FIELD(location, " . implode(',', array_keys($zipcodersort)) . ")")->get();
                        $data_for_filter = $matches;
                        $csvarr = array(
                            array('Name', 'Title', 'Company', 'Avarage stay', 'Work experience', 'City', 'Zip code'),
                        );
                        foreach ($matches as $match) {
                            $sndrarr = array();
                            array_push($sndrarr, $match->name, $match->current_position, $match->current_company, $match->average_stay, $match->work_experience, $match->city, $match->location);
                            array_push($csvarr, $sndrarr);
                        }
                        $csvname = 'ZIP-' . $address . ' ' . Carbon::now()->toDateTimeString() . '.csv';
                        $srcsv = fopen(__DIR__ . '/../../../storage/app/public/resumes/' . $csvname, 'w');
                        foreach ($csvarr as $srcsvf) {
                            fputcsv($srcsv, $srcsvf);
                        }
                        $pagination = false;
                        Session::flash('csvready', $csvname);

                        return view('filter-data', compact('data_for_filter', 'pagination', 'post_list'));
                    } catch (\Exception $exception) {
                        $query = Resume::query();
                        if ($request->has('sort') && $request->has('order')) {
                            $sortKey = $request->input('sort');
                            $sortOrder = $request->input('order');
                            $prevSortKey = session('sort_key');
                            if ($sortOrder === 'asc') {
                                $sortOrder = 'asc';
                            } else {
                                $sortOrder = 'desc';
                            }
                            switch ($sortKey) {
                                case 'name':
                                    $query->orderBy('name', $sortOrder);
                                    break;
                                case 'title':
                                    $query->orderBy('current_position', $sortOrder);
                                    break;
                                case 'company':
                                    $query->orderBy('current_company', $sortOrder);
                                    break;
                                case 'average_stay':
                                    $query->orderByRaw("CAST(average_stay as UNSIGNED) " . $sortOrder . "");
                                    break;
                                case 'work_experience':
                                    $query->orderByRaw("CAST(work_experience as UNSIGNED) " . $sortOrder . "");
                                    break;
                                case 'city':
                                    $query->orderBy('city', $sortOrder);
                                    break;
                                case 'location':
                                    $query->orderByRaw("CAST(location as UNSIGNED) " . $sortOrder . "");
                                    break;
                            }
                            session(['sort_key' => $sortKey]);
                            session(['sort_order' => $sortOrder]);
                        } else {
                            $query->orderBy('name', 'asc');
                        }
                        $matches =  DB::table('resumes')->get();
                        $csvarr = array(
                            array('Name', 'Title', 'Company', 'Avarage stay', 'Work experience', 'City', 'Zip code'),
                        );
                        foreach ($matches as $match) {
                            $sndrarr = array();
                            array_push($sndrarr, $match->name, $match->current_position, $match->current_company, $match->average_stay, $match->work_experience, $match->city, $match->location);
                            array_push($csvarr, $sndrarr);
                        }
                        $csvname = 'all.csv';
                        $srcsv = fopen(__DIR__ . '/../../../storage/app/public/resumes/' . $csvname, 'w');
                        foreach ($csvarr as $srcsvf) {
                            fputcsv($srcsv, $srcsvf);
                        }
                        $data_for_filter = $query->paginate(1000000);
                        $data_for_filter->appends(request()->query());
                        $pagination = true;
                        Session::flash('error_in_request', 'Encountered error. try again');
                        return view('filter-data', compact('data_for_filter', 'pagination', 'post_list'));
                    }
                }
            } else {
                $query = Resume::query();
                if ($request->has('sort') && $request->has('order')) {
                    $sortKey = $request->input('sort');
                    $sortOrder = $request->input('order');
                    $prevSortKey = session('sort_key');
                    if ($sortOrder === 'asc') {
                        $sortOrder = 'asc';
                    } else {
                        $sortOrder = 'desc';
                    }
                    switch ($sortKey) {
                        case 'name':
                            $query->orderBy('name', $sortOrder);
                            break;
                        case 'title':
                            $query->orderBy('current_position', $sortOrder);
                            break;
                        case 'company':
                            $query->orderBy('current_company', $sortOrder);
                            break;
                        case 'average_stay':
                            $query->orderByRaw("CAST(average_stay as UNSIGNED) " . $sortOrder . "");
                            break;
                        case 'work_experience':
                            $query->orderByRaw("CAST(work_experience as UNSIGNED) " . $sortOrder . "");
                            break;
                        case 'city':
                            $query->orderBy('city', $sortOrder);
                            break;
                        case 'location':
                            $query->orderByRaw("CAST(location as UNSIGNED) " . $sortOrder . "");
                            break;
                    }
                    session(['sort_key' => $sortKey]);
                    session(['sort_order' => $sortOrder]);
                }
                // else{
                //     $query->orderBy('name', 'asc');
                // }
                $matches =  DB::table('resumes')->get();
                $csvarr = array(
                    array('Last Engagement Date','Name', 'Title', 'Company', 'Avarage stay', 'Work experience','Salary', 'City', 'Zip code','Notes'),
                );
                // dd($csvarr, $matches);
                foreach ($matches as $match) {
                    $sndrarr = array();
                    array_push($sndrarr, $match->name, $match->current_position, $match->current_company, $match->average_stay, $match->work_experience, $match->city, $match->location);
                    array_push($csvarr, $sndrarr);
                }
                // $csvname = 'all.csv';
                // $srcsv = fopen(__DIR__ . '/../../../storage/app/public/resumes/' . $csvname, 'w');
                // foreach ($csvarr as $srcsvf) {
                //     fputcsv($srcsv, $srcsvf);
                // }
                $data_for_filter = $query->paginate(1000000);
                $data_for_filter->appends(request()->query());
                $pagination = true;
                // dd($data_for_filter);
                return view('filter-data', compact('data_for_filter', 'pagination','post_list'));
            }
        } else {
            return redirect()->route('home')->with('error', 'Please login first');
        }
    }
    public function update(Request $request){


            DB::table('resumes')->where('id', $request->input('id'))
            ->update([
                'last_engagement_date' =>$request->input('last_engagement_date'),
                'name' => $request->input('name'),
                'current_position' =>$request->input('current_position'),
                'current_company' =>$request->input('current_company'),
                'average_stay' =>$request->input('average_stay'),
                'work_experience' =>$request->input('work_experience'),
                'salary' =>$request->input('salary'),
                'location' =>$request->input('location'),
                'notes' =>$request->input('notes'),
                'city' =>$request->input('city')


            ]);

            // $data = $request->input();
            // dd($data);

            return redirect()->route('filterData');

    }

    public function showlist(Request $request) {
        if ($request->has('add_data_to_list')) {
            $listid = $request->input('add_data_to_list');
            $listData = ListData::where('list_id', $listid)->get();
            $resumeIds = $listData->pluck('resume_id');
            $selectedIds = $request->input('selected');
            if($selectedIds != null){
                foreach ($selectedIds as $record) {
                    if(!$resumeIds->contains($record)){
                        ListData::create([
                            'list_id' => $listid,
                            'resume_id' => $record
                        ]);
                    }
                }
                return redirect()->back()->with('success', 'Data added to list successfully');
            }
            else{
                return redirect()->back()->with('error', 'Please select at least one record');
            }
            
        }
        $selectedIds = $request->input('selected');
        if($selectedIds != null){
            $listName = $request->input('list-name');
            ListModel::create(['name' => $listName]);

        $listInfo = ListModel::where('name', $listName)->select('id')->orderBy('created_at', 'desc')->first();


        $listId = $listInfo->id;
        foreach ($selectedIds as $record) {
            ListData::create([
                'list_id' => $listId,
                'resume_id' => $record

            ]);
        }
        return redirect()->back();
        }
        else{
            return redirect()->back()->with('error', 'Please select at least one record');
        }




    }

    public function developerlook_delete_list(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->input('list_id')) {
                DB::table('lists')->where('id', $request->input('list_id'))->delete();
                return redirect()->route('filterData');
            }
        }
    }
    public function update_exp(Request $request)
    {
        $formData = $request->only(['0', '1', '2', '3']);
        $titles = $formData[0];
        $companies = $formData[1];
        $durations = $formData[2];
        $dates_worked = $formData[3];
        $the_data = "";

        foreach ($titles as $index => $title) {
            $title = isset($title) ? $title : "not available";
            $company = isset($companies[$index]) ? $companies[$index] : "not available";
            $duration = isset($durations[$index]) ? $durations[$index] : "not available";
            $date_worked = isset($dates_worked[$index]) ? $dates_worked[$index] : "not available";

            $the_data .= $title . "***" . $company . "***" . $duration . "***" . $date_worked . "///";
        }
        $resume_id = $request->input('id');
        DB::table('resumes')->where('id', $resume_id)->update(['prev_comps_with_pos' => $the_data]);
        return redirect()->route('filterData');
    }


    public function developerlook_all_list(){
        if (session()->has('username')){
            $all_post = ListModel::all();
            foreach($all_post as $post){
                $listData = ListData::where('list_id', $post->id)->get();
                $post->item_amount = count($listData);
            }
            return view('admin_timeline', compact('all_post'));
        }
        else{
            return redirect()->route('home')->with('error', 'Please login as admin first');
        }
    }
    public function developerlook_delete_single(Request $request,$id){
        if(session()->has('username')){
            ListModel::where('id', $id)->delete();
            ListData::where('list_id', $id)->delete();
            return redirect()->route('all_list');
        }
        else{
            return redirect()->route('home')->with('error', 'Please login as admin first');
        }
    }
    public function developerlook_exportToCsv(Request $request,$id){
        if (session()->has('username')) {
            $listData = ListData::where('list_id', $id)->get();
            $resumeIds = $listData->pluck('resume_id');
            $resumes = Resume::whereIn('id', $resumeIds)->get();
            $fileName = 'resume_data.csv';
            $file = fopen('php://temp', 'w');
            fputcsv($file, [
                'Last Engagement Date',
                'Name',
                'Title',
                'Company',
                'Average Stay',
                'Work Experience',
                'Salary',
                'City',
                'Zip Code',
                'Notes',
            ]);
            foreach ($resumes as $resume) {
                fputcsv($file, [
                    $resume->last_engagement_date,
                    $resume->name,
                    $resume->current_position,
                    $resume->current_company,
                    $resume->average_stay,
                    $resume->work_experience,
                    $resume->salary,
                    $resume->city,
                    $resume->location,
                    $resume->notes,
                ]);
            }
            rewind($file);
            $csv = stream_get_contents($file);
            fclose($file);
            return Response::make($csv, 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ]);
        }
        else{
            return redirect()->route('home')->with('error', 'Please login as admin first.');
        }
    }
    public function developerlook_exportToCsvAll(){
        if (session()->has('username')) {
            $resumes = Resume::all();
            $fileName = 'All_resume_data.csv';
            $file = fopen('php://temp', 'w');
            fputcsv($file, [
                'Last Engagement Date',
                'Name',
                'Title',
                'Company',
                'Average Stay',
                'Work Experience',
                'Salary',
                'City',
                'Zip Code',
                'Notes',
            ]);
            foreach ($resumes as $resume) {
                fputcsv($file, [
                    $resume->last_engagement_date,
                    $resume->name,
                    $resume->current_position,
                    $resume->current_company,
                    $resume->average_stay,
                    $resume->work_experience,
                    $resume->salary,
                    $resume->city,
                    $resume->location,
                    $resume->notes,
                ]);
            }
            rewind($file);
            $csv = stream_get_contents($file);
            fclose($file);
            return Response::make($csv, 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ]);
        }
        else{
            return redirect()->route('home')->with('error', 'Please login as admin first.');
        }
    }
    public function developerlook_data_single_data($dataID,$id){
        if (session()->has('username')) {
            ListData::where('list_id', $id)->where('resume_id', $dataID)->delete();
            $listData = ListData::where('list_id', $id)->get();
            $resumeIds = $listData->pluck('resume_id');
            $resumes = Resume::whereIn('id', $resumeIds)->get();
            return view('admin_single', compact('resumes', 'id'));
        }
        else{
            return redirect()->route('home')->with('error', 'Please login as admin first.');
        }
    }
    public function developerlook_admin_download(Request $request,$id){
        if (session()->has('username')){
            $resume = Resume::where('id', $id)->first();
            if ($resume) {
                $originalDownloadLink = $resume->resume_link;
                $temporaryFileName = 'resume_' . uniqid() . '.' . pathinfo($originalDownloadLink, PATHINFO_EXTENSION);
                $temporaryFilePath = storage_path('app/temp/' . $temporaryFileName);
                $baseUrl = url('/');
                $relativePath = str_replace($baseUrl, '', $originalDownloadLink);
                $relativePath = ltrim($relativePath, '/');
                $fileContents = file_get_contents($relativePath);
                file_put_contents($temporaryFilePath, $fileContents);
                return response()->download($temporaryFilePath)->deleteFileAfterSend(true);
            }
            return redirect()->back()->with('error', 'Resume not found');
        }
    }










    public function developerlook_admin_single(Request $request,$id){
        // if (session()->has('username')) {
        //     if($request->input('location')){
        //         $listData = ListData::where('list_id', $id)->get();
        //         $resumeIds = $listData->pluck('resume_id');
        //         $resumes = Resume::whereIn('id', $resumeIds)->where(function ($query) use ($request) {$query->where('location', 'like', '%' . $request->input('location') . '%');})->get();
        //         return view('admin_single', compact('resumes', 'id'));
        //     }
        //     $listData = ListData::where('list_id', $id)->get();
        //     $resumeIds = $listData->pluck('resume_id');
        //     $resumes = Resume::whereIn('id', $resumeIds)->get();
        //     return view('admin_single', compact('resumes', 'id'));
        // }
        // else{
        //     return redirect()->route('home')->with('error', 'Please login as admin first.');
        // }





        
        Session::forget('error_in_request');
        Session::forget('csvready');
        if (session()->has('username')) {
            if ($request->isMethod('post')) {
                if ($request->input('singleDataDrop')) {
                    DB::table('resumes')->where('id', $request->input('singleDataDrop'))->delete();
                    return redirect()->route('admin_single');
                }
            } else {
                $listData = ListData::where('list_id', $id)->get();
                $resumeIds = $listData->pluck('resume_id');
                $data_for_filter = Resume::whereIn('id', $resumeIds)->get();
                return view('admin_single', compact('data_for_filter','id'));
            }
        } else {
            return redirect()->route('home')->with('error', 'Please login first');
        }
    }
}
