<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('admin_login_template/header.php');
?>  
<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-menu-nav-dark 1-column login-bg  blank-page blank-page" data-open="click" data-menu="vertical-menu-nav-dark" data-col="1-column">
  <div class="row">
    <div class="col s12">
      <div class="container"><div id="login-page" class="row">
        <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
          <form class="login-form" id="admin_login_form" type="post">
            <div class="row">
              <div class="input-field col s12">
                <h5 class="ml-4">Sign in</h5>
              </div>
            </div>
            <div class="add_error row margin">
            <div class="input-field col s12 m12">
              <i class="material-icons prefix pt-2">person_outline</i>
              <label for="email" class="center-align">Email</label>
              <input id="email" name="email" type="text" autocomplete="off">

            </div>
          </div>
           <!--  <div class="row margin">
              <div class="input-field col s12">
                <i class="material-icons prefix pt-2">call</i>
                <input id="mobile_no" type="text">
                <label for="mobile_no">Mobile Number</label>
              </div>
            </div> -->
            <div class="add_error row margin">
            <div class="input-field col s12">
              <i class="material-icons prefix pt-2">lock</i>
              <input id="password" name="password" type="password" autocomplete="off">
              <label for="password" class="center-align">Password</label>
            </div>
          </div>
          <div class="row margin" style="display: none;">
            <div class="input-field col s12">
              <i class="material-icons prefix pt-2">lock_outline</i>
              <input id="otp" type="text">
              <label for="otp">Enter OTP</label>
            </div>
          </div>
           <!--  <div class="row">
              <div class="col s12 m12 l12 ml-2 mt-1">
                <p>
                  <label>
                    <input type="checkbox" name="remember" id="remember" />
                    <span>Remember Me</span>
                  </label>
                </p>
              </div>
            </div> -->
            <div class="row margin">
              <div class="input-field col s12">
                <button class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12" type="submit" name="submit">Login</button>
              </div>
            </div>
            <!-- <div class="row">
              <div class="input-field col s6 m6 l6">
                <p class="margin right-align medium-small"><a href="user-forgot-password.html">Forgot password ?</a></p>
              </div>
            </div> -->
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('admin_login_template/footer.php');?>