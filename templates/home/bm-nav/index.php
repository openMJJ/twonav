<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo $site['keywords']?>"/>
    <meta name="description" content="<?php echo $site['description']?>">
    <title><?php echo $site['Title'];?></title>
<?php require ('const.php');?>
    <link rel="stylesheet" href="<?php echo $libs?>/Font-awesome/4.7.0/css/font-awesome.css">
    <script type="module" crossorigin src="<?php echo $theme_dir?>/assets/index.js?v=4.1.4"></script>
    <link rel="stylesheet" href="<?php echo $theme_dir?>/assets/index.css?v=4.1.4">
    <link rel="shortcut icon" href="<?php echo $favicon;?>">
    <?php 
        if(intval($theme_config['display_admin']) != 1){ echo "<style>.LM-admin {display:none;}</style>\n";}
        if(intval($theme_config['display_theme_version']) != 1){ echo "<style>.theme_version {display:none;}</style>\n";}
    ?>
    <?php echo $site['custom_header'].PHP_EOL?>
    <?php echo $global_config['global_header'].PHP_EOL?>
</head>
<body>
<div id="root"></div>
</body>
<footer>
    <?php echo $copyright.' | The theme author is <a target="_blank" href="https://gitee.com/robin901118/homepage_navigation" title="主题作者: 故时旅人">robin901118</a>'.PHP_EOL;?>
    <?php echo $ICP.PHP_EOL;?>
    <?php echo $site['custom_footer'].PHP_EOL;?>
    <?php echo $global_config['global_footer'].PHP_EOL;?>
</footer>
</html>
<!--主题来源:故时旅人(robin901118),适配者:落幕(lm21)-->

