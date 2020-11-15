<?php

function get_title() {
    return 'ورود به برنامه';
}

function get_content() { ?>

<?php get_module_name()?>
    <div class="container">

        <form class="form-signin"method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="username" class="sr-only">نام کاربری </label>
        <input  id="username" class="form-control"name="username" placeholder="نام کاربری " required autofocus>
        <label for="password" class="sr-only">رمز عبور</label>
        <input type="password" id="password"  class="form-control"name="password" placeholder="رمز عبور" required>
        <div class="checkbox">
          
        </div>
        <button class="btn btn-lg btn-primary btn-block" name="login"type="submit">ورود</button>
      </form>

    </div> <!-- /container -->


<?php }
function process_inputs() {
    
    if(!isset($_POST['login'])) {
        return;
    }
    
    if(isset($_POST['username'])) {
        $username = $_POST['username'];
    }

    if(empty($username)) {
        add_message('نام کاربری نمی تواند خالی باشد.', 'error');
        return;
    }
    
    if(isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    
    if(empty($password)) {
        add_message('رمز عبور نمی تواند خالی باشد.', 'error');
        return;
    }
    
    user_login($username, $password);
    
    if(!is_user_log_in()) {
        add_message('نام کاربری یا رمز عبور، اشتباه است.', 'error');
    } else {
        redirect_to(home_url());
    }
    
}