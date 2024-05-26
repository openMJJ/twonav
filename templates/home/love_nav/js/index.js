// 配置与初始化
layui.config({ base: rootPath + '/js/' , version: version});
var posr_url = `./index.php?theme=love_nav&u=${u}`;
layui.use(['layer', 'miniAdmin'], function () {
    var layer = layui.layer,
        miniAdmin = layui.miniAdmin,
        options = { iniUrl: posr_url + '&api=menu' ,bgColorDefault: 0};

    // 读取本地缓存
    nav_data = JSON.parse(localStorage.getItem(u + "_nav_data")) || {} ;
    // 判断缓存是否可用
    if(theme_config.cache_time > 0 && Math.round(new Date() / 1000) < (parseInt(theme_config.cache_time) + nav_data.uptime)){
        miniAdmin.render(options);
        $('.layuimini-loader').remove();
        return;
    }
    // 请求数据
    $.post(posr_url +  "&api=data", function (r, status) {
        if (r.code == 1) {
            r.uptime = Math.round(new Date() / 1000);
            nav_data = r;
            let local_data = JSON.stringify(r);
            localStorage.setItem(u + "_nav_data",local_data);
            miniAdmin.render(options);
            $('.layuimini-loader').remove();
        } else {
            layer.alert("请求失败,请稍后重试..", {icon: 5, title: '错误', anim: 2, closeBtn: 0, btn: ['重试']}, function () {
                location.reload();
            });
        }
    }).fail(function () {
        layer.alert("请求异常,请稍后重试..", {icon: 5, title: '错误', anim: 2, closeBtn: 0, btn: ['重试']}, function () {
            location.reload();
        });
    });
});