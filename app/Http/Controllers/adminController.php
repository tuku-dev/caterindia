<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
#use Illuminate\Routing\Controller as BaseController;
#use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
//This line is used for getting the input box value
use Illuminate\Http\Request;
//This line is used for database connection
use DB;
//This line is used for session
use Session;
//This line is used for url redirect
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Helpers;
use Image;
use Response;
use Excel;
use Mail;
use App\Mail\MailBuilder;

//use App\Mylibs\thumbnail_manager;

class adminController extends Controller {

    //Admin Login
    public function adminLogin(Request $request) {
        $email = $request->input('email');
        $user_password = $request->input('password');
        //echo $email;echo $user_password;exit;

        if ($email == "" || $user_password == "") {
            return Redirect::to('administrator')->with('blank', true);
        }

        // Get records from core table with email address
        $result = DB::table('core')
                ->where('email', '=', $email)
                ->get();

        // If record not exist
        if (count($result) == 0) {
            return Redirect::to('administrator')->with('invalid', true);
        }

        // Decrypt the password from the database
        $db_password = base64_decode(base64_decode($result[0]->password));

        // If password does not macth in db_password
        if ($user_password != $db_password) {
            return Redirect::to('administrator')->with('invalid', true);
        }

        // Store in SESSION
        Session::put('admin_id', $result[0]->id);
        Session::put('admin_name', $result[0]->admin_name);
        return Redirect::to('administrator/dashboard');
    }

    //Admin Logout
    public function logout() {
        Session::flush();
        Session::forget('admin_id');
        Session::forget('admin_name');
        return Redirect::to('administrator');
    }

    //Admin Password Recovery
    public function adminPswRecovery(Request $request) {
        $forgot_email = $request->input('forgot_email');

        if ($forgot_email == "") {
            return Redirect::to('administrator/forgot-psw-admin')->with('blank', true);
        }

        // Get records from core table with email address
        $result = DB::table('core')
                ->where('email', '=', $forgot_email)
                ->get();

        // If record not exist
        if (count($result) == 0) {
            return Redirect::to('administrator/forgot-psw-admin')->with('invalid', true);
        }

        // Decrypt the password from the database
        $db_password = base64_decode(base64_decode($result[0]->password));

        $res_template = DB::table('email_template')->where('id', '=', 4)->get();
        // Admin Details
        $admin_det = DB::table('core')->where('id', '=', 1)->get();
        $admin_name = $admin_det[0]->admin_name;
        $admin_email = $admin_det[0]->alt_email;
        $site_url = $admin_det[0]->site_url;

        $current_year = date("Y");

        # Subject
        $subject = "Upscale :: Password";
        $input = $res_template[0]->contents;

        //echo $admin_email;exit;
        $body = str_replace(array('%ADMINNAME%', '%ADMINEMAIL%', '%ADMINPASSWORD%', '%FROMEMAIL%', '%CURRENTYEAR%'), array($admin_name, $forgot_email, $db_password, $admin_email, $current_year), $input);
        //echo $body;exit;

        $content = [
            'title' => 'ok',
            'subject' => $subject,
            'body' => 'demo',
            'email_template' => 'emails.common_mail',
            'from_email' => $admin_email
        ];

        //dd($content);
        $ok = Mail::to($forgot_email)->send(new MailBuilder($content));


        if ($ok) {
            return Redirect::to('administrator/forgot-psw-admin')->with('success', true);
        } else {
            return Redirect::to('administrator/forgot-psw-admin')->with('failed', true);
        }
    }

    // My Account start
    public function viewAdminAccount() {
        $data = DB::table('core')->get();
        return view('admin.my-account')->with('data', $data);
    }

    public function updateAdminDetails(Request $request) {
        $admin_name = $request->input('admin_name');
        $email = $request->input('email');
        $alt_email = $request->input('alt_email');
        $contact_no = $request->input('contact_no');
        $fax_no = $request->input('fax_no');
        $mobile_no = $request->input('mobile_no');
        $address = $request->input('address');

        $facebook_url = $request->input('facebook_url', false);
        $twitter_url = $request->input('twitter_url', false);
        $linkedin_url = $request->input('linkedin_url', false);
        $instagram_url = $request->input('instagram_url', false);

        if ($admin_name == "" || $email == "") {
            return Redirect::to('administrator/my-account')->with('blank', true);
        }

        DB::table('core')
                ->where('id', '>', 0)
                ->update(['admin_name' => $admin_name,
                    'email' => $email,
                    'alt_email' => $alt_email,
                    'contact_no' => $contact_no,
                    'fax_no' => $fax_no,
                    'mobile_no' => $mobile_no,
                    'facebook_url' => $facebook_url,
                    'twitter_url' => $twitter_url,
                    'linkedin_url' => $linkedin_url,
                    'instagram_url' => $instagram_url,
                    'address' => $address]);
        return Redirect::to('administrator/my-account')->with('success', true);
    }

