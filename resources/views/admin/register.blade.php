<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="POS - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Login - Pos admin template</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
        <!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
    </head>
    <body class="account-page">

        <div id="global-loader" >
			<div class="whirly-loader"> </div>
		</div>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<div class="login-wrapper login-new">
                    <div class="login-content user-login">
                        <div class="login-logo">
                            <img src="assets/img/logo.png" alt="img">
                            <a href="index.html" class="login-logo logo-white">
                                <img src="assets/img/logo-white.png"  alt="">
                            </a>
                        </div>
                        <form action="signin-3.html">
                            <div class="login-userset">
                                <div class="login-userheading">
                                    <h3>Register</h3>
                                    <h4>Create New Dreamspos Account</h4>
                                </div>
                                <div class="form-login">
                                    <label>Name</label>
                                    <div class="form-addons">
                                        <input type="text" class="form-control">
                                        <img src="assets/img/icons/user-icon.svg" alt="img">
                                    </div>
                                </div>
                                <div class="form-login">
                                    <label>Email Address</label>
                                    <div class="form-addons">
                                        <input type="text" class="form-control">
                                        <img src="assets/img/icons/mail.svg" alt="img">
                                    </div>
                                </div>
                                <div class="form-login">
                                    <label>Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-input">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>
                                <div class="form-login">
                                    <label>Confirm Passworrd</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-inputs">
                                        <span class="fas toggle-passwords fa-eye-slash"></span>
                                    </div>
                                </div>
                                <div class="form-login authentication-check">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="custom-control custom-checkbox justify-content-start">
                                                <div class="custom-control custom-checkbox">
                                                    <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                                        <input type="checkbox">
                                                        <span class="checkmarks"></span>I agree to the <a href="#" class="hover-a">Terms & Privacy</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-login">
                                    <button type="submit" class="btn btn-login">Sign Up</button>
                                </div>
                                <div class="signinform">
                                    <h4>Already have an account ? <a href="{{ route('login') }}" class="hover-a">Sign In Instead</a></h4>
                                </div>
                                <div class="form-setlogin or-text">
                                    <h4>OR</h4>
                                </div>
                                <div class="form-sociallink">
                                    <ul class="d-flex">
                                        <li>
                                            <a href="javascript:void(0);" class="facebook-logo">
                                                <img src="assets/img/icons/facebook-logo.svg" alt="Facebook">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="assets/img/icons/google.png" alt="Google">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="apple-logo">
                                                <img src="assets/img/icons/apple-logo.svg" alt="Apple">
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                        <p>Copyright &copy; 2023 DreamsPOS. All rights reserved.</p>
                    </div>
                </div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		<div class="customizer-links" id="setdata">
			<ul class="sticky-sidebar">
				<li class="sidebar-icons">
					<a href="#" class="navigation-add" data-bs-toggle="tooltip" data-bs-placement="left"
						data-bs-original-title="Theme">
						<i data-feather="settings" class="feather-five"></i>
					</a>
				</li>
			</ul>
		</div>

		<!-- jQuery -->
        <script src="assets/js/jquery-3.7.1.min.js"></script>

         <!-- Feather Icon JS -->
		<script src="assets/js/feather.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
		
		<!-- Custom JS --><script src="assets/js/theme-script.js"></script>	
		<script src="assets/js/script.js"></script>

	
    </body>
</html>