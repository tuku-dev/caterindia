<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
#use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Helpers;
//This line is used for getting the input box value
use Illuminate\Http\Request;
//This line is used for database connection
use DB;
//This line is used for session
use Session;
use Cookie;
//This line is used for url redirect
use Illuminate\Support\Facades\Redirect;
//use App\Mylibs\thumbnail_manager;
//use App\Mylibs\paypal_pro;
use Mail;
use App\Mail\Reminder;
use App\Mail\MailBuilder;
use Carbon\Carbon;
use View;
use Share;

class homeController extends Controller {
	
	public function __construct() {
        $seo_info = DB::table('seo')->where('id', '=', '1')->get();

        $this->admin_data = Helpers::getShare();

        View::share(['seo_info' => $seo_info]);
    }
	
    public function showHome() {
        return view('home');
    }
	
	public function aboutUs() {
		$content_det = DB::table('contents')->where('id', '=', 1)->get();
        return view('about-us')->with('content_det', $content_det);
    }
	
	public function contactUs() {
        return view('contact-us')->with('admin_data', $this->admin_data);
    }

    public function viewRestaurants($name){
    	$data = DB::table('area')->where('area_name', '=', $name)->first();
    	$count_data = DB::table('area')->where('area_name', '=', $name)->count();
    	if($count_data == 0){
    		return Redirect::to('./');
    	}
    	$restaurants = DB::table('restaurant')
    				  ->join('area', 'area.area_id', '=', 'restaurant.area_id')
    				  ->where('restaurant.area_id', '=', $data->area_id)
    				  ->get();
    	$count_restaurants = DB::table('restaurant')
    				  ->join('area', 'area.area_id', '=', 'restaurant.area_id')
    				  ->where('restaurant.area_id', '=', $data->area_id)
    				  ->count();
		return view('restaurants')->with('restaurants', $restaurants)->with('count_restaurants', $count_restaurants)->with('admin_data', $this->admin_data);
    }

    public function viewRestaurantItems($id,$name){
    	$restaurant = DB::table('restaurant')
    				 ->where('rest_id', '=', base64_decode(base64_decode($id)))
    				 ->first();
    	/*$category = DB::table('category')
                    ->where('restaurant_id', '=', base64_decode(base64_decode($id)))
                    ->get();
        $subcategory = DB::table('subcategory')
                      ->join('category', 'category.category_id', '=', 'subcategory.cate_id')
                      ->where('subcategory.restaurant_id', '=', base64_decode(base64_decode($id)))
                      ->get(); */
        //dd($subcategory); exit;         
        /*$items = DB::table('product')
                ->where('restaurant_id', '=', base64_decode(base64_decode($id)))
                ->get();*/
        //dd($items); exit;
    	return view('restaurant')->with('restaurant', $restaurant);
    }
	
	public function sendContactUsMail(Request $request) {
        $full_name = trim($request->input('full_name'));
        $user_email = trim($request->input('user_email'));
        $subject = trim($request->input('subject'));
        $your_message = trim($request->input('your_message'));

        if ($full_name == "" || $user_email == "" || $subject == "" || $your_message == "") {
            return Redirect::to('contact-us')->with('blank', true);
        } else {
            // Admin Details
            $admin_det = DB::table('core')->where('id', '=', 1)->get();
            $admin_name = $admin_det[0]->admin_name;
            $admin_email = $admin_det[0]->alt_email;

            $current_year = date("Y");

            //Email Template Details
            $res_template = DB::table('email_template')->where('id', '=', 1)->get();
            $input = $res_template[0]->contents;

            $body_admin = str_replace(array('%ADMINNAME%', '%NAME%', '%EMAIL%', '%MESSAGE%', '%ADMINEMAIL%', '%CURRENTYEAR%'), array($admin_name, $full_name, $user_email, $your_message, $admin_email, $current_year), $input);
            //echo $body_admin;exit;

            /* $content = [
              'from_email' => $user_email,
              'subject'=> $subject,
              'body'=> $body_admin,
              'email_template' => 'emails.common_mail'
              ];
              $ok=Mail::to($admin_email)->send(new MailBuilder($content)); */

            $headers = "MIME-Version: 1.0\n";
            $headers .= "Content-type: text/html; charset=UTF-8\n";
            $headers .= "From:" . $full_name . " < " . $user_email . ">\n";
            $ok = mail($admin_email, $subject, $body_admin, $headers);

            return Redirect::to('contact-us')->with('success', true);
        }
    }
	
