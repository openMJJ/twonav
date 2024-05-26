<?php if(!defined('DIR')){header('HTTP/1.1 404 Not Found');header("status: 404 Not Found");exit;}$LoginConfig = unserialize($USER_DB['LoginConfig']);?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>TwoNav - 登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="<?php echo $layui['css']; ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo $libs?>/Other/html5.min.js"></script>
    <script src="<?php echo $libs?>/Other/respond.min.js"></script>
    <![endif]-->
    <style>
        html, body {width: 100%;height: 100%;overflow: hidden}
        body {background: #1E9FFF;}
        body:after {content:'';background-repeat:no-repeat;background-size:cover;-webkit-filter:blur(3px);-moz-filter:blur(3px);-o-filter:blur(3px);-ms-filter:blur(3px);filter:blur(3px);position:absolute;top:0;left:0;right:0;bottom:0;z-index:-1;}
        .layui-container {width: 100%;height: 100%;overflow: hidden}
        .admin-login-background {width:360px;height:300px;position:absolute;left:50%;top:40%;margin-left:-180px;margin-top:-100px;}
        .logo-title {text-align:center;letter-spacing:2px;padding:14px 0;}
        .logo-title h2 {color:#1E9FFF;font-size:23px;font-weight:bold;}
        .login-form {background-color:#fff;border:1px solid #fff;border-radius:3px;padding:14px 20px;box-shadow:0 0 8px #eeeeee;}
        .login-form .layui-form-item {position:relative;}
        .login-form .layui-form-item label {position:absolute;left:1px;top:1px;width:38px;line-height:36px;text-align:center;color:#d2d2d2;}
        .login-form .layui-form-item input {padding-left:36px;}
        .captcha {width:60%;display:inline-block;}
        .captcha-img {display:inline-block;width:34%;float:right;}
        .captcha-img img {height:34px;border:1px solid #e6e6e6;height:36px;width:100%;}
    </style>
</head>
<body>
<div class="layui-container">
    <div class="admin-login-background">
        <div class="layui-form login-form">
            <form class="layui-form" action="">
                <div class="layui-form-item logo-title">
                    <h2>TwoNav - 登录</h2>
                </div>
                <div class="layui-form-item">
                    <label class="layui-icon layui-icon-username" for="username"></label>
                    <input type="text" name="User" lay-verify="required|account" placeholder="账号" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-item">
                    <label class="layui-icon layui-icon-password" for="password"></label>
                    <input type="password" name="Password" lay-verify="required|password" placeholder="密码" autocomplete="off" class="layui-input">
                </div>
<?php if(!empty($LoginConfig['totp_key'])){ ?>
                <div class="layui-form-item">
                    <label class="layui-icon layui-icon-vercode" for="vercode"></label>
                    <input type="text" name="otp_code" lay-verify="required" placeholder="OTP验证码" autocomplete="off" class="layui-input">
                </div>
<?php }?>
                <div class="layui-form-item">
                    <button class="layui-btn layui-btn layui-btn-normal layui-btn-fluid" lay-submit="" lay-filter="login">登 录</button>
                </div>
            </form>
<?php
    //若为默认值则显示注册入口
    if($global_config['Register'] == 'register' && $global_config['RegOption'] == 1){
        echo '<p style="width: 85%; margin-top: 10px;"><a href="?c=register" class="fl">没有账号？立即注册</a></p>';
    } 
?>
        </div>
    </div>
</div>
<script src = "<?php echo $libs?>/jquery/jquery-3.6.0.min.js"></script>
<script src = "<?php echo $layui['js']; ?>"></script>
<script src = '<?php echo $libs?>/jquery/jquery.md5.js'></script>
<script src = "./templates/login/o-login1/jquery.particleground.min.js" charset="utf-8"></script>
<script>
    layui.use(['form'], function () {
        var form = layui.form,
            layer = layui.layer;

        // 粒子线条背景
        $(document).ready(function(){
            $('.layui-container').particleground({
                dotColor:'#7ec7fd',
                lineColor:'#7ec7fd'
            });
        });

        // 进行登录操作
        form.on('submit(login)', function (data) {
            data = data.field;
            if (data.User == '') {
                layer.msg('用户名不能为空');
                return false;
            }
            if (data.Password == '') {
                layer.msg('密码不能为空');
                return false;
            }

            data.Password = $.md5(data.Password);
            $.post('./index.php?c=<?php echo $c; ?>&u='+data.User,data,function(re,status){
                if(re.code == 1) {
                    window.location.href = re.url || './index.php?c=admin&u='+ data.User;
                }else{
                    layer.msg(re.msg, {icon: 5});
                }
            });
            return false;
        });
    });
</script>
</body>
</html>