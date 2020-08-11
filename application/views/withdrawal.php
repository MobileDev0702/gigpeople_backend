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
   
<script src="<?php echo base_url();?>assets/js/chart14.js"></script>
<script src="<?php echo base_url();?>assets/js/chart15.js"></script>


<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>


</head>
<body>

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
					<a href="<?php echo site_url();?>/welcome"><img src="<?php echo base_url();?>/assets/images/logo2.png" alt=""></a>
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
								<div class="status-switch" id="snackbar-user-status">
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
							<li><a href="<?php echo site_url();?>/welcome/manageRequests"><i class="icon-material-outline-business-center"></i>Manage Requests</a>
									
							</li>
							<li><a href="<?php echo site_url();?>/welcome/myOrders"><i class="icon-feather-archive"></i>My Orders</a></li>
						</ul>

						<ul data-submenu-title="Account">
							<li><a href="<?php echo site_url();?>/welcome/profile"><i class="icon-feather-user-plus"></i>Profile</a>
	
							</li>

							<li ><a href="<?php echo site_url();?>/welcome/message"><i class="icon-material-outline-question-answer"></i>Chat<span class="nav-tag">2</span></a></li>

							<li><a href="<?php echo site_url();?>/welcome/favourites"><i class="icon-feather-heart"></i>Favourite</a></li>
							<li class="active"><a href="<?php echo site_url();?>/welcome/withdrawal"><i class="icon-feather-credit-card"></i>Withdrawals</a>
	
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
		
	
			<!-- Row -->
			<div class="row">
										<h3>With Drawels</h3>
				

				<!-- Dashboard Box -->
			</div><br><br>
			<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-arrow-back"></i>With Drawels</h3>
						</div>
						</div>
						</div><br><br>
		<div class="fun-facts-container">
				<div class="fun-fact" data-fun-fact-color="#36bd78">
					<div class="fun-fact-text">
						<span>Amount in wallet</span>
						<h4>22</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-material-outline-account-balance-wallet
"></i></div>
				</div>
				<div class="fun-fact" data-fun-fact-color="#b81b7f">
					<div class="fun-fact-text">
						<span>Amount earned this month</span>
						<h4>4</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-material-outline-business-center"></i></div>
				</div>
				
			</div><br><br>

		<h3 class="margin-top-50">Payment Method</h3>

			<!-- Payment Methods Accordion -->
			<div class="payment margin-top-30">

				<div class="payment-tab payment-tab-active">
					<div class="payment-tab-trigger">
						<input checked id="paypal" name="cardType" type="radio" value="paypal">
						<label for="paypal">PayPal</label>
						<img class="payment-logo paypal" src="../../../i.imgur.com/ApBxkXU.png" alt="">
					</div>

					<div class="payment-tab-content">
						<p>You will be redirected to PayPal to complete payment.</p>
					</div>
				</div>


				<div class="payment-tab">
					<div class="payment-tab-trigger">
						<input type="radio" name="cardType" id="creditCart" value="creditCard">
						<label for="creditCart">Bank Details</label>
						<img class="payment-logo" src="../../../i.imgur.com/IHEKLgm.png" alt="">
					</div>

					<div class="payment-tab-content">
						<div class="row payment-form-row">

							<div class="col-md-9">
								<div class="card-label">
									<input id="nameOnCard" name="nameOnCard" required type="text" placeholder="Bank Name">
								</div>
							</div>

							<div class="col-md-6">
								<div class="card-label">
									<input id="cardNumber" name="cardNumber" placeholder="Account Number" required type="text">
								</div>
							</div>

							<div class="col-md-4">
								<div class="card-label">
									<input id="expiryDate" placeholder="Routing Number" required type="text">
								</div>
							</div>

							
						</div>
					</div>
				</div>

			</div>
			<a href="#" class="button big ripple-effect margin-top-40 margin-bottom-65">With Draw</a>
		</div>


	
            
						

		</div>
	</div>
</div>
</div>
<!-- Dashboard Container / End -->

</div>
<!-- Wrapper / End -->


<!-- Apply for a job popup
================================================== -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab">Add Note</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab">
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Do Not Forget 😎</h3>
				</div>
					
				<!-- Form -->
				<form method="post" id="add-note">

					<select class="selectpicker with-border default margin-bottom-20" data-size="7" title="Priority">
						<option>Low Priority</option>
						<option>Medium Priority</option>
						<option>High Priority</option>
					</select>

					<textarea name="textarea" cols="10" placeholder="Note" class="with-border"></textarea>

				</form>
				
				<!-- Button -->
				<button class="button full-width button-sliding-icon ripple-effect" type="submit" form="add-note">Add Note <i class="icon-material-outline-arrow-right-alt"></i></button>

			</div>

		</div>
	</div>
</div>
<!-- Apply for a job popup / End -->


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

</body>


</html>