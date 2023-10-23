<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="POS - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Login - Control </title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>public/assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url();?>public/assets/css/bootstrap.min.css">
		
        <!-- Fontawesome CSS -->
		<link rel="stylesheet" href="<?php echo base_url();?>public/assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>public/assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo base_url();?>public/assets/css/style.css">
		
    </head>
    <body class="account-page">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<div class="login-wrapper">
                    <div class="login-content">
                        <form role="form" method="post" action="<?php echo base_url(); ?>login" id="formLogin">
                            <div class="login-userset">
                                <div class="login-logo">
                                    <img src="<?php echo base_url();?>public/assets/img/logo.png" alt="img">
                                </div>
                                <div class="login-userheading">
                                    <h3>Sign In</h3>
                                    <h4></h4>
                                </div>
                                <div class="form-login">
                                    <label>Email</label>
                                    <div class="form-addons">
                                        <input id="email" type="text" placeholder="Enter your email address">
                                        <img src="<?php echo base_url();?>public/assets/img/icons/mail.svg" alt="img">
                                    </div>
                                </div>
                                <div class="form-login">
                                    <label>Password</label>
                                    <div class="pass-group">
                                        <input id="clave" type="password" class="pass-input" placeholder="Enter your password">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>
                                <div class="form-login">
                                    <div class="alreadyuser">
                                        <h4><a href="javascript:void(0);" class="hover-a">Olvidaste tu contraseña?</a></h4>
                                    </div>
                                </div>
                                <div class="form-login">
                                    <a class="btn btn-login" onclick="upd_login();" href="javascript:void(0);">Sign In</a>
                                </div>
                                <div class="signinform text-center">
                                    <h4>No cuentas con una cuenta ? <a href="javascript:void(0);" class="hover-a">Regístrate</a></h4>
                                </div>
                                <!--<div class="form-setlogin">
                                    <h4>Or sign up with</h4>
                                </div>
                                <div class="form-sociallink">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="<?php echo base_url();?>public/assets/img/icons/google.png" class="me-2" alt="google">
                                                Sign Up using Google
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="<?php echo base_url();?>public/assets/img/icons/facebook.png" class="me-2" alt="google">
                                                Sign Up using Facebook
                                            </a>
                                        </li>
                                    </ul>
                                </div>-->
                            </div>
                        </form>
                    </div>
                    <div class="login-img">
                        <img src="<?php echo base_url();?>public/assets/img/login.jpg" alt="img">
                    </div>
                </div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="<?php echo base_url();?>public/assets/js/jquery-3.6.0.min.js"></script>

         <!-- Feather Icon JS -->
		<script src="<?php echo base_url();?>public/assets/js/feather.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="<?php echo base_url();?>public/assets/js/bootstrap.bundle.min.js"></script>
		
		<!-- Custom JS -->
		<script src="<?php echo base_url();?>public/assets/js/script.js"></script>
		
        <script>
            function get_data(id){
                return $('#'+id).val();
            }
            function upd_login(){
                var data =  new FormData();
                data.append('email',get_data('email'));
                data.append('clave',get_data('clave'));
                $.ajax({
                    type:'post',
                    contentType:false,
                    url:'<?php echo base_url()?>login',
                    data: data,
                    processData:false,
                    beforeSend:function(){
                    },
                    success: function(response){
                    if(response=='si'){
                        window.location.href = '/sys_villas/clientes/';
                    }else{
                    }
                    }
                });
            }
            /*$('#formLogin').validate({
                rules: {
                    "ruc": { required: true },
                    "usuario":{ required:true },
                    "contra":{ required:true },
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response != "error")
                            {   
                                if(response==10){
                                    window.location.href = '/distribuidor/product_list/';
                                }else{
                                    window.location.href = '/distribuidor/product_list/';
                                }
                            }
                            else
                            {}
                        }
                    });
                }
            });*/
        </script>
    </body>
</html>