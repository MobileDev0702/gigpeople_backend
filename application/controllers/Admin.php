<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Admin_model');
        $this->load->model('Api_model');
        $this->load->library('session');
        $this->load->helper('form');

        if(empty($this->session->userdata('gid'))) {
            redirect('adminlogin');
        }
    }
    
    function index()
    {
        $this->load->view('admin/login_header/header');
        $this->load->view('admin/login');
        $this->load->view('admin/login_footer/footer');
    }
    
    function dashboard()
    {
        $data['gigs_count'] = count($this->Admin_model->getgiglist(array('status!=' => 0))->result_array());
        $data['orders_count'] = count($this->Admin_model->getorder(array())->result_array());
        $data['user_count'] = $this->Admin_model->totalUsers(array('account_status!=' => 3));
        $data['total_cost'] = $this->Admin_model->getTotalAmount(array('order_status' => '5'))->row()->total_amount;
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
        $data['buyer_count'] = count($this->Admin_model->getUserList(array('user_type!=' => 2))->result_array());
        $data['seller_count'] = count($this->Admin_model->getUserList(array('user_type!=' => 1))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/header');
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/footer/footer');
    }
    
    function banner()
    {
        $data['banner_list'] = $this->Admin_model->gerBanner(array('status!=' => '2'))->result_array();
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/banner');
        $this->load->view('admin/footer/footer');
    }
    
    function bannerStatus()
    {
        $banner_id = $this->input->post('banner_id');
        $banner_status = $this->input->post('banner_status');
    
        $bannerData = ['status' => $banner_status, 'updated_at' => date('Y-m-d H:i:s') ];
    
        if ($this->Admin_model->addBanner($banner_id, $bannerData))
        {
            $data['status'] = "1";
            $data['message'] = "Banner Status Updated Successfully";
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function addBanner()
    {
        $banner_icon = $this->input->post('banner_icon');
    
        $bannerData = ['banner_image' => $banner_icon, 'status' => '1', 'created_at' => date('Y-m-d H:i:s') ];
    
        if ($this->Admin_model->addBanner('', $bannerData))
        {
            $data['status'] = "1";
            $data['message'] = "Banner Added Successfully";
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function viewBanner()
    {
        $banner_id = $this->input->post('banner_id');
        $banner_details = $this->Admin_model->gerBanner(array('id=' => $banner_id))->row();
        $data['banner_details'] = $banner_details;
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function editBanner()
    {
        $banner_id = $this->input->post('banner_idE');
        $banner_icon = $this->input->post('banner_iconE');
    
        $bannerData = ['banner_image' => $banner_icon, 'updated_at' => date('Y-m-d H:i:s') ];
    
        if ($this->Admin_model->addBanner($banner_id, $bannerData))
        {
            $data['status'] = "1";
            $data['message'] = "Banner updated Successfully";
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function subcategory($id = '')
    {
        $status = !empty($id) ? $id : '';
        if ($status == '1')
        {
            $data['status'] = $status;
            $data['subcategory_list'] = $this->Admin_model->getSubCategory(array('category_status' => '1'))->result_array();
        }
        elseif ($status == '2')
        {
            $data['status'] = $status;
            $data['subcategory_list'] = $this->Admin_model->getSubCategory(array('category_status' => '0'))->result_array();
        }
        else
        {
            $data['status'] = $status;
            $data['subcategory_list'] = $this->Admin_model->getSubCategory(array('category_status!=' => '2'))->result_array();
        }
    
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/subcatagory');
        $this->load->view('admin/footer/footer');
    }
    
    function subcategoryStatus()
    {
        $category_id = $this->input->post('category_id');
        $category_status = $this->input->post('category_status');
    
        $categoryData = ['category_status' => $category_status, 'updated_at' => date('Y-m-d H:i:s') ];
    
        if ($this->Admin_model->addSubCategory($category_id, $categoryData))
        {
            $data['status'] = "1";
            $data['message'] = "Category Status Updated Successfully";
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function addSubCategory()
    {
        $category_name = $this->input->post('name');
        $category_icon = $this->input->post('category_icon');
        $parent_category_id = $this->input->post('parent');
    
        if (!empty($category_icon))
        {
            $categoryData = ['category_name' => $category_name, 'category_icon' => $category_icon, 'parent_category_id' => $parent_category_id, 'category_status' => '1', 'created_at' => date('Y-m-d H:i:s') ];
    
            if ($this->Admin_model->addSubCategory('', $categoryData))
            {
                $data['status'] = "1";
                $data['message'] = "Category Added Successfully";
            }
            else
            {
                $data['status'] = "0";
                $data['message'] = "Something went wrong";
            }
        }
        else
        {
            $data['status'] = "2";
            $data['message'] = "Please upload image";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function viewSubCategory()
    {
        $category_id = $this->input->post('category_id');
        $category_details = $this->Admin_model->getSubCategory(array('id=' => $category_id))->row();
        $data['category_details'] = $category_details;
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function editSubCategory()
    {
        $category_id = $this->input->post('category_idE');
        $category_name = $this->input->post('nameE');
        $category_icon = $this->input->post('category_iconE');
        $parent_category_id = $this->input->post('parentE');
    
        $categoryData = ['category_name' => $category_name, 'category_icon' => $category_icon, 'parent_category_id' => $parent_category_id, 'updated_at' => date('Y-m-d H:i:s') ];
    
        if ($this->Admin_model->addSubCategory($category_id, $categoryData))
        {
            $data['status'] = "1";
            $data['message'] = " Category updated Successfully";
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function categoryDropDown()
    {
        $data['category_list'] = $this->Admin_model->getSubCategory(array('category_status!=' => '2', 'parent_category_id' => '0'))->result_array();
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function buyerlist($id = '')
    {
        $status = !empty($id) ? $id : '';
        if ($status == '1')
        {
            $data['status'] = $status;
            $data['buyer_details'] = $this->Admin_model->getUserList(array('user_type!=' => 2, 'account_status' => 0))->result_array();
        }
        elseif ($status == '2')
        {
            $data['status'] = $status;
            $data['buyer_details'] = $this->Admin_model->getUserList(array('user_type!=' => 2, 'account_status' => 1))->result_array();
        }
        else
        {
            $data['status'] = $status;
            $data['buyer_details'] = $this->Admin_model->getUserList(array('user_type!=' => 2))->result_array();
        }
    
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/buyerlist');
        $this->load->view('admin/footer/footer');
    }
    
    function buyerview($id)
    {
        $data['buyer_details'] = $this->Admin_model->getUserList(array('id' => $id))->row();
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
        $data['request_list'] = $this->Admin_model->RequestList(array('user_id' => $id))->result_array();
        $data['review_details'] = $this->Admin_model->getReview(array('buyer_id' => $id, 'buyer_rating!=' => '', 'buyer_review!=' => ''))->result_array();
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/buyerview');
        $this->load->view('admin/footer/footer');
    }
    
    function requestlist($id = '')
    {
        $status = !empty($id) ? $id : '';
        if ($status == '1')
        {
            $data['status'] = $status;
            $data['list'] = $this->Admin_model->getRequestList(array('request_status' => '1'))->result_array();
        }
        elseif ($status == '2')
        {
            $data['status'] = $status;
            $data['list'] = $this->Admin_model->getRequestList(array('request_status' => '0'))->result_array();
        }
        else
        {
            $data['status'] = $status;
            $data['list'] = $this->Admin_model->getRequestList()->result_array();
        }
    
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/requestlist');
        $this->load->view('admin/footer/footer');
    }
    
    function requestview($id)
    {
        $data['view'] = $this->Admin_model->getRequestList(array('request.id' => $id))->row();
        $data['offer_view'] = $this->Admin_model->getOfferList(array('offer_sent.request_id' => $id))->result_array();
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/requestview');
        $this->load->view('admin/footer/footer');
    }
    
    function sellerlist($id = '')
    {
        $status = !empty($id) ? $id : '';
        if ($status == '1')
        {
            $data['status'] = $status;
            $data['seller_details'] = $this->Admin_model->getUserList(array('user_type!=' => 1, 'account_status' => 0))->result_array();
        }
        elseif ($status == '2')
        {
            $data['status'] = $status;
            $data['seller_details'] = $this->Admin_model->getUserList(array('user_type!=' => 1, 'account_status' => 1))->result_array();
        }
        else
        {
            $data['status'] = $status;
            $data['seller_details'] = $this->Admin_model->getUserList(array('user_type!=' => 1))->result_array();
        }
    
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/sellerlist');
        $this->load->view('admin/footer/footer');
    }
    
    function sellerview($id)
    {
        $data['seller_details'] = $this->Admin_model->getUserList(array('id' => $id))->row();
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
        $data['gig_list'] = $this->Admin_model->getgiglist(array('user_id' => $id, 'status!=' => 0))->result_array();
        $data['review_details'] = $this->Admin_model->getReview(array('seller_id' => $id, 'seller_review!=' => '', 'seller_rating!=' => ''))->result_array();
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/sellerview');
        $this->load->view('admin/footer/footer');
    }
    
    function giglist($id = '')
    {
        $status = !empty($id) ? $id : '';
        if ($status == '1')
        {
            $data['status'] = $status;
            $data['gigs_details'] = $this->Admin_model->getgiglist(array('status' => '2'))->result_array();
        }
        elseif ($status == '2')
        {
            $data['status'] = $status;
            $data['gigs_details'] = $this->Admin_model->getgiglist(array('status' => '3'))->result_array();
        }
        else
        {
            $data['status'] = $status;
            $data['gigs_details'] = $this->Admin_model->getgiglist(array('status!=' => 1))->result_array();
        }
    
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/giglist');
        $this->load->view('admin/footer/footer');
    }
    
    function gigview($id)
    {
        $data['gig_details'] = $this->Admin_model->getgiglist(array('id' => $id))->row();
        $orderView = $this->Admin_model->getorder(array('product_id' => $id, 'type' => '1'))->row();
        $order_id = !empty($orderView->id) ? $orderView->id : '';
        $data['review_details'] = $this->Admin_model->getReview(array('order_id' => $order_id))->result_array();
    
        $gigRating = ceil($this->Api_model->rating(array('order_id' => $order_id, 'order_rating!=' => '0'), 'avg(order_rating) as rating')->row()->rating);
        $data['gig_rating'] = !empty($gigRating) ? $gigRating : '0';
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/gigview');
        $this->load->view('admin/footer/footer');
    }
    
    function gigStatus()
    {
        $gig_id = $this->input->post('gig_id');
        $account_status = $this->input->post('status');
    
        $userData = array('status' => $account_status, 'updated_at' => date('Y-m-d H:i:s'));
    
        if ($this->Admin_model->gigDetailsUpdate($gig_id, $userData))
        {
            $data['status'] = "1";
            $data['message'] = ($account_status == 2) ? "Gig is activated successfully" : "Gig deactivated successfully";
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function userStatus()
    {
        $user_id = $this->input->post('user_id');
        $status = $this->input->post('account_status');
        $user_type = $this->input->post('user_type');
        $account = $this->input->post('account');
    
        if ($account == 'seller')
        {
            $userData = array(
            //'account_status'=>$account_status,
            'user_type' => '1', 'updated_at' => date('Y-m-d H:i:s'));
        }
        else
        {
            $userData = array(
            //'account_status'=>$account_status,
            'user_type' => '2', 'updated_at' => date('Y-m-d H:i:s'));
        }
    
        if ($this->Admin_model->userDetailsUpdate($user_id, $userData))
        {
            $data['status'] = "1";
            $data['message'] = ($status == 1) ? "Account Activated Successfully" : "Account Deactivated Successfully";
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function myorder($id = '')
    {
        $status = !empty($id) ? $id : '';
        if ($status == '1')
        {
            $data['status'] = $status;
            $data['order_list'] = $this->Admin_model->getorder(array('order_status' => 4))->result_array();
        }
        elseif ($status == '2')
        {
            $data['status'] = $status;
            $data['order_list'] = $this->Admin_model->getorder(array('order_status' => 7))->result_array();
        }
        else
        {
            $data['status'] = $status;
            $data['order_list'] = $this->Admin_model->getorder(array())->result_array();
        }
    
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/myorder');
        $this->load->view('admin/footer/footer');
    }
    
    function orderview($id)
    {
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
        $data['Orders'] = $this->Admin_model->getorder(array('id' => $id))->row();
        $data['dispute_list'] = $this->Admin_model->get_where('order_history', array('order_id' => $id, 'history_type' => '3'));
        $data['reviews'] = $this->Admin_model->getReview(array('order_id' => $id))->row();
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/orderview');
        $this->load->view('admin/footer/footer');
    }
    
    function statistics($id = '')
    {
        $status = !empty($id) ? $id : '';
        if ($status)
        {
            $data['status'] = $status;
            $data['list'] = $this->Admin_model->getorder(array('order_status' => 5))->result_array();
        }
        else
        {
            $data['status'] = $status;
            $data['list'] = $this->Admin_model->getorder(array('order_status' => 5))->result_array();
        }
    
        $data['category_details'] = $this->Admin_model->getSubCategory(array('category_status' => '1'))->result_array();
        $data['order_list'] = $this->Admin_model->getorder(array('order_status' => 5))->result_array();
        $data['total_cost'] = $this->Admin_model->getTotalAmount(array('order_status' => '5'))->row()->total_amount;
        $data['user_cost'] = $this->Admin_model->getTotalAmount(array('order_status' => '5'))->row()->user_amount;
        $data['company_cost'] = $this->Admin_model->getTotalAmount(array('order_status' => '5'))->row()->company_amount;
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/statistics');
        $this->load->view('admin/footer/footer');
    }
    
    function walletWithDraw()
    {
        $data['list'] = $this->Admin_model->getUserList(array('wallet_status' => '1'))->result_array();
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/withdraw');
        $this->load->view('admin/footer/footer');
    }
    
    function dispute($id = '')
    {
        $status = !empty($id) ? $id : '';
        if ($status == '1')
        {
            $data['status'] = $status;
            $data['dispute_list'] = $this->Admin_model->get_where('order_history', array('history_type' => '3'));
        }
        elseif ($status == '2')
        {
            $data['status'] = $status;
            $data['dispute_list'] = $this->Admin_model->get_where('order_history', array('history_type' => '3'));
        }
        else
        {
            $data['status'] = $status;
            $data['dispute_list'] = $this->Admin_model->get_where('order_history', array('history_type' => '3'));
        }
    
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/disputelist');
        $this->load->view('admin/footer/footer');
    }
    
    function disputeview($id)
    {
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
        $data['Orders'] = $this->Admin_model->getorder(array('id' => $id))->row();
        $seller_id = $data['Orders']->seller_id;
        $buyer_id = $data['Orders']->buyer_id;
        $data['seller_dispute'] = $this->Admin_model->get_where('order_history', array('order_id' => $id, 'from_user_id' => $seller_id, 'history_type' => '3'));
        $data['buyer_dispute'] = $this->Admin_model->get_where('order_history', array('order_id' => $id, 'from_user_id' => $buyer_id, 'history_type' => '3'));
        $data['reviews'] = $this->Admin_model->getReview(array('order_id' => $id))->row();
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/disputeview');
        $this->load->view('admin/footer/footer');
    }
    
    function report()
    {
        $data['user_list'] = $this->Api_model->HistoryList(array('history_type' => 4))->result_array();
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/report');
        $this->load->view('admin/footer/footer');
    }
    
    function changePasswordConfirm()
    {
        $admin_id = $this->session->userdata('admin_id');
        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $old_password = md5($old_password);
        $admin_details = $this->Admin_model->getAdminDetails(array('admin_id' => $admin_id, 'password' => $old_password))->row();
    
        if (empty($admin_details))
        {
            $data['status'] = "0";
            $data['message'] = "Old Password is incorrect";
        }
        else
        {
            $new_password = md5($new_password);
            $adminData = array('password' => $new_password,);
    
            if ($this->Admin_model->updateAdmin($admin_id, $adminData))
            {
                $data['status'] = "1";
                $data['message'] = "Password Changed Successfully";
            }
            else
            {
                $data['status'] = "0";
                $data['message'] = "Something went wrong";
            }
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function settings()
    {
        $admin_id = $this->session->userdata('admin_id');
        $data['admin_details'] = $this->Admin_model->getAdminDetails(array('admin_id' => '1'))->row();
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/settings');
        $this->load->view('admin/footer/footer');
    }
    
    function changepassword()
    {
        $admin_id = $this->session->userdata('admin_id');
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/changepassword');
        $this->load->view('admin/footer/footer');
    }
    
    function adminLogin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $admin_details = $this->Admin_model->getAdminDetails(array('email' => $email))->row();
    
        if (empty($admin_details))
        {
            $data['status'] = "0";
            $data['message'] = "Email Id not exists";
        }
        else
        {
            $password = md5($password);
            $admin_details = $this->Admin_model->getAdminDetails(array('email' => $email, 'password' => $password))->row();
            if (empty($admin_details))
            {
                $data['status'] = "0";
                $data['message'] = "Password is incorrect";
            }
            else
            {
                $data['status'] = "1";
                $data['message'] = "Login Success!!";
                $this->sessionSet($email);
            }
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function adminProfile()
    {
        $admin_id = $this->session->userdata('admin_id');
        $admin_name = $this->input->post('admin_name');
        $admin_email = $this->input->post('admin_email');
        $commission_per = $this->input->post('commission_per');
        $adminData = array('admin_name' => $admin_name, 'email' => $admin_email, 'commission_per' => $commission_per,);
        if ($this->Admin_model->updateAdmin($admin_id, $adminData))
        {
            $data['status'] = "1";
            $data['message'] = "Settings Updated Successfully";
            $this->sessionSet($admin_email);
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function termsAndCondition()
    {
        $admin_id = $this->session->userdata('admin_id');
        $data['admin_details'] = $this->Admin_model->getAdminDetails(array('admin_id' =>'1'))->row();
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/termsandcondition');
        $this->load->view('admin/footer/footer');
    }
    
    function privacyPolicy()
    {
        $admin_id = $this->session->userdata('admin_id');
        //print_r($admin_id);exit;
        $data['admin_details'] = $this->Admin_model->getAdminDetails(array('admin_id' =>'1'))->row();
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/privacypolicy');
        $this->load->view('admin/footer/footer');
    }
    
    function contact()
    {
        $data['contact_list'] = $this->Admin_model->getContactList()->result_array();
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/contact');
        $this->load->view('admin/footer/footer');
    }
    
    function help()
    {
        $admin_id = $this->session->userdata('admin_id');
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
        $data['help_list'] = $this->Admin_model->getHelpList(array('status!=' => '3'))->result_array();
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/help');
        $this->load->view('admin/footer/footer');
    }
    
    function helpview($id)
    {
        $data['help_view'] = $this->Admin_model->getHelpList(array('help.id' => $id))->row();
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/helpview');
        $this->load->view('admin/footer/footer');
    }
    
    function addhelp()
    {
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/addhelp');
        $this->load->view('admin/footer/footer');
    }
    
    function edithelp($id)
    {
        $data['help_view'] = $this->Admin_model->getHelpList(array('help.id' => $id))->row();
        $data['gig_count'] = count($this->Admin_model->getgiglist(array('status' => 0))->result_array());
    
        $this->load->view('admin/header/header', $data);
        $this->load->view('admin/header/sidebar');
        $this->load->view('admin/edithelp');
        $this->load->view('admin/footer/footer');
    }
    
    function updateTerms()
    {
        $admin_id = $this->session->userdata('admin_id');
        $terms = $this->input->post('terms');
        $adminData = array('terms' => $terms,);
    
        if ($this->Admin_model->updateAdmin($admin_id, $adminData))
        {
            $data['status'] = "1";
            $data['message'] = "Terms & conditions updated Successfully";
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function updatePrivacy()
    {
        $admin_id = $this->session->userdata('admin_id');
        $privacy = $this->input->post('privacy');
        $adminData = array('privacy' => $privacy,);
    
        if ($this->Admin_model->updateAdmin($admin_id, $adminData))
        {
            $data['status'] = "1";
            $data['message'] = "Privacy Policy updated Successfully";
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function addquestion()
    {
        $question = $this->input->post('question');
        $help = $this->input->post('help');
        $parent = $this->input->post('parent');
    
        $categoryData = ['help' => $question, 'parent_id' => $parent, 'description' => $help, 'status' => '1', 'created_at' => date('Y-m-d H:i:s') ];
    
        if ($this->Admin_model->addQuestion('', $categoryData))
        {
            $data['status'] = "1";
            $data['message'] = "Question Added Successfully";
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function questionStatus()
    {
        $help_id = $this->input->post('question_id');
        $help_status = $this->input->post('question_status');
    
        $helpData = ['status' => $help_status, 'updated_at' => date('Y-m-d H:i:s') ];
    
        if ($this->Admin_model->addQuestion($help_id, $helpData))
        {
            $data['status'] = "1";
            $data['message'] = "Question Status Updated Successfully";
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function updateHelp()
    {
        $help = $this->input->post('help');
        $help_id = $this->input->post('help_id');
        $adminData = array('description' => $help,);
    
        if ($this->Admin_model->addQuestion($help_id, $adminData))
        {
            $data['status'] = "1";
            $data['message'] = "Help updated Successfully";
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function viewQuestion()
    {
        $help_id = $this->input->post('help_id');
        $help_details = $this->Admin_model->getHelpList(array('help.id=' => $help_id))->row();
        $data['help_details'] = $help_details;
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function editQuestion()
    {
        $help_id = $this->input->post('id');
        $question = $this->input->post('question');
        $help = $this->input->post('help');
        $parent = $this->input->post('parent');
    
        $categoryData = ['help' => $question, 'parent_id' => $parent, 'description' => $help, 'updated_at' => date('Y-m-d H:i:s') ];
    
        if ($this->Admin_model->addQuestion($help_id, $categoryData))
        {
            $data['status'] = "1";
            $data['message'] = "Question updated Successfully";
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function logout()
    {
        $this->session->unset_userdata('gid');
        redirect('adminlogin');
    }
}

?>