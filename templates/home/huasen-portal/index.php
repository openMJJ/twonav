<?php
if(in_array($_GET['method'],['findAppConfig','findByCode','findAll','findJournalInformationById','article_list'])){
    if($_GET['method'] === 'findAppConfig'){
        exit(file_get_contents(DIR.'/templates/home/huasen-portal/data/findAppConfig.json')) ;
    }
    if($_GET['method'] === 'findByCode'){
        exit(file_get_contents(DIR.'/templates/home/huasen-portal/data/findByCode.json'));
    }
    if($_GET['method'] === 'findAll'){
        exit(file_get_contents(DIR.'/templates/home/huasen-portal/data/findAll.json'));
    }
    if($_GET['method'] === 'findJournalInformationById'){
        $data['code'] = 200;
        $data['msg'] = '成功获取数据';
        $data['data']['_id'] = '641881fa39ede6001dacb8b9';
        $data['data']['name'] = '默认订阅';
        $data['data']['code'] = 0;
        $data['data']['expand'] = '{}';
        $series = [];
        foreach ( $categorys as $category ) {
            $links['typeName'] = $category['name'];
            $links['sites'] = get_links($category['id']);
            foreach ($links['sites'] as &$link) {
                $link['name'] = $link['title'];
                $link['describe'] = $link['description'];
                $link['icon'] = $link['ico'];
            }
            array_push($series,$links);
        }
        $data['data']['series'] = $series;
        exit(json_encode($data));
    }
    //未开启或无权限时不查询数据
    if($_GET['method'] === 'article_list'  && ($global_config['article'] == 0 | !check_purview('article',1))){ 
        exit(json_encode(['code'=>400,'msg'=>'获取文章数据失败','data'=>[]]));
    }
    //文章内容
    if($_GET['method'] === 'article_list' && !empty($_GET['_id'])){
        $article = get_article_content($_GET['_id']);
        
        if(empty($article['id'])){
            exit(json_encode(['code'=>400,'msg'=>'文章不存在或无权限查阅','data'=>[]]));
        }
        $new_article = [
                'bannerImg'=>$article['cover'],
                'code'=>0,
                'content'=>'<br />'.$article['content'],
                'isDraft'=> false,
                'manageId'=>'',
                'tag'=> $article['category_name'],
                'time'=>date('Y-m-d', $article['up_time']),
                'title' => $article['title'],
                '_id'=>$article['id']
                ];
                
        exit(json_encode(['code'=>200,'msg'=>'请求成功·查询文章成功','data'=>[$new_article]]));
    }
    
    //文章列表
    if($_GET['method'] === 'article_list'){
        $articles = get_article_list(0,200);
        $new_articles = [];
        foreach ( $articles['data'] as $article ) {
            array_push($new_articles,[
                'bannerImg'=>$article['cover'],
                'code'=>0,
                'content'=>$article['content'],
                'isDraft'=> false,
                'manageId'=>'',
                'tag'=>$article['category_name'],
                'time'=>date('Y-m-d', $article['up_time']),
                'title' => $article['title'],
                '_id'=>$article['id']
                ]);
        }
        exit(json_encode(['code'=>200,'msg'=>'请求成功·查询文章成功','data'=>$new_articles]));
    }
    
}
?>
<!DOCTYPE html>
<html lang="zh_CN" theme-mode="light">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta id="viewport" name="viewport" content="width=device-width,initial-scale=1">
		<link rel="shortcut icon" href="<?php echo $favicon;?>">
		<title><?php echo $site['Title']; ?></title>
		<meta name="keywords" content="<?php echo $site['keywords']; ?>">
		<meta name="description" content="<?php echo $site['description']; ?>">
		<link rel="stylesheet" href="<?php echo $theme_dir?>/loading.css">
		<script>
        var user = '<?php echo $u?>',title = '<?php echo $site['Title']; ?>';
        </script>
		<link href="<?php echo $theme_dir?>/css/chunk-048fae1a.60b2bf44.css" rel="prefetch">
		<link href="<?php echo $theme_dir?>/css/chunk-10941450.69da767e.css" rel="prefetch">
		<link href="<?php echo $theme_dir?>/css/chunk-2d63bd87.1fed944d.css" rel="prefetch">
		<link href="<?php echo $theme_dir?>/css/chunk-3158845a.f7c23f3a.css" rel="prefetch">
		<link href="<?php echo $theme_dir?>/css/chunk-67cc8328.f1639489.css" rel="prefetch">
		<link href="<?php echo $theme_dir?>/css/chunk-74c4abd2.b99ce301.css" rel="prefetch">
		<link href="<?php echo $theme_dir?>/css/chunk-b8c40a10.bbcb30c1.css" rel="prefetch">
		<link href="<?php echo $theme_dir?>/css/chunk-d7daa0f4.e1724bb5.css" rel="prefetch">
		<link href="<?php echo $theme_dir?>/css/chunk-da7953d2.4b05a1f9.css" rel="prefetch">
		<link href="<?php echo $theme_dir?>/js/chunk-048fae1a.e5503c7d.js" rel="prefetch">
		<link href="<?php echo $theme_dir?>/js/chunk-10941450.65890875.js" rel="prefetch">
		<link href="<?php echo $theme_dir?>/js/chunk-2d63bd87.51e3e686.js" rel="prefetch">
		<link href="<?php echo $theme_dir?>/js/chunk-3158845a.bee5832f.js" rel="prefetch">
		<link href="<?php echo $theme_dir?>/js/chunk-67cc8328.756abb43.js" rel="prefetch">
		<link href="<?php echo $theme_dir?>/js/chunk-74c4abd2.256fa8e6.js" rel="prefetch">
		<link href="<?php echo $theme_dir?>/js/chunk-b8c40a10.372f5ace.js" rel="prefetch">
		<link href="<?php echo $theme_dir?>/js/chunk-d7daa0f4.777e8279.js" rel="prefetch">
		<link href="<?php echo $theme_dir?>/js/chunk-da7953d2.257a8080.js" rel="prefetch">
		<link href="<?php echo $theme_dir?>/css/app.ea9e8330.css" rel="preload" as="style">
		<link href="<?php echo $theme_dir?>/css/chunk-element.83ddf129.css" rel="preload" as="style">
		<link href="<?php echo $theme_dir?>/css/chunk-vendors.bdc89dd8.css" rel="preload" as="style">
		<link href="<?php echo $theme_dir?>/js/app.7abec5b0.js" rel="preload" as="script">
		<link href="<?php echo $theme_dir?>/js/chunk-element.c08cd797.js" rel="preload" as="script">
		<link href="<?php echo $theme_dir?>/js/chunk-vendors.a169ca06.js" rel="preload" as="script">
		<link href="<?php echo $theme_dir?>/css/chunk-element.83ddf129.css" rel="stylesheet">
		<link href="<?php echo $theme_dir?>/css/chunk-vendors.bdc89dd8.css" rel="stylesheet">
		<link href="<?php echo $theme_dir?>/css/app.ea9e8330.css" rel="stylesheet">
	</head>
	<body>
		<noscript>
			<strong>We're sorry but huasen-portal doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
		</noscript>
		<div id="loading-id9527">
			<div class="loding-box">
				<h3>亮灯唤君来·君寻光而至</h3>
				<ul class="item-group">
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
				</ul>
			</div>
		</div>
		<div id="app"></div>
		<script src="<?php echo $theme_dir?>/js/chunk-element.c08cd797.js"></script>
		<script src="<?php echo $theme_dir?>/js/chunk-vendors.a169ca06.js"></script>
		<script src="<?php echo $theme_dir?>/js/app.7abec5b0.js"></script>
	</body>
</html>