    // My Account end
    //Change password Start
    public function viewChangePassword() {
        return view('admin.change-password-admin');
    }

    public function changeAdminPsw(Request $request) {
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');
        $conf_password = $request->input('conf_password');

        if ($old_password == "" || $new_password == "" || $conf_password == "") {
            return Redirect::to('administrator/change-password-admin')->with('blank', true);
        }

        if ($new_password != $conf_password) {
            return Redirect::to('administrator/change-password-admin')->with('conf_not_match', true);
        }

        $is_password_exist = DB::table('core')
                ->select('password')
                ->where('id', '>', 0)
                ->get();
        $decrypted_db_password = base64_decode(base64_decode($is_password_exist[0]->password));

        if ($decrypted_db_password != $old_password) {
            return Redirect::to('administrator/change-password-admin')->with('not_match', true);
        }

        $encrypted_password = base64_encode(base64_encode($new_password));

        DB::table('core')->where('id', '>', 0)->update(array('password' => $encrypted_password));

        return Redirect::to('administrator/change-password-admin')->with('success', true);
    }

    //Change password end
    //Manage Seo start
    public function viewManageSeo() {
        $data = DB::table('seo')->get();
        return view('admin.manage-seo')->with('data', $data);
    }

    public function updateSeoDetails(Request $request) {
        $meta_title = $request->input('meta_title');
        $meta_keyword = $request->input('meta_keyword');
        $meta_descr = $request->input('meta_descr');

        if ($meta_title == "" || $meta_keyword == "" || $meta_descr == "") {
            return Redirect::to('administrator/manage-seo')->with('blank', true);
        }

        DB::table('seo')
                ->where('id', '>', 0)
                ->update(
                        array('meta_title' => $meta_title,
                            'meta_keyword' => $meta_keyword,
                            'meta_descr' => $meta_descr,
        ));
        return Redirect::to('administrator/manage-seo')->with('success', true);
    }

    //View manage content page start
    public function viewManageContents() {
        $data = DB::table('contents')->orderBy('id')->get();
        return view('admin.manage-contents')->with('data', $data);
    }

    public function viewEditContent($reference_id) {
        $data = DB::table('contents')->where('id', '=', $reference_id)->get();
        return view('admin.edit-content')->with('data', $data);
    }

    public function updateContent(Request $request) {
        $reference_id = $request->input('reference_id');
        $page_title = $request->input('page_title');
        $content = $request->input('content');
        $meta_title = $request->input('meta_title');
        $meta_descr = $request->input('meta_descr');
        $meta_keyword = $request->input('meta_keyword');

        if ($page_title == "" || $content == "") {
            return Redirect::to('administrator/edit-content/' . $reference_id . '/edit')->with('blank', true);
        }
        DB::table('contents')->where('id', '=', $reference_id)->update(array('page_title' => $page_title, 'content' => $content, 'meta_title' => $meta_title, 'meta_descr' => $meta_descr, 'meta_keyword' => $meta_keyword));
        return Redirect::to('administrator/edit-content/' . $reference_id . '/edit')->with('success', true);
    }

    //Banner page coding starts here
    public function viewManageBanners() {
        $data = DB::table('banners')->orderBy('id', 'DESC')->get();
        return view('admin.manage-banners')->with('data', $data);
    }

    public function viewAddBanner() {
        return view('admin.add-banner');
    }

    public function saveBannerData(Request $request) {
        if ($request->file('upload_banner') == "") {
            return Redirect::to('administrator/add-banner/')->with('blank', true);
        }
        $ext = strtolower($request->file('upload_banner')->getClientOriginalExtension());


        // File Upload here
        if ($request->file('upload_banner')->getClientOriginalName() != "" && $ext == "png" || $ext == "jpg" || $ext == "jpeg") {
            $banner_image = 'B_' . date('dmy') . time() . '.' . $request->file('upload_banner')->getClientOriginalExtension();
            $request->file('upload_banner')->move(public_path() . '/banners/', $banner_image);

            $created_date = date("Y-m-d");
            DB::table('banners')->insert(array('banner_photo' => $banner_image,
                'created_date' => $created_date,
                'updated_date' => $created_date));
            return Redirect::to('administrator/add-banner')->with('success', true);
        } else {
            return Redirect::to('administrator/add-banner/')->with('invformat', true);
        }
    }

