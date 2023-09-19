<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class JSDMyProfileController extends Controller
{
    public function developerlook_index(){
        if(session()->has('username')){
            return view('upload-file');
        }else{
            return redirect()->route('home')->with('error', 'Please Login First');
        }
    }
    public function uploadSubmit(Request $request){
        $this->validate($request, [
        'resumes'=>'required',
        ]);
        if($request->hasFile('resumes')){
          $allowedfileExtension=['doc','docx', 'pdf', 'rtf'];
          $files = $request->file('resumes');
          foreach($request->resumes as $resume){
            if(!in_array($resume->getClientOriginalExtension(),$allowedfileExtension)){
              Session::flash('extension_error', "Allowed file types are doc & docx");
              return redirect(route('uploadFile'));
            }
          }
          foreach($request->resumes as $resume){
            $filename = $resume->storeAs(
              'resumes',
              $resume->getClientOriginalName(),
              'public'
            );
            $filepath = $resume;
            $handle = fopen($filepath, "r");
            $contents = fread($handle, filesize($filepath));
            fclose($handle);
            $modifiedDate = date("Y-m-d", filemtime($filepath));
            $base64str = base64_encode($contents);
            $data = ["DocumentAsBase64String" => $base64str, "DocumentLastModified" => $modifiedDate];
            $url = "https://rest.resumeparsing.com/v10/parser/resume";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $headers = [
              "accept: application/json",
              "content-type: application/json; charset=utf-8",
              "sovren-accountid: 25910655",
              "sovren-servicekey: WfnG70XJxMQz+ZwVBTKdUD+5Bj6vOR98W+LRIshn"
            ];
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($curl);
            curl_close($curl);
            $decoded_json = json_decode($result, true);
            if($decoded_json['Value']['ParsingResponse']['Code']=='Success' || $decoded_json['Value']['ParsingResponse']['Code']=='WarningsFoundDuringParsing'){
              $parsed_resume = new Resume();
              try{
                $parsed_resume->name = $decoded_json['Value']['ResumeData']['ContactInformation']['CandidateName']['FormattedName'];
              }catch(\Exception $exception){}
              try{
                $parsed_resume->current_position = $decoded_json['Value']['ResumeData']['EmploymentHistory']['Positions']['0']['JobTitle']['Raw'];
              }catch(\Exception $exception){}
              try{
                $parsed_resume->current_company = $decoded_json['Value']['ResumeData']['EmploymentHistory']['Positions']['0']['Employer']['Name']['Raw'];
              }catch(\Exception $exception){}
              try{
                if(count($decoded_json['Value']['ResumeData']['EmploymentHistory']['Positions']) > 1){
                  $stedval= '';
                  $cusct= count($decoded_json['Value']['ResumeData']['EmploymentHistory']['Positions']);
                  $cusct--;
                  for($x=0; $x <= $cusct; $x++){
                    $rearrgedDTS = explode('-', $decoded_json['Value']['ResumeData']['EmploymentHistory']['Positions'][$x]['StartDate']['Date']);
                    $rearrgedDTSF = array();
                    array_push($rearrgedDTSF, $rearrgedDTS[1], $rearrgedDTS[2], $rearrgedDTS[0]);
                    $rearrgedDTSFS = implode('-', $rearrgedDTSF);
                    $rearrgedDTE = explode('-', $decoded_json['Value']['ResumeData']['EmploymentHistory']['Positions'][$x]['EndDate']['Date']);
                    $rearrgedDTEF = array();
                    array_push($rearrgedDTEF, $rearrgedDTE[1], $rearrgedDTE[2], $rearrgedDTE[0]);
                    $rearrgedDTEFS = implode('-', $rearrgedDTEF);
                    $cwd= ((strtotime($decoded_json['Value']['ResumeData']['EmploymentHistory']['Positions'][$x]['EndDate']['Date'])* 1000) - (strtotime($decoded_json['Value']['ResumeData']['EmploymentHistory']['Positions'][$x]['StartDate']['Date'])* 1000));
                    $months= floor(floor(floor(floor(floor($cwd/1000)/60)/60)/24)/30.44);
                    $years= floor($months/12);
                    $result= "";
                    if($years > 0) {
                      $result .= $years ." year";
                      if($years > 1) {
                        $result .= "s";
                      }
                      $result .= " ";
                    }
                    if($months > 0) {
                      $result .= $months % 12 ." month";
                      if($months % 12 > 1) {
                        $result .= "s";
                      }
                      $result .= " ";
                    }
                    $stedval= $stedval.$decoded_json['Value']['ResumeData']['EmploymentHistory']['Positions'][$x]['JobTitle']['Raw'].'***'.$decoded_json['Value']['ResumeData']['EmploymentHistory']['Positions'][$x]['Employer']['Name']['Raw'].'***'.trim($result).'***'.$rearrgedDTSFS.' to '.$rearrgedDTEFS.'///';
                  }
                  $parsed_resume->prev_comps_with_pos = $stedval;
                }elseif(count($decoded_json['Value']['ResumeData']['EmploymentHistory']['Positions']) <= 1){
                  $stedval= 'not available'.'***'.'not available'.'***'.'not available'.'***'.'not available'.'///';
                  $parsed_resume->prev_comps_with_pos = $stedval;
                }
              }catch(\Exception $exception){
                $stedval= 'not available'.'***'.'not available'.'***'.'not available'.'***'.'not available'.'///';
                $parsed_resume->prev_comps_with_pos = $stedval;
              }
              try{
                $months= $decoded_json['Value']['ResumeData']['EmploymentHistory']['ExperienceSummary']['AverageMonthsPerEmployer'];
                $years= floor($months/12);
                $result= "";
                if($years > 0) {
                  $result .= $years ." year";
                  if($years > 1) {
                    $result .= "s";
                  }
                  $result .= " ";
                }
                if($months > 0) {
                  $result .= $months % 12 ." month";
                  if($months % 12 > 1) {
                    $result .= "s";
                  }
                  $result .= " ";
                }
                $parsed_resume->average_stay = trim($result);
              }catch(\Exception $exception){}
              try{
                // preg_match('/[0-9]+\s(\w+)/', $decoded_json['Value']['ResumeData']['EmploymentHistory']['ExperienceSummary']['Description'], $matches);
                // $parsed_resume->work_experience = $matches[0];
                $months= $decoded_json['Value']['ResumeData']['EmploymentHistory']['ExperienceSummary']['MonthsOfWorkExperience'];
                $years= floor($months/12);
                $result= "";
                if($years > 0) {
                  $result .= $years ." year";
                  if($years > 1) {
                    $result .= "s";
                  }
                  $result .= " ";
                }
                if($months > 0) {
                  $result .= $months % 12 ." month";
                  if($months % 12 > 1) {
                    $result .= "s";
                  }
                  $result .= " ";
                }
                $parsed_resume->work_experience = trim($result);
              }catch(\Exception $exception){}
              try{
                $parsed_resume->location = $decoded_json['Value']['ResumeData']['ContactInformation']['Location']['PostalCode'];
              }catch(\Exception $exception){}
              try{
                $parsed_resume->city = $decoded_json['Value']['ResumeData']['ContactInformation']['Location']['Municipality'].', '.$decoded_json['Value']['ResumeData']['ContactInformation']['Location']['Regions']['0'];
              }catch(\Exception $exception){}
              $parsed_resume->resume_link = asset('storage/resumes/'.$resume->getClientOriginalName());
              $parsed_resume->save();
            }
          }
          Session::flash('upload_success', "Uploaded Successfully");
          return redirect(route('filterData'));
        }
        
    }
}