	public function reservationTable() {
        return view('reservation');
    }
	
	public function ourBlog() {
        return view('blog');
    }
	
	public function viewUserLogin() {
		if (Session::get('user_id') != "") {
            return Redirect::to('home');
        }
        return view('user-login');
    }
	
	public function viewCart() {
        return view('cart');
    }
	//News letter
	public function saveNewsletterData(Request $request) {
        $news_ltr_email = $request->input('news_ltr_email');
        $current_date = date("Y-m-d");

        $count = DB::table('newsletter')->where('nl_email', '=', $news_ltr_email)->count();
        if ($news_ltr_email == "") {
            return "0";
        } else if ($count > 0) {
            return "1";
        } else {
            DB::table('newsletter')->insert(array('nl_email' => $news_ltr_email, 'subscribe_date' => $current_date));
            return "success";
        }
    }
	//User Registration
	public function saveUserRegistrationData(Request $request) {
		if (Cookie::get('user_id') != "") {
            echo "0"; exit;
        }
        $full_name = $request->input('full_name');
        $user_email = $request->input('user_email');
        $user_psw = base64_encode(base64_encode($request->input('user_psw')));
        $contact_no = $request->input('contact_no');
		$verification = mt_rand(100000, 999999);
        if ($full_name == "" || $user_email == "" || $user_psw == "" || $contact_no == "") {
            echo "0"; exit;
        }
		if(!preg_match('/^[^\W][a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*\@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)*\.[a-zA-Z]{2,4}$/',$user_email)){
			echo "4"; exit;
		}
		if(!preg_match("/^[6-9][0-9]{9}$/", $contact_no)) {
		  echo "5"; exit;
		}
		$mobile_count = DB::table('user_login')
						->where('contact_no', '=', $contact_no)
						->count();
		if($mobile_count > 0){
			echo "2"; exit;
			}
        $count = DB::table('user_login')
                ->where('email', '=', $user_email)
                ->count();
        if ($count == 0) {
			$created_date = date("Y-m-d");
			DB::table('tempcheck')->insert(array(
					'verify' => $verification));
			//SMS gatway code write here. And delete tempcheck table from database.
			// Store in SESSION
			Session::put('full_name', $full_name);
			Session::put('email', $user_email);
			Session::put('user_psw', $user_psw);
			Session::put('contact_no', $contact_no);
			Session::put('verification', $verification);
			Session::put('created_date', $created_date);
			Session::put('updated_date', $created_date);
            echo "1";
        } else {
            echo "3"; exit;
        }
    }
	//OTP verification
	public function otpVerify(Request $request) {
		if (Cookie::get('user_id') != "") {
            echo "0"; exit;
        }
        $otp = $request->input('otp');
		if($otp!=""){
			if(strlen($otp) < 6){
				echo "0"; exit;
				}
			if($otp == Session::get('verification')){
				DB::table('user_login')->insert(array(
					'full_name' => Session::get('full_name'),
					'email' => Session::get('email'),
					'user_psw' => Session::get('user_psw'),
					'contact_no' => Session::get('contact_no'),
					'verification' => Session::get('verification'),
					'user_status' => '1',
					'created_date' => Session::get('created_date'),
					'updated_date' => Session::get('updated_date')));
				$user_id = DB::getPdo()->lastInsertId();
                Cookie::queue('user_id', $user_id, 43200);
                Session::forget('full_name');
				Session::forget('email');
				Session::forget('user_psw');
				Session::forget('contact_no');
				Session::forget('verification');
				Session::forget('created_date');
				Session::forget('updated_date');
				echo "1"; 
				}
			else{
				echo "0"; exit;	
			}
		}else{
		echo "0"; exit;		
		}
    }
	//User Resend OTP
	public function resendOtp(){
		if (Cookie::get('user_id') != "") {
            echo "0"; exit;
        }
		Session::forget('verification');
		$verification = mt_rand(100000, 999999);
		DB::table('tempcheck')->insert(array(
					'verify' => $verification));
		//SMS gatway code write here. And delete tempcheck table from database.
		Session::put('verification', $verification);
		   echo "1";
		}
	//User Login
	public function userLoginProcess(Request $request) {
		if (Cookie::get('user_id') != "") {
            return Redirect::to('user-login');
        }
        $email = $request->input('user_email');
        $user_password = $request->input('user_psw');

        if ($email == "" || $user_password == "") {
            return Redirect::to('user-login')->with('blank', true);
        }

        // Get records from core table with email address
        $result = DB::table('user_login')
                ->where('email', '=', $email)
				->orWhere('contact_no', '=', $email)
                ->get();

        // If record not exist
        if (count($result) == 0) {
            return Redirect::to('user-login')->with('invalid', true);
        }

        if ($result[0]->user_status == 0) {
            return Redirect::to('user-login')->with('blocked', true);
        }

        // Decrypt the password from the database
        $db_password = base64_decode(base64_decode($result[0]->user_psw));
		
        // If password does not macth in db_password
        if ($user_password != $db_password) {
            return Redirect::to('user-login')->with('invpsw', true);
        }

        // Store in SESSION
        Cookie::queue('user_id', $result[0]->user_id, 43200);
        return Redirect::to('home');
    }
	
