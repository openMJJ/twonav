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
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">
<meta name="force-rendering" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
<meta name="applicable-device" content="pc,mobile">
<title><?php echo $link['title']; ?> - <?php echo $site['title']; ?></title>
<meta name="keywords" content="<?php echo $link['keywords']; ?>">
<meta name="description" content="<?php echo $link['description']; ?>">
<link rel="stylesheet" href="<?php echo $libs?>/Font-awesome/4.7.0/css/font-awesome.css">
<link rel="stylesheet" href="<?php echo $theme_dir?>/css/style.css?v=<?php echo $theme_ver; ?>">
<link rel="shortcut icon" href="<?php echo $favicon;?>">
<!--[if lt IE 9]><div class="fuck-ie"><p class="tips">*您的IE浏览器版本过低，为获得更好的体验请使用Chrome、Firefox或其他现代浏览器!</p></div><![endif]-->
<script src = "<?php echo $libs?>/jquery/jquery-2.2.4.min.js"></script>
</head>
<body>
<header class="header">
  <div class="h-fix">
    <div class="container">
      <h1 class="logo"> <a href="" title="<?php echo $site['description']; ?>"> <img id="light-logo" src="<?php echo $theme_config['logo'];?>" alt="<?php echo $site['description']; ?>" title="<?php echo $site['description']; ?>"/> <img id="dark-logo" src="<?php echo $theme_config['logo'];?>" alt="<?php echo $site['description']; ?>" title="<?php echo $site['description']; ?>"/> </a> </h1>
      <div id="m-btn" class="m-btn"><i class="fa fa-bars"></i></div>
      <div class="darkmode autoleft" title="日夜模式切换"> <a href="javascript:switchNightMode()" target="_self" class=""><i class="fa fa-moon-o"></i></a> </div>
      <nav class="nav-bar" id="nav-box" data-type="index" data-infoid="">
        <ul class="nav">
          <li><a href="./?u=<?php echo $u?>">首页</a></li>
          <li><a href="./?c=admin&u=<?php echo $u?>">管理</a></li>
          <li ><a href="#">分类</a>
            <ul class="sub-menu sub2">
<?php  foreach ($categorys_list as $category) { ?>
                <li data-id="category-<?php echo $category['id']; ?>"><a href="./?u=<?php echo U;?>&oc=<?php echo $category['id'];?>"><?php echo $category['name']; ?></a></li>
<?php } ?>
            </ul>
          </li>
          <?php echo $theme_config['navbar-link']; ?>
<?php if(is_guestbook()){ ?>
        <li><a href="./index.php?c=guestbook&u=<?php echo $u?>">在线留言</a></li>
<?php } ?>
        </ul>
      </nav>
<?php if (is_apply()) { ?> 
      <div class="submit fr"> <a href="./index.php?c=apply&u=<?php echo $u?>" target="_blank" class="a transition"><i class="fa fa-heart"></i>申请收录</a> </div>
<?php } ?> 
    </div>
  </div>
</header>

<div id="mask"></div>
<div class="breadnav">
  <div class="container bread"> <i class="fa fa-home"></i><a href="./?u=<?php echo U;?>">首页</a>>><a href="./?u=<?php echo U;?>&oc=<?php echo $link_category['cid'];?>"><?php echo $link_category['name']; ?></a> </div>
</div>
<p class="index-breadcrumb"></p>

<div class="container"> 
  <div class="part">
    <div class="bar clearfix">
      <h1 class="tt"> <?php echo $link['title']; ?> </h1>
      <div class="r-intro fr"> <span class="data fr"> <small class="info"><i class="fa fa-clock-o"></i><?php echo date('Y-m-d', $link['add_time']);?></small> <small class="info"><i class="fa fa-eye"></i><?php echo $link['click'];?></small> </span> </div>
    </div>
    <div class="items">
      <div class="row post-single">
        <div class="col-xs-12 col-sm-12 col-md-8">
          <div class="pic fl">
            <div class="blur blur-layer" style="background: transparent url(<?php echo $link['ico']; ?>) no-repeat center center;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;animation: rotate 20s linear infinite;"> </div>
            <img class="img-cover" src="<?php echo $link['ico']; ?>" alt="<?php echo $link['title']; ?>" title="<?php echo $link['title']; ?>"> </div>
          <div class="list">
            <p>站点名称：<?php echo $link['title']; ?></p>
            <p class="cate">所属分类：<a href="./?u=<?php echo U;?>&oc=<?php echo $link_category['cid'];?>" class="mcolor"><?php echo $link_category['name']; ?></a></p>
            <p class="site">官方网址：<?php echo $uri_part['host'] ?? '非HTTP(S)协议';?></p>
            <p class="seo">SEO查询： 
                <a rel="nofollow" class="" href="http://www.aizhan.com/cha/<?php echo $uri_part['host'];?>" target="_blank"><i class="fa fa-bar-chart"></i>爱站网</a> 
                <a rel="nofollow" class="pczz" href="http://seo.chinaz.com/<?php echo $uri_part['host'];?>" target="_blank"><i class="fa fa-bar-chart"></i>站长工具</a>
            </p>
            <a class="btn transition" target="_blank" href="<?php echo $link['url']; ?>" rel="nofollow">进入网站 <i class="fa fa-chevron-circle-right"></i></a> </div>
        </div>
      </div>
    </div>
  </div>
  <div class="part">
    <p class="tt"><span>站点介绍</span></p>
    <div class="items">
      <div class="art-main">
       <p><?php echo $link['description']; ?></p>
      </div>
    </div>
  </div>
  
  <div class="part related">
    <p class="tt"><span>相似站点</span></p>
    <div class="items">
      <div class="row">
      <div class="part" id="category-<?php echo $link_category['id']; ?>">
        <div class="items">
          <div class="row">
     <?php  foreach ($links as $link) {   $link['description'] = empty($link['description']) ? '作者很懒，没有填写描述。' : $link['description']; ?>
            <div class="col-xs-6 col-sm-4 col-md-3">
              <div class="item">
                  <a class="link" target="_blank" href="<?php echo $link['real_url']; ?>" rel="nofollow"><i class="autoleft fa fa-angle-right" title="直达网站"></i></a>
                  <a class="a" href="<?php echo $link['url']; ?>" target="_blank">
                      <img src="<?php echo $link['ico']; ?>">
                      <h3><?php echo $link['title']; ?></h3>
                      <p><?php echo $link['description']; ?></p>
                  </a>
              </div>
            </div>
    <?php } ?>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
  
</div>

<div class="footer-copyright ">
  <div class="container">
        <?php echo $copyright.PHP_EOL;?>
        <?php echo $ICP.PHP_EOL;?>
        <?php echo $site['custom_footer'].PHP_EOL;?>
        <?php echo $global_config['global_footer'].PHP_EOL;?>
  </div>
</div>
<div id="backtop" class="fa fa-angle-up autoleft" title="返回顶部"></div>
<script src="<?php echo $libs?>/jquery/jQueryCookie.js"></script>
<script src="<?php echo $libs?>/Other/holmes.js"></script>
<script src="<?php echo $theme_dir?>/js/main.js" type="text/javascript"></script> 
<!--[if lt IE 9]><script src="<?php echo $theme_dir?>/js/html5-css3.js"></script><![endif]-->
</body>
</html>