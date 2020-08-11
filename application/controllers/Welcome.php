<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();  

        $this->load->helper('url');
    }
	function index()
	{
		$this->load->view('home');
	}
	function home()
	{
		$this->load->view('home');
	}
	function login()
	{
		$this->load->view('login');
	}
	function signUp()
	{
		$this->load->view('signup');
	}
	function subCategory()
	{
		$this->load->view('subCategory');
	}
	function categoryDetails()
	{
		$this->load->view('categoryDetails');  
	}
	function sellerProfile()
	{
		$this->load->view('sellerProfile'); 
	}
	function checkout()
	{
		$this->load->view('checkout');  
	}
	function dashboard()
	{
		$this->load->view('dashboard');
	}
	function bookmark()
	{
		$this->load->view('bookmark');
	}
	function message()
	{
		$this->load->view('message');
	}
	function myGigs()
	{
		$this->load->view('myGigs');
	}
	function newGigs()
	{
		$this->load->view('newGig');
	}
	function mySales()
	{
		$this->load->view('mySales');
	}
	function manageRequests()
	{
		$this->load->view('manageRequest');
	}
	function profile()
	{
		$this->load->view('profile');
	}
	function settings()
	{
		$this->load->view('settings');
	}
	function myOrders()
	{
		$this->load->view('myOrders');
	}
	function activeorders()
	{
		$this->load->view('activeorders');
	}
	function cancelorders()
	{
		$this->load->view('cancelorders');
	}
	function deleiverdorders()
	{
		$this->load->view('deleverorders');
	}
	function completeorders()
	{
		$this->load->view('completeorders');
	}
	function myOrdersDetails()
	{
		$this->load->view('myOrderDetails');
	}
	function buyerRequests()
	{
		$this->load->view('buyerRequests');
	}
	function about()
	{
		$this->load->view('about');
	}
	function becomeSeller()
	{
		$this->load->view('becomeSeller');
	}
	function contact()
	{
		$this->load->view('helpsupport');
	}
	function helpdetails()
	{
		$this->load->view('helpdetails');
	}
	function terms()
	{
		$this->load->view('terms');
	}
	function privacy()
	{
		$this->load->view('privacy');
	}
	function analytics()
	{
		$this->load->view('analytics');
	}
	function manageRequestDetails()
	{
		$this->load->view('manageRequestDetails');
	}
	function offerProfile()
	{
		$this->load->view('offerProfile');
	}
	function paymentHistory()
	{
		$this->load->view('paymentHistory');
	}
	function withdrawal()
	{
		$this->load->view('withdrawal');
	}
	function dispute()
	{
		$this->load->view('dispute');
	}
	function newRefund()
	{
		$this->load->view('newRefund');
	}
	function mySalesDetails()
	{
		$this->load->view('mySalesDetails');
	}
	function favourites()
	{
		$this->load->view('favourite');
	}
	function newRequest()
	{
		$this->load->view('newRequest');
	}
    function updateRequest()
	{
		$this->load->view('updateRequest');
	}
	 function gigDetailsAll()
	{
		$this->load->view('gigactiveDetails');
	}

	 function updateGig()
	{
		$this->load->view('updateGig');
	}
    function gigDetails()
	{
		$this->load->view('gigDetails');
	}
	 function salesRequestDetails()
	{
		$this->load->view('salesRequestDetails');
	}
	 function salesCancelDetails()
	{
		$this->load->view('salesCancelDetails');
	}
	function salesCurrentDetails()
	{
		$this->load->view('salesCurrentDetails');
	}
	function gigFavDetails()
	{
		$this->load->view('gigFavDetails');
	}
	function paymentMethod()
	{
		$this->load->view('paymentMethod');
	}

	function orderCancelDetails()
	{
		$this->load->view('orderCancelDetails');
	}
	function deliverOrderDetails()
	{
		$this->load->view('deliverOrderDetails');
	}
}