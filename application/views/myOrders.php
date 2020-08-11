<!doctype html>
<html lang="en">


<head>

<!-- Basic Page Needs
================================================== -->
<title>..:: <?php echo $this->config->item('app_name');?> ::..</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/fav.png">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/style.css">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/colors/blue.css">

</head>
<body class="gray">

<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
<header id="header-container" class="fullwidth dashboard-header not-sticky">

	<!-- Header -->
	<div id="header">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo">
					<a href="<?php echo site_url();?>/welcome/home"><img src="<?php echo base_url();?>/assets/images/logo2.png" alt=""></a>
				</div>

				<!-- Main Navigation -->
				<nav id="navigation">
									
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
				
			</div>
			<!-- Left Side Content / End -->


			<!-- Right Side Content / End -->
			<div class="right-side">

				<!--  User Notifications -->
				<div class="header-widget hide-on-mobile">

					<?php include("navigation1.php");?>
					
					<!-- Notifications -->
					<div class="header-notifications">

						<!-- Trigger -->
						<div class="header-notifications-trigger">
							<a href="#"><i class="icon-feather-bell"></i><span>4</span></a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">

							<div class="header-notifications-headline">
								<h4>Notifications</h4>
								<button class="mark-as-read ripple-effect-dark" title="Mark all as read" data-tippy-placement="left">
									<i class="icon-feather-check-square"></i>
								</button>
							</div>

							<div class="header-notifications-content">
								<div class="header-notifications-scroll" data-simplebar>
									<ul>
										<!-- Notification -->
										<li class="notifications-not-read">
											<a href="#">
												<span class="notification-icon"><i class="icon-material-outline-group"></i></span>
												<span class="notification-text">
													<strong>Michael Shannah</strong> Send new request for  <span class="color">Full Stack Software Engineer</span>
												</span>
											</a>
										</li>

										<!-- Notification -->
										<li>
											<a href="#">
												<span class="notification-icon"><i class="icon-material-outline-group"></i></span>
												<span class="notification-text">
													<strong>Michael Shannah</strong> Send new request for  <span class="color">Full Stack Software Engineer</span>
												</span>
											</a>
										</li>

										<!-- Notification -->
										<li class="notifications-not-read">
											<a href="#">
												<span class="notification-icon"><i class="icon-material-outline-group"></i></span>
												<span class="notification-text">
													<strong>Michael Shannah</strong> Send new request for  <span class="color">Full Stack Software Engineer</span>
												</span>
											</a>
										</li>

										<!-- Notification -->
										<li>
											<a href="#">
												<span class="notification-icon"><i class="icon-material-outline-group"></i></span>
												<span class="notification-text">
													<strong>Sindy Forrest</strong> applied for a job <span class="color">Full Stack Software Engineer</span>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</div>

						</div>

					</div>
					
					<!-- Messages -->
					<div class="header-notifications">
						<div class="header-notifications-trigger">
							<a href="#"><i class="icon-feather-mail"></i><span>3</span></a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">

							<div class="header-notifications-headline">
								<h4>Messenger</h4>
								<button class="mark-as-read ripple-effect-dark" title="Mark all as read" data-tippy-placement="left">
									<i class="icon-feather-check-square"></i>
								</button>
							</div>

							<div class="header-notifications-content">
								<div class="header-notifications-scroll" data-simplebar>
									<ul>
										<!-- Notification -->
										<li class="notifications-not-read">
											<a href="#">
												<span class="notification-avatar status-online"><img src="<?php echo base_url();?>/assets/images/user-avatar-small-03.jpg" alt=""></span>
												<div class="notification-text">
													<strong>David Peterson</strong>
													<p class="notification-msg-text">Thanks for reaching out. I'm quite busy right now on many...</p>
													<span class="color">4 hours ago</span>
												</div>
											</a>
										</li>

										<!-- Notification -->
										<li class="notifications-not-read">
											<a href="#">
												<span class="notification-avatar status-offline"><img src="<?php echo base_url();?>/assets/images/user-avatar-small-02.jpg" alt=""></span>
												<div class="notification-text">
													<strong>Sindy Forest</strong>
													<p class="notification-msg-text">Hi Tom! Hate to break it to you, but I'm actually on vacation until...</p>
													<span class="color">Yesterday</span>
												</div>
											</a>
										</li>

										<!-- Notification -->
										<li class="notifications-not-read">
											<a href="#">
												<span class="notification-avatar status-online"><img src="images/user-avatar-placeholder.png" alt=""></span>
												<div class="notification-text">
													<strong>Marcin Kowalski</strong>
													<p class="notification-msg-text">I received payment. Thanks for cooperation!</p>
													<span class="color">Yesterday</span>
												</div>
											</a>
										</li>
									</ul>
								</div>
							</div>

							<a href="<?php echo site_url();?>/welcome/message" class="header-notifications-button ripple-effect button-sliding-icon">View All Messages<i class="icon-material-outline-arrow-right-alt"></i></a>
						</div>
					</div>
								<div class="header-notifications">
						<div class="header-notifications-trigger">
							<a href="#"><i class="icon-feather-shopping-cart"></i><span>3</span></a>
						</div>

				</div>

				<!--  User Notifications / End -->

				<!-- User Menu -->
				<div class="header-widget">

					<!-- Messages -->
					<div class="header-notifications user-menu">
						<div class="header-notifications-trigger">
							<a href="#"><div class="user-avatar status-online"><img src="<?php echo base_url();?>/assets/images/user-avatar-small-01.jpg" alt=""></div></a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">

							<!-- User Status -->
							<div class="user-status">

								<!-- User Name / Avatar -->
								<div class="user-details">
									<div class="user-avatar status-online"><img src="<?php echo base_url();?>/assets/images/user-avatar-small-01.jpg" alt=""></div>
									<div class="user-name">
										Tom Smith <span>Freelancer</span>
									</div>
								</div>
								
								<!-- User Status Switcher -->
								<div class="status-switch" id="snackbar-user-status" style="display:none">
									<label class="user-online current-status">Online</label>
									<label class="user-invisible">Invisible</label>
									<!-- Status Indicator -->
									<span class="status-indicator" aria-hidden="true"></span>
								</div>	
						</div>
						
						<ul class="user-menu-small-nav">
							<li><a href="<?php echo site_url();?>/welcome/dashboard"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
							<li><a href="<?php echo site_url();?>/welcome/settings"><i class="icon-material-outline-settings"></i> Settings</a></li>
							<li><a href="<?php echo site_url();?>/welcome/home"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
						</ul>

						</div>
					</div>

				</div>
				<!-- User Menu / End -->

				<!-- Mobile Navigation Button -->
				<span class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</span>

			</div>
			<!-- Right Side Content / End -->


		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->


