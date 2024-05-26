<?php 
//获取链接信息
$link['real_url'] = $link['url'];
$link['ico'] = geticourl($site['link_icon'],$link);
$link['description'] = empty($link['description']) ? '作者很懒，没有填写描述。' : $link['description'];
$uri_part = parse_url($link['url']);
//获取分类信息
$link_category = get_db('user_categorys','*',['uid'=>UID,'cid'=>$link['fid'],'status'=>1]);
//获取同分类下的链接
$where = [];
$where['uid'] = UID;
$where['fid'] = $link['fid'];
$where['status'] = 1;
$where['pid'] = 0;
$where['ORDER']['weight'] = 'ASC';
$where['ORDER']['lid'] = 'ASC';
$where['lid[!]'] = $link['lid'];
$where['LIMIT'] = [0, 8];
if(!is_login()){
    $where['property'] = 0;
}
$links = select_db('user_links','*',$where);
foreach ($links as &$link2) {
    $link2['real_url'] = $link2['url'];
    $link2['ico'] = geticourl($site['link_icon'],$link2);
    if($site['link_model'] != 'direct'){
        $link2['url'] = "./index.php?c=click&id={$link2['lid']}&u=".U;
    }
}

$categorys_list = get_category_list();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $link['title']; ?> - <?php echo $site['title']; ?></title>
    <meta name="keywords" content="<?php echo $site['keywords']; ?>">
    <meta name="description" content="<?php echo $site['description']; ?>">
	<link rel="shortcut icon" href="<?php echo $favicon;?>" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo $theme_dir?>/css/guodu.css">
	<script src="<?php echo $libs?>/jquery/jquery-3.6.0.min.js"></script>
	<?php echo $site['custom_header'].PHP_EOL?>
    <?php echo $global_config['global_header'].PHP_EOL?>
</head>

<body>
    <?php require 'header.php'; ?>
    <!-- 过渡页区 -->
    <div class="zhandianbox">
        <div class="zhandianbt">
            <h2><?php echo $link['title']; ?></h2>
            <div class="zdbox">
                <div class="zhandianlogo">
                    <img data-src="<?php echo $link['ico']; ?>" alt="">
                </div>
                <div class="zhandianyc">
                    <p>站点名称：<?php echo $link['title']; ?></p>
                    <p>所属分类：<?php echo $link_category['name']; ?></p>
                    <p>官方网址：<?php echo $uri_part['host'] ?? '非HTTP(S)协议';?></p>
                    <p> SEO查询：
                        <a href="https://www.itdog.cn/ping/<?php echo $uri_part['host'];?>">在线ping</a>
                        |
                        <a href="https://seo.chinaz.com/<?php echo $uri_part['host'];?>">权重查询</a>
                        |
                        <a href="https://icp.chinaz.com/<?php echo $uri_part['host'];?>">备案查询</a>
                        |
                        <a href="https://link.chinaz.com/<?php echo $uri_part['host'];?>">友链查询</a>
                    </p>
                    <p>
                        <a href="<?php echo $link['url']; ?>">进入网站 ></a>
                    </p>
                </div>
            </div>
        </div>
        <!-- 站点介绍 -->
        <div class="zdjsbox">
            <div class="zdjs">
                <h2>站点介绍</h2>
                <div class="zdjsms">
                    <p><?php echo $link['description']; ?></p>
                </div>
            </div>
        </div>
        <!-- 相关站点 -->
        <div class="xgzdbox">
            <div class="xgzd">
                <h2 id="xgzd">相关站点</h2>
                <div class="tabcontent">
                    <ul>
<?php  foreach ($links as $link) {   $link['description'] = empty($link['description']) ? '作者很懒，没有填写描述。' : $link['description']; ?>
                        <li>
                            <a href="<?php echo $link['url']; ?>" target="_blank">
                                <div class="tabcontentimg">
                                    <img data-src="<?php echo $link['ico']; ?>" alt="网站1">
                                </div>
                                <div class="tabcontentms">
                                    <h2><?php echo $link['title']; ?></h2>
                                    <p><?php echo $link['description']; ?></p>
                                </div>
                            </a>
                        </li>
<?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
	<script>
	    const u = '<?php echo $u;?>';var page = 'transit';
	    const theme_config = <?php echo json_encode($theme_config);?>;
	 </script>
	<script src="<?php echo $theme_dir?>/js/index.js?v=<?php echo $theme_ver; ?>"></script>
</body>

</html>