	//Forgot OTP
	public function forgotOtp(Request $request) {
		if (Cookie::get('user_id') != "") {
            echo "0"; exit;
        }
        $phone = $request->input('phone');

        if ($phone == "") {
            echo "0"; exit;
        }

        // Get records from core table with email address
        $result = DB::table('user_login')
                ->where('contact_no', '=', $phone)
                ->get();

        // If record not exist
        if (count($result) == 0) {
            echo "0"; exit;
        }
		$verification = mt_rand(100000, 999999);
		DB::table('tempcheck')->insert(array(
					'verify' => $verification));
		//SMS gatway code write here. And delete tempcheck table from database.
		// Store in SESSION
		Session::put('verification', $verification);
		Session::put('contact_no', $phone);
		echo "1";
    }
	
	//Forgot password OTP Verify
	public function otpVerificationChangepsw(Request $request){
		if (Cookie::get('user_id') != "") {
            echo "0"; exit;
        }
        $otp = $request->input('forgototp_confirm');
		if($otp!=""){
			if(strlen($otp) < 6){
				echo "0";
				}
			if($otp == Session::get('verification')){
				Session::forget('verification');
				echo "1"; 
				}
			else{
				echo "0";
			}
		}else{
		echo "0";	
		}
		}
	
	//Change Password forgot
	public function changePassword(Request $request) {
		if (Cookie::get('user_id') != "") {
            echo "0";
        }
        $password = $request->input('password');
		$repeat_password = $request->input('repeat_password');

        if ($password == "" || $repeat_password == "") {
            echo "0";
        }
		
		if ($password != $repeat_password){
			echo "0";
		}
		$db_password = base64_encode(base64_encode($password));
        $result = DB::table('user_login')
                ->where('contact_no', '=', Session::get('contact_no'))
				->update(array('user_psw' => $db_password));    

			$user = DB::table('user_login')->where('contact_no', '=', Session::get('contact_no'))->first();
            Cookie::queue('user_id',  $user->user_id, 43200);
			Session::forget('contact_no');
			echo "1";
    }
	
	//User Logout
	public function userLogout() {
		if (Cookie::get('user_id') == "") {
            return Redirect::to('user-login');
        }
        Cookie::queue(
            Cookie::forget('user_id')
        );
        return Redirect::to('home');
    }

    //Search Area
    public function searchareResult(Request $request){
    	if(!empty($request->input('keyword'))) {
		$query = DB::table('area')
				->where('area_name', 'like', $request->input('keyword').'%')
				->limit(5)
				->get();
		if(!empty($query)) {
		$html = "<ul id='country-list'>";
		$html3 = "";
		foreach($query as $res) {
		$html2 = "<li onClick='selectCountry(".'"'.$res->area_name .'"'.");'><i class='icofont icofont-social-google-map'></i><div>".$res->area_name ."</div></li>";
		$html3 = $html3.$html2;}
		$html3 = $html3."</ul>";
		echo $html.$html3; exit;
		} }
    }

    //Added To Cart

    public function addedToCart(Request $request){
        dd($request->all()); exit;
       $prdid = $request->input('prdid');
       $img = $request->input('img');
       $name = $request->input('name');
       $price = $request->input('price');
       $desc = $request->input('desc');
       $qnty = $request->input('qnty');
       $type = $request->input('type');
       $category = $request->input('category');
       $subcategory = $request->input('subcategory');
       $rest = $request->input('rest');

    }
	
	
}
