<?php 
$site['max_link'] = 0; //阻止限制链接数量
if(!empty($_GET['api'])) require 'api.php';
    $info1 = [];
    $info1['title'] = '导航';
    $info1['icon'] = 'fa fa-address-book';
    $info1['href'] = '';
    $info1['target'] = '_self';
    foreach ($category_parent as $category) {
        $info1['child'][] = ['title'=>$category['name'],'href'=>$category['id'],'icon'=>$category['font_icon'],'target'=>'_self'];
    }
    $init = array( 'homeInfo'=>['title'=>'导航','href'=>(empty($info1['child']) ? 0 : $info1['child'][0]['href'])],'logoInfo'=>['title'=>$site['logo']],'menuInfo'=>$info1['child']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $site['Title'];?></title>
    <meta name="keywords" content="<?php echo $site['keywords']; ?>">
    <meta name="description" content="<?php echo $site['description']; ?>">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="<?php echo $favicon;?>">
    <link rel="stylesheet" href="<?php echo $layui['css'];?>" media="all">
    <link rel="stylesheet" href="<?php echo $libs?>/Font-awesome/4.7.0/css/font-awesome.css" media="all">
    <link rel="stylesheet" href="<?php echo $theme_dir?>/css/layuimini.css?v=2.0.1" media="all">
    <style id="layuimini-bg-color"></style>
    <style id="custom_css"></style>
    <style>

</style>
</head>
<body class="layui-layout-body layuimini-all">

    
<div class="layui-layout layui-layout-admin">
    <!--初始化加载层-->
    <div class="layuimini-loader"><div class="layuimini-loader-inner"></div></div>
    
    <div class="layui-header header">
        <div class="layui-logo layuimini-logo layuimini-back-home"></div>

        <div class="layuimini-header-content">
            
            <div class="layuimini-tool">
                <li class="layui-nav-item">
                    <i title="展开" class="fa fa-outdent" data-side-fold="1"></i>
                </li>
            </div>

            <ul class="layui-nav layui-layout-right">
                
                <li class="layui-nav-item mobile layui-hide-xs" lay-unselect style="width: 185px!important;">
                    <input type="text" class="search-input"  placeholder="关键字搜索" required style="padding: 5px; border: 1px solid #ccc;">
                </li>
                
                <li class="layui-nav-item" lay-unselect style="">
                    <a href="javascript:linkSearch();" title="书签搜索"><i class="fa fa-search" style="col2or: rgb(191 187 187);"></i></a>
                </li>
                
                <li class="layui-nav-item" lay-unselect>
                    <a href="./index.php?c=admin&u=<?php echo $u?>" title="系统管理"><i class="fa fa-user"></i></a>
                </li>
                <li class="layui-nav-item" lay-unselect>
                    <a href="javascript:;" data-refresh="刷新" title="刷新"><i class="fa fa-refresh"></i></a>
                </li>
                <li class="layui-nav-item mobile layui-hide-xs" lay-unselect>
                    <a href="javascript:;" data-check-screen="full" title="全屏模式"><i class="fa fa-arrows-alt"></i></a>
                </li>
                <li class="layui-nav-item layuimini-select-bgcolor" lay-unselect>
                    <a href="javascript:;" data-bgcolor="配色方案" title="配色方案"><i class="fa fa-magic"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <!--左侧菜单-->
    <div class="layui-side layui-bg-black layuimini-menu-left"></div>
    <!--手机端遮罩层-->
    <div class="layuimini-make"></div>
    <!-- 移动导航 -->
    <div class="layuimini-site-mobile"><i class="layui-icon"></i></div>
    <!--返回顶部-->
    <div class="layuimini-site-top" style="cursor:pointer;"><i class="layui-icon layui-icon-top layui-fixbar-top" style="font-size: 30px;"></i></div>
    <!--主体内容-->
    <div class="layui-body">
        <!--顶部二级分类-->
        <div class="layuimini-page-header">
            <div style="padding-left: 10px;">
                <div class="layui-btn-container" id="sub_category" style="float:left; padding-top: 5px;">
                    <button type="button" class="layui-btn layui-btn-primary layui-btn-sm">正在加载中...</button>
                </div>
                <div id="shrink" style="float:right;cursor:pointer;padding-right: 15px;padding-top: 5px;font-size: 1.5em;"><i class="fa fa fa-angle-double-down"></i></div>
            </div>
        </div>
        <!--子页内容-->
        <div class="layuimini-content-page"></div>
        <footer class="footer"><?php 
            echo empty($copyright)?'':$copyright;
            echo empty($ICP)?'':' | '.$ICP;
            echo empty($site['custom_footer'])?'':' | '.$site['custom_footer'];
            echo empty($global_config['global_footer'])?'':' | '.$global_config['global_footer'];
            ?>
        </footer>
        
    </div>
</div>
<script src="<?php echo $libs?>/jquery/jquery-3.6.0.min.js"></script>
<script src="<?php echo $layui['js'];?>" charset="utf-8"></script>

<script>
var u = '<?php echo $u?>',nav_data,rootPath = '<?php echo $theme_dir?>',
    theme_config = <?php echo json_encode($theme_config)?>,
    menu = <?php echo json_encode($init)?>,
    version = "<?php echo $Ver;?>";
</script>
<script src="<?php echo $theme_dir?>/js/index.js?v=<?php echo $theme_ver; ?>" charset="utf-8"></script>
</body>
</html>