    public function viewEditBanner($reference_id) {
        $data = DB::table('banners')->where('id', '=', $reference_id)->get();
        return view('admin.edit-banner')->with('data', $data);
    }

    public function updateBanner(Request $request) {
        $reference_id = $request->input('reference_id');
        $updated_date = date("Y-m-d");

        if ($request->file('upload_banner') != "") {
            $ext = strtolower($request->file('upload_banner')->getClientOriginalExtension());
            // File Upload here
            if ($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
                //Unlink code starts here
                $data = DB::table('banners')->where('id', '=', $reference_id)->get();
                if ($data[0]->banner_photo != '') {
                    $unlink_path = "public/banners/" . $data[0]->banner_photo;
                    unlink($unlink_path);
                }
                //Unlink code ends here	

                $banner_image = 'B_' . date('dmy') . time() . '.' . $request->file('upload_banner')->getClientOriginalExtension();
                $request->file('upload_banner')->move(public_path() . '/banners/', $banner_image);
                DB::table('banners')->where('id', '=', $reference_id)->update(array('banner_photo' => $banner_image, 'updated_date' => $updated_date));
                return Redirect::to('administrator/edit-banner/' . $reference_id . '/edit')->with('success', true);
            }
        } else {
            return Redirect::to('administrator/edit-banner/' . $reference_id . '/edit')->with('success', true);
        }
    }

    public function deleteBanner($id) {
        $data = DB::table('banners')->where('id', '=', $id)->get();
        //Unlink code starts here
        $data = DB::table('banners')
                ->where('id', '=', $id)
                ->get();
        if ($data[0]->banner_photo != '') {
            $unlink_path = "public/banners/" . $data[0]->banner_photo;
            unlink($unlink_path);
        }
        //Unlink code ends here	
        DB::table('banners')->where('id', '=', $id)->delete();
        return Redirect::to('administrator/manage-banners');
    }

    //Banner page coding ends here
    //Manage Newsletter contact list starts here
    public function viewManageNewsletter() {
        $data = DB::table('newsletter')->orderBy('id', 'DESC')->get();
        $template_det = DB::table('email_template')->where('id', '=', '9')->get();
        return view('admin.manage-newsletter')->with('data', $data)->with('template_det', $template_det);
    }

    public function deleteNlEmail($id) {
        DB::table('newsletter')->where('id', '=', $id)->delete();
        return Redirect::to('administrator/manage-newsletter');
    }

    public function sendNewsletterMail(Request $request) {
        if ($request->input('to_email') == '' || $request->input('subject') == '' || $request->input('contents') == '') {
            return Redirect::to('administrator/manage-newsletter')->with('blank', true);
        }

        $res_template = DB::table('email_template')->where('id', '=', 9)->get();

        // Admin Details
        $admin_det = DB::table('core')->where('id', '=', 1)->get();
        $admin_name = $admin_det[0]->admin_name;
        $admin_email = $admin_det[0]->alt_email;
        $site_url = $admin_det[0]->site_url;



        $current_year = date("Y");

        # Subject
        $subject = $request->input('subject');
        $input = $request->input('contents');

        $allEmail = join(",", $request->input('to_email'));
        $toEmail = explode(",", $allEmail);
        for ($i = 0; $i < count($toEmail); $i++) {
            $data = DB::table('newsletter')->where('nl_email', '=', $toEmail)->get();
            $uid = $data[0]->id;
            $token = Helpers::keyMaker($uid);
            $body = str_replace(array('%ADMINNAME%', '%ADMINEMAIL%', '%CURRENTYEAR%', '%UID%', '%TOKEN%'), array($admin_name, $admin_email, $current_year, $uid, $token), $input);
            //echo $body;exit;

            $emailTo = $toEmail[$i];
            if ($emailTo != "") {
                $headers = "MIME-Version: 1.0\n";
                $headers .= "Content-type: text/html; charset=UTF-8\n";
                $headers .= "From:" . $admin_name . " < " . $admin_email . ">\n";
                /* echo $emailTo."<br><br>";
                  echo $admin_email."<br><br>";
                  echo $body."<br><br>-----------<br><br>"; */
                $ok = mail($emailTo, $subject, $body, $headers);
            }
        }
        return Redirect::to('administrator/manage-newsletter')->with('success', true);
    }
	
