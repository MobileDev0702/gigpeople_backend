<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{
    
    protected $data = Array(); //protected variables goes here its declaration
    
    public function __construct()
    {
        parent::__construct();          
        $this->load->helper('url');        
        $this->load->library('email');        
        $this->load->library('session');
        $this->load->model('Admin_model');
        $this->load->model('Api_model');
    }
    
    function adminDetails()
    {
        $admin_details=$this->Admin_model->getAdminDetails(array('admin_id'=>'1'))->row();
        
        return $admin_details;
    }

    function getCategory($parent_category_id)
    {
        $details=$this->Admin_model->getSubCategory(array('id='=>$parent_category_id,'category_status!='=>'2'))->row();
        
        if(!empty($details))
        {
            $category_name=$details->category_name;
        }
        else
        {
            $category_name="";
        }
        
        return $category_name;
    }
    
    function getSubCategory($parent_category_id)
    {
        $category_details=$this->Admin_model->getSubCategory(array('id='=>$parent_category_id,'category_status!='=>'2'))->row();
        
        if(!empty($category_details))
        {
            $category_name=$category_details->category_name;
        }
        else
        {
            $category_name="";
        }
        return $category_name;
    }

    function getCategories($parent_category_id)
    {
        $details=$this->Admin_model->getSubCategory(array("id"=>$parent_category_id))->row();
        
        return $details;
    }
    
    function getUserDetails($id)
    {
        $user_details=$this->Admin_model->getUserList(array("id"=>$id))->row();
        
        return $user_details;
    }
    
    function getGig($id)
    {
    	return $this->Admin_model->getgiglist(array("id"=>$id))->row();
    }
    
    function getRequest($id)
    {
    	return $this->Admin_model->RequestList(array("id"=>$id))->row();
    }

    function checkAccountStatus($user_id)
    {
        $user_details= (array) $this->getUserDetails(array("id"=>$user_id));
        
        $account_status=$user_details['account_status'];
        
        if($account_status==0)//active
        {
            return true;
        }
        else //not active
        {
            $data['status']="2";
            
            $data['message']="Your Account was not Active";
        }
        
        header( 'Content-type:application/json');
        
        print json_encode( $data);
        
        exit;
    }
    
    function formValidation($field_name,$field,$type)
    {
        if($type=="required")
        {
            if($field=="")
            {
                $data['status']="0";
                
                $data['message']=$field_name ." is ".$type;
                
                header( 'Content-type:application/json');
                
                print json_encode( $data);
                
                exit;
            }
        }
        
        if($type=="missing")
        {
            if(!isset($field))
            {
                $data['status']="0";
                
                $data['message']=$field_name ." is ".$type;
                
                print json_encode( $data);
                
                exit;
            }
        }
    }

    function doUpload()
    {
        $file_type=$this->input->post('file_type');
        
        if(!empty($_FILES["file_name"]) && $_FILES["file_name"]["error"] == UPLOAD_ERR_OK)
        {
            $profile_image_path=explode("-",$this->imagePath($file_type))[0];

            $profile_image_url=explode("-",$this->imagePath($file_type))[1];

            $new_name=strtotime(date('Y-m-d'));
                    
            $config = array(

                'upload_path' => $profile_image_path,

                'allowed_types' => '*',

                'file_name'=>$new_name
            );

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if(!$this->upload->do_upload('file_name'))
            {
                $result['status']='0';

                $result['message']=$this->upload->display_errors();                              
            }
            else
            {

                $datas = array('upload_data' => $this->upload->data());

                $result['file_url']=$profile_image_url.$datas['upload_data']['file_name'];

                $result['file_name']=$datas['upload_data']['file_name'];

                $result['status']='1';

                $result['message']='Success';

            }
        }
        else
        {
            $result['status']='0';
            
            $result['message']='Please select an image to upload first.!!!';  
        }
        
        header( 'Content-type:application/json');
        print json_encode( $result);
        exit;
    }
    
    function imagePath($type)
    { 
        if($type=="profile_image")
        {
            $profile_image_path=".".$this->config->item('profile_url');

            $profile_image_url=base_url().$this->config->item('profile_url');
        }
        
        if($type=="banner_images")
        {
            $profile_image_path=".".$this->config->item('banner_url');

            $profile_image_url=base_url().$this->config->item('banner_url');
        }
        
        if($type=="category_image")
        {
            $profile_image_path=".".$this->config->item('category_url');

            $profile_image_url=base_url().$this->config->item('category_url');
        }
        
        if($type=="request_image")
        {
            $profile_image_path=".".$this->config->item('request_url');

            $profile_image_url=base_url().$this->config->item('request_url');
        }
        
        if($type=="gig_image")
        {
            $profile_image_path=".".$this->config->item('gig_url');

            $profile_image_url=base_url().$this->config->item('gig_url');
        }
        
        if($type=="project")
        {
            $profile_image_path=".".$this->config->item('project_url');

            $profile_image_url=base_url().$this->config->item('project_url');
        }
        
        return $profile_image_path."-".$profile_image_url;
     }

    function getImage($image_name,$type)
    {
        if(trim($image_name)!="")
        {
            $profile_image_path=explode("-",$this->imagePath($type))[0];

            $profile_image_url=explode("-",$this->imagePath($type))[1];

            $image_exits  = $profile_image_path."/".$image_name;

            if(file_exists($image_exits)) 
            {
                $file_url = $profile_image_url.$image_name;
            }
            else 
            {
                $file_url = '';
            }
        }
        else
        {
            if($type=="profile_image")
            {
                 $file_url="";
            }
            
            if($type=="banner_images")
            {
                $file_url="";
            }

            if($type=="category_image")
            {
                $file_url="";
            }
            
            if($type=="request_image")
            {
                $file_url="";
            }
            
            if($type=="gig_image")
            {
                $file_url="";
            }
            if($type=="project")
            {
                $file_url="";
            }
        }

        return  $file_url;
    }

    function fileUploadError($erro_no)
    {
        if($erro_no==0)
        {
            $message="There is no error, the file uploaded with success";
        }
        else if($erro_no==1)
        {
            $message="The uploaded file exceeds the upload_max_filesize directive in php.ini";
        }
        else if($erro_no==2)
        {
            $message="The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
        }
        else if($erro_no==3)
        {
            $message="The uploaded file was only partially uploaded";
        }
        else if($erro_no==4)
        {
            $message="No file was uploaded";
        }
        else if($erro_no==5)
        {
            $message="Undefined Error";
        }
        else if($erro_no==6)
        {
            $message="Missing a temporary folder";
        }
        else if($erro_no==7)
        {
            $message="Failed to write file to disk.";
        }
        else if($erro_no==8)
        {
              $message="A PHP extension stopped the file upload.";
        }
        else
        {
              $message="Undefined Error";
        }

        return $message;
    }
    
    function welcomeMail($user_id)
    {
        $user_details=(array) $this->getUserDetails(array("id"=>$user_id));
        
        $first_name=$user_details['first_name'];
        
        $last_name=$user_details['last_name'];
        
        $to_email=$user_details['email'];
        
        $to_name=$first_name." ".$last_name;
        
        $subject="Welcome to Gig People"; 

                   $body='<center>
          <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="m_8071217944691516924backgroundTable" style="background-color:#f3f3f3;padding-left:10px;padding-right:10px">
              <tbody><tr>
                  <td align="center" valign="top">
                      <table border="0" cellpadding="0" cellspacing="0" id="m_8071217944691516924templateContainer" style="border:none;margin-top:20px;width:100%;max-width:600px">
                          <tbody><tr>
                              <td align="center" valign="top">
                                    
                                  <table border="0" cellpadding="0" cellspacing="0" id="m_8071217944691516924templateHeader" style="background-color:#fff;max-width:600px;width:100%">
                                        <tbody><tr>
                                            <td class="m_8071217944691516924headerContent" align="center">
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                          <tr>
                              <td align="center" valign="top">
                                   
                                  <table border="0" cellpadding="0" cellspacing="0" id="m_8071217944691516924templateBody" style="background-color:#fff;padding-top:0px;max-width:600px;width:100%">
                                      <tbody><tr>
                                            <td valign="top" class="m_8071217944691516924bodyContent">

                                                
                                                <table border="0" cellpadding="20" cellspacing="0" style="max-width:600px;width:100%">
                                                    <tbody>
                                                    <tr>
                                                    <td class="padding" align="center">
                                                    <img src="cid:logo" width="100" height="100">
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <div><h1 style="text-align:center;color:#444;font-size:26px">Gig People</h1><p style="text-align:center;font-size:15px"></p><hr style="border:1px solid #ccc;border-top:none;margin:30px 0 28px"><p>Hi, '.$to_name.'!</p><p>Welcome to Gig People ! Thank you for Signup with us .
                                                                                    
                                                            <p>Sincerely,<br> Gig People</p><hr style="border:1px solid #ccc;border-top:none;margin:30px 0 28px"></div>
                            </td>
                                                    </tr>
                                                </tbody></table>
                                                

                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                          <tr>
                              <td align="center" valign="top">
                                    
                                    <table border="0" cellpadding="10" cellspacing="0" id="m_8071217944691516924templateFooter" style="background-color:#fff;border-bottom-right-radius:3px;border-bottom-left-radius:3px;max-width:600px;width:100%">
                                      <tbody><tr>
                                          <td valign="top" class="m_8071217944691516924footerContent">
                                                
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%">

                                                    <tbody><tr>
                                                        <td valign="top">
                                                            <div><div class="m_8071217944691516924email-footer-wrapper" style="background-color:#f9f9f9;text-align:center;padding:20px;border-bottom-left-radius:3px;border-bottom-right-radius:3px">Copyright © 2019 Gig People, All rights reserved. Our mailing address is: <a href="mailto:'.$this->adminDetails()->support_email.'" target="_blank">'.$this->adminDetails()->support_email.'</a>.<div class="m_8071217944691516924footer-inner-wrapper"><div class="m_8071217944691516924powered-by-tithely" align="center" style="text-align:center;padding-top:8px"><a href="#" target="_blank" data-saferedirecturl=""></a><br></div></div></div></div>
                                                        </td>
                                                    </tr>

                                                </tbody></table> 
                                            </td>
                                        </tr>
                                    </tbody></table>

                                </td>
                            </tr>
                        </tbody></table>
                        <br>
                    </td>
                </tr>
            </tbody></table>
        </center>';
        
       //echo $body;
      
       //exit;
        
        $sender_email = $this->adminDetails()->support_email;//india2018
        
        $sender_name = "Gig People";
        
        return $this->mail_sending($to_email,$to_name,$subject,$body,$sender_email,$sender_name);  
    }

    function sendmail($to_email,$to_name,$password)
    {
           
        $subject="Gig People - New Password"; 

                  //$body='Your New password is  '.$content;
                  
                   $body='<center>
          <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="m_8071217944691516924backgroundTable" style="background-color:#f3f3f3;padding-left:10px;padding-right:10px">
              <tbody><tr>
                  <td align="center" valign="top">
                      <table border="0" cellpadding="0" cellspacing="0" id="m_8071217944691516924templateContainer" style="border:none;margin-top:20px;width:100%;max-width:600px">
                          <tbody><tr>
                              <td align="center" valign="top">
                                    
                                  <table border="0" cellpadding="0" cellspacing="0" id="m_8071217944691516924templateHeader" style="background-color:#fff;max-width:600px;width:100%">
                                        <tbody><tr>
                                            <td class="m_8071217944691516924headerContent" align="center">
                                            
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                          <tr>
                              <td align="center" valign="top">
                                   
                                  <table border="0" cellpadding="0" cellspacing="0" id="m_8071217944691516924templateBody" style="background-color:#fff;padding-top:0px;max-width:600px;width:100%">
                                      <tbody><tr>
                                            <td valign="top" class="m_8071217944691516924bodyContent">

                                                
                                                <table border="0" cellpadding="20" cellspacing="0" style="max-width:600px;width:100%">
                                                    <tbody>
                                                    <tr>
                                                    <td class="padding" align="center">
                                                    <img src="cid:logo" width="100" height="100">
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top">
                                                            <div><h1 style="text-align:center;color:#444;font-size:26px">Gig People</h1><p style="text-align:center;font-size:15px"></p><hr style="border:1px solid #ccc;border-top:none;margin:30px 0 28px"><p>Hi, '.$to_name.'!</p><p>Your new password is  : '.$password.'  .You can use it to login and reset your password in settings.

                                                            <p>Sincerely,<br> Gig People</p><hr style="border:1px solid #ccc;border-top:none;margin:30px 0 28px"></div>
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                                

                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                          <tr>
                              <td align="center" valign="top">
                                    
                                    <table border="0" cellpadding="10" cellspacing="0" id="m_8071217944691516924templateFooter" style="background-color:#fff;border-bottom-right-radius:3px;border-bottom-left-radius:3px;max-width:600px;width:100%">
                                      <tbody><tr>
                                          <td valign="top" class="m_8071217944691516924footerContent">

                                                
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%">

                                                    <tbody><tr>
                                                        <td valign="top">
                                                            <div><div class="m_8071217944691516924email-footer-wrapper" style="background-color:#f9f9f9;text-align:center;padding:20px;border-bottom-left-radius:3px;border-bottom-right-radius:3px">Copyright © 2019 Gig People, All rights reserved. Our mailing address is: <a href="mailto:'.$this->adminDetails()->support_email.'" target="_blank">'.$this->adminDetails()->support_email.'</a>.<div class="m_8071217944691516924footer-inner-wrapper"><div class="m_8071217944691516924powered-by-tithely" align="center" style="text-align:center;padding-top:8px"><a href="#" target="_blank" data-saferedirecturl=""></a><br></div></div></div></div>
                                                        </td>
                                                    </tr>

                                                </tbody></table>
                                                

                                            </td>
                                        </tr>
                                    </tbody></table>
                                    

                                </td>
                            </tr>
                        </tbody></table>
                        <br>
                    </td>
                </tr>
            </tbody></table>
        </center>';
        
       //echo $body;
      
       //exit;

        $sender_email = $this->adminDetails()->support_email;//india2018
        
        $sender_name = "Gig People";
        
        return $this->mail_sending($to_email,$to_name,$subject,$body,$sender_email,$sender_name);     
            
    }

    function feedbackMail($from_name,$from_email_id,$feedback)
    {
        $sender_email = $from_email_id;//india2018
        
        $sender_name = $from_name;
        
        $subject="Gig People - Feedback from app users"; 
        
        $body=$feedback;
        
        //$to_email = "noreply.backend.development@gmail.com";//india2018
        
        $to_email=$this->adminDetails()->support_email;
        
        $to_name = "Gig People";
        
        return $this->mail_sending($to_email,$to_name,$subject,$body,$sender_email,$sender_name);
    }

    function mail_sending($recipient_email,$recipient_name,$subject,$body,$sender_email,$sender_name)
    {
        include APPPATH . 'third_party/mailing/class.phpmailer.php';
        
        $mail = new PHPMailer;
        
        $mail->isSendmail();
        
        $mail->setFrom($sender_email,$sender_name);
        
        $mail->addCustomHeader('X-custom-header',$sender_name);
        
        $mail->From = $sender_email;
        
        $mail->FromName = $sender_name;
        
        $mail->AddEmbeddedImage('assets_backend/images/logo/applogo1.png','logo'); 
        
        $mail->addAddress($recipient_email,$recipient_name);
        
        $mail->addReplyTo($sender_email,"Reply");
        
        $mail->isHTML(true);
        
        $mail->Subject = $subject;
        
        $mail->Body =$body;       
        
        if($mail->send()) 
        {
            return true;
            //echo "ok";
        }
        else
        {
            return false;
            //echo $mail->ErrorInfo;
        }
        //exit;
    }
    
    function prepreFcm($fcm_type,$fcm_data)
    {
        if($fcm_type=="signup")
        {
            $user_id=$fcm_data['user_id'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Account Confirmation";
            
            $body= "Welcome to Gig People !!!";
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>'0',
                
                'created_at'=>date('Y-m-d H:i:s')
            
            );
            
            $this->Api_model->addNotification($notificationData);
        }
    
        if($fcm_type=="gigadd") 
        { 
            $user_id=$fcm_data['user_id'];

            $gig_id=$fcm_data['gig_id'];

            $status=$fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Gig Added";
            
            $body= "You have added a new gig";

            $notstatus = '2-'.$gig_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }
        
        if($fcm_type=="gigpublish") 
        {
            $user_id=$fcm_data['user_id'];

            $gig_id=$fcm_data['gig_id'];

            $status=$fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Gig Published";
            
            $body= "You have published a new gig";

            $notstatus = '2-'.$gig_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }
        
        if($fcm_type=="requestadd") 
        {
            $user_id     = $fcm_data['user_id'];
            $subcategory = $fcm_data['subcategory'];

            $user_details=$this->Api_model->gigsellerlist(array('gig_list.user_id!='=>$user_id,'gig_list.sub_category_id'=>$subcategory,'gig_list.status'=>'2'))->result_array();
            
            //$user_details=$this->Api_model->getUserDetails(array('id!='=>$user_id))->result_array();

            $details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();

            $name = $details->first_name." ".$details->last_name;

            foreach ($user_details as $key => $value2) 
            {
                $userid = $value2['user_id'];

                //$userid=$value2['id'];

                $user_type=$value2['user_type'];
                
                $device_type=$value2['device_type'];
                
                $device_token=$value2['device_token'];
                
                $notification=$value2['notification'];
                
                $title="Gig Request";
                
                $body= "New gig request received from #".$name;
                
                if($device_type!="" && $device_token!="" && $notification==1)
                {
                    $this->callFCM($device_token,$device_type,$title,$body,'1');
                }
                
                $notificationData=array(
                
                    'user_id'=>$userid,
                    
                    'title'=>$title,
                    
                    'body'=>$body,

                    'status'=>'1',
                    
                    'created_at'=>date('Y-m-d H:i:s')
                );
                
                $this->Api_model->addNotification($notificationData);
            }
        }

        if($fcm_type=="offerreceived") 
        {
            $user_id=$fcm_data['user_id'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Offer Received";
            
            $body= "New Offer Received";
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,'3');
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>'3',
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="offerrejectedbuyer") 
        {
            $user_id=$fcm_data['user_id'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Offer Rejected";
            
            $body= "Seller Offer Rejected";
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,'1');
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>'1',
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="offerrejectedseller") 
        {
            $user_id=$fcm_data['user_id'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Offer Rejected";
            
            $body= "Your offer rejected by buyer";
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,'1');
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>'1',
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="offeracceptedbuyer") 
        {
            $user_id=$fcm_data['user_id'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Offer Accepted";
            
            $body= "Offer Accepted";
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,'3');
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>'3',
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="offeracceptedseller") 
        {
            $user_id=$fcm_data['user_id'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Offer Accepted";
            
            $body= "Your offer accepted";
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,'7');
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>'7',
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }
        
        if($fcm_type=="rejected") 
        {
            $user_id=$fcm_data['user_id'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Request Rejected";
            
            $body= "Your gig request rejected";
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,'4');
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>'4',
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }
        
        if($fcm_type=="accepted") 
        {
            $user_id=$fcm_data['user_id'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Request Accepted";
            
            $body= "Your gig request accepted";
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,'4');
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>'4',
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="buyercart") 
        {
            $user_id=$fcm_data['user_id'];
            
            $order_id=$fcm_data['order_id'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Order Placed";
            
            $body= "New Order Placed #".$order_id;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,'4');
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>'4',
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="sellercart") 
        {
            $user_id=$fcm_data['user_id'];
            
            $order_id=$fcm_data['order_id'];
            
            $buyer_id =$fcm_data['buyer_id'];
            
            $Buyer=$this->Api_model->getUserDetails(array('id'=>$buyer_id))->row();
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Order Received";
            
            $body= $Buyer->first_name.' '.$Buyer->last_name." has placed the order #".$order_id;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,'7');
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>'7',
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="orderreview") 
        {
            $user_id=$fcm_data['user_id'];

            $order_id = $fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Gig Rating";
            
            $body= "You have received a feedback on order";

            $notstatus = '2-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="sellerreview") 
        {
            $user_id=$fcm_data['user_id'];

            $seller_id=$fcm_data['seller_id'];

            $order_id = $fcm_data['order_id'];

            $status   = $fcm_data['status'];

            $details=$this->Api_model->getUserDetails(array('id'=>$seller_id))->row();

            $name = $details->first_name." ".$details->last_name;
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="User Rating";
            
            $body= "You received review from #".$name;

            $notstatus = '4-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="buyerreview") 
        {
            $user_id=$fcm_data['user_id'];

            $buyer_id=$fcm_data['buyer_id'];

            $order_id = $fcm_data['order_id'];

            $status   = $fcm_data['status'];

            $details=$this->Api_model->getUserDetails(array('id'=>$buyer_id))->row();

            $name = $details->first_name." ".$details->last_name;
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="User Rating";
            
            $body= "You received review from #".$name;

            $notstatus = '7-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }
       
        if($fcm_type=="deliveredrecived") 
        {
            $user_id=$fcm_data['user_id'];

            $order_id=$fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Order Delivered";
            
            $body= "Order has been successfully delivered #".$order_id;

            $notstatus = '4-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="timeBuyerrequest") 
        {
            $user_id=$fcm_data['user_id'];

            $order_id = $fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Time Requested";
            
            $body= "Seller requested time extension on your order";

            $notstatus = '4-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="timeSellerreject") 
        {
            $user_id=$fcm_data['user_id'];

            $order_id = $fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Time Request Rejected";
            
            $body= "Your time request rejected";

            $notstatus = '7-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="timeSelleraccept") 
        {
            $user_id=$fcm_data['user_id'];

            $order_id = $fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Time Request Accepted";
            
            $body= "Your time request accepted";

            $notstatus = '7-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }
                
        if($fcm_type=="chatsent") 
        {
            $user_id      = $fcm_data['user_id'];
            $from_user_id = $fcm_data['from_user_id'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();

            $details=$this->Api_model->getUserDetails(array('id'=>$from_user_id))->row();

            $name = $details->first_name." ".$details->last_name;
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Message received";
            
            $body= "New message received from #".$name;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,'6');
            }  
        }        
        
        if($fcm_type=="Sellercancelrequest") 
        {
            $user_id=$fcm_data['user_id'];
            
            $order_id=$fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Cancel Request";
            
            $body= "Order cancel request Received #".$order_id;

            $notstatus = '4-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }
        
        if($fcm_type=="cancelBuyeraccept") 
        {
            $user_id=$fcm_data['user_id'];
            
            $order_id=$fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Cancel Request";
            
            $body= "Order cancel request accepted #".$order_id;

            $notstatus = '4-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }
        
        if($fcm_type=="cancelBuyerreject") 
        {
            $user_id=$fcm_data['user_id'];
            
            $order_id=$fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Cancel Request";
            
            $body= "Order cancel request rejected #".$order_id;

            $notstatus = '4-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="Buyercancelrequest") 
        {
            $user_id=$fcm_data['user_id'];
            
            $order_id=$fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Cancel Request";
            
            $body= "Order cancel request Received #".$order_id;

            $notstatus = '7-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }
        
        if($fcm_type=="cancelSelleraccept") 
        {
            $user_id=$fcm_data['user_id'];
            
            $order_id=$fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Cancel Request";
            
            $body= "Order cancel request accepted #".$order_id;

            $notstatus = '7-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }
        
        if($fcm_type=="cancelSellerreject") 
        {
            $user_id=$fcm_data['user_id'];
            
            $order_id=$fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Cancel Request";
            
            $body= "Order cancel request rejected #".$order_id;

            $notstatus = '7-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }       

        if($fcm_type=="sellerrmsg") 
        {
            $user_id  = $fcm_data['user_id'];

            $order_id = $fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="New Comment";
            
            $body= "You have a new comment on your order";

            $notstatus = '4-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="buyerrmsg") 
        {
            $user_id  = $fcm_data['user_id'];

            $order_id = $fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="New Comment";
            
            $body= "You have a new comment on your order";

            $notstatus = '7-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="orderrevision") 
        {
            $user_id=$fcm_data['user_id'];

            $order_id = $fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="New Revision";
            
            $body= "Buyer requested revision on the order";

            $notstatus = '7-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }       

        if($fcm_type=="revisionSelleraccept") 
        {
            $user_id=$fcm_data['user_id'];
            
            $order_id=$fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Revision Accepted";
            
            $body= "Your revision request accepted #".$order_id;

            $notstatus = '4-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="revisionSellerreject") 
        {
            $user_id=$fcm_data['user_id'];
            
            $order_id=$fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Revision Rejected";
            
            $body= "Your revision request rejected #".$order_id;

            $notstatus = '4-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="sellerdispute") 
        {
            $user_id=$fcm_data['user_id'];

            $order_id=$fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Order Dispute";
            
            $body= "Your Order is disputed #".$order_id;

            $notstatus = '4-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }

        if($fcm_type=="buyerdispute") 
        {
            $user_id=$fcm_data['user_id'];

            $order_id=$fcm_data['order_id'];

            $status   = $fcm_data['status'];
            
            $user_details=$this->Api_model->getUserDetails(array('id'=>$user_id))->row();
            
            $user_type=$user_details->user_type;
            
            $device_type=$user_details->device_type;
            
            $device_token=$user_details->device_token;
            
            $notification=$user_details->notification;
            
            $title="Order Dispute";
            
            $body= "Your Order is disputed #".$order_id;

            $notstatus = '7-'.$order_id.'-'.$status;
            
            if($device_type!="" && $device_token!="" && $notification==1)
            {
                $this->callFCM($device_token,$device_type,$title,$body,$notstatus);
            }
            
            $notificationData=array(
            
                'user_id'=>$user_id,
                
                'title'=>$title,
                
                'body'=>$body,

                'status'=>$notstatus,
                
                'created_at'=>date('Y-m-d H:i:s')
            );
            
            $this->Api_model->addNotification($notificationData);
        }       

    }    
    
    function callFCM($device_id,$device_type,$title,$body,$status='0')
    {
        require_once(APPPATH . 'third_party/Fcm.php');
        
        $fcm = new Fcm();
        
        $out=$fcm->sendNotification($device_id,$device_type,$title,$body,$status);
        
        //echo $out;exit;
    }

}
?>