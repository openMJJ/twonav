<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo '申请收录 - ' . $site['subtitle'];?></title>
    <meta name="keywords" content="<?php echo $site['keywords']; ?>">
    <meta name="description" content="<?php echo $site['description']; ?>">
	<link rel="shortcut icon" href="<?php echo $favicon;?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo $theme_dir?>/css/shoulu.css">
	<script src="<?php echo $libs?>/jquery/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php require 'header.php'; ?>
    <!-- 收录区 -->
    <div class="shoubox">
        <div class="shuoming">
            <div class="tjsm">
                <?php echo $apply['Notice'];?>
            </div>
        </div>
        <div class="shouluform">
            <form id="form">
                <h2>申请收录</h2>
                <label for="title">网站名称:</label>
                <input type="text" id="title" name="title" placeholder="请输入网站名称"><br>
                
                <label for="url">网站链接:</label>
                <input type="text" id="url" name="url" placeholder="请输入网站链接"><br>
                
                <label for="category_id">网站分类:</label>
                <select id="category_id" name="category_id">
                    <option value="">请选择网站分类</option>
                    <?php echo_category(false);//输出公开分类 ?>
                </select><br>
                
                <label for="iconurl">网站图标:</label>
                <input type="text" id="iconurl" name="iconurl" placeholder="请输入网站图标"><br>
                
                <label for="description">网站描述:</label>
                <textarea id="description" name="description" placeholder="请输入网站描述"></textarea><br>
                
                <label for="email">联系邮箱:</label>
                <input type="text" id="email" name="email" placeholder="请输入联系邮箱"><br>
                <input type="submit" value="提交">
            </form>
        </div>
    </div>
    <?php require 'footer.php'; ?>
	<script>
	    const u = '<?php echo $u;?>';var page = 'apply';
	    const theme_config = <?php echo json_encode($theme_config);?>;
	 </script>
	<script src="<?php echo $theme_dir?>/js/index.js?v=<?php echo $theme_ver; ?>"></script>
	<script src = "<?php echo $libs?>/Layer/v3.3.0/layer.js"></script> 
    <script>
        $("#form").submit(function(event) {
            event.preventDefault();
            var formData = {
                title: $("#title").val(),
                url: $("#url").val(),
                category_id: $("#category_id").val(),
                iconurl: $("#iconurl").val(),
                description: $("#description").val(),
                email: $("#email").val()
            };
            if(formData.title.trim() === ''){
                layer.msg('网站名称不能为空', {icon: 5});
                return;
            }
            if(formData.url.trim() === ''){
                layer.msg('网站链接不能为空', {icon: 5});
                return;
            }
            if(formData.category_id.trim() === ''){
                layer.msg('网站分类不能为空', {icon: 5});
                return;
            }
            
            $.post('', formData, function(re) {
                if(re.code == 1) {
                    layer.msg(re.msg, {icon: 1});
                }else{
                    layer.msg(re.msg, {icon: 5});
                }
            }).fail(function(error) {
                console.log(error);
            });
        });
    </script>
</body>
</html>
