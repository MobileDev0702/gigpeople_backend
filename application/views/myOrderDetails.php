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
<body>

<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
<header id="header-container" class="fullwidth">

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
			<!-- Right Side Content / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->



<!-- Titlebar
================================================== -->
<div class="single-page-header" data-background-image="<?php echo base_url();?>/assets/images/single-job.jpg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="single-page-header-inner">
					<div class="left-side">
						<div class="header-image"><a href="#"><img src="<?php echo base_url();?>/assets/images/user-avatar-big-01.jpg" alt=""></a></div>
						<div class="header-details">
							<h3>Order #FO3AAB1B3C85</h3>
							<a href="#"><h5>About the Buyer</h5></a>
							<ul>
								<li><a href="#"><i class="icon-feather-git-merge"></i> Gig Details</a></li>
								<li><img class="flag" src="images/flags/gb.svg" alt=""> United Kingdom</li>
								<li><div class="verified-badge-with-title">Verified</div></li>
							</ul>
						</div>
					</div>
					<div class="right-side">
						<div class="salary-box">
							<div class="salary-type">March 2,2017</div>
							<div class="salary-amount">$35</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Page Content
================================================== -->
<div class="container">
	<div class="row">
		
		<!-- Content -->
		<div class="col-xl-9 col-lg-9 content-right-offset">

		    <h3 class="margin-bottom-25">Order Details</h3>


			<div class="row">
			<div class="col-xl-12">

			<div class="listings-container grid-layout">
				         <a href="#" class="job-listing" style="width:900px;text-decoration: none">

							<!-- Job Listing Details -->
							<div class="job-listing-details">
								<!-- Logo -->
								<table class="margin-top-20">
				<tbody><tr height="40">
					<th width="500">Item</th>
					<th width="100">Qty</th>
					<th width="200">Duration</th>
					<th width="200">Amount</th>
				</tr>

				<tr>
					<td>Standard Plan</td> 
					<td>1</td>
					<td>1 DAY</td>
					<td>$5.00</td>
				</tr>
			</tbody></table>
								
							</div>

							<!-- Job Listing Footer -->
							<div class="job-listing-footer">
								<table id="totals">
								<tbody><tr>
									<th width="630">Total </th> 
									<th ><span>$5.00</span></th>
								</tr>
							</tbody></table>
							</div>
						</a>
			</div>
		    </div>
	        </div>


			<div class="boxed-list margin-bottom-60">
				<div class="boxed-list-headline">
					<h3><i class="icon-material-outline-thumb-up"></i> Work History and Feedback</h3>
				</div><br>
				<table align="center">
					        <tr><td style="text-align:center;font-size: 50px"><i class="icon-line-awesome-rocket"></i></td></tr>
							<tr><th>Order Started</th></tr>
							<tr><th style="font-weight: bold;text-align: center;">2 Days left </th></tr>
				</table>
				<ul class="boxed-list-ul">
					<li>
						<div class="boxed-list-item">
							<!-- Avatar -->
							<div class="item-image">
								<img src="<?php echo base_url();?>/assets/images/user-avatar-big-01.jpg" alt="">
							</div>
							
							<!-- Content -->
							<div class="item-content">
								<h4>Me</h4>
								<div class="item-details margin-top-7">
									<div class="detail-item"><i class="icon-material-outline-date-range"></i> May 12,2019 </div>
								</div>
								<div class="item-description">
									<p>Focus the team on the tasks at hand or the internal and external customer requirements.</p>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="boxed-list-item">
							<!-- Avatar -->
							<div class="item-image">
								<img src="<?php echo base_url();?>/assets/images/user-avatar-big-01.jpg" alt="">
							</div>
							
							<!-- Content -->
							<div class="item-content">
								<h4>John</h4>
								<div class="item-details margin-top-7">
									<div class="detail-item"><i class="icon-material-outline-date-range"></i> May 12,2019 </div>
								</div>
								<div class="item-description">
									<p>Focus the team on the tasks at hand or the internal and external customer requirements.</p>
								</div>
							</div>
						</div>
					</li>

					
				</ul>

				<table align="center">
					        <tr><td style="text-align:center;font-size: 50px"><i class="icon-line-awesome-truck"></i></td></tr>
							<tr><th style="text-align: center;">Your delivery</th></tr>
							<tr><th style="font-weight: bold;text-align: center;">This order will be marked as complete in 3 days.t </th></tr>
				</table>
