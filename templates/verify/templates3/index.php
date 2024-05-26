<?php if(!defined('DIR')){header('HTTP/1.1 404 Not Found');header("status: 404 Not Found");exit;}?>
<!DOCTYPE HTML>
<html>
<head>
<head>
	<title><?php echo $data['title'];?> - <?php echo $site['subtitle']?></title>
	<meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no minimal-ui">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_dir?>/static/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_dir?>/static/main.css">
    <link rel="shortcut icon" href="<?php echo $favicon;?>">
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-form-title" style="background-image: url(<?php echo $theme_dir?>/static/bg-01.jpg);">
                <span class="login100-form-title-1"><?php echo $data['tip'];?></span>
            </div>
            <form class="login100-form validate-form">
                <div class="wrap-input100 validate-input m-b-18" data-validate="<?php echo $data['tip'];?>">
                    <span class="label-input100">密码</span>
                    <input class="input100" type="password" id="Password" placeholder="<?php echo $data['input_tip'];?>">
                    <span class="focus-input100"></span>
                </div>
                <?php if(!empty($data['get_tip'])){ ?>
                <div class="flex-sb-m w-full p-b-30">
                    <div>
                        <a href="javascript:" onclick="showInfo('<?php echo base64_encode($data['get_tip'])?>')" class="txt1">如何获取？</a>
                    </div>
                </div>
                <?php }?>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" id="verify">验 证</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo $libs?>/jquery/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="<?php echo $libs?>/Layer/v3.3.0/layer.js"></script>
<script>
    $('#verify').on('click', function () {
        Password = $("#Password").val();
        if( Password == ''){
            layer.msg("<?php echo $data['input_tip'];?>", {icon: 5});
            $('#Password').focus();
            return false;
        }
        $.post('<?php echo $data['post_url']; ?>',{'Password':Password},function(re,status){
            if(re.code == 1) {
                layer.msg('正在验证..', {icon: 16,shade: [0.1, '#f5f5f5'],scrollbar: false,offset: 'auto',time: 888,
			        end: function() {
				        window.location.reload();
				        return false;
			        }
		        });
            }else{
                layer.msg(re.msg, {icon: 5});
            }
        });
        return false;
    });
    function showInfo($base64) {
        var content =decodeURIComponent(escape(window.atob($base64)));
        if(content.startsWith("http")){
            window.open(content);
            return false;
        }
        layer.open({type: 1,title: '如何获取',btn: ['知道了'],
            content: '<div style="padding: 20px; line-height: 22px; font-weight: 300;"><?php echo $data['get_tip'];?></div>'
        });
    }
</script>
</body>
</html>