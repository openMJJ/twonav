<?php if(!defined('DIR')){header('HTTP/1.1 404 Not Found');header("status: 404 Not Found");exit;}$LoginConfig = unserialize($USER_DB['LoginConfig']);?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./templates/login/o-tushan/css/Login.css">
  <link rel="stylesheet" href="<?php echo $layui['css']; ?>">
  <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
  <title>TwoNav - 登录</title>
  <script>
    window.onload = function () {
      document.querySelector(".login").style.opacity = 1;
    }
  </script>
</head>

<body class="login">
  <div class="root">
    <section class="left">
      <img class="cover" src="./templates/login/o-tushan/image/backgroundLogin.png" />
    </section>
    <section class="right">
      <!-- PC版的样式 -->
      <h2>TwoNav - 登录</h2>
      <div class="login_frame">
        <div class="login_box">
          <h4>管理登录</h4>
          <h6>亲爱的管理员欢迎回来！</h6>
          <form class="layui-form login-bottom">
            <input name="type" value="pc" style = "display:none;" />
            <div class="inp">
              <span class="label">用户名</span>
              <input type="text" name="User" placeholder="请输入账号" />
            </div>
            <div class="inp">
              <span class="label">用户密码</span>
              <input type="password" name="Password" placeholder="请输入密码" />
            </div>
<?php if(!empty($LoginConfig['totp_key'])){ ?>
            <div class="inp">
              <span class="label">OTP验证码</span>
              <input type="text" name="otp_code" placeholder="OTP验证码" />
            </div>
<?php }?>
            <div class="submit">
              <input type="submit" lay-submit lay-filter="login" class="submit" value="登录">
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
  <div class="mobile">
    <!-- 手机版的样式 -->
    <h1>OneNav Extend</h1>
    <form class="layui-form login-bottom">
      <input name="type" value="mobile" style = "display:none;"/>
      <div class="inp">
        <span class="label">用户名</span>
        <input type="text" name="User" placeholder="请输入账号" />
      </div>
      <div class="inp">
        <span class="label">用户密码</span>
        <input type="password" name="Password" placeholder="请输入密码" />
      </div>
<?php if(!empty($LoginConfig['totp_key'])){ ?>
        <div class="inp">
          <span class="label">OTP验证码</span>
          <input type="text" name="otp_code" placeholder="OTP验证码" />
        </div>
<?php }?>
      <div class="submit">
        <input type="submit" lay-submit lay-filter="login" class="submit" value="登录">
      </div>
    </form>
  </div>
  <footer><img src='./templates/login/o-tushan/image/copyright-fill.png' />2022 Powered by 落幕</footer>
</body>
<script src = '<?php echo $layui['js']; ?>'></script>
<script src = '<?php echo $libs?>/jquery/jquery-3.6.0.min.js'></script>
<script src = '<?php echo $libs?>/jquery/jquery.md5.js'></script>

<script>
 layui.use(['form','jquery'], function () {
        var $ = layui.jquery,
            form = layui.form,
            layer = layui.layer;
        
        // 进行登录操作
        form.on('submit(login)', function (data) {
            console.log(data.field) 
            data = data.field;
            if (data.User == '') {
                layer.msg('用户名不能为空',{icon: 5});
                return false;
            }
            if (data.Password == '') {
                layer.msg('密码不能为空',{icon: 5});
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
</html>