<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title><?php echo $theme;?> - 主题配置</title>
  <link rel='stylesheet' href='<?php echo $layui['css']; ?>'>
  <style>    
    .layui-form-item {margin-bottom: 10px;}
  </style>
</head>
<body>
<div class="layui-row" style="margin-top:18px;">
 <div class="layui-container">
   <form class="layui-form" lay-filter="form">
       
    <div class="layui-form-item">
     <label class="layui-form-label">链接描述</label>
      <div class="layui-input-inline">
       <select lay-verify="required" name="display_describe">
        <option value="0">隐藏</option>
        <option value="1">显示</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">是否显示链接描述内容</div>
    </div>
    <div class="layui-form-item">
     <label class="layui-form-label">管理入口</label>
      <div class="layui-input-inline">
       <select lay-verify="required" name="display_admin">
        <option value="0">隐藏</option>
        <option value="1">显示</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">左下角的管理入口</div>
    </div>
    <div class="layui-form-item">
     <label class="layui-form-label">主题版本</label>
      <div class="layui-input-inline">
       <select lay-verify="required" name="display_theme_version">
        <option value="0">隐藏</option>
        <option value="1">显示</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">左上角的主题版本</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">logo</label>
      <div class="layui-input-block">
       <input type="text" name="logo" placeholder="可以填图像的URL,留空则使用默认" autocomplete="off" class="layui-input">
      </div>
    </div>
    
    <div class="layui-form-item" style="padding-top: 10px;">
     <div class="layui-input-block"><button class="layui-btn" lay-submit lay-filter="save">保存</button></div>
    </div>
   </form>
 </div>
</div>
<script src="<?php echo $layui['js']; ?>"></script>
<script src="./templates/admin/js/public.js?v=<?php echo $Ver;?>"></script>
<script>
var u = _GET('u');
layui.use(['form'], function(){
    var form = layui.form;var $ = layui.$;
    form.val('form', <?php echo json_encode($theme_config);?>);
    form.on('submit(save)', function(data){
        $.post(get_api('write_theme','config') + '&t=' + _GET('theme'),data.field,function(data,status){
            if(data.code == 1) {
                layer.msg(data.msg, {icon: 1,time: 500,end: function() {if(_GET('source') != 'admin'){parent.location.reload();}}});
            }else{
                layer.msg(data.msg, {icon: 5});
            }
        });
        return false; 
    });
});
</script>
</body>
</html>