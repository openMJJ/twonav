<?php 

//判断指定分类是否存在文章
$xw = false;
if($theme_config['xinwenlanmu'] > 0){
    foreach ($categorys as $item) {
        if ($item['id'] == $theme_config['xinwenlanmu']) {
            $xw = true;
            $xw_category = $item;
        }
    }
    if($xw){
        $xw_article = get_article_list($theme_config['xinwenlanmu'],10);
        if(empty($xw_article)){
            $xw = false;
        }
    }
}

//获取二级分类
function get_sub_category($array, $key, $value) {
    $filteredArray = [];
    foreach ($array as $item) {
        if (isset($item[$key]) && $item[$key] === $value ) {
            $filteredArray[] = $item;
        }
    }
    return $filteredArray;
}

function del_useless_fields(&$array, $fieldsToRemove) {
    foreach ($array as &$item) {
        if (is_array($item)) {
            foreach ($fieldsToRemove as $field) {
                if (isset($item[$field])) {
                    unset($item[$field]);
                }
            }
        }
    }
}
if($theme_config['yibujiazai'] == 0 || $_GET['api'] == 'data'){ 
    $mix_data = $category_parent;
    //处理二级分类
    foreach ($category_parent as $key => $category) {
        $sub_category = get_sub_category($categorys,'fid',$category['id']);
        $mix_data[$key]['sub_category'] = $sub_category;
    }
    //处理链接
    $useless_fields = ['real_url','url_standby','click','extend','fid','icon','pid','property','type','id'];
    foreach ($mix_data as $key1 => $category) {
        $mix_data[$key1]['links'] = get_links($category['id']);
        del_useless_fields($mix_data[$key1]['links'],$useless_fields);
        foreach ($category['sub_category'] as $key2 => $category) {
            $mix_data[$key1]['sub_category'][$key2]['links'] = get_links($category['id']);
            del_useless_fields($mix_data[$key1]['sub_category'][$key2]['links'],$useless_fields);
        }
    }
    if($theme_config['yibujiazai'] == 1 && $_GET['api'] == 'data'){
        msgA(['code'=>1,'data'=>$mix_data]);
    }
}

if(!check_purview('header',1)){
    foreach (['navbar_link','friend_link','gg_list','ggw1','bottom_a','tongji'] as $key) {
        $theme_config[$key] = '';
    }
    
}
//读取文章列表
if($theme_config['wenzhang_sl'] > 0){
    $article_list = get_article_list(0,intval(trim($theme_config['wenzhang_sl'])));
}
?>
<!DOCTYPE html>
<html lang="zh" >
<head >
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site['Title'];?></title>
    <meta name="keywords" content="<?php echo $site['keywords']; ?>">
    <meta name="description" content="<?php echo $site['description']; ?>">
	<link rel="shortcut icon" href="<?php echo $favicon;?>" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo $theme_dir?>/css/jiazaidonghua.css">
	<link rel="stylesheet" href="<?php echo $theme_dir?>/css/style.css?v=<?php echo $theme_ver; ?>">
	<link rel="stylesheet" href="<?php echo $libs?>/Font-awesome/4.7.0/css/font-awesome.css">
	<script src="<?php echo $libs?>/jquery/jquery-3.6.0.min.js"></script>
	<style id="custom_css"></style>
	<?php echo $site['custom_header'].PHP_EOL?>
    <?php echo $global_config['global_header'].PHP_EOL?>
</head>

