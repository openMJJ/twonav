<?php
$article_top10 = get_article_list(0,10);
$data = get_article_content($_GET['id']);

?>
<!DOCTYPE html>
<html lang="zh">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $data['title'] . ' - ' . $site['subtitle'];?></title>
    <meta name="keywords" content="<?php echo $site['keywords']; ?>">
    <meta name="description" content="<?php echo $site['description']; ?>">
	<link rel="shortcut icon" href="<?php echo $favicon;?>" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo $theme_dir?>/css/wenzhang.css">
	<link rel="stylesheet" href="<?php echo $theme_dir?>/css/xcode.min.css">
	<script src="<?php echo $theme_dir?>/js/highlight.min.js"></script>
	<script src="<?php echo $libs?>/jquery/jquery-3.6.0.min.js"></script>
	<?php echo $site['custom_header'].PHP_EOL?>
    <?php echo $global_config['global_header'].PHP_EOL?>
</head>

<body>
	<?php require 'header.php'; ?>
	<!-- 置顶按钮 -->
	<img class="lrc" id="scroll-to-top" src="<?php echo $theme_dir?>/image/zd.png" alt="">
	<!-- 文章内容 -->
	<div class="wzybox">
		<article>
			<div class="wzfm">
				<img data-src="<?php echo empty($data['cover'])?$theme_dir.'/image/default'.rand(1,3).'.jpg':$data['cover'];?>" loading="lazy" alt="文章封面">
			</div>
			<!--自定义代码1-->
			<?php echo $theme_config['wz_code1'];?>
			<div class="wzynr">
				<h2 class="wz_title"><?php echo $data['title'];?></h2>
				<div class="wzynrzw">
					<?php echo $data['content'];?>
				</div>
				<div class="wzjsy">
					<p>------本页内容已结束，喜欢请分享------</p>
					<p class="tip" >感谢您的来访，获取更多精彩文章请收藏本站。</p>
					<div class="wzjsyimg">
						<img data-src="<?php echo $theme_dir?>/image/scbz_50.jpg" loading="lazy" alt="">
					</div>
				</div>
		</article>
		<!-- 文章内容右侧 -->
		<div class="wzyright">
		    
			<div class="grbjtp">
				<img data-src="<?php echo $theme_config['grbjtp'];?>" loading="lazy" alt="背景封面">
			</div>
			<div class="grzy">
				<img data-src="<?php echo $theme_config['grzy1'];?>" loading="lazy" alt="站长QQ图像">
				<!--<img data-src="https://www.a754.com/wp-content/uploads/2023/06/1e8bb6f3d7023442.gif" loading="lazy" alt="徽章">-->
			</div>
			<div class="grzynr">
				<a><?php echo $site['Title'];?></a>
				<!--<img data-src="http://www.a754.com/wp-content/uploads/2023/04/3019f42220002044.gif" loading="lazy" alt="">-->
			</div>
			<!--自定义代码2-->
			<?php echo $theme_config['wz_code2'];?>
			<!--右侧文章top10-->
			<div class="grzylist">
				<ul>
				    <?php $top = 0; foreach ($article_top10['data'] as $article) { $top++; ?> 
					<li>
						<a href="./?<?php echo $theme_config['wenzhang_nz'] == '1' ? '':'c=article&' ?>id=<?php echo $article['id'];?>&u=<?php echo $u;?>">
							<h3>TOP<?php echo $top;?></h3>
							<img data-src="<?php echo empty($article['cover'])?$theme_dir.'/image/default'.rand(1,3).'.jpg':$article['cover'];?>" loading="lazy" alt="">
							<p><?php echo $article['title'];?></p>
						</a>
					</li>
					<?php  }?> 
				</ul>
			</div>
		</div>
	</div>
    <?php require 'footer.php'; ?>
	<script>
	    const u = '<?php echo $u;?>';var page = 'article';
	    const theme_config = <?php echo json_encode($theme_config);?>;
	 </script>
	<script src="<?php echo $theme_dir?>/js/index.js?v=<?php echo $theme_ver; ?>"></script>
	<script src="<?php echo $theme_dir?>/js/spotlight.bundle.js"></script>
</body>

</html>