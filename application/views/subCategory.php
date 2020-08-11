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
<header id="header-container" class="fullwidth not-sticky">

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
										<?php include("navigation.php");?>

				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
				
			</div>
			<!-- Left Side Content / End -->


			<!-- Right Side Content / End -->
			<div class="right-side">

			
			</div>
			<!-- Right Side Content / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->

<!-- Page Content
================================================== -->
<div class="full-page-container">

	<div class="full-page-sidebar">
		<div class="full-page-sidebar-inner" data-simplebar>
			<div class="sidebar-container">
				
				<!-- Location -->
				<div class="sidebar-widget">
					<h3>Seller Location</h3>
					<div class="input-with-icon">
						<div id="autocomplete-container">
							<input id="autocomplete-input" type="text" placeholder="Location">
						</div>
						<i class="icon-material-outline-location-on"></i>
					</div>
				</div>

				
				
				
				<!-- Category -->
				<div class="sidebar-widget">
					<h3>Category</h3>
					<select class="selectpicker default" multiple data-selected-text-format="count" data-size="7" title="All Categories" >
						<option>Admin Support</option>
						<option>Customer Service</option>
						<option>Data Analytics</option>
						<option>Design & Creative</option>
						<option>Legal</option>
						<option>Software Developing</option>
						<option>IT & Networking</option>
						<option>Writing</option>
						<option>Translation</option>
						<option>Sales & Marketing</option>
					</select>
				</div>

				<div class="sidebar-widget">
					<h3>SubCategory</h3>
					<select class="selectpicker default" multiple data-selected-text-format="count" data-size="7" title="All Categories" >
						<option>Admin Support</option>
						<option>Customer Service</option>
						<option>Data Analytics</option>
						<option>Design & Creative</option>
						<option>Legal</option>
						<option>Software Developing</option>
						<option>IT & Networking</option>
						<option>Writing</option>
						<option>Translation</option>
						<option>Sales & Marketing</option>
					</select>
				</div>
				
				<div class="sidebar-widget">
				<h3>Delivery Time</h3>
					<div class="radio">
						<input id="radio-1" name="radio" type="radio" checked="">
						<label for="radio-1"><span class="radio-label"></span> Up to 24 Hours</label>
					</div>

					<br>

					<div class="radio">
						<input id="radio-2" name="radio" type="radio">
						<label for="radio-2"><span class="radio-label"></span> Up to 3 days</label>
					</div>					<br>

					<div class="radio">
						<input id="radio-3" name="radio" type="radio">
						<label for="radio-3"><span class="radio-label"></span> Up to 7 days</label>
					</div>					<br>

					<div class="radio">
						<input id="radio-4" name="radio" type="radio">
						<label for="radio-5"><span class="radio-label"></span> Any</label>
					</div>
			    </div>

			    <div class="sidebar-widget">
					<h3>Online Status</h3>

					<!-- Range Slider -->
					<div class="switches-list">
					<div class="switch-container">
						<label class="switch"><input type="checkbox" checked=""><span class="switch-button"></span> Online</label>
					</div>

					
				</div>
				</div>

				<div class="sidebar-widget">
					<h3>Seller Language</h3>

					<!-- Range Slider -->
					<div class="checkbox">
						<input type="checkbox" id="chekcbox1" checked="">
						<label for="chekcbox1"><span class="checkbox-icon"></span> English</label>
					</div><br>
					<div class="checkbox">
						<input type="checkbox" id="chekcbox2" checked="">
						<label for="chekcbox2"><span class="checkbox-icon"></span> Urdu</label>
					</div>
				</div>

				<!-- Tags -->

				<!-- Salary -->
				<div class="sidebar-widget">
					<h3>Price Range</h3>
					<div class="margin-top-55"></div>

					<!-- Range Slider -->
					<input class="range-slider" type="text" value="" data-slider-currency="$" data-slider-min="1500" data-slider-max="15000" data-slider-step="100" data-slider-value="[1500,15000]"/>
				</div>

				<div class="sidebar-widget">
					<h3>Tags</h3>

					<div class="tags-container">
						<div class="tag">
							<input type="checkbox" id="tag1">
							<label for="tag1">front-end dev</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag2">
							<label for="tag2">angular</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag3">
							<label for="tag3">react</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag4">
							<label for="tag4">vue js</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag5">
							<label for="tag5">web apps</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag6">
							<label for="tag6">design</label>
						</div>
						<div class="tag">
							<input type="checkbox" id="tag7">
							<label for="tag7">wordpress</label>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

				<!-- Tags -->
				

			</div>
			<!-- Sidebar Container / End -->

			<!-- Search Button -->
			<div class="sidebar-search-button-container">
				<button class="button ripple-effect">Search</button>
			</div>
			<!-- Search Button / End-->

		</div>
	</div>
	<!-- Full Page Sidebar / End -->
	
	<!-- Full Page Content -->
	<div class="full-page-content-container" data-simplebar>
		<div class="full-page-content-inner">

			<h3 class="page-title">Search Results</h3>

			<div class="notify-box margin-top-15">
				

				<div class="sort-by">
					<span>Sort by:</span>
					<select class="selectpicker hide-tick">
						<option>Newest</option>
						<option>Oldest</option>
					</select>
				</div>
			</div>

			<div class="listings-container grid-layout margin-top-35">
				
				<!-- Job Listing -->
				<a href="<?php echo site_url();?>/welcome/categoryDetails" class="job-listing">

					<!-- Job Listing Details -->
					<div class="job-listing-details">
						<!-- Logo -->
						<div class="job-listing-company-logo">
							<img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="">
						</div>

						<!-- Details -->
						<div class="job-listing-description">
							<h4 class="job-listing-company">Faisal <span class="verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h4>
							<h3 class="job-listing-title">I Will Create Complete And Secure Website In PHP And Mysql</h3>
								<div class="freelancer-rating">
									<div class="star-rating" data-rating="4.9"></div>
								</div>
						</div>
					</div>

					<!-- Job Listing Footer -->
					<div class="job-listing-footer">
						<span class="bookmark-icon"></span>
						<ul>
							<li><i class="icon-material-outline-location-on"></i> San Francissco</li>
							<li><i class="icon-material-outline-business-center"></i> Full Time</li>
							<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
							<li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
						</ul>
					</div>
				</a>	

				<!-- Job Listing -->
				<a href="<?php echo site_url();?>/welcome/categoryDetails" class="job-listing">

					<!-- Job Listing Details -->
					<div class="job-listing-details">
						<!-- Logo -->
						<div class="job-listing-company-logo">
							<img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="">
						</div>

						<!-- Details -->
						<div class="job-listing-description">
							<h4 class="job-listing-company">Faisal <span class="verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h4>
							<h3 class="job-listing-title">I Will Create Complete And Secure Website In PHP And Mysql</h3>
								<div class="freelancer-rating">
									<div class="star-rating" data-rating="4.9"></div>
								</div>
						</div>
					</div>

					<!-- Job Listing Footer -->
					<div class="job-listing-footer">
						<span class="bookmark-icon"></span>
						<ul>
							<li><i class="icon-material-outline-location-on"></i> San Francissco</li>
							<li><i class="icon-material-outline-business-center"></i> Full Time</li>
							<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
							<li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
						</ul>
					</div>
				</a>	

				<!-- Job Listing -->
				<a href="<?php echo site_url();?>/welcome/categoryDetails" class="job-listing">

					<!-- Job Listing Details -->
					<div class="job-listing-details">
						<!-- Logo -->
						<div class="job-listing-company-logo">
							<img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="">
						</div>

						<!-- Details -->
						<div class="job-listing-description">
							<h4 class="job-listing-company">Faisal <span class="verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h4>
							<h3 class="job-listing-title">I Will Create Complete And Secure Website In PHP And Mysql</h3>
								<div class="freelancer-rating">
									<div class="star-rating" data-rating="4.9"></div>
								</div>
						</div>
					</div>

					<!-- Job Listing Footer -->
					<div class="job-listing-footer">
						<span class="bookmark-icon"></span>
						<ul>
							<li><i class="icon-material-outline-location-on"></i> San Francissco</li>
							<li><i class="icon-material-outline-business-center"></i> Full Time</li>
							<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
							<li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
						</ul>
					</div>
				</a>	
				

				<!-- Job Listing -->
				<a href="<?php echo site_url();?>/welcome/categoryDetails" class="job-listing">

					<!-- Job Listing Details -->
					<div class="job-listing-details">
						<!-- Logo -->
						<div class="job-listing-company-logo">
							<img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="">
						</div>

						<!-- Details -->
						<div class="job-listing-description">
							<h4 class="job-listing-company">Faisal <span class="verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h4>
							<h3 class="job-listing-title">I Will Create Complete And Secure Website In PHP And Mysql</h3>
								<div class="freelancer-rating">
									<div class="star-rating" data-rating="4.9"></div>
								</div>
						</div>
					</div>

					<!-- Job Listing Footer -->
					<div class="job-listing-footer">
						<span class="bookmark-icon"></span>
						<ul>
							<li><i class="icon-material-outline-location-on"></i> San Francissco</li>
							<li><i class="icon-material-outline-business-center"></i> Full Time</li>
							<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
							<li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
						</ul>
					</div>
				</a>	


				<!-- Job Listing -->
				<a href="<?php echo site_url();?>/welcome/categoryDetails" class="job-listing">

					<!-- Job Listing Details -->
					<div class="job-listing-details">
						<!-- Logo -->
						<div class="job-listing-company-logo">
							<img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="">
						</div>

						<!-- Details -->
						<div class="job-listing-description">
							<h4 class="job-listing-company">Faisal <span class="verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h4>
							<h3 class="job-listing-title">I Will Create Complete And Secure Website In PHP And Mysql</h3>
								<div class="freelancer-rating">
									<div class="star-rating" data-rating="4.9"></div>
								</div>
						</div>
					</div>

					<!-- Job Listing Footer -->
					<div class="job-listing-footer">
						<span class="bookmark-icon"></span>
						<ul>
							<li><i class="icon-material-outline-location-on"></i> San Francissco</li>
							<li><i class="icon-material-outline-business-center"></i> Full Time</li>
							<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
							<li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
						</ul>
					</div>
				</a>	

				<!-- Job Listing -->
				<a href="<?php echo site_url();?>/welcome/categoryDetails" class="job-listing">

					<!-- Job Listing Details -->
					<div class="job-listing-details">
						<!-- Logo -->
						<div class="job-listing-company-logo">
							<img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="">
						</div>

						<!-- Details -->
						<div class="job-listing-description">
							<h4 class="job-listing-company">Faisal <span class="verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h4>
							<h3 class="job-listing-title">I Will Create Complete And Secure Website In PHP And Mysql</h3>
								<div class="freelancer-rating">
									<div class="star-rating" data-rating="4.9"></div>
								</div>
						</div>
					</div>

					<!-- Job Listing Footer -->
					<div class="job-listing-footer">
						<span class="bookmark-icon"></span>
						<ul>
							<li><i class="icon-material-outline-location-on"></i> San Francissco</li>
							<li><i class="icon-material-outline-business-center"></i> Full Time</li>
							<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
							<li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
						</ul>
					</div>
				</a>	

				<!-- Job Listing -->
				<a href="<?php echo site_url();?>/welcome/categoryDetails" class="job-listing">

					<!-- Job Listing Details -->
					<div class="job-listing-details">
						<!-- Logo -->
						<div class="job-listing-company-logo">
							<img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="">
						</div>

						<!-- Details -->
						<div class="job-listing-description">
							<h4 class="job-listing-company">Faisal <span class="verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h4>
							<h3 class="job-listing-title">I Will Create Complete And Secure Website In PHP And Mysql</h3>
								<div class="freelancer-rating">
									<div class="star-rating" data-rating="4.9"></div>
								</div>
						</div>
					</div>

					<!-- Job Listing Footer -->
					<div class="job-listing-footer">
						<span class="bookmark-icon"></span>
						<ul>
							<li><i class="icon-material-outline-location-on"></i> San Francissco</li>
							<li><i class="icon-material-outline-business-center"></i> Full Time</li>
							<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
							<li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
						</ul>
					</div>
				</a>	

				<!-- Job Listing -->
				<a href="<?php echo site_url();?>/welcome/categoryDetails" class="job-listing">

					<!-- Job Listing Details -->
					<div class="job-listing-details">
						<!-- Logo -->
						<div class="job-listing-company-logo">
							<img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="">
						</div>

						<!-- Details -->
						<div class="job-listing-description">
							<h4 class="job-listing-company">Faisal <span class="verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h4>
							<h3 class="job-listing-title">I Will Create Complete And Secure Website In PHP And Mysql</h3>
								<div class="freelancer-rating">
									<div class="star-rating" data-rating="4.9"></div>
								</div>
						</div>
					</div>

					<!-- Job Listing Footer -->
					<div class="job-listing-footer">
						<span class="bookmark-icon"></span>
						<ul>
							<li><i class="icon-material-outline-location-on"></i> San Francissco</li>
							<li><i class="icon-material-outline-business-center"></i> Full Time</li>
							<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
							<li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
						</ul>
					</div>
				</a>	
				
				<!-- Job Listing -->
			<a href="<?php echo site_url();?>/welcome/categoryDetails" class="job-listing">

					<!-- Job Listing Details -->
					<div class="job-listing-details">
						<!-- Logo -->
						<div class="job-listing-company-logo">
							<img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="">
						</div>

						<!-- Details -->
						<div class="job-listing-description">
							<h4 class="job-listing-company">Faisal <span class="verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h4>
							<h3 class="job-listing-title">I Will Create Complete And Secure Website In PHP And Mysql</h3>
								<div class="freelancer-rating">
									<div class="star-rating" data-rating="4.9"></div>
								</div>
						</div>
					</div>

					<!-- Job Listing Footer -->
					<div class="job-listing-footer">
						<span class="bookmark-icon"></span>
						<ul>
							<li><i class="icon-material-outline-location-on"></i> San Francissco</li>
							<li><i class="icon-material-outline-business-center"></i> Full Time</li>
							<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
							<li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
						</ul>
					</div>
				</a>	
				
				<!-- Job Listing -->
				<a href="<?php echo site_url();?>/welcome/categoryDetails" class="job-listing">

					<!-- Job Listing Details -->
					<div class="job-listing-details">
						<!-- Logo -->
						<div class="job-listing-company-logo">
							<img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="">
						</div>

						<!-- Details -->
						<div class="job-listing-description">
							<h4 class="job-listing-company">Faisal <span class="verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h4>
							<h3 class="job-listing-title">I Will Create Complete And Secure Website In PHP And Mysql</h3>
								<div class="freelancer-rating">
									<div class="star-rating" data-rating="4.9"></div>
								</div>
						</div>
					</div>

					<!-- Job Listing Footer -->
					<div class="job-listing-footer">
						<span class="bookmark-icon"></span>
						<ul>
							<li><i class="icon-material-outline-location-on"></i> San Francissco</li>
							<li><i class="icon-material-outline-business-center"></i> Full Time</li>
							<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
							<li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
						</ul>
					</div>
				</a>	
				
				<!-- Job Listing -->
			<a href="<?php echo site_url();?>/welcome/categoryDetails" class="job-listing">

					<!-- Job Listing Details -->
					<div class="job-listing-details">
						<!-- Logo -->
						<div class="job-listing-company-logo">
							<img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="">
						</div>

						<!-- Details -->
						<div class="job-listing-description">
							<h4 class="job-listing-company">Faisal <span class="verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h4>
							<h3 class="job-listing-title">I Will Create Complete And Secure Website In PHP And Mysql</h3>
								<div class="freelancer-rating">
									<div class="star-rating" data-rating="4.9"></div>
								</div>
						</div>
					</div>

					<!-- Job Listing Footer -->
					<div class="job-listing-footer">
						<span class="bookmark-icon"></span>
						<ul>
							<li><i class="icon-material-outline-location-on"></i> San Francissco</li>
							<li><i class="icon-material-outline-business-center"></i> Full Time</li>
							<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
							<li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
						</ul>
					</div>
				</a>	

				<!-- Job Listing -->
				<a href="<?php echo site_url();?>/welcome/categoryDetails" class="job-listing">

					<!-- Job Listing Details -->
					<div class="job-listing-details">
						<!-- Logo -->
						<div class="job-listing-company-logo">
							<img src="<?php echo base_url();?>/assets/images/gig/convert-psd-to-html5.jpg" alt="">
						</div>

						<!-- Details -->
						<div class="job-listing-description">
							<h4 class="job-listing-company">Faisal <span class="verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h4>
							<h3 class="job-listing-title">I Will Create Complete And Secure Website In PHP And Mysql</h3>
								<div class="freelancer-rating">
									<div class="star-rating" data-rating="4.9"></div>
								</div>
						</div>
					</div>

					<!-- Job Listing Footer -->
					<div class="job-listing-footer">
						<span class="bookmark-icon"></span>
						<ul>
							<li><i class="icon-material-outline-location-on"></i> San Francissco</li>
							<li><i class="icon-material-outline-business-center"></i> Full Time</li>
							<li><i class="icon-material-outline-account-balance-wallet"></i> $35000-$38000</li>
							<li><i class="icon-material-outline-access-time"></i> 2 days ago</li>
						</ul>
					</div>
				</a>	

			</div>

			<!-- Pagination -->
			<div class="clearfix"></div>
			<div class="pagination-container margin-top-20 margin-bottom-20">
				<nav class="pagination">
					<ul>
						<li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>
						<li><a href="#" class="ripple-effect">1</a></li>
						<li><a href="#" class="ripple-effect current-page">2</a></li>
						<li><a href="#" class="ripple-effect">3</a></li>
						<li><a href="#" class="ripple-effect">4</a></li>
						<li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
					</ul>
				</nav>
			</div>
			<div class="clearfix"></div>
			<!-- Pagination / End -->

			<!-- Footer -->
			<div class="small-footer margin-top-15">
				<div class="small-footer-copyrights">
					© 2019 <strong><?php echo $this->config->item('app_name');?></strong>. All Rights Reserved.
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
	<!-- Full Page Content / End -->

</div>


</div>
<!-- Wrapper / End -->

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
</script>

<!-- Google Autocomplete -->
<script>
	function initAutocomplete() {
		 var options = {
		  types: ['(cities)'],
		  // componentRestrictions: {country: "us"}
		 };

		 var input = document.getElementById('autocomplete-input');
		 var autocomplete = new google.maps.places.Autocomplete(input, options);
	}
</script>

<!-- Google API & Maps -->
<!-- Geting an API Key: https://developers.google.com/maps/documentation/javascript/get-api-key -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgeuuDfRlweIs7D6uo4wdIHVvJ0LonQ6g&amp;libraries=places&amp;callback=initAutocomplete"></script>

</body>


</html>