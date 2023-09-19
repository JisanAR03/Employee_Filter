<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\User;
use App\Models\Resume;
use GuzzleHttp\Client;
use App\Models\ListData;
use App\Models\ListModel;
use App\Models\ownedData;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Services\ElasticEmailService;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function developerlook_index(){
        if (!session()->has('basicUser')) {
        return view('user_signup');
        }
        else{
            return redirect()->route('timeline')->with('success', 'Already Logged In');
        }
    }
    public function developerlook_user_store(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|email|unique:users,username',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->route('home')->with('error', 'Invalid Email or Password');
        }
        else{
            $verificationToken = Str::random(40); // Generate a verification token
            $service = 'user';
            $apiKey = "86D231B37684507DCB943241C73268D061C286F398AA737F345E05FAA849E14D31DDBE0FE8D8E84C0C642FEF8DAAEDBF";
            $recipientEmail = $request->username;
            $senderEmail = "verification@sortersorter.com";
            $subject = "Verification Email";
            //send massege with token
            $message = '<h1>Email Verification</h1>
            <p>Please click the following link to verify your email address:</p>
            <a href="' . route('verification.verify', ['service' => $service, 'token' => $verificationToken]) . '">Verify Email</a>';

            $data = [
                "apikey" => $apiKey,
                "from" => $senderEmail,
                "to" => $recipientEmail,
                "subject" => $subject,
                "bodyText" => $message,
                "bodyHtml" => $message,
            ];

            $client = new Client();
            try {
                $response = $client->post("https://api.elasticemail.com/v2/email/send", [
                    'form_params' => $data,
                ]);

                $responseData = json_decode($response->getBody(), true);
                if (isset($responseData["success"]) && $responseData["success"]) {
                    $user = User::create([
                        'username' => $request->username,
                        'password' => Hash::make($request->password),
                        'remember_token' => 'user/'.$verificationToken, // Save the verification token to the user record
                    ]);
                    return redirect()->route('home')->with('success', 'Account created successfully. Please check your email for verification.');
                } else {
                    return redirect()->route('home')->with('error', $responseData["error"]);
                }
            } catch (\Exception $e) {
                return redirect()->route('home')->with('error', "Failed to communicate with the Elastic Email API.");
            }
        }
    }
    public function developerlook_index_verify(){
        return view('user-verify');
    }
    public function developerlook_user_verify(Request $request){ 
        $user = $request->input('username');
        $verificationToken = Str::random(40); 
        $user_data = User::where('username', $user)->first();
        if($user_data){
            if($user_data -> remember_token == null){
                return redirect()->route('home')->with('error', 'Already Verified');
            }
            else{
                $user_data->remember_token = 'user/'.$verificationToken;
                $service = 'user';
                if($user_data){
                    $apiKey = "86D231B37684507DCB943241C73268D061C286F398AA737F345E05FAA849E14D31DDBE0FE8D8E84C0C642FEF8DAAEDBF";
                    $recipientEmail = $user;
                    $senderEmail = "verification@sortersorter.com";
                    $subject = "Verification Email";
                    //send massege with token
                    $message = '<h1>Email Verification</h1>
                    <p>Please click the following link to verify your email address:</p>
                    <a href="' . route('verification.verify', ['service' => $service, 'token' => $verificationToken]) . '">Verify Email</a>';

                    $data = [
                        "apikey" => $apiKey,
                        "from" => $senderEmail,
                        "to" => $recipientEmail,
                        "subject" => $subject,
                        "bodyText" => $message,
                        "bodyHtml" => $message,
                    ];

                    $client = new Client();
                    try {
                        $response = $client->post("https://api.elasticemail.com/v2/email/send", [
                            'form_params' => $data,
                        ]);

                        $responseData = json_decode($response->getBody(), true);
                        if (isset($responseData["success"]) && $responseData["success"]) {
                            $user_data->save();
                            return redirect()->route('home')->with('success', 'Verification Email Sent');
                        } else {
                            return redirect()->route('home')->with('error', $responseData["error"]);
                        }
                    } catch (\Exception $e) {
                        return redirect()->route('home')->with('error', "Failed to communicate with the Elastic Email API.");
                    }
                }
            }
        }
        else{
            return redirect()->route('home')->with('error', 'Invalid Email');
        }
    }
    public function developerlook_timeline(){
        if (session()->has('basicUser')) {
            $all_post = ListModel::all();
            foreach($all_post as $post){
                $listData = ListData::where('list_id', $post->id)->get();
                $post->item_amount = count($listData);
            }
            return view('timeline', compact('all_post'));
        }
        else{
            return redirect()->route('home')->with('error', 'Please login as User.');
        }
    }
    public function developerlook_profile(){
        if (session()->has('basicUser')) {
            $user = session('basicUser');
            $user_id = User::where('username', $user)->first()->id;
            $own_list = ownedData::where('user_id', $user_id)->get();
            $own_resume = Resume::whereIn('id', $own_list->pluck('resume_id'))->get();
            return view('profile', compact('own_resume'));
        }
        else{
            return redirect()->route('home')->with('error', 'Please login as User.');
        }
    }
    public function developerlook_payment(){
        if (session()->has('basicUser')) {
            return view('payment');
        }
        else{
            return redirect()->route('home')->with('error', 'Please login as User.');
        }
    }
    public function stripe($amount)
    {   
        
        $user = session('basicUser');
        if(isset($user)){
            if(session()->has('basicUser')){
                $user_data = User::where('username', $user)->first();
                if($user_data->credit_amount != 0){
                    return redirect()->route('profile')->with('success', 'You already have a subscription.');
                }
                else{
                    try{
                        if($amount == "payment"){
                            $amount = 100;
                        }
                        else{
                            return redirect()->route('home')->with('error', 'Invalid Request.');
                        }
                        return view('stripe', compact('amount'));
                    }
                        catch(\Exception $e){
                            return redirect()->route('home')->with('error', $e->getMessage());
                        }
                }
            }
            else{
                return redirect()->route('profile')->with('error', 'Invalid Request.');
            }
        }
        else{
            return redirect()->route('home')->with('error', 'Please login first.');
        }
    }
    // Session::flash('success', 'Payment successful!');
    public function stripePost(Request $request)
    {
        if (session()->has('basicUser')) {
            try{
                $amount = intval($request->input('amount'));
                $user = session('basicUser');
                if($amount == 100){
                    Stripe::setApiKey(env('STRIPE_SECRET'));
                    Charge::create ([
                            "amount" => $amount * 100,
                            "currency" => "usd",
                            "source" => $request->stripeToken,
                            "description" => "Test payment to filter." 
                    ]);
                    if(isset($user)){
                        $seeker = User::where('username', $user)->first();
                        $seeker->credit_amount = 100;
                        $seeker->save();
                    }
                    else{
                        return redirect()->route('porfile')->with('error', 'Invalid Request.');
                    }
                }
                else{
                    return redirect()->route('profile')->with('error', 'Invalid Request.');
                }
                return redirect()->route('profile')->with('success', 'Payment successful!');
            }
            catch(\Exception $e){
                return redirect()->route('porfile')->with('error', $e->getMessage());
            }
        }
        else{
            return redirect()->route('home')->with('error', 'Please login as User.');
        }
    }
    public function developerlook_single(Request $request,$id){
        if (session()->has('basicUser')) {
            $searchTerm = $request->input('search_data');
            if($searchTerm){
                $listData = ListData::where('list_id', $id)->get();
                $resumeIds = $listData->pluck('resume_id');
                $resumes = Resume::whereIn('id', $resumeIds)
                            ->where(function ($query) use ($searchTerm) {
                                $query->where('Name', 'LIKE', "%$searchTerm%")
                                    ->orWhere('current_position', 'LIKE', "%$searchTerm%")
                                    ->orWhere('current_company', 'LIKE', "%$searchTerm%")
                                    ->orWhere('average_stay', 'LIKE', "%$searchTerm%")
                                    ->orWhere('work_experience', 'LIKE', "%$searchTerm%")
                                    ->orWhere('city', 'LIKE', "%$searchTerm%");
                            })
                            ->get();
                return view('single', compact('resumes'));
            }
            else{
                $listData = ListData::where('list_id', $id)->get();
                $resumeIds = $listData->pluck('resume_id');
                $resumes = Resume::whereIn('id', $resumeIds)->get();
                return view('single', compact('resumes'));
            }
        }
        else{
            return redirect()->route('home')->with('error', 'Please login as User.');
        }
    }
    public function developerlook_download(Request $request){
        if (session()->has('basicUser')) {
            $owned = $request->input('owned');
            $resumeId = $request->input('id');
            if($owned){
                $resume = Resume::where('id', $resumeId)->first();
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
                } else {
                    return redirect()->route('timeline')->with('error', 'Invalid Request.');
                }
            }
            else{
                $user = session('basicUser');
                $user_id = User::where('username', $user)->first()->id;
                $ownedData = ownedData::where('resume_id', $resumeId)->where('user_id', $user_id)->first();
                if($ownedData){
                    return redirect()->route('profile')->with('success', 'already owned check owned file.');
                }
                else{
                    $user_credit = User::where('id', $user_id)->first()->credit_amount;
                    if($user_credit){
                        $user_credit = $user_credit - 1;
                        $user_data = User::where('id', $user_id)->first();
                        $user_data->credit_amount = $user_credit;
                        $resume = Resume::where('id', $resumeId)->first();
                        if ($resume) {
                            $originalDownloadLink = $resume->resume_link;
                            $temporaryFileName = 'resume_' . uniqid() . '.' . pathinfo($originalDownloadLink, PATHINFO_EXTENSION);
                            $temporaryFilePath = storage_path('app/temp/' . $temporaryFileName);
                            $baseUrl = url('/');
                            $relativePath = str_replace($baseUrl, '', $originalDownloadLink);
                            $relativePath = ltrim($relativePath, '/');
                            $fileContents = file_get_contents($relativePath);
                            file_put_contents($temporaryFilePath, $fileContents);
                            $user_data->save();
                            $ownedData = ownedData::create([
                                'user_id' => $user_id,
                                'resume_id' => $resumeId,
                            ]);
                            return response()->download($temporaryFilePath)->deleteFileAfterSend(true);
                        } else {
                            return redirect()->route('timeline')->with('error', 'Invalid Request.');
                        }
                    }
                    else{
                        return redirect()->route('payment')->with('error', 'Buy credit first.');
                    }
                }
            }
        }
        else{
            return redirect()->route('home')->with('error', 'Please login as User.');
        }
    }
    public function developerlook_credit(){
        if (session()->has('basicUser')) {
            $user = session('basicUser');
            $user_credit = User::where('username', $user)->first()->credit_amount;
            return view('credit', compact('user_credit'));
        }
        else{
            return redirect()->route('home')->with('error', 'Please login as User.');
        }
    }
    public function developerlook_passChange(){
        if (session()->has('basicUser')) {
            return view('passChange');
        }
        else{
            return redirect()->route('home')->with('error', 'Please login as User.');
        }
    }
    public function developerlook_passChangePost(Request $request){
        $user_id = session('basicUser');
        $user = User::where('username', $user_id)->first();
        $old_pass = $request->input('current_password');
        $new_pass = $request->input('new_password');
        $confirm_pass = $request->input('new_password_conf');
        if($new_pass == $confirm_pass){
            if(Hash::check($old_pass, $user->password)){
                $user->password = Hash::make($new_pass);
                $verificationToken = Str::random(40);
                $service = 'user';
                $user->remember_token = 'user/'.$verificationToken;
                if($user){
                    $apiKey = "86D231B37684507DCB943241C73268D061C286F398AA737F345E05FAA849E14D31DDBE0FE8D8E84C0C642FEF8DAAEDBF";
                    $recipientEmail = $user_id;
                    $senderEmail = "verification@sortersorter.com";
                    $subject = "Verification Email";
                    //send massege with token
                    $message = '<h1>Email Verification</h1>
                    <p>Please click the following link to verify your email address:</p>
                    <a href="' . route('verification.verify', ['service' => $service, 'token' => $verificationToken]) . '">Verify Email</a>';

                    $data = [
                        "apikey" => $apiKey,
                        "from" => $senderEmail,
                        "to" => $recipientEmail,
                        "subject" => $subject,
                        "bodyText" => $message,
                        "bodyHtml" => $message,
                    ];

                    $client = new Client();
                    try {
                        $response = $client->post("https://api.elasticemail.com/v2/email/send", [
                            'form_params' => $data,
                        ]);

                        $responseData = json_decode($response->getBody(), true);
                        if (isset($responseData["success"]) && $responseData["success"]) {
                            $user->save();
                            session()->forget('basicUser');
                            return redirect()->route('home')->with('success', 'Password Changed now verify your mail.');
                        } else {
                            return redirect()->route('passChange')->with('error', $responseData["error"]);
                        }
                    } catch (\Exception $e) {
                        return redirect()->route('passChange')->with('error', "Failed to communicate with the Elastic Email API.");
                    }
                }
            }
            else{
                return redirect()->route('passChange')->with('error', 'Invalid Old Password.');
            }
        }
        else{
            return redirect()->route('passChange')->with('error', 'New Password and Confirm Password does not match.');
        }
    }
}
