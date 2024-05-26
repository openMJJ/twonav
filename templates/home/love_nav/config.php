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
  </style>
</head>
<body>
<div class="layui-row" style = "margin-top:18px;">
 <div class="layui-container">
  <div class="layui-col-lg8 layui-col-md-offset2">
   <form class="layui-form" lay-filter="form">
       
    <div class="layui-form-item">
     <label class="layui-form-label">Logo</label>
      <div class="layui-input-block" >
       <input type="text" name="logo" placeholder="图片logo地址" autocomplete="off" class="layui-input">
      </div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">显示描述</label>
      <div class="layui-input-inline" style="width: 100px;">
       <select lay-verify="required" name="link_description">
        <option value="0">不显示</option>
        <option value="1">显示1行</option>
        <option value="2">显示2行</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">是否显示链接描述</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">数据缓存</label>
      <div class="layui-input-inline" style="width: 100px;">
       <input type="text" name="cache_time" placeholder="0" autocomplete="off" class="layui-input">
      </div>
      <div class="layui-form-mid layui-word-aux">单位:秒,0表示不缓存,客户端数据缓存时间</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">卡片宽度</label>
      <div class="layui-input-inline" style="width: 100px;">
       <select lay-verify="required" name="card_width">
        <option value="0">缩小</option>
        <option value="1">正常</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">选缩小时建议同时缩小间距</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">卡片间距</label>
      <div class="layui-input-inline" style="width: 100px;">
       <input type="text" name="card_spac" placeholder="10" autocomplete="off" class="layui-input">
      </div>
      <div class="layui-form-mid layui-word-aux">范围1-10,默认10</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">底部版权</label>
      <div class="layui-input-inline" style="width: 100px;">
       <select lay-verify="required" name="footer">
        <option value="hide">隐藏</option>
        <option value="show">显示</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">是否显示底部版权</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">和风天气</label>
      <div class="layui-input-inline" style="width: 100px;">
       <select lay-verify="required" name="weather">
        <option value="0">关闭</option>
        <option value="1">开启</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">天气信息数据来源:和风天气</div>
    </div>

    <div class="layui-form-item">
     <label class="layui-form-label">匹配阈值</label>
      <div class="layui-input-inline" style="width: 50px;">
       <input type="text" name="fuse_threshold" placeholder="1-100" autocomplete="off" class="layui-input">
      </div>
     <div class="layui-form-mid layui-word-aux">站内搜索匹配阈值,范围:1-100,越低越严格,默认30</div>
    </div>

    <div class="layui-form-item" style="padding-top: 10px;">
     <div class="layui-input-block"><button class="layui-btn" lay-submit lay-filter="save">保存</button></div>
    </div>
   </form>
  </div>
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