	//Area page coding starts here
    public function viewManageArea() {
        $data = DB::table('area')->orderBy('area_id', 'DESC')->get();
        return view('admin.manage-area')->with('data', $data);
    }

	public function viewAddArea() {
        return view('admin.add-area');
    }
	
	public function saveAreaData(Request $request) {
        $area_name = $request->input('area_name');
        if ($area_name == "") {
            return Redirect::to('administrator/add-area')->with('blank', true);
        }

        //Duplicate checked

        $count = DB::table('area')
                ->where('area_name', '=', $area_name)
                ->count();

        if ($count == 0) {
            DB::table('area')->insert(array('area_name' => $area_name));
            return Redirect::to('administrator/add-area')->with('success', true);
        } else {
            return Redirect::to('administrator/add-area')->with('exist', true);
        }
    }
	
	public function viewEditarea($reference_id) {
        $data = DB::table('area')->where('area_id', '=', $reference_id)->get();
        return view('admin.edit-area')->with('data', $data);
    }
	
	public function updateArea(Request $request) {
        $reference_id = $request->input('reference_id');
		$area_name = $request->input('area_name');
		
		if ($reference_id == "" || $area_name == "") {
            return Redirect::to('administrator/edit-area/' . $reference_id . '/edit')->with('blank', true);
        }

        //Duplicate checked
        $count = DB::table('area')
                ->where('area_name', '=', $area_name)
                ->where('area_id', '<>', $reference_id)
                ->count();

        if ($count > 0) {
            return Redirect::to('administrator/edit-area/' . $reference_id . '/edit')->with('exist', true);
        }
		DB::table('area')->where('area_id', '=', $reference_id)->update(array('area_name' => $area_name));
		return Redirect::to('administrator/edit-area/' . $reference_id . '/edit')->with('success', true);
    }
	
	public function deleteArea($id) {
        DB::table('area')->where('id', '=', $id)->delete();
        return Redirect::to('administrator/manage-area');
    }
	
	//Restaurant page coding starts here
	public function viewRestaurant() {
        $data = DB::table('restaurant')
				->join('area', 'area.area_id', '=', 'restaurant.area_id')
				->orderBy('rest_id', 'DESC')->get();
        return view('admin.restaurant')->with('data', $data);
    }
	
	public function viewAddRestaurant() {
		$area = DB::table('area')->pluck('area_name','area_id')->prepend('Please Select...', '');
        return view('admin.add-restaurant')->with('area', $area);
    }
	
	public function saveRestaurant(Request $request){
		$area_id = $request->input('area_id');
		$restaurant_name = $request->input('restaurant_name');
        $delivery_time = $request->input('delivery_time');
        $description = $request->input('description');
		$email = $request->input('email');
		$phone = $request->input('phone');
		$minimum_order = $request->input('minimum_order');
		$rating = $request->input('rating');
        if ($area_id == "" || $restaurant_name == "" || $delivery_time == "" || $description =="" || $email == "" || $phone == "" || $minimum_order == "" || $rating == "") {
            return Redirect::to('administrator/add-restaurant')->with('blank', true);
        }
		$ext = strtolower($request->file('image')->getClientOriginalExtension());
	  if ($request->file('image') != "" && $ext != "png" && $ext != "jpg" && $ext != "jpeg") {
	  	return Redirect::to('administrator/add-restaurant')->with('invformat', true)->withInput();
	  }
		//Duplicate checked
        $count = DB::table('restaurant')
                ->where('area_id', '=', $area_id)
				->where('restaurant_name', '=', $restaurant_name)
                ->count();
		if ($count == 0) {
            //Laravel photo cropping
            if ($request->file('image')) {
		$restaurant_img = date('dmy') . time() . '.' . $request->file('image')->getClientOriginalExtension();
			$thumb_img = Image::make($request->file('image')->getRealPath())->resize(370, 280);
			$thumb_img->save(public_path() . '/restaurant/' . $restaurant_img, 80);
            } else {
                $restaurant_img = "";
            }
            DB::table('restaurant')->insert(array('area_id' => $area_id, 'restaurant_name' => $restaurant_name, 'delivery_time' => $delivery_time, 'description' => $description, 'image' => $restaurant_img, 'minimum_order' => $minimum_order, 'rating' => $rating, 'email' => $email, 'phone' => $phone, 'shorting' => '0', 'status' => '0', 'created_date' => date('Y-m-d')));
            return Redirect::to('administrator/add-restaurant')->with('success', true);
        } else {
            return Redirect::to('administrator/add-restaurant/')->with('exist', true);
        }

		}
	
