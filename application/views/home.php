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

    document.getElementById("homepage").className = "current";
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
					<a href="<?php echo site_url();?>/welcome"><img src="<?php echo base_url();?>assets/images/logo2.png"></a>
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

				<!--  User Notifications -->
				<div class="header-widget hide-on-mobile">
					
					<!-- Notifications -->
					<div class="header-notifications">

						<div class="intro-search-button">
						<button class="button ripple-effect" onclick="window.location.href='<?php echo site_url();?>/welcome/signUp'">Join Now</button>
					</div>
					

					</div>
					
					

				</div>
				<!--  User Notifications / End -->

				<!-- User Menu -->
			
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



<!-- Intro Banner
================================================== -->
<div class="intro-banner" data-background-image="<?php echo base_url();?>/assets/images/home-background.jpg">

	<!-- Transparent Header Spacer -->
	<div class="transparent-header-spacer"></div>

	<div class="container">
		
		<!-- Intro Headline -->
		<div class="row">
			<div class="col-md-12">
				<div class="banner-headline">
					<h3>
						<strong>Gigpeople  have a collection of creatives, correctors, developers, editors, designers, writers and much more - ready to do whatever you want</strong>
						<!-- <br>
						<span></span> -->
					</h3>
				</div>
			</div>
		</div>
		
		<!-- Search Bar -->
		<div class="row">
			<div class="col-md-12">
				<div class="intro-banner-search-form margin-top-95">

					<!-- Search Field -->
					<!-- <div class="intro-search-field with-autocomplete">
						<label for="autocomplete-input" class="field-title ripple-effect">Where?</label>
						<div class="input-with-icon">
							<input id="autocomplete-input" type="text" placeholder="Online Job">
							<i class="icon-material-outline-location-on"></i>
						</div>
					</div>
 -->
					<!-- Search Field -->
					<div class="intro-search-field">
						<label for ="intro-keywords" class="field-title ripple-effect">What you need done?</label>
						<input id="intro-keywords" type="text" placeholder="e.g. build me a website">
					</div>

					<!-- Search Field -->
					<div class="intro-search-field">
						<select class="selectpicker default" multiple data-selected-text-format="count" data-size="7" title="All Categories" >
							<option>Graphics and Design</option>
							<option>Digital Marketing</option>
							<option>Writing and Translation</option>
							<option>Video & Animation</option>
							<option>Music & Video</option>
							<option>Programming & Tech</option>
							<option>Advertising</option>
							<option>Business</option>
							<option>Fun & Lifestyle</option>
						</select>
					</div>

					<!-- Button -->
					<div class="intro-search-button">
						<button class="button ripple-effect">Search</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Stats -->
		<div class="row">
			<div class="col-md-12">
				<ul class="intro-stats margin-top-45 hide-under-992px">
					<li>
						<strong class="counter">1,586</strong>
						<span>Gigs Posted</span>
					</li>
					<li>
						<strong class="counter">3,543</strong>
						<span>Completed Requests</span>
					</li>
					<li>
						<strong class="counter">1,232</strong>
						<span>Sellers</span>
					</li>
				</ul>
			</div>
		</div>

	</div>
</div>


<!-- Content
================================================== -->