<!-- Dashboard Container -->
<div class="dashboard-container">

	<!-- Dashboard Sidebar
	================================================== -->
	<div class="dashboard-sidebar">
		<div class="dashboard-sidebar-inner" data-simplebar>
			<div class="dashboard-nav-container">

				<!-- Responsive Navigation Trigger -->
				<a href="#" class="dashboard-responsive-nav-trigger">
					<span class="hamburger hamburger--collapse" >
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</span>
					<span class="trigger-title">Dashboard Navigation</span>
				</a>
				
				<!-- Navigation -->
					<div class="dashboard-nav">
					<div class="dashboard-nav-inner">

						<ul data-submenu-title="Start">
						    <li ><a href="<?php echo site_url();?>/welcome/home"><i class="icon-material-outline-search"></i>Search Catagories</a></li>
							<li ><a href="<?php echo site_url();?>/welcome/dashboard"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
						   <!--  <li ><a href="<?php echo site_url();?>/welcome/bookmark"><i class="icon-material-outline-star-border"></i>Favourite</a></li> -->


							<li ><a href="<?php echo site_url();?>/welcome/buyerRequests"><i class="icon-feather-users"></i>Gig Request</a>
	
							</li>

							<li><a href="<?php echo site_url();?>/welcome/myGigs"><i class="icon-feather-git-merge"></i>My Gigs</a>
							</li>
							<li ><a href="<?php echo site_url();?>/welcome/mySales"><i class="icon-feather-pocket"></i>My Sales</a>
									
							</li>
						
						</ul>
						
						<ul data-submenu-title="Buyer">
							<li ><a href="<?php echo site_url();?>/welcome/manageRequests"><i class="icon-material-outline-business-center"></i>Manage Requests</a>
									
							</li>
							<li class="active"><a href="<?php echo site_url();?>/welcome/myOrders"><i class="icon-feather-archive"></i>My Orders</a></li>
						</ul>

						<ul data-submenu-title="Account">
							<li><a href="<?php echo site_url();?>/welcome/profile"><i class="icon-feather-user-plus"></i>Profile</a>
	
							</li>

							<li ><a href="<?php echo site_url();?>/welcome/message"><i class="icon-material-outline-question-answer"></i>Chat<span class="nav-tag">2</span></a></li>

							<li><a href="<?php echo site_url();?>/welcome/favourites"><i class="icon-feather-heart"></i>Favourite</a></li>
							<li><a href="<?php echo site_url();?>/welcome/withdrawal"><i class="icon-feather-credit-card"></i>Withdrawals</a>
	
							</li>
							<li><a href="<?php echo site_url();?>/welcome/analytics"><i class="icon-feather-activity"></i>Analytics</a>
	
							</li>
							<li><a href="<?php echo site_url();?>/welcome/settings"><i class="icon-material-outline-settings"></i> Settings</a></li>
							<li><a href="<?php echo site_url();?>/welcome/home"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
						</ul>
						
					</div>
				</div>
				<!-- Navigation / End -->

			</div>
		</div>
	</div>
	<!-- Dashboard Sidebar / End -->


	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>My Orders</h3>



				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li>My Orders</li>
					</ul>


				</nav><br>



			</div>
	
			<!-- Row -->
			<div class="row">

				<div class="col-xl-12">

					 <div class="dashboard-box margin-top-0">
						<div class="notify-box margin-top-15">
							<div class="sort-by">
								<span>Sort by:</span>
								<select class="selectpicker hide-tick" id="select">
									<option id="active">Active</option>
									<option id="deliver">Delivered</option>
									<option id="cancel">Canceled</option>
								</select>
							</div>
					    </div>
					</div>
					<div class="freelancers-container freelancers-list-layout margin-top-35" id="activediv">
						
						<div class="freelancer">

							<!-- Overview -->
							<div class="freelancer-overview">
								<div class="freelancer-overview-inner">
									
									<!-- Bookmark Icon -->
									<span class="bookmark-icon"></span>
									
									<!-- Avatar -->
									<div class="" >
										
										<a href="single-freelancer-profile.html"><img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="" style="height:px;width:px;"></a>
									</div>

									<!-- Name -->
									<div class="freelancer-name"><span><b>Due On:17/08/2019</b></span>
										<h4><a href="<?php echo site_url();?>/welcome/myOrdersDetails">I Will Create Complete And Secure Website In PHP And Mysql </a></h4>
										<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</span>
									</div>
									<div class="task-tags">
										<a href="" class="button gray ripple-effect ico" title="Share" data-tippy-placement="top"><i class="icon-feather-share-2"></i></a>
										<span>$10</span>

								    </div>
								    
								</div>

							</div>
						
						</div>
						<div class="freelancer">

							<!-- Overview -->
							<div class="freelancer-overview">
								<div class="freelancer-overview-inner">
									
									<!-- Bookmark Icon -->
									<span class="bookmark-icon"></span>
									
									<!-- Avatar -->
									<div class="" >
										
										<a href="single-freelancer-profile.html"><img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="" style="height:px;width:px;"></a>
									</div>

									<!-- Name -->
									<div class="freelancer-name"><span><b>Due On:17/08/2019</b></span>
										<h4><a href="<?php echo site_url();?>/welcome/myOrdersDetails">I Will Create Complete And Secure Website In PHP And Mysql </a></h4>
										<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</span>
									</div>
									<div class="task-tags">
										<a href="#" class="button gray ripple-effect ico" title="Share" data-tippy-placement="top"><i class="icon-feather-share-2"></i></a>
										<span>$10</span>

								    </div>
								    
								</div>

							</div>
						
						</div>
						<div class="freelancer">

							<!-- Overview -->
							<div class="freelancer-overview">
								<div class="freelancer-overview-inner">
									
									<!-- Bookmark Icon -->
									<span class="bookmark-icon"></span>
									
									<!-- Avatar -->
									<div class="" >
										
										<a href=><img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="" style="height:px;width:px;"></a>
									</div>

									<!-- Name -->
									<div class="freelancer-name"><span><b>Due On:17/08/2019</b></span>
										<h4><a href="<?php echo site_url();?>/welcome/myOrdersDetails">I Will Create Complete And Secure Website In PHP And Mysql </a></h4>
										<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</span>
									</div>
									<div class="task-tags">
										<a href="#" class="button gray ripple-effect ico" title="Share" data-tippy-placement="top"><i class="icon-feather-share-2"></i></a>
										<span>$10</span>

								    </div>
								    
								</div>

							</div>
						
						</div>
						<div class="freelancer">

							<!-- Overview -->
							<div class="freelancer-overview">
								<div class="freelancer-overview-inner">
									
									<!-- Bookmark Icon -->
									<span class="bookmark-icon"></span>
									
									<!-- Avatar -->
									<div class="" >
										
										<a href="single-freelancer-profile.html"><img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="" style="height:px;width:px;"></a>
									</div>

									<!-- Name -->
									<div class="freelancer-name"><span><b>Due On:17/08/2019</b></span>
										<h4><a href="<?php echo site_url();?>/welcome/myOrdersDetails">I Will Create Complete And Secure Website In PHP And Mysql </a></h4>
										<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</span>
									</div>
									<div class="task-tags">
										<a href="#" class="button gray ripple-effect ico" title="Share" data-tippy-placement="top"><i class="icon-feather-share-2"></i></a>
										<span>$10</span>

								    </div>
								    
								</div>

							</div>
						
						</div>
			
					</div>
					<div class="freelancers-container freelancers-list-layout margin-top-35" id="deliverdiv">
						
						<div class="freelancer">

							<!-- Overview -->
							<div class="freelancer-overview">
								<div class="freelancer-overview-inner">
									
									<!-- Bookmark Icon -->
									<span class="bookmark-icon"></span>
									
									<!-- Avatar -->
									<div class="" >
										
										<a href="single-freelancer-profile.html"><img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="" style="height:px;width:px;"></a>
									</div>

									<!-- Name -->
									<div class="freelancer-name"><span><b>Due On:17/08/2019</b></span>
										<h4><a href="<?php echo site_url();?>/welcome/deliverOrderDetails">I Will Create Complete And Secure Website In PHP And Mysql </a></h4>
										<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</span>
									</div>
									<div class="task-tags">
										<a href="#" class="button gray ripple-effect ico" title="Share" data-tippy-placement="top"><i class="icon-feather-share-2"></i></a>
										<span>$10</span>

								    </div>
								    
								</div>

							</div>
						
						</div>
						<div class="freelancer">

							<!-- Overview -->
							<div class="freelancer-overview">
								<div class="freelancer-overview-inner">
									
									<!-- Bookmark Icon -->
									<span class="bookmark-icon"></span>
									
									<!-- Avatar -->
									<div class="" >
										
										<a href="single-freelancer-profile.html"><img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="" style="height:px;width:px;"></a>
									</div>

									<!-- Name -->
									<div class="freelancer-name"><span><b>Due On:17/08/2019</b></span>
										<h4><a href="<?php echo site_url();?>/welcome/deliverOrderDetails">I Will Create Complete And Secure Website In PHP And Mysql </a></h4>
										<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</span>
									</div>
									<div class="task-tags">
										<a href="#" class="button gray ripple-effect ico" title="Share" data-tippy-placement="top"><i class="icon-feather-share-2"></i></a>
										<span>$10</span>

								    </div>
								    
								</div>

							</div>
						
						</div>
						<div class="freelancer">

							<!-- Overview -->
							<div class="freelancer-overview">
								<div class="freelancer-overview-inner">
									
									<!-- Bookmark Icon -->
									<span class="bookmark-icon"></span>
									
									<!-- Avatar -->
									<div class="" >
										
										<a href="single-freelancer-profile.html"><img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="" style="height:px;width:px;"></a>
									</div>

									<!-- Name -->
									<div class="freelancer-name"><span><b>Due On:17/08/2019</b></span>
										<h4><a href="<?php echo site_url();?>/welcome/deliverOrderDetails">I Will Create Complete And Secure Website In PHP And Mysql </a></h4>
										<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</span>
									</div>
									<div class="task-tags">
										<a href="#" class="button gray ripple-effect ico" title="Share" data-tippy-placement="top"><i class="icon-feather-share-2"></i></a>
										<span>$10</span>

								    </div>
								    
								</div>

							</div>
						
						</div>
			
					</div>
					<div class="freelancers-container freelancers-list-layout margin-top-35" id="canceldiv">
						
						<div class="freelancer">

							<!-- Overview -->
							<div class="freelancer-overview">
								<div class="freelancer-overview-inner">
									
									<!-- Bookmark Icon -->
									<span class="bookmark-icon"></span>
									
									<!-- Avatar -->
									<div class="" >
										
										<a href="single-freelancer-profile.html"><img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="" style="height:px;width:px;"></a>
									</div>

									<!-- Name -->
									<div class="freelancer-name"><span><b>Due On:17/08/2019</b></span>
										<h4><a href="<?php echo site_url();?>/welcome/orderCancelDetails">I Will Create Complete And Secure Website In PHP And Mysql </a></h4>
										<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</span>
									</div>
									<div class="task-tags">
										<a href="#" class="button gray ripple-effect ico" title="Share" data-tippy-placement="top"><i class="icon-feather-share-2"></i></a>
										<span>$10</span>

								    </div>
								    
								</div>

							</div>
						
						</div>
			
					</div>


	
				</div>

			</div>
			<!-- Row / End -->

			<!-- Footer -->
			<div class="dashboard-footer-spacer"></div>
			<div class="small-footer margin-top-15">
				<div class="small-footer-copyrights">
					© 2019 <strong>Gig People</strong>. All Rights Reserved.
				</div>
				<ul class="footer-social-links">
					<li>
						<a href="#" title="Facebook" data-tippy-placement="top">
							<i class="icon-brand-facebook-f"></i>
						</a>
					</li>
					<li>
						<a href="#" title="Twitter" data-tippy-placement="top">
							<i class="icon-brand-twitter"></i>
						</a>
					</li>
					<li>
						<a href="#" title="Google Plus" data-tippy-placement="top">
							<i class="icon-brand-google-plus-g"></i>
						</a>
					</li>
					<li>
						<a href="#" title="LinkedIn" data-tippy-placement="top">
							<i class="icon-brand-linkedin-in"></i>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<!-- Footer / End -->

		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>
