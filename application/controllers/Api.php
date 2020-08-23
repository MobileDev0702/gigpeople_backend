<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller {

    public function __construct()
    {
        parent::__construct();  
        $this->load->model('Api_model');
        $this->load->model('Admin_model');
        $this->load->helper('url');
    }
    
    //=========================== User Signup ===============================//

    function signup()
    {
        $email_id       = $this->input->post('email_id');
        $first_name     = $this->input->post('first_name');
        $last_name      = $this->input->post('last_name');
        $password       = $this->input->post('password');
        $device_type    = $this->input->post('device_type');
        $device_token   = $this->input->post('device_token');
        
        $this->formValidation("Email Id",$email_id,"required");
        $this->formValidation("First Name",$first_name,"required");
        $this->formValidation("Last Name",$last_name,"required");
        $this->formValidation("Password",$password,"required");
        $this->formValidation("Device Type",$device_type,"required");
        $this->formValidation("Device Token",$device_token,"required");
        
        $check_user1= (array) $this->getUserDetails(array("email"=>$email_id));
    
        if(empty($check_user1))
        {
        
            $userData=array(
            
                'user_type'=>'3',
                
                'first_name'=>$first_name,
                
                'last_name'=>$last_name,
                
                'email'=>$email_id,
                
                'password'=>md5($password),
                
                'device_type'=>$device_type,
                
                'device_token'=>$device_token,
                
                'notification'=>1,
                
                'account_status'=>0,

                'live_status'=>1,
                
                'created_at'=>date('Y-m-d H:i:s')
            
            );
            
            $user_id=$this->Api_model->addUser('',$userData);
            
            if($user_id)
            {
                $data['status']="1";
                
                $data['message']="Success";                       
                
                $data['user_details']=$this->getUserDetails("id='$user_id'"); 
                
                $this->welcomeMail($user_id);
                           
                $this->prepreFcm('signup',array('user_id'=>$user_id));
            }
            else
            {
                $data['status']="0";
                
                $data['message']="Something went wrong";
            }
        }
        else
        {
            $data['status']="0";
            
            $data['message']="Email Id already Exist!!";
        }
        
        header( 'Content-type:application/json');
        
        print json_encode( $data);
        
        exit;
    }
    
    //=========================== User Details ===============================//

    function getUserDetails($condition)
    {
        $user_details = $this->Api_model->getUserDetails($condition)->row();
        
        $userDetails=array();
        
        if(!empty($user_details))
        {
            $user_id            = $user_details->id;
            
            $gig_list           = $this->Api_model->GigList(array('user_id'=>$user_id,'status'=>'2'))->result_array();
            $gigCount           = count($gig_list);
            
            $buyerReview        = $this->Api_model->RatingList(array('buyer_id'=>$user_id))->result_array();
            $buyerreviewCount   = count($buyerReview);
            
            $sellerReview       = $this->Api_model->RatingList(array('seller_id'=>$user_id))->result_array();
            $sellerreviewCount  = count($sellerReview);

            $reviewCount        = $sellerreviewCount;
            
			$sellerRating = round($this->Api_model->rating(array('seller_id'=>$user_id),'avg(seller_rating) as rating')->row()->rating);
			$Rating = !empty($sellerRating) ? $sellerRating : '0';
            
            $userDetails=array(
                
                'user_id'             => $user_id,
                'first_name'          => trim($user_details->first_name),
                'last_name'           => trim($user_details->last_name),
                'email'               => $user_details->email,
                'email_otp'           => $user_details->email_otp,
                'is_email_verified'   => $user_details->is_email_verified,
                'profile'             => $user_details->profile_picture,
                'profile_image_url'   => $this->getImage($user_details->profile_picture,'profile_image'),
                'mobile_country'      => $user_details->mobile_country,
                'phone_no'            => $user_details->phone_no,
                'mobile_otp'          => $user_details->mobile_otp,
                'is_mobile_verified'  => $user_details->is_mobile_verified,
                'address'             => $user_details->address,
                'lattitude'           => $user_details->lattitude,
                'longitude'           => $user_details->longitude,
                'about'               => $user_details->about,
                'profile_link'        => $user_details->profile_link,
                'skills'              => $user_details->skills,
                'language'            => $user_details->language,
                'wallet'              => $user_details->wallet,
                'rating'              => "$Rating",
                'no_of_reviews'       => "$reviewCount",
                'no_of_gigpost'       => "$gigCount",
                'join_date'           => $user_details->created_at,
                'notification'        => $user_details->notification,
                'customer_order'      => $user_details->customer_order,
                'account_status'      => $user_details->account_status                
            );               
            
            return $userDetails;
        }
        else
        {
            $obj = (object) $userDetails;
            return $obj;
        }
    }
    
    //=========================== User Login ===============================//

    function signIn()
    {
        $email_id=$this->input->post('email_id');
        
        $password=$this->input->post('password');
        
        $device_type=$this->input->post('device_type');
        
        $device_token=$this->input->post('device_token');
        
        $this->formValidation("Email ID",$email_id,"required");
        
        $this->formValidation("Password",$password,"required");
        
        $this->formValidation("Device Type",$device_type,"required");
        
        $this->formValidation("Device Token",$device_token,"required");
        
        $check_user= (array) $this->getUserDetails("(phone_no='$email_id' or email='$email_id')");
        
        if(!empty($check_user))
        {
            
            $password=md5($password);
            
            $check_password= (array) $this->getUserDetails("(phone_no='$email_id' or email='$email_id') and (password ='$password')");
            
            if(!empty($check_password))
            {
                $user_id=$check_user['user_id'];
                
                $this->checkAccountStatus($user_id);
                
                $userData=array(
                
                    'device_type'=>$device_type,
                    
                    'device_token'=>$device_token,
                    
                    'live_status'=>1,
                    
                    'updated_at'=>date('Y-m-d H:i:s'),
                
                );
                
                $this->Api_model->addUser($user_id,$userData);
                
                $data['status']="1";
                
                $data['message']="Login Success";
                
                $data['user_id']=$user_id;
                
                $data['user_details']=$this->getUserDetails(array("id"=>$user_id));       
            }
            else
            {
                $data['status']="0";
                
                $data['message']="Password is incorrect";
            }
        }
        else
        {
            $data['status']="0";
            
            $data['message']="Email Id or Mobile no does not Exist";
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== Social Login ===============================//
    
    function socialLogin()
    {
        $email_id       = $this->input->post('email_id');
        $first_name     = $this->input->post('first_name');
        $last_name      = $this->input->post('last_name');
        $device_type    = $this->input->post('device_type');
        $device_token   = $this->input->post('device_token');

        $this->formValidation("User name",$email_id,"required");
        $this->formValidation("Device type",$device_type,"required");
        $this->formValidation("Device Token",$device_token,"required");
        
        $check_user=(array) $this->getUserDetails("(phone_no='$email_id' or email='$email_id')");
        
        if(!empty($check_user))
        {         
            $user_id=$check_user['user_id'];
            
            $this->checkAccountStatus($user_id);
            
            $userData=array(
            
                'device_type'=>$device_type,
                
                'device_token'=>$device_token,
                
                'updated_at'=>date('Y-m-d H:i:s'),
            
            );
            
            $this->Api_model->addUser($user_id,$userData);
            
            $data['status']="1";
            
            $data['message']="Login Success";
            
            $data['user_id']=$user_id;
            
            $data['user_details']=$this->getUserDetails(array("id"=>$user_id));
        }
        else
        {
            $userData=array(
                
                'user_type'=>'3',

                'first_name'=>$first_name ? $first_name : '',

                'last_name'=>$last_name ? $last_name : '',

                'email'=>$email_id,

                'notification'=>1,
                
                'account_status'=>0,

                'live_status'=>1,

                'device_type'=>$device_type,

                'device_token'=>$device_token,

                'created_at'=>date('Y-m-d H:i:s'),
            );

            $user_id=$this->Api_model->addUser('',$userData);
            
            if($user_id)
            {
                   $data['status']="1";

                   $data['message']="Account Created Successfully";

                   $data['user_id']=$user_id;

                   $data['user_details']=$this->getUserDetails(array("id"=>$user_id));
                   
                   $this->welcomeMail($user_id);
                   
                   $this->prepreFcm('signup',array('user_id'=>$user_id));
            }
            else
            {
                   $data['status']="0";

                   $data['message']="Something went wrong";
            }
        }
        
        header( 'Content-type:application/json');
        
        print json_encode( $data);
        
        exit;
    }
    
    //=========================== Forgotpassword ===============================//
    
    function forgotPassword()
    {
        $email_id=$this->input->post('email_id');
        
        $this->formValidation("Email Id",$email_id,"required");
        
        $check_user=(array) $this->getUserDetails("email='$email_id'");
        
        if(!empty($check_user))
        {
            $user_id=$check_user['user_id'];
            
            $this->checkAccountStatus($user_id);
            
            $to_name=$check_user['first_name']." ".$check_user['last_name'];
            
            $new_password=rand();
            
            $userData=array(
            
                'password'=>md5($new_password),
                
                'updated_at'=>date('Y-m-d H:i:s'),
            
            );
            
            if($this->Api_model->addUser($user_id,$userData))
            {
                $this->sendmail($email_id,$to_name,$new_password);
                
                $data['status']="1";
                
                $data['message']="Password sent to your emailId";
                
                $data['New Password']="$new_password";          
            }
            else
            {
                $data['status']='0';
                
                $data['message']='Something went wrong !! ';
            }
        }
        else
        {
            $data['status']="0";
            
            $data['message']="Email Id Doesnot Exist";
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
     
    //=========================== Change Password ===============================//
    
    function changePassword()
    {
        $user_id=$this->input->post('user_id');
        
        $old_password=$this->input->post('old_password');
        
        $new_password=$this->input->post('new_password');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("Old Password",$old_password,"required");
        
        $this->formValidation("New Password",$new_password,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
            $data['status']="0";
            
            $data['message']="User Not Found";
        }
        else
        {
            $this->checkAccountStatus($user_id);
            
            $old_password=md5($old_password);
            
            $oldpassword_check=$this->Api_model->getUserDetails("(id='$user_id' and password='$old_password')")->row();
            
            if(empty($oldpassword_check))
            {
                $data['status']="0";
                
                $data['message']="Old Password is incorrect";
            }
            else
            {
                $userData=array(
                    
                    'password'=>md5($new_password),
                    
                    'updated_at'=>date('Y-m-d H:i:s'),
                
                );
                
                $this->Api_model->addUser($user_id,$userData);
                
                $data['status']="1";
                
                $data['message']="Password changed Successfully";
                
                $data['user_id']=$user_id;
                
                $data['user_details']=$this->getUserDetails("id='$user_id'");
            }   
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
     
    //=========================== Terms and Conditions ===============================//
    
    function terms()
    {
        $data['terms']=$this->Admin_model->getAdminDetails(array('admin_id'=>'1'))->row();
        
        $this->load->view("termsview",$data);
    }
    
    //=========================== Privacy Policy ===============================//
    
    function privacy()
    {
        $data['privacy']=$this->Admin_model->getAdminDetails(array('admin_id'=>'1'))->row();
        
        $this->load->view("privacyview",$data);
    }
    
    //=========================== Profile View ===============================//
    
    function profileView()
    {
        $user_id=$this->input->post('user_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        $buyerRating = $this->Api_model->RatingList(array('buyer_id'=>$user_id,'buyer_review!='=>''))->result_array();
        
        $buyerRatingList=array();
        
        if(!empty($buyerRating)) {
        
            foreach ($buyerRating as $key => $value)
            { 
                $seller_id    = $value['seller_id'];
                
                $userData = $this->Api_model->get_where_row("app_user",array('id' => $seller_id));

                if(!empty($userData)) {
                                
                    $buyerRatingList[] =[
                        
                        'first_name'          => trim($userData->first_name),
                        'last_name'           => trim($userData->last_name),
                        'profile'             => $userData->profile_picture,
                        'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                        'review'              => $value['buyer_review'],
                        'rating'              => $value['buyer_rating'],
                        'is_date'             => $value['created_at'],
                    ];
                }
            }
        }
        
        $sellerRating = $this->Api_model->RatingList(array('seller_id'=>$user_id,'seller_review!='=>''))->result_array();
        
        $sellerRatingList=array();

        if(!empty($sellerRating)) {
        
            foreach ($sellerRating as $key => $value)
            { 
                $buyer_id    = $value['buyer_id'];
                
                $Buyer = $this->Api_model->get_where_row("app_user",array('id' => $buyer_id));

                if(!empty($Buyer)) {
                
                    $sellerRatingList[] =[
                        
                        'first_name'          => trim($Buyer->first_name),
                        'last_name'           => trim($Buyer->last_name),
                        'profile'             => $Buyer->profile_picture,
                        'profile_image_url'   => $this->getImage($Buyer->profile_picture,'profile_image'),
                        'review'              => $value['seller_review'],
                        'rating'              => $value['seller_rating'],
                        'is_date'             => $value['created_at'],
                        
                    ];
                } 
            }
        }
        
        $buyerReview        = $this->Api_model->RatingList(array('buyer_id'=>$user_id,'buyer_review!='=>''))->result_array();
        $buyerreviewCount   = count($buyerReview);
        
        $sellerReview       = $this->Api_model->RatingList(array('seller_id'=>$user_id,'seller_review!='=>''))->result_array();
        $sellerreviewCount  = count($sellerReview);
        
        if(!empty($check_user))
        {
            $this->checkAccountStatus($user_id);
            
            $data['status']="1";
            $data['message']="Success";
            $data['user_id']=$user_id;
            
            $data['user_details'] = $this->getUserDetails(array("id"=>$user_id));
            
            $data['buyer_reviewcount']  = "$buyerreviewCount";            
            $data['buyer_reviews']      = $buyerRatingList;
            
            $data['seller_reviewcount'] = "$sellerreviewCount";           
            $data['seller_reviews']     = $sellerRatingList;
            
            
            /*$data['buyer_reviewcount']  = "$buyerreviewCount";            
            $data['buyer_reviews']      = $buyerRatingList;
            
            $data['seller_reviewcount'] = "$sellerreviewCount";           
            $data['seller_reviews']     = $sellerRatingList;*/
        }
        else
        {
            $data['status']="0";            
            $data['message']="User Doesnot Exist";
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;    
    }
   
    //=========================== Chat Add ===============================//
    
    function chatAdd()
    {
        $from_user_id = $this->input->post('from_user_id');
        
        $to_user_id   = $this->input->post('to_user_id');
        
        $message      = $this->input->post('message');
        
        $firebase_id  = $this->input->post('firebase_id');
        
        $this->formValidation("From User Id",$from_user_id,"required");
        
        $this->formValidation("To User Id",$to_user_id,"required");
        
        $this->formValidation("Message",$message,"required");
        
        $this->formValidation("Firebase Id",$firebase_id,"missing");
        
        $from_user=(array) $this->getUserDetails("id='$from_user_id'");
        
        $to_user=(array) $this->getUserDetails("id='$to_user_id'");
        
        if(empty($from_user) || empty($to_user))
        {
            $data['status']="0";
            
            $data['message']="From User or To User not Found";
        }
        else
        {
        
            $check_chat=$this->Api_model->checkChat("(from_user_id='$from_user_id' and to_user_id='$to_user_id') or (from_user_id='$to_user_id' and to_user_id='$from_user_id')")->row();
        
            if(empty($check_chat)) //no record so add
            {
            
                $chatData=array(
                
                    'from_user_id'=>$from_user_id,
                    
                    'to_user_id'=>$to_user_id,
                    
                    'message'=>$message,
                    
                    'to_user_unread_count'=>1,
                    
                    'firebase_id'=>$firebase_id,
                    
                    'created_at'=>date('Y-m-d H:i:s')
                
                );
                
                $this->Api_model->addChat('',$chatData);
                
                $this->prepreFcm('chatsent',array('user_id'=>$to_user_id,'from_user_id'=>$from_user_id));
            
            }
            else
            {
                $chat_id=$check_chat->id;
                
                $from_user_idO=$check_chat->from_user_id;
                
                $to_user_idO=$check_chat->to_user_id;
                
                if($from_user_id==$from_user_idO)
                {
                    $unread_count=$check_chat->to_user_unread_count+1;
                    
                    $count_lable_name="to_user_unread_count";
                }
                
                if($from_user_id==$to_user_idO)
                {
                    $unread_count=$check_chat->from_user_unread_count+1;
                    
                    $count_lable_name="from_user_unread_count";
                }
                
                $chatData=array(
                
                    // 'from_user_id'=>$from_user_id,
                    
                    // 'to_user_id'=>$to_user_id,
                    
                    'message'=>$message,
                    
                    $count_lable_name=>$unread_count,
                    
                    'firebase_id'=>$firebase_id,
                    
                    'created_at'=>date('Y-m-d H:i:s')
                
                );
                
                $this->Api_model->addChat(array('id'=>$chat_id),$chatData);
                
               $this->prepreFcm('chatsent',array('user_id'=>$to_user_id,'from_user_id'=>$from_user_id));
                
            }
                
            $data['status']="1";
            
            $data['message']="Chat Added Successfully";
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }

    //=========================== Chat List ===============================//
    
    function chatList()
    {
        $user_id=$this->input->post('user_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
            $data['status']="0";
            
            $data['message']="User not Found";
        }
        else
        {
            $this->checkAccountStatus($user_id);
            
            $chat_list=$this->Api_model->checkChat("(from_user_id='$user_id') or (to_user_id='$user_id')")->result_array();
            
            $chatList=array();
            
            foreach ($chat_list as $key => $value) 
            {
                $from_user_id=$value['from_user_id'];
                
                $to_user_id=$value['to_user_id'];
                
                $created_at=$value['created_at'];
                
                if($from_user_id==$user_id)
                {
                    $to_user=$to_user_id;
                    
                    $message_count=$value['from_user_unread_count'];
                }
                
                if($to_user_id==$user_id)
                {
                    $to_user=$from_user_id;
                    
                    $message_count=$value['to_user_unread_count'];
                }
            
                $chatList[]=[
                
                    'to_user_id'=>$to_user,
                    
                    'to_user_details'=>$this->getUserDetails("id='$to_user'"),
                    
                    'message'=>$value['message'],
                    
                    'message_count'=>$message_count,
                    
                    'firebase_id'=>$value['firebase_id'],
                    
                    'chat_status'=>$value['status'],
                    
                    'created_at'=>$created_at
                
                ];
            }
            
            $data['status']="1";
            $data['message']="Success";
            $data['chat_list']=$chatList;
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    function chatListDetails($user_id)
    {
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
            $data['status']="0";
            
            $data['message']="User not Found";
        }
        else
        {
            $this->checkAccountStatus($user_id);
            
            $chat_list=$this->Api_model->checkChat("(from_user_id='$user_id') or (to_user_id='$user_id')")->result_array();
            
            $chatList=array();
            
            foreach ($chat_list as $key => $value) 
            {
                $from_user_id=$value['from_user_id'];
                
                $to_user_id=$value['to_user_id'];
                
                $created_at=$value['created_at'];
                
                if($from_user_id==$user_id)
                {
                    $to_user=$to_user_id;
                    
                    $message_count=$value['from_user_unread_count'];
                }
                
                if($to_user_id==$user_id)
                {
                    $to_user=$from_user_id;
                    
                    $message_count=$value['to_user_unread_count'];
                }
            
                $chatList[]=[
                
                    'to_user_id'=>$to_user,
                    
                    'to_user_details'=>$this->getUserDetails("id='$to_user'"),
                    
                    'message'=>$value['message'],
                    
                    'message_count'=>$message_count,
                    
                    'firebase_id'=>$value['firebase_id'],
                    
                    'chat_status'=>$value['status'],
                    
                    'created_at'=>$created_at
                
                ];
            }
            
             return $chatList;
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }

    //=========================== Chat Read ===============================//
    
    function chatRead()
    {
        $user_id=$this->input->post('user_id');
        
        $to_user_id=$this->input->post('to_user_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("To User Id",$to_user_id,"required");
        
        $chat_list=$this->Api_model->checkChat("(from_user_id='$user_id' and to_user_id='$to_user_id') or (to_user_id='$user_id' and from_user_id='$to_user_id')")->row();

        if(!empty($chat_list))
        {
        
            $from_user_id_db = $chat_list->from_user_id;
            
            $to_user_id_db  = $chat_list->to_user_id;
            
            $chat_status   = $chat_list->status;
            
            
            
            if($from_user_id_db==$user_id)
            {
                $count_lable_name='from_user_unread_count';
            }
            
            if($to_user_id_db==$user_id)
            {
                $count_lable_name='to_user_unread_count';
            }
            
            $chatData=array(
            
                $count_lable_name=>0,
                
                'created_at'=>date('Y-m-d H:i:s')
            
            );
            
            if($this->Api_model->addChat("(from_user_id='$user_id' and to_user_id='$to_user_id') or (to_user_id='$user_id' and from_user_id='$to_user_id')",$chatData))
            {
                $data['status']="1";
                
                $data['message']="Chat Status Updated";
                
                $data['chat_status']= "$chat_status";
            }
            else
            {
                $data['status']="0";
                
                $data['message']="Something went wrong";
            }
        
        }
        else
        {
            $data['status']="1";
            
            $data['message']="No chat to read";
            
            $data['chat_status']="$chat_status";
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== Block User ====================================//

    function blockChat()
    {
        $user_id=$this->input->post('user_id');
    
        $friend_id=$this->input->post('friend_id');
    
        $this->formValidation("User Id",$user_id,"required");
    
        $this->formValidation("Friend Id",$friend_id,"required");
    
        $check_user=(array) $this->getUserDetails("id='$user_id'");
    
        $check_friend=(array) $this->getUserDetails("id='$friend_id'");
    
        if(empty($check_user) || empty($check_friend))
        {
            $data['status']="0";
    
            $data['message']="User Does not Exist";
        }
        else
        {
    
            $chat_list=$this->Api_model->getChatList("((from_user_id='$user_id' and to_user_id='$friend_id')  or (from_user_id='$friend_id' and to_user_id='$user_id'))")->row();
    
            $chat_status=$chat_list->status;
    
            if($chat_status!=2)//if they didnt bloacked yet means
            {
    
                $condition="(from_user_id='$user_id') or (to_user_id='$user_id')";
    
                $chatData=array(
    
                    'status'=>2
    
                );
            }
            else //already blocked remove block
            {
                $condition="((from_user_id='$user_id' and to_user_id='$friend_id')  or (from_user_id='$friend_id' and to_user_id='$user_id'))";
    
                $chatData=array(
    
                    'status'=>1
    
                );
            }
    
            if($this->Api_model->chatStatus($condition,$chatData))
            {
                $data['status']="1";
    
                $data['message']=($chat_status==2) ? "User Un-Blocked Successfully" : "User Blocked Successfully";
            }
            else
            {
                $data['status']="0";
    
                $data['message']="Something went wrong";
            }
        }
    
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit; 
    }

    //=========================== Logout ===============================//
    
    function logout()
    {
        $user_id=$this->input->post('user_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
            $data['status']="0";
            
            $data['message']="User not Found";
        }
        else
        {
            $userData=array(
                
                'device_type'=>'',
                
                'device_token'=>'',
                
                'live_status'=>0,
                
                'updated_at'=>date('Y-m-d H:i:s'),
            );
            
            if($this->Api_model->addUser($user_id,$userData))
            {
                $data['status']="1";
                
                $data['message']="Logout Successfully";
            }
            else
            {
                $data['status']="0";
                
                $data['message']="Something went wrong";
            } 
        }          
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;               
    }

    //=========================== Notifiction on / off ===============================//
    
    function pushnotification()
    {
        $user_id=$this->input->post('user_id');
        
        $notification=$this->input->post('notification');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("Notification Status",$notification,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(!empty($check_user))
        {
            $this->checkAccountStatus($user_id);
            
            $userData=array(
            
                'notification'=>$notification,
                
                'updated_at'=>date('Y-m-d H:i:s'),
            
            );
            
            if($this->Api_model->addUser($user_id,$userData))
            {
                $data['status']="1";
                
                $data['message']="Notification status Updated Successfully";                  
            }
            else
            {
                $data['status']='0';
                
                $data['message']='Something went wrong !! ';
            }
        }
        else
        {
            $data['status']="0";
            
            $data['message']="User Doesnot Exist";
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== Customer Order on / off ===============================//
    
    function customerOrders()
    {
        $user_id=$this->input->post('user_id');
        
        $customer_order=$this->input->post('customer_order');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("Customer Order Status",$customer_order,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(!empty($check_user))
        {
        
            $this->checkAccountStatus($user_id);
            
            $userData=array(
            
                'customer_order'=>$customer_order,
                
                'updated_at'=>date('Y-m-d H:i:s'),
            
            );
            
            if($this->Api_model->addUser($user_id,$userData))
            {
                $data['status']="1";
                
                $data['message']="Customer Order status Updated Successfully";                  
            }
            else
            {
                $data['status']='0';
                
                $data['message']='Something went wrong !! ';
            }
        }
        else
        {
            $data['status']="0";
            
            $data['message']="User Doesnot Exist";
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== Notification List ===============================//
    
    function notificationList()
    {
        $user_id=$this->input->post('user_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
            $data['status']="0";
            
            $data['message']="User Does not Exist";
        }
        else
        {
            $notification_list=$this->Api_model->getNotification(array('user_id'=>$user_id))->result_array();
            
            $notificationList=array();
            
            $notificationList=$notification_list;
            
            $data['status']="1";
            
            $data['message']="Success";
            
            $data['notification_list']=$notificationList;                     
        }            
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== Edit Profile ===============================//

    function EditProfile()
    {
        $user_id        = $this->input->post('user_id');
        $first_name     = $this->input->post('first_name');
        $last_name      = $this->input->post('last_name');
        $email_id       = $this->input->post('email_id');
        $mobile_no      = $this->input->post('phone_no');
        $address        = $this->input->post('address');
        $country        = $this->input->post('country');
        
        $lattitude      = $this->input->post('lattitude');
        $longitude      = $this->input->post('longitude');
        $profile_image  = $this->input->post('profile_image');
        $language       = $this->input->post('language');
        $about          = $this->input->Post('about');
        $skills         = $this->input->Post('skills');

        $link           = $this->input->Post('link');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("First Name",$first_name,"required");
        
        $this->formValidation("Last Name",$last_name,"required");
        
        $this->formValidation("Email Id",$email_id,"required");
        
        $this->formValidation("Mobile No",$mobile_no,"required");
        
        $this->formValidation("Address",$address,"required");
        
        $this->formValidation("Country",$address,"required");
        
        $this->formValidation("Lattitude",$lattitude,"required");
        
        $this->formValidation("Longitude",$longitude,"required");
        
        $this->formValidation("Experience",$language,"required");
        
        $this->formValidation("About",$about,"required");
        
        $this->formValidation("Skills",$skills,"required");

        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(!empty($check_user))
        {
            
            $mobile_country=explode(" ",$mobile_no)[0];
            
            $mobile_no=explode(" ",$mobile_no)[1];
            
            $check_user_email=(array) $this->getUserDetails("(id!='$user_id' and email='$email_id')");
            
            if(empty($check_user_email))
            {
            
                $old_email=$check_user['email'];
                
                if($old_email!=$email_id)
                {
                    //$email_otp = '';
                    
                    $is_email_verified=0;
                }
                else
                {
                    $email_otp=$check_user['email_otp'];
                    
                    $is_email_verified=$check_user['is_email_verified'];
                }
                
                $check_user_mobile=(array) $this->getUserDetails("(id!='$user_id' and phone_no='$mobile_no')");
                
                if(empty($check_user_mobile))
                {
                
                    $old_mobile_no=$check_user['phone_no'];
                    
                    if($old_mobile_no!=$mobile_no)
                    {
                        //$mobile_otp = '';
                        
                        $is_mobile_verified=0;
                    }
                    else
                    {
                        $mobile_otp=$check_user['mobile_otp'];
                        
                        $is_mobile_verified=$check_user['is_mobile_verified'];
                    }
                    
                    $userData=array(
                    
                        'first_name'=>$first_name,
                        
                        'last_name'=>$last_name,
                        
                        'mobile_country'=>$mobile_country,
                        
                        'phone_no'=>$mobile_no,
                        
                        'email'=>$email_id,
                        
                        'is_mobile_verified'=>$is_mobile_verified,
                        
                        //'mobile_otp'=>$mobile_otp,
                        
                        'is_email_verified'=>$is_email_verified,
                        
                        //'email_otp'=>$email_otp,
                        
                        'address'=>$address,
                        
                        'country'=>$country,
                        
                        'lattitude'=>$lattitude,
                        
                        'longitude'=>$longitude,
                        
                        'language'=>$language,
                        
                        'profile_picture'=>$profile_image,
                        
                        'about'=>$about,
                        
                        'skills'=>$skills,

                        'profile_link'=>$link,
                        
                        'updated_at'=>date('Y-m-d H:i:s'),
                    );
                    
                    
                    if($this->Api_model->addUser($user_id,$userData))
                    {
                        $data['status']="1";
                        
                        $data['message']="Profile Updated Successfully";
                        
                        $data['user_id']=$user_id;
                        
                        $data['user_details']=$this->getUserDetails(array("id"=>$user_id));
                    }
                    else
                    {
                        $data['status']="0";
                        
                        $data['message']="Something went wrong";
                    }
                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Mobile No Already Exist";
                }  
            }
            else
            {
                $data['status']="0";
                
                $data['message']="Email Id Already Exist";
            }
        }
        else
        {
            $data['status']="0";
            
            $data['message']="User Doesnot Exist";
        }
        
        header( 'Content-type:application/json');
        
        print json_encode( $data);
        
        exit;
        
    }    
    
    //=========================== Mobile otp generation ===============================//
    
    function mobileOTP()
    {
        $mobile_no=$this->input->post('mobile_no');
        
        $user_id=$this->input->post('user_id');//0 for signup 
        
        $this->formValidation("Mobile No",$mobile_no,"required");
        
        $this->formValidation("User Id",$user_id,"required");
        
        if($user_id==0)
        {
            $check_mobile= (array) $this->getUserDetails(array("phone_no"=>$mobile_no));
        }
        else
        {
            $check_mobile= (array) $this->getUserDetails(array("phone_no"=>$mobile_no,'user_id!=',$user_id));
        }
        
        if(!empty($check_mobile))
        {
            $data['status']="0";
            
            $data['message']="Mobile No Already Exist";
        } 
        else
        {
            $digits     = 4;
            
            $mobile_otp = rand(pow(10, $digits-1), pow(10, $digits)-1);
            
            if($user_id!=0)//signup user
            {
                $userData=array(
                
                    'is_mobile_verified'=>0,
                    
                    'mobile_otp'=>$mobile_otp,
                    
                    'updated_at'=>date('Y-m-d H:i:s')
                
                );
                
                $this->Api_model->addUser($user_id,$userData);
            }
            
            $data['status']="1";
            $data['message']="Success";
            $data['mobile_otp']="$mobile_otp";
        
        }
        
        header( 'Content-type:application/json');
        
        print json_encode( $data);
        
        exit;
    }
    
    //=========================== Email otp generation ===============================//
    
    function emailOTP()
    {
        $email_id=$this->input->post('email_id');
        
        $user_id=$this->input->post('user_id');//0 for signup 
        
        $this->formValidation("Email Id",$email_id,"required");
        
        $this->formValidation("User Id",$user_id,"required");
        
        if($user_id==0)
        {
            $check_email= (array) $this->getUserDetails(array("email"=>$email_id));
        }
        else
        {
            $check_email= (array) $this->getUserDetails(array("email"=>$email_id,'user_id!=',$user_id));
        }
        
        if(!empty($check_email))
        {
            $data['status']="0";
            
            $data['message']="Email Id Already Exist";
        } 
        else
        {
        
            $digits     = 4;
            
            $mobile_otp = rand(pow(10, $digits-1), pow(10, $digits)-1);
            
            if($user_id!=0)//signup user
            {
            
                $userData=array(
                
                    'is_email_verified'=>0,
                    
                    'email_otp'=>$mobile_otp,
                    
                    'updated_at'=>date('Y-m-d H:i:s')
                
                
                );
                
                $this->Api_model->addUser($user_id,$userData);
            
            }
            
            $data['status']="1";
            
            $data['message']="Success";
            
            $data['email_otp']="$mobile_otp";
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }

    //=========================== Dashboard ===============================//
    
    function Dashboard()
    {
        $search_key = $this->input->post('search_key');
        
        $banner_list=$this->Api_model->bannerList(array('status'=>1))->result_array();
        
        $bannerList=array();
        
        foreach ($banner_list as $key => $value) 
        {
            $banner_image=$value['banner_image'];
            
            $bannerList[]=[
            
                'banner_image'=>$this->getImage($banner_image,'banner_images'),
            
            ];
        }
        
        $parent_category_list=$this->Api_model->categoryList("(parent_category_id='0' and category_status='1')",$search_key)->result_array();
        
        $parent_categoryList=array();
        
        foreach ($parent_category_list as $key => $value) 
        {
            $category_id=$value['id'];
            
            $category_name=$value['category_name'];
            
            $category_icon=$value['category_icon'];
            
            
            $sub_category_list=$this->Api_model->categoryList("(parent_category_id='$category_id' and category_status='1')",'')->result_array();
            
            $sub_categoryList=array();
            
            foreach ($sub_category_list as $key => $value1) 
            {
            
                $category_id1=$value1['id'];
                
                $category_name1=$value1['category_name'];
                
                $category_icon1=$value1['category_icon'];
                
                $sub_categoryList[]=[
                
                    'sub_category_id'=>$category_id1,
                    
                    'sub_category_name'=>$category_name1,
                    
                    'sub_category_icon'=> $this->getImage($category_icon1,'category_image'),
                
                ];
            }
            
            $parent_categoryList[]=[
            
                'main_category_id'=>$category_id,
                
                'main_category_name'=>$category_name,
                
                'main_category_icon'=> $this->getImage($category_icon,'category_image'),
                
                'sub_category'=>$sub_categoryList
            
            ];
        }
        
        $data['status']="1";
        
        $data['message']="Success";
        
        $data['banner_list']=$bannerList;
        
        $data['main_category_list']=$parent_categoryList;
        
        header( 'Content-type:application/json');
        
        print json_encode( $data);
        
        exit;
    }

    //=========================== Category List ===============================//
    
    function categoryList()
    {
        $parent_category_list=$this->Api_model->categoryList("(parent_category_id='0' and category_status='1')",'')->result_array();
        
        $parent_categoryList=array();
        
        foreach ($parent_category_list as $key => $value) 
        {
            $category_id=$value['id'];
            
            $category_name=$value['category_name'];
            
            $category_icon=$value['category_icon'];
            
            $sub_category_list=$this->Api_model->categoryList("(parent_category_id='$category_id' and category_status='1')",'')->result_array();
            
            $sub_categoryList=array();
            
            foreach ($sub_category_list as $key => $value1) 
            {
            
                $category_id1=$value1['id'];
                
                $category_name1=$value1['category_name'];
                
                $category_icon1=$value1['category_icon'];
                
                $sub_categoryList[]=[
                
                    'main_category_id'=>$category_id,
                    
                    'sub_category_id'=>$category_id1,
                    
                    'sub_category_name'=>$category_name1,
                    
                    'sub_category_icon'=> $this->getImage($category_icon1,'category_image'),
                
                ];
            
            }
            
            $parent_categoryList[]=[
            
                'main_category_id'=>$category_id,
                
                'main_category_name'=>$category_name,
                
                'main_category_icon'=> $this->getImage($category_icon,'category_image'),
                
                'sub_category'=>$sub_categoryList
            
            ];
        }
    
        $data['status']="1";
        
        $data['message']="Success";
        
        $data['category_list']=$parent_categoryList;
        
        header( 'Content-type:application/json');
        
        print json_encode( $data);
        
        exit;
    
    }

    //=========================== Category & Sub Category List ===============================//
    
    function subCategoryList()
    {
        $main_category_id=$this->input->post('main_category_id');
        
        $this->formValidation("Main Category Id",$main_category_id,"required");
        
        $sub_category_list=$this->Api_model->categoryList("(parent_category_id='$main_category_id' and category_status='1')",'')->result_array();
        
        $sub_categoryList=array();
        
        foreach ($sub_category_list as $key => $value1) 
        {
        
            $category_id1=$value1['id'];
            
            $category_name1=$value1['category_name'];
            
            $category_icon1=$value1['category_icon'];
            
            $sub_categoryList[]=[
            
                'sub_category_id'=>$category_id1,
                
                'sub_category_name'=>$category_name1,
                
                'sub_category_icon'=> $this->getImage($category_icon1,'category_image'),
            
            ];
        
        }
        
        $data['status']="1";
        
        $data['message']="Success";
        
        $data['sub_category_list']=$sub_categoryList;
        
        header( 'Content-type:application/json');
        
        print json_encode( $data);
        
        exit;
    }

    //=========================== ContactUs =================================//
    
    function ContactUs()
    {
        $user_id=$this->input->post('user_id');
        
        $type=$this->input->post('type');
        
        $description=$this->input->post('description');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("Type",$type,"required");
        
        $this->formValidation("Description",$description,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
        
            $data['status']="0";
            
            $data['message']="User not Found";
        }
        else
        {
            $this->checkAccountStatus($user_id);
            
            $helpData=array(
                
                'user_id'=>$user_id,
                
                'type'=>$type,
                
                'content'=>$description,
                
                'created_at'=>date('Y-m-d H:i:s')
            
            );
            
            if($this->Api_model->insert('contact',$helpData))
            {
                $data['status']="1";
                
                $data['message']="Your query submitted Successfully ! Admin will contact you soon";
            }
            else
            {
                $data['status']="0";
                
                $data['message']="Something went wrong";
            }
        
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }

    //=========================== HelpSupport ===============================//
    
    function HelpSupport()
    {
        $category_list=$this->Api_model->getFaqCategory()->result_array();
        
        $faqList=array();
        
        foreach ($category_list as $key => $value) 
        {
            $faq_category_id=$value['parent_id'];
            
            $category_name=$value['category_name'];
            
            $faq_list=$this->Api_model->faq(array('parent_id'=>$faq_category_id))->result_array();
            
            $faq=array();
            
            foreach ($faq_list as $key => $value2) 
            {
                
                $faq[]=[
                
                'question'=>$value2['help'],
                
                'answer'=>$value2['description'],
                
                ];
            
            }
            
            $faqList[]=[
            
                'category_id'=>$faq_category_id,
                
                'category_name'=>$category_name,
                
                'faq'=>$faq
            
            ];
        
        }
        
        $data['status']="1";
        
        $data['message']="Success";
        
        $data['faq_list']=$faqList;
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== Verified ===============================//

    function Verified()
    {
        $user_id=$this->input->post('user_id');
        
        $type=$this->input->post('verify_type');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("Type",$type,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
        
            $data['status']="0";
            
            $data['message']="User not Found";
        
        }
        else
        {
            $this->checkAccountStatus($user_id);
            
            if($type==1)
            {
            
                $userData=array(
                
                    'is_mobile_verified'=>'1',
                    
                    'updated_at'=>date('Y-m-d H:i:s')
                
                );
                
                if($this->Api_model->addUser($user_id,$userData))
                {
                    $data['status']="1";
                    
                    $data['message']="Mobile Verified Successfully";
                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Something went wrong";
                }
            
            }
            else
            {
            
                $userData=array(
                
                    'is_email_verified'=>'1',
                    
                    'updated_at'=>date('Y-m-d H:i:s')
                
                );
                
                if($this->Api_model->addUser($user_id,$userData))
                {
                    $data['status']="1";
                    
                    $data['message']="Email Verified Successfully";
                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Something went wrong";
                }
            }
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== Billing Add ===============================//
    
    function billingAdd()
    {
        $user_id       = $this->input->post('user_id');
        $full_name     = $this->input->post('full_name');
        $company_name  = $this->input->post('company_name');
        $country       = $this->input->post('country');
        $address       = $this->input->post('address');
        $lattitude     = $this->input->post('billing_lattitude');
        $longitude     = $this->input->post('billing_longitude');
        $zipcode       = $this->input->Post('zipcode');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("Full Name",$full_name,"required");
        
        $this->formValidation("Company Name",$company_name,"required");
        
        $this->formValidation("Address",$address,"required");
        
        $this->formValidation("Country",$country,"required");
        
        $this->formValidation("Lattitude",$lattitude,"required");
        
        $this->formValidation("Longitude",$longitude,"required");
        
        $this->formValidation("Zipcode",$zipcode,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(!empty($check_user))
        {
            $details = $this->Api_model->get_where_row('billing',array('user_id' => $user_id));
        
            if(!empty($details))
            {
                
                $billingData=array(
                    
                    'company_name'  => $company_name,
                    
                    'full_name'     => $full_name,
                    
                    'address'       => $address,
                    
                    'country'       => $country,
                    
                    'billing_lattitude'     => $lattitude,
                    
                    'billing_longitude'     => $longitude,
                    
                    'zipcode'       => $zipcode,
                    
                    'updated_at'    => date('Y-m-d H:i:s'),
                );
                
                $update_where = array('user_id'=> $user_id);
                
                if($this->Api_model->update('billing',$billingData,$update_where))
                {
                    $data['status']="1";
                
                    $data['message']="Billing Details Updated Successfully";
                    
                    //$data['billing_details']=$this->billingDetails($user_id);
                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Something went wrong";
                }
            }
            else
            {
                $billingData=array(
                
                    'user_id'       => $user_id,
                    
                    'company_name'  => $company_name,
                    
                    'full_name'     => $full_name,
                    
                    'address'       => $address,
                    
                    'country'       => $country,
                    
                    'billing_lattitude'     => $lattitude,
                    
                    'billing_longitude'     => $longitude,
                    
                    'zipcode'       => $zipcode,
                    
                    'status'        => '1',
                    
                    'created_at'    => date('Y-m-d H:i:s'),
                );
                
                
                if($this->Api_model->insert('billing',$billingData))
                {
                    $data['status']="1";
                    
                    $data['message']="Billing Details Added Successfully";
                    
                    //$data['billing_details']=$this->billingDetails($user_id);
                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Something went wrong";
                }
            }
        }
        else
        {
            $data['status']="0";
            
            $data['message']="User Doesnot Exist";
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== Billing Details ===============================//
    
    function billingDetails()
    {
        $user_id       = $this->input->post('user_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $details = $this->Api_model->get_where_row('billing',array('user_id' => $user_id));
        
        $billingDetails=array();
       
        $billingDetails =[
            
            'user_id'        => !empty($details->user_id) ? $details->user_id : '',
            'billing_id'     => !empty($details->id) ? $details->id : '',
            'company_name'   => !empty($details->company_name) ? $details->company_name : '', 
            'full_name'      => !empty($details->full_name) ? $details->full_name : '',
            'address'        => !empty($details->address) ? $details->address : '',
            'lattitude'      => !empty($details->billing_lattitude) ? $details->billing_lattitude : '',
            'longitude'      => !empty($details->billing_longitude) ? $details->billing_longitude : '',        
            'country'        => !empty($details->country) ? $details->country : '',
            'address'        => !empty($details->address) ? $details->address : '',
            'zipcode'        => !empty($details->zipcode) ? $details->zipcode : '',
        ];
             
        $data['status']="1";
        $data['message']="Success";
        $data['billing_details']=$billingDetails;
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== Request Add ===============================//

    function requestAdd()
    {
        $user_id=$this->input->post('user_id');
    
        $category=$this->input->post('category_id');
    
        $subcategory=$this->input->post('subcategory_id');
    
        $deliverytime=$this->input->post('deliverytime');
    
        $description=$this->input->post('description');
    
        $price=$this->input->post('price');
        
        $quantity=$this->input->post('quantity');
    
        $image=$this->input->post('image');
    
        $this->formValidation("User Id",$user_id,"required");
    
        $this->formValidation("Category",$category,"required");
    
        $this->formValidation("Sub Category",$subcategory,"required");
    
        $this->formValidation("Delivery Time",$deliverytime,"required");
    
        $this->formValidation("Price",$price,"required");
        
        $this->formValidation("Quantity",$quantity,"required");
    
        $this->formValidation("Description",$description,"required");
    
        $check_user=(array) $this->getUserDetails("id='$user_id'");
    
        if(empty($check_user))
        {
            $data['status']="0";
    
            $data['message']="User not Found";
        }
        else
        { 
              $this->checkAccountStatus($user_id);
    
              $Data=array(
    
                  'user_id'=>$user_id,
    
                  'image'=>$image,
    
                  'category'=>$category,
                  
                  'subcategory'=>$subcategory,
                  
                  'deliverytime'=>$deliverytime,
    
                  'price'=>$price,
                  
                  'quantity'=>$quantity,
    
                  'description'=>$description,
    
                  'created_at'=>date('Y-m-d H:i:s')
              );
    
              if($request_id=$this->Api_model->AddRequest('',$Data))
              {
                  $data['status']="1";
                  
                  $data['request_id']="$request_id";
    
                  $data['message']="Request Added Successfully";
                  
                  $this->prepreFcm('requestadd',array('user_id'=>$user_id,'subcategory'=>$subcategory));
              }
              else
              {
                  $data['status']="0";
    
                  $data['message']="Something went wrong";
              }
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    //=========================== Request Edit ===============================//

    function requestEdit()
    {
        $request_id=$this->input->post('request_id');
    
        $category=$this->input->post('category_id');
    
        $subcategory=$this->input->post('subcategory_id');
    
        $deliverytime=$this->input->post('deliverytime');
    
        $description=$this->input->post('description');
    
        $price=$this->input->post('price');
        
        $quantity=$this->input->post('quantity');
    
        $image=$this->input->post('image');
    
        $this->formValidation("Request Id",$request_id,"required");
    
        $this->formValidation("Category",$category,"required");
    
        $this->formValidation("Sub Category",$subcategory,"required");
    
        $this->formValidation("Delivery Time",$deliverytime,"required");
    
        $this->formValidation("Price",$price,"required");
        
        $this->formValidation("Quantity",$quantity,"required");
    
        $this->formValidation("Description",$description,"required");

        $check_now=$this->Api_model->RequestList(array('id'=>$request_id))->row();
    
        if(empty($check_now))
        {
            $data['status']="0";
    
            $data['message']="Request not Found";
        }
        else
        {
            $Data=array(
            
                'image'=>$image,
                
                'category'=>$category,
                
                'subcategory'=>$subcategory,
                
                'deliverytime'=>$deliverytime,
                
                'price'=>$price,
                
                'quantity'=>$quantity,
                
                'description'=>$description,
                
                'updated_at'=>date('Y-m-d H:i:s')
            
            );
            
            if($request_id=$this->Api_model->AddRequest(array('id'=>$request_id),$Data))
            {
                $data['status']="1";
            
                $data['message']="Request Updated Successfully";

            }
            else
            {
                $data['status']="0";
            
                $data['message']="Something went wrong";
            }
        }
    
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit; 
    }
    
    //=========================== Request List ====================================//
    
    function RequestList()
    {
        $user_id=$this->input->post('user_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
            $data['status']="0";
            
            $data['message']="User not Found";
        }
        else
        { 
            $this->checkAccountStatus($user_id);
            
            $request_list=$this->Api_model->RequestList(array('user_id'=>$user_id))->result_array();
            
            $requestList=array();
            
            foreach ($request_list as $key => $value)
            { 
                
                if(!empty($value['category']))
                {
                    $Details    = $this->Api_model->get_where_row("category",array('id' => $value['category']));
                    
                    $category   = $Details->category_name;
                    
                    $category_icon = $Details->category_icon;
                }
                else
                {
                    $category = '';
                    
                    $category_icon = '';
                }
                
                if(!empty($value['subcategory']))
                {
                    $Details    = $this->Api_model->get_where_row("category",array('id' => $value['subcategory']));
                    
                    $subcategory_name = $Details->category_name;
                    
                    $sub_category_icon = $Details->category_icon;
                }
                else
                {
                    $subcategory_name = '';
                    
                    $sub_category_icon = '';
                }
                
                $imageList = explode(",",$value['image']);
                
                $image_list=array();
                
                foreach ($imageList as $key => $value1) 
                {
                    $image_list[]=[
                    
                        'image'     => $value1,
                        
                        'image_url' => $this->getImage($value1,'request_image')
                    ];
                }
            
                $requestList[]=[
                
                    'user_id'=>$value['user_id'],
                    
                    'request_id'=>$value['id'],
                    
                    'category_id'=>$value['category'],
                    
                    'category_name'=>$category,
                    
                    'category_icon'=> $this->getImage($category_icon,'category_image'),

                    'sub_category_id'=>$value['subcategory'],
                
                    'sub_category_name'=>$subcategory_name,
                
                    'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                    
                    'image_list'=>$image_list,
                    
                    'price'=>$value['price'],
                    
                    'quantity'=>$value['quantity'],
                    
                    'deliverytime'=>$value['deliverytime'],
                    
                    'description'=>$value['description']
                ];
            }
            
            $data['status']="1";
            
            $data['message']="Success";
            
            $data['request_list']=$requestList;
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit; 
    }
    
    //=========================== Request Details ====================================//
    
    function RequestDetails()
    {
        $user_id    = $this->input->post('user_id');
        
        $request_id = $this->input->post('request_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("Request Id",$request_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
        
            $data['status']="0";
            
            $data['message']="User not Found";
        
        }
        else
        {
            $requestData = $this->Api_model->RequestList(array('id'=>$request_id))->row();
            
            $requestDetails = array();
            $offerReceived  = array();
            $offerAccept    = array();
            
            if(!empty($requestData))
            {
        
                if(!empty($requestData->category))
                {
                    $Details        = $this->Api_model->get_where_row("category",array('id' => $requestData->category));
                    
                    $category       = $Details->category_name;
                    
                    $category_icon  = $Details->category_icon;
                }
                else
                {
                    $category       = '';
                    
                    $category_icon  = '';
                }
                
                if(!empty($requestData->subcategory))
                {
                    $subDetails        = $this->Api_model->get_where_row("category",array('id' => $requestData->subcategory));
                    
                    $subcategory_name  = $subDetails->category_name;
                    
                    $sub_category_icon = $subDetails->category_icon;
                }
                else
                {
                    $subcategory_name = '';
                    
                    $sub_category_icon = '';
                }
                
                $imageList = explode(",",$requestData->image);
                
                $image_list=array();               
                                
                foreach ($imageList as $key => $value1) 
                {
                    $image_list[]=[
                    
                        'image'     => $value1,
                        
                        'image_url' => $this->getImage($value1,'request_image')
                    ];
                }
                
                $buyer    = $this->Api_model->get_where_row("app_user",array('id' => $requestData->user_id));

                $sellerRating = ceil($this->Api_model->rating(array('seller_id'=>$requestData->user_id,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);

                $buyerRating = ceil($this->Api_model->rating(array('buyer_id'=>$requestData->user_id,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);

                $rating1 = !empty($sellerRating) ? $sellerRating : '0';
                $rating2 = !empty($buyerRating) ? $buyerRating : '0';

                $rating = $rating1 + $rating2;
                
                $requestDetails =[
                
                    'user_id'=>$requestData->user_id,

                    'rating'=>"$rating",
                    
                    'request_id'=>$requestData->id,
                    
                    'category_id'=>$requestData->category,
                    
                    'category_name'=>$category,
                    
                    'category_icon'=> $this->getImage($category_icon,'category_image'),
    
                    'sub_category_id'=>$requestData->subcategory,
                
                    'sub_category_name'=>$subcategory_name,
                
                    'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                    
                    'image_list'=>$image_list,

                    'price'=>$requestData->price,
                    
                    'quantity'=>$requestData->quantity,
                    
                    'deliverytime'=>$requestData->deliverytime,
                    
                    'description'=>$requestData->description,
                    
                    'request_status'=>$requestData->request_status
                ];
                
                if(!empty($requestData->id))
                {
                
                    $check_offer = $this->Api_model->OfferList(array('request_id'=>$requestData->id))->result_array();

                    if(!empty($check_offer))
                    {
                        
                        foreach ($check_offer as $key => $value2) 
                        {
                            $Userid     = $value2['user_id'];
                        
                            $user_details1    = $this->Api_model->get_where_row("app_user",array('id' => $Userid));

                            $Rating = ceil($this->Api_model->rating(array('seller_id'=>$Userid,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);
                            $rating = !empty($Rating) ? $Rating : '0';
                        
                            $offerReceived[] =[
                    
                                'user_id'             => $Userid,
                                'first_name'          => trim($user_details1->first_name),
                                'last_name'           => trim($user_details1->last_name),
                                'email'               => $user_details1->email,
                                'profile'             => $user_details1->profile_picture,
                                'profile_image_url'   => $this->getImage($user_details1->profile_picture,'profile_image'),
                                'phone_no'            => $user_details1->phone_no,
                                'address'             => $user_details1->address,
                                'country'             => $user_details1->country,
                                'about'               => $user_details1->about,
                                'skills'              => $user_details1->skills,
                                'language'            => $user_details1->language,
                                'rating'              => "$rating",
                                'live_status'         => $user_details1->live_status,
                                'join_date'           => $user_details1->created_at,
                                'orders_completed'    => '0',
                                
                                'seller_id'=>$Userid,
                                
                                'offer_id'=>$value2['id'],
                                
                                'category_id'=>$requestData->category,
                        
                                'category_name'=>$category,
                                
                                'category_icon'=> $this->getImage($category_icon,'category_image'),
                
                                'sub_category_id'=>$requestData->subcategory,
                            
                                'sub_category_name'=>$subcategory_name,
                            
                                'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                                
                                'price'=>$value2['price'],
                                'deliverytime'=>$value2['deliver_time'],
                                'description'=>$value2['description'],
                                'offer_status'=>$value2['offer_status'],
                        
                            ];
                        
                        }
                    } 
                    
                    if(!empty($requestData->seller_id))
                    {
                         $seller_id = $requestData->seller_id;
                        
                         $seller_details    = $this->Api_model->get_where_row("app_user",array('id' => $seller_id));
                        
                         $checkOffer = $this->Api_model->OfferList(array('request_id'=>$requestData->id))->row();

                         $Rating = ceil($this->Api_model->rating(array('seller_id'=>$seller_id,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);
                         $rating = !empty($Rating) ? $Rating : '0';
                        
                         $offerAccept =[
                        
                            'first_name'          => trim($seller_details->first_name),
                            'last_name'           => trim($seller_details->last_name),
                            'email'               => $seller_details->email,
                            'profile'             => $seller_details->profile_picture,
                            'profile_image_url'   => $this->getImage($user_details1->profile_picture,'profile_image'),
                            'phone_no'            => $seller_details->phone_no,
                            'address'             => $seller_details->address,
                            'country'             => $seller_details->country,
                            'about'               => $seller_details->about,
                            'skills'              => $seller_details->skills,
                            'language'            => $seller_details->language,
                            'rating'              => "$rating",
                            'live_status'         => $seller_details->live_status,
                            'join_date'           => $seller_details->created_at,
                            'orders_completed'    => '0',
                            
                            'seller_id'=>$seller_id,
                            
                            'offer_id'=>$checkOffer->id,
                            
                            'category_id'=>$requestData->category,
                    
                            'category_name'=>$category,
                            
                            'category_icon'=> $this->getImage($category_icon,'category_image'),
            
                            'sub_category_id'=>$requestData->subcategory,
                        
                            'sub_category_name'=>$subcategory_name,
                        
                            'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                            
                            'price'=>$checkOffer->price,
                            'deliverytime'=>$checkOffer->deliver_time,
                            'description'=>$checkOffer->description,
                            'offer_status'=>$checkOffer->offer_status
                            
                        ];
                    }
                    
                }
            }

            $data['status']="1";
            $data['message']="Success";
            $data['request_Details'] = $requestDetails;
            $data['offer_Details']   = $offerReceived;
            
            if($offerAccept)
            {
                $data['accept_Details']  = $offerAccept;
            }
        }      
                    
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit; 
    }
    
    //=========================== Gig Request Details ====================================//
    
    function GigRequest()
    {
        $user_id    = $this->input->post('user_id');
        
        $search_key = $this->input->post('search_key');
        
        $location   = $this->input->post('location');
        
        $lattitude  = $this->input->post('lattitude');
        
        $longitude  = $this->input->post('longitude');
        
        $category   = $this->input->post('category_id');
        
        $subcategory= $this->input->post('subcategory_id');
        
        $filter = array(
            'lat'           => $lattitude,
            'lon'           => $longitude,
            'location'      => $location,
            'category'      => $category,
            'subcategory'   => $subcategory
        );
               
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
            $data['status']="0";
            
            $data['message']="User not Found";
        }
        else
        {
            $customer_order = $check_user['customer_order'];
            
            if(!empty($customer_order))
            {
            
                $request_list=$this->Api_model->getRequest(array('user_id'=>$user_id,'request_status'=>'0'),$search_key,$filter)->result_array();
                
                $requestList=array();
                
                foreach ($request_list as $key => $value)
                { 
                    
                    $User_list=array();
                    
                    if(!empty($value['user_id']))
                    {
                        $user_details1    = $this->Api_model->get_where_row("app_user",array('id' => $value['user_id']));

                        $sellerRating = ceil($this->Api_model->rating(array('seller_id'=>$value['user_id'],'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);

                        $buyerRating = ceil($this->Api_model->rating(array('buyer_id'=>$value['user_id'],'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);

                        $rating1 = !empty($sellerRating) ? $sellerRating : '0';
                        $rating2 = !empty($buyerRating) ? $buyerRating : '0';

                        $rating = $rating1 + $rating2;
                        
                        $User_list=[
                        
                            'user_id'             => $value['user_id'],
                            'first_name'          => trim($user_details1->first_name),
                            'last_name'           => trim($user_details1->last_name),
                            'email'               => $user_details1->email,
                            'profile'             => $user_details1->profile_picture,
                            'profile_image_url'   => $this->getImage($user_details1->profile_picture,'profile_image'),
                            'phone_no'            => $user_details1->phone_no,
                            'is_mobile_verified'  => $user_details1->is_mobile_verified,
                            'is_email_verified'   => $user_details1->is_email_verified,
                            'address'             => $user_details1->address,
                            'country'             => $user_details1->country,
                            'about'               => $user_details1->about,
                            'skills'              => $user_details1->skills,
                            'language'            => $user_details1->language,
                            'rating'              => "$rating",
                            'live_status'         => $user_details1->live_status,
                            'join_date'           => $user_details1->created_at,
                            'orders_completed'    => '0',
                        ];
                    }
                    
                    if(!empty($value['category']))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $value['category']));
                        
                        $category   = $Details->category_name;
                        
                        $category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $category = '';
                        
                        $category_icon = '';
                    }
                    
                    if(!empty($value['subcategory']))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $value['subcategory']));
                        
                        $subcategory_name = $Details->category_name;
                        
                        $sub_category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $subcategory_name = '';
                        
                        $sub_category_icon = '';
                    }
                    
                    $imageList = explode(",",$value['image']);
                    
                    $image_list=array();
                    
                    foreach ($imageList as $key => $value1) 
                    {
                        $image_list[]=[
                        
                            'image'     => $value1,
                            
                            'image_url' => $this->getImage($value1,'request_image')
                        ];
                    }
    
                    $requestList[]=[
                    
                        'user_id'=>$value['user_id'],
                        
                        'user_details' => $User_list,
                        
                        'request_id'=>$value['id'],
                        
                        'category_id'=>$value['category'],
                        
                        'category_name'=>$category,
                        
                        'category_icon'=> $this->getImage($category_icon,'category_image'),
        
                        'sub_category_id'=>$value['subcategory'],
                    
                        'sub_category_name'=>$subcategory_name,
                    
                        'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                        
                        'image_list'=>$image_list,
                        
                        'price'=>$value['price'],
                        
                        'quantity'=>$value['quantity'],
                        
                        'deliverytime'=>$value['deliverytime'],
                        
                        'description'=>$value['description']
                        
                    ];
                    
                }
                
                $data['status']="1";
                $data['message']="Success";
                $data['request_Details']=$requestList;
                
            }
            else
            {
                $data['status']="2";
                
                $data['message']="Order not found.Please enable the orders";
            }
        }
            
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit; 
    }
    
    //=========================== Offer Send ===============================//

    function offerSend()
    {
        $user_id=$this->input->post('user_id');
        
        $request_id=$this->input->post('request_id');
    
        $deliverytime=$this->input->post('deliver_time');
    
        $description=$this->input->post('description');
    
        $price=$this->input->post('price');
        
        $image=$this->input->post('image');
    
        $this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("Request Id",$request_id,"required");
        
        $this->formValidation("Delivery Time",$deliverytime,"required");
        
        $this->formValidation("Price",$price,"required");
        
        $this->formValidation("Description",$description,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
            $data['status']="0";
            
            $data['message']="User not Found";
        }
        else
        {

            $check_now=$this->Api_model->RequestList(array('id'=>$request_id))->row();
                     
            $req_user_id = $check_now->user_id;
        
            if(empty($check_now))
            {
                $data['status']="0";
        
                $data['message']="Record not Found";
            }
            else
            { 
                                    
                $check_offer = $this->Api_model->OfferList(array('request_id'=>$request_id,'user_id'=>$user_id))->row();
                
                if(!empty($check_offer))
                {
                    $Offerid    = $check_offer->id;                    
                    $Userid     = $check_offer->user_id;                    
                    $Requestid  = $check_offer->request_id;
                    
                    $OfferData=array(
        
                      'user_id'     => $Userid,
        
                      'request_id'  => $Requestid,
        
                      'deliver_time'=> $deliverytime,
        
                      'price'       => $price,

                      'offer_status'=> '0',
                      
                      'description' => $description,
        
                      'updated_at'  => date('Y-m-d H:i:s')        
                    );
        
                    if($this->Api_model->Offersend(array('id'=>$Offerid),$OfferData))
                    {
                        $data['status']="1";
                        
                        $data['message']="Offer Updated Successfully";

                        $this->prepreFcm('offerreceived',array('user_id'=>$req_user_id));
                    }
                    else
                    {
                        $data['status']="0";
                        
                        $data['message']="Something went wrong";
                    }
                    
                }
                else
                {
    
                    $OfferData=array(
            
                      'user_id'     => $user_id,
        
                      'request_id'  => $request_id,
        
                      'deliver_time'=> $deliverytime,
        
                      'price'       => $price,

                      'offer_status'=> '0',
                      
                      'description' => $description,
        
                      'created_at'  => date('Y-m-d H:i:s')
            
                    );
                      
            
                    if($offer_id=$this->Api_model->Offersend('',$OfferData))
                    {
                        
                        $RequestData=array(

                            'request_status'=>'3',
                            
                            'updated_at'=>date('Y-m-d H:i:s')
                        );
                        
                        $this->prepreFcm('offerreceived',array('user_id'=>$req_user_id));
                        
                        //$this->Api_model->AddRequest(array('id'=>$request_id),$RequestData);
                        
                        $data['status']="1";
                        
                        $data['message']="Offer Sent Successfully";
                    }
                    else
                    {
                        $data['status']="0";
                        
                        $data['message']="Something went wrong";
                    }
                }
            }
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    //=========================== Offer Send List ====================================//
    
    function offerSendList()
    {
        $user_id        = $this->input->post('user_id');
        
        $search_key     = $this->input->post('search_key');
        
        $location       = $this->input->post('location');
        
        $lattitude      = $this->input->post('lattitude');
        
        $longitude      = $this->input->post('longitude');
        
        $category       = $this->input->post('category');

        $subcategory    = $this->input->post('subcategory_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $filter = array(
            'lat'        => $lattitude,
            'lon'        => $longitude,
            'location'   => $location,
            'category'   => $category,
            'subcategory'=> $subcategory
        );
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
        
            $data['status']="0";
            
            $data['message']="User not Found";
        }
        else
        {
        
            $request_list=$this->Api_model->OfferList(array('user_id'=>$user_id),$search_key,$filter)->result_array();
            
            $requestList=array();
            
            $User_list=array();
            
            $image_list=array();
            
            $myOffer=array();
                
            foreach ($request_list as $key => $value)
            { 
                $requestr_details1    = $this->Api_model->get_where_row("request",array('id' => $value['request_id']));
                
                if(!empty($requestr_details1->user_id))
                {
                    $user_details1    = $this->Api_model->get_where_row("app_user",array('id' => $requestr_details1->user_id));

                    $sellerRating = ceil($this->Api_model->rating(array('seller_id'=>$requestr_details1->user_id,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);

                    $buyerRating = ceil($this->Api_model->rating(array('buyer_id'=>$requestr_details1->user_id,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);

                    $rating1 = !empty($sellerRating) ? $sellerRating : '0';
                    $rating2 = !empty($buyerRating) ? $buyerRating : '0';

                    $rating = $rating1 + $rating2;
                    
                    $User_list=[
                    
                        'user_id'             => $requestr_details1->user_id,
                        'first_name'          => trim($user_details1->first_name),
                        'last_name'           => trim($user_details1->last_name),
                        'email'               => $user_details1->email,
                        'profile'             => $user_details1->profile_picture,
                        'profile_image_url'   => $this->getImage($user_details1->profile_picture,'profile_image'),
                        'phone_no'            => $user_details1->phone_no,
                        'is_mobile_verified'  => $user_details1->is_mobile_verified,
                        'is_email_verified'   => $user_details1->is_email_verified,
                        'address'             => $user_details1->address,
                        'country'             => $user_details1->country,
                        'about'               => $user_details1->about,
                        'skills'              => $user_details1->skills,
                        'language'            => $user_details1->language,
                        'rating'              => "$rating",
                        'live_status'         => $user_details1->live_status,
                        'join_date'           => $user_details1->created_at,
                        'orders_completed'    => '0',
                    ];
                }
                
                if(!empty($requestr_details1->category))
                {
                    $Details    = $this->Api_model->get_where_row("category",array('id' => $requestr_details1->category));
                    
                    $category   = $Details->category_name;
                    
                    $category_icon = $Details->category_icon;
                }
                else
                {
                    $category = '';
                    
                    $category_icon = '';
                }
                
                if(!empty($requestr_details1->subcategory))
                {
                    $Details    = $this->Api_model->get_where_row("category",array('id' => $requestr_details1->subcategory));
                    
                    $subcategory_name = $Details->category_name;
                    
                    $sub_category_icon = $Details->category_icon;
                }
                else
                {
                    $subcategory_name = '';
                    
                    $sub_category_icon = '';
                }
                
                $imageList = explode(",",$requestr_details1->image);
                
                foreach ($imageList as $key => $value1) 
                {
                    $image_list[]=[
                    
                        'image'     => $value1,
                        
                        'image_url' => $this->getImage($value1,'request_image')
                    ];
                }
                
                $myOffer=[
                
                    'deliverytime'=>$value['deliver_time'],
                    
                    'price'=>$value['price'],
                    
                    'description'=>$value['description'],
                    
                    'offer_status'=>$value['offer_status']                    
                ];
                
                $requestList[]=[
                
                    'user_id'=>$value['user_id'],
                    
                    'user_details' => $User_list,
                    
                    'request_id'=>$requestr_details1->id,
                    
                    'category_id'=>$requestr_details1->category,
                    
                    'category_name'=>$category,
                    
                    'category_icon'=> $this->getImage($category_icon,'category_image'),
    
                    'sub_category_id'=>$requestr_details1->subcategory,
                
                    'sub_category_name'=>$subcategory_name,
                
                    'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                    
                    'image_list'=>$image_list,
                    
                    'price'=>$requestr_details1->price,
                    
                    'quantity'=>$requestr_details1->quantity,
                    
                    'deliverytime'=>$requestr_details1->deliverytime,
                    
                    'description'=>$requestr_details1->description,
                    
                    'my_offer' => $myOffer
                ];                
            }
            
            $data['status']="1";
            $data['message']="Success";
            $data['request_Details']=$requestList;
        }
            
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit; 
    }
    
    //=========================== Gig Add ===============================//

    function gigAdd()
    {
        $user_id=$this->input->post('user_id');
    
        $title=$this->input->post('title');

        $category=$this->input->post('category_id');
    
        $subcategory=$this->input->post('subcategory_id');

        $image=$this->input->post('image');

        $price=$this->input->post('price');

        $deliverytime=$this->input->post('delivery_time');
        
        $shipping=$this->input->post('shipping');

        $shipping_price=$this->input->post('shipping_price'); 
        
        $revisions=$this->input->post('revisions');

        $gig_tag=$this->input->post('gig_tag');
    
        $description=$this->input->post('description');
        
        $status=$this->input->post('status');
          
        $this->formValidation("User Id",$user_id,"required");
    
        $this->formValidation("Title",$title,"required");

        $this->formValidation("Category",$category,"required");
    
        $this->formValidation("Sub Category",$subcategory,"required");
    
        $this->formValidation("Delivery Time",$deliverytime,"required");
    
        $this->formValidation("Price",$price,"required");

        $this->formValidation("Shipping",$shipping,"required");
        
        if($shipping==2)
        {
            $this->formValidation("Shipping Price",$shipping_price,"required");
        }

        $this->formValidation("Revisions",$revisions,"required");

        $this->formValidation("Gig Tag",$gig_tag,"required");        
   
        $this->formValidation("Description",$description,"required");
        
        $this->formValidation("Status",$status,"required");
    
        $check_user=(array) $this->getUserDetails("id='$user_id'");
    
        if(empty($check_user))
        {
            $data['status']="0";
    
            $data['message']="User not Found";
        }
        else
        { 
              $this->checkAccountStatus($user_id);
              
              if($shipping==2)
              {
                  $total_cost = $price + $shipping_price;
              }
              else
              {
                  $total_cost = $price;
              }
              
              $Data=array(
    
                  'user_id'=>$user_id,
    
                  'title'=>$title,

                  'image'=>$image,
    
                  'category_id'=>$category,
                  
                  'sub_category_id'=>$subcategory,

                  'price'=>$price,
                  
                  'delivery_time'=>$deliverytime,   
                                    
                  'shipping'=>$shipping,

                  'shipping_price'=> !empty($shipping==2) ? $shipping_price : '',

                  'revisions'=>$revisions,
                  
                  'total_cost'=>$total_cost,

                  'gig_tag'=>$gig_tag,
    
                  'description'=>$description,
                  
                  'status'=> $status,
    
                  'created_at'=>date('Y-m-d H:i:s')
              );
              
    
              if($gig_id=$this->Api_model->AddGig('',$Data))
              {
                  $data['status']="1";                  
                  $data['gig_id']="$gig_id";    
                  $data['message']="Gig Added Successfully";

                  if($status==1)
                  {
                    $this->prepreFcm('gigadd',array('user_id'=>$user_id,'gig_id'=>$gig_id,'status'=> $status));
                  }
                  else
                  {
                     $this->prepreFcm('gigpublish',array('user_id'=>$user_id,'gig_id'=>$gig_id,'status'=>'2'));
                  }             
              }
              else
              {
                  $data['status']="0";    
                  $data['message']="Something went wrong";
              }
        }
    
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit; 
    }
    
    //=========================== Gig Edit ===============================//

    function gigEdit()
    {
        $user_id=$this->input->post('user_id');
        
        $gig_id=$this->input->post('gig_id');
    
        $title=$this->input->post('title');

        $category=$this->input->post('category_id');
    
        $subcategory=$this->input->post('subcategory_id');

        $image=$this->input->post('image');

        $price=$this->input->post('price');

        $deliverytime=$this->input->post('delivery_time');
        
        $shipping=$this->input->post('shipping');

        $shipping_price=$this->input->post('shipping_price'); 
        
        $revisions=$this->input->post('revisions');

        $gig_tag=$this->input->post('gig_tag');
    
        $description=$this->input->post('description');          
          
        $this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("Gig Id",$gig_id,"required");
    
        $this->formValidation("Title",$title,"required");

        $this->formValidation("Category",$category,"required");
    
        $this->formValidation("Sub Category",$subcategory,"required");
    
        $this->formValidation("Delivery Time",$deliverytime,"required");
    
        $this->formValidation("Price",$price,"required");

        $this->formValidation("Shipping",$shipping,"required");

        if($shipping==2)
        {
            $this->formValidation("Shipping Price",$shipping_price,"required");
        }

        $this->formValidation("Revisions",$revisions,"required");

        $this->formValidation("Gig Tag",$gig_tag,"required");        
   
        $this->formValidation("Description",$description,"required");
        
    
        $check_now=$this->Api_model->GigList(array('user_id'=>$user_id,'id'=>$gig_id))->row(); 
    
        if(empty($check_now))
        {
            $data['status']="0";
    
            $data['message']="Record not Found";
        }
        else
        { 
              $this->checkAccountStatus($user_id);
              
              if(!empty($shipping==2))
              {
                  $total_cost = $price + $shipping_price;
              }
              else
              {
                  $total_cost = $price;
              }
    
              $Data=array(
    
                  'title'=>$title,

                  'image'=>$image,
    
                  'category_id'=>$category,
                  
                  'sub_category_id'=>$subcategory,

                  'price'=>$price,
                  
                  'delivery_time'=>$deliverytime,   
                                    
                  'shipping'=>$shipping,

                  'shipping_price'=>!empty($shipping==2) ? $shipping_price : '',
                  
                  'total_cost'=>$total_cost,

                  'revisions'=>$revisions,

                  'gig_tag'=>$gig_tag,
    
                  'description'=>$description,
    
                  'updated_at'=>date('Y-m-d H:i:s')
              );
    
              if($this->Api_model->AddGig(array('id'=>$gig_id),$Data))
              {
                  $data['status']="1";
                  
                  $data['message']="Gig Update Successfully";
              }
              else
              {
                  $data['status']="0";
    
                  $data['message']="Something went wrong";
              }
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    //=========================== Gig Publish ===============================//

    function gigPublish()
    {
        $user_id=$this->input->post('user_id');
        
        $gig_id=$this->input->post('gig_id');
    
        $this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("Gig Id",$gig_id,"required");
        
        $check_now=$this->Api_model->GigList(array('user_id'=>$user_id,'id'=>$gig_id))->row(); 
    
        if(empty($check_now))
        {
            $data['status']="0";
    
            $data['message']="Record not Found";
        }
        else
        { 
              $this->checkAccountStatus($user_id);
    
              $Data=array(
    
                  'status'=>'2',

                  'published_at'=>date('Y-m-d H:i:s')
              );
    
              if($this->Api_model->AddGig(array('id'=>$gig_id),$Data))
              {
                  $data['status']="1";
                  
                  $data['message']="Gig Publish Successfully";
                  
                  $this->prepreFcm('gigpublish',array('user_id'=>$user_id,'gig_id'=>$gig_id,'status'=>'2'));
              }
              else
              {
                  $data['status']="0";
    
                  $data['message']="Something went wrong";
              }
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    //=========================== Gig List ====================================//
    
    function GigList()
    {
        $user_id=$this->input->post('user_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
            $data['status']="0";
            
            $data['message']="User not Found";
        }
        else
        { 
            $this->checkAccountStatus($user_id);
            
            $gig_list=$this->Api_model->GigList(array('user_id'=>$user_id))->result_array();
            
            $gigList        = array();
            
            $draftgigList   = array();
            
            $publishgigList = array();
            
            $deniedgigList  = array();
            
            $sellerEmpty    = array();

            
            foreach ($gig_list as $key => $value)
            { 

                $orderList=$this->Api_model->OrderList(array('type'=>'1','product_id'=>$value['id']))->row();
                
                if($orderList != NULL)
                {
                    $order_id=$orderList->id;
                    $sellerRating = $this->Api_model->RatingList(array('order_id'=>$order_id))->result_array();

                    $gigreview_Count = count($sellerRating);
                    $gigreviewCount="$gigreview_Count";
                    
                    $sellerRatingList=array();
                    if(!empty($sellerRating)) {
                    
                    foreach ($sellerRating as $key => $values)
                    { 
                        $buyer_id    = $values['buyer_id'];
                        $gigRating    = $values['order_rating'];

                        $Buyer = $this->Api_model->get_where_row("app_user",array('id' => $buyer_id));
                        
                        $buyer_rating = $values['buyer_rating'];
                        $buyer_review = $values['buyer_review'];
                        $is_date      = $values['created_at'];
                        
                        $sellerRatingList[] =[
                            
                            'first_name'          => trim($Buyer->first_name),
                            'last_name'           => trim($Buyer->last_name),
                            'profile'             => $Buyer->profile_picture,
                            'profile_image_url'   => $this->getImage($Buyer->profile_picture,'profile_image'),
                            'review'              => $values['seller_review'],
                            'rating'              => $values['seller_rating'],
                            'is_date'             => $values['created_at'],
                        ];
                    }
                    
                    }
                    else
                    {
                       $gigRating="0";
                       $gigreviewCount="0";
                    }
                }
                else
                {
                   $gigRating="0";
                   $gigreviewCount="0";
                }
                
                if(!empty($value['category_id']))
                {
                    $Details    = $this->Api_model->get_where_row("category",array('id' => $value['category_id']));
                    
                    $category   = $Details->category_name;
                    
                    $category_icon = $Details->category_icon;
                }
                else
                {
                    $category = '';
                    
                    $category_icon = '';
                }
                
                if(!empty($value['sub_category_id']))
                {
                    $Details    = $this->Api_model->get_where_row("category",array('id' => $value['sub_category_id']));
                    
                    $subcategory_name = $Details->category_name;
                    
                    $sub_category_icon = $Details->category_icon;
                }
                else
                {
                    $subcategory_name = '';
                    
                    $sub_category_icon = '';
                }
                
                $array = json_decode($value['image']);
                
                $image_list=array();
                
                if(!empty($array))
                {
                    $imageList = $array->image_list;
                    
                    foreach ($imageList as $key => $value1) 
                    {
                        $image_list[]=[
                        
                            'file'     => $value1->file,
                            
                            'thumnail' => $value1->thumnail,
                            
                            'type'     => $value1->type,
                        ];
                    }
                }
                
                if($value['status']==1)
                {
                    $draftgigList[]=[
                    
                        'user_id'=>$value['user_id'],
                        
                        'gig_id'=>$value['id'],
                        
                        'title'=>$value['title'],
                        
                        'category_id'=>$value['category_id'],
                        
                        'category_name'=>$category,
                        
                        'category_icon'=> $this->getImage($category_icon,'category_image'),
    
                        'sub_category_id'=>$value['sub_category_id'],
                    
                        'sub_category_name'=>$subcategory_name,
                    
                        'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                        
                        'image_list'=>$image_list,
                        
                        'price'=>$value['price'],
                        
                        'delivery_time'=>$value['delivery_time'],
                        
                        'shipping'=>$value['shipping'],
                        
                        'shipping_price'=>$value['shipping_price'],
                        
                        'total_cost'=>$value['total_cost'],
                        
                        'revisions'=>$value['revisions'],
                        
                        'gig_tag'=>$value['gig_tag'],
                        
                        'description'=>$value['description'],
                        
                        'gig_status'=>$value['status'],
                        
                        'gig_rating'=>$gigRating,
                        
                        'review_count'=>$gigreviewCount,
                        
                        'is_favourite'=>'0',
                        
                        'created_at'=>$value['created_at']
                    ];
                }
                if($value['status']==2)
                {
                    $publishgigList[]=[
                    
                        'user_id'=>$value['user_id'],
                        
                        'gig_id'=>$value['id'],
                        
                        'title'=>$value['title'],
                        
                        'category_id'=>$value['category_id'],
                        
                        'category_name'=>$category,
                        
                        'category_icon'=> $this->getImage($category_icon,'category_image'),
    
                        'sub_category_id'=>$value['sub_category_id'],
                    
                        'sub_category_name'=>$subcategory_name,
                    
                        'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                        
                        'image_list'=>$image_list,
                        
                        'price'=>$value['price'],
                        
                        'delivery_time'=>$value['delivery_time'],
                        
                        'shipping'=>$value['shipping'],
                        
                        'shipping_price'=>$value['shipping_price'],
                        
                        'total_cost'=>$value['total_cost'],
                        
                        'revisions'=>$value['revisions'],
                        
                        'gig_tag'=>$value['gig_tag'],
                        
                        'description'=>$value['description'],
                        
                        'gig_status'=>$value['status'],
                        
                        'gig_rating'=>$gigRating,
                        
                        'review_count'=>$gigreviewCount,
                        
                        'is_favourite'=>'0',
                        
                        'created_at'=>$value['created_at'],
                        
                        'gig_reviews'=>$sellerRatingList
                    ];
                }
                if($value['status']==3)
                {
                    $deniedgigList[]=[
                    
                        'user_id'=>$value['user_id'],
                        
                        'gig_id'=>$value['id'],
                        
                        'title'=>$value['title'],
                        
                        'category_id'=>$value['category_id'],
                        
                        'category_name'=>$category,
                        
                        'category_icon'=> $this->getImage($category_icon,'category_image'),
    
                        'sub_category_id'=>$value['sub_category_id'],
                    
                        'sub_category_name'=>$subcategory_name,
                    
                        'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                        
                        'image_list'=>$image_list,
                        
                        'price'=>$value['price'],
                        
                        'delivery_time'=>$value['delivery_time'],
                        
                        'shipping'=>$value['shipping'],
                        
                        'shipping_price'=>$value['shipping_price'],
                        
                        'total_cost'=>$value['total_cost'],
                        
                        'revisions'=>$value['revisions'],
                        
                        'gig_tag'=>$value['gig_tag'],
                        
                        'description'=>$value['description'],
                        
                        'gig_status'=>$value['status'],
                        
                        'gig_rating'=>$gigRating,
                        
                        'review_count'=>$gigreviewCount,
                        
                        'is_favourite'=>'0',
                        
                        'created_at'=>$value['created_at']
                    ];
                }
                else
                {
                    $gigList[]=[
                    
                        'user_id'=>$value['user_id'],
                        
                        'gig_id'=>$value['id'],
                        
                        'title'=>$value['title'],
                        
                        'category_id'=>$value['category_id'],
                        
                        'category_name'=>$category,
                        
                        'category_icon'=> $this->getImage($category_icon,'category_image'),
    
                        'sub_category_id'=>$value['sub_category_id'],
                    
                        'sub_category_name'=>$subcategory_name,
                    
                        'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                        
                        'image_list'=>$image_list,
                        
                        'price'=>$value['price'],
                        
                        'delivery_time'=>$value['delivery_time'],
                        
                        'shipping'=>$value['shipping'],
                        
                        'shipping_price'=>$value['shipping_price'],
                        
                        'total_cost'=>$value['total_cost'],
                        
                        'revisions'=>$value['revisions'],
                        
                        'gig_tag'=>$value['gig_tag'],
                        
                        'description'=>$value['description'],
                        
                        'gig_status'=>$value['status'],
                        
                        'gig_rating'=>$gigRating,
                        
                        'review_count'=>$gigreviewCount,
                        
                        'is_favourite'=>'0',
                        
                        'created_at'=>$value['created_at'],
                        
                        'gig_reviews'=> !empty($value['status']==2) ? $sellerRatingList : $sellerEmpty
                        
                    ];
                }
            }
            
            $data['status']="1";
            
            $data['message']="Success";
            
            $data['all_gig_list']       = $gigList;
            
            $data['draftl_gig_list']    = $draftgigList;
            
            $data['publish_gig_list']   = $publishgigList;
            
            $data['denied_gig_list']    = $deniedgigList;
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit; 
    }
    
    //=========================== Gig Details ====================================//
    
    function GigDetails()
    {
        $user_id    = $this->input->post('user_id');
        
        $gig_id = $this->input->post('gig_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("Gig Id",$gig_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
        
            $data['status']="0";
            
            $data['message']="User not Found";
        
        }
        else
        { 
            $gigData = $this->Api_model->GigList(array('id'=>$gig_id))->row();

            //print_r($gigData);exit;
            
            $gigDetails = array();
            
            if(!empty($gigData))
            {
                
                $orderList=$this->Api_model->OrderList(array('type'=>'1','product_id'=>$gig_id))->row();

                if(!empty($orderList))

                {     

                    $order_id=$orderList->id;

                    $gigReview = $this->Api_model->RatingList(array('gigs_id'=>$gig_id,'order_review!='=>''))->result_array();
                    $gigreviewCount = count($gigReview);

                    $gigRatings =  $this->Api_model->rating(array('gigs_id'=>$gig_id,'order_rating!='=>''),'avg(order_rating) as rating')->row()->rating;
                    $gigRating  = round($gigRatings);
                    $gig_rating = !empty($gigRating) ? $gigRating : '0';

                    $OrderList = $this->Api_model->get_where("orders",array('type'=>'1','product_id'=>$gig_id));

                    $gigReviewList = array();
                    
                    if(!empty($OrderList))
                    {                       
                        foreach ($OrderList as $key => $value)
                        { 

                            $order_id=$value->id;

                            //print_r($order_id);exit;

                            $Rating = $this->Api_model->RatingList(array('order_id'=>$order_id,'order_review!='=>''))->row(); 

                           if(!empty($Rating))
                           {
                                        
                                $userData = $this->Api_model->get_where_row("app_user",array('id' => $Rating->buyer_id));
                                           
                                $gigReviewList[] =[
                                    
                                    'first_name'          => trim($userData->first_name),
                                    'last_name'           => trim($userData->last_name),
                                    'profile'             => $userData->profile_picture,
                                    'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                                    'review'              => $Rating->order_review,
                                    'rating'              => $Rating->order_rating,
                                    'is_date'             => $Rating->created_at,
                                ];
                            }
                          
                        } 

                    }
                }
                else
                {
                    $gigreviewCount="0";
                    $gig_rating="0";
                    $gigReviewList = array();
                }

                if(!empty($gigData->category_id))
                {
                    $Details        = $this->Api_model->get_where_row("category",array('id' => $gigData->category_id));
                    
                    $category       = $Details->category_name;
                    
                    $category_icon  = $Details->category_icon;
                }
                else
                {
                    $category = '';
                    
                    $category_icon = '';
                }
                
                if(!empty($gigData->sub_category_id))
                {
                    $subDetails        = $this->Api_model->get_where_row("category",array('id' => $gigData->sub_category_id));
                    
                    $subcategory_name  = $subDetails->category_name;
                    
                    $sub_category_icon = $subDetails->category_icon;
                }
                else
                {
                    $subcategory_name = '';
                    
                    $sub_category_icon = '';
                }
                
                //$imageList = explode(",",$gigData->image);
                
                $array = json_decode($gigData->image);
                
                $imageList = $array->image_list;
                
                $image_list=array();
                
                foreach ($imageList as $key => $value1) 
                {
                    $image_list[]=[
                    
                        'file' => $value1->file,
                                
                                'thumnail' => $value1->thumnail,
                                
                                'type'     => $value1->type,
                    ];
                }
                
                $gigDetails =[
                
                    'user_id'=>$gigData->user_id,
                    
                    'gig_id'=>$gigData->id,
                    
                    'title'=>$gigData->title,
                    
                    'category_id'=>$gigData->category_id,
                    
                    'category_name'=>$category,
                    
                    'category_icon'=> $this->getImage($category_icon,'category_image'),
    
                    'sub_category_id'=>$gigData->sub_category_id,
                
                    'sub_category_name'=>$subcategory_name,
                
                    'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                    
                    'image_list'=>$image_list,

                    'price'=>$gigData->price,
                    
                    'delivery_time'=>$gigData->delivery_time,
                    
                    'shipping'=>$gigData->shipping,
                    
                    'shipping_price'=>$gigData->shipping_price,
                    
                    'total_cost'=>$gigData->total_cost,
                    
                    'revisions'=>$gigData->revisions,
                    
                    'gig_tag'=>$gigData->gig_tag,
                    
                    'description'=>$gigData->description,
                    
                    'gig_status'=>$gigData->status,
                    
                    'gig_rating'=>"$gig_rating",
                    
                    'review_count'=>"$gigreviewCount",
                    
                    'is_favourite'=>'0'
                ];


                $data['status']="1";
                $data['message']="Success";
                $data['gig_Details'] = $gigDetails;
                $data['gig_reviews'] = $gigReviewList;
               
            }
            else
            {
                $data['status']="0";
                $data['message']="Gig Not Found";
            }


        }       
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit; 
    }
    
    //=========================== favourite add remove ============================//
    
    function favouriteAdd()
    {
    
        $user_id        = $this->input->post('user_id');
        
        $favourite_type = $this->input->post('favourite_type');
        
        $favourite_id   = $this->input->post('favourite_id');
              
        $this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("Favourite Type",$favourite_type,"required");
        
        $this->formValidation("Favourite Id",$favourite_id,"required");
               
        $check_user= (array) $this->getUserDetails(array("id"=>$user_id));
        
        if(empty($check_user))
        {
            $data['status']="0";
            
            $data['message']="User Not Found";
        } 
        else
        {        
            $this->checkAccountStatus($user_id);
            
            if($favourite_type=='1')
            {
                $seller_details=$this->Api_model->getUserDetails(array('id'=>$favourite_id,'id!='=>$user_id))->row();
                
                if(empty($seller_details))
                {
                    $data['status']="0";
                    
                    $data['message']="Seller Not Found";
                }
                else
                {
                    $check_already_favourite_list=$this->Api_model->getGigList(array('favouritelist.user_id'=>$user_id,'favouritelist.favourite_type'=>$favourite_type,'favouritelist.favourite_id'=>$favourite_id))->row();
                    
                    if(empty($check_already_favourite_list))
                    {
                        $favouriteListData=array(
                        
                            'user_id'=>$user_id,
                            
                            'favourite_type'=>'1',
                            
                            'favourite_id'=>$favourite_id,
                            
                            'created_at'=>date('Y-m-d H:i:s')
                        
                        );
                        
                        if($this->Api_model->addFavouriteList($favouriteListData))
                        {
                            $data['status']="1";
                            
                            $data['message']="Favourite Added Successfully";
                        }
                        else
                        {
                            $data['status']="0";
                            
                            $data['message']="Something went wrong";
                        }
                    }
                    else
                    {
                        if($this->Api_model->removeFavouriteList(array('user_id'=>$user_id,'favourite_id'=>$favourite_id)))
                        {
                            $data['status']="1";
                            
                            $data['message']="Favourite Removed Successfully";
                        }
                        else
                        {
                            $data['status']="0";
                            
                            $data['message']="Something went wrong";
                        }
                    }
                
                }
            }
            else
            {            
                $gig_details=$this->Api_model->GigList(array('id'=>$favourite_id))->row();
                
                if(empty($gig_details))
                {
                    $data['status']="0";
                    
                    $data['message']="Gig Not Found";
                }
                else
                {
                    $check_already_favourite_list=$this->Api_model->getGigList1(array('favouritelist.user_id'=>$user_id,'favouritelist.favourite_type'=>$favourite_type,'favouritelist.favourite_id'=>$favourite_id))->row();
                    
                    if(empty($check_already_favourite_list))
                    {
                        $favouriteListData=array(
                            
                            'user_id'=>$user_id,
                            
                            'favourite_type'=>'2',
                            
                            'favourite_id'=>$favourite_id,
                            
                            'created_at'=>date('Y-m-d H:i:s')
                        
                        );
                        
                        if($this->Api_model->addFavouriteList($favouriteListData))
                        {
                            $data['status']="1";
                            
                            $data['message']="Favourite Added Successfully";
                        }
                        else
                        {
                            $data['status']="0";
                            
                            $data['message']="Something went wrong";
                        }
                    }
                    else
                    {
                        if($this->Api_model->removeFavouriteList(array('user_id'=>$user_id,'favourite_id'=>$favourite_id)))
                        {
                            $data['status']="1";
                            
                            $data['message']="Favourite Removed Successfully";
                        }
                        else
                        {
                            $data['status']="0";
                            
                            $data['message']="Something went wrong";
                        }
                    }
                
                }
            }
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== Favourite Seller List ===================================//
     
    function favouriteSeller()
    {
        $user_id=$this->input->post('user_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user= (array) $this->getUserDetails(array("id"=>$user_id));
        
        if(empty($check_user))
        {
            $data['status']="0";            
            $data['message']="User Not Found";
        } 
        else
        {
            $this->checkAccountStatus($user_id);
            
            $favourite_list=$this->Api_model->getGigList(array('favouritelist.user_id'=>$user_id))->result_array();
            
            $favouriteList=array();
            
            $gigList=array();
            
            foreach ($favourite_list as $key => $value) 
            {
                $favourite_type =$value['favourite_type'];
                
                if($favourite_type=='1')
                {
                    $seller_id = $value['favourite_id'];
                    
                     $gig_list=$this->Api_model->GigList(array('user_id'=>$seller_id))->result_array();
                    
                    $gigList=array();
                    
                    foreach ($gig_list as $key => $value1) 
                    {
                    
                        if(!empty($value1['category_id']))
                        {
                            $Details    = $this->Api_model->get_where_row("category",array('id' => $value1['category_id']));
                            
                            $category   = $Details->category_name;
                            
                            $category_icon = $Details->category_icon;
                        }
                        else
                        {
                            $category = '';
                            
                            $category_icon = '';
                        }
                        
                        if(!empty($value1['sub_category_id']))
                        {
                            $Details    = $this->Api_model->get_where_row("category",array('id' => $value1['sub_category_id']));
                            
                            $subcategory_name = $Details->category_name;
                            
                            $sub_category_icon = $Details->category_icon;
                        }
                        else
                        {
                            $subcategory_name = '';
                            
                            $sub_category_icon = '';
                        }
                        
                        // $imageList = explode(",",$value1['image']);
                        
                        // $image_list=array();
                        
                        // foreach ($imageList as $key => $value2) 
                        // {
                        //     $image_list[]=[
                            
                        //         'image'     => $value2,
                                
                        //         'image_url' => $this->getImage($value2,'gig_image')
                        //     ];
                        // }
                        
                        $array = json_decode($value1['image']);                
                        $imageList = $array->image_list;                        
                        $image_list=array();
                        
                        foreach ($imageList as $key => $value2) 
                        {
                            $image_list[]=[
                            
                                'file'      => $this->getImage($value2->file,'gig_image'),
                                'thumnail'  => $this->getImage($value2->thumnail,'gig_image'),
                                'type'      => $value2->type,
                            ];
                        }
                        
                        $gigList[]=[                        
                           
                            'gig_id'=>$value1['id'],
                            
                            'title'=>$value1['title'],
                            
                            'category_id'=>$value1['category_id'],
                            
                            'category_name'=>$category,
                            
                            'category_icon'=> $this->getImage($category_icon,'category_image'),
                            
                            'sub_category_id'=>$value1['sub_category_id'],
                            
                            'sub_category_name'=>$subcategory_name,
                            
                            'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                            
                            'image_list'=>$image_list,
                            
                            'price'=>$value1['price'],
                            
                            'delivery_time'=>$value1['delivery_time'],
                            
                            'shipping'=>$value1['shipping'],
                            
                            'shipping_price'=>$value1['shipping_price'],
                        
                            'total_cost'=>$value1['total_cost'],
                            
                            'revisions'=>$value1['revisions'],
                            
                            'gig_tag'=>$value1['gig_tag'],
                            
                            'description'=>$value1['description'],
                            
                            'gig_status'=>$value1['status'],

                            'review_count'=>'0',
                            
                            'gig_rating'=>'0',
                            
                            'is_favourite'=>'1',
                        ];
                    
                    }
                    
                    $userData = $this->Api_model->get_where_row("app_user",array('id' => $seller_id));

                    $completed = $this->Api_model->getCompleted($seller_id);    
                    $orders_completed = $completed->id ? $completed->id : '0';

                    $Rating = ceil($this->Api_model->rating(array('seller_id'=>$seller_id,'seller_rating!='=>'0'),'avg(seller_rating) as rating')->row()->rating);
                    $rating = !empty($Rating) ? $Rating : '0';
                    
                    $favouriteList[]=[ 
                    
                        'seller_id'           => $userData->id,
                        'first_name'          => trim($userData->first_name),
                        'last_name'           => trim($userData->last_name),
                        'email'               => $userData->email,
                        'profile'             => $userData->profile_picture,
                        'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                        'mobile_country'      => $userData->mobile_country,
                        'phone_no'            => $userData->phone_no,
                        'is_email_verified'   => $userData->is_email_verified,
                        'is_mobile_verified'  => $userData->is_mobile_verified,
                        'address'             => $userData->address,
                        'about'               => $userData->about,
                        'skills'              => $userData->skills,
                        'language'            => $userData->language,
                        'rating'              => "$rating",
                        'live_status'         => $userData->live_status,
                        'last_visited'        => $userData->updated_at,
                        'join_date'           => $userData->created_at,
                        'orders_completed'    => $orders_completed,
                        'gig_details'         => $gigList
                    
                    ];
                }
            }
        
            $data['status']="1";
            $data['message']="Success";
            $data['favouriteseller_list']=$favouriteList;
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== Favourite Gig List ===================================//

    function favouriteGig()
    {
        $user_id=$this->input->post('user_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user= (array) $this->getUserDetails(array("id"=>$user_id));
        
        if(empty($check_user))
        {
            $data['status']="0";            
            $data['message']="User Not Found";
        } 
        else
        {
            $this->checkAccountStatus($user_id);
            
            $favourite_list=$this->Api_model->getGigList1(array('favouritelist.user_id'=>$user_id))->result_array();

            $favouriteList=array();
            
            $gigList=array();
            
            foreach ($favourite_list as $key => $value) 
            {
                $favourite_type =$value['favourite_type'];
                
                if($favourite_type=='2')
                {
                    $favourite_id= $value['favourite_id'];
                    
                     $gig_list=$this->Api_model->GigList(array('id'=>$favourite_id))->result_array();
                    
                    $gigList=array();
                    
                    foreach ($gig_list as $key => $value1) 
                    {
                    
                        if(!empty($value1['category_id']))
                        {
                            $Details    = $this->Api_model->get_where_row("category",array('id' => $value1['category_id']));
                            
                            $category   = $Details->category_name;
                            
                            $category_icon = $Details->category_icon;
                        }
                        else
                        {
                            $category = '';
                            
                            $category_icon = '';
                        }
                        
                        if(!empty($value1['sub_category_id']))
                        {
                            $Details    = $this->Api_model->get_where_row("category",array('id' => $value1['sub_category_id']));
                            
                            $subcategory_name = $Details->category_name;
                            
                            $sub_category_icon = $Details->category_icon;
                        }
                        else
                        {
                            $subcategory_name = '';
                            
                            $sub_category_icon = '';
                        }
                        
                        // $imageList = explode(",",$value1['image']);
                        
                        // $image_list=array();
                        
                        // foreach ($imageList as $key => $value2) 
                        // {
                        //     $image_list[]=[
                            
                        //         'image'     => $value2,
                                
                        //         'image_url' => $this->getImage($value2,'gig_image')
                        //     ];
                        // }
                        
                        $array = json_decode($value1['image']);
                
                        $imageList = $array->image_list;
                        
                        $image_list=array();
                        
                        foreach ($imageList as $key => $value2) 
                        {
                            $image_list[]=[
                            
                                 'file'     => $this->getImage($value2->file,'gig_image'),
                                
                                'thumnail'  => $this->getImage($value2->thumnail,'gig_image'),
                                
                                'type'      => $value2->type,
                            ];
                        }

                        $gigReview = $this->Api_model->RatingList(array('gigs_id'=>$value1['id'],'order_review!='=>''))->result_array();

                        $gigreviewCount  = count($gigReview);
                     
                        $gigRatings       =  $this->Api_model->rating(array('gigs_id'=>$value1['id'],'order_rating!='=>''),'avg(order_rating) as rating')->row()->rating;
                         
                        $gigRating=round($gigRatings);

                        $rating1 = !empty($gigreviewCount) ? $gigreviewCount : '0';
                        $rating2 = !empty($gigRating) ? $gigRating : '0';
                        
                        $gigList[]=[                        
                           
                            'gig_id'=>$value1['id'],
                            
                            'title'=>$value1['title'],
                            
                            'category_id'=>$value1['category_id'],
                            
                            'category_name'=>$category,
                            
                            'category_icon'=> $this->getImage($category_icon,'category_image'),
                            
                            'sub_category_id'=>$value1['sub_category_id'],
                            
                            'sub_category_name'=>$subcategory_name,
                            
                            'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                            
                            'image_list'=>$image_list,
                            
                            'price'=>$value1['price'],
                            
                            'delivery_time'=>$value1['delivery_time'],
                            
                            'shipping'=>$value1['shipping'],
                            
                            'shipping_price'=>$value1['shipping_price'],
                        
                            'total_cost'=>$value1['total_cost'],
                            
                            'revisions'=>$value1['revisions'],
                            
                            'gig_tag'=>$value1['gig_tag'],
                            
                            'description'=>$value1['description'],
                            
                            'gig_status'=>$value1['status'],

                            'review_count'=>$rating1,
                            
                            'gig_rating'=>$rating2,
                            
                            'is_favourite'=>'1',
                        ];
                    
                    }
                    
                    $userData = $this->Api_model->get_where_row("app_user",array('id' =>$value1['user_id']));

                    $completed=$this->Api_model->getCompleted($value1['user_id']);            
                    $orders_completed = $completed->id ? $completed->id : '0';

                    $Rating =$this->Api_model->rating(array('seller_id'=>$value1['user_id']),'avg(buyer_rating) as rating')->row()->rating;

                    $buyerRatings    = !empty($Rating) ? $Rating : '0';

                   //print_r($buyerRatings);exit;
             
                   $buyer_count=$this->Api_model->get_count('reviews',array('buyer_id'=>$value1['user_id']));

                   $buyer_count = $buyer_count ? $buyer_count : 1; 

                     if($buyerRatings=="0")
                     {
                         $Rating="0";
                     }
                     else
                     {
                         $buyerRatingB = $buyerRatings/$buyer_count;

                         $Rating=round($buyerRatingB);
                     }

                    $rating = !empty($Rating) ? $Rating : '0';
                    
                    $favouriteList[]=[
                    
                        'seller_id'           => $userData->id,
                        'first_name'          => trim($userData->first_name),
                        'last_name'           => trim($userData->last_name),
                        'email'               => $userData->email,
                        'profile'             => $userData->profile_picture,
                        'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                        'mobile_country'      => $userData->mobile_country,
                        'phone_no'            => $userData->phone_no,
                        'is_email_verified'   => $userData->is_email_verified,
                        'is_mobile_verified'  => $userData->is_mobile_verified,
                        'address'             => $userData->address,
                        'about'               => $userData->about,
                        'skills'              => $userData->skills,
                        'language'            => $userData->language,
                        'rating'              => "$rating",
                        'live_status'         => $userData->live_status,
                        'last_visited'        => $userData->updated_at,
                        'join_date'           => $userData->created_at,
                        'orders_completed'    => $orders_completed,
                        'gig_details'         => $gigList
                    
                    ];
                }
            }
        
            $data['status']="1";
            $data['message']="Success";
            $data['favouritegig_list']=$favouriteList;
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== Category Gig List ===================================//

    function categoryGiglist()
    {
        $user_id         = $this->input->post('user_id');
        $sub_category_id = $this->input->post('sub_category_id');     
        $search_key     = $this->input->post('search_key');        
        $location       = $this->input->post('seller_location');        
        $lattitude      = $this->input->post('seller_lat');        
        $longitude      = $this->input->post('seller_lon');        
        $category       = $this->input->post('category_id');        
        $delivery       = $this->input->post('delivery_time');        
        $online_status  = $this->input->post('online_status');        
        $language       = $this->input->post('language');        
        $minimum        = $this->input->post('minimum_price');        
        $maximum        = $this->input->post('maximum_price');
        $tags           = $this->input->post('tags');
        
        $this->formValidation("User Id",$user_id,"required");        
        $this->formValidation("Sub Category Id",$sub_category_id,"required");
        
        $filter = array(
            'lat'           => $lattitude,
            'lon'           => $longitude,
            'location'      => $location,
            'category'      => $category,
            'subcategory'   => $sub_category_id,
            'delivery'      => $delivery,
            'status'        => $online_status,
            'language'      => $language,
            'min_price'     => $minimum,
            'max_price'     => $maximum,
            'tags'          => $tags
        );
        
        $check_user= (array) $this->getUserDetails(array("id"=>$user_id));
        
        if(empty($check_user))
        {
            $data['status']="0";            
            $data['message']="User Not Found";
        } 
        else
        {
            $this->checkAccountStatus($user_id);
            
            $favouriteList=array();
            
            $gig_list=$this->Api_model->giglistSearch(array('gig_list.user_id!='=>$user_id,'gig_list.sub_category_id'=>$sub_category_id,'gig_list.status'=>'2'),$search_key,$filter)->result_array();
            
            $sellerList=array();
            $gigList=array();
                    
            foreach ($gig_list as $key => $value1) 
            {
				$gigRatings = round($this->Api_model->rating(array('gigs_id'=>$value1['id'],'order_rating!='=>''),'avg(order_rating) as rating')->row()->rating);
				$gigRating = !empty($gigRatings) ? round($gigRatings) : '0';

				$gigReview = $this->Api_model->RatingList(array('gigs_id'=>$value1['id'],'order_review!='=>''))->result_array();
				$gigReviewCount = !empty($gigReview) ? count($gigReview) : '0';
				
                $gigFav=$this->Api_model->getGigList1(array('favouritelist.user_id='=>$user_id,'favouritelist.favourite_type='=>'2','favouritelist.favourite_id'=>$value1['id']))->row();
                $Fav = $gigFav ? '1' : '0';             

                $seller_id = $value1['user_id'];
                $userData = $this->Api_model->get_where_row("app_user",array('id' => $seller_id));

                $completed=$this->Api_model->getCompleted($seller_id);            
                $orders_completed = $completed->id ? $completed->id : '0';

                $Rating = round($this->Api_model->rating(array('seller_id'=>$seller_id,'buyer_rating!='=>'0'),'avg(seller_rating) as rating')->row()->rating);
                $rating = !empty($Rating) ? $Rating : '0';
                
               $sellerList=[ 
                    'seller_id'           => $seller_id,
                    'first_name'          => trim($userData->first_name),
                    'last_name'           => trim($userData->last_name),
                    'email'               => $userData->email,
                    'profile'             => $userData->profile_picture,
                    'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                    'mobile_country'      => $userData->mobile_country,
                    'phone_no'            => $userData->phone_no,
                    'is_email_verified'   => $userData->is_email_verified,
                    'is_mobile_verified'  => $userData->is_mobile_verified,
                    'address'             => $userData->address,
                    'about'               => $userData->about,
                     'skills'             => $userData->skills,
                    'language'            => $userData->language,
                    'rating'              => "$rating",
                    'live_status'         => $userData->live_status,
                    'last_visited'        => $userData->updated_at,
                    'join_date'           => $userData->created_at,
                    'orders_completed'    => $orders_completed
                
                ];
            
                if(!empty($value1['category_id']))
                {
                    $Details    = $this->Api_model->get_where_row("category",array('id' => $value1['category_id']));
                    
                    $category   = $Details->category_name;                    
                    $category_icon = $Details->category_icon;
                }
                else
                {
                    $category = '';                    
                    $category_icon = '';
                }
                
                if(!empty($value1['sub_category_id']))
                {
                    $Details    = $this->Api_model->get_where_row("category",array('id' => $value1['sub_category_id']));
                    
                    $subcategory_name = $Details->category_name;                    
                    $sub_category_icon = $Details->category_icon;
                }
                else
                {
                    $subcategory_name = '';                    
                    $sub_category_icon = '';
                }
                               
                $array = json_decode($value1['image']);        
                $imageList = $array->image_list;
                
                $image_list=array();
                
                foreach ($imageList as $key => $value2) 
                {
                    $image_list[]=[
                    
                        'file' => $value2->file,
                        'file' => $this->getImage($value2->file,'gig_image'),
                        'thumnail' => $this->getImage($value2->thumnail,'gig_image'),
                        'type'     => $value2->type,
                    ];
                }
                
                $gigList[]=[          
                    
                    'seller_details' => $sellerList,
                   
                    'gig_id'=>$value1['id'],
                    
                    'title'=>$value1['title'],
                    
                    'category_id'=>$value1['category_id'],
                    
                    'category_name'=>$category,
                    
                    'category_icon'=> $this->getImage($category_icon,'category_image'),
                    
                    'sub_category_id'=>$value1['sub_category_id'],
                    
                    'sub_category_name'=>$subcategory_name,
                    
                    'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                    
                    'image_list'=>$image_list,
                    
                    'price'=>$value1['price'],
                    
                    'delivery_time'=>$value1['delivery_time'],
                    
                    'shipping'=>$value1['shipping'],
                    
                    'shipping_price'=>$value1['shipping_price'],
                        
                    'total_cost'=>$value1['total_cost'],
                    
                    'revisions'=>$value1['revisions'],
                    
                    'gig_tag'=>$value1['gig_tag'],
                    
                    'description'=>$value1['description'],
                    
                    'gig_status'=>$value1['status'],

                    'review_count'=>"$gigReviewCount",
                    
                    'gig_rating'=>"$gigRating",
                    
                    'is_favourite'=>$Fav                    
                ];
            
            }
        
            $data['status']="1";            
            $data['message']="Success";            
            $data['categorygig_list']=$gigList;
        }
        
        header( 'Content-type:application/json');        
        print json_encode( $data);        
        exit;    
    }
    
    //=========================== Card Add ===============================//

    function cardAdd()
    {
        $user_id     = $this->input->post('user_id');        
        $seller_id   = $this->input->post('seller_id');        
        $gig_id      = $this->input->post('gig_id');        
        $quantity    = $this->input->post('quantity');        
        $description = $this->input->post('description');
        
        $this->formValidation("User Id",$user_id,"required");        
        $this->formValidation("Seller Id",$seller_id,"required");        
        $this->formValidation("Gig Id",$gig_id,"required");        
        //$check_user=(array) $this->getUserDetails("id='$user_id'");
        
        $gigList=$this->Api_model->GigList(array('user_id='=>$seller_id,'id'=>$gig_id))->row();
    
        if(empty($gigList))
        {
            $data['status']="0";    
            $data['message']="Record not Found";
        }
        else
        { 
            $deliveryTime    = $gigList->delivery_time;

            $price    = $gigList->price;
            
            $total = $price * $quantity;
            
            $shipping_price = $gigList->shipping_price;
            
            $final_cost = $total + $shipping_price;
            
              $this->checkAccountStatus($user_id);
              
              $Details = $this->Api_model->CardList(array('user_id'=>$user_id,'gig_id'=>$gig_id))->row();
              
              if(empty($Details))
              {
        
                  $Data=array(
        
                      'user_id'=>$user_id,
                      
                      'seller_id'=>$seller_id,
        
                      'gig_id'=>$gig_id,                    
                      
                      'description'=>$description,

                      'delivery_time'=>$deliveryTime,
    
                      'quantity'=>$quantity,
                      
                      'price'=>$price,
                      
                      'total_cost'=>$total,
                      
                      'shipping_cost'=>$shipping_price,
                      
                      'final_cost'=>$final_cost,

                      'created_at'=>date('Y-m-d H:i:s')
                  );
        
                  if($gig_id=$this->Api_model->AddCard('',$Data))
                  {
                      $data['status']="1";
                      
                      $data['message']="Gig added to cart successfully";
                  }
                  else
                  {
                      $data['status']="0";
        
                      $data['message']="Something went wrong";
                  }
              }
              else
              {                  
                  if($quantity==1)
                  {
                        //$quantity_f = $Details->quantity;
                        
                        //$final = $quantity_f + $quantity;

                        $deliveryTime    = $gigList->delivery_time;
                        
                        $price    = $gigList->price;
                        
                        $total = $price * $quantity;
                        
                        $shipping_price = $gigList->shipping_price;
                        
                        $final_cost = $total + $shipping_price;
                                                
                        $quantity = $quantity;
                  }
                                   
                  $Data=array(
        
                      'user_id'=>$user_id,
                      
                      'seller_id'=>$seller_id,
        
                      'gig_id'=>$gig_id,
                      
                      'description'=>$description,

                      'delivery_time'=>$deliveryTime,
    
                      'quantity'=>$quantity,
                      
                      'price'=>$price,
                      
                      'total_cost'=>$total,
                      
                      'shipping_cost'=>$shipping_price,
                      
                      'final_cost'=>$final_cost,
        
                      'updated_at'=>date('Y-m-d H:i:s')
                  );
        
                  if($gig_id=$this->Api_model->AddCard(array('user_id'=>$user_id,'gig_id'=>$gig_id),$Data))
                  {
                      $data['status']="1";
                      
                      $data['message']="Gig added to cart successfully";
                  }
                  else
                  {
                      $data['status']="0";
        
                      $data['message']="Something went wrong";
                  }
              }
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    //=========================== Card Remove ===============================//

    function cardRemove()
    {
        $user_id=$this->input->post('user_id');
    
        $gig_id=$this->input->post('gig_id');
          
        $this->formValidation("User Id",$user_id,"required");
    
        $this->formValidation("Gig Id",$gig_id,"required");
    
        $check_user=(array) $this->getUserDetails("id='$user_id'");
    
        if(empty($check_user))
        {
            $data['status']="0";
    
            $data['message']="User not Found";
        }
        else
        { 
            $this->checkAccountStatus($user_id);
            
            $Details = $this->Api_model->CardList(array('user_id'=>$user_id,'gig_id'=>$gig_id))->row();
            
            if(!empty($Details))
            {
                if($gig_id=$this->Api_model->delete('cart',array('user_id'=>$user_id,'gig_id'=>$gig_id)))
                {
                    $data['status']="1";
                    
                    $data['message']="Remove Successfully";
                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Something went wrong";
                }
            }
            else
            {
                $data['status']="0";
                
                $data['message']="No Record found";
            }
        }
    
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit; 
    }
    
    //=========================== Order Now ===============================//

    function orderNow()
    {
        $user_id        = $this->input->post('user_id');
        
        $payment_option = $this->input->post('payment_option');
        
        $payment_id     = $this->input->post('payment_id');
        
        $total_amount   = $this->input->post('total_amount');     
        
        $this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("Payment Option",$payment_option,"required");
        
        $this->formValidation("Payment Id",$payment_id,"required");
        
        $this->formValidation("Total Amount",$total_amount,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
    
        if(empty($check_user))
        {
            $data['status']="0";
    
            $data['message']="User not Found";
        }
        else
        { 
            $check_now=$this->Api_model->CardList(array('user_id'=>$user_id))->result_array(); 
    
            if(empty($check_now))
            {
                $data['status']="0";
        
                $data['message']="Record not Found";
            }
            else
            { 
                $this->checkAccountStatus($user_id);
                
                $Details = $this->Api_model->CardList(array('user_id'=>$user_id))->result_array(); 
                
                foreach ($Details as $key => $value) 
                {

                    $buyer_id  = $value['user_id'];

                    $seller_id = $value['seller_id'];
                    
                    $Data=array(
                    
                        'buyer_id'=>$value['user_id'],
                        
                        'seller_id'=>$value['seller_id'],
                        
                        'product_id'=>$value['gig_id'],
                        
                        'type'=>1,
                        
                        'delivery_time'=>$value['delivery_time'],

                        'quantity'=>$value['quantity'],
                        
                        'price'=>$value['price'],
                        
                        'total_cost'=>$value['total_cost'],
                        
                        'shipping_cost'=>$value['shipping_cost'],
                        
                        'final_cost'=>$value['final_cost'],
                        
                        'description'=>$value['description'],
                        
                        'order_status'=>'3',
                        
                        'created_at'=>date('Y-m-d H:i:s')
                    );
                    
                    if($id=$this->Api_model->Orders('',$Data))
                    {                                      
                        $data['status']="1";
                        
                        $data['message']="Added Successfully";

                        $this->prepreFcm('buyercart',array('user_id'=>$buyer_id,'order_id'=>$id));

                        $this->prepreFcm('sellercart',array('user_id'=>$seller_id,'order_id'=>$id,'buyer_id'=>$buyer_id));

                        $this->Api_model->delete('cart',array('gig_id' => $value['gig_id']));
                    }
                    else
                    {
                        $data['status']="0";
                        
                        $data['message']="Something went wrong";
                    }
                    
                }
            }
        }
    
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit; 
    }
    
    //=========================== Card Count ====================================//
    
    function cardCount()
    {
        $user_id    = $this->input->post('user_id');
        
        //$gig_id = $this->input->post('gig_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        //$this->formValidation("Gig Id",$gig_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
            $data['status']="0";
            
            $data['message']="User not Found";
        }
        else
        { 
            $CardData = $this->Api_model->CardList(array('user_id'=>$user_id))->result_array();
            
            $gigDetails = array();
            
            $quantity=0;
            
            foreach ($CardData as $key => $value1) 
            {
                $quantity += $value1['quantity'];
            }
        }
        
        $data['status']="1";
        $data['message']="Success";
        $data['cart_Count'] = $quantity;

        header( 'Content-type:application/json');
        print json_encode( $data);
        exit; 
    }
    
    //=========================== Card Item ====================================//
    
    function cardItem()
    {
        $user_id    = $this->input->post('user_id');
        
        //$gig_id = $this->input->post('gig_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        //$this->formValidation("Gig Id",$gig_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
            $data['status']="0";
            
            $data['message']="User not Found";
        }
        else
        { 
            $CardData = $this->Api_model->CardList(array('user_id'=>$user_id))->result_array();
            
            $cartDetails = array();
            
            $grand_total = 0;
            
            if(!empty($CardData))
            {
                foreach ($CardData as $key => $value1) 
                {
                     $Details    = $this->Api_model->get_where_row("gig_list",array('id' => $value1['gig_id']));
                     
                     if(!empty($Details))
                     {
                         
                        $array = json_decode($Details->image);
                
                        $imageList = $array->image_list;
                        
                        $image_list=array();
                        
                        $i=1;
                        foreach ($imageList as $key => $value2) 
                        {
                            if($i==1)
                            {
                                $image_list[]=[
                                
                                    //'file' => $this->getImage($value2->file,'gig_image'),
                                    

                                'thumnail' => $this->getImage($value2->thumnail,'gig_image'),
                                    
                                    //'type'     => $value2->type,
                                ];
                            }
                            $i++;
                        }
                        
                        $grand_total += $value1['final_cost'];
                        
                        $cartDetails[] =[
                        
                            'user_id'=>$value1['user_id'],
                            
                            'seller_id'=>$value1['seller_id'],
                            
                            'gig_id'=>$value1['gig_id'],
                            
                            'title'=>$Details->title,
                            
                            'image_list'=>$image_list,
                            
                            'gig_description'=>$Details->description,
                            
                            'card_description'=>$value1['description'],
                            
                            'price'=>$Details->price,
                            
                            'quantity'=>$value1['quantity'],
                            
                            'total_cost'=>$value1['total_cost'],
                            
                            'shipping_price'=>$value1['shipping_cost'],
                            
                            'final_cost'=>$value1['final_cost'],
                        ];
                     }
                }
            }
        }
        
        $data['status']="1";
        $data['message']="Success";
        $data['grand_total']="$grand_total";
        $data['cart_item'] = $cartDetails;

        header( 'Content-type:application/json');
        print json_encode( $data);
        exit; 
    }
    
    //=========================== My Order ====================================//
    
    function myOrders()
    {
        $user_id    = $this->input->post('user_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
            $data['status']="0";
            
            $data['message']="User not Found";
        }
        else
        { 
            $activeList     = array();
            $deliveredList  = array();
            $cancelledList  = array();
            $sellerList     = array();
            
            $this->checkAccountStatus($user_id);                       
            
            $order_list=$this->Api_model->OrderList(array('buyer_id'=>$user_id))->result_array();
                        
            foreach ($order_list as $key => $values)
            {
                if($values['type']=='1')
                {
                    $gigid    = $values['product_id'];
                    $gig_list = $this->Api_model->GigList(array('id'=>$gigid))->row();
                    $seller_id  = $values['seller_id'];
                    
                    $userData = $this->Api_model->get_where_row("app_user",array('id' => $seller_id));

                    $completed=$this->Api_model->getCompleted($seller_id);            
                    $orders_completed = $completed->id ? $completed->id : '0';

                    $Rating = ceil($this->Api_model->rating(array('seller_id'=>$seller_id,'seller_rating!='=>'0'),'avg(seller_rating) as rating')->row()->rating);
                    $rating = !empty($Rating) ? $Rating : '0';
                    
                    $sellerList=[ 
                    
                        'seller_id'            => $userData->id,
                        'first_name'          => trim($userData->first_name),
                        'last_name'           => trim($userData->last_name),
                        'email'               => $userData->email,
                        'profile'             => $userData->profile_picture,
                        'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                        'mobile_country'      => $userData->mobile_country,
                        'phone_no'            => $userData->phone_no,
                        'is_email_verified'   => $userData->is_email_verified,
                        'is_mobile_verified'  => $userData->is_mobile_verified,
                        'address'             => $userData->address,
                        'about'               => $userData->about,
                        'skills'              => $userData->skills,
                        'language'            => $userData->language,
                        'rating'              => "$rating",
                        'live_status'         => $userData->live_status,
                        'last_visited'        => $userData->updated_at,
                        'join_date'           => $userData->created_at,
                        'orders_completed'    => $orders_completed
                    ];
                    
                    if(!empty($gig_list->category_id))
                    {
                        $Details = $this->Api_model->get_where_row("category",array('id' => $gig_list->category_id));

                        $category       = $Details->category_name;
                        $category_icon  = $Details->category_icon;
                    }
                    else
                    {
                        $category       = '';                        
                        $category_icon  = '';
                    }
                    
                    if(!empty($gig_list->sub_category_id))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $gig_list->sub_category_id));
                        
                        $subcategory_name   = $Details->category_name;
                        $sub_category_icon  = $Details->category_icon;
                    }
                    else
                    {
                        $subcategory_name   = '';                        
                        $sub_category_icon  = '';
                    }
                    
                    $image_list=array();
                    
                    $array = json_decode($gig_list->image);
                
                    $imageList = $array->image_list;
                    
                    $image_list=array();
                    
                    foreach ($imageList as $key => $value2) 
                    {
                        $image_list[]=[
                        
                            'image'     =>  $value2->type,
                            
                            'image_url' => $this->getImage($value2->thumnail,'gig_image'),
                        ];
                    }

                    if($values['order_status']==3)
                    {
                        $activeList[]=[
                        
                            'buyer_id'=>$user_id,
                            
                            'seller_details'=>$sellerList,
                            
                            'order_id'=>$values['id'],
                            
                            'order_date'=>$values['created_at'],
                            
                            //'gig_id'=>$gig_list->id,
                            
                            'title'=>$gig_list->title,
                            
                            'category_id'=>$gig_list->category_id,
                            
                            'category_name'=>$category,
                            
                            'category_icon'=> $this->getImage($category_icon,'category_image'),
                    
                            'sub_category_id'=>$gig_list->sub_category_id,
                        
                            'sub_category_name'=>$subcategory_name,
                        
                            'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                            
                            'image_list'=>$image_list,
                            
                            'price'=>$values['price'],
                            
                            'quantity'=>$values['quantity'],
                            
                            'deliverytime'=>$gig_list->delivery_time,
                            
                            'description'=>$gig_list->description,

                            'requirement'=>$values['description'],
                            
                            'shipping_price'=>$values['shipping_cost'],
                            
                            'total_cost'=>$values['final_cost'],

                            'time_extension'=>$values['time_extension'],

                            'time_description'=>$values['time_description'],

                            'time_status'=>$values['time_status']
                        ];
                    }
                    if($values['order_status']==4)
                    {
                        $deliveredList[]=[
                        
                            'buyer_id'=>$user_id,
                            
                            'seller_details'=>$sellerList,    
                        
                            'order_id'=>$values['id'],
                            
                            'order_date'=>$values['created_at'],
                            
                            //'gig_id'=>$gig_list->id,
                            
                            'title'=>$gig_list->title,
                            
                            'category_id'=>$gig_list->category_id,
                            
                            'category_name'=>$category,
                            
                            'category_icon'=> $this->getImage($category_icon,'category_image'),
                    
                            'sub_category_id'=>$gig_list->sub_category_id,
                        
                            'sub_category_name'=>$subcategory_name,
                        
                            'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                            
                            'image_list'=>$image_list,
                            
                            'price'=>$values['price'],
                            
                            'quantity'=>$values['quantity'],
                            
                            'deliverytime'=>$gig_list->delivery_time,
                            
                            'description'=>$gig_list->description,

                            'requirement'=>$values['description'],
                            
                            'shipping_price'=>$values['shipping_cost'],
                            
                            'total_cost'=>$values['final_cost'],

                            'time_extension'=>$values['time_extension'],

                            'time_description'=>$values['time_description'],

                            'time_status'=>$values['time_status']
                        ];
                    }
                    
                    if($values['order_status']==7)
                    {
                        $cancelledList[]=[
                        
                            'buyer_id'=>$user_id,
                            
                            'seller_details'=>$sellerList,     
                        
                            'order_id'=>$values['id'],
                            
                            'order_date'=>$values['created_at'],
                            
                            //'gig_id'=>$gig_list->id,
                            
                            'title'=>$gig_list->title,
                            
                            'category_id'=>$gig_list->category_id,
                            
                            'category_name'=>$category,
                            
                            'category_icon'=> $this->getImage($category_icon,'category_image'),
                    
                            'sub_category_id'=>$gig_list->sub_category_id,
                        
                            'sub_category_name'=>$subcategory_name,
                        
                            'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                            
                            'image_list'=>$image_list,
                            
                            'price'=>$values['price'],
                            
                            'quantity'=>$values['quantity'],
                            
                            'deliverytime'=>$gig_list->delivery_time,
                            
                            'description'=>$gig_list->description,

                            'requirement'=>$values['description'],
                            
                            'shipping_price'=>$values['shipping_cost'],
                            
                            'total_cost'=>$values['final_cost'],

                            'time_extension'=>$values['time_extension'],

                            'time_description'=>$values['time_description'],

                            'time_status'=>$values['time_status']
                        ];
                    }  
                }
                
                if($values['type']=='2')
                {
                    $requestid = $values['product_id'];                               
                    $request_list=$this->Api_model->RequestList(array('id'=>$requestid))->row();     
                    
                    $seller_id  = $values['seller_id'];
                    
                    $userData = $this->Api_model->get_where_row("app_user",array('id' => $seller_id));

                    $completed=$this->Api_model->getCompleted($seller_id);            
                    $orders_completed = $completed->id ? $completed->id : '0';

                    $Rating = ceil($this->Api_model->rating(array('seller_id'=>$seller_id,'seller_rating!='=>'0'),'avg(seller_rating) as rating')->row()->rating);
                    $rating = !empty($Rating) ? $Rating : '0';
                    
                    $sellerList=[ 
                    
                        'buyer_id'            => $userData->id,
                        'first_name'          => trim($userData->first_name),
                        'last_name'           => trim($userData->last_name),
                        'email'               => $userData->email,
                        'profile'             => $userData->profile_picture,
                        'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                        'mobile_country'      => $userData->mobile_country,
                        'phone_no'            => $userData->phone_no,
                        'is_email_verified'   => $userData->is_email_verified,
                        'is_mobile_verified'  => $userData->is_mobile_verified,
                        'address'             => $userData->address,
                        'about'               => $userData->about,
                        'skills'              => $userData->skills,
                        'language'            => $userData->language,
                        'rating'              => "$rating",
                        'live_status'         => $userData->live_status,
                        'last_visited'        => $userData->updated_at,
                        'join_date'           => $userData->created_at,
                        'orders_completed'    => $orders_completed
    
                    ];
                    
                    if(!empty($request_list->category))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $request_list->category));
                        
                        $category   = $Details->category_name;
                        
                        $category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $category = '';
                        
                        $category_icon = '';
                    }
                    
                    if(!empty($request_list->subcategory))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $request_list->subcategory));
                        
                        $subcategory_name = $Details->category_name;
                        
                        $sub_category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $subcategory_name = '';
                        
                        $sub_category_icon = '';
                    }
                    
                    $imageList = explode(",",$request_list->image);
                    
                    $image_list=array();
                    
                    foreach ($imageList as $key => $value1) 
                    {
                        $image_list[]=[
                        
                            'image'     => $value1,
                            
                            'image_url' => $this->getImage($value1,'request_image')
                        ];
                    }
                    
                    if($values['order_status']==3)
                    {
                        $activeList[]=[
                        
                            'buyer_id'=>$user_id,
                            
                            'seller_details'=>$sellerList,  
                        
                            'order_id'=>$values['id'],
                            
                            'order_date'=>$values['created_at'],
                            
                            //'request_id'=>$request_list->id,
                            
                            'title'=>'',
                            
                            'category_id'=>$request_list->category,
                            
                            'category_name'=>$category,
                            
                            'category_icon'=> $this->getImage($category_icon,'category_image'),
                    
                            'sub_category_id'=>$request_list->subcategory,
                        
                            'sub_category_name'=>$subcategory_name,
                        
                            'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                            
                            'image_list'=>$image_list,
                            
                            'price'=>$values['price'],
                            
                            'quantity'=>$values['quantity'],
                            
                            'deliverytime'=>$request_list->deliverytime,
                            
                            'description'=>$request_list->description,

                            'requirement'=>$values['description'],
                            
                            'shipping_price'=>$values['shipping_cost'],
                            
                            'total_cost'=>$values['final_cost'],

                            'time_extension'=>$values['time_extension'],

                            'time_description'=>$values['time_description'],

                            'time_status'=>$values['time_status']
                        ];
                    }
                    if($values['order_status']==4)
                    {
                        $deliveredList[]=[
                        
                            'buyer_id'=>$user_id,
                            
                            'seller_details'=>$sellerList,     
                        
                            'order_id'=>$values['id'],
                            
                            'order_date'=>$values['created_at'],
                            
                            //'request_id'=>$request_list->id,
                            
                            'title'=>'',
                            
                            'category_id'=>$request_list->category,
                            
                            'category_name'=>$category,
                            
                            'category_icon'=> $this->getImage($category_icon,'category_image'),
                    
                            'sub_category_id'=>$request_list->subcategory,
                        
                            'sub_category_name'=>$subcategory_name,
                        
                            'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                            
                            'image_list'=>$image_list,
                            
                            'price'=>$values['price'],
                            
                            'quantity'=>$values['quantity'],
                            
                            'deliverytime'=>$request_list->deliverytime,
                            
                            'description'=>$request_list->description,

                            'requirement'=>$values['description'],
                            
                            'shipping_price'=>$values['shipping_cost'],
                            
                            'total_cost'=>$values['final_cost'],

                            'time_extension'=>$values['time_extension'],

                            'time_description'=>$values['time_description'],

                            'time_status'=>$values['time_status']
                        ];
                    }
                    
                    if($values['order_status']==7)
                    {
                        $cancelledList[]=[
                        
                            'buyer_id'=>$user_id,
                            
                            'seller_details'=>$sellerList,  
                        
                            'order_id'=>$values['id'],
                            
                            'order_date'=>$values['created_at'],
                            
                            //'request_id'=>$request_list->id,
                            
                            'title'=>'',
                            
                            'category_id'=>$request_list->category,
                            
                            'category_name'=>$category,
                            
                            'category_icon'=> $this->getImage($category_icon,'category_image'),
                    
                            'sub_category_id'=>$request_list->subcategory,
                        
                            'sub_category_name'=>$subcategory_name,
                        
                            'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                            
                            'image_list'=>$image_list,
                            
                            'price'=>$values['price'],
                            
                            'quantity'=>$values['quantity'],
                            
                            'deliverytime'=>$request_list->deliverytime,
                            
                            'description'=>$request_list->description,

                            'requirement'=>$values['description'],
                            
                            'shipping_price'=>$values['shipping_cost'],
                            
                            'total_cost'=>$values['final_cost'],

                            'time_extension'=>$values['time_extension'],

                            'time_description'=>$values['time_description'],

                            'time_status'=>$values['time_status']
                        ];
                    }   

                }
            }
            
            $data['status']="1";
            $data['message']="Success";
            
            $active    = count($activeList);
            $delivered = count($deliveredList);
            $cancelled = count($cancelledList);
            
            $data['active_count']    = "$active";
            $data['delivered_count'] = "$delivered";
            $data['cancelled_count'] = "$cancelled";
            
            $data['active_order_list']=$activeList;
            $data['delivered_order_list']=$deliveredList;
            $data['cancelled_order_list']=$cancelledList;
        }

        header( 'Content-type:application/json');
        print json_encode( $data);
        exit; 
    }
    
    //=========================== My Sales ====================================//
    
    function mySales()
    {
        $user_id    = $this->input->post('user_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
            $data['status']="0";
            
            $data['message']="User not Found";
        }
        else
        { 
            $orderrequestList   = array();
            $currentList        = array();
            $completedList      = array();
            $cancelledList      = array();
            $buyerList          = array();
            
            $this->checkAccountStatus($user_id);


            $start  = date('Y-m-d 00:00:00',strtotime('first day of this month'));
            $end    = date('Y-m-d 23:59:59',strtotime('last day of this month'));

            $month = array(
                'start'         => $start,
                'end'           => $end,                
            );
           
            $Revenue=$this->Api_model->getRevenue($user_id,$month);
            
            $Amount = $Revenue->amount ? $Revenue->amount : '0.00';

            $TotalRevenue=$this->Api_model->getTotalRevenue($user_id);
            
            $TotalAmount = $TotalRevenue->amount ? $TotalRevenue->amount : '0.00';
           
            $order_list=$this->Api_model->OrderList(array('seller_id'=>$user_id))->result_array();
            
            foreach ($order_list as $key => $values)
            {
                if($values['type']=='1')
                {
                    $gigid    = $values['product_id'];
                    $gig_list = $this->Api_model->GigList(array('id'=>$gigid))->row();
                    $buyer_id  = $values['buyer_id'];
                    
                    $userData = $this->Api_model->get_where_row("app_user",array('id' => $buyer_id));

                    $completed=$this->Api_model->getCompleted($buyer_id);            
                    $orders_completed = $completed->id ? $completed->id : '0';

                    $Rating = ceil($this->Api_model->rating(array('buyer_id'=>$buyer_id,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);
                    $rating = !empty($Rating) ? $Rating : '0';
                    
                    $buyerList=[ 
                    
                        'buyer_id'            => $userData->id,
                        'first_name'          => trim($userData->first_name),
                        'last_name'           => trim($userData->last_name),
                        'email'               => $userData->email,
                        'profile'             => $userData->profile_picture,
                        'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                        'mobile_country'      => $userData->mobile_country,
                        'phone_no'            => $userData->phone_no,
                        'is_email_verified'   => $userData->is_email_verified,
                        'is_mobile_verified'  => $userData->is_mobile_verified,
                        'address'             => $userData->address,
                        'about'               => $userData->about,
                        'skills'              => $userData->skills,
                        'language'            => $userData->language,
                        'rating'              => "$rating",
                        'live_status'         => $userData->live_status,
                        'last_visited'        => $userData->updated_at,
                        'join_date'           => $userData->created_at,
                        'orders_completed'    => $orders_completed
    
                    ];
                    
                    if(!empty($gig_list->category_id))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $gig_list->category_id));
                        
                        $category   = $Details->category_name;
                        
                        $category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $category = '';
                        
                        $category_icon = '';
                    }
                    
                    if(!empty($gig_list->sub_category_id))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $gig_list->sub_category_id));
                        
                        $subcategory_name = $Details->category_name;
                        
                        $sub_category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $subcategory_name = '';
                        
                        $sub_category_icon = '';
                    }
                    
                    $image_list=array();
                    
                    $array = json_decode($gig_list->image);
                
                    $imageList = $array->image_list;
                    
                    $image_list=array();
                    
                    foreach ($imageList as $key => $value2) 
                    {
                        $image_list[]=[
                        
                            'image'     =>  $value2->type,
                            
                            'image_url' => $this->getImage($value2->thumnail,'gig_image'),
                        ];
                    }
                    
                   
                    if($values['order_status']==3)
                    {
                        $currentList[]=[
                        
                            'seller_id'=>$user_id,
                            
                            'buyer_details'=>$buyerList,
                            
                            'order_id'=>$values['id'],
                            
                            'order_date'=>$values['created_at'],
                            
                            //'gig_id'=>$gig_list->id,
                            
                            'title'=>$gig_list->title,
                            
                            'category_id'=>$gig_list->category_id,
                            
                            'category_name'=>$category,
                            
                            'category_icon'=> $this->getImage($category_icon,'category_image'),
                    
                            'sub_category_id'=>$gig_list->sub_category_id,
                        
                            'sub_category_name'=>$subcategory_name,
                        
                            'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                            
                            'image_list'=>$image_list,
                            
                            'price'=>$values['price'],
                            
                            'quantity'=>$values['quantity'],
                            
                            'deliverytime'=>$gig_list->delivery_time,
                            
                            'description'=>$gig_list->description,

                            'requirement'=>$values['description'],
                            
                            'shipping_price'=>$values['shipping_cost'],
                            
                           'total_cost'=>$values['final_cost'],

                            'time_extension'=>$values['time_extension'],

                            'time_description'=>$values['time_description'],

                            'time_status'=>$values['time_status']
                        ];
                    }
                    if($values['order_status']==4)
                    {
                        $completedList[]=[
                        
                            'seller_id'=>$user_id,
                            
                            'buyer_details'=>$buyerList,       
                        
                            'order_id'=>$values['id'],
                            
                            'order_date'=>$values['created_at'],
                            
                            //'gig_id'=>$gig_list->id,
                            
                            'title'=>$gig_list->title,
                            
                            'category_id'=>$gig_list->category_id,
                            
                            'category_name'=>$category,
                            
                            'category_icon'=> $this->getImage($category_icon,'category_image'),
                    
                            'sub_category_id'=>$gig_list->sub_category_id,
                        
                            'sub_category_name'=>$subcategory_name,
                        
                            'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                            
                            'image_list'=>$image_list,
                            
                            'price'=>$values['price'],
                            
                            'quantity'=>$values['quantity'],
                            
                            'deliverytime'=>$gig_list->delivery_time,
                            
                            'description'=>$gig_list->description,

                            'requirement'=>$values['description'],
                            
                            'shipping_price'=>$values['shipping_cost'],
                            
                            'total_cost'=>$values['final_cost'],

                            'time_extension'=>$values['time_extension'],

                            'time_description'=>$values['time_description'],

                            'time_status'=>$values['time_status']
                        ];
                    }
                    
                    if($values['order_status']==7)
                    {
                        $cancelledList[]=[
                        
                            'seller_id'=>$user_id,
                            
                            'buyer_details'=>$buyerList,       
                        
                            'order_id'=>$values['id'],
                            
                            'order_date'=>$values['created_at'],
                            
                            //'gig_id'=>$gig_list->id,
                            
                            'title'=>$gig_list->title,
                            
                            'category_id'=>$gig_list->category_id,
                            
                            'category_name'=>$category,
                            
                            'category_icon'=> $this->getImage($category_icon,'category_image'),
                    
                            'sub_category_id'=>$gig_list->sub_category_id,
                        
                            'sub_category_name'=>$subcategory_name,
                        
                            'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                            
                            'image_list'=>$image_list,
                            
                            'price'=>$values['price'],
                            
                            'quantity'=>$values['quantity'],
                            
                            'deliverytime'=>$gig_list->delivery_time,
                            
                            'description'=>$gig_list->description,

                            'requirement'=>$values['description'],
                            
                            'shipping_price'=>$values['shipping_cost'],
                            
                            'total_cost'=>$values['final_cost'],

                            'time_extension'=>$values['time_extension'],

                            'time_description'=>$values['time_description'],

                            'time_status'=>$values['time_status']
                        ];
                    }  
                }
                
                if($values['type']=='2')
                {
                    $requestid = $values['product_id'];
                    
                    $request_list=$this->Api_model->RequestList(array('id'=>$requestid))->row();
                    
                    $buyer_id  = $values['buyer_id'];
                    
                    $userData = $this->Api_model->get_where_row("app_user",array('id' => $buyer_id));

                    $buyerRating = ceil($this->Api_model->rating(array('buyer_id'=>$buyer_id,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);
                    $rating = !empty($buyerRating) ? $buyerRating : '0';
                    
                    $buyerList=[ 
                    
                        'buyer_id'            => $userData->id,
                        'first_name'          => trim($userData->first_name),
                        'last_name'           => trim($userData->last_name),
                        'email'               => $userData->email,
                        'profile'             => $userData->profile_picture,
                        'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                        'mobile_country'      => $userData->mobile_country,
                        'phone_no'            => $userData->phone_no,
                        'is_email_verified'   => $userData->is_email_verified,
                        'is_mobile_verified'  => $userData->is_mobile_verified,
                        'address'             => $userData->address,
                        'about'               => $userData->about,
                        'skills'              => $userData->skills,
                        'language'            => $userData->language,
                        'rating'              => "$rating",
                        'live_status'         => $userData->live_status,
                        'last_visited'        => $userData->updated_at,
                        'join_date'           => $userData->created_at,
                        'orders_completed'    => '0'
    
                    ];
                    
                    if(!empty($request_list->category))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $request_list->category));
                        
                        $category   = $Details->category_name;
                        
                        $category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $category = '';
                        
                        $category_icon = '';
                    }
                    
                    if(!empty($request_list->subcategory))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $request_list->subcategory));
                        
                        $subcategory_name = $Details->category_name;
                        
                        $sub_category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $subcategory_name = '';
                        
                        $sub_category_icon = '';
                    }
                    
                    $imageList = explode(",",$request_list->image);
                    
                    $image_list=array();
                    
                    foreach ($imageList as $key => $value1) 
                    {
                        $image_list[]=[
                        
                            'image'     => $value1,
                            
                            'image_url' => $this->getImage($value1,'request_image')
                        ];
                    }
                    
                    if($values['order_status']==1)
                    {
                        $orderrequestList[]=[
                        
                            'seller_id'=>$request_list->seller_id,
                            
                            'buyer_details'=>$buyerList,     
                            
                            'order_id'=>$values['id'],
                            
                            'order_date'=>$values['created_at'],
                            
                            'request_id'=>$request_list->id,
                            
                            'title'=>'',
                            
                            'category_id'=>$request_list->category,
                            
                            'category_name'=>$category,
                            
                            'category_icon'=> $this->getImage($category_icon,'category_image'),
                    
                            'sub_category_id'=>$request_list->subcategory,
                        
                            'sub_category_name'=>$subcategory_name,
                        
                            'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                            
                            'image_list'=>$image_list,
                            
                            'price'=>$values['price'],
                            
                            'quantity'=>$values['quantity'],
                            
                            'deliverytime'=>$request_list->deliverytime,
                            
                            'description'=>$request_list->description,

                            'requirement'=>$values['description'],
                            
                            'shipping_price'=>$values['shipping_cost'],
                            
                            'total_cost'=>$values['final_cost'],

                            'time_extension'=>$values['time_extension'],

                            'time_description'=>$values['time_description'],

                            'time_status'=>$values['time_status']
  
                        ];
                    }
                    if($values['order_status']==3)
                    {
                        $currentList[]=[
                        
                            'seller_id'=>$request_list->seller_id,
                            
                            'buyer_details'=>$buyerList,       
                        
                            'order_id'=>$values['id'],
                            
                            'order_date'=>$values['created_at'],
                            
                            //'request_id'=>$request_list->id,
                            
                            'title'=>'',
                            
                            'category_id'=>$request_list->category,
                            
                            'category_name'=>$category,
                            
                            'category_icon'=> $this->getImage($category_icon,'category_image'),
                    
                            'sub_category_id'=>$request_list->subcategory,
                        
                            'sub_category_name'=>$subcategory_name,
                        
                            'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                            
                            'image_list'=>$image_list,
                            
                            'price'=>$values['price'],
                            
                            'quantity'=>$values['quantity'],
                            
                            'deliverytime'=>$request_list->deliverytime,
                            
                            'description'=>$request_list->description,

                            'requirement'=>$values['description'],
                            
                            'shipping_price'=>$values['shipping_cost'],
                            
                            'total_cost'=>$values['final_cost'],

                            'time_extension'=>$values['time_extension'],

                            'time_description'=>$values['time_description'],

                            'time_status'=>$values['time_status']
                        ];
                    }
                    if($values['order_status']==4)
                    {
                        $completedList[]=[
                        
                            'seller_id'=>$request_list->seller_id,
                            
                            'buyer_details'=>$buyerList,       
                        
                            'order_id'=>$values['id'],
                            
                            'order_date'=>$values['created_at'],
                            
                            //'request_id'=>$request_list->id,
                            
                            'title'=>'',
                            
                            'category_id'=>$request_list->category,
                            
                            'category_name'=>$category,
                            
                            'category_icon'=> $this->getImage($category_icon,'category_image'),
                    
                            'sub_category_id'=>$request_list->subcategory,
                        
                            'sub_category_name'=>$subcategory_name,
                        
                            'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                            
                            'image_list'=>$image_list,
                            
                            'price'=>$values['price'],
                            
                            'quantity'=>$values['quantity'],
                            
                            'deliverytime'=>$request_list->deliverytime,
                            
                            'description'=>$request_list->description,

                            'requirement'=>$values['description'],
                            
                            'shipping_price'=>$values['shipping_cost'],
                            
                            'total_cost'=>$values['final_cost'],

                            'time_extension'=>$values['time_extension'],

                            'time_description'=>$values['time_description'],

                            'time_status'=>$values['time_status']
                        ];
                    }
                    
                    if($values['order_status']==7)
                    {
                        $cancelledList[]=[
                        
                            'seller_id'=>$request_list->seller_id,
                            
                            'buyer_details'=>$buyerList,       
                        
                            'order_id'=>$values['id'],
                            
                            'order_date'=>$values['created_at'],
                            
                            //'request_id'=>$request_list->id,
                            
                            'title'=>'',
                            
                            'category_id'=>$request_list->category,
                            
                            'category_name'=>$category,
                            
                            'category_icon'=> $this->getImage($category_icon,'category_image'),
                    
                            'sub_category_id'=>$request_list->subcategory,
                        
                            'sub_category_name'=>$subcategory_name,
                        
                            'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                            
                            'image_list'=>$image_list,
                            
                            'price'=>$values['price'],
                            
                            'quantity'=>$values['quantity'],
                            
                            'deliverytime'=>$request_list->deliverytime,
                            
                            'description'=>$request_list->description,

                            'requirement'=>$values['description'],
                            
                            'shipping_price'=>$values['shipping_cost'],
                            
                            'total_cost'=>$values['final_cost'],

                            'time_extension'=>$values['time_extension'],

                            'time_description'=>$values['time_description'],

                            'time_status'=>$values['time_status']
                        ];
                    }   

                }
            }            

            $data['status']="1";
            $data['message']="Success";
            
            $data['total_balance']      = "$TotalAmount";
            $data['total_eaarning']     = "$TotalAmount";
            $data['revenue_of_month']   = "$Amount";
            
            $data['order_request_list']     = $orderrequestList;
            $data['current_order_list']     = $currentList;
            $data['completed_order_list']   = $completedList;
            $data['cancelled_order_list']   = $cancelledList;
        }

        header( 'Content-type:application/json');
        print json_encode( $data);
        exit; 
    }
    
    //=========================== Analytics ====================================//
    
    function Analytics()
    {
        $user_id    = $this->input->post('user_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
         $reportDetails=array();
        
        if(empty($check_user))
        {
            $data['status']="0";            
            $data['message']="User not Found";
        }
        else
        {

            $start  = date('Y-m-d 00:00:00',strtotime('first day of this month'));
            $end    = date('Y-m-d 23:59:59',strtotime('last day of this month'));

            $month = array(
                'start'         => $start,
                'end'           => $end,                
            );
           
            $Revenue = $this->Api_model->getRevenue($user_id,$month);            
            $Amount  = $Revenue->amount ? $Revenue->amount : '0.00';

            $TotalRevenue = $this->Api_model->getTotalRevenue($user_id);            
            $TotalAmount  = $TotalRevenue->amount ? $TotalRevenue->amount : '0.00';

            $Created=$this->Api_model->getAnalytics($user_id,array('order_status' => '3'));            
            $orders_created = $Created->id ? $Created->id : '0';

            $Completed=$this->Api_model->getAnalytics($user_id,array('order_status' => '4'));            
            $orders_completed = $Completed->id ? $Completed->id : '0';

            $Delivered=$this->Api_model->getAnalytics($user_id,array('order_status' => '4'));            
            $orders_delivered = $Delivered->id ? $Delivered->id : '0';

            $Cancelled=$this->Api_model->getAnalytics($user_id,array('order_status' => '7'));            
            $orders_cancelled = $Cancelled->id ? $Cancelled->id : '0';

            $sellerRating       = ceil($this->Api_model->rating(array('seller_id'=>$user_id,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);
            $buyer_rating       = !empty($sellerRating) ? $sellerRating : '0';

            $buyerRating        = ceil($this->Api_model->rating(array('buyer_id'=>$user_id,'seller_rating!='=>'0'),'avg(seller_rating) as rating')->row()->rating);
            $seller_rating      = !empty($buyerRating) ? $buyerRating : '0';
            
            $Rating             = $buyer_rating + $seller_rating;

            $Positive=$this->Api_model->getPositiveReviews($user_id);            
            $positive_rating = $Positive->rating ? $Positive->rating : '0';

            $Negative=$this->Api_model->getNagativeReviews($user_id);            
            $negative_rating = $Negative->rating ? $Negative->rating : '0';

            $reportDetails =[
                'user_id'           => $user_id,
                'month_earned'      => $Amount,
                'created_orders'    => $orders_created, 
                'avg_selling_price' => $TotalAmount, 
                'positive_rating'   => "$positive_rating",
                'new_orders'        => $orders_created,
                'multiple_orders'   => '0',
                'extra_orders'      => '0',
                'delivered_orders'  => $orders_delivered,
                'positive_reviews'  => "$positive_rating",        
                'negative_reviews'  => "$negative_rating",
                'rated'             => "$Rating",
                'completed_orders'  => $orders_completed,
                'cancelled_orders'  => $orders_cancelled
            ];
        }
        
        $data['status']="1";
        $data['message']="Success";
        $data['analytics_Report']=$reportDetails;
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== Buyer Offer Accepted Rejected ===============================//

    function buyerOfferStatus()
    {
        $user_id=$this->input->post('user_id');

        $request_id=$this->input->post('request_id');

        $seller_id=$this->input->post('seller_id');
    
        $offer_id=$this->input->post('offer_id');
    
        $payment_option=$this->input->post('payment_option');
        
        $payment_id=$this->input->post('payment_id');
    
        $offer_status=$this->input->post('offer_status');
    
        
        $this->formValidation("User Id",$user_id,"required");

        $this->formValidation("Request Id",$request_id,"required");
    
        $this->formValidation("Seller Id",$seller_id,"required");
    
        $this->formValidation("Offer Id",$offer_id,"required");
        
        if($offer_status==1)
        {
            $this->formValidation("Payment Option",$payment_option,"required");
            
            $this->formValidation("Payment Id",$payment_id,"required");
        }
            
        $this->formValidation("Offer Status",$offer_status,"required");

        $check_now=$this->Api_model->RequestList(array('id'=>$request_id,'user_id'=>$user_id))->row();
    
        if(empty($check_now))
        {    
            $data['status']="0";
    
            $data['message']="Request not Found";    
        }
        else
        { 
            if($offer_status==1)
            {
                $OfferList = $this->Api_model->OfferList(array('id'=>$offer_id,'user_id'=>$seller_id))->row();
                
                $Price     = $OfferList->price;
                
                $Quantity  = $check_now->quantity;
                
                $Data=array(   
       
                      //'seller_id'=>$seller_id,
                      
                      //'offer_id'=>$offer_id,
                      
                      //'payment_option'=>$payment_option,
                      
                      //'payment_id'=>$payment_id,
        
                      'offer_status'=>'1',
        
                      'updated_at'=>date('Y-m-d H:i:s')
        
                  );
        
                  if($this->Api_model->Offersend(array('id'=>$request_id,'user_id'=>$user_id),$Data))
                  {
                       $RequestData=array(

                            'seller_id'=>$seller_id,
                            
                            'request_status'=>'1',
                            
                            'updated_at'=>date('Y-m-d H:i:s')
                        );
                        
                       $this->Api_model->AddRequest(array('id'=>$request_id),$RequestData);
                       
                       $OrdersData=array(

                            'seller_id'=>$seller_id,
                            
                            'buyer_id'=>$user_id,
                            
                            'type'=>'2',
                            
                            'product_id'=>$request_id,
                            
                            'price'=>$Price,
                            
                            'quantity'=>$Quantity,
                            
                            'total_cost'=>$Price,
                            
                            'final_cost'=>$Price,
                            
                            'order_status'=>'1',
                            
                            'payment_option'=>$payment_option,
                            
                            'payment_id'=>$payment_id,
                            
                            'created_at'=>date('Y-m-d H:i:s')
                        );
                        
                       $this->Api_model->Orders('',$OrdersData);
                        
                      $data['status']="1";
                      
                      $data['message']="Offer Accepted Successfully";

                      //$this->prepreFcm('offeracceptedbuyer',array('user_id'=>$user_id));
                      $this->prepreFcm('offeracceptedseller',array('user_id'=>$seller_id));
                  }
                  else
                  {
                      $data['status']="0";
        
                      $data['message']="Something went wrong";
                  }
            }
            
            if($offer_status==2)
            {
                $Data=array(   
       
                      //'seller_id'=>$seller_id,
                      
                      //'offer_id'=>$offer_id,
                      
                      //'payment_option'=>$payment_option,
        
                      'offer_status'=>'2',
        
                      'updated_at'=>date('Y-m-d H:i:s')
        
                  );
        
                  if($request_id=$this->Api_model->Offersend(array('id'=>$offer_id,'request_id'=>$request_id),$Data))
                  {
                      
                      $data['status']="1";
                      
                      $data['message']="Offer Rejected Successfully";

                      //$this->prepreFcm('offerrejectedbuyer',array('user_id'=>$user_id));
                      $this->prepreFcm('offerrejectedseller',array('user_id'=>$seller_id));
                  }
                  else
                  {
                      $data['status']="0";
        
                      $data['message']="Something went wrong";
                  }
            }
            
        }
    
        header( 'Content-type:application/json');
        print json_encode( $data);    
        exit; 
    }
    
    //=========================== Search Seller List ===================================//
    
    function searchSeller()
    {
        $user_id     = $this->input->post('user_id');        
        $user_search = $this->input->post('user_search');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user= (array) $this->getUserDetails(array("id"=>$user_id));
        
        if(empty($check_user))
        {
            $data['status']="0";            
            $data['message']="User Not Found";
        } 
        else
        {
            $this->checkAccountStatus($user_id);
            
            $gig_list=$this->Api_model->GigSearchListv(array('gig_list.user_id!='=>$user_id,'gig_list.status'=>'2'),$user_search)->result_array();
            
            $sellerList=array();
            
            foreach ($gig_list as $key => $value)
            { 
                $SellerFav=$this->Api_model->getGigList1(array('favouritelist.user_id='=>$user_id,'favouritelist.favourite_type='=>'1','favouritelist.favourite_id'=>$value['user_id']))->row();

                $Fav = $SellerFav ? '1' : '0';

                $seller_id = $value['user_id'];

                $userData = $this->Api_model->get_where_row("app_user",array('id' => $seller_id,'id!=' => $user_id));

                if(!empty($userData)) {

                    $completed=$this->Api_model->getCompleted($seller_id);            
                    $orders_completed = $completed->id ? $completed->id : '0';

                    $sellerRating = round($this->Api_model->rating(array('seller_id'=>$seller_id,'seller_rating!='=>'0'),'avg(seller_rating) as rating')->row()->rating);
                    $rating = !empty($sellerRating) ? $sellerRating : '0';                        
                       
                    $sellerList[]=[ 
                        'seller_id'           => $seller_id,
                        'first_name'          => trim($userData->first_name),
                        'last_name'           => trim($userData->last_name),
                        'email'               => $userData->email,
                        'profile'             => $userData->profile_picture,
                        'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                        'mobile_country'      => $userData->mobile_country,
                        'phone_no'            => $userData->phone_no,
                        'is_email_verified'   => $userData->is_email_verified,
                        'is_mobile_verified'  => $userData->is_mobile_verified,
                        'address'             => $userData->address,
                        'about'               => $userData->about,
                        'skills'              => $userData->skills,
                        'language'            => $userData->language,
                        'rating'              => "$rating",
                        'live_status'         => $userData->live_status,
                        'last_visited'        => $userData->updated_at,
                        'is_favourite'        => $Fav,
                        'join_date'           => $userData->created_at,
                        'orders_completed'    => $orders_completed
                    ];
                }
            }
        
            $data['status']="1";            
            $data['message']="Success";            
            $data['seller_list']=$sellerList;
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== Search Gig List ===================================//

    function searchGig()
    {
        $user_id    = $this->input->post('user_id');
        $gig_search = $this->input->post('gig_search'); 
        
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user= (array) $this->getUserDetails(array("id"=>$user_id));
        
        if(empty($check_user))
        {
            $data['status']="0";
            $data['message']="User Not Found"; 
        } 
        else
        {
            $this->checkAccountStatus($user_id);
            
            $favouriteList=array();

            $gig_list=$this->Api_model->searchGig("(user_id !=".$user_id." and status='2')",$gig_search)->result_array();
            
            $sellerList=array();
            $searchList=array();
                    
            foreach ($gig_list as $key => $value1) 
            {
                $gigFav=$this->Api_model->getGigList1(array('favouritelist.user_id='=>$user_id,'favouritelist.favourite_type='=>'2','favouritelist.favourite_id'=>$value1['id']))->row();
                
                $Fav = $gigFav ? '1' : '0';
                
                $seller_id = $value1['user_id'];
                $userData = $this->Api_model->get_where_row("app_user",array('id' => $seller_id));
                
                $sellerRating = round($this->Api_model->rating(array('seller_id'=>$value1['user_id']),'avg(seller_rating) as rating')->row()->rating);
                
                $rating    = !empty($sellerRating) ? $sellerRating : '0';
                                
                $completed=$this->Api_model->getCompleted($seller_id);          
                $orders_completed = $completed->id ? $completed->id : '0';
                
                $sellerList=[ 
                    'seller_id'           => $seller_id,
                    'first_name'          => trim($userData->first_name),
                    'last_name'           => trim($userData->last_name),
                    'email'               => $userData->email,
                    'profile'             => $userData->profile_picture,
                    'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                    'mobile_country'      => $userData->mobile_country,
                    'phone_no'            => $userData->phone_no,
                    'is_email_verified'   => $userData->is_email_verified,
                    'is_mobile_verified'  => $userData->is_mobile_verified,
                    'address'             => $userData->address,
                    'about'               => $userData->about,
                    'skills'              => $userData->skills,
                    'language'            => $userData->language,
                    'rating'              => "$rating",
                    'live_status'         => $userData->live_status,
                    'last_visited'        => $userData->updated_at,
                    'join_date'           => $userData->created_at,
                    'orders_completed'    => $orders_completed
                
                ];
                
                $gigReview = $this->Api_model->RatingList(array('gigs_id'=>$value1['id'],'order_review!='=>''))->result_array();
                
                $gigreviewCount = count($gigReview);
                
                $gigRatings =  $this->Api_model->rating(array('gigs_id'=>$value1['id'],'order_rating!='=>''),'avg(order_rating) as rating')->row()->rating;
                
                $gigRating  = round($gigRatings);
                $gig_rating = !empty($gigRating) ? $gigRating : '0';

                if(!empty($value1['category_id']))
                {
                    $Details    = $this->Api_model->get_where_row("category",array('id' => $value1['category_id']));
                    
                    $category   = $Details->category_name;
                    $category_icon = $Details->category_icon;
                }
                else
                {
                    $category = '';
                    $category_icon = '';
                }
                
                if(!empty($value1['sub_category_id']))
                {
                    $Details    = $this->Api_model->get_where_row("category",array('id' => $value1['sub_category_id']));
                    
                    $subcategory_name = $Details->category_name;
                    
                    $sub_category_icon = $Details->category_icon;
                }
                else
                {
                    $subcategory_name = '';
                    
                    $sub_category_icon = '';
                }
                
                $array = json_decode($value1['image']);
                
                $image_list=array();
                
                if($array)
                {
                    $imageList = $array->image_list;
                    
                    foreach ($imageList as $key => $value2) 
                    {
                        $image_list[]=[
                        
                            'file' => $this->getImage($value2->file,'gig_image'),
                            
                            'thumnail' => $this->getImage($value2->thumnail,'gig_image'),
                            
                            'type'     => $value2->type,
                        ];
                    }
                }
                
                $searchList[]=[          
                    
                    'seller_details' => $sellerList,
                   
                    'gig_id'=>$value1['id'],
                    
                    'title'=>$value1['title'],
                    
                    'category_id'=>$value1['category_id'],
                    
                    'category_name'=>$category,
                    
                    'category_icon'=> $this->getImage($category_icon,'category_image'),
                    
                    'sub_category_id'=>$value1['sub_category_id'],
                    
                    'sub_category_name'=>$subcategory_name,
                    
                    'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                    
                    'image_list'=>$image_list,
                    
                    'price'=>$value1['price'],
                    
                    'delivery_time'=>$value1['delivery_time'],
                    
                    'shipping'=>$value1['shipping'],
                    
                    'shipping_price'=>$value1['shipping_price'],
                        
                    'total_cost'=>$value1['total_cost'],
                    
                    'revisions'=>$value1['revisions'],
                    
                    'gig_tag'=>$value1['gig_tag'],
                    
                    'description'=>$value1['description'],
                    
                    'gig_status'=>$value1['status'],
                    
                    'review_count'=>"$gigreviewCount",
                    
                    'gig_rating'=>"$gig_rating",
                    
                    'is_favourite'=>$Fav                    
                ];
            
            }
           
            $data['status']="1";
            $data['message']="Success";
            $data['searchgig_list']=$searchList;
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== Seller Requestr Accepted Rejected ===============================//

    function sellerRequest()
    {
        $user_id=$this->input->post('user_id');
        $request_id=$this->input->post('request_id');
        $request_status=$this->input->post('request_status');
        
        $this->formValidation("User Id",$user_id,"required");
        $this->formValidation("Request Id",$request_id,"required");
        $this->formValidation("Request Status",$request_status,"required");

        $check_now=$this->Api_model->OrderList(array('type'=>'2','product_id'=>$request_id,'seller_id'=>$user_id))->row();
    
        if(empty($check_now))
        {    
            $data['status']="0";    
            $data['message']="Request not Found";    
        }
        else
        { 
            $buyer_id = $check_now->buyer_id;
            
            if($request_status==1)
            {
                $Data=array(   
                
                    'order_status'=>'3',                
                    'updated_at'=>date('Y-m-d H:i:s')                
                );
                
                if($this->Api_model->Orders(array('type'=>'2','product_id'=>$request_id,'seller_id'=>$user_id),$Data))
                {
                    $data['status']="1";                
                    $data['message']="Accepted Successfully";
                    
                    $this->prepreFcm('accepted',array('user_id'=>$buyer_id));
                }
                else
                {
                    $data['status']="0";                
                    $data['message']="Something went wrong";
                }
            }
            
            if($request_status==2)
            {
                $Data=array(   
                
                    'order_status'=>'2',                
                    'updated_at'=>date('Y-m-d H:i:s')
                
                );
                
                if($this->Api_model->Orders(array('type'=>'2','product_id'=>$request_id,'seller_id'=>$user_id),$Data))
                {
                
                    $data['status']="1";                
                    $data['message']="Rejected Successfully";
                    
                    $this->prepreFcm('rejected',array('user_id'=>$buyer_id));
                }
                else
                {
                    $data['status']="0";                
                    $data['message']="Something went wrong";
                }
            }            
        }
    
        header( 'Content-type:application/json');
        print json_encode( $data);    
        exit; 
    }
    
    //=========================== Buyer gig Feedback ========================================//
    
    function buyerorderFeedback()
    {
        $user_id    = $this->input->post('user_id');        
        $order_id   = $this->input->post('order_id');        
        $rating     = $this->input->post('order_rating');        
        $review     = $this->input->post('order_review');
        $gig_id     = $this->input->post('gig_id');
        
        $this->formValidation("User Id",$user_id,"required");        
        $this->formValidation("Order Id",$order_id,"required");        
        $this->formValidation("Rating",$rating,"required");        
        $this->formValidation("Review",$review,"missing");
        
        $Details=$this->Api_model->OrderList(array('id'=>$order_id,'buyer_id'=>$user_id))->row();
        $sellerId = $Details->seller_id;
        $orderStatus = $Details->order_status;

        if(empty($Details))
        {
            $data['status']="0";            
            $data['message']="Record Not Found";
        }
        else
        {
            $Details = $this->Api_model->RatingList(array('order_id'=>$order_id))->row();
            
            if(!empty($Details))
            {
                $Orderid = $Details->order_id;
                                
                $Data=array(
                
                    'buyer_id'		=> $user_id,                    
                    'order_id'		=> $order_id,                    
                    'order_rating'	=> $rating,
                    'gigs_id'		=> $gig_id,                    
                    'order_review'	=> $review,                      
                    'updated_at'	=> date('Y-m-d H:i:s')
                );
            
                if($this->Api_model->RatingAdd(array('order_id'=>$order_id),$Data))
                {
                    $data['status']="1";                    
                    $data['message']="Rating Updated";

                    $this->prepreFcm('orderreview',array('user_id'=>$sellerId,'order_id'=>$order_id,'status'=>$orderStatus));
                }
                else
                {
                    $data['status']="0";                    
                    $data['message']="Something went wrong";
                }
            }
            else
            {
                $Data=array(
            
                    'buyer_id'		=> $user_id,                    
                    'order_id'		=> $order_id,                    
                    'order_rating'	=> $rating,
                    'gigs_id'		=> $gig_id,                    
                    'order_review'	=> $review,                    
                    'created_at'	=> date('Y-m-d H:i:s')
                );
            
                if($this->Api_model->RatingAdd('',$Data))
                {
                    $data['status']="1";                    
                    $data['message']="Rating Updated";

                    $this->prepreFcm('orderreview',array('user_id'=>$sellerId));
                }
                else
                {
                    $data['status']="0";                    
                    $data['message']="Something went wrong";
                }
            }
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== Rating Add ========================================//
    
    function ratingadd()
    {
        $user_id     = $this->input->post('user_id');        
        $order_id    = $this->input->post('order_id');        
        $rating_type = $this->input->post('rating_type');        
        $rating      = $this->input->post('rating');        
        $review      = $this->input->post('review');
        $gig_id    	 = $this->input->post('gig_id');
        
        $this->formValidation("User Id",$user_id,"required");        
        $this->formValidation("Order Id",$order_id,"required");        
        $this->formValidation("Rating Type",$rating_type,"required");        
        $this->formValidation("Rating",$rating,"required");        
        $this->formValidation("Review",$review,"missing");

        if($rating_type==1)
        {
            $Details=$this->Api_model->OrderList(array('id'=>$order_id,'buyer_id'=>$user_id))->row();
        }
       if($rating_type==2)
        {
            $Details=$this->Api_model->OrderList(array('id'=>$order_id,'seller_id'=>$user_id))->row();
        }
        
        if(empty($Details))
        {
            $data['status']="0";            
            $data['message']="Record Not Found";
        }
        else
        {
            if($rating_type==1)
            {
                $Details=$this->Api_model->OrderList(array('id'=>$order_id,'buyer_id'=>$user_id))->row();
                $userid = $Details->seller_id;
            }
            if($rating_type==2)
            {
                $Details=$this->Api_model->OrderList(array('id'=>$order_id,'seller_id'=>$user_id))->row();
                $userid = $Details->buyer_id;
            }

            $orderStatus = $Details->order_status;
            
            $Details = $this->Api_model->RatingList(array('order_id'=>$order_id))->row();
            
            if(!empty($Details))
            {
                $Orderid = $Details->order_id;
   
                if($rating_type==1)
                {
                    $Data=array(
                
                        'buyer_id'=>$user_id,
                        'seller_id'=>$userid,                        
                        'seller_rating'=>$rating,                        
                        'seller_review'=>$review,
                        'gigs_id'=>$gig_id,                        
                        'updated_at'=>date('Y-m-d H:i:s')
                    );
            
                    if($this->Api_model->RatingAdd(array('order_id'=>$Orderid),$Data))
                    {
                        $data['status']="1";                        
                        $data['message']="Rating Updated";

                        $this->prepreFcm('buyerreview',array('user_id'=>$userid,'buyer_id'=>$user_id,'order_id'=>$Orderid,'status'=>$orderStatus));
                    }
                    else
                    {
                        $data['status']="0";                        
                        $data['message']="Something went wrong";
                    }
                }
                
                if($rating_type==2)
                {
                    $Data=array(
                
                        'seller_id'=>$user_id,
                        'buyer_id'=>$userid,                        
                        'buyer_rating'=>$rating,                        
                        'buyer_review'=>$review,
                        'gigs_id'=>$gig_id,                        
                        'updated_at'=>date('Y-m-d H:i:s')
                    );
            
                    if($this->Api_model->RatingAdd(array('order_id'=>$Orderid),$Data))
                    {
                        $data['status']="1";                        
                        $data['message']="Rating Updated";

                        $this->prepreFcm('sellerreview',array('user_id'=>$userid,'seller_id'=>$user_id,'order_id'=>$Orderid,'status'=>$orderStatus));
                    }
                    else
                    {
                        $data['status']="0";                        
                        $data['message']="Something went wrong";
                    }
                }
            }
            else
            { 
                if($rating_type==1)
                {
                    $Data=array(
                
                        'buyer_id'=>$user_id,
                        'seller_id'=>$userid,                        
                        'order_id'=>$order_id,                        
                        'seller_rating'=>$rating,                        
                        'seller_review'=>$review,
                        'gigs_id'=>$gig_id,                        
                        'created_at'=>date('Y-m-d H:i:s')
                    );
            
                    if($this->Api_model->RatingAdd('',$Data))
                    {
                        $data['status']="1";                        
                        $data['message']="Rating Updated";

                        $this->prepreFcm('buyerreview',array('user_id'=>$userid,'buyer_id'=>$user_id,'order_id'=>$order_id,'status'=>$orderStatus));
                    }
                    else
                    {
                        $data['status']="0";                        
                        $data['message']="Something went wrong";
                    }
                }
                
                if($rating_type==2)
                {
                    $Data=array(
                
						'seller_id'=>$user_id,                        
						'order_id'=>$order_id,
						'buyer_id'=>$userid,                        
						'buyer_rating'=>$rating,                        
						'buyer_review'=>$review,
						'gigs_id'=>$gig_id,                        
						'created_at'=>date('Y-m-d H:i:s')
                    );
            
                    if($this->Api_model->RatingAdd('',$Data))
                    {
                        $data['status']="1";                        
                        $data['message']="Rating Updated";

                        $this->prepreFcm('sellerreview',array('user_id'=>$userid,'seller_id'=>$user_id,'order_id'=>$order_id,'status'=>$orderStatus));
                    }
                    else
                    {
                        $data['status']="0";                        
                        $data['message']="Something went wrong";
                    }
                }
            }
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== seller Delivery ========================================//

    function sellerDelivery()
    {
        $user_id     = $this->input->post('user_id');
        $buyer_id    = $this->input->post('buyer_id');
        $order_id    = $this->input->post('order_id');
        $type        = $this->input->post('type');
        $thumb       = $this->input->post('thumb');
        $project     = $this->input->post('project');
        $description = $this->input->post('description');

        $this->formValidation("User Id", $user_id, "required");
        $this->formValidation("Buyer Id", $buyer_id, "required");
        $this->formValidation("Order Id", $order_id, "required");
        $this->formValidation("type", $type, "required");

        if($type==2)
        {
            $this->formValidation("Thumb", $thumb, "required");
        }

        $this->formValidation("Project", $project, "required");
        $this->formValidation("Description", $description, "missing");
        
        $Details=$this->Api_model->OrderList(array('id'=>$order_id,'buyer_id'=>$buyer_id,'seller_id'=>$user_id))->row();
        
        if(empty($Details))
        {
            $data['status']="0";
            
            $data['message']="Record Not Found";
        }
        else
        {

            $orderStatus = $Details->order_status;

            $Data=array(

                //'attachment'=>$project,                
                'order_status'=>'4',                
                //'project_description'=>$description,                
                'delivered_at'=>date('Y-m-d H:i:s')
            );

            $Delivery=array(

                'user_id'=>$user_id,

                'order_id'=>$order_id,                   
                        
                'buyer_id'=>$buyer_id,

                'type'=>$type,

                'thumb'=>$type=='2' ? $thumb: '',

                'project'=>$project,
                
                //'status'=>'4',
                
                'description'=>$description,
                
                'created_at'=>date('Y-m-d H:i:s')
            );

            $this->Api_model->insert('order_delivery',$Delivery);

            if($this->Api_model->Orders(array('id'=>$order_id,'buyer_id'=>$buyer_id,'seller_id'=>$user_id),$Data))
            {
                $data['status']="1";
                
                $data['message']="Order successfully delivered";

                $this->prepreFcm('deliveredrecived',array('order_id'=>$order_id,'user_id'=>$buyer_id,'status'=>$orderStatus));
            }
            else
            {
                $data['status']="0";
                
                $data['message']="Something went wrong";
            }
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== language List ========================================//
    
    function languageList()
    {
        $language_list=$this->Api_model->getUserDetails(array("account_status"=>'0',"language!="=>''))->result_array();
        
        $languageList=array();
        
        foreach ($language_list as $key => $value) 
        {
            $languageList[]=$value['language'];
        } 
        
        $array_unique = array_unique($languageList);
        $array_merge  = array_merge($array_unique); 
        
        $implodestr = implode(',',$array_merge);
        $explodestr = explode(",",$implodestr);
        
        $language_List=array();
        
        foreach ($explodestr as $key => $value1) 
        {
            $language_List[]=$value1;
        } 
        
        $arrayUnique = array_unique($language_List);
        
        $arrayMerge  = array_merge($arrayUnique); 
    
        
        $data['status']="1";
        
        $data['message']="Success";
        
        $data['language_list']=$arrayMerge;
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== tag List ========================================//
    
    function tagList()
    {
        $sub_category_id=$this->input->post('sub_category_id');
        
        $this->formValidation("User Id",$sub_category_id,"required");
        
        $tag_list=$this->Api_model->GigList(array("sub_category_id"=>$sub_category_id))->result_array();
        
        $tagList=array();
        
        foreach ($tag_list as $key => $value1) 
        {
            $tagList[]=$value1['gig_tag'];
        } 
        
        $array_unique = array_unique($tagList);
        $array_merge = array_merge($array_unique); 
        
        
        $implodestr = implode(',',$array_merge);
        $explodestr = explode(",",$implodestr);
        
        $tag_List=array();
        
        foreach ($explodestr as $key => $value1) 
        {
            $tag_List[]=$value1;
        } 
        
        $arrayUnique = array_unique($tag_List);
        
        $arrayMerge  = array_merge($arrayUnique); 
        
        $data['status']="1";
        
        $data['message']="Success";
        
        $data['tag_list']=$arrayMerge;
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=========================== Seller Order History ===============================//

    function SellerOrderHistory()
    {
        $order_id   = $this->input->post('order_id');
        $user_id    = $this->input->post('user_id');
        $buyer_id   = $this->input->post('buyer_id');
        $type       = $this->input->post('history_type');
        $message    = $this->input->post('message');
       
        $this->formValidation("Order Id",$order_id,"required");
        $this->formValidation("User Id",$user_id,"required");
        $this->formValidation("Type",$type,"required");
        $this->formValidation("Message",$message,"required");
    
        $check_user=(array) $this->getUserDetails("id='$user_id'");
    
        if(empty($check_user))
        {
            $data['status']="0";
    
            $data['message']="User not Found";
        }
        else
        { 
            $OrderList   = $this->Api_model->OrderList(array('id'=>$order_id))->row();
            $orderStatus = $OrderList->order_status;

            $this->checkAccountStatus($user_id);
            
            if($type=='4') 
            {
                $Data=array(
                    
                    'order_id'=>$order_id,
                    
                    'from_user_id'=>$user_id,
    
                    'history_type'=>$type,
                    
                    'details'=>$message,
                    
                    'status'=>'1',
                    
                    'created_at'=>date('Y-m-d H:i:s')
                );
                
                if($this->Api_model->AddHistory('',$Data))
                {
                    $data['status']="1";
                    
                    $data['message']="Added Successfully";
                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Something went wrong";
                }
            }
            else
            {
                $ReqData=array(
            
                    'from'=>$user_id,
                    
                    'to'=>$buyer_id,
                    
                    'message'=>$message,
                    
                    'is_date'=>date('Y-m-d H:i:s')
            
                );
                
                $content=json_encode($ReqData);
                
                $Data=array(
                    
                    'order_id'=>$order_id,
                    
                    'from_user_id'=>$user_id,
    
                    'history_type'=>$type,
                    
                    'details'=>$content,
                    
                    'created_at'=>date('Y-m-d H:i:s')
                );
                
                if($this->Api_model->AddHistory('',$Data))
                {
                    $data['status']="1";
                    
                    $data['message']="Added Successfully";

                    if($type=='1')
                    {
                        $this->prepreFcm('sellerrmsg',array('user_id'=>$buyer_id,'order_id'=>$order_id,'status'=>$orderStatus)); 
                    }
                    else if($type=='3')
                    {
                        $this->prepreFcm('sellerdispute',array('user_id'=>$buyer_id,'order_id'=>$order_id,'status'=>$orderStatus)); 
                    }                                     
                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Something went wrong";
                }
            }
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    //=========================== Buyer Order History ===============================//

    function BuyerOrderHistory()
    {
        $order_id   = $this->input->post('order_id');
        
        $user_id    = $this->input->post('user_id');
        
        $seller_id  = $this->input->post('seller_id');
        
        $type       = $this->input->post('history_type');
        
        $message    = $this->input->post('message');
       
        $this->formValidation("Order Id",$order_id,"required");
        
        $this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("Type",$type,"required");
    
        $this->formValidation("Message",$message,"required");
    
        $check_user=(array) $this->getUserDetails("id='$user_id'");
    
        if(empty($check_user))
        {
            $data['status']="0";
    
            $data['message']="User not Found";
        }
        else
        { 
            $this->checkAccountStatus($user_id);

            $OrderList   = $this->Api_model->OrderList(array('id'=>$order_id))->row();
            $orderStatus = $OrderList->order_status;
            
            if($type=='4')
            {
                $Data=array(
                    
                    'order_id'=>$order_id,
                    
                    'from_user_id'=>$user_id,
    
                    'history_type'=>$type,
                    
                    'details'=>$message,
                    
                    'status'=>'1',
                    
                    'created_at'=>date('Y-m-d H:i:s')
                );
                
                if($this->Api_model->AddHistory('',$Data))
                {
                    $data['status']="1";
                    
                    $data['message']="Added Successfully";
                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Something went wrong";
                }
            }
            else
            {
                $ReqData=array(
                
                    'from'=>$user_id,
                    
                    'to'=>$seller_id,
                    
                    'message'=>$message,
                    
                    'is_date'=>date('Y-m-d H:i:s')
                
                );
                
                $content=json_encode($ReqData);
                
                $Data=array(
                    
                    'order_id'=>$order_id,
                    
                    'from_user_id'=>$user_id,
    
                    'history_type'=>$type,
                    
                    'details'=>$content,
                    
                    'created_at'=>date('Y-m-d H:i:s')
                );                
                
                if($gig_id=$this->Api_model->AddHistory('',$Data))
                {
                    $data['status']="1";
                    
                    $data['message']="Added Successfully";

                    if($type=='1')
                    {
                        $this->prepreFcm('buyerrmsg',array('user_id'=>$seller_id,'order_id'=>$order_id,'status'=>$orderStatus)); 
                    }

                    if($type=='2')
                    {
                        $this->prepreFcm('orderrevision',array('user_id'=>$seller_id,'order_id'=>$order_id,'status'=>$orderStatus));
                    }
                    else if($type=='3')
                    {
                        $this->prepreFcm('buyerdispute',array('user_id'=>$seller_id,'order_id'=>$order_id,'status'=>$orderStatus)); 
                    } 

                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Something went wrong";
                }
            }
              
        }
    
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit; 
    }
    
    //=========================== Buyer Order History List ===================================//

    function BuyerOrderHistoryList()
    {
        $user_id = $this->input->post('user_id');
        
        $order_id = $this->input->post('order_id');
        
        //$this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("Order Id",$order_id,"required");
        
        //$check_user= (array) $this->getUserDetails(array("id"=>$user_id));
        
        $OrderList     = $this->Api_model->OrderList(array('id'=>$order_id))->row();
        
        if(empty($OrderList))
        {
            $data['status']="0";
            
            $data['message']="Record Not Found";
        } 
        else
        {

            if($OrderList->type=='1') {

                $gigid    = $OrderList->product_id;
                $gig_list = $this->Api_model->GigList(array('id'=>$gigid))->row();

                if(!empty($gig_list->category_id))
                {
                    $Details = $this->Api_model->get_where_row("category",array('id' => $gig_list->category_id));

                    $category       = $Details->category_name;
                    $category_icon  = $Details->category_icon;
                }
                else
                {
                    $category       = '';                        
                    $category_icon  = '';
                }
                
                if(!empty($gig_list->sub_category_id))
                {
                    $Details    = $this->Api_model->get_where_row("category",array('id' => $gig_list->sub_category_id));
                    
                    $subcategory_name   = $Details->category_name;
                    $sub_category_icon  = $Details->category_icon;
                }
                else
                {
                    $subcategory_name   = '';                        
                    $sub_category_icon  = '';
                }
                
                $image_list=array();
                
                $array = json_decode($gig_list->image);
            
                $imageList = $array->image_list;
                
                $image_list=array();
                
                foreach ($imageList as $key => $value2) 
                {
                    $image_list[]=[
                    
                        'image'     =>  $value2->type,
                        
                        'image_url' => $this->getImage($value2->thumnail,'gig_image'),
                    ];
                }

                $orderDetails=[
                                           
                    'order_id'=>$OrderList->id,
                    
                    'order_date'=>$OrderList->created_at,
                    
                    'gig_id'=>$gig_list->id,
                    
                    'title'=>$gig_list->title,
                    
                    'category_id'=>$gig_list->category_id,
                    
                    'category_name'=>$category,
                    
                    'category_icon'=> $this->getImage($category_icon,'category_image'),
            
                    'sub_category_id'=>$gig_list->sub_category_id,
                
                    'sub_category_name'=>$subcategory_name,
                
                    'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                    
                    'image_list'=>$image_list,
                    
                    'price'=>$OrderList->price,
                    
                    'quantity'=>$OrderList->quantity,
                    
                    'deliverytime'=>$gig_list->delivery_time,
                    
                    'description'=>$gig_list->description,

                    'requirement'=>$OrderList->description,
                    
                    'shipping_price'=>$OrderList->shipping_cost,
                    
                    'total_cost'=>$OrderList->final_cost,

                    'time_extension'=>$OrderList->time_extension,

                    'time_description'=>$OrderList->time_description,

                    'time_status'=>$OrderList->time_status
                ];




            }

            if($OrderList->type=='2') {

                $requestid    = $OrderList->product_id;                               
                $request_list = $this->Api_model->RequestList(array('id'=>$requestid))->row();

                if(!empty($request_list->category))
                {
                    $Details    = $this->Api_model->get_where_row("category",array('id' => $request_list->category));
                    
                    $category   = $Details->category_name;
                    
                    $category_icon = $Details->category_icon;
                }
                else
                {
                    $category = '';
                    
                    $category_icon = '';
                }
                
                if(!empty($request_list->subcategory))
                {
                    $Details    = $this->Api_model->get_where_row("category",array('id' => $request_list->subcategory));
                    
                    $subcategory_name = $Details->category_name;
                    
                    $sub_category_icon = $Details->category_icon;
                }
                else
                {
                    $subcategory_name = '';
                    
                    $sub_category_icon = '';
                }
                
                $imageList = explode(",",$request_list->image);
                
                $image_list=array();
                
                foreach ($imageList as $key => $value1) 
                {
                    $image_list[]=[
                    
                        'image'     => $value1,
                        
                        'image_url' => $this->getImage($value1,'request_image')
                    ];
                }

                $orderDetails=[                        
                                   
                    'order_id'=>$OrderList->id,
                    
                    'order_date'=>$OrderList->created_at,
                    
                    //'request_id'=>$request_list->id,
                    
                    'title'=>'',
                    
                    'category_id'=>$request_list->category,
                    
                    'category_name'=>$category,
                    
                    'category_icon'=> $this->getImage($category_icon,'category_image'),
            
                    'sub_category_id'=>$request_list->subcategory,
                
                    'sub_category_name'=>$subcategory_name,
                
                    'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                    
                    'image_list'=>$image_list,
                    
                    'price'=>$OrderList->price,
                    
                    'quantity'=>$OrderList->quantity,
                    
                    'deliverytime'=>$request_list->deliverytime,
                    
                    'description'=>$request_list->description,

                    'requirement'=>$OrderList->description,
                    
                    'shipping_price'=>$OrderList->shipping_cost,
                    
                    'total_cost'=>$OrderList->final_cost,

                    'time_extension'=>$OrderList->time_extension,

                    'time_description'=>$OrderList->time_description,

                    'time_status'=>$OrderList->time_status
                ];
            }


            $seller_id  =  $OrderList ? $OrderList->seller_id : '';

            $userData = $this->Api_model->get_where_row("app_user",array('id' => $seller_id));

            $completed=$this->Api_model->getCompleted($seller_id);            
            $orders_completed = $completed->id ? $completed->id : '0';

            $Rating = ceil($this->Api_model->rating(array('seller_id'=>$seller_id),'avg(buyer_rating) as rating')->row()->rating);
            //print_r($Rating);exit;
            $rating = !empty($Rating) ? $Rating : '0';

            $seller_List=[ 

                'seller_id'           => $userData->id,
                'first_name'          => trim($userData->first_name),
                'last_name'           => trim($userData->last_name),
                'email'               => $userData->email,
                'profile'             => $userData->profile_picture,
                'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                'mobile_country'      => $userData->mobile_country,
                'phone_no'            => $userData->phone_no,
                'is_email_verified'   => $userData->is_email_verified,
                'is_mobile_verified'  => $userData->is_mobile_verified,
                'address'             => $userData->address,
                'about'               => $userData->about,
                'skills'              => $userData->skills,
                'language'            => $userData->language,
                'rating'              => "$rating",
                'live_status'         => $userData->live_status,
                'last_visited'        => $userData->updated_at,
                'join_date'           => $userData->created_at,
                'orders_completed'    => $orders_completed

            ];

            $SellerId = $OrderList ? $OrderList->seller_id : '';
            $userid   = $user_id;
            $GigId    = $OrderList->type =='1' ? $OrderList->product_id : '';
            $Gig      = $this->Api_model->get_where_row("gig_list",array('id' => $GigId));
            $Revision = $Gig ? $Gig->revisions : '';

            $List = $this->Api_model->HistoryList(array('order_id'=>$order_id,'history_type'=>'2'))->result_array();   

            $revisionCount = count($List);
                      
            $this->checkAccountStatus($user_id);
              
            $reviewList   = $this->Api_model->RatingList(array('order_id'=>$order_id))->row();//'from_user_id='=>$user_id,
            
            $order_rating = !empty($reviewList->order_rating) ? $reviewList->order_rating : '';
            $order_review = !empty($reviewList->order_review) ? $reviewList->order_review : '';
            
            $buyer_rating = !empty($reviewList->buyer_rating) ? $reviewList->buyer_rating : '';
            $buyer_review = !empty($reviewList->buyer_review) ? $reviewList->buyer_review : '';
            
            $seller_rating = !empty($reviewList->seller_rating) ? $reviewList->seller_rating : '';
            $seller_review = !empty($reviewList->seller_review) ? $reviewList->seller_review : '';
            
            $revisionList   = array();
            $disputeList    = array();
            $cancelReason   = array();
            $orderReviews   = array();
            $userReviews    = array();
            $timeExtensions = array();
            $orderDelivery  = array();

            
            $OrderList     = $this->Api_model->OrderList(array('id'=>$order_id))->row();//'from_user_id='=>$user_id,

            $orderDate      = $OrderList->created_at ? $OrderList->created_at : '';
            $deliveryCount  = $OrderList->delivery_time ? $OrderList->delivery_time : '0';
            $timeCount      = $OrderList->time_status=='2' ? $OrderList->time_extension : '0';
            
            $order_status  = $OrderList->order_status;
            $order_buyer   = $OrderList->seller_id;
            
            $review_date   = !empty($reviewList->created_at) ? $reviewList->created_at : '';
            
            $isBuyer  = $this->Api_model->get_where_row("app_user",array('id' => $order_buyer));
            
            $orderReviews=[ 
                'order_id'            => $OrderList->id,
                'first_name'          => $isBuyer->first_name,
                'last_name'           => $isBuyer->last_name,
                'profile'             => $isBuyer->profile_picture,
                'profile_image_url'   => $this->getImage($isBuyer->profile_picture,'profile_image'),
                'rating'              => $order_rating,
                'review'              => $order_review,
                'is_date'             => $review_date,
            ];

            $userReviews=[ 
                'order_id'            => $OrderList->id,
                'first_name'          => $isBuyer->first_name,
                'last_name'           => $isBuyer->last_name,
                'profile'             => $isBuyer->profile_picture,
                'profile_image_url'   => $this->getImage($isBuyer->profile_picture,'profile_image'),
                'rating'              => $buyer_rating,
                'review'              => $buyer_review,
                'is_date'             => $review_date,
            ]; 

            $timeExtensions=[ 
                'order_id'            => $OrderList->id,
                'time_extension'      => $OrderList->time_extension,
                'time_description'    => $OrderList->time_description,
                'time_status'         => $OrderList->time_status,
                'is_date'             => $OrderList->updated_at,
            ];

            $Cancel = $this->Api_model->HistoryList(array('order_id'=>$order_id,'history_type'=>'5'))->row();   
            
            $cancelStatus = $Cancel ? $Cancel->status : '';
            
            $Buyer_id  = $OrderList->buyer_id;
            $Seller_id = $OrderList->seller_id;

            $cancel_reason = $OrderList->cancel_reason;

            // if($cancel_reason)
            // {                
                $cancelReason=[ 
                    'order_id'          => $OrderList->id,         
                    'cancel_by'         => $Cancel ? $Cancel->from_user_id : '',
                    'cancel_reason'     => $Cancel ? $Cancel->details : '',                   
                    'cancelled_date'    => $OrderList->cancelled_at ? $OrderList->cancelled_at : '',
                    'cancel_status'     => $cancelStatus,
                ];
            // }
            // else
            // {
            //     $cancelReason   = (object)array();
            // }
            
            $List = $this->Api_model->HistoryList(array('order_id'=>$order_id))->result_array();//'from_user_id='=>$user_id,
            
            $sellerList = array();
            $searchList = array();
                    
            foreach ($List as $key => $value) 
            {
               
                $user_id = $value['from_user_id'];
                
                if($value['history_type']=='1')
                {
                    $Json = json_decode($value['details']);
                    
                    $buyer_id   = $Json->from;
                    $seller_id  = $Json->to;
                    $message    = $Json->message;
                    $is_date    = $Json->is_date;
                    
                    if($Buyer_id==$user_id)
                    {
                         $Buyer  = $this->Api_model->get_where_row("app_user",array('id' => $user_id));
                         
                          $sellerList[]=[ 
                            'msg_id'                  => $value['id'],
                            
                            'order_id'                  => $value['order_id'],
                            
                            'user_id'                  => $user_id,
                            'first_name'          => $Buyer->first_name,
                            'last_name'           => $Buyer->last_name,
                            'profile'             => $Buyer->profile_picture,
                            'profile_image_url'   => $this->getImage($Buyer->profile_picture,'profile_image'),
    
                            'message'                   => $message,
                            'is_date'                   => $is_date,
                        ];
                    }
                    
                    if($Seller_id==$user_id)
                    {
                          $userData = $this->Api_model->get_where_row("app_user",array('id' => $user_id));
                    
                             $sellerList[]=[ 
                                'msg_id'                  => $value['id'],
                                
                                'order_id'                  => $value['order_id'],
                                'user_id'                  => $user_id,
                                'first_name'         => $userData->first_name,
                                'last_name'          => $userData->last_name,
                                'profile'            => $userData->profile_picture,
                                'profile_image_url'  => $this->getImage($userData->profile_picture,'profile_image'),
                                'message'                   => $message,
                                'is_date'                   => $is_date,
                            ];
                    }
                   
                }
                if($value['history_type']=='2')
                {
                   $Json = json_decode($value['details']);
                    
                    $buyer_id   = $Json->from;
                    $seller_id  = $Json->to;
                    $message    = $Json->message;
                    $is_date    = $Json->is_date;
                    
                    if($Buyer_id==$user_id)
                    {
                         $Buyer  = $this->Api_model->get_where_row("app_user",array('id' => $user_id));
                         
                          $revisionList[]=[ 
                            'msg_id'                  => $value['id'],
                            
                            'order_id'                  => $value['order_id'],
                            
                           'user_id'                  => $user_id,
                            'first_name'          => $Buyer->first_name,
                            'last_name'           => $Buyer->last_name,
                            'profile'             => $Buyer->profile_picture,
                            'profile_image_url'   => $this->getImage($Buyer->profile_picture,'profile_image'),
    
                            'message'                   => $message,
                            'is_date'                   => $is_date,
                            
                            'status'                  => $value['status'],
                        ];
                    }
                    
                    if($Seller_id==$user_id)
                    {
                          $userData = $this->Api_model->get_where_row("app_user",array('id' => $user_id));
                    
                             $revisionList[]=[ 
                                'msg_id'                  => $value['id'],
                                
                                'order_id'                  => $value['order_id'],
                                'user_id'                  => $user_id,
                                'first_name'         => $userData->first_name,
                                'last_name'          => $userData->last_name,
                                'profile'            => $userData->profile_picture,
                                'profile_image_url'  => $this->getImage($userData->profile_picture,'profile_image'),
                                'message'                   => $message,
                                'is_date'                   => $is_date,
                                
                                'status'                  => $value['status'],
                            ];
                    }
                }
                
                if($value['history_type']=='3')
                {
                   $Json = json_decode($value['details']);
                    
                    $buyer_id   = $Json->from;
                    $seller_id  = $Json->to;
                    $message    = $Json->message;
                    $is_date    = $Json->is_date;
                    
                    if($Buyer_id==$user_id)
                    {
                         $Buyer  = $this->Api_model->get_where_row("app_user",array('id' => $user_id));
                         
                          $disputeList[]=[ 
                            //'msg_id'                  => $value['id'],
                            
                            'order_id'                  => $value['order_id'],
                            
                            //'buyer_id'                  => $buyer_id,
                            'first_name'          => $Buyer->first_name,
                            'last_name'           => $Buyer->last_name,
                            'profile'             => $Buyer->profile_picture,
                            'profile_image_url'   => $this->getImage($Buyer->profile_picture,'profile_image'),
    
                            'message'                   => $message,
                            'is_date'                   => $is_date,
                        ];
                    }
                    
                    if($Seller_id==$user_id)
                    {
                          $userData = $this->Api_model->get_where_row("app_user",array('id' => $user_id));
                    
                             $disputeList[]=[ 
                                //'msg_id'                  => $value['id'],
                                
                                'order_id'                  => $value['order_id'],
                                //'seller_id'                 => $seller_id,
                                 'first_name'         => $userData->first_name,
                                'last_name'          => $userData->last_name,
                                'profile'            => $userData->profile_picture,
                                'profile_image_url'  => $this->getImage($userData->profile_picture,'profile_image'),
                                 'message'                   => $message,
                                'is_date'                   => $is_date,
                            ];
                    }
                }
            }
            
            $Admin = $this->Api_model->HistoryList(array('order_id'=>$order_id,'from_user_id'=>$user_id,'history_type'=>'4'))->row();
            $admin_report = !empty($Admin->status) ? $Admin->status : '0';

            if(!empty($deliveryCount))
            {
                $Count = $deliveryCount + $timeCount;

                $currentDate   = date("Y-m-d h:i:s");           
                $deliveryDate = date('Y-m-d', strtotime($orderDate.'+ '.$Count.' days'));

                $startDate      = new DateTime($orderDate);
                $endDate        = new DateTime($currentDate);
                $interval       = $startDate->diff($endDate);
                $order_started  = $interval->days;

                $startDate1      = new DateTime($currentDate);
                $endDate1        = new DateTime($deliveryDate);
                $interval1       = $startDate1->diff($endDate1);
                $order_deliver   = $interval1->days;  
            }
            else
            {
                $order_started   = "0";
                $order_deliver   = "0";  
            }

            $Delivery = $this->Admin_model->get_where('order_delivery',array('buyer_id'=>$userid,'order_id'=>$order_id));

            if(!empty($Delivery))
            {
                foreach ($Delivery as $key => $valuelist) 
                {
                    $orderDelivery[]=[ 
                        'user_id'       => $valuelist->buyer_id,
                        'order_id'      => $valuelist->order_id,
                        'type'          => $valuelist->type,
                        'thumb'         => $valuelist->type,
                        'thumb_url'     => $valuelist->type =='2' ? $this->getImage($valuelist->thumb,'project') : '',
                        'project'       => $valuelist->project,
                        'project_url'   => $this->getImage($valuelist->project,'project'),
                        'description'   => $valuelist->description,
                        'is_date'       => $valuelist->created_at,
                    ];
                }
            }         
         
            $data['status']     = "1";
            $data['message']    = "Success";            

            $data['order_date']     = $orderDate;

            $data['order_status']   = $order_status;
            
            $data['admin_report']   = !empty($admin_report) ? $admin_report : '0';
            $data['user_rating']    = !empty($buyer_rating) ? $buyer_rating : '0';
            $data['order_rating']   = !empty($order_rating) ? $order_rating : '0';
            $data['other_rating']   = !empty($seller_rating) ? $seller_rating : '0';
                       
            $data['order_started']      = "$order_started";            
            $data['order_deliver']      = "$order_deliver";
            
            $data['gig_revision']       = $Revision;
            $data['revision_count']     = "$revisionCount";
            
            $data['message_list']       = $sellerList;
            
            $data['revision_order']     = $revisionList;
            
            $data['dispute_order']      = $disputeList;
            
            $data['cancelled_order']    = $cancelReason;
            
            $data['order_reviews']      = $orderReviews;

            $data['user_reviews']       = $userReviews;

            $data['time_Extensions']    = $timeExtensions;

            $data['order_delivery']     = $orderDelivery;

            $data['orderDetails']       = $orderDetails;

            $data['sellerDetails']      = $seller_List;
        }
        
        header( 'Content-type:application/json');        
        print json_encode( $data);        
        exit;    
    }
    
    //=========================== Seller Order History List ===================================//
    
    function SellerOrderHistoryList()
    {
        $user_id = $this->input->post('user_id');
        
        $order_id = $this->input->post('order_id');
        
        //$this->formValidation("User Id",$user_id,"required");
        
        $this->formValidation("Order Id",$order_id,"required");
        
        $check_user= (array) $this->getUserDetails(array("id"=>$user_id));

        //print_r( $check_user);exit;
        
        $OrderList     = $this->Api_model->OrderList(array('id'=>$order_id))->row();

        if(empty($check_user))
        {
            $data['status']="0";
                
            $data['message']="User Not Found";
        }
        else
        {
            if(empty($OrderList))
            {
                $data['status']="0";
                
                $data['message']="Record Not Found";
            } 
            else
            {

                if($OrderList->type=='1') {

                    $gigid    = $OrderList->product_id;
                    $gig_list = $this->Api_model->GigList(array('id'=>$gigid))->row();

                    if(!empty($gig_list->category_id))
                    {
                        $Details = $this->Api_model->get_where_row("category",array('id' => $gig_list->category_id));

                        $category       = $Details->category_name;
                        $category_icon  = $Details->category_icon;
                    }
                    else
                    {
                        $category       = '';                        
                        $category_icon  = '';
                    }
                    
                    if(!empty($gig_list->sub_category_id))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $gig_list->sub_category_id));
                        
                        $subcategory_name   = $Details->category_name;
                        $sub_category_icon  = $Details->category_icon;
                    }
                    else
                    {
                        $subcategory_name   = '';                        
                        $sub_category_icon  = '';
                    }
                    
                    $image_list=array();
                    
                    $array = json_decode($gig_list->image);
                
                    $imageList = $array->image_list;
                    
                    $image_list=array();
                    
                    foreach ($imageList as $key => $value2) 
                    {
                        $image_list[]=[
                        
                            'image'     =>  $value2->type,
                            
                            'image_url' => $this->getImage($value2->thumnail,'gig_image'),
                        ];
                    }

                    $orderDetails=[
                                               
                        'order_id'=>$OrderList->id,
                        
                        'order_date'=>$OrderList->created_at,
                        
                        'gig_id'=>$gig_list->id,
                        
                        'title'=>$gig_list->title,
                        
                        'category_id'=>$gig_list->category_id,
                        
                        'category_name'=>$category,
                        
                        'category_icon'=> $this->getImage($category_icon,'category_image'),
                
                        'sub_category_id'=>$gig_list->sub_category_id,
                    
                        'sub_category_name'=>$subcategory_name,
                    
                        'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                        
                        'image_list'=>$image_list,
                        
                        'price'=>$OrderList->price,
                        
                        'quantity'=>$OrderList->quantity,
                        
                        'deliverytime'=>$gig_list->delivery_time,
                        
                        'description'=>$gig_list->description,

                        'requirement'=>$OrderList->description,
                        
                        'shipping_price'=>$OrderList->shipping_cost,
                        
                        'total_cost'=>$OrderList->final_cost,

                        'time_extension'=>$OrderList->time_extension,

                        'time_description'=>$OrderList->time_description,

                        'time_status'=>$OrderList->time_status
                    ];
                }

                if($OrderList->type=='2') {

                    $requestid    = $OrderList->product_id;                               
                    $request_list = $this->Api_model->RequestList(array('id'=>$requestid))->row();

                    if(!empty($request_list->category))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $request_list->category));
                        
                        $category   = $Details->category_name;
                        
                        $category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $category = '';
                        
                        $category_icon = '';
                    }
                    
                    if(!empty($request_list->subcategory))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $request_list->subcategory));
                        
                        $subcategory_name = $Details->category_name;
                        
                        $sub_category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $subcategory_name = '';
                        
                        $sub_category_icon = '';
                    }
                    
                    $imageList = explode(",",$request_list->image);
                    
                    $image_list=array();
                    
                    foreach ($imageList as $key => $value1) 
                    {
                        $image_list[]=[
                        
                            'image'     => $value1,
                            
                            'image_url' => $this->getImage($value1,'request_image')
                        ];
                    }

                    $orderDetails=[                        
                                       
                        'order_id'=>$OrderList->id,
                        
                        'order_date'=>$OrderList->created_at,
                        
                        //'request_id'=>$request_list->id,
                        
                        'title'=>'',
                        
                        'category_id'=>$request_list->category,
                        
                        'category_name'=>$category,
                        
                        'category_icon'=> $this->getImage($category_icon,'category_image'),
                
                        'sub_category_id'=>$request_list->subcategory,
                    
                        'sub_category_name'=>$subcategory_name,
                    
                        'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                        
                        'image_list'=>$image_list,
                        
                        'price'=>$OrderList->price,
                        
                        'quantity'=>$OrderList->quantity,
                        
                        'deliverytime'=>$request_list->deliverytime,
                        
                        'description'=>$request_list->description,

                        'requirement'=>$OrderList->description,
                        
                        'shipping_price'=>$OrderList->shipping_cost,
                        
                        'total_cost'=>$OrderList->final_cost,

                        'time_extension'=>$OrderList->time_extension,

                        'time_description'=>$OrderList->time_description,

                        'time_status'=>$OrderList->time_status
                    ];
                }

                $buyer_id  = $OrderList ? $OrderList->buyer_id : '';

                $userData = $this->Api_model->get_where_row("app_user",array('id' => $buyer_id));

                $completed=$this->Api_model->getCompleted($buyer_id);            
                $orders_completed = $completed->id ? $completed->id : '0';

                $Rating = ceil($this->Api_model->rating(array('seller_id'=>$buyer_id,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);
                $rating = !empty($Rating) ? $Rating : '0';

                $buyer_List=[ 

                    'buyer_id'            => trim($userData->id),
                    'first_name'          => trim($userData->first_name),
                    'last_name'           => trim($userData->last_name),
                    'email'               => $userData->email,
                    'profile'             => $userData->profile_picture,
                    'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                    'mobile_country'      => $userData->mobile_country,
                    'phone_no'            => $userData->phone_no,
                    'is_email_verified'   => $userData->is_email_verified,
                    'is_mobile_verified'  => $userData->is_mobile_verified,
                    'address'             => $userData->address,
                    'about'               => $userData->about,
                    'skills'              => $userData->skills,
                    'language'            => $userData->language,
                    'rating'              => "$rating",
                    'live_status'         => $userData->live_status,
                    'last_visited'        => $userData->updated_at,
                    'join_date'           => $userData->created_at,
                    'orders_completed'    => $orders_completed
                ];

                $BuyerId = $OrderList ? $OrderList->buyer_id : '';

                $userid = $user_id;

                $this->checkAccountStatus($user_id);
                
                $reviewList   = $this->Api_model->RatingList(array('order_id'=>$order_id))->row();//'from_user_id='=>$user_id,
                
                $order_rating = !empty($reviewList->order_rating) ? $reviewList->order_rating : '0';
                $order_review = !empty($reviewList->order_review) ? $reviewList->order_review : '0';
                
                $buyer_rating = !empty($reviewList->buyer_rating) ? $reviewList->buyer_rating : '0';
                $buyer_review = !empty($reviewList->buyer_review) ? $reviewList->buyer_review : '0';
                
                $seller_rating = !empty($reviewList->seller_rating) ? $reviewList->seller_rating : '0';
                $seller_review = !empty($reviewList->seller_review) ? $reviewList->seller_review : '0';
                
                $revisionList   = array();
                $disputeList    = array();
                $cancelReason   = array();
                $orderReviews   = array();
                $userReviews    = array();
                $timeExtensions = array();
                $sellerList     = array();
                $orderDelivery  = array();
                $orderList      = array();

                $OrderList      = $this->Api_model->OrderList(array('id'=>$order_id))->row();//'from_user_id='=>$user_id,
                $orderDate      = $OrderList->created_at ? $OrderList->created_at : '';
                $deliveryCount  = $OrderList->delivery_time ? $OrderList->delivery_time : '0';
                $timeCount      = $OrderList->time_status=='2' ? $OrderList->time_extension : '0';

                $order_status  = $OrderList->order_status;
                $order_buyer   = $OrderList->buyer_id;
                
                $review_date   = !empty($reviewList->created_at) ? $reviewList->created_at : '';
                
                $isBuyer  = $this->Api_model->get_where_row("app_user",array('id' => $order_buyer));
                
                $orderReviews=[ 
                    'order_id'            => $OrderList->id,
                    'first_name'          => $isBuyer->first_name,
                    'last_name'           => $isBuyer->last_name,
                    'profile'             => $isBuyer->profile_picture,
                    'profile_image_url'   => $this->getImage($isBuyer->profile_picture,'profile_image'),
                    'rating'              => $order_rating,
                    'review'              => $order_review,
                    'is_date'             => $review_date,
                ];

                $userReviews=[ 
                    'order_id'            => $OrderList->id,
                    'first_name'          => $isBuyer->first_name,
                    'last_name'           => $isBuyer->last_name,
                    'profile'             => $isBuyer->profile_picture,
                    'profile_image_url'   => $this->getImage($isBuyer->profile_picture,'profile_image'),
                    'rating'              => $seller_rating,
                    'review'              => $seller_review,
                    'is_date'             => $review_date,
                ];

                $timeExtensions=[ 
                    'order_id'            => $OrderList->id,
                    'time_extension'      => $OrderList->time_extension,
                    'time_description'    => $OrderList->time_description,
                    'time_status'         => $OrderList->time_status,
                    'is_date'             => $OrderList->updated_at,
                ];
        
                $cancel_reason='';

                $Cancel = $this->Api_model->HistoryList(array('order_id'=>$order_id,'history_type'=>'5'))->row();   

                $cancelStatus = $Cancel ? $Cancel->status : '';
                
                $Buyer_id  = $OrderList->buyer_id;
                $Seller_id = $OrderList->seller_id;
                
                $cancel_reason = $OrderList->cancel_reason;

                // if($cancel_reason)
                // {                                
                    $cancelReason=[ 
                        'order_id'          => $OrderList->id,         
                        'cancel_by'         => $Cancel ? $Cancel->from_user_id : '',
                        'cancel_reason'     => $Cancel ? $Cancel->details : '',                   
                        'cancelled_date'    => $OrderList->cancelled_at ? $OrderList->cancelled_at : '',
                        'cancel_status'     => $cancelStatus,
                    ];
                // }
                // else
                // {
                //     $cancelReason   = (object)array();
                // }
                
                $List=$this->Api_model->HistoryList(array('order_id'=>$order_id))->result_array();//'from_user_id='=>$user_id,
                
                foreach ($List as $key => $value) 
                {
                    $user_id = $value['from_user_id'];
                    
                    if($value['history_type']=='1')
                    {
                        $Json = json_decode($value['details']);
                        
                        $buyer_id   = $Json->from;
                        $seller_id  = $Json->to;
                        $message    = $Json->message;
                        $is_date    = $Json->is_date;
                        
                        if($Buyer_id==$user_id)
                        {
                             $Buyer  = $this->Api_model->get_where_row("app_user",array('id' => $user_id));
                             
                              $sellerList[]=[ 
                                'msg_id'                  => $value['id'],
                                
                                'order_id'                  => $value['order_id'],
                                
                                'user_id'                  => $user_id,
                                'first_name'          => $Buyer->first_name,
                                'last_name'           => $Buyer->last_name,
                                'profile'             => $Buyer->profile_picture,
                                'profile_image_url'   => $this->getImage($Buyer->profile_picture,'profile_image'),
        
                                'message'                   => $message,
                                'is_date'                   => $is_date,
                            ];
                        }
                        
                        if($Seller_id==$user_id)
                        {
                              $userData = $this->Api_model->get_where_row("app_user",array('id' => $user_id));
                        
                                 $sellerList[]=[ 
                                    'msg_id'             => $value['id'],
                                    
                                    'order_id'           => $value['order_id'],
                                    'user_id'            => $user_id,
                                    
                                    'first_name'         => $userData->first_name,
                                    'last_name'          => $userData->last_name,
                                    'profile'            => $userData->profile_picture,
                                    'profile_image_url'  => $this->getImage($userData->profile_picture,'profile_image'),
                                    'message'            => $message,
                                    'is_date'            => $is_date,
                                ];
                        }
                       
                    }
                    
                    if($value['history_type']=='2')
                    {
                       $Json = json_decode($value['details']);
                        
                        $buyer_id   = $Json->from;
                        $seller_id  = $Json->to;
                        $message    = $Json->message;
                        $is_date    = $Json->is_date;
                        
                        if($Buyer_id==$user_id)
                        {
                             $Buyer  = $this->Api_model->get_where_row("app_user",array('id' => $user_id));
                             
                              $revisionList[]=[ 
                                'msg_id'                  => $value['id'],
                                
                                'order_id'                  => $value['order_id'],
                                
                                'user_id'                  => $user_id,
                                'first_name'          => $Buyer->first_name,
                                'last_name'           => $Buyer->last_name,
                                'profile'             => $Buyer->profile_picture,
                                'profile_image_url'   => $this->getImage($Buyer->profile_picture,'profile_image'),
        
                                'message'                   => $message,
                                'is_date'                   => $is_date,
                                
                                'status'                  => $value['status'],
                            ];
                        }
                        
                        if($Seller_id==$user_id)
                        {
                              $userData = $this->Api_model->get_where_row("app_user",array('id' => $user_id));
                        
                                 $revisionList[]=[ 
                                    'msg_id'                  => $value['id'],
                                    
                                    'order_id'                  => $value['order_id'],
                                    'user_id'                  => $user_id,
                                    'first_name'         => $userData->first_name,
                                    'last_name'          => $userData->last_name,
                                    'profile'            => $userData->profile_picture,
                                    'profile_image_url'  => $this->getImage($userData->profile_picture,'profile_image'),
                                    'message'                   => $message,
                                    'is_date'                   => $is_date,
                                    
                                    'status'                  => $value['status'],
                                ];
                        }
                    }
                    
                    if($value['history_type']=='3')
                    {
                       $Json = json_decode($value['details']);
                        
                        $buyer_id   = $Json->from;
                        $seller_id  = $Json->to;
                        $message    = $Json->message;
                        $is_date    = $Json->is_date;
                        
                        if($Buyer_id==$user_id)
                        {
                             $Buyer  = $this->Api_model->get_where_row("app_user",array('id' => $user_id));
                             
                              $disputeList[]=[ 
                                //'msg_id'                  => $value['id'],
                                
                                'order_id'                  => $value['order_id'],
                                
                                //'buyer_id'                  => $buyer_id,
                                'first_name'          => $Buyer->first_name,
                                'last_name'           => $Buyer->last_name,
                                'profile'             => $Buyer->profile_picture,
                                'profile_image_url'   => $this->getImage($Buyer->profile_picture,'profile_image'),
        
                                'message'                   => $message,
                                'is_date'                   => $is_date,
                            ];
                        }
                        
                        if($Seller_id==$user_id)
                        {
                              $userData = $this->Api_model->get_where_row("app_user",array('id' => $user_id));
                        
                                 $disputeList[]=[ 
                                    //'msg_id'                  => $value['id'],
                                    
                                    'order_id'                  => $value['order_id'],
                                    //'seller_id'                 => $seller_id,
                                    'first_name'         => $userData->first_name,
                                   'last_name'          => $userData->last_name,
                                   'profile'            => $userData->profile_picture,
                                   'profile_image_url'  => $this->getImage($userData->profile_picture,'profile_image'),
                                     'message'                   => $message,
                                    'is_date'                   => $is_date,
                                ];
                        }
                    }
                }
                
                $Admin = $this->Api_model->HistoryList(array('order_id'=>$order_id,'from_user_id'=>$user_id,'history_type'=>'4'))->row();
                $admin_report = !empty($Admin->status) ? $Admin->status : '0';

                if(!empty($deliveryCount))
                {
                    $Count = $deliveryCount + $timeCount;

                    $currentDate   = date("Y-m-d h:i:s");           
                    $deliveryDate = date('Y-m-d', strtotime($orderDate.'+ '.$Count.' days'));

                    $startDate      = new DateTime($orderDate);
                    $endDate        = new DateTime($currentDate);
                    $interval       = $startDate->diff($endDate);
                    $order_started  = $interval->days;

                    $startDate1      = new DateTime($currentDate);
                    $endDate1        = new DateTime($deliveryDate);
                    $interval1       = $startDate1->diff($endDate1);
                    $order_deliver   = $interval1->days;  
                }
                else
                {
                    $order_started   = "0";
                    $order_deliver   = "0";  
                }

                $Delivery = $this->Admin_model->get_where('order_delivery',array('user_id'=>$userid,'order_id'=>$order_id));

                if(!empty($Delivery))
                {
                    foreach ($Delivery as $key => $valuelist) 
                    {
                        $orderDelivery[]=[ 
                            'user_id'       => $valuelist->user_id,
                            'order_id'      => $valuelist->order_id,
                            'type'          => $valuelist->type,
                            'thumb'         => $valuelist->type,
                            'thumb_url'     => $valuelist->type =='2' ? $this->getImage($valuelist->thumb,'project') : '',
                            'project'       => $valuelist->project,
                            'project_url'   => $this->getImage($valuelist->project,'project'),
                            'description'   => $valuelist->description,
                            'is_date'       => $valuelist->created_at,
                        ];
                    }
                }    
            
                $data['status']     = "1";            
                $data['message']    = "Success";

                $data['order_date']      = $orderDate;
                
                $data['order_status']    = $order_status;
                
                $data['admin_report']    = !empty($admin_report) ? $admin_report : '0';
                $data['user_rating']     = !empty($seller_rating) ? $seller_rating : '0';
                $data['order_rating']    = !empty($order_rating) ? $order_rating : '0';
                $data['other_rating']    = !empty($buyer_rating) ? $buyer_rating : '0';
                
                $data['order_started']   = "$order_started";
                $data['order_deliver']   = "$order_deliver";

                $data['message_list']    = $sellerList;
                $data['revision_order']  = $revisionList;
                
                $data['dispute_order']   = $disputeList;
                $data['cancelled_order'] = $cancelReason;
                
                $data['order_reviews']   = $orderReviews;
                $data['user_reviews']    = $userReviews;

                $data['time_Extensions'] = $timeExtensions;

                $data['order_delivery']  = $orderDelivery;

                $data['orderDetails']    = $orderDetails;

                $data['buyerDetails']    = $buyer_List;
            }

        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }

    //=========================== Seller Revision Accepted Rejected ===============================//

    function sellerRevision()
    {
        $user_id     = $this->input->post('user_id');
        $order_id    = $this->input->post('order_id');
        $msg_id      = $this->input->post('msg_id');
        $status      = $this->input->post('status');

        $this->formValidation("User Id",$user_id,"required");
        $this->formValidation("Order Id",$order_id,"required");
        $this->formValidation("Msg Id",$msg_id,"required");
        $this->formValidation("Status",$status,"required");
    
        $check_now = $this->Api_model->HistoryList(array('order_id'=>$order_id,'history_type'=>'2','id'=>$msg_id))->row();
    
        if(empty($check_now))
        {
            $data['status']="0";
            $data['message']="Record not found";
        }
        else
        {

            $OrderList   = $this->Api_model->OrderList(array('id'=>$order_id))->row();
            $orderStatus = $OrderList->order_status;

            $BuyerId = $check_now->from_user_id;

            if($status==1)
            {

                $iData=array(
                   
                    'order_status'=>'3',    
                    
                    'updated_at'=>date('Y-m-d H:i:s')
                );

                $this->Api_model->Orders(array('id'=>$order_id,'seller_id'=>$user_id),$iData);

                $Data=array(   
                
                    'status'=>$status,
                    
                    'updated_at'=>date('Y-m-d H:i:s')
                );
        
                if($this->Api_model->AddHistory(array('order_id'=>$order_id,'history_type'=>'2','id'=>$msg_id),$Data))
                {
                    $data['status']="1";
                    
                    $data['message']="Accepted Successfully";

                    $this->prepreFcm('revisionSelleraccept',array('user_id'=>$BuyerId,'order_id'=>$order_id,'status'=>$orderStatus));
                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Something went wrong";
                }
            }
            
            if($status==2)
            {
                $Data=array(   
                
                    'status'=>$status,
                    
                    'updated_at'=>date('Y-m-d H:i:s')
                
                );
                
                if($this->Api_model->AddHistory(array('order_id'=>$order_id,'history_type'=>'2','id'=>$msg_id),$Data))
                {
                    $data['status']="1";
                    
                    $data['message']="Rejected Successfully";

                    $this->prepreFcm('revisionSellerreject',array('user_id'=>$BuyerId,'order_id'=>$order_id,'status'=>$orderStatus));
                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Something went wrong";
                }
            }
        }
    
        header( 'Content-type:application/json');
        print json_encode( $data);    
        exit; 
    }
    
    //=========================== Order Cancelled ========================================//
    
    function orderCancelled()
    {
        $user_id        = $this->input->post('user_id');
        $order_id       = $this->input->post('order_id');
        $user_type      = $this->input->post('user_type');
        $cancel_reason  = $this->input->post('cancel_reason');
        
        $this->formValidation("User Id",$user_id,"required");
        $this->formValidation("Order Id",$order_id,"required");
        $this->formValidation("User Type",$user_type,"required");
        $this->formValidation("Cancel Reason",$cancel_reason,"missing");
        
        if($user_type==1)
        {
            $Details=$this->Api_model->OrderList(array('id'=>$order_id,'buyer_id'=>$user_id))->row();
        }
        else if($user_type==2)
        {
            $Details=$this->Api_model->OrderList(array('id'=>$order_id,'seller_id'=>$user_id))->row();
        }
        
        if(empty($Details))
        {
            $data['status']="0";
            
            $data['message']="Record Not Found";
        }
        else
        {
            
            $Details = $this->Api_model->OrderList(array('id'=>$order_id))->row();
            
            $Orderid = $Details->id;
            
            $buyer_id = $Details->buyer_id;
            
            $seller_id = $Details->seller_id;

            $orderStatus = $Details->order_status;
            
            if($user_type==1)
            {
                $Data=array(
            
                    'cancel_reason'=>$cancel_reason,
                    
                    //'order_status'=>'7',
                    
                    'cancelled_at'=>date('Y-m-d H:i:s')
                );


                $HistoryData=array(
                    
                    'order_id'=>$order_id,
                    
                    'from_user_id'=>$user_id,
    
                    'history_type'=>'5',
                    
                    'details'=>$cancel_reason,
                    
                    'status'=>'0',
                    
                    'created_at'=>date('Y-m-d H:i:s')
                );

                $this->Api_model->AddHistory('',$HistoryData);
        
                if($this->Api_model->Orders(array('id'=>$Orderid),$Data))
                {
                    $data['status']="1";
                    
                    $data['message']="Order cancel request sent";
                    
                    $this->prepreFcm('Buyercancelrequest',array('user_id'=>$seller_id,'order_id'=>$order_id,'status'=>$orderStatus));
                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Something went wrong";
                }
            }
            
            if($user_type==2)
            {
                $Data=array(
            
                    'cancel_reason'=>$cancel_reason,
                    
                    //'order_status'=>'7',
                    
                    'cancelled_at'=>date('Y-m-d H:i:s')
                );

                $HistoryData=array(
                    
                    'order_id'=>$order_id,
                    
                    'from_user_id'=>$user_id,
    
                    'history_type'=>'5',
                    
                    'details'=>$cancel_reason,
                    
                    'status'=>'0',
                    
                    'created_at'=>date('Y-m-d H:i:s')
                );

                $this->Api_model->AddHistory('',$HistoryData);
        
                if($this->Api_model->Orders(array('id'=>$Orderid),$Data))
                {
                    $data['status']="1";
                    
                    $data['message']="Order cancel request sent";
                    
                    $this->prepreFcm('Sellercancelrequest',array('user_id'=>$buyer_id,'order_id'=>$order_id,'status'=>$orderStatus));
                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Something went wrong";
                }
            }
           
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }

     //=========================== Buyer Cancelled Status Accepted Rejected ===============================//

    function BuyerCancelledStatus()
    {
        $user_id     = $this->input->post('user_id');
        $order_id    = $this->input->post('order_id');
        $status      = $this->input->post('status');

        $this->formValidation("User Id",$user_id,"required");
        $this->formValidation("Order Id",$order_id,"required");
        $this->formValidation("Status",$status,"required");
    
        $Details=$this->Api_model->OrderList(array('id'=>$order_id,'buyer_id'=>$user_id))->row();

        $check_now = $this->Api_model->HistoryList(array('order_id'=>$order_id,'history_type'=>'5'))->row();

    
        if(empty($check_now))
        {
            $data['status']="0";
            $data['message']="Record not found";
        }
        else
        {            

            //$order_id = $Details->id;
            
            $buyer_id = $Details->buyer_id;
            
            $seller_id = $Details->seller_id;

            $orderStatus = $Details->order_status;
            
            if($status==1)
            {
                $Data=array(   
                
                    'status'=>'1',
                    
                    'updated_at'=>date('Y-m-d H:i:s')
                );

                $Cancelled=array(
                               
                    'order_status'=>'7',
                    
                    'cancelled_at'=>date('Y-m-d H:i:s')
                );

                $this->Api_model->Orders(array('id'=>$order_id),$Cancelled);
        
                if($this->Api_model->AddHistory(array('order_id'=>$order_id,'history_type'=>'5'),$Data))
                {
                    $data['status']="1";                    
                    $data['message']="Accepted Successfully";

                    $this->prepreFcm('cancelSelleraccept',array('user_id'=>$seller_id,'order_id'=>$order_id,'status'=>$orderStatus));
                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Something went wrong";
                }
            }
            
            if($status==2)
            {
                $Data=array(   
                
                    'status'=>'2',
                    
                    'updated_at'=>date('Y-m-d H:i:s')
                );
        
                if($this->Api_model->AddHistory(array('order_id'=>$order_id,'history_type'=>'5'),$Data))
                {
                    $data['status']="1";
                    
                    $data['message']="Rejected Successfully";

                    $this->prepreFcm('cancelSellerreject',array('user_id'=>$seller_id,'order_id'=>$order_id,'status'=>$orderStatus));
                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Something went wrong";
                }
            }
        }
    
        header( 'Content-type:application/json');
        print json_encode( $data);    
        exit; 
    }


     //=========================== Seller Cancelled Status Accepted Rejected ===============================//

    function SellerCancelledStatus()
    {
        $user_id     = $this->input->post('user_id');
        $order_id    = $this->input->post('order_id');
        $status      = $this->input->post('status');

        $this->formValidation("User Id",$user_id,"required");
        $this->formValidation("Order Id",$order_id,"required");
        $this->formValidation("Status",$status,"required");
    
        $Details=$this->Api_model->OrderList(array('id'=>$order_id,'seller_id'=>$user_id))->row();

        $check_now = $this->Api_model->HistoryList(array('order_id'=>$order_id,'history_type'=>'5'))->row();

    
        if(empty($check_now))
        {
            $data['status']="0";
            $data['message']="Record not found";
        }
        else
        {
            $Orderid = $Details->id;
            
            $buyer_id = $Details->buyer_id;
            
            $seller_id = $Details->seller_id;

            $orderStatus = $Details->order_status;
            
            if($status==1)
            {
                $Data=array(   
                
                    'status'=>'1',
                    
                    'updated_at'=>date('Y-m-d H:i:s')
                );

                $Cancelled=array(
                               
                    'order_status'=>'7',
                    
                    'cancelled_at'=>date('Y-m-d H:i:s')
                );

                $this->Api_model->Orders(array('id'=>$order_id),$Cancelled);
        
                if($this->Api_model->AddHistory(array('order_id'=>$order_id,'history_type'=>'5'),$Data))
                {
                    $data['status']="1";
                    
                    $data['message']="Accepted Successfully";

                    $this->prepreFcm('cancelBuyeraccept',array('user_id'=>$buyer_id,'order_id'=>$order_id,'status'=>$orderStatus));
                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Something went wrong";
                }
            }
            
            if($status==2)
            {
                $Data=array(   
                
                    'status'=>'2',
                    
                    'updated_at'=>date('Y-m-d H:i:s')
                );
        
                if($this->Api_model->AddHistory(array('order_id'=>$order_id,'history_type'=>'5'),$Data))
                {
                    $data['status']="1";
                    
                    $data['message']="Rejected Successfully";

                    $this->prepreFcm('cancelBuyerreject',array('user_id'=>$buyer_id,'order_id'=>$order_id,'status'=>$orderStatus));
                }
                else
                {
                    $data['status']="0";
                    
                    $data['message']="Something went wrong";
                }
            }
        }
    
        header( 'Content-type:application/json');
        print json_encode( $data);    
        exit; 
    }
    
    //=========================== User Review ========================================//
    
    function userReview()
    {
        $user_id=$this->input->post('user_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        $buyerRating = $this->Api_model->RatingList(array('buyer_id'=>$user_id))->result_array();

        $buyerRatingList=array();

        if(!empty($buyerRating)) {
        
            foreach ($buyerRating as $key => $value)
            { 
                $seller_id = $value['seller_id'] ;
                
                $userData = $this->Api_model->get_where_row("app_user",array('id' => $seller_id));

                if(!empty($userData)) {
                
                    $buyerRatingList[] =[
                        
                        'first_name'          => trim($userData->first_name),
                        'last_name'           => trim($userData->last_name),
                        'profile'             => $userData->profile_picture,
                        'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                        'review'              => $value['buyer_review'],
                        'rating'              => $value['buyer_rating'],
                        'is_date'             => $value['created_at'],
                    ];

                }

            }
        }
        $sellerRating = $this->Api_model->RatingList(array('seller_id'=>$user_id))->result_array();
        
        $sellerRatingList=array();

        if(!empty($sellerRating)) {
        
            foreach ($sellerRating as $key => $value)
            { 
                $buyer_id = $value['buyer_id'];
                
                $Buyer = $this->Api_model->get_where_row("app_user",array('id' => $buyer_id));

                if(!empty($Buyer)) {
                
                    $sellerRatingList[] =[
                        
                        'first_name'          => trim($Buyer->first_name),
                        'last_name'           => trim($Buyer->last_name),
                        'profile'             => $Buyer->profile_picture,
                        'profile_image_url'   => $this->getImage($Buyer->profile_picture,'profile_image'),
                        'review'              => $value['seller_review'],
                        'rating'              => $value['seller_rating'],
                        'is_date'             => $value['created_at'],
                        
                    ];
                }
            }
        }
        
        if(!empty($check_user))
        {
            $this->checkAccountStatus($user_id);
            
            $data['status']="1";
            
            $data['message']="Success";
            
            $data['user_id']=$user_id;
            
            $data['buyer_reviews']  = $buyerRatingList;
            
            $data['seller_reviews'] = $sellerRatingList;
        }
        else
        {
            $data['status']="0";            
            $data['message']="User Doesnot Exist";
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    
    }
    
    //=========================== Gig Review ========================================//
    
    function gigReview()
    {
        $user_id=$this->input->post('user_id');
        $gig_id=$this->input->post('gig_id');
        
        $this->formValidation("User Id",$user_id,"required");
        $this->formValidation("Gig Id",$gig_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");

        if(!empty($check_user))
        {
            $this->checkAccountStatus($user_id);

            $OrderList = $this->Api_model->get_where("orders",array('type'=>'1','product_id'=>$gig_id));       
          
            $RatingList=array();
            
            foreach ($OrderList as $key => $value)
            {
                $Rating = $this->Api_model->RatingList(array('order_id'=>$value->id,'order_review!='=>'','order_rating!='=>''))->row();                

                if(!empty($Rating->buyer_id)) {
                            
                    $userData = $this->Api_model->get_where_row("app_user",array('id' => $Rating->buyer_id));
                               
                    $RatingList[] =[
                        
                        'first_name'          => trim($userData->first_name),
                        'last_name'           => trim($userData->last_name),
                        'profile'             => $userData->profile_picture,
                        'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                        'review'              => $Rating->order_review,
                        'rating'              => $Rating->order_rating,
                        'is_date'             => $Rating->created_at,
                    ];
                }
            }                      
            
            $data['status']="1";            
            $data['message']="Success";        
            $data['gig_reviews'] = $RatingList;
        }
        else
        {
            $data['status']="0";            
            $data['message']="User Doesnot Exist";
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;    
    }
    
    //=========================== Payment History ========================================//
    
    function paymentHistory()
    {
        $user_id=$this->input->post('user_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user= (array) $this->getUserDetails(array("id"=>$user_id));
        
        if(empty($check_user))
        {
            $data['status']="0";
            
            $data['message']="User Not Found";
        } 
        else 
        {
            $amountEarning  = array();
            $amountSpending = array();
            
            $earningDetails = $this->Api_model->OrderList(array('seller_id'=>$user_id))->result_array();
            
            foreach ($earningDetails as $key => $values)
            {
                if($values['type']=='1')
                {
                    $gigid    = $values['product_id'];
                    $gig_list = $this->Api_model->GigList(array('id'=>$gigid))->row();
                    $buyer_id  = $values['buyer_id'];
                    
                    $userData = $this->Api_model->get_where_row("app_user",array('id' => $buyer_id));

                    $sellerRating = ceil($this->Api_model->rating(array('seller_id'=>$buyer_id,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);

                    $buyerRating = ceil($this->Api_model->rating(array('buyer_id'=>$buyer_id,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);

                    $rating1 = !empty($sellerRating) ? $sellerRating : '0';
                    $rating2 = !empty($buyerRating) ? $buyerRating : '0';

                    $rating = $rating1 + $rating2;
                    
                    $buyerList=[ 
                    
                        'buyer_id'            => $userData->id,
                        'first_name'          => trim($userData->first_name),
                        'last_name'           => trim($userData->last_name),
                        'email'               => $userData->email,
                        'profile'             => $userData->profile_picture,
                        'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                        'mobile_country'      => $userData->mobile_country,
                        'phone_no'            => $userData->phone_no,
                        'is_email_verified'   => $userData->is_email_verified,
                        'is_mobile_verified'  => $userData->is_mobile_verified,
                        'address'             => $userData->address,
                        'about'               => $userData->about,
                        'skills'              => $userData->skills,
                        'language'            => $userData->language,
                        'rating'              => "$rating",
                        'live_status'         => $userData->live_status,
                        'last_visited'        => $userData->updated_at,
                        'join_date'           => $userData->created_at,
                        'orders_completed'    => '0'
    
                    ];
                    
                    if(!empty($gig_list->category_id))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $gig_list->category_id));
                        
                        $category   = $Details->category_name;
                        
                        $category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $category = '';
                        
                        $category_icon = '';
                    }
                    
                    if(!empty($gig_list->sub_category_id))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $gig_list->sub_category_id));
                        
                        $subcategory_name = $Details->category_name;
                        
                        $sub_category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $subcategory_name = '';
                        
                        $sub_category_icon = '';
                    }
                    
                    $image_list=array();
                    
                    $array = json_decode($gig_list->image);
                
                    $imageList = $array->image_list;
                    
                    $image_list=array();
                    
                    foreach ($imageList as $key => $value2) 
                    {
                        $image_list[]=[
                        
                            'image'     =>  $value2->type,
                            
                            'image_url' => $this->getImage($value2->thumnail,'gig_image'),
                        ];
                    }

                    $amountEarning[]=[
                    
                        'seller_id'=>$user_id,
                        
                        'buyer_details'=>$buyerList,       
                    
                        'order_id'=>$values['id'],
                        
                        'order_date'=>$values['created_at'],
                        
                        //'gig_id'=>$gig_list->id,
                        
                        'title'=>$gig_list->title,
                        
                        'category_id'=>$gig_list->category_id,
                        
                        'category_name'=>$category,
                        
                        'category_icon'=> $this->getImage($category_icon,'category_image'),
                
                        'sub_category_id'=>$gig_list->sub_category_id,
                    
                        'sub_category_name'=>$subcategory_name,
                    
                        'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                        
                        'image_list'=>$image_list,
                        
                        'price'=>$values['price'],
                        
                        'quantity'=>$values['quantity'],
                        
                        'deliverytime'=>$gig_list->delivery_time,
                        
                        'description'=>$gig_list->description,
                        
                        'shipping_price'=>$values['shipping_cost'],
                        
                        'total_cost'=>$values['final_cost']
                    ];
                }
                
                if($values['type']=='2')
                {
                    $requestid = $values['product_id'];
                    
                    $request_list=$this->Api_model->RequestList(array('id'=>$requestid))->row();
                    
                    $buyer_id  = $values['buyer_id'];
                    
                    $userData = $this->Api_model->get_where_row("app_user",array('id' => $buyer_id));

                    $sellerRating = ceil($this->Api_model->rating(array('seller_id'=>$buyer_id,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);

                    $buyerRating = ceil($this->Api_model->rating(array('buyer_id'=>$buyer_id,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);

                    $rating1 = !empty($sellerRating) ? $sellerRating : '0';
                    $rating2 = !empty($buyerRating) ? $buyerRating : '0';

                    $rating = $rating1 + $rating2;
                    
                    $buyerList=[ 
                    
                        'buyer_id'            => $userData->id,
                        'first_name'          => trim($userData->first_name),
                        'last_name'           => trim($userData->last_name),
                        'email'               => $userData->email,
                        'profile'             => $userData->profile_picture,
                        'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                        'mobile_country'      => $userData->mobile_country,
                        'phone_no'            => $userData->phone_no,
                        'is_email_verified'   => $userData->is_email_verified,
                        'is_mobile_verified'  => $userData->is_mobile_verified,
                        'address'             => $userData->address,
                        'about'               => $userData->about,
                        'skills'              => $userData->skills,
                        'language'            => $userData->language,
                        'rating'              => "$rating",
                        'live_status'         => $userData->live_status,
                        'last_visited'        => $userData->updated_at,
                        'join_date'           => $userData->created_at,
                        'orders_completed'    => '0'
    
                    ];
                    
                    if(!empty($request_list->category))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $request_list->category));
                        
                        $category   = $Details->category_name;
                        
                        $category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $category = '';
                        
                        $category_icon = '';
                    }
                    
                    if(!empty($request_list->subcategory))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $request_list->subcategory));
                        
                        $subcategory_name = $Details->category_name;
                        
                        $sub_category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $subcategory_name = '';
                        
                        $sub_category_icon = '';
                    }
                    
                    $imageList = explode(",",$request_list->image);
                    
                    $image_list=array();
                    
                    foreach ($imageList as $key => $value1) 
                    {
                        $image_list[]=[
                        
                            'image'     => $value1,
                            
                            'image_url' => $this->getImage($value1,'request_image')
                        ];
                    }
                    
                    $amountEarning[]=[
                    
                        'seller_id'=>$request_list->seller_id,
                        
                        'buyer_details'=>$buyerList,       
                    
                        'order_id'=>$values['id'],
                        
                        'order_date'=>$values['created_at'],
                        
                        //'request_id'=>$request_list->id,
                        
                        'title'=>'',
                        
                        'category_id'=>$request_list->category,
                        
                        'category_name'=>$category,
                        
                        'category_icon'=> $this->getImage($category_icon,'category_image'),
                
                        'sub_category_id'=>$request_list->subcategory,
                    
                        'sub_category_name'=>$subcategory_name,
                    
                        'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                        
                        'image_list'=>$image_list,
                        
                        'price'=>$values['price'],
                        
                        'quantity'=>$values['quantity'],
                        
                        'deliverytime'=>$request_list->deliverytime,
                        
                        'description'=>$request_list->description,
                        
                        'shipping_price'=>$values['shipping_cost'],
                        
                        'total_cost'=>$values['final_cost']
                    ];
                }
            }
            
            /*$gig_list=$this->Api_model->RequestList(array('seller_id'=>$user_id))->result_array();

            foreach ($gig_list as $key => $value)
            { 
                $buyer_id = $value['user_id'];
                
                $userData = $this->Api_model->get_where_row("app_user",array('id' => $buyer_id));
                    
                $buyerList=[ 
                
                    'buyer_id'            => $userData->id,
                    'first_name'          => trim($userData->first_name),
                    'last_name'           => trim($userData->last_name),
                    'email'               => $userData->email,
                    'profile'             => $userData->profile_picture,
                    'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                    'mobile_country'      => $userData->mobile_country,
                    'phone_no'            => $userData->phone_no,
                    'is_email_verified'   => $userData->is_email_verified,
                    'is_mobile_verified'  => $userData->is_mobile_verified,
                    'address'             => $userData->address,
                    'about'               => $userData->about,
                    'skills'              => $userData->skills,
                    'language'            => $userData->language,
                    'rating'              => '4',
                    'live_status'         => '1',
                    'join_date'           => $userData->created_at,

                ];
                
                
                if(!empty($value['category']))
                {
                    $Details    = $this->Api_model->get_where_row("category",array('id' => $value['category']));
                    
                    $category   = $Details->category_name;
                    
                    $category_icon = $Details->category_icon;
                }
                else
                {
                    $category = '';
                    
                    $category_icon = '';
                }
                
                if(!empty($value['subcategory']))
                {
                    $Details    = $this->Api_model->get_where_row("category",array('id' => $value['subcategory']));
                    
                    $subcategory_name = $Details->category_name;
                    
                    $sub_category_icon = $Details->category_icon;
                }
                else
                {
                    $subcategory_name = '';
                    
                    $sub_category_icon = '';
                }
                
                $imageList = explode(",",$value['image']);
                
                $image_list=array();
                
                foreach ($imageList as $key => $value1) 
                {
                    $image_list[]=[
                    
                        'image'     => $value1,
                        
                        'image_url' => $this->getImage($value1,'request_image')
                    ];
                }
                

                    $amountEarning[]=[
                    
                        'seller_id'=>$value['seller_id'],
                        
                        'buyer_details'=>$buyerList,       
                    
                        'title'=>$value['id'],
                        
                        'order_id'=>$value['id'],
                        
                        'order_date'=>$value['created_at'],
                        
                        'category_id'=>$value['category'],
                        
                        'category_name'=>$category,
                        
                        'category_icon'=> $this->getImage($category_icon,'category_image'),
    
                        'sub_category_id'=>$value['subcategory'],
                    
                        'sub_category_name'=>$subcategory_name,
                    
                        'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                        
                        'image_list'=>$image_list,
                        
                        'price'=>$value['price'],
                        
                        'quantity'=>$value['quantity'],
                        
                        'deliverytime'=>$value['deliverytime'],
                        
                        'description'=>$value['description'],
                        
                        'shipping_price'=>$value['price'],
                        
                        'total_cost'=>$value['price']
                    ];
                
                
                
            }*/
            
            $spendingDetails = $this->Api_model->OrderList(array('buyer_id'=>$user_id))->result_array();
            
            foreach ($spendingDetails as $key => $values)
            {
                if($values['type']=='1')
                {
                    $gigid    = $values['product_id'];
                    $gig_list = $this->Api_model->GigList(array('id'=>$gigid))->row();
                    $seller_id  = $values['seller_id'];
                    
                    $userData = $this->Api_model->get_where_row("app_user",array('id' => $seller_id));

                    $sellerRating = ceil($this->Api_model->rating(array('seller_id'=>$seller_id,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);

                    $buyerRating = ceil($this->Api_model->rating(array('buyer_id'=>$seller_id,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);

                    $rating1 = !empty($sellerRating) ? $sellerRating : '0';
                    $rating2 = !empty($buyerRating) ? $buyerRating : '0';

                    $rating = $rating1 + $rating2;
                    
                    $sellerList=[ 
                    
                        'seller_id'            => $userData->id,
                        'first_name'          => trim($userData->first_name),
                        'last_name'           => trim($userData->last_name),
                        'email'               => $userData->email,
                        'profile'             => $userData->profile_picture,
                        'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                        'mobile_country'      => $userData->mobile_country,
                        'phone_no'            => $userData->phone_no,
                        'is_email_verified'   => $userData->is_email_verified,
                        'is_mobile_verified'  => $userData->is_mobile_verified,
                        'address'             => $userData->address,
                        'about'               => $userData->about,
                        'skills'              => $userData->skills,
                        'language'            => $userData->language,
                        'rating'              => "$rating",
                        'live_status'         => $userData->live_status,
                        'last_visited'        => $userData->updated_at,
                        'join_date'           => $userData->created_at,
                        'orders_completed'    => '0'
    
                    ];
                    
                    if(!empty($gig_list->category_id))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $gig_list->category_id));
                        
                        $category   = $Details->category_name;
                        
                        $category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $category = '';
                        
                        $category_icon = '';
                    }
                    
                    if(!empty($gig_list->sub_category_id))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $gig_list->sub_category_id));
                        
                        $subcategory_name = $Details->category_name;
                        
                        $sub_category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $subcategory_name = '';
                        
                        $sub_category_icon = '';
                    }
                    
                    $image_list=array();
                    
                    $array = json_decode($gig_list->image);
                
                    $imageList = $array->image_list;
                    
                    $image_list=array();
                    
                    foreach ($imageList as $key => $value2) 
                    {
                        $image_list[]=[
                        
                            'image'     =>  $value2->type,
                            
                            'image_url' => $this->getImage($value2->thumnail,'gig_image'),
                        ];
                    }
                    
                    $amountSpending[]=[
                    
                        'buyer_id'=>$user_id,
                        
                        'seller_details'=>$sellerList,    
                    
                        'order_id'=>$values['id'],
                        
                        'order_date'=>$values['created_at'],
                        
                        //'gig_id'=>$gig_list->id,
                        
                        'title'=>$gig_list->title,
                        
                        'category_id'=>$gig_list->category_id,
                        
                        'category_name'=>$category,
                        
                        'category_icon'=> $this->getImage($category_icon,'category_image'),
                
                        'sub_category_id'=>$gig_list->sub_category_id,
                    
                        'sub_category_name'=>$subcategory_name,
                    
                        'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                        
                        'image_list'=>$image_list,
                        
                        'price'=>$values['price'],
                        
                        'quantity'=>$values['quantity'],
                        
                        'deliverytime'=>$gig_list->delivery_time,
                        
                        'description'=>$gig_list->description,
                        
                        'shipping_price'=>$values['shipping_cost'],
                        
                        'total_cost'=>$values['final_cost']
                    ];
                    
                }
                
                if($values['type']=='2')
                {
                    $requestid = $values['product_id'];
                    
                    $request_list=$this->Api_model->RequestList(array('id'=>$requestid))->row();
                    
                    $buyer_id  = $values['buyer_id'];
                    
                    $userData = $this->Api_model->get_where_row("app_user",array('id' => $buyer_id));

                    $sellerRating = ceil($this->Api_model->rating(array('seller_id'=>$buyer_id,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);

                    $buyerRating = ceil($this->Api_model->rating(array('buyer_id'=>$buyer_id,'buyer_rating!='=>'0'),'avg(buyer_rating) as rating')->row()->rating);

                    $rating1 = !empty($sellerRating) ? $sellerRating : '0';
                    $rating2 = !empty($buyerRating) ? $buyerRating : '0';

                    $rating = $rating1 + $rating2;
                    
                    $buyerList=[ 
                    
                        'buyer_id'            => $userData->id,
                        'first_name'          => trim($userData->first_name),
                        'last_name'           => trim($userData->last_name),
                        'email'               => $userData->email,
                        'profile'             => $userData->profile_picture,
                        'profile_image_url'   => $this->getImage($userData->profile_picture,'profile_image'),
                        'mobile_country'      => $userData->mobile_country,
                        'phone_no'            => $userData->phone_no,
                        'is_email_verified'   => $userData->is_email_verified,
                        'is_mobile_verified'  => $userData->is_mobile_verified,
                        'address'             => $userData->address,
                        'about'               => $userData->about,
                        'skills'              => $userData->skills,
                        'language'            => $userData->language,
                        'rating'              => "$rating",
                        'live_status'         => $userData->live_status,
                        'last_visited'        => $userData->updated_at,
                        'join_date'           => $userData->created_at,
                        'orders_completed'    => '0'
    
                    ];
                    
                    if(!empty($request_list->category))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $request_list->category));
                        
                        $category   = $Details->category_name;
                        
                        $category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $category = '';
                        
                        $category_icon = '';
                    }
                    
                    if(!empty($request_list->subcategory))
                    {
                        $Details    = $this->Api_model->get_where_row("category",array('id' => $request_list->subcategory));
                        
                        $subcategory_name = $Details->category_name;
                        
                        $sub_category_icon = $Details->category_icon;
                    }
                    else
                    {
                        $subcategory_name = '';
                        
                        $sub_category_icon = '';
                    }
                    
                    $imageList = explode(",",$request_list->image);
                    
                    $image_list=array();
                    
                    foreach ($imageList as $key => $value1) 
                    {
                        $image_list[]=[
                        
                            'image'     => $value1,
                            
                            'image_url' => $this->getImage($value1,'request_image')
                        ];
                    }

                    $amountSpending[]=[
                    
                        'buyer_id'=>$user_id,
                        
                        'seller_details'=>$sellerList,     
                    
                        'order_id'=>$values['id'],
                        
                        'order_date'=>$values['created_at'],
                        
                        //'request_id'=>$request_list->id,
                        
                        'title'=>'',
                        
                        'category_id'=>$request_list->category,
                        
                        'category_name'=>$category,
                        
                        'category_icon'=> $this->getImage($category_icon,'category_image'),
                
                        'sub_category_id'=>$request_list->subcategory,
                    
                        'sub_category_name'=>$subcategory_name,
                    
                        'sub_category_icon'=> $this->getImage($sub_category_icon,'category_image'),
                        
                        'image_list'=>$image_list,
                        
                        'price'=>$values['price'],
                        
                        'quantity'=>$values['quantity'],
                        
                        'deliverytime'=>$request_list->deliverytime,
                        
                        'description'=>$request_list->description,
                        
                        'shipping_price'=>$values['shipping_cost'],
                        
                        'total_cost'=>$values['final_cost']
                    ];
                }
            }
              
            $data['status'] = "1";            
            $data['message']="Success";
            
            $data['amount_earning']  = $amountEarning;            
            $data['amount_spending'] = $amountSpending;
        
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;    
    }
    
    function walletList()
    {
        $user_id=$this->input->post('user_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
            $data['status']="0";            
            $data['message']="User not Found";
        }
        else
        {
            $details=$this->Api_model->WalletList(array('order_status'=>5,'seller_id'=>$user_id,'wallet_status'=>'0'))->result_array(); 
            
            $final_cost = 0;
            
            foreach ($details as $key => $value) 
            {
                $final_cost += !empty($value['final_cost']) ? $value['final_cost'] : '0';
            }
            
            $data['status']        = "1";
            $data['message']       = "Success";
            $data['amount_earned'] = "$final_cost";
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    function withdraw()
    {
        $user_id=$this->input->post('user_id');
        
        $this->formValidation("User Id",$user_id,"required");
        
        $check_user=(array) $this->getUserDetails("id='$user_id'");
        
        if(empty($check_user))
        {
            $data['status']="0";            
            $data['message']="User not Found";
        }
        else
        {
            $details=$this->Api_model->WalletList(array('order_status'=>5,'seller_id'=>$user_id,'wallet_status'=>'0'))->result_array();
            
            if(!empty($details))
            {
                foreach ($details as $key => $value) 
                {
                    $Data=array(
                    
                        'wallet_status'=>'1',                        
                        'updated_at'=>date('Y-m-d H:i:s')
                    );
                    
                    $this->Api_model->Orders(array('seller_id'=>$user_id),$Data);
                }
                
                $data['status']        = "1";
                $data['message']       = "Wallet amount is debited successfully ";
            }
            else
            {
                $data['status']        = "2";
                $data['message']       = "Insufficient wallet amount";
            }
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }

    //=========================== Buyer Time Accepted Rejected ===============================//

    function buyertimeAccept()
    {
        $user_id     = $this->input->post('user_id');
        $order_id    = $this->input->post('order_id');
        $status      = $this->input->post('status');

        $this->formValidation("User Id",$user_id,"required");
        $this->formValidation("Order Id",$order_id,"required");
        $this->formValidation("Status",$status,"required");
    
         $check_now = $this->Api_model->OrderList(array('buyer_id='=>$user_id,'id'=>$order_id))->row();
    
        if(empty($check_now))
        {
            $data['status']="0";
            $data['message']="Record not found";
        }
        else
        {

            $seller_id = $check_now->seller_id;
            $orderStatus = $check_now->order_status;

            if($status==2)
            {
                $Data=array(   
                
                    'time_status'=>'2',                    
                    'updated_at'=>date('Y-m-d H:i:s')
                );
        
                if($request_id=$this->Api_model->Orders(array('id'=>$order_id,'buyer_id'=>$user_id),$Data))
                {
                    $data['status']="1";                    
                    $data['message']="Accepted Successfully";

                    $this->prepreFcm('timeSelleraccept',array('user_id'=>$seller_id,'order_id'=>$order_id,'status'=>$orderStatus));
                }
                else
                {
                    $data['status']="0";                    
                    $data['message']="Something went wrong";
                }
            }
            
            if($status==3)
            {
                $Data=array(   
                
                    'time_status'=>'3',                    
                    'updated_at'=>date('Y-m-d H:i:s')
                
                );
                
                if($request_id=$this->Api_model->Orders(array('id'=>$order_id,'buyer_id'=>$user_id),$Data))
                {
                    $data['status']="1";                    
                    $data['message']="Rejected Successfully";

                    $this->prepreFcm('timeSellerreject',array('user_id'=>$seller_id,'order_id'=>$order_id,'status'=>$orderStatus));
                }
                else
                {
                    $data['status']="0";                    
                    $data['message']="Something went wrong";
                }
            }
        }
    
        header( 'Content-type:application/json');
        print json_encode( $data);    
        exit; 
    }

    //=========================== Time Extensions ===============================//

    function timeExtensions()
    {
        $user_id     = $this->input->post('user_id');
        $order_id    = $this->input->post('order_id');
        //$gig_id      = $this->input->post('gig_id');
        $delivery    = $this->input->post('delivery_time');
        $description = $this->input->post('description');

        $this->formValidation("User Id",$user_id,"required");
        $this->formValidation("Order Id",$order_id,"required");
        //$this->formValidation("Gig Id",$gig_id,"required");
        $this->formValidation("Delivery Time",$delivery,"required");
        $this->formValidation("Description",$description,"required");
    
        $check_now = $this->Api_model->OrderList(array('seller_id='=>$user_id,'id'=>$order_id))->row();
    
        if(empty($check_now))
        {
            $data['status']="0";
            $data['message']="Record not found";
        }
        else
        {
            $buyer_id    = $check_now->buyer_id;
            $orderStatus = $check_now->order_status;

            $Data=array(   
            
                'time_extension'   => $delivery,
                'time_description' => $description,
                'time_status'      => '1',                
                'updated_at'       => date('Y-m-d H:i:s')
            );
    
            if($this->Api_model->Orders(array('id'=>$order_id),$Data))
            {
                $data['status']="1";                
                $data['message']="Time Extension Requested";

                $this->prepreFcm('timeBuyerrequest',array('user_id'=>$buyer_id,'order_id'=>$order_id,'status'=>$orderStatus));
            }
            else
            {
                $data['status']="0";                
                $data['message']="Something went wrong";
            }            
        }
    
        header( 'Content-type:application/json');
        print json_encode( $data);    
        exit; 
    }

    //=========================== Notification Count ===============================//

    function notificationCount()
    {
        $user_id     = $this->input->post('user_id');

        $this->formValidation("User Id",$user_id,"required");

        $check_user=(array) $this->getUserDetails("id='$user_id'");

        if(!empty($check_user))
        {
            $this->checkAccountStatus($user_id);

            $notification_count=$this->Api_model->get_count('notifications',array('user_id'=>$user_id ,'read_status'=>'0'));
            
            $data['status']="1";            
            $data['message']="Success";
            
            $data['user_id']=$user_id;
            $data['unread_notification_count']="$notification_count";     
        }
        else
        {
            $data['status']="0";            
            $data['message']="User Doesnot Exist";
        }

        header( 'Content-type:application/json');
        print json_encode( $data);    
        exit; 
    }

    //=========================== Notification Update ===============================//

    function notificationUpdate()
    {
        $user_id     = $this->input->post('user_id');

        $this->formValidation("User Id",$user_id,"required");

        $check_user=(array) $this->getUserDetails("id='$user_id'");

        if(!empty($check_user))
        {
            $this->checkAccountStatus($user_id);

           $userData=array(
                
                'read_status'  => "1",                
            );
            
            $update_where = array('user_id'=> $user_id);
            
            if($this->Api_model->update('notifications',$userData,$update_where))
            {
                $data['status']="1";                
                $data['message']="Notifications Updated Successfully";         
            }
            else
            {
                $data['status']="0";                    
                $data['message']="Something went wrong";
            }      
        }
        else
        {
            $data['status']="0";            
            $data['message']="User Doesnot Exist";
        }

        header( 'Content-type:application/json');
        print json_encode( $data);    
        exit; 
    }
}