<!-- Popular Job Categories -->
<div class="section margin-top-65 margin-bottom-30">
	<div class="container">
		<div class="row">

			<!-- Section Headline -->
			<div class="col-xl-12">
				<div class="section-headline centered margin-top-0 margin-bottom-45">
					<h3>Popular Categories</h3>
				</div>
			</div>

			<div class="categories-container">

					<!-- Category Box -->
					<a href="<?php echo site_url();?>/welcome/subCategory" class="category-box">
						<div class="category-box-icon">
							<i class="icon-line-awesome-file-code-o"></i>
						</div>
						<div class="category-box-counter">612</div>
						<div class="category-box-content">
							<h3>Web & Software Dev</h3>
							<p>Software Engineer, Web / Mobile Developer & More</p>
						</div>
					</a>

					<!-- Category Box -->
					<a href="<?php echo site_url();?>/welcome/subCategory" class="category-box">
						<div class="category-box-icon">
							<i class="icon-line-awesome-cloud-upload"></i>
						</div>
						<div class="category-box-counter">113</div>
						<div class="category-box-content">
							<h3>Data Science & Analitycs</h3>
							<p>Data Specialist / Scientist, Data Analyst & More</p>
						</div>
					</a>

					<!-- Category Box -->
					<a href="<?php echo site_url();?>/welcome/subCategory" class="category-box">
						<div class="category-box-icon">
							<i class="icon-line-awesome-suitcase"></i>
						</div>
						<div class="category-box-counter">186</div>
						<div class="category-box-content">
							<h3>Accounting & Consulting</h3>
							<p>Auditor, Accountant, Fnancial Analyst & More</p>
						</div>
					</a>

					<!-- Category Box -->
					<a href="<?php echo site_url();?>/welcome/subCategory" class="category-box">
						<div class="category-box-icon">
							<i class="icon-line-awesome-pencil"></i>
						</div>
						<div class="category-box-counter">298</div>
						<div class="category-box-content">
							<h3>Writing & Translations</h3>
							<p>Copywriter, Creative Writer, Translator & More</p>
						</div>
					</a>

					<!-- Category Box -->
					<a href="<?php echo site_url();?>/welcome/subCategory" class="category-box">
						<div class="category-box-icon">
							<i class="icon-line-awesome-pie-chart"></i>
						</div>
						<div class="category-box-counter">549</div>						
						<div class="category-box-content">
							<h3>Sales & Marketing</h3>
							<p>Brand Manager, Marketing Coordinator & More</p>
						</div>
					</a>

					<!-- Category Box -->
					<a href="<?php echo site_url();?>/welcome/subCategory" class="category-box">
						<div class="category-box-icon">
							<i class="icon-line-awesome-image"></i>
						</div>
						<div class="category-box-counter">873</div>
						<div class="category-box-content">
							<h3>Graphics & Design</h3>
							<p>Creative Director, Web Designer & More</p>
						</div>
					</a>

					<!-- Category Box -->
					<a href="<?php echo site_url();?>/welcome/subCategory" class="category-box">
						<div class="category-box-icon">
							<i class="icon-line-awesome-bullhorn"></i>
						</div>
						<div class="category-box-counter">125</div>
						<div class="category-box-content">
							<h3>Digital Marketing</h3>
							<p>Darketing Analyst, Social Profile Admin & More</p>
						</div>
					</a>

					<!-- Category Box -->
					<a href="<?php echo site_url();?>/welcome/subCategory" class="category-box">
						<div class="category-box-icon">
							<i class="icon-line-awesome-graduation-cap"></i>
						</div>
						<div class="category-box-counter">445</div>
						<div class="category-box-content">
							<h3>Education & Training</h3>
							<p>Advisor, Coach, Education Coordinator & More</p>
						</div>
					</a>

				</div>


		</div>
	</div>
</div>
<!-- Features Cities / End -->