	public function viewEditRestaurant($reference_id) {
        $data = DB::table('restaurant')->where('rest_id', '=', $reference_id)->first();
		$area = DB::table('area')->pluck('area_name','area_id');
        return view('admin.edit-restaurant')->with('area', $area)->with('data', $data);
    }
	
	public function updateRestaurant(Request $request) {
        $reference_id = $request->input('reference_id');
		$area_id = $request->input('area_id');
		$restaurant_name = $request->input('restaurant_name');
        $delivery_time = $request->input('delivery_time');
        $description = $request->input('description');
		$email = $request->input('email');
		$phone = $request->input('phone');
		$minimum_order = $request->input('minimum_order');
		$rating = $request->input('rating');
        if ($reference_id == "" || $area_id == "" || $restaurant_name == "" || $delivery_time == "" || $description =="" || $email == "" || $phone == "" || $minimum_order == "" || $rating == "") {
            return Redirect::to('administrator/edit-restaurant/' . $reference_id . '/edit')->with('blank', true);
        }
        //Duplicate checked
        $count = DB::table('restaurant')
                ->where('area_id', '=', $area_id)
				->where('restaurant_name', '=', $restaurant_name)
                ->where('rest_id', '<>', $reference_id)
                ->count();
        if ($count > 0) {
            return Redirect::to('administrator/edit-restaurant/' . $reference_id . '/edit')->with('exist', true);
        }
		if($request->file('image') != ""){
			$ext = strtolower($request->file('image')->getClientOriginalExtension());
            if($request->file('image') != "" && $ext != "png" && $ext != "jpg" && $ext != "jpeg") {
                return Redirect::to('administrator/edit-restaurant/' . $reference_id . '/edit')->with('invformat', true);
            }

            if ($request->file('image') != "" && $ext == "png" || $ext == "jpg" || $ext == "jpeg") {
                //Unlink code starts here
                $data = DB::table('restaurant')->where('rest_id', '=', $reference_id)->get();
                if ($data[0]->image != '') {
					$unlink_path = "public/restaurant/" . $data[0]->image;
                    unlink($unlink_path);
                }
                //Unlink code ends here
				
                //Laravel photo cropping
                $restaurant_image = date('dmy') . time() . '.' . $request->file('image')->getClientOriginalExtension();

                //Thumb Photo Uploading
                $thumb_img = Image::make($request->file('image')->getRealPath())->resize(370, 280);
                $thumb_img->save(public_path() . '/restaurant/' . $restaurant_image, 80);

                DB::table('restaurant')->where('rest_id', '=', $reference_id)->update(array('image' => $restaurant_image));
            }
        }
		
		$updated_date = date("Y-m-d");
		DB::table('restaurant')->where('rest_id', '=', $reference_id)->update(array('area_id' => $area_id,
		  		'restaurant_name' => $restaurant_name,
                'delivery_time' => $delivery_time,
                'description' => $description,
		    	'minimum_order' => $minimum_order,
			 	'rating' => $rating,
			 	'email' => $email,
				'phone' => $phone,
				'updated_date' => $updated_date));
		return Redirect::to('administrator/edit-restaurant/' . $reference_id . '/edit')->with('success', true);
    }
	
	public function deleteRestaurant($id) {
		$cat_data = DB::table('restaurant')->where('rest_id', '=', $id)->first();
        if ($cat_data->image != '') {
            $unlink_path = "public/restaurant/" . $cat_data->image;
            if (file_exists($unlink_path)) {
                unlink($unlink_path);
            }
        }
        DB::table('restaurant')->where('rest_id', '=', $id)->delete();
        return Redirect::to('administrator/restaurant');
    }
	
	//Manage Category 
	public function manageCategory() {
		$data = DB::table('category')
				->join('restaurant', 'category.restaurant_id', '=', 'restaurant.rest_id')
				->get();
        return view('admin.manage-category')->with('data', $data);
    }
	
	public function viewAddCategory() {
        $restaurant = DB::table('restaurant')->pluck('restaurant_name','rest_id')->prepend('Please Select...', '');
        return view('admin.add-category')->with('restaurant', $restaurant);
    }
	