<!-- Dashboard Container / End -->

</div>
<!-- Wrapper / End -->


<!-- Send Direct Message Popup
================================================== -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab">Send Message</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab">
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Direct Message To Sindy</h3>
				</div>
					
				<!-- Form -->
				<form method="post" id="send-pm">
					<textarea name="textarea" cols="10" placeholder="Message" class="with-border" required></textarea>
				</form>
				
				<!-- Button -->
				<button class="button full-width button-sliding-icon ripple-effect" type="submit" form="send-pm">Send <i class="icon-material-outline-arrow-right-alt"></i></button>

			</div>

		</div>
	</div>
</div>
<!-- Send Direct Message Popup / End -->


<!-- Scripts
================================================== -->
<script src="<?php echo base_url();?>/assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/jquery-migrate-3.0.0.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/mmenu.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/tippy.all.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/simplebar.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/bootstrap-slider.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/snackbar.js"></script>
<script src="<?php echo base_url();?>/assets/js/clipboard.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/counterup.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/magnific-popup.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/slick.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/custom.js"></script>

<!-- Snackbar // documentation: https://www.polonel.com/snackbar/ -->
<script>
// Snackbar for user status switcher
$('#snackbar-user-status label').click(function() { 
	Snackbar.show({
		text: 'Your status has been changed!',
		pos: 'bottom-center',
		showAction: false,
		actionText: "Dismiss",
		duration: 3000,
		textColor: '#fff',
		backgroundColor: '#383838'
	}); 
}); 

$(function() {
  $("#select").change(function() {
    if($("#active").is(":selected"))
    {
      $("#activediv").show();
      $("#deliverdiv").hide();
      $("#canceldiv").hide();
    }
     if($("#deliver").is(":selected"))
    {
      $("#activediv").hide();
      $("#deliverdiv").show();
      $("#canceldiv").hide();
    }
    if($("#cancel").is(":selected"))
    {
      $("#activediv").hide();
      $("#deliverdiv").hide();
      $("#canceldiv").show();
    }
  }).trigger('change');
});
</script>

</body>

<!-- Mirrored from www.vasterad.com/themes/hireo/dashboard-manage-candidates.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Feb 2019 10:28:21 GMT -->
</html>