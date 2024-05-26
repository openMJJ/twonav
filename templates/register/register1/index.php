<?php if (!defined('DIR')) {
    header('HTTP/1.1 404 Not Found');
    header("status: 404 Not Found");
    exit;
}

$mail_config = get_db("global_config", "v", ["k" => "mail_config"]);
if (!empty($mail_config)) {
    $mail_config = unserialize($mail_config);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>TwoNav - 注册</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="<?php echo $layui['css']; ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo $libs ?>/Other/html5.min.js"></script>
    <script src="<?php echo $libs ?>/Other/respond.min.js"></script>
    <![endif]-->
    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            overflow: hidden
        }

        body {
            background: #1E9FFF;
        }

        body:after {
            content: '';
            background-repeat: no-repeat;
            background-size: cover;
            -webkit-filter: blur(3px);
            -moz-filter: blur(3px);
            -o-filter: blur(3px);
            -ms-filter: blur(3px);
            filter: blur(3px);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
        }

        .layui-container {
            width: 100%;
            height: 100%;
            overflow: hidden
        }

        .admin-login-background {
            width: 360px;
            height: 300px;
            position: absolute;
            left: 50%;
            top: 30%;
            margin-left: -180px;
            margin-top: -100px;
        }

        .logo-title {
            text-align: center;
            letter-spacing: 2px;
            padding: 14px 0;
        }

        .logo-title h2 {
            color: #1E9FFF;
            font-size: 23px;
            font-weight: bold;
        }

        .login-form {
            background-color: #fff;
            border: 1px solid #fff;
            border-radius: 3px;
            padding: 14px 20px;
            box-shadow: 0 0 8px #eeeeee;
        }

        .login-form .layui-form-item {
            position: relative;
        }

        .login-form .layui-form-item label {
            position: absolute;
            left: 1px;
            top: 1px;
            width: 38px;
            line-height: 36px;
            text-align: center;
            color: #d2d2d2;
        }

        .login-form .layui-form-item input {
            padding-left: 36px;
        }

        .captcha {
            width: 60%;
            display: inline-block;
        }

        .captcha-img {
            display: inline-block;
            width: 34%;
            float: right;
        }

        .captcha-img img {
            height: 34px;
            border: 1px solid #e6e6e6;
            height: 36px;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="layui-container">
        <div class="admin-login-background">
            <div class="layui-form login-form">
                <form class="layui-form" action="">
                    <div class="layui-form-item logo-title">
                        <h2>TwoNav - 注册</h2>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-icon layui-icon-username" for="username"></label>
                        <input type="text" name="User" lay-verify="required|account" placeholder="请输入账号" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-icon layui-icon-password" for="password"></label>
                        <input type="password" name="Password" lay-verify="required|password" placeholder="请输入密码" autocomplete="off" class="layui-input">
                        <span class="bind-password icon icon-4"></span>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-icon layui-icon-email" for="password"></label>
                        <input type="text" name="Email" lay-verify="required|email" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
                    </div>

                    <?php if ($mail_config['verify_email'] == 1) { ?>
                        <div class="layui-form-item">
                            <label class="layui-icon layui-icon-auz" for="code"></label>
                            <input type="text" name="code" style="width: 200px;" placeholder="请输入验证码" autocomplete="off" class="layui-input">
                            <div style="display: inline-block;position: absolute;top: 0;right: 0;">
                                <span><a class="layui-btn layui-btn-normal" lay-submit="" lay-filter="getcode" id="getcode">获取验证码</a></span>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="layui-form-item" <?php echo $global_config['RegOption'] == 2 ? '' : 'style = "display:none;"' ?>>
                        <label class="layui-icon layui-icon-fonts-code" for="regcode"></label>
                        <input type="text" name="regcode" placeholder="请输入注册码" value="<?php echo $_GET['key']; ?>" autocomplete="off" class="layui-input">
                    </div>

                    <div class="layui-form-item">
                        <button class="layui-btn layui-btn layui-btn-normal layui-btn-fluid" lay-submit="" lay-filter="login">注 册</button>
                    </div>
                </form>
                <?php
                //若为默认值则显示登录入口
                if ($global_config['Login'] == 'login') {
                    echo '<p style="margin-top: 10px;display: flex;justify-content: space-between;"><a href="?c=login" class="fl">已有账号？立即登录</a>';
                    echo ($global_config['RegOption'] == 2 && !empty($reg_tips)) ? '<a href="javascript:;" onclick="Get_Invitation(\'' . base64_encode($reg_tips) . '\')">获取注册码</a>' . "\n" : '';
                    echo '</p>';
                }
                ?>
            </div>
        </div>
    </div>
    <script src="<?php echo $libs ?>/jquery/jquery-3.6.0.min.js"></script>
    <script src="<?php echo $layui['js']; ?>"></script>
    <script src='<?php echo $libs ?>/jquery/jquery.md5.js'></script>
    <script src="./templates/register/register1/jquery.particleground.min.js" charset="utf-8"></script>
    <script>
        layui.use(['form'], function() {
            var form = layui.form,
                layer = layui.layer;

            // 粒子线条背景
            $(document).ready(function() {
                $('.layui-container').particleground({
                    dotColor: '#7ec7fd',
                    lineColor: '#7ec7fd'
                });
            });

            $('.bind-password').on('click', function() {
                if ($(this).hasClass('icon-5')) {
                    $(this).removeClass('icon-5');
                    $("input[name='Password']").attr('type', 'password');
                } else {
                    $(this).addClass('icon-5');
                    $("input[name='Password']").attr('type', 'text');
                }
            });

            //获取验证码
            form.on('submit(getcode)', function(data) {
                data = data.field;
                data.Password = $.md5(data.Password);
                if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(data.Email)) {
                    layer.load(1, {
                        shade: [0.3, '#fff']
                    });
                    layer.msg('正在发送中..', {
                        icon: 16,
                        time: 1000 * 300
                    });
                    $.post('./index.php?c=<?php echo $c; ?>&u=' + data.User + "&type=getcode", data, function(re, status) {
                        layer.closeAll();
                        if (re.code == 1) {
                            layer.msg("发送成功", {
                                icon: 1
                            });
                        } else {
                            layer.msg(re.msg, {
                                icon: 5
                            });
                        }
                    });
                } else {
                    layer.msg('请输入正确的邮箱', {
                        icon: 5
                    });
                }
            });

            // 进行注册操作
            form.on('submit(login)', function(data) {
                $("*").blur();
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
                $.post('./index.php?c=<?php echo $c; ?>&u=' + data.User, data, function(re, status) {
                    if (re.code == 1) {
                        layer.alert("您已成功注册,请记牢您的账号密码!", {
                            icon: 1,
                            title: '注册成功',
                            anim: 2,
                            closeBtn: 0,
                            btn: ['后台管理']
                        }, function() {
                            window.location.href = './index.php?c=admin&u=' + data.User;
                        });
                    } else {
                        layer.msg(re.msg, {
                            icon: 5
                        });
                    }
                });
                return false;
            });
        });

        //获取邀请码
        function Get_Invitation($base64) {
            var content = decodeURIComponent(escape(window.atob($base64)));
            if (content.substr(0, 4) == 'http') {
                window.open(content);
            } else {
                layer.open({
                    title: '获取注册码',
                    content: content
                });
            }
            return false;
        }
    </script>
</body>

</html>