<!-- Features Jobs -->
<div class="section gray margin-top-45 padding-top-65 padding-bottom-75">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				
				<!-- Section Headline -->
				<div class="section-headline margin-top-0 margin-bottom-35">
					<h3>Recent Requests</h3>
					<a href="#">Browse All Requests</a>
				</div>
				
				<!-- Jobs Container -->
				<div class="tasks-list-container compact-list margin-top-35">
						
					<!-- Task -->
					<a href="#" class="task-listing">

						<!-- Job Listing Details -->
						<div class="task-listing-details">

							<!-- Details -->
							<div class="task-listing-description">
								<h3 class="task-listing-title">Food Delviery Mobile App</h3>
								<ul class="task-icons">
									<li><i class="icon-material-outline-location-on"></i> San Francisco</li>
									<li><i class="icon-material-outline-access-time"></i> 2 minutes ago</li>
								</ul>
								<div class="task-tags margin-top-15">
									<span>iOS</span>
									<span>Android</span>
									<span>mobile apps</span>
									<span>design</span>
								</div>
							</div>

						</div>

						<div class="task-listing-bid">
							<div class="task-listing-bid-inner">
								<div class="task-offers">
									<strong>$1,000 - $2,500</strong>
									<span>Fixed Price</span>
								</div>
								<span class="button button-sliding-icon ripple-effect">Send Offer <i class="icon-material-outline-arrow-right-alt"></i></span>
							</div>
						</div>
					</a>

					<!-- Task -->
					<a href="#" class="task-listing">

						<!-- Job Listing Details -->
						<div class="task-listing-details">

							<!-- Details -->
							<div class="task-listing-description">
								<h3 class="task-listing-title">2000 Words English to German</h3>
								<ul class="task-icons">
									<li><i class="icon-material-outline-location-off"></i> Online Job</li>
									<li><i class="icon-material-outline-access-time"></i> 5 minutes ago</li>
								</ul>
								<div class="task-tags margin-top-15">
									<span>copywriting</span>
									<span>translating</span>
									<span>editing</span>
								</div>
							</div>

						</div>

						<div class="task-listing-bid">
							<div class="task-listing-bid-inner">
								<div class="task-offers">
									<strong>$75</strong>
									<span>Fixed Price</span>
								</div>
								<span class="button button-sliding-icon ripple-effect">Send Offer <i class="icon-material-outline-arrow-right-alt"></i></span>
							</div>
						</div>
					</a>

					<!-- Task -->
					<a href="#" class="task-listing">

						<!-- Job Listing Details -->
						<div class="task-listing-details">

							<!-- Details -->
							<div class="task-listing-description">
								<h3 class="task-listing-title">Fix Python Selenium Code</h3>
								<ul class="task-icons">
									<li><i class="icon-material-outline-location-off"></i> Online Job</li>
									<li><i class="icon-material-outline-access-time"></i> 30 minutes ago</li>
								</ul>
								<div class="task-tags margin-top-15">
									<span>Python</span>
									<span>Flask</span>
									<span>API Development</span>
								</div>
							</div>

						</div>

						<div class="task-listing-bid">
							<div class="task-listing-bid-inner">
								<div class="task-offers">
									<strong>$100 - $150</strong>
									<span>Hourly Rate</span>
								</div>
								<span class="button button-sliding-icon ripple-effect">Send Offer <i class="icon-material-outline-arrow-right-alt"></i></span>
							</div>
						</div>
					</a>

					<!-- Task -->
					<a href="#" class="task-listing">

						<!-- Job Listing Details -->
						<div class="task-listing-details">

							<!-- Details -->
							<div class="task-listing-description">
								<h3 class="task-listing-title">WordPress Theme Installation</h3>
								<ul class="task-icons">
									<li><i class="icon-material-outline-location-off"></i> Online Job</li>
									<li><i class="icon-material-outline-access-time"></i> 1 hour ago</li>
								</ul>
								<div class="task-tags margin-top-15">
									<span>WordPress</span>
									<span>Theme Installation</span>
								</div>
							</div>

						</div>

						<div class="task-listing-bid">
							<div class="task-listing-bid-inner">
								<div class="task-offers">
									<strong>$100</strong>
									<span>Fixed Price</span>
								</div>
								<span class="button button-sliding-icon ripple-effect">Send Offer <i class="icon-material-outline-arrow-right-alt"></i></span>
							</div>
						</div>
					</a>

					<!-- Task -->
					<a href="#" class="task-listing">

						<!-- Job Listing Details -->
						<div class="task-listing-details">

							<!-- Details -->
							<div class="task-listing-description">
								<h3 class="task-listing-title">PHP Core Website Fixes</h3>
								<ul class="task-icons">
									<li><i class="icon-material-outline-location-off"></i> Online Job</li>
									<li><i class="icon-material-outline-access-time"></i> 1 hour ago</li>
								</ul>
								<div class="task-tags margin-top-15">
									<span>PHP</span>
									<span>MySQL Administration</span>
									<span>API Development</span>
								</div>
							</div>

						</div>

						<div class="task-listing-bid">
							<div class="task-listing-bid-inner">
								<div class="task-offers">
									<strong>$50 - $80</strong>
									<span>Hourly Rate</span>
								</div>
								<span class="button button-sliding-icon ripple-effect">Send Offer <i class="icon-material-outline-arrow-right-alt"></i></span>
							</div>
						</div>
					</a>		


				</div>
				<!-- Jobs Container / End -->

			</div>
		</div>
	</div>
</div>
<!-- Featured Jobs / End -->

<!-- Icon Boxes -->
<div class="section padding-top-65 padding-bottom-65">
	<div class="container">
		<div class="row">

			<div class="col-xl-12">
				<!-- Section Headline -->
				<div class="section-headline centered margin-top-0 margin-bottom-5">
					<h3>How Post a request Works?</h3>
				</div>
			</div>
			
			<div class="col-xl-4 col-md-4">
				<!-- Icon Box -->
				<div class="icon-box with-line">
					<!-- Icon -->
					<div class="icon-box-circle">
						<div class="icon-box-circle-inner">
							<i class="icon-line-awesome-lock"></i>
							<div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
						</div>
					</div>
					<h3>Create an Account</h3>
					<p>Bring to the table win-win survival strategies to ensure proactive domination going forward.</p>
				</div>
			</div>

			<div class="col-xl-4 col-md-4">
				<!-- Icon Box -->
				<div class="icon-box with-line">
					<!-- Icon -->
					<div class="icon-box-circle">
						<div class="icon-box-circle-inner">
							<i class="icon-line-awesome-legal"></i>
							<div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
						</div>
					</div>
					<h3>Post a Requirement</h3>
					<p>Efficiently unleash cross-media information without. Quickly maximize return on investment.</p>
				</div>
			</div>

			<div class="col-xl-4 col-md-4">
				<!-- Icon Box -->
				<div class="icon-box">
					<!-- Icon -->
					<div class="icon-box-circle">
						<div class="icon-box-circle-inner">
							<i class=" icon-line-awesome-trophy"></i>
							<div class="icon-box-check"><i class="icon-material-outline-check"></i></div>
						</div>
					</div>
					<h3>Choose an Expert</h3>
					<p>Nanotechnology immersion along the information highway will close the loop on focusing solely.</p>
				</div>
			</div>

		</div>
	</div>
