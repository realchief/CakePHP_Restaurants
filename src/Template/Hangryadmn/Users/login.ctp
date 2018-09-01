<div class="login-box">
    <div class="login-logo">
        <a href=""><b><?= $siteSettings['site_name'] ?></b></a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Login</p>
        <form action="" method="post">
            <div class="form-group has-feedback">
                <input type="text" id="username" class="form-control" placeholder="Email" name="username">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <span class="userErr"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <span class="passErr"></span>
            </div>

            <div class="form-group has-feedback clearfix">
                <button type="submit" onclick="return adminLogin()" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
        </form>

    </div>
</div>

<script>
    function adminLogin() {
        $(".error").html('');
        var username = $.trim($("#username").val());
        var password = $.trim($("#password").val());

        if(username == '') {
            $(".userErr").addClass('error').html('Please enter your username');
            $("#username").focus();
            return false;
        }else if(password == '') {
            $(".passErr").addClass('error').html('Please enter your password');
            $("#password").focus();
            return false;
        }
    }
</script>