<ul class="boxed-list-ul">
					<li>
						<div class="boxed-list-item">
							<!-- Avatar -->
							<div class="item-image">
								<img src="<?php echo base_url();?>/assets/images/user-avatar-big-01.jpg" alt="">
							</div>
							
							<!-- Content -->
							<div class="item-content">
								<h4>Me</h4>
								<div class="item-details margin-top-7">
									<div class="detail-item"><i class="icon-material-outline-date-range"></i> May 12,2019 </div>
								</div>
								<div class="item-description">
									<p>Focus the team on the tasks at hand or the internal and external customer requirements.</p>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="boxed-list-item">
							<!-- Avatar -->
							<div class="item-image">
								<img src="<?php echo base_url();?>/assets/images/user-avatar-big-01.jpg" alt="">
							</div>
							
							<!-- Content -->
							<div class="item-content">
								<h4>John</h4>
								<div class="item-details margin-top-7">
									<div class="detail-item"><i class="icon-material-outline-date-range"></i> May 12,2019 </div>
								</div>
								<div class="item-description">
									<p>Focus the team on the tasks at hand or the internal and external customer requirements.</p>
								</div>
							</div>
							<div class="bids-bid">
								<div class="bid-rate">
									<div class="rate"><i class="icon-feather-refresh-cw
" style="font-size: 20px"></i></div>
									<h4>Requested for revision</h4>
									<span>Revise your delivery to avoid cancellation. Your buyer has 1 revision available.</span>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="boxed-list-item">
							<!-- Avatar -->
							<div class="item-image">
								<img src="<?php echo base_url();?>/assets/images/user-avatar-big-01.jpg" alt="">
							</div>
							
							<!-- Content -->
							<div class="item-content">
								<h4>Me</h4>
								<div class="item-details margin-top-7">
									<div class="detail-item"><i class="icon-material-outline-date-range"></i> May 12,2019 </div>
								</div>
								<div class="item-description">
									<p>Focus the team on the tasks at hand or the internal and external customer requirements.</p>
									<a href="#" class="popup-with-zoom-anim button button-sliding-icon dark">Accept <i class="icon-material-outline-arrow-right-alt"></i></a>
									<a href="#" class="popup-with-zoom-anim button button-sliding-icon gray">Decline <i class="icon-material-outline-arrow-right-alt"></i></a>
								</div>
							</div>
						</div>
					</li>


				<table align="center">
					        <tr><td style="text-align:center;font-size: 50px"><i class="icon-feather-alert-circle"></i></td></tr>
							<tr><th style="text-align: center;"> Order Dispute </th></tr>
							<tr><th style="font-weight: bold;text-align: center;">ameliathomas2 stated the issue is:The Gig Requested additional work, which wasn't in the scope of the original order  </th></tr>

							 <tr><td style="text-align:center;font-size: 50px"><i class="icon-feather-x-circle"></i></td></tr>
							<tr><th style="text-align: center;"> Order Cancelled </th></tr>
							<tr><th style="font-weight: bold;text-align: center;"> You accepted to mutually cancel the order with ameliathomas2.
							<p>Amount will be Refunded to Buyer Account</p> </th></tr>
				</table>

					
				</ul>

				<div class="centered-button margin-top-35">
					<a href="#small-dialog-1" class="popup-with-zoom-anim button button-sliding-icon">Leave a Review <i class="icon-material-outline-arrow-right-alt"></i></a>
					<a href="#small-dialog" class="popup-with-zoom-anim button button-sliding-icon">Message Now <i class="icon-material-outline-arrow-right-alt"></i></a>
					<a href="#small-dialog-2" class="popup-with-zoom-anim button button-sliding-icon">Ask For Revision<i class="icon-material-outline-arrow-right-alt"></i></a>
					<a href="#small-dialog" class="popup-with-zoom-anim button button-sliding-icon">Cancel <i class="icon-material-outline-arrow-right-alt"></i></a>
				</div>

				
			</div>

			<div class="boxed-list margin-bottom-60">
				<div class="boxed-list-headline">
					<h3><i class="icon-material-outline-thumb-up"></i> Reviews</h3>
				</div>
				<ul class="boxed-list-ul">
					<li>
						<div class="boxed-list-item">
							<!-- Content -->
							<div class="item-content">
								<h4>Doing things the right way <span>Anonymous Employee</span></h4>
								<div class="item-details margin-top-10">
									<div class="star-rating" data-rating="5.0"><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span></div>
									<div class="detail-item"><i class="icon-material-outline-date-range"></i> August 2019</div>
								</div>
								<div class="item-description">
									<p>Great company and especially ideal for the career-minded individual. The company is large enough to offer a variety of jobs in all kinds of interesting locations. Even if you never change roles, your job changes and evolves as the company grows, keeping things fresh.</p>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="boxed-list-item">
							<!-- Content -->
							<div class="item-content">
								<h4>Outstanding Work Environment <span>Anonymous Employee</span></h4>
								<div class="item-details margin-top-10">
									<div class="star-rating" data-rating="5.0"><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span><span class="star"></span></div>
									<div class="detail-item"><i class="icon-material-outline-date-range"></i> May 2019</div>
								</div>
								<div class="item-description">
									<p>They do business with integrity and rational thinking. Overall, it's an excellent place to work, with products that are winning in the marketplace.</p>
								</div>
							</div>
						</div>
					</li>
				</ul>

				

			</div>
         

			
		
         </div>

		<!-- Sidebar -->
		<div class="col-xl-3 col-lg-3">
			<div class="sidebar-container">
				<div class="sidebar-widget">
					<div class="job-overview">
						<div class="job-overview-headline" style="text-align: center">Support</div>
						<div class="job-overview-inner">
							<p style="text-align:center">Need to contact Customer Spport </p>
							<a href="#" class="button dark ripple-effect" style="text-align: center;width:180px">Contact</a>
							<a href="#" class="button dark ripple-effect" style="text-align: center;width:180px">Contact Admin</a>
						</div>
					</div>
				</div>
				<h3>Bookmark or Share</h3>

					<!-- Bookmark Button -->
					<button class="bookmark-button margin-bottom-25">
						<span class="bookmark-icon"></span>
						<span class="bookmark-text">Bookmark</span>
						<span class="bookmarked-text">Bookmarked</span>
					</button>

					<!-- Copy URL -->
					<div class="copy-url">
						<input id="copy-url" type="text" value="" class="with-border">
						<button class="copy-url-button ripple-effect" data-clipboard-target="#copy-url" title="Copy to Clipboard" data-tippy-placement="top"><i class="icon-material-outline-file-copy" ></i></button>
					</div>

					<!-- Share Buttons -->
					<div class="share-buttons margin-top-25">
						<div class="share-buttons-trigger"><i class="icon-feather-share-2"></i></div>
						<div class="share-buttons-content">
							<span>Interesting? <strong>Share It!</strong></span>
							<ul class="share-buttons-icons">
								<li><a href="#" data-button-color="#3b5998" title="Share on Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
								<li><a href="#" data-button-color="#1da1f2" title="Share on Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
								<li><a href="#" data-button-color="#dd4b39" title="Share on Google Plus" data-tippy-placement="top"><i class="icon-brand-google-plus-g"></i></a></li>
								<li><a href="#" data-button-color="#0077b5" title="Share on LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a></li>
							</ul>
						</div>
					</div>
            </div>
		</div>

	</div>
