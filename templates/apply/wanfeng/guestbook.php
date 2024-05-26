<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo '留言板 - ' . $site['subtitle'];?></title>
    <meta name="keywords" content="<?php echo $site['keywords']; ?>">
    <meta name="description" content="<?php echo $site['description']; ?>">
	<link rel="shortcut icon" href="<?php echo $favicon;?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo $theme_dir?>/css/liuyan.css">
	<script src="<?php echo $libs?>/jquery/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php require 'header.php'; ?>
    <!-- 留言板区 -->
    <div class="container">
        <form id="form">
            <h2>留言板</h2>
            <div class="form-group">
                <label for="type">反馈类型</label>
                <select id="type">
                    <option value="投诉建议">投诉建议</option>
                    <option value="问题反馈" selected="" >问题反馈</option>
                    <option value="商务合作">商务合作</option>
                    <option value="其他">其他</option>
                </select>
            </div>
            <div class="form-group">
                <label for="contact">联系方式</label>
                <input type="text" id="contact" placeholder="请输入您的联系方式">
            </div>
            <div class="form-group">
                <label for="title">标题</label>
                <input type="text" id="title" placeholder="请输入反馈标题">
            </div>
            <div class="form-group">
                <label for="content">内容</label>
                <textarea id="content" placeholder="请输入反馈内容"></textarea>
            </div>
            <button class="submit-btn" type="submit">提交</button>
        </form>
    </div>
    <?php require 'footer.php'; ?>
	<script>
	    const u = '<?php echo $u;?>';var page = 'guestbook';
	    const theme_config = <?php echo json_encode($theme_config);?>;
	 </script>
	<script src="<?php echo $theme_dir?>/js/index.js?v=<?php echo $theme_ver; ?>"></script>
	<script src="<?php echo $libs?>/Layer/v3.3.0/layer.js"></script> 
    <script>
        $("#form").submit(function(event) {
            event.preventDefault();
            var formData = {
                type: $("#type").val(),
                contact: $("#contact").val(),
                title: $("#title").val(),
                content: $("#content").val()
            };
            if(formData.contact.trim() === ''){
                layer.msg('联系方式不能为空', {icon: 5});
                return;
            }
            if(formData.title.trim() === ''){
                layer.msg('标题不能为空', {icon: 5});
                return;
            }
            if(formData.content.trim() === ''){
                layer.msg('内容不能为空', {icon: 5});
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
