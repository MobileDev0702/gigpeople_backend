<!doctype html>
<html lang="en">


<head>

<!-- Basic Page Needs
================================================== -->
<title>..:: <?php echo $this->config->item('app_name');?> ::..</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/fav.png">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!-- CSS
================================================== -->
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/style.css">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/colors/blue.css">


<script type="text/javascript">
    
$( document ).ready(function() {

    document.getElementById("aboutpage").className = "current";
});
</script>   

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
					<a href="<?php echo site_url();?>/welcome/home"><img src="<?php echo base_url();?>/assets/images/logo2.png" alt=""></a>
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



<!-- Content
================================================== -->


<!-- Section -->
<div class="section gray">
	<div class="container">


		<div class="row">
			<div class="col-xl-12 col-lg-8">

				<!-- Section Headline -->
				<div class="section-headline margin-top-60 margin-bottom-35">
					<h4>Welcome To GigPeople !!</h4>
				</div>

				<!-- Blog Post -->
				<a href="#" class="blog-post">
					<!-- Blog Post Thumbnail -->
					<div class="blog-post-thumbnail">
						<div class="blog-post-thumbnail-inner">
							<img src="<?php echo base_url();?>/assets/images/blog-01a.jpg" alt="">
						</div>
					</div>
					<!-- Blog Post Content -->
					<div class="blog-post-content">
						<span class="blog-post-date">22 July 2019</span>
						<h3>About</h3>
						<p>Efficiently myocardinate market-driven innovation via open-source alignments. Dramatically engage high-payoff infomediaries rather than. </p>
					</div>
					<!-- Icon -->
					<div class="entry-icon"></div>
				</a>
				
				<!-- Blog Post -->
				

				

			</div>


			

		</div>
	</div>

	<!-- Spacer -->
	<div class="padding-top-40"></div>
	<!-- Spacer -->

</div>
<!-- Section / End -->

<!-- Photo Section -->
<div class="photo-section" data-background-image="<?php echo base_url();?>/assets/images/section-background.jpg">

	<!-- Infobox -->
	<div class="text-content white-font">
		<div class="container">

			<div class="row">


				<div class="col-lg-6 col-md-8 col-sm-12">
					<h2>Hire experts or be hired. <br> For any job, any time.</h2>
					<p>Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation is on the runway towards.</p>
					<a href="<?php echo site_url();?>/welcome/signUp" class="button button-sliding-icon ripple-effect big margin-top-20">Get Started <i class="icon-material-outline-arrow-right-alt"></i></a>
				</div>
			</div>

		</div>
	</div>

	<!-- Infobox / End -->

</div>
<!-- Photo Section / End -->

	

<!-- Recent Blog Posts -->
<div class="section white padding-top-0 padding-bottom-60 full-width-carousel-fix">
	<div class="container">
		<div class="row">

				<div class="section-headline margin-top-60 margin-bottom-35">
					<h4>&nbsp;&nbsp;Recent Gigs</h4>
				</div>
			<div class="col-xl-12">
				<div class="blog-carousel">

					<a href="<?php echo site_url();?>/welcome/categoryDetails" class="blog-compact-item-container">
						<div class="blog-compact-item">
							<img src="<?php echo base_url();?>/assets/images/blog-04a.jpg" alt="">
							<div class="blog-compact-item-content">
								<ul class="blog-post-tags">
									<li>20 May 2019</li>
								</ul>
								<h3>Deliver Best Logo Design</h3>
								<p>Distinctively reengineer revolutionary meta-services and premium architectures intuitive opportunities.</p>
							</div>
						</div>
					</a>

					<a href="#" class="blog-compact-item-container">
						<div class="blog-compact-item">
							<img src="<?php echo base_url();?>/assets/images/blog-04a.jpg" alt="">
							<div class="blog-compact-item-content">
								<ul class="blog-post-tags">
									<li>20 May 2019</li>
								</ul>
								<h3>Deliver Best Logo Design</h3>
								<p>Distinctively reengineer revolutionary meta-services and premium architectures intuitive opportunities.</p>
							</div>
						</div>
					</a>

					<a href="#" class="blog-compact-item-container">
						<div class="blog-compact-item">
							<img src="<?php echo base_url();?>/assets/images/blog-04a.jpg" alt="">
							<div class="blog-compact-item-content">
								<ul class="blog-post-tags">
									<li>20 May 2019</li>
								</ul>
								<h3>Deliver Best Logo Design</h3>
								<p>Distinctively reengineer revolutionary meta-services and premium architectures intuitive opportunities.</p>
							</div>
						</div>
					</a>

					<a href="#" class="blog-compact-item-container">
						<div class="blog-compact-item">
							<img src="<?php echo base_url();?>/assets/images/blog-04a.jpg" alt="">
							<div class="blog-compact-item-content">
								<ul class="blog-post-tags">
									<li>20 May 2019</li>
								</ul>
								<h3>Deliver Best Logo Design</h3>
								<p>Distinctively reengineer revolutionary meta-services and premium architectures intuitive opportunities.</p>
							</div>
						</div>
					</a>
					

				</div>

			</div>
		</div>
	</div>
</div>
<!-- Recent Blog Posts / End -->

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
							<li><a href="#"><span>Post Requests</span></a></li>
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
							<li><a href="#"><span>Offer Requests</span></a></li>
							<li><a href="#"><span>Get Hired</span></a></li>
						</ul>
					</div>
				</div>

				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>Helpful Links</h3>
						<ul>
							<li><a href="<?php echo site_url();?>/welcome/contact"><span>Help & Support</span></a></li>
							<li><a href="<?php echo site_url();?>/welcome/privacy"><span>Privacy Policy</span></a></li>
							<li><a href="<?php echo site_url();?>/welcome/terms"><span>Terms of Use</span></a></li>
						</ul>
					</div>
				</div>

				<!-- Links -->
				<div class="col-xl-2 col-lg-2 col-md-3">
					<div class="footer-links">
						<h3>Account</h3>
						<ul>
							<li><a href="<?php echo site_url();?>/welcome/login"><span>Log In</span></a></li>
							<li><a href="<?php echo site_url();?>/welcome/signUp"><span>My Account</span></a></li>
						</ul>
					</div>
				</div>

				<!-- Newsletter -->
					<div class="col-xl-4 col-lg-4 col-md-12">
					<div class="footer-links">
						<h3>Categories</h3>
						<ul>
							<li><a href="#"><span>Graphics and Design</span></a></li>
							<li><a href="#"><span>Digital Marketing</span></a></li>
							<li><a href="#"><span>Writing and Translation</span></a></li>
							<li><a href="<?php echo site_url();?>/welcome/subCategory"><span>More</span></a></li>
							
						</ul>
					</div>
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

</body>

</html>