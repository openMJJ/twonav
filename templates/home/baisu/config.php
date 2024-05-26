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
     <label class="layui-form-label">Logo字体</label>
      <div class="layui-input-inline">
       <select lay-verify="required" name="fonts">
        <option value="0">普通</option>
        <option value="1">个性</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">普通加载快,个性更好看</div>
    </div>

    <div class="layui-form-item">
     <label class="layui-form-label">链接描述</label>
      <div class="layui-input-inline">
       <select lay-verify="required" name="describe">
        <option value="0">关闭</option>
        <option value="1">显示</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">是否显示链接描述内容</div>
    </div>

    <div class="layui-form-item">
     <label class="layui-form-label">导航宽度</label>
      <div class="layui-input-inline">
       <input type="number" name="left_width" placeholder="默认260" autocomplete="off" class="layui-input">
      </div>
     <div class="layui-form-mid layui-word-aux">左侧栏的宽度,默认260</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">搜索URL</label>
      <div class="layui-input-inline">
       <select lay-verify="required" name="search_url">
        <option value="0">关闭</option>
        <option value="1">开启</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">开启时可搜索URL</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">打开方式</label>
      <div class="layui-input-inline">
       <select lay-verify="required" name="open_with">
        <option value="0">新的窗口</option>
        <option value="1">当前窗口</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">点击书签打开链接的方式</div>
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