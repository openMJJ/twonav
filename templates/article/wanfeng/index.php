<?php 
// 挽风导航入口文件

if( !empty($c) && $c != 'index' ){
    if(!is_file('./templates/home/wanfeng/article.php')){
        exit('<h3>该模板依赖同名主页模板,请先下载安装同名主页模板后在使用!</h3>');
    }
    //主题配置(用户)
    $theme_config_db = get_db('user_config','v',['t'=>'theme_home','k'=>'wanfeng','uid'=>UID]);
    $theme_config_db = unserialize($theme_config_db);
    //合并配置数据
    $theme_config = empty($theme_config_db) ? $theme_config : array_merge ($theme_config,$theme_config_db);
}

//把留言和收录写入主题配置
$theme_config['is_guestbook'] = is_guestbook();
$theme_config['is_apply'] = is_apply();

//判断载入那个模板
if($c == 'article'){ 
    require 'article.php';
}elseif($c == 'click'){
    require 'transit.php';
}elseif($c == 'apply'){
    require 'apply.php';
}elseif($c == 'guestbook'){
    require 'guestbook.php';
}else{
    if($theme_config['wenzhang_nz'] == '1' && !empty($_GET['id'])){
        require 'article.php';
    }else{
        require 'home.php';
    }
}

