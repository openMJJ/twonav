<?php if(!defined('DIR')){header('HTTP/1.1 404 Not Found');header("status: 404 Not Found");exit;} ?>
<script>
    var category_parent = <?php echo json_encode($category_parent); ?>;
    var categorys = <?php echo json_encode($categorys); ?>;
</script>

<div class="component-main" id="component_type_add" style="display: none;">
	<div class="title">添加分类</div>
	<form class="layui-form list-w" lay-filter="type_add">
	    <input type="hidden" name="fid" id="fid" value="0" />
		<div class="list">
			<span class="icon"><i class="layui-icon layui-icon-edit"></i></span>
			<input type="text" class="text" name="name" id="name" lay-verify="required" placeholder="请输入分类名称" autocomplete="off">
		</div>
		<div class="list list-icons">
			<span class="icon font_icon_show"><i class="fa fa-book"></i></span>
			<input type="text" class="text" name="font_icon" id="font_icon" required="" lay-verify="required" placeholder="请输入分类图标" autocomplete="off" value="fa fa-book">
			<div class="select_icons">选择图标</div>
		</div>
		<div class="list-type" id="categoryList" type="category">
			<span class="hover" data-fid = "0">一级分类</span>
			<!--由js插入数据-->
		</div>
		<div class="list list-2">
			<div class="li">私有：<input type="checkbox" name="property" id="property" value = "1" lay-skin="switch" lay-text="是|否"></div>
		</div>
		<div class="list">
			<textarea name="description" id="description" placeholder="请输入分类描述（选填）"></textarea>
		</div>
		<div class="list">
			<button lay-submit="" lay-filter="type_add">添加</button>
		</div>
	</form>
</div>

<div class="component-main" id="component_type_edit" style="display: none;">
	<div class="title">编辑分类</div>
	<form class="layui-form list-w" lay-filter="type_edit">
		<input type="hidden" name="cid" id="cid" value="" />
		<input type="hidden" name="fid" id="fid" value="0" />
		<div class="list">
			<span class="icon"><i class="layui-icon layui-icon-edit"></i></span>
			<input type="text" class="text" name="name" id="name" lay-verify="required" placeholder="请输入分类名称" autocomplete="off">
		</div>
		<div class="list list-icons">
			<span class="icon font_icon_show"><i class="fa fa-book"></i></span>
			<input type="text" class="text" name="font_icon" id="font_icon" required="" lay-verify="required" placeholder="请输入分类图标" autocomplete="off" value="fa fa-book">
			<div class="select_icons">选择图标</div>
		</div>
		<div class="list-type" id="categoryList" type="category">
			<span class="hover" data-fid = "0">一级分类</span>
			<!--由js插入数据-->
		</div>
		<div class="list list-2">
			<div class="li">私有：<input type="checkbox" name="property" id="property" lay-skin="switch" lay-text="是|否"></div>
		</div>
		<div class="list">
			<textarea name="description" id="description" placeholder="请输入分类描述（选填）"></textarea>
		</div>
		<div class="list">
			<button lay-submit="" lay-filter="type_edit">保存</button>
		</div>
	</form>
</div>

<div class="component-main" id="component_links_add" style="display: none;">
	<div class="title">添加书签</div>
	<form class="layui-form list-w" lay-filter="links_add">
		<input type="hidden" name="fid" id="fid" value="" />
		<div class="list">
			<span class="icon"><i class="layui-icon layui-icon-senior"></i></span>
			<input type="text" class="text" name="url" id="url" required="" lay-verify="required|url" placeholder="请输入书签链接" autocomplete="off">
		</div>
		<div class="list">
			<span class="icon"><i class="layui-icon layui-icon-edit"></i></span>
			<input type="text" class="text" name="title" id="title" required="" lay-verify="required" placeholder="请输入标签名称" autocomplete="off">
		</div>
		<div class="list-type" id="categoryList" type="link">
		    <!--由js插入数据-->
		</div>
		<div class="list list-2">
			<div class="li">私有：<input type="checkbox" name="property" id="property" lay-skin="switch" lay-text="是|否"></div>
		</div>
		<div class="list">
			<textarea name="description" id="description" placeholder="请输入书签描述（选填）"></textarea>
		</div>
		<div class="list list-btn02">
			<button id="get_links_info" class="btn01" >获取链接信息</button>
			<button lay-submit="" lay-filter="links_add" class="btn02">添加链接</button>
		</div>
	</form>
</div>

<div class="component-main" id="component_links_edit" style="display: none;">
	<div class="title">编辑书签</div>
	<form class="layui-form list-w" lay-filter="links_edit">
		<input type="hidden" name="lid" id="lid" value="" />
		<input type="hidden" name="fid" id="fid" value="" />
		<div class="list">
			<span class="icon"><i class="layui-icon layui-icon-senior"></i></span>
			<input type="text" class="text" name="url" id="url" required="" lay-verify="required|url" placeholder="请输入书签链接" autocomplete="off">
		</div>
		<div class="list">
			<span class="icon"><i class="layui-icon layui-icon-edit"></i></span>
			<input type="text" class="text" name="title" id="title" required="" lay-verify="required" placeholder="请输入标签名称" autocomplete="off">
		</div>
		<div class="list-type" id="categoryList" type="link">
            <!--由js插入数据-->
		</div>
		<div class="list list-2">
			<div class="li">私有：<input type="checkbox" name="property" id="property" lay-skin="switch" lay-text="是|否"></div>
		</div>
		<div class="list">
			<textarea name="description" id="description" placeholder="请输入书签描述（选填）"></textarea>
		</div>
		<div class="list list-btn02">
			<button id="get_links_info" class="btn01" >获取链接信息</button>
			<button lay-submit="" lay-filter="links_edit" class="btn02">编辑链接</button>
		</div>
	</form>
</div>