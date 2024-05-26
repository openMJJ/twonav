<?php if(!defined('DIR')){header('HTTP/1.1 404 Not Found');header("status: 404 Not Found");exit;}
$LoginConfig = unserialize($USER_DB['LoginConfig']);?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo $site['keywords']; ?>">
	<meta name="description" content="<?php echo $site['description']; ?>">
    <link rel="stylesheet" href="./templates/login/wanfang/index.css">
    <link rel="shortcut icon" href="<?php echo $favicon;?>" type="image/x-icon">
    <title>TwoNav - 登录</title>
</head>
<body>
    <div class="container">
        <div class="panda">
            <div class="ear left"></div>
            <div class="ear right"></div>
            <div class="face">
                <div class="eye-shadow left"></div>
                <div class="eye-white left">
                    <div class="eye-ball"></div>
                </div>
                <div class="eye-shadow right"></div>
                <div class="eye-white right">
                    <div class="eye-ball"></div>
                </div>
                <div class="nose"></div>
                <div class="mouth"></div>
            </div>
            <div class="body"></div>
            <div class="foot left">
                <div class="sole"></div>
            </div>
            <div class="foot right">
                <div class="sole"></div>
            </div>
        </div>
        <div class="login-box">
            <div class="hand left"></div>
            <div class="hand right"></div>
            <h1>TwoNav 系统管理</h1>
            <div class="ipt-box">
                <input type="text" id= "User" required>
                <label>用户名</label>
            </div>
            <div class="ipt-box">
                <input type="password" id="Password" required>
                <label>密码</label>
            </div>
<?php if(!empty($LoginConfig['totp_key'])){ ?>
            <div class="ipt-box">
                <input type="text" id="otp_code" required>
                <label>OTP验证码</label>
            </div>
<?php }?>
            <button id="login">登录</button>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo $libs?>/jquery/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="<?php echo $libs?>/Layer/v3.3.0/layer.js"></script>
    <script type="text/javascript" src="<?php echo $libs?>/jquery/jquery.md5.js"></script>
    <script>
        if ($("#otp_code").length) {
            $(".login-box").css({"height":340,"top":"47%"});
        }
    
        $('#Password').focusin(function(){
            // 密码框选中
            $('.login-box').addClass('up');
        }).focusout(function(){
            // 密码框非选中
            $('.login-box').removeClass('up');
        })
        // 眼球移动
        $(document).on('mousemove',function(e){
            let dw=$(document).width() / 10;
            let dh=$(document).height() / 18;
            let x=e.pageX / dw;
            let y=e.pageY / dh;
            $('.eye-ball').css({
                left:x,
                top:y
            })
        })
        // 登录按钮
        $('#login').on('click', function () {
            if($("#User").val() == ''){
                layer.msg("请输入用户名", {icon: 5});
                return false;
            }
            if($("#Password").val() == ''){
                layer.msg("请输入密码", {icon: 5});
                return false;
            }
            let otp_code = "";
            if ($("#otp_code").length) {
                otp_code = $("#otp_code").val();
                if(otp_code.length == 0){
                    layer.msg("请输入OTP验证码", {icon: 5});
                    return false;
                }
            }
            let post_data = {'User':$("#User").val(),"Password":$.md5($("#Password").val()),"otp_code":otp_code};
            $.post('./index.php?c=<?php echo $c; ?>&u='+post_data.User,post_data,function(re,status){
                if(re.code == 1) {
                    window.location.href = re.url;
                }else{
                    layer.msg(re.msg, {icon: 5});
                }
            });
        });
        
    </script>
</body>
</html>