</div>


<!-- Footer
================================================== -->
<div id="footer">
	
	<!-- Footer Top Section -->
	<div class="footer-top-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">

					<!-- Footer Rows Container -->
					<div class="footer-rows-container">
						
						<!-- Left Side -->
						<div class="footer-rows-left">
							<div class="footer-row">
								<div class="footer-row-inner footer-logo">
									<img src="<?php echo base_url();?>/assets/images/logo.png" alt="">
								</div>
							</div>
						</div>
						
						<!-- Right Side -->
						<div class="footer-rows-right">

							<!-- Social Icons -->
							<div class="footer-row">
								<div class="footer-row-inner">
									<ul class="footer-social-links">
										<li>
											<a href="#" title="Facebook" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-facebook-f"></i>
											</a>
										</li>
										<li>
											<a href="#" title="Twitter" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-twitter"></i>
											</a>
										</li>
										<li>
											<a href="#" title="Google Plus" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-google-plus-g"></i>
											</a>
										</li>
										<li>
											<a href="#" title="LinkedIn" data-tippy-placement="bottom" data-tippy-theme="light">
												<i class="icon-brand-linkedin-in"></i>
											</a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
							</div>
							
							<!-- Language Switcher -->
							<!-- <div class="footer-row">
								<div class="footer-row-inner">
									<select class="selectpicker language-switcher" data-selected-text-format="count" data-size="5">
										<option selected>English</option>
										<option>Français</option>
										<option>Español</option>
										<option>Deutsch</option>
									</select>
								</div>
							</div> -->
						</div>

					</div>
					<!-- Footer Rows Container / End -->
				</div>
			</div>
		</div>
	</div>
	<!-- Footer Top Section / End -->

	<!-- Footer Middle Section -->
	<div class="footer-middle-section">
		<div class="container">
			<div class="row">

				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>For Buyers</h3>
						<ul>
							<li><a href="#"><span>Browse sellers</span></a></li>
							<li><a href="#"><span>Add Requests</span></a></li>
							<li><a href="#"><span>Response Alerts</span></a></li>
							<li><a href="#"><span>Manage Requests</span></a></li>
						</ul>
					</div>
				</div>

				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>For Seller</h3>
						<ul>
							<li><a href="#"><span>Post a Gig</span></a></li>
							<li><a href="#"><span>Offer Reuests</span></a></li>
							<li><a href="#"><span>Get Hired</span></a></li>
						</ul>
					</div>
				</div>

				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>Helpful Links</h3>
						<ul>
							<li><a href="#"><span>Contact</span></a></li>
							<li><a href="#"><span>Privacy Policy</span></a></li>
							<li><a href="#"><span>Terms of Use</span></a></li>
						</ul>
					</div>
				</div>

				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>Account</h3>
						<ul>
							<li><a href="#"><span>Log In</span></a></li>
							<li><a href="#"><span>My Account</span></a></li>
						</ul>
					</div>
				</div>

				<!-- Newsletter -->
				<div class="col-xl-4 col-lg-4 col-md-12">
					<h3> Contact us</h3>
					<p>SanFransico , USA</p>
					
				</div>
			</div>
		</div>
	</div>
	<!-- Footer Middle Section / End -->
	
	<!-- Footer Copyrights -->
	<div class="footer-bottom-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					© 2019 <strong><?php echo $this->config->item('app_name');?></strong>. All Rights Reserved.
				</div>
			</div>
		</div>
	</div>
	<!-- Footer Copyrights / End -->

