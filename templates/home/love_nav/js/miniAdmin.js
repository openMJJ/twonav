// layuimini 主体框架扩展
layui.define(["jquery", "miniMenu", "element","miniPage", "miniTheme"], function (exports) {
    var $ = layui.$,
        element = layui.element,
        layer = layui.layer,
        miniMenu = layui.miniMenu,
        miniTheme = layui.miniTheme,
        miniPage = layui.miniPage;

    var miniAdmin = {
        render: function (options) {
            options.iniUrl = options.iniUrl || null;
            options.clearUrl = options.clearUrl || null;
            options.renderPageVersion = options.renderPageVersion || false;
            options.bgColorDefault = options.bgColorDefault || 0;
            options.multiModule = options.multiModule || false;
            options.menuChildOpen = options.menuChildOpen || false;
            options.pageAnim = options.pageAnim || false;
            
            if (menu == null) {
                miniAdmin.error('暂无菜单信息');
                return;
            }
            
            miniAdmin.renderLogo(menu.logoInfo);
            miniAdmin.renderClear(options.clearUrl);
            miniAdmin.renderAnim(options.pageAnim);
            miniAdmin.listen({
                homeInfo:menu.homeInfo,
                multiModule: options.multiModule,
            });
            miniMenu.render({
                menuList: menu.menuInfo,
                multiModule: options.multiModule,
                menuChildOpen: options.menuChildOpen
            });
            miniPage.render({
                homeInfo:menu.homeInfo,
                menuList: menu.menuInfo,
                multiModule: options.multiModule,
                renderPageVersion: options.renderPageVersion,
                menuChildOpen: options.menuChildOpen,
                listenSwichCallback: function () {
                    miniAdmin.renderDevice();
                }
            });
            miniTheme.render({
                bgColorDefault: options.bgColorDefault,
                listen: true,
            });
        },

        // 初始化logo
        renderLogo: function (data) {
            var logo = theme_config.logo.length > 0 ? '<img src="' + theme_config.logo + '" alt="logo">' : '';
            var html = '<a href="javascript:;">' + logo + '<h1>' + data.title + '</h1></a>';
            $('.layuimini-logo').html(html);
        },

        // 初始化缓存地址
        renderClear: function (clearUrl) {
            $('.layuimini-clear').attr('data-href',clearUrl);
        },

        // 切换菜单动画
        renderAnim: function (anim) {
            if (anim) {
                $('#layuimini-bg-color').after('<style id="layuimini-page-anim">' +
                    '.layuimini-page-anim {-webkit-animation-name:layuimini-upbit;-webkit-animation-duration:.3s;-webkit-animation-fill-mode:both;}\n' +
                    '@keyframes layuimini-upbit {0% {transform:translate3d(0,30px,0);opacity:.3;}\n' +
                    '100% {transform:translate3d(0,0,0);opacity:1;}\n' +
                    '}\n' +
                    '</style>');
            }
        },

        // 进入全屏
        fullScreen: function () {
            var el = document.documentElement;
            var rfs = el.requestFullScreen || el.webkitRequestFullScreen;
            if (typeof rfs != "undefined" && rfs) {
                rfs.call(el);
            } else if (typeof window.ActiveXObject != "undefined") {
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript != null) {
                    wscript.SendKeys("{F11}");
                }
            } else if (el.msRequestFullscreen) {
                el.msRequestFullscreen();
            } else if (el.oRequestFullscreen) {
                el.oRequestFullscreen();
            } else if (el.webkitRequestFullscreen) {
                el.webkitRequestFullscreen();
            } else if (el.mozRequestFullScreen) {
                el.mozRequestFullScreen();
            } else {
                miniAdmin.error('浏览器不支持全屏调用！');
            }
        },

        // 退出全屏
        exitFullScreen: function () {
            var el = document;
            var cfs = el.cancelFullScreen || el.webkitCancelFullScreen || el.exitFullScreen;
            if (typeof cfs != "undefined" && cfs) {
                cfs.call(el);
            } else if (typeof window.ActiveXObject != "undefined") {
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript != null) {
                    wscript.SendKeys("{F11}");
                }
            } else if (el.msExitFullscreen) {
                el.msExitFullscreen();
            } else if (el.oRequestFullscreen) {
                el.oCancelFullScreen();
            }else if (el.mozCancelFullScreen) {
                el.mozCancelFullScreen();
            } else if (el.webkitCancelFullScreen) {
                el.webkitCancelFullScreen();
            } else {
                miniAdmin.error('浏览器不支持全屏调用！');
            }
        },

        // 初始化设备端
        renderDevice: function () {
            if (miniAdmin.checkMobile()) {
                $('.layuimini-tool i').attr('data-side-fold', 1);
                $('.layuimini-tool i').attr('class', 'fa fa-outdent');
                $('.layui-layout-body').removeClass('layuimini-mini');
                $('.layui-layout-body').addClass('layuimini-all');
            }
        },

        // 成功
        success: function (title) {
            return layer.msg(title, {icon: 1, shade: this.shade, scrollbar: false, time: 2000, shadeClose: true});
        },

        // 失败
        error: function (title) {
            return layer.msg(title, {icon: 2, shade: this.shade, scrollbar: false, time: 3000, shadeClose: true});
        },

        // 判断是否为手机
        checkMobile: function () {
            var ua = navigator.userAgent.toLocaleLowerCase();
            var pf = navigator.platform.toLocaleLowerCase();
            var isAndroid = (/android/i).test(ua) || ((/iPhone|iPod|iPad/i).test(ua) && (/linux/i).test(pf))
                || (/ucweb.*linux/i.test(ua));
            var isIOS = (/iPhone|iPod|iPad/i).test(ua) && !isAndroid;
            var isWinPhone = (/Windows Phone|ZuneWP7/i).test(ua);
            var clientWidth = document.documentElement.clientWidth;
            if (!isAndroid && !isIOS && !isWinPhone && clientWidth > 1024) {
                return false;
            } else {
                return true;
            }
        },

        // 监听
        listen: function (options) {
            options.homeInfo = options.homeInfo || {};

            // 刷新
            $('body').on('click', '[data-refresh]', function () {
                localStorage.removeItem(u + "_nav_data");//删除缓存
                location.reload();
            });

            // 监听提示信息
            $("body").on("mouseenter", ".layui-nav-tree .menu-li", function () {
                if (miniAdmin.checkMobile()) {
                    return false;
                }
                var classInfo = $(this).attr('class'),
                    tips = $(this).prop("innerHTML"),
                    isShow = $('.layuimini-tool i').attr('data-side-fold');
                if (isShow == 0 && tips) {
                    tips = "<ul class='layuimini-menu-left-zoom layui-nav layui-nav-tree layui-this'><li class='layui-nav-item layui-nav-itemed'>"+tips+"</li></ul>" ;
                    window.openTips = layer.tips(tips, $(this), {
                        tips: [2, '#2f4056'],
                        time: 300000,
                        skin:"popup-tips",
                        success:function (el) {
                            var left = $(el).position().left - 10 ;
                            $(el).css({ left:left });
                            element.render();
                        }
                    });
                }
            });

            $("body").on("mouseleave", ".popup-tips", function () {
                if (miniAdmin.checkMobile()) {
                    return false;
                }
                var isShow = $('.layuimini-tool i').attr('data-side-fold');
                if (isShow == 0) {
                    try {
                        layer.close(window.openTips);
                    } catch (e) {
                        console.log(e.message);
                    }
                }
            });

            // 全屏
            $('body').on('click', '[data-check-screen]', function () {
                var check = $(this).attr('data-check-screen');
                if (check == 'full') {
                    miniAdmin.fullScreen();
                    $(this).attr('data-check-screen', 'exit');
                    $(this).html('<i class="fa fa-compress"></i>');
                } else {
                    miniAdmin.exitFullScreen();
                    $(this).attr('data-check-screen', 'full');
                    $(this).html('<i class="fa fa-arrows-alt"></i>');
                }
            });

            // 点击遮罩层
            $('body').on('click', '.layuimini-make', function () {
                miniAdmin.renderDevice();
            });
        }
    };
    exports("miniAdmin", miniAdmin);
});