	public function saveCategory(Request $request){
		$restaurant_id = $request->input('restaurant_id');
		$category_name = $request->input('category_name');
		
        if ($restaurant_id == "" || $category_name == "") {
            return Redirect::to('administrator/add-category')->with('blank', true);
        }
		
		//Duplicate checked
        $count = DB::table('category')
                ->where('restaurant_id', '=', $restaurant_id)
				->where('category_name', '=', $category_name)
                ->count();
		if ($count == 0) {
            DB::table('category')->insert(array('restaurant_id' => $restaurant_id, 'category_name' => $category_name, 'status' => '1'));
            return Redirect::to('administrator/add-category')->with('success', true);
        } else {
            return Redirect::to('administrator/add-category/')->with('exist', true);
        }

		}
	
	public function viewEditCategory($reference_id) {
        $data = DB::table('category')->where('category_id', '=', $reference_id)->first();
		$restaurant = DB::table('restaurant')->pluck('restaurant_name','rest_id');
        return view('admin.edit-category')->with('restaurant', $restaurant)->with('data', $data);
    }
	
	public function updateCategory(Request $request) {
        $reference_id = $request->input('reference_id');
		$restaurant_id = $request->input('restaurant_id');
		$category_name = $request->input('category_name');
        if ($reference_id == "" || $restaurant_id == "" || $category_name == "") {
            return Redirect::to('administrator/edit-category/' . $reference_id . '/edit')->with('blank', true);
        }
        //Duplicate checked
        $count = DB::table('category')
                ->where('restaurant_id', '=', $restaurant_id)
				->where('category_name', '=', $category_name)
                ->where('category_id', '<>', $reference_id)
                ->count();
        if ($count > 0) {
            return Redirect::to('administrator/edit-category/' . $reference_id . '/edit')->with('exist', true);
        }
		DB::table('category')
			->where('category_id', '=', $reference_id)
			->update(array(
				'restaurant_id' => $restaurant_id,
		  		'category_name' => $category_name));
		return Redirect::to('administrator/edit-category/' . $reference_id . '/edit')->with('success', true);
    }
	
	public function deleteCategory($id) {
		DB::table('product')->where('category_id', '=', $id)->delete();
		DB::table('subcategory')->where('cate_id', '=', $id)->delete();
        DB::table('category')->where('category_id', '=', $id)->delete();
        return Redirect::to('administrator/manage-category');
    }
	
	//Manage Subcategory
	public function manageSubategory() {
		$data = DB::table('subcategory')
				->join('category', 'subcategory.cate_id', '=', 'category.category_id')
				->join('restaurant', 'subcategory.restaurant_id', '=', 'restaurant.rest_id')
				->get();
        return view('admin.manage-subcategory')->with('data', $data);
    }
	
	public function viewAddSubcategory() {
        $restaurant = DB::table('restaurant')->pluck('restaurant_name','rest_id')->prepend('Please Select...', '');
        return view('admin.add-subcategory')->with('restaurant', $restaurant);
    }
	
	public function FindCategory(Request $request) {
        $id = $request->input('id');
        if ($id != "") {
            $category = DB::table('category')->select('category_name', 'category_id')->where('restaurant_id', '=', $id)->get();
            $data = array(
                'category' => $category
            );
            echo json_encode($data); exit;
        } else {
            echo "0"; exit;
        }
    }
	
	public function saveSubcategory(Request $request){
		$restaurant_id = $request->input('restaurant_id');
		$category_name = $request->input('category_name');
		$subcategory_name = $request->input('subcategory_name');
		
        if ($restaurant_id == "" || $category_name == "" || $subcategory_name == "") {
            return Redirect::to('administrator/add-subcategory')->with('blank', true);
        }
		
		//Duplicate checked
        $count = DB::table('subcategory')
                ->where('restaurant_id', '=', $restaurant_id)
				->where('cate_id', '=', $category_name)
				->where('subcategory_name', '=', $subcategory_name)
                ->count();
		if ($count == 0) {
            DB::table('subcategory')->insert(array('cate_id' => $category_name, 'restaurant_id' => $restaurant_id, 'subcategory_name' => $subcategory_name, 'status' => '1'));
            return Redirect::to('administrator/add-subcategory')->with('success', true);
        } else {
            return Redirect::to('administrator/add-subcategory/')->with('exist', true);
        }

		}
	
