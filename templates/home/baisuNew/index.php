<!DOCTYPE html>
<html lang="zh-ch">
	<head>
		<meta charset="utf-8">
		<meta name="renderer" content="webkit|ie-comp|ie-stand">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<meta http-equiv="Cache-Control" content="no-transform">
		<meta name="applicable-device" content="pc,wap">
		<meta name="MobileOptimized" content="width">
		<meta name="HandheldFriendly" content="true">
		<meta name="author" content="BaiSu" />
		<title><?php echo $site['Title']; ?></title>
		<meta name="keywords" content="<?php echo $site['keywords']; ?>" />
		<meta name="description" content="<?php echo $site['description']; ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?php echo $theme_dir?>/css/style.css?v=<?php echo $theme_ver; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo $libs?>/Font-awesome/4.7.0/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $layui['css']; ?>" />
	</head>
	<body>
		<div class="wap-header">
			<div class="logo"><a href=""><?php echo $site['logo']; ?></a></div>
		</div>
		<div class="navlist-main"> <?php if( isset($_GET['oc']) ) { echo '<div class="overlay"></div>'; } //仅分类模式遮蔽分类栏?> 
			<div class="logo"><a href=""><?php echo $site['logo']; ?></a></div>
			<div class="type-list"><?php
			//遍历分类目录并显示
			foreach ($category_parent as $category) {
			    $isSub = empty($category['subitem_count']) ? '' : '<i class="sub layui-icon layui-icon-right"></i>';
			    $property = $category['property'] == 1 ? '<span class="property">私</span> ' :'';?> 
				<div class="list">
					<a class="typeList" data-id="<?php echo $category['id']; ?>" href="#category-<?php echo $category['id']; ?>">
						<i class="<?php echo $category['font_icon']; ?>"></i>
						<p><?php echo $category['name']; ?></p>
						<div class="icon"><?php echo $property; ?><?php echo $isSub; ?></div>
					</a><?php if(!empty($category['subitem_count'])){ 
					//存在二级分类 ?> 
					<div class="list-sub"><?php foreach (get_category_sub( $category['id'] ) as $category_sub){
					    //遍历二级分类
					    $sub_property = $category_sub['property'] == 1 ? '<span class="property">私</span>':'';?> 
						<a class="typeList" data-id="<?php echo $category_sub['id']; ?>" href="#category-<?php echo $category_sub['id']; ?>">
							<i class="<?php echo $category_sub['font_icon']; ?>"></i>
							<p><?php echo $category_sub['name']; ?></p>
							<div class="icon"><?php echo $sub_property; ?></div>
						</a><?php } 
						//渲染二级分类End ?> 
					</div><?php } 
					//存在二级分类End?> 
				</div><?php } 
			//遍历分类End 
            if( is_login ) {
            //如果已登录则显示添加分类和添加书签 ?> 
				<div class="list-w2">
				    <div class="list" id="nav-add-type"><a><i class="layui-icon layui-icon-addition"></i><p>分类</p></a></div>		
					<div class="list" id="nav-add-link"><a><i class="layui-icon layui-icon-addition"></i><p>书签</p></a></div>	
				</div><?php 
            } ?> 
			</div>
			<div class="user-info">
				<div class="pic">
					<a href=""><img src="<?php echo $theme_dir?>/images/touxiang.png"></a>
				</div>
				<div class="text">
				    <a href="./index.php?c=admin&u=<?php echo U?>" target="_blank">
				        <p class="t1"><?php echo is_login ? $site['title']:'尚未登录'?></p>
					    <p class="t2"><?php echo is_login ? '系统管理':'立即登陆系统'?></p>
					</a>
				</div>
			</div>
		</div>
		<!--主体内容-->
		<div class="index-main">
		    <!--顶部栏-->
			<div class="header-main">
			    <!--搜索-->
				<div class="seaech-main-w">
					<div class="seaech-main">
						<div class="input">
							<input type="text" id="search" name="search" placeholder="支持站内书签搜索及百度搜索" />
							<i class="layui-icon layui-icon-search"></i>
						</div>
						<div class="btn">
							<div class="btn-s" id="seaech-to">
								<img src="<?php echo $theme_dir?>/images/baidu.svg" />百度搜索
							</div>
						</div>
					</div>
				</div>
                <!--日期时间-->
				<div class="times-main">
					<div class="time" id="time">00:00:00</div>
					<div class="date" id="date">2022 年 12 月 31 日</div>
					<div class="calendar">
						<span id="nowLunar">壬寅年腊月初六</span>
						<span id="nowWeek">星期三</span>
					</div>
				</div>
				<!--和风天气-->
                <div class="weather-main" id="he-plugin-standard"></div>
			</div>
			<!--书签内容-->
			<div class="site-main"> <?php foreach ( $categorys as $category ) { 
			    //遍历分类目录
                $fid = $category['id'];
                $links = get_links($fid);
				$property = $category['property'] == 1 ? '<span class="property">私</span>':''; ?> 
				<div class="site-main-li">
					<div class="site-tit" id="category-<?php echo $category['id']; ?>">
					    <i class='<?php echo $category['font_icon']; ?>'></i><?php echo $category['name']; ?><?php echo $property; ?>
<?php if( $theme_config['describe'] == 1 && !empty($category['description'])) { ?> 
						<div class="desc"><?php echo $category['description']; ?></div>
<?php }?>
					</div>
					<div class="site-list"><?php foreach ($links as $link) { //遍历链接
					$link['description'] = empty($link['description']) ? '作者很懒，没有填写描述。' : $link['description'];
					$link_property = $link['property'] == 1 ? '<span class="property">私</span>' : '';?> 
						<div class="list siteList" data-id="<?php echo $link['id']; ?>" data-url="<?php echo $link['url']; ?>" data-links="<?php echo $link['real_url']; ?>">
							<img src="<?php echo $link['ico']; ?>" class="icon" />
							<p class="title"><?php echo $link['title']; ?></p><?php if( $theme_config['describe'] == 1) { ?> 
							<div class="desc"><?php echo $link['description']; ?></div><?php }?> 
							<?php echo $link_property; ?> 
						</div><?php } ?> 
						<div class="list kongs"></div>
						<div class="list kongs"></div>
						<div class="list kongs"></div>
						<div class="list kongs"></div>
						<div class="list kongs"></div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<footer class="show">
            <?php echo $copyright.' | The theme author is <a href="https://gitee.com/baisucode/onenav-baisu" target="_blank">BaiSu</a>'.PHP_EOL;?>
            <?php echo $ICP.PHP_EOL;?>
            <?php echo $site['custom_footer'].PHP_EOL;?>
            <?php echo $global_config['global_footer'].PHP_EOL;?>
		</footer>
	    <?php if( is_login ) include ("admin.php"); ?>
        <script src="<?php echo $libs?>/jquery/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo $layui['js']; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo $theme_dir?>/js/dayjs.min.js"></script>
		<script src="<?php echo $theme_dir?>/js/lunar.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo $theme_dir?>/js/axios.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?php echo $libs?>/Other/ClipBoard.min.js"></script>
        <script src="<?php echo $libs?>/Other/holmes.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo $theme_dir?>/js/common.js?v=<?php echo $theme_ver; ?>" type="text/javascript" charset="utf-8"></script><?php if( is_login ) { ?> 
		<script>var u = '<?php echo $u?>';</script>
		<script src="<?php echo $theme_dir?>/js/admin.js?v=<?php echo $theme_ver; ?>" type="text/javascript" charset="utf-8"></script><?php } ?> 
		<script type="text/javascript">
			WIDGET = {
				"CONFIG": {
					"layout": "1",
					"width": "220",
					"height": "180",
					"background": "1",
					"dataColor": "FFFFFF",
					"borderRadius": "6",
					"modules": "10",
					"key": "7423b182d5cb48239f19df9e25cdf320"
				}
			}
		</script>
		<script src="https://widget.qweather.net/standard/static/js/he-standard-common.js?v=2.0"></script>
	</body>
</html>