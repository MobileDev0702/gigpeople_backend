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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>



<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
    
$( document ).ready(function() {

    document.getElementById("signpage").className = "current";
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
		
			<!-- Right Side Content / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->

<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Log In</h2>

				<!-- Breadcrumbs -->
				<!-- <nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li>Log In</li>
					</ul>
				</nav> -->

			</div>
		</div>
	</div>
</div>


<!-- Page Content
================================================== -->
<div class="container">
	<div class="row">
		<div class="col-xl-5 offset-xl-3">


			<div class="login-register-page">
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>We're glad to see you again!</h3>
					<span>Don't have an account? <a href="<?php echo site_url();?>/welcome/signUp">Sign Up!</a></span>
				</div>
					
				<!-- Form -->
				<form method="post" id="login-form">
					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" name="emailaddress" id="emailaddress" placeholder="Email or  Mobile Number" required/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-outline-lock"></i>
						<input type="password" class="input-text with-border" name="password" id="password" placeholder="Password" required/>
					</div>

					<div class="input-with-icon-left">

					 <table align="center">
					 	<tr><td><div class="g-recaptcha" data-sitekey="6Le3NI8UAAAAAA06nMC9bNJvGkWbeCFZeouosbpa"></div></td></tr>
					 </table>

					 </div>

					

					   
					<br>

					<a href="#" class="forgot-password" data-toggle="modal" data-target="#forgotpassword" style="text-decoration: none">Forgot Password?</a>
					<br>
				</form>
				
				<!-- Button -->
				<button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form"  onclick="loadPage()">Log In <i class="icon-material-outline-arrow-right-alt"></i></button>
				
				<!-- Social Login -->
				<div class="social-login-separator"><span>or</span></div>
				<div class="social-login-buttons">
					<button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> Log In via Facebook</button>
					<button class="google-login ripple-effect"><i class="icon-brand-google"></i> Log In via Google</button>
				</div>
			</div>

		</div>
	</div>
</div>


<!-- Spacer -->
<div class="margin-top-70"></div>
<!-- Spacer / End-->

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






<!-- Modal -->
  <div class="modal fade" id="forgotpassword" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #FF6F00;color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Forgot Password</h4>
        </div>
        <div class="modal-body">
          <form method="post" id="login-form">
					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" name="emailaddress" id="emailaddress" placeholder="Email Address / Mobile Number" required/>
					</div>

					
					

					   
					
				</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" >Submit</button>
        </div>
      </div>
      
    </div>
  </div>

<!-- Modal -->












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

function loadPage()
{
	location.href="<?php echo site_url();?>/welcome/dashboard";
}
</script>

</body>


</html>