	public function viewEditSubcategory($reference_id) {
        $data = DB::table('subcategory')->where('sub_caid', '=', $reference_id)->first();
		$category = DB::table('category')->pluck('category_name','category_id');
		$restaurant = DB::table('restaurant')->pluck('restaurant_name','rest_id');
        return view('admin.edit-subcategory')->with('category', $category)->with('restaurant', $restaurant)->with('data', $data);
    }
	
	public function updateSubcategory(Request $request) {
        $reference_id = $request->input('reference_id');
		$restaurant_id = $request->input('restaurant_id');
		$category_name = $request->input('category_name');
		$subcategory_name = $request->input('subcategory_name');
        if ($reference_id == "" || $restaurant_id == "" || $category_name == "" || $subcategory_name == "") {
            return Redirect::to('administrator/edit-subcategory/' . $reference_id . '/edit')->with('blank', true);
        }
        //Duplicate checked
        $count = DB::table('subcategory')
                ->where('restaurant_id', '=', $restaurant_id)
				->where('cate_id', '=', $category_name)
				->where('subcategory_name', '=', $subcategory_name)
                ->where('sub_caid', '<>', $reference_id)
                ->count();
        if ($count > 0) {
            return Redirect::to('administrator/edit-subcategory/' . $reference_id . '/edit')->with('exist', true);
        }
		DB::table('subcategory')
			->where('sub_caid', '=', $reference_id)
			->update(array(
				'restaurant_id' => $restaurant_id,
		  		'cate_id' => $category_name,
				'subcategory_name' => $subcategory_name));
		return Redirect::to('administrator/edit-subcategory/' . $reference_id . '/edit')->with('success', true);
    }
	
	public function deleteSubcategory($id) {
		DB::table('product')->where('subcategory_id', '=', $id)->delete();
		DB::table('subcategory')->where('sub_caid', '=', $id)->delete();
        return Redirect::to('administrator/manage-subcategory');
    }
	
	//Manage Item
	public function manageItems() {
		$data = DB::table('product')
				->join('restaurant', 'product.restaurant_id', '=', 'restaurant.rest_id')
				->join('category', 'product.category_id', '=', 'category.category_id')
				->get();
        return view('admin.manage-items')->with('data', $data);
    }
	
	public function viewAddItems() {
        $restaurant = DB::table('restaurant')->pluck('restaurant_name','rest_id')->prepend('Select Restaurant...', '');
        return view('admin.add-items')->with('restaurant', $restaurant);
    }
	
	public function FindSubcategory(Request $request) {
        $id = $request->input('id');
        if ($id != "") {
            $subcategory = DB::table('subcategory')->select('subcategory_name', 'sub_caid')->where('cate_id', '=', $id)->get();
            $data = array(
                'subcategory' => $subcategory
            );
            echo json_encode($data); exit;
        } else {
            echo "0"; exit;
        }
    }
	
	public function saveItems(Request $request){
		$restaurant_id = $request->input('restaurant_id');
		$category_name = $request->input('category_name');
		$subcategory_id = $request->input('subcategory_id');
		$item_name = $request->input('item_name');
		$description = $request->input('description');
		$price = $request->input('price');
		$type = $request->input('type');
		
        if ($restaurant_id == "" || $category_name == "" || $item_name == "" || $price == "" || $type == "") {
            return Redirect::to('administrator/add-items')->with('blank', true);
        }
        if ($request->file('image')) {
		$ext = strtolower($request->file('image')->getClientOriginalExtension());
	    if ($request->file('image') != "" && $ext != "png" && $ext != "jpg" && $ext != "jpeg") {
	  	return Redirect::to('administrator/add-items')->with('invformat', true)->withInput();
	  }
    }
		//Duplicate checked
        $count = DB::table('product')
                ->where('restaurant_id', '=', $restaurant_id)
				->where('category_id', '=', $category_name)
				->where('subcategory_id', '=', $subcategory_id)
				->where('item_name', '=', $item_name)
                ->count();
		if ($count == 0) {
			//Laravel photo cropping
            if ($request->file('image')) {
			$dishes_img = date('dmy') . time() . '.' . $request->file('image')->getClientOriginalExtension();
			$thumb_img = Image::make($request->file('image')->getRealPath())->resize(160, 159);
			$thumb_img->save(public_path() . '/images/dishes/' . $dishes_img, 80);
            } else {
                $dishes_img = "";
            }
			
            DB::table('product')->insert(array('restaurant_id' => $restaurant_id, 'category_id' => $category_name, 'subcategory_id' => $subcategory_id, 'pimage' => $dishes_img, 'item_name' => $item_name, 'description' => $description, 'price' => $price, 'type' => $type, 'status' => '1'));
            return Redirect::to('administrator/add-items')->with('success', true);
        } else {
            return Redirect::to('administrator/add-items')->with('exist', true);
        }

		}
	
    public function viewEditItems($reference_id){
        $data = DB::table('product')->where('product_id', '=', $reference_id)->first();
        $restaurant = DB::table('restaurant')->pluck('restaurant_name','rest_id')->prepend('Select Restaurant...', '');
        $category = DB::table('category')->where('restaurant_id','=',$data->restaurant_id)->pluck('category_name','category_id')->prepend('Select Category...', '');
        $subcategory = DB::table('subcategory')->where('cate_id','=',$data->category_id)->pluck('subcategory_name','sub_caid')->prepend('Select Subcategory...', '');
        
        return view('admin.edit-items')->with('restaurant', $restaurant)->with('category', $category)->with('subcategory', $subcategory)->with('data', $data);
    }

    public function updateItems(Request $request){
        $reference_id = $request->input('reference_id');
        $restaurant_id = $request->input('restaurant_id');
        $category_name = $request->input('category_name');
        $subcategory_id = $request->input('subcategory_id');
        $item_name = $request->input('item_name');
        $description = $request->input('description');
        $price = $request->input('price');
        $type = $request->input('type');
        
        if ($reference_id == "" || $restaurant_id == "" || $category_name == "" || $item_name == "" || $price == "" || $type == "") {
            return Redirect::to('administrator/edit-items/' . $reference_id . '/edit')->with('blank', true);
        }
        //Duplicate checked
        $count = DB::table('product')
                ->where('restaurant_id', '=', $restaurant_id)
                ->where('category_id', '=', $category_name)
                ->where('subcategory_id', '=', $subcategory_id)
                ->where('item_name', '=', $item_name)
                ->where('product_id', '<>', $reference_id)
                ->count();
        if ($count > 0) {
            return Redirect::to('administrator/edit-items/' . $reference_id . '/edit')->with('exist', true);
        }

        if($request->file('image') != ""){
            $ext = strtolower($request->file('image')->getClientOriginalExtension());
            if($request->file('image') != "" && $ext != "png" && $ext != "jpg" && $ext != "jpeg") {
                return Redirect::to('administrator/edit-items/' . $reference_id . '/edit')->with('invformat', true);
            }

            if ($request->file('image') != "" && $ext == "png" || $ext == "jpg" || $ext == "jpeg") {
                //Unlink code starts here
                $data = DB::table('product')->where('product_id', '=', $reference_id)->get();
                if ($data[0]->pimage != '') {
                    $unlink_path = "public/images/dishes/" . $data[0]->pimage;
                    unlink($unlink_path);
                }
                //Unlink code ends here
                
                //Laravel photo cropping
                $dishes_img = date('dmy') . time() . '.' . $request->file('image')->getClientOriginalExtension();

                //Thumb Photo Uploading
                $thumb_img = Image::make($request->file('image')->getRealPath())->resize(160, 159);
                $thumb_img->save(public_path() . '/images/dishes/' . $dishes_img, 80);

                DB::table('product')->where('product_id', '=', $reference_id)->update(array('pimage' => $dishes_img));
            }
        }
        
        DB::table('product')->where('product_id', '=', $reference_id)->update(array('restaurant_id' => $restaurant_id,
                'category_id' => $category_name,
                'subcategory_id' => $subcategory_id,
                'item_name' => $item_name,
                'description' => $description,
                'price' => $price,
                'type' => $type));
        return Redirect::to('administrator/edit-items/' . $reference_id . '/edit')->with('success', true);
    }
    public function deleteItems($id){
        //Unlink code starts here
        $pro_data = DB::table('product')->where('product_id', '=', $id)->first();
        if ($pro_data->pimage != '') {
            $unlink_path = "public/images/dishes/" . $pro_data->pimage;
            if (file_exists($unlink_path)) {
                unlink($unlink_path);
            }
        }
        DB::table('product')->where('product_id', '=', $id)->delete();
        return Redirect::to('administrator/manage-items');
    }
    ###############  Ajax Part Start #####################################

    ###############  Ajax Part  END #####################################
}