</div>
<!-- Footer / End -->

</div>
<!-- Wrapper / End -->


<!-- Apply for a job popup
================================================== -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab">Chat</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab">
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Send message to Buyer</h3>
				</div>
					
				<!-- Form -->
				<form method="post" id="apply-now-form">

					<div class="input-with-icon-left">
						<i class="icon-material-outline-account-circle"></i>
						<textarea class="input-text with-border" name="name" id="name"  required></textarea>
					</div>

					

				</form>
				
				<!-- Button -->
				<button class="button margin-top-35 full-width button-sliding-icon ripple-effect" type="submit" form="apply-now-form">Send <i class="icon-material-outline-arrow-right-alt"></i></button>

			</div>

		</div>
	</div>
</div>
<!-- Apply for a job popup / End -->

<!-- Leave a Review Popup
================================================== -->
<div id="small-dialog-1" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab">Leave a Review</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab">
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>What is it like to work at Acodia?</h3>
					
				<!-- Form -->
				<form method="post" id="leave-company-review-form">

					<!-- Leave Rating -->
					<div class="clearfix"></div>
					<div class="leave-rating-container">
						<div class="leave-rating margin-bottom-5">
							<input type="radio" name="rating" id="rating-1" value="1" required>
							<label for="rating-1" class="icon-material-outline-star"></label>
							<input type="radio" name="rating" id="rating-2" value="2" required>
							<label for="rating-2" class="icon-material-outline-star"></label>
							<input type="radio" name="rating" id="rating-3" value="3" required>
							<label for="rating-3" class="icon-material-outline-star"></label>
							<input type="radio" name="rating" id="rating-4" value="4" required>
							<label for="rating-4" class="icon-material-outline-star"></label>
							<input type="radio" name="rating" id="rating-5" value="5" required>
							<label for="rating-5" class="icon-material-outline-star"></label>
						</div>
					</div>
					<div class="clearfix"></div>
					<!-- Leave Rating / End-->

				</div>


					

					<textarea class="with-border" placeholder="Review" name="message" id="message" cols="7"  required></textarea>

				</form>
				
				<!-- Button -->
				<button class="button margin-top-35 full-width button-sliding-icon ripple-effect" type="submit" form="leave-company-review-form">Leave a Review <i class="icon-material-outline-arrow-right-alt"></i></button>

			</div>

		</div>
	</div>
</div>
<!-- Leave a Review Popup / End -->

<!-- Leave a Review Popup
================================================== -->
<div id="small-dialog-2" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab">Revision</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab">
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Request Seller for Revision</h3>
					
				<!-- Form -->
				<form method="post" id="leave-company-review-form">

					<!-- Leave Rating -->
					
					<div class="clearfix"></div>
					<!-- Leave Rating / End-->

				</div>


					

					<textarea class="with-border" placeholder="Revision" name="message" id="message" cols="7"  required></textarea>

				</form>
				
				<!-- Button -->
				<button class="button margin-top-35 full-width button-sliding-icon ripple-effect" type="submit" form="leave-company-review-form">Send <i class="icon-material-outline-arrow-right-alt"></i></button>

			</div>

		</div>
	</div>
</div>
<!-- Leave a Review Popup / End -->



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

// Snackbar for copy to clipboard button
$('.copy-url-button').click(function() { 
	Snackbar.show({
		text: 'Copied to clipboard!',
	}); 
}); 
</script>

<!-- Google API & Maps -->
<!-- Geting an API Key: https://developers.google.com/maps/documentation/javascript/get-api-key -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgeuuDfRlweIs7D6uo4wdIHVvJ0LonQ6g&amp;libraries=places"></script>
<script src="js/infobox.min.js"></script>
<script src="js/markerclusterer.js"></script>
<script src="js/maps.js"></script>

</body>

<!-- Mirrored from www.vasterad.com/themes/hireo/single-job-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Feb 2019 10:27:51 GMT -->
</html>