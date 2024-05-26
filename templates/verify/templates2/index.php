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
    <link rel="stylesheet" href="<?php echo $theme_dir?>/style.css" type="text/css" media="all">
    <link rel="shortcut icon" href="<?php echo $favicon;?>">
    <?php if(!empty($theme_config['background'])){ ?>
    <style>
        body {background: url(<?php echo $theme_config['background'];?>);background-size: cover;}
    </style>
    <?php }?>
</head>
<body>
<h1><?php echo $data['title'];?> - <?php echo $site['subtitle']?></h1>
<div class="container w3layouts agileits">
    <div class="login w3layouts agileits">
        <h2><?php echo $data['tip'];?></h2>
        <form method="post" id="form">
            <input type="password" id="Password" placeholder="<?php echo $data['input_tip'];?>">
            <div class="send-button w3layouts agileits"><input type="submit" value="验 证" id="verify"></div>
        </form>
        <?php if(!empty($data['get_tip'])){ ?>
        <div class="send-button w3layouts agileits">
            <input type="submit" onclick="showInfo('<?php echo base64_encode($data['get_tip'])?>')" value="如何获取？">
        </div>
        <?php }?>
    </div>
    <div class="clear"></div>
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