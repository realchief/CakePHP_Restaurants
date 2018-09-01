<div class="login-box">
    <div class="login-logo">
        <a href=""><b><?= $siteSettings['site_name'] ?></b></a>
    </div>
    <div class="login-box-body">
        <div id="login">
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

                <div id="forget" class="col-md-12 col-sm-12 col-xs-12 no-padding">
                    <div class="rememberpassword text-right text-left-xs">
                        <a href="javascript:void(0);" onclick="return forgotDiv('forgot');"class="linkRight" id="forgetPage"><?php echo __('Forget Password');?> ?</a>
                    </div>
                </div>
            </form>

        </div>


        <div style="display:none" id="forgotPwd" class="loginInnerBg clearfix">
            <h4><?php echo __(' Forget Mail');?> </h4>  <?=
            $this->Form->create('Users',[
                'class' => 'login-form',
                'id'=>'forgetmail',
                'class' => 'login-form'
            ]); ?>

            <div class="form-group"><?=
                $this->Form->input('forgotemail',[
                    'label' => false,
                    'placeholder' => __('Email'),
                    'id'=>'forgotemail',
                    'class'=>'form-control placeholder-no-fix',
                    'autocomplete' => 'off',
                    'div' => false
                ]); ?>
                <label id="forgotmailErr" class="error"></label>
            </div>
            <div class="signup-footer">
                <div class="submit"><?=
                    $this->Form->input("submit",[
                        'type' => 'submit',
                        'label'=>false,
                        'class' => 'btn btn-primary btn-block btn-flat',
                        'onclick'=>'return forgetPwdValid()',
                        'id' => 'submit',
                        'div' =>false
                    ]); ?>
                </div>
                <div class="newuser pull-right ">
                    <?php echo __('Back to');?> <a href="javascript:void(0);" onclick="return forgotDiv('login');" id="loginPage" ><?php echo __('Login');?></a>
                </div>
            </div>
            <?=  $this->Form->end(); ?>
        </div>

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

    function forgotDiv(val){
        if(val == 'forgot'){
            $("#forgotPwd").show();
            $("#login").hide();
        }else{
            $("#forgotPwd").hide();
            $("#login").show();
        }
    }

    function forgetPwdValid() {

        var forgotemail = $.trim($("#forgotemail").val());


        $('#forgotmailErr').html('');

        if(forgotemail == '') {
            $("#forgotmailErr").html('Please enter your email');
            $("#forgotemail").focus();
            return false;
        }else if(forgotemail != '' && !isValidEmailAddress(forgotemail)) {
            $("#forgotmailErr").html('Please enter valid email');
            $("#forgotemail").focus();
            return false;
        }else {

            $.post(jssitebaseurl+'users/forgotPassword', {
                'username' : forgotemail
            }, function (output) {

                if ($.trim(output) == 0) {
                    $("#forgotmailErr").html('Invalid account');
                    return false;
                }else if ($.trim(output) == 1) {
                    window.location.reload();
                }
            });
            return false;
        }
    }

    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    };

</script>