</div>
<!-- Icon Boxes / End -->


<!-- Testimonials -->
<div class="section gray padding-top-65 padding-bottom-55">
	
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<!-- Section Headline -->
				<div class="section-headline centered margin-top-0 margin-bottom-5">
					<h3>Testimonials</h3>
				</div>
			</div>
		</div>
	</div>

	<!-- Categories Carousel -->
	<div class="fullwidth-carousel-container margin-top-20">
		<div class="testimonial-carousel testimonials">

			<!-- Item -->
			<div class="fw-carousel-review">
				<div class="testimonial-box">
					<div class="testimonial-avatar">
						<img src="<?php echo base_url();?>/assets/images/user-avatar-small-02.jpg" alt="">
					</div>
					<div class="testimonial-author">
						<h4>Sindy Forest</h4>
						 <span>Freelancer</span>
					</div>
					<div class="testimonial">Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions.</div>
				</div>
			</div>

			<!-- Item -->
			<div class="fw-carousel-review">
				<div class="testimonial-box">
					<div class="testimonial-avatar">
						<img src="<?php echo base_url();?>/assets/images/user-avatar-small-01.jpg" alt="">
					</div>
					<div class="testimonial-author">
						<h4>Tom Smith</h4>
						 <span>Freelancer</span>
					</div>
					<div class="testimonial">Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art.</div>
				</div>
			</div>

			<!-- Item -->
			<div class="fw-carousel-review">
				<div class="testimonial-box">
					<div class="testimonial-avatar">
						<img src="<?php echo base_url();?>/assets/images/user-avatar-placeholder.png" alt="">
					</div>
					<div class="testimonial-author">
						<h4>Sebastiano Piccio</h4>
						 <span>Employer</span>
					</div>
					<div class="testimonial">Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art.</div>
				</div>
			</div>

			<!-- Item -->
			<div class="fw-carousel-review">
				<div class="testimonial-box">
					<div class="testimonial-avatar">
						<img src="images/user-avatar-small-03.jpg" alt="">
					</div>
					<div class="testimonial-author">
						<h4>David Peterson</h4>
						 <span>Freelancer</span>
					</div>
					<div class="testimonial">Collaboratively administrate turnkey channels whereas virtual e-tailers. Objectively seize scalable metrics whereas proactive e-services. Seamlessly empower fully researched growth strategies and interoperable sources.</div>
				</div>
			</div>

			<!-- Item -->
			<div class="fw-carousel-review">
				<div class="testimonial-box">
					<div class="testimonial-avatar">
						<img src="images/user-avatar-placeholder.png" alt="">
					</div>
					<div class="testimonial-author">
						<h4>Marcin Kowalski</h4>
						 <span>Freelancer</span>
					</div>
					<div class="testimonial">Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions.</div>
				</div>
			</div>

		</div>
	</div>
	<!-- Categories Carousel / End -->

</div>
<!-- Testimonials / End -->


<!-- Counters -->
<div class="section padding-top-70 padding-bottom-75">
	<div class="container">
		<div class="row">

			<div class="col-xl-12">
				<div class="counters-container">
					
					<!-- Counter -->
					<div class="single-counter">
						<i class="icon-line-awesome-suitcase"></i>
						<div class="counter-inner">
							<h3><span class="counter">1,586</span></h3>
							<span class="counter-title">Gigs Posted</span>
						</div>
					</div>

					<!-- Counter -->
					<div class="single-counter">
						<i class="icon-line-awesome-legal"></i>
						<div class="counter-inner">
							<h3><span class="counter">3,543</span></h3>
							<span class="counter-title">Requests Posted</span>
						</div>
					</div>

					<!-- Counter -->
					<div class="single-counter">
						<i class="icon-line-awesome-user"></i>
						<div class="counter-inner">
							<h3><span class="counter">2,413</span></h3>
							<span class="counter-title">Active Members</span>
						</div>
					</div>

					<!-- Counter -->
					<div class="single-counter">
						<i class="icon-line-awesome-trophy"></i>
						<div class="counter-inner">
							<h3><span class="counter">99</span>%</h3>
							<span class="counter-title">Satisfaction Rate</span>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- Counters / End -->


<!-- Footer
================================================== -->
<?php

include("footer.php");
?>

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

	// Autocomplete adjustment for homepage
	if ($('.intro-banner-search-form')[0]) {
	    setTimeout(function(){ 
	        $(".pac-container").prependTo(".intro-search-field.with-autocomplete");
	    }, 300);
	}

</script>

<!-- Google API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgeuuDfRlweIs7D6uo4wdIHVvJ0LonQ6g&amp;libraries=places&amp;callback=initAutocomplete"></script>

</body>


</html>