<body >
	<!-- 加载动画 -->
	<div class="container" id="loader">
        <div class="iron-man"><span></span><span></span><span></span><span></span>
            <img src="<?php echo $theme_dir?>/image/iron_man.png" alt="">
        </div>
        <div class="lines">
            <span></span><span></span><span></span><span></span>
        </div>
        <div class="loading-text">灭霸你给我等着，等我数据加载完</div>
    </div>
	<!-- 移动端侧边栏 -->
	<div id="mySidebar" class="sidebar">
		<div class="cblzc" id="cblzcbs">
			<a class="closebtn" onclick="closeNav()"></a>
			<div class="cbl-logo">
				<img src="<?php echo $theme_config['logo']; ?>" alt="侧边栏顶部logo">
			</div>
			<div class="cblfl"><ul><!--由js渲染数据至此--></ul></div>
			<div class="cblfldb">
				<?php if($xw == true){ echo '<a href="#xinwenlanmu" id="m_xw">'.$xw_category['name'].'</a>'; } ?> 
				<?php if(!empty(@$article_list['count'])){ echo '<a href="#wenzhangliebiao" id="m_wz">文章列表</a>'; } ?>   
				<?php if(!empty($theme_config['friend_link'])){ echo '<a href="#youqinglianjie" id="m_yl">友情链接</a>'; } ?>  
			</div>
		</div>


	</div>

	<!-- 悬浮按钮 -->
	<!-- 日夜模式按钮 -->
	
	<button id="mode-switch">
		<pre id="moon-icon"></pre>
		<pre id="sun-icon" style="display: none;"></pre>
	</button>
	<!-- 置顶按钮 -->
	<img class="lrc" id="scroll-to-top" src="<?php echo $theme_dir?>/image/zd.png" alt="">
	<!-- 背景音乐按钮 -->
	
	<?php if(!empty($theme_config['myaudio'])) { ?> 
	<!-- 背景音乐 -->
	<audio id="myaudio" src="<?php echo $theme_config['myaudio']?>" preload="none"></audio>
	<!-- 背景音乐按钮图片 -->
	<img class="lrc" id="tp" src="<?php echo $theme_dir?>/image/bjyytb.png" />
    <?php  }?> 
    
	<!-- 顶部导航栏 -->
	<div class="header" id="headerbs">
		<div class="top">
			<!-- 网站logo -->
			<div class="logo">
				<a href="./?u=<?php echo $u?>">
					<img data-src="<?php echo $theme_config['logo']; ?>" alt="logo">
				</a>
			</div>
			<!-- 顶部导航栏列表 -->
			<a class="openbtn" onclick="openNav()">☰</a>
			<div class="top-list">
				<nav>
					<ul>
						<li><a href="./?u=<?php echo $u?>">首页</a></li>
						<li id="x">
							<a>分类
								<svg t="1689710042785" class="icon" id="sx" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3747" width="12" height="12">
									<path d="M560 736c-12.288 0-24.576-4.672-33.92-14.08l-256-256c-18.752-18.752-18.752-49.152 0-67.904s49.152-18.752 67.904 0l222.08 222.08 222.08-222.08c18.752-18.752 49.152-18.752 67.904 0s18.752 49.152 0 67.904l-256 256C584.576 731.328 572.288 736 560 736z" p-id="3748"></path>
								</svg>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>

	<!-- 分类内容 -->
	<div class="fl" id="flbs">
		<div class="fl-list"><ul><!--由js渲染数据至此--></ul></div>
	</div>
	<?php if($theme_config['search'] > 0) {?> 
	<!-- 搜索引擎区块 -->
	<div class="search-container">
		<h3><?php echo $theme_config['title'];?></h3>
		<div id="search-tabs" class="tabss"><!--由js渲染数据至此--></div>
		<div id="search-input">
			<input type="text" id="search-input" placeholder="请输入搜索内容">
			<button id="search-btn" >搜索</button>	
		</div>
	</div>
    <?php  }?> 
    
    <?php if($theme_config['gg'] == '1') {?>
	<!-- 广告位 -->
	<div class="glyg">
		<!-- 跑马灯 -->
		<div class="pmd">
			<marquee behavior="" direction="">
				<p id="pmd_text"></p>
			</marquee>
		</div>
		<div class="ggw0">
			<!-- 文字广告列表 -->
			<div class="gg-list"></div>
		</div>
	</div>
	
	<!-- 横幅广告 -->
	<div class="ggw1"></div>
	<?php  } //广告区 End?> 
	<?php echo $theme_config['home_code1'];?>
	<div class="main">
		<!-- 侧边栏分类 -->
		<div class="cebianlan"><ul><!--由js渲染数据至此--></ul></div>
		<!-- 站点列表 -->
		<div class="main-list">
		    
		</div><!-- main-list结束 -->
	</div><!-- main结束 -->

	<!-- 文章区块 -->
	<div class="wenzhang">

		<div class="wenzhangnr">
		    <?php if($xw == true){ echo '<div class="wzbt" id="xinwenlanmu"><h3>'.$xw_category['name'].'</h3></div>';  ?>
			<div class="wzlm">
				<ul>
				    <?php foreach ($xw_article['data'] as $article) { 
				        if($theme_config['wenzhang_nz'] == '1'){
                            $article['url'] = "./?id={$article['id']}&u={$u}"; 
                        }
				    ?> 
					<li>
						<a href="<?php echo $article['url'];?>" target="_blank">
							<img data-src="<?php echo empty($article['cover'])?$theme_dir.'/image/default'.rand(1,3).'.jpg':$article['cover'];?>" alt="">
							<h3><?php echo $article['title'];?></h3>
							<p><?php echo $article['summary'];?></p>
						</a>
					</li>
					<?php  }?> 
				</ul>
			</div>
			<?php  }?> 
			<?php if( $theme_config['wenzhang_sl'] > 0 && $article_list['count'] > 0) {   ?> 
			<!-- 文章列表 -->
			<div class="wzbt" id="wenzhangliebiao">
				<h3>文章列表</h3>
			</div>
			<div class="wz-list">
                <?php foreach ($article_list['data'] as $article) {  
                    if($theme_config['wenzhang_nz'] == '1'){
                        $article['url'] = "./?id={$article['id']}&u={$u}"; 
                    }
                ?> 
				<a href="<?php echo $article['url'];?>" target="_blank">
					<div class="wzk">

						<div class="wzkimg">
							<img data-src="<?php echo empty($article['cover'])?$theme_dir.'/image/default'.rand(1,3).'.jpg':$article['cover'];?>" alt="">
						</div>
						<div class="wzkyc">
							<h3><?php echo $article['title'];?></h3>
							<p><?php echo $article['summary'];?></p>
						</div>
					</div>
				</a>
                <?php  }?> 
			</div>
			<?php  }?> 
			<!-- 友情链接 -->
			<div class="wzbt" id="youqinglianjie">
				<h3>友情链接</h3>
			</div>
			<div class="yqlj"></div>
		</div>
	</div>
	<!-- 底部 -->
	<div class="foot">
		<div class="footer">
			<div class="left">
				<div class="leftimg">
					<img data-src="<?php echo $theme_config['logo']; ?>" alt="logo">
				</div>
				<a><?php echo $site['keywords']; ?></a>
			</div>
			<div class="center">
				<div class="biaoqian"><ul></ul></div>
				<div class="banquan" style="color: #969CA9;">
				    <?php 
				    if(!empty($copyright)){
				        echo "<a>{$copyright}</a> · ";
				    }
				    if(!empty($ICP)){
				        echo "<a>{$ICP}</a> · ";
				    }
				    if(!empty($theme_config['disclaimers'])){
				        echo "<a>{$theme_config['disclaimers']}</a>";
				    }
				    if(!empty($site['custom_footer'])) {
				        echo '<br />'.$site['custom_footer'];
				    }
				    if(!empty($global_config['global_footer'])) {
				        echo '<br />'.$global_config['global_footer'];
				    }
				    ?>
				</div>
				<div class="tb"></div>
			</div>
			<div class="right"><ul></ul></div>
		</div>
	</div>
	<div class="tongji">
		<div class="tongjinr"><?php echo $theme_config['tongji'];?></div>
	</div>
	<!--底部波浪开始-->
	<div class="wiiuii_layout">
		<svg class="editorial" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none">
			<defs>
				<path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
			</defs>
			<g class="parallax">
				<use xlink:href="#gentle-wave" x="50" y="0" fill="#4579e2" />
				<use xlink:href="#gentle-wave" x="50" y="3" fill="#3461c1" />
				<use xlink:href="#gentle-wave" x="50" y="6" fill="#2d55aa" />
			</g>
		</svg>
	</div>
	<!--底部波浪结束-->
	<script>
	    const u = '<?php echo $u;?>';var mix_data = false;var page = 'home';
	    const theme_config = <?php echo json_encode($theme_config);?>;
	    const category_parent = <?php echo json_encode($category_parent);?>;
        <?php if($theme_config['yibujiazai'] == 0){ ?>mix_data = <?php echo json_encode($mix_data);?>; <?php }?> 
	 </script>
	 <script src="<?php echo $theme_dir?>/js/index.js?v=<?php echo $theme_ver; ?>"></script>
</body>
</html>