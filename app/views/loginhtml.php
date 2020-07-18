<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>              				
<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="<?php echo adminassets_url('css/normalize.css');?>">
    <link rel="stylesheet" href="<?php echo adminassets_url('css/main.css');?>">
    <link rel="stylesheet" href="<?php echo adminassets_url('css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php echo adminassets_url('css/all.min.css');?>">
    <link rel="stylesheet" href="<?php echo adminassets_url('fonts/flaticon.css');?>">
    <link rel="stylesheet" href="<?php echo adminassets_url('css/animate.min.css');?>">
    <link rel="stylesheet" href="<?php echo adminassets_url('css/jquery.dataTables.min.css');?>">
    <link rel="stylesheet" href="<?php echo adminassets_url('css/style.css');?>">
    <script src="<?php echo adminassets_url('js/modernizr-3.6.0.min.js');?>"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>

	<script type="text/javascript">
		var baseurl = "<?php echo  base_url(); ?>";
    </script>
    <style>
        .logo{
            max-width:150px;
    height: auto;

        }
    </style>
</head>
<body>
    <div id="preloader"></div>
    <div class="login-page-wrap">
        <div class="login-page-content">
            <div class="login-box">
                <div class="item-logo">
                    <!-- <img src="<?php //echo adminassets_url('images/logo-img.png');?>" alt=""> -->
                    <div class="client_logo">
					<div class="admin_logos">
						<h3><?php echo $title; ?></h3>
					</div>
				</div>
                </div>
				<?php echo form_open(base_url('welcome/authenticate'), 'class="login-form" method="POST"');?>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" placeholder="Enter usrename" class="form-control">
                        <i class="far fa-envelope"></i>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter password" class="form-control">
                        <i class="fas fa-lock"></i>
                    </div>
					<!-- <div class="form-group">
                        <?php echo $captcha['image']; ?> <input type="text" autocomplete="off" style="width: 224px;padding: 5px;" name="userCaptcha" placeholder="Enter Captcha" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>" />
                    </div> -->
                    
				<div class="g-recaptcha" data-sitekey="6Lf6HfkUAAAAAMRzkfZHjFTFL0uHECwiy1iHLZWc"></div>
					
					<?php echo form_error('g-recaptcha"','<p style="color:#F83A18">','</p>'); ?> 
					<?php if($this->session->flashdata('erroruserlog')) : ?>
						<?php echo $this->session->flashdata('erroruserlog'); ?>
					<?php endif; ?>	
                    <div class="form-group">
                        <button type="submit" class="login-btn ">Login</button>
                    </div>
                <?php echo form_close();?>
				<div class="login-social">
                    <p><a href="<?php echo base_url('createuser');?>"><i class="fas fa-angle-left"></i> Create Account</a></p>
                </div>
                <div class="login-social">
                </div>
            </div>
        </div>
    </div>
	<script src="<?php echo adminassets_url('js/jquery-3.3.1.min.js');?>"></script>
    <script src="<?php echo adminassets_url('js/plugins.js');?>"></script>
    <script src="<?php echo adminassets_url('js/popper.min.js');?>"></script>
    <script src="<?php echo adminassets_url('js/bootstrap.min.js');?>"></script>
    <script src="<?php echo adminassets_url('js/jquery.scrollUp.min.js');?>"></script>
    <script src="<?php echo adminassets_url('js/main.js');?>"></script>
</body>
</html>