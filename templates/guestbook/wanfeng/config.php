<?php 
if($_GET['fn'] != 'home'){
    exit('<h3>该主题可自定义的选项较多<br />为了避免配置不同步<br />请前往主页模板安装和配置该主题</h3>');
}
?>

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
     <label class="layui-form-label">风格选项</label>
      <div class="layui-input-inline">
       <select lay-verify="required" name="style">
        <option value="0">拟态风</option>
        <option value="1">磨砂风</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">拟态风为原生风格,磨砂风由交流群Git贡献</div>
    </div>
    <div class="layui-form-item">
     <label class="layui-form-label">搜索区块</label>
      <div class="layui-input-inline">
       <select lay-verify="required" name="search">
        <option value="0">关闭</option>
        <option value="1">开启(新标签)</option>
        <option value="2">开启(当前标签)</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">是否显示搜索区块</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">显示描述</label>
      <div class="layui-input-inline">
       <select lay-verify="required" name="card_style">
        <option value="0">不显示</option>
        <option value="1">显示1行</option>
        <option value="2">显示2行</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">是否显示链接描述</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">管理入口</label>
      <div class="layui-input-inline">
       <select lay-verify="required" name="in_admin">
        <option value="0">关闭</option>
        <option value="1">显示</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">是否显示管理入口</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">页内标题</label>
      <div class="layui-input-block">
       <input type="text" name="title" placeholder="页内搜索上方的标题" autocomplete="off" class="layui-input">
      </div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">卡片间距</label>
      <div class="layui-input-inline" style="width: 150px;">
       <input type="text" name="card_padding" placeholder="15" autocomplete="off" class="layui-input">
      </div>
      <div class="layui-form-mid layui-word-aux">卡片间距,范围1-15,默认15</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">书签区高度</label>
      <div class="layui-input-inline" style="width: 150px;">
       <input type="text" name="main_height" placeholder="600" autocomplete="off" class="layui-input">
      </div>
      <div class="layui-form-mid layui-word-aux">书签区高度,默认600</div>
    </div>

    <!--<div class="layui-form-item">-->
    <!-- <label class="layui-form-label">最大宽度</label>-->
    <!--  <div class="layui-input-inline" style="width: 150px;">-->
    <!--   <input type="text" name="max_width" placeholder="600" autocomplete="off" class="layui-input">-->
    <!--  </div>-->
    <!--  <div class="layui-form-mid layui-word-aux">最大宽度,默认1200</div>-->
    <!--</div>-->

    <div class="layui-form-item">
     <label class="layui-form-label">横排文章</label>
      <div class="layui-input-inline" style="width: 150px;">
       <select lay-verify="required" name="xinwenlanmu">
        <option value="0">不显示</option>
        <?php echo_category(true); ?>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">指定分类下的10篇最新文章</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">竖排文章</label>
      <div class="layui-input-block">
       <input type="text" name="wenzhang_sl" placeholder="显示多少篇文章,0表示不显示!默认10" value="10" autocomplete="off" class="layui-input">
      </div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">文章模板</label>
      <div class="layui-input-inline">
       <select lay-verify="required" name="wenzhang_nz">
        <option value="0">系统模板</option>
        <option value="1">内置模板</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">是否使用内置的文章阅读模板</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">广告区块</label>
      <div class="layui-input-inline">
       <select lay-verify="required" name="gg">
        <option value="0">关闭</option>
        <option value="1">开启</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">是否显示广告区块</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">滚动广告</label>
      <div class="layui-input-block">
       <input type="text" name="gundong_gg" placeholder="滚动的炫彩文字广告" autocomplete="off" class="layui-input">
      </div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">广告列表</label>
      <div class="layui-input-block">
       <textarea name="gg_list" rows ="2" placeholder="&lt;li&gt;&lt;a href=&quot;#&quot; target=&quot;_blank&quot;&gt;1号广告位&lt;/a&gt;&lt;/li&gt;" class="layui-textarea"></textarea>
      </div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">横幅广告</label>
      <div class="layui-input-block">
       <textarea name="ggw1" rows ="2" placeholder="&lt;img data-src=&quot;./templates/home/wanfeng-new/image/guanggao1.png&quot;&gt;" class="layui-textarea"></textarea>
      </div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label" lay-tips="横幅广告下方的自定义代码">自定义1 <i class="layui-icon layui-icon-tips"></i></label>
      <div class="layui-input-block">
       <textarea name="home_code1" rows ="2" placeholder="横幅广告下方的自定义代码" class="layui-textarea"></textarea>
      </div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">背景音乐</label>
      <div class="layui-input-block">
       <input type="text" name="myaudio" placeholder="输入MP3文件链接" autocomplete="off" class="layui-input">
      </div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">自动播放</label>
      <div class="layui-input-inline">
       <select lay-verify="required" name="myaudio_autoplay">
        <option value="0">关闭</option>
        <option value="1">开启</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">是否自动播放背景音乐</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">循环播放</label>
      <div class="layui-input-inline">
       <select lay-verify="required" name="myaudio_loop">
        <option value="0">关闭</option>
        <option value="1">开启</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">是否循环播放背景音乐</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">logo</label>
      <div class="layui-input-block">
       <input type="text" name="logo" placeholder="图片logo地址,建议png透明来兼容夜间模式" autocomplete="off" class="layui-input">
      </div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">顶部链接</label>
      <div class="layui-input-block">
       <textarea name="navbar_link" rows ="2" placeholder="&lt;li&gt;&lt;a href=&quot;https://github.com/tznb1/TwoNav&quot;&gt;关于本站&lt;/a&gt;&lt;/li&gt;" class="layui-textarea"></textarea>
      </div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">友情链接</label>
      <div class="layui-input-block">
       <textarea name="friend_link" rows ="2" placeholder="&lt;li&gt;&lt;a href=&quot;https://github.com/tznb1/TwoNav&quot; title=&quot;项目地址&quot; target=&quot;_blank&quot;&gt;TwoNav&lt;/a&gt;&lt;/li&gt;" class="layui-textarea"></textarea>
      </div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">联系QQ</label>
      <div class="layui-input-inline" style="width: 200px;">
       <input type="text" name="QQ" autocomplete="off" class="layui-input">
      </div>
      <div class="layui-form-mid layui-word-aux">不填则不显示</div>
    </div>
    <div class="layui-form-item">
     <label class="layui-form-label">联系微信</label>
      <div class="layui-input-inline" style="width: 200px;">
       <input type="text" name="WX" autocomplete="off" class="layui-input">
      </div>
      <div class="layui-form-mid layui-word-aux">不填则不显示</div>
    </div>
    <div class="layui-form-item">
     <label class="layui-form-label">联系邮箱</label>
      <div class="layui-input-inline" style="width: 200px;">
       <input type="text" name="email" autocomplete="off" class="layui-input">
      </div>
      <div class="layui-form-mid layui-word-aux">不填则不显示</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">免责声明</label>
      <div class="layui-input-block">
       <input type="text" name="disclaimers" autocomplete="off" class="layui-input">
      </div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">二维码</label>
      <div class="layui-input-block">
       <textarea name="QR_data" rows ="2" placeholder="格式为JSON数组,双击使用示例代码" class="layui-textarea"></textarea>
      </div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">底部链接</label>
      <div class="layui-input-block">
       <textarea name="bottom_a" rows ="2" placeholder="双击使用示例代码" class="layui-textarea"></textarea>
      </div>
    </div>
    <div class="layui-form-item">
     <label class="layui-form-label">51统计</label>
      <div class="layui-input-block">
       <textarea name="tongji" rows ="2" placeholder="51统计代码,没有可不填" class="layui-textarea"></textarea>
      </div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">全站变灰</label>
      <div class="layui-input-inline">
       <select lay-verify="required" name="mourn">
        <option value="0">关闭</option>
        <option value="1">开启</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">全站变灰悼念伟人</div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label">异步加载</label>
      <div class="layui-input-inline">
       <select lay-verify="required" name="yibujiazai">
        <option value="0">关闭</option>
        <option value="1">开启</option>
       </select>
      </div>
     <div class="layui-form-mid layui-word-aux">数据量多时可以开启</div>
    </div>


	<div class="layui-form-item">
		<label class="layui-form-label">注意事项</label>
		<div class="layui-form-mid layui-word-aux" style="color: #d40909!important;">部分配置无自定义代码权限时不生效</div>
	</div>
	
    <fieldset class="layui-elem-field layui-field-title">
      <legend>文章模板配置</legend>
    </fieldset>

    <div class="layui-form-item">
     <label class="layui-form-label">头部背景</label>
      <div class="layui-input-block">
       <input type="text" name="grbjtp" placeholder="页内搜索上方的标题" autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
     <label class="layui-form-label">用户头像</label>
      <div class="layui-input-block">
       <input type="text" name="grzy1" placeholder="页内搜索上方的标题" autocomplete="off" class="layui-input">
      </div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label" lay-tips="文章封面下方的自定义代码">自定义1 <i class="layui-icon layui-icon-tips"></i></label>
      <div class="layui-input-block">
       <textarea name="wz_code1" rows ="2" placeholder="文章封面下方的自定义代码" class="layui-textarea"></textarea>
      </div>
    </div>
    
    <div class="layui-form-item">
     <label class="layui-form-label" lay-tips="Top10上方的自定义代码">自定义2 <i class="layui-icon layui-icon-tips"></i></label>
      <div class="layui-input-block">
       <textarea name="wz_code2" rows ="2" placeholder="Top10上方的自定义代码" class="layui-textarea"></textarea>
      </div>
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
    
    // 获取元素上的lay-tips属性并为其添加提示
    $("*[lay-tips]").mouseenter(function() {
        var tipsContent = $(this).attr("lay-tips");
        var tipsIndex = layer.tips(tipsContent, this);
        $(this).data("index", tipsIndex);
    });

    // 当鼠标离开元素时关闭提示
    $("*[lay-tips]").mouseleave(function() {
        layer.close($(this).data("index"));
    });

    var $textarea = $("textarea[name='QR_data']");
    $textarea.on("dblclick", function() {
        if ($textarea.val().trim() === "") {
            $textarea.val('[{"data-src":"图片链接","a":"扫码加WX"},{"data-src":".图片链接","a":"扫码赞助"}]');
            $textarea.select();
            document.execCommand("copy");
            alert("示例代码已复制到剪贴板！");
        }
    });
    
    var $textarea = $("textarea[name='bottom_a']");
    $textarea.on("dblclick", function() {
        if ($textarea.val().trim() === "") {
            $textarea.val('<li><a href="#">网站地图</a></li><li><a href="#">广告合作</a></li><li><a href="#" >免责声明</a></li>');
            $textarea.select();
            document.execCommand("copy");
            alert("示例代码已复制到剪贴板！");
        }
    });
    
});
</script>
</body>
</html>