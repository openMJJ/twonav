//是否移除底部版权
if(theme_config.footer == 'hide'){
    $(".footer").remove();
    $(".layuimini-content-page").css("height", "100%");
}
//链接卡片样式模板 style="width:250px;"
var card_class = theme_config.card_width == '1' ? 'layui-col-xs6 layui-col-sm4 layui-col-md3 layui-col-xl2' : 'layui-col-xs6 layui-col-sm3 layui-col-md2 layui-col-xl1';
var link_card_html = 
    `<div class="${card_class}">
      <div class="layui-card link">
       <a href="#url" target="_blank">
         <div class="link_title">
          <div class="layui-card-header link lines1"><img class="link_icon" src="#ico" alt="ico">#title</div>
         </div>
         <div class="layui-card-body lines2">#description</div>
       </a>
      </div>
    </div>`;
//单标题
if(theme_config.link_description == 0){
    link_card_html = link_card_html.replace(/\s+<div class="layui-card-body lines2">#description<\/div>/, '');
}
//标题+描述1
if(theme_config.link_description == 1){
    link_card_html = link_card_html.replace(/lines2/, 'lines1');
}

layui.define(["element", "jquery"], function (exports) {
    var element = layui.element,
        $ = layui.$,layer = layui.layer;
    
    
    // 获取相关的 jQuery 对象
    const $panel = $('.layui-panel');
    const $expandBtn = $('#expand-btn');

    // 设置初始高度
    let panelHeight = $panel.height();

    // 点击展开/收起按钮时切换高度
    $expandBtn.on('click', function() {
        if (panelHeight === 75) {
            // 展开
            $panel.animate({ height: 'auto' }, 300);
            panelHeight = $panel.height();
        } else {
            // 收起
            $panel.animate({ height: '75px' }, 300);
            panelHeight = 75;
        }
    });

    //标题+描述1 默认的,不用改
    function renderPage(href) {
        var container = '.layuimini-content-page';
        $(container).html('');
        //根据请求href来读取对应数据
        $("#sub_category").html('');
        sub_data = [];
        nav_data.data.forEach(function(item) {
            if(item.id == href){
                sub_data = [...item.sub_category];
                if(item.links.length > 0 || item.sub_category.length == 0){
                    sub_data.unshift({'id':item.id,'name':item.name,'font_icon':item.font_icon,'parent':true,'links':item.links});
                }
            }
        });
        
        //渲染分类按钮
        sub_data.forEach(function(item) {
            if(item.links.length == 0){
                return;
            }
            //渲染分类按钮
            var newButton = $("<button></button>")
            .html(`<i class="${item.font_icon}"></i> ` + item.name)
            .attr("type", "button")
            .attr("data-id",item.id)
            .addClass("layui-btn layui-btn-primary layui-btn-sm");
            if(item.parent == true){
                newButton.attr("style",'margin-right: 20px;');
            }
            $("#sub_category").append(newButton);
            
            //生成链接卡片HTML
            $links_html = '';
            
            item.links.forEach(function(link) {
                // 默认描述
                if(typeof link.description !== 'undefined'){
                    link.description = link.description.length == 0 ? "作者很懒，没有填写描述。":link.description; 
                }
                // 模板代码
                let originalText = link_card_html;
                // 使用正则表达式进行替换
                for (const [search, replace] of Object.entries(link)) {
                  const regex = new RegExp('#' + search, 'g');
                  originalText = originalText.replace(regex, replace);
                }
                $links_html += originalText;
            });

            
            //渲染分类卡片
            var card = $("<div>").addClass("layui-card").attr("id", "card_" + item.id);
            var cardHeader = $("<div>").addClass("layui-card-header").html('<i class="' + item.font_icon + '"></i> ' + item.name);
            var cardBody = $("<div>").addClass("layui-card-body").attr("id", "category_" + item.id).html('<div class="layui-row layui-col-space15">'+$links_html+'</div>');
            card.append(cardHeader);
            card.append(cardBody);
            $(container).append(card);
        });
        $('#sub_category').find("button").eq(0).addClass("active"); //点亮第一个分类按钮
        $(container).animate({scrollTop: 0}, 0); //回到顶部
        element.init();
    }
    
    $("#shrink").click(function() {
        const icon = $(this).find("i");
        if (icon.hasClass("fa-angle-double-down")) {
            icon.removeClass("fa-angle-double-down").addClass("fa-angle-double-up");
            $("#sub_category").css('display','inline');
            
        } else {
            $("#sub_category").css('display','flex');
            icon.removeClass("fa-angle-double-up").addClass("fa-angle-double-down");
        }
    });
    
    //分类按钮点击事件
    $('body').on('click', '#sub_category button', function () {
        $("#sub_category button").removeClass("active"); // 移除所有按钮的 "active" 类
        $(this).addClass("active"); // 为当前点击的按钮添加 "active" 类
        let content = '.layuimini-content-page';
        let id = '#card_' + $(this).data("id"); // 构建对应ID的字符串
        
        $('.layuimini-content-page .layui-card').removeClass("active");
        $(id).addClass("active");
        
        let contentHeight = $(content).prop('scrollHeight'); // 获取内容区域的滚动高度
        let target = $(id)[0]; // 获取具有对应ID的元素
        let targetTop = target.offsetTop - $('.layuimini-page-header').outerHeight() - 7; // 获取目标元素顶部 - header高度

        //console.log( targetTop);
        if(contentHeight > targetTop){
            $(content).animate({scrollTop: targetTop}, 188);
        }else{
            $(content).animate({scrollTop: contentHeight}, 188);
        }
    });
    

    var miniPage = {
        //初始化tab
        render: function (options) {
            options.homeInfo = options.homeInfo || {};
            options.menuList = options.menuList || [];
            options.multiModule = options.multiModule || false;
            options.renderPageVersion = options.renderPageVersion || false;
            options.listenSwichCallback = options.listenSwichCallback || function () {
            };
            var href = location.hash.replace(/^#\//, '');
            if (href === null || href === undefined || href === '') {
                miniPage.renderHome(options);
            } else {
                miniPage.renderPage(href, options);
                if (options.multiModule) {
                    miniPage.listenSwitchMultiModule(href);
                } else {
                    miniPage.listenSwitchSingleModule(href);
                }
            }
            miniPage.listen(options);
            miniPage.listenHash(options);
        },

        // 初始化主页
        renderHome: function (options) {
            options.homeInfo = options.homeInfo || {};
            options.homeInfo.href = options.homeInfo.href || '';
            options.renderPageVersion = options.renderPageVersion || false;
            miniPage.renderPageContent(options.homeInfo.href, options);
            $(`a[layuimini-href='${options.homeInfo.href}']`).parent().addClass("layui-this");
        },

        //初始化页面
        renderPage: function (href, options) {
            miniPage.renderPageTitle(href, options);
            miniPage.renderPageContent(href, options);
        },

        //初始化页面标题
        renderPageTitle: function (href, options) {
            options.homeInfo = options.homeInfo || {};
            options.homeInfo.title = options.homeInfo.title || '主页';
            options.menuList = options.menuList || [];
            //$('.layuimini-page-header').removeClass('layui-hide');
            var pageTitleHtml = '<a lay-href="" href="javascript:;" class="layuimini-back-home">' + options.homeInfo.title + '</a><span lay-separator="">/</span>\n';
            var pageTitleArray = miniPage.buildPageTitleArray(href, options.menuList);
            if (pageTitleArray.length > 0) {
                for (var key in pageTitleArray) {
                    key = parseInt(key);
                    if (key !== pageTitleArray.length - 1) {
                        pageTitleHtml += '<a><cite>' + pageTitleArray[key] + '</cite></a><span lay-separator="">/</span>\n';
                    } else {
                        pageTitleHtml += '<a><cite>' + pageTitleArray[key] + '</cite></a>\n';
                    }
                }
            } else {
                var title = sessionStorage.getItem('layuimini_page_title');
                if (title === null || title === undefined || title === '') {
                    //$('.layuimini-page-header').addClass('layui-hide');
                } else {
                    pageTitleHtml += '<a><cite>' + title + '</cite></a>\n';
                }
            }
            $('.layuimini-page-header .layuimini-page-title').empty().html(pageTitleHtml);
        },

        //初始化页面内容
        renderPageContent: function (href, options) {
            renderPage(href);
        },

        //刷新页面内容
        refresh: function (options) {
            var href = location.hash.replace(/^#\//, '');
            if (href === null || href === undefined || href === '') {
                miniPage.renderHome(options);
            } else {
                miniPage.renderPageContent(href, options);
            }
        },

        //构建页面标题数组
        buildPageTitleArray: function (href, menuList) {
            var array = [],
                newArray = [];
            for (key in menuList) {
                var item = menuList[key];
                if (item.href === href) {
                    array.push(item.title);
                    break;
                }
                if (item.child) {
                    newArray = miniPage.buildPageTitleArray(href, item.child);
                    if (newArray.length > 0) {
                        newArray.unshift(item.title);
                        array = array.concat(newArray);
                        break;
                    }
                }
            }
            return array;
        },

        //获取指定链接内容
        getHrefContent: function (href) {
            var content = '';
            var v = new Date().getTime();
            $.ajax({
                url: href.indexOf("?") > -1 ? href + '&v=' + v : href + '?v=' + v,
                type: 'get',
                dataType: 'html',
                async: false,
                success: function (data) {
                    content = data;
                },
                error: function (xhr, textstatus, thrown) {
                    return layer.msg('Status:' + xhr.status + '，' + xhr.statusText + '，请稍后再试！');
                }
            });
            return content;
        },

        //获取弹出层的宽高
        getOpenWidthHeight: function () {
            var clienWidth = $(".layuimini-content-page").width();
            var clientHeight = $(".layuimini-content-page").height();
            var offsetLeft = $(".layuimini-content-page").offset().left;
            var offsetTop = $(".layuimini-content-page").offset().top;
            return [clienWidth, clientHeight, offsetTop, offsetLeft];
        },

        //单模块切换
        listenSwitchSingleModule: function (tabId) {
            $("[layuimini-href]").each(function () {
                if ($(this).attr("layuimini-href") === tabId) {
                    // 自动展开菜单栏
                    var addMenuClass = function ($element, type) {
                        if (type === 1) {
                            $element.addClass('layui-this');
                            if ($element.hasClass('layui-nav-item') && $element.hasClass('layui-this')) {
                                $(".layuimini-header-menu li").attr('class', 'layui-nav-item');
                            } else {
                                addMenuClass($element.parent().parent(), 2);
                            }
                        } else {
                            $element.addClass('layui-nav-itemed');
                            if ($element.hasClass('layui-nav-item') && $element.hasClass('layui-nav-itemed')) {
                                $(".layuimini-header-menu li").attr('class', 'layui-nav-item');
                            } else {
                                addMenuClass($element.parent().parent(), 2);
                            }
                        }
                    };
                    addMenuClass($(this).parent(), 1);
                    return false;
                }
            });
        },

        /**
         * 多模块切换
         * @param tabId
         */
        listenSwitchMultiModule: function (tabId) {
            $("[layuimini-href]").each(function () {
                if ($(this).attr("layuimini-href") === tabId) {

                    // 自动展开菜单栏
                    var addMenuClass = function ($element, type) {
                        if (type === 1) {
                            $element.addClass('layui-this');
                            if ($element.hasClass('layui-nav-item') && $element.hasClass('layui-this')) {
                                var moduleId = $element.parent().attr('id');
                                $(".layuimini-header-menu li").attr('class', 'layui-nav-item');
                                $("#" + moduleId + "HeaderId").addClass("layui-this");
                                $(".layuimini-menu-left .layui-nav.layui-nav-tree").attr('class', 'layui-nav layui-nav-tree');
                                $("#" + moduleId).attr('class', 'layui-nav layui-nav-tree layui-this');
                            } else {
                                addMenuClass($element.parent().parent(), 2);
                            }
                        } else {
                            $element.addClass('layui-nav-itemed');
                            if ($element.hasClass('layui-nav-item') && $element.hasClass('layui-nav-itemed')) {
                                var moduleId = $element.parent().attr('id');
                                $(".layuimini-header-menu li").attr('class', 'layui-nav-item');
                                $("#" + moduleId + "HeaderId").addClass("layui-this");
                                $(".layuimini-menu-left .layui-nav.layui-nav-tree").attr('class', 'layui-nav layui-nav-tree');
                                $("#" + moduleId).attr('class', 'layui-nav layui-nav-tree layui-this');
                            } else {
                                addMenuClass($element.parent().parent(), 2);
                            }
                        }
                    };
                    addMenuClass($(this).parent(), 1);
                    return false;
                }
            });
        },

        /**
         * 修改hash地址定位
         * @param href
         */
        hashChange: function (href) {
            window.location.hash = "/" + href;
        },

        /**
         * 修改hash地址为主页
         */
        hashHome: function () {
            window.location.hash = "/";
        },

        /**
         * 监听
         * @param options
         */
        listen: function (options) {

            /**
             * 打开新窗口
             */
            $('body').on('click', '[layuimini-href]', function () {
                var loading = layer.load(0, {shade: false, time: 2 * 1000});
                var href = $(this).attr('layuimini-href'),
                    target = $(this).attr('target');
                if(!href) return  ;
                var me = this ;
                var el = $("[layuimini-href='"+href+"']",".layuimini-menu-left") ;
                layer.close(window.openTips);
                if(el.length){
                    $(el).closest(".layui-nav-tree").find(".layui-this").removeClass("layui-this");
                    $(el).parent().addClass("layui-this");
                }
                if (target === '_blank') {
                    layer.close(loading);
                    window.open(href, "_blank");
                    return false;
                }
                miniPage.hashChange(href);
                $('.layuimini-menu-left').attr('layuimini-page-add', 'yes');
                layer.close(loading);
            });

            /**
             * 在子页面上打开新窗口
             */
            $('body').on('click', '[layuimini-content-href]', function () {
                var loading = parent.layer.load(0, {shade: false, time: 2 * 1000});
                var href = $(this).attr('layuimini-content-href'),
                    title = $(this).attr('data-title'),
                    target = $(this).attr('target');
                if(!href) return  ;
                var me = this ;
                var el = $("[layuimini-href='"+href+"']",".layuimini-menu-left") ;
                layer.close(window.openTips);
                if(el.length){
                    $(el).closest(".layui-nav-tree").find(".layui-this").removeClass("layui-this");
                    $(el).parent().addClass("layui-this");
                }
                if (target === '_blank') {
                    parent.layer.close(loading);
                    window.open(href, "_blank");
                    return false;
                }
                sessionStorage.setItem('layuimini_page_title', title);
                miniPage.hashChange(href);
                parent.layer.close(loading);
            });

            /**
             * 返回主页
             */
            $('body').on('click', '.layuimini-back-home', function () {
                //miniPage.hashHome();
            });


        },


        /**
         * 监听hash变化
         * @returns {boolean}
         */
        listenHash: function (options) {
            options.homeInfo = options.homeInfo || {};
            options.multiModule = options.multiModule || false;
            options.listenSwichCallback = options.listenSwichCallback || function () {
            };
            window.onhashchange = function () {
                var href = location.hash.replace(/^#\//, '');
                if (typeof options.listenSwichCallback === 'function') {
                    options.listenSwichCallback();
                }
                if (href === null || href === undefined || href === '') {
                    $("[layuimini-href]").parent().removeClass('layui-this');
                    miniPage.renderHome(options);
                } else {
                    miniPage.renderPage(href, options);
                }
                if ($('.layuimini-menu-left').attr('layuimini-page-add') === 'yes') {
                    $('.layuimini-menu-left').attr('layuimini-page-add', 'no');
                } else {
                    // 从页面中打开的话，浏览器前进后退、需要重新定位菜单焦点
                    $("[layuimini-href]").parent().removeClass('layui-this');
                    if (options.multiModule) {
                        miniPage.listenSwitchMultiModule(href);
                    } else {
                        miniPage.listenSwitchSingleModule(href);
                    }
                }
            };
        },


    };

    exports("miniPage", miniPage);
});

// 自定义卡片间距
$('#custom_css').append(`.layui-panel, .layui-card {margin: ${theme_config.card_spac}px !important;}`);
// 缩小卡片额外自适应
if(theme_config.card_width == '0'){
    $('#custom_css').append(`@media screen and (min-width: 1900px) { .layui-col-xl2 {width: 11.11%;} } @media screen and (min-width: 2500px) { .layui-col-xl2 {width: 10.00%;} }`);
}

// //添加背景和透明(未开放)
// $('#custom_css').append(`
// .layuimini-content-page {
//     background-image: url('./templates/home/quality/img/background.jpg'); /* 替换为您的背景图像的URL */
//     background-size: cover; /* 调整背景图像大小以覆盖整个元素 */
//     background-repeat: no-repeat; /* 防止背景图像重复显示 */
//     background-position: center center; /* 将背景图像定位在元素中心 */
// }
// .layui-card {
//     background: rgba(255, 255, 255, 0.1); /* 背景颜色，带有透明度 */
//     backdrop-filter: blur(10px); /* 模糊效果，可根据需要调整模糊程度 */
//     border: none; /* 可根据需要调整边框样式 */
// }
// .layuimini-content-page .layui-card-header,.layui-card-body {
//     color: #fff;
// }

// `);

// 是否加载和风天气
if (theme_config.weather == 1) {
    WIDGET = {
      "CONFIG": {
        "modules": "02",
        "background": "1",
        "tmpColor": "FFFFFF",
        "tmpSize": "16",
        "cityColor": "FFFFFF",
        "citySize": "16",
        "aqiColor": "FFFFFF",
        "aqiSize": "16",
        "weatherIconSize": "24",
        "alertIconSize": "18",
        "padding": "10px 10px 10px 10px",
        "shadow": "1",
        "language": "auto",
        "borderRadius": "4",
        "fixed": "false",
        "vertical": "center",
        "horizontal": "center",
        "key": "67d029a58c5d4b0a8738d645ab1b2ff3"
      }
    };
    $('.layuimini-tool').append('<li class="layui-nav-item" style="width: 40px; padding-top: 8px;padding-left: 15px;"><div id="he-plugin-simple"></div></li>');
    $.getScript("https://widget.qweather.net/simple/static/js/he-simple-common.js?v=2.0");
}
//返回顶部
var debounceTimer;
$('.layuimini-content-page').scroll(function() {
  clearTimeout(debounceTimer);
  debounceTimer = setTimeout(function() {
    var scrollPos = $('.layuimini-content-page').scrollTop();
    if (scrollPos > 100) {
      $('.layuimini-site-top').fadeIn();
    } else {
      $('.layuimini-site-top').fadeOut();
    }
  }, 100);
});
$(".layuimini-site-top").on("click", function() {
    $(".layuimini-content-page").animate({scrollTop: 0}, 188);
});
  
// 监听搜索输入回车
$('.search-input').keypress(function(event) {
    if (event.keyCode === 13 && event.target.value != '') {
        linkSearch();
    }
});

$(".search-input").on("input", function() {
    if($(this).val().length === 0){
        $("#Search_result").remove();
        $(".search-input").val('');
        $(".search-input").parent().addClass('layui-hide-xs');
        $("#he-plugin-simple").show();
    }
});
// 执行链接搜索
var Search_index = [];
function linkSearch() {
    //输入框不可见时
    if($(".search-input").is(":visible") === false){
        $(".search-input").parent().removeClass('layui-hide-xs');
        $("#he-plugin-simple").hide();
        $(".search-input").focus();
        return false;
    }
    $(".search-input").focus();
    var keyword = $('.search-input').val();
    if(keyword == ''){
        return false;
    }
    if(Search_index.length  === 0){
        GenerateIndex();
    }
    let threshold = theme_config.fuse_threshold >= 1 && theme_config.fuse_threshold <= 100 ? parseInt(theme_config.fuse_threshold) : 30;
    threshold = threshold == 100 ? threshold : threshold / 100 ;
    // 创建Fuse实例
    var options = {
        keys: ['title', 'description'], // 在哪些字段中搜索
        threshold: threshold, // 阈值用于匹配程度，根据需求调整
    };
    var fuse = new Fuse(Search_index, options);
    var searchMatches = fuse.search(keyword);
    $("#Search_result").remove();
    if($('#Search_result').length === 0){
        $(".layuimini-content-page").prepend(`<div class="layui-card" id="Search_result">
            <div class="layui-card-header"><i class="fa fa-search"></i> 站内搜索 <i class="fa fa-close" id="close_Search_result" style="padding-left: 10px;color: #f00;font-size: 1.3em;"></i></div>
                <div class="layui-card-body" >
                <div class="layui-row layui-col-space15" id="Search_result_body"></div>
            </div>
          </div>`);// before 
    }
    $links_html = '';
    if(searchMatches.length > 0){
        $(".layuimini-content-page").animate({scrollTop: 0}, 188);
        $('#Search_result_body').html('');
        $('#Search_result .layui-card-header').html(`
        <i class="fa fa-search"></i> 找到 ${searchMatches.length} 个结果 
        <i class="fa fa-close" id="close_Search_result" style="padding-left: 10px;color: #f00;font-size: 1.3em;"></i>`);
        //遍历搜索结果
        searchMatches.forEach(function(d) {
            if(typeof d.item.description !== 'undefined'){
                d.item.description = d.item.description.length == 0 ? "作者很懒，没有填写描述。":d.item.description; 
            }
            let originalText = link_card_html;
            for (const [search, replace] of Object.entries(d.item)) {
              const regex = new RegExp('#' + search, 'g');
              originalText = originalText.replace(regex, replace);
            }
            $links_html += originalText;
        });
        //将结果插入页面
        $('#Search_result_body').append($links_html);
    }else{
        //提示未搜索到匹配结果
        $('#Search_result_body').html('<br /><h3 style=" padding-left: 20px; ">未搜索到匹配结果</h3><br />');
    }
    //关闭搜索结果
    $("#close_Search_result").on("click", function() {
        $("#Search_result").remove();
        $(".search-input").val('');
        $(".search-input").parent().addClass('layui-hide-xs');
        $("#he-plugin-simple").show();
    });
}



//创建索引数据
function GenerateIndex() {
    console.log('初次搜索创建索引');
    nav_data.data.forEach(function(item) {
        //父分类下的链接
        if (item.links.length > 0) {
            Search_index.push(...item.links); 
        }
        //遍历子分类
        item.sub_category.forEach(function(sub_item) {
            if (sub_item.links.length > 0) {
                Search_index.push(...sub_item.links);
            }
        });
    });
    //console.log(Search_index);
}



/**
 * Fuse.js v6.6.2 - Lightweight fuzzy-search (http://fusejs.io)
 *
 * Copyright (c) 2022 Kiro Risk (http://kiro.me)
 * All Rights Reserved. Apache Software License 2.0
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 */
var e,t;e=this,t=function(){"use strict";function e(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function t(t){for(var n=1;n<arguments.length;n++){var r=null!=arguments[n]?arguments[n]:{};n%2?e(Object(r),!0).forEach((function(e){c(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):e(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function n(e){return n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},n(e)}function r(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function i(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}function o(e,t,n){return t&&i(e.prototype,t),n&&i(e,n),Object.defineProperty(e,"prototype",{writable:!1}),e}function c(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function a(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");Object.defineProperty(e,"prototype",{value:Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),writable:!1}),t&&u(e,t)}function s(e){return s=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)},s(e)}function u(e,t){return u=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e},u(e,t)}function h(e,t){if(t&&("object"==typeof t||"function"==typeof t))return t;if(void 0!==t)throw new TypeError("Derived constructors may only return object or undefined");return function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}(e)}function l(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,r=s(e);if(t){var i=s(this).constructor;n=Reflect.construct(r,arguments,i)}else n=r.apply(this,arguments);return h(this,n)}}function f(e){return function(e){if(Array.isArray(e))return d(e)}(e)||function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}(e)||function(e,t){if(e){if("string"==typeof e)return d(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?d(e,t):void 0}}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function d(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}function v(e){return Array.isArray?Array.isArray(e):"[object Array]"===b(e)}function g(e){return"string"==typeof e}function y(e){return"number"==typeof e}function p(e){return!0===e||!1===e||function(e){return m(e)&&null!==e}(e)&&"[object Boolean]"==b(e)}function m(e){return"object"===n(e)}function k(e){return null!=e}function M(e){return!e.trim().length}function b(e){return null==e?void 0===e?"[object Undefined]":"[object Null]":Object.prototype.toString.call(e)}var x=function(e){return"Invalid value for key ".concat(e)},w=function(e){return"Pattern length exceeds max of ".concat(e,".")},L=Object.prototype.hasOwnProperty,S=function(){function e(t){var n=this;r(this,e),this._keys=[],this._keyMap={};var i=0;t.forEach((function(e){var t=_(e);i+=t.weight,n._keys.push(t),n._keyMap[t.id]=t,i+=t.weight})),this._keys.forEach((function(e){e.weight/=i}))}return o(e,[{key:"get",value:function(e){return this._keyMap[e]}},{key:"keys",value:function(){return this._keys}},{key:"toJSON",value:function(){return JSON.stringify(this._keys)}}]),e}();function _(e){var t=null,n=null,r=null,i=1,o=null;if(g(e)||v(e))r=e,t=O(e),n=j(e);else{if(!L.call(e,"name"))throw new Error(function(e){return"Missing ".concat(e," property in key")}("name"));var c=e.name;if(r=c,L.call(e,"weight")&&(i=e.weight)<=0)throw new Error(function(e){return"Property 'weight' in key '".concat(e,"' must be a positive integer")}(c));t=O(c),n=j(c),o=e.getFn}return{path:t,id:n,weight:i,src:r,getFn:o}}function O(e){return v(e)?e:e.split(".")}function j(e){return v(e)?e.join("."):e}var A={useExtendedSearch:!1,getFn:function(e,t){var n=[],r=!1;return function e(t,i,o){if(k(t))if(i[o]){var c=t[i[o]];if(!k(c))return;if(o===i.length-1&&(g(c)||y(c)||p(c)))n.push(function(e){return null==e?"":function(e){if("string"==typeof e)return e;var t=e+"";return"0"==t&&1/e==-1/0?"-0":t}(e)}(c));else if(v(c)){r=!0;for(var a=0,s=c.length;a<s;a+=1)e(c[a],i,o+1)}else i.length&&e(c,i,o+1)}else n.push(t)}(e,g(t)?t.split("."):t,0),r?n:n[0]},ignoreLocation:!1,ignoreFieldNorm:!1,fieldNormWeight:1},I=t(t(t(t({},{isCaseSensitive:!1,includeScore:!1,keys:[],shouldSort:!0,sortFn:function(e,t){return e.score===t.score?e.idx<t.idx?-1:1:e.score<t.score?-1:1}}),{includeMatches:!1,findAllMatches:!1,minMatchCharLength:1}),{location:0,threshold:.6,distance:100}),A),C=/[^ ]+/g;function E(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1,t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:3,n=new Map,r=Math.pow(10,t);return{get:function(t){var i=t.match(C).length;if(n.has(i))return n.get(i);var o=1/Math.pow(i,.5*e),c=parseFloat(Math.round(o*r)/r);return n.set(i,c),c},clear:function(){n.clear()}}}var $=function(){function e(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},n=t.getFn,i=void 0===n?I.getFn:n,o=t.fieldNormWeight,c=void 0===o?I.fieldNormWeight:o;r(this,e),this.norm=E(c,3),this.getFn=i,this.isCreated=!1,this.setIndexRecords()}return o(e,[{key:"setSources",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];this.docs=e}},{key:"setIndexRecords",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];this.records=e}},{key:"setKeys",value:function(){var e=this,t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];this.keys=t,this._keysMap={},t.forEach((function(t,n){e._keysMap[t.id]=n}))}},{key:"create",value:function(){var e=this;!this.isCreated&&this.docs.length&&(this.isCreated=!0,g(this.docs[0])?this.docs.forEach((function(t,n){e._addString(t,n)})):this.docs.forEach((function(t,n){e._addObject(t,n)})),this.norm.clear())}},{key:"add",value:function(e){var t=this.size();g(e)?this._addString(e,t):this._addObject(e,t)}},{key:"removeAt",value:function(e){this.records.splice(e,1);for(var t=e,n=this.size();t<n;t+=1)this.records[t].i-=1}},{key:"getValueForItemAtKeyId",value:function(e,t){return e[this._keysMap[t]]}},{key:"size",value:function(){return this.records.length}},{key:"_addString",value:function(e,t){if(k(e)&&!M(e)){var n={v:e,i:t,n:this.norm.get(e)};this.records.push(n)}}},{key:"_addObject",value:function(e,t){var n=this,r={i:t,$:{}};this.keys.forEach((function(t,i){var o=t.getFn?t.getFn(e):n.getFn(e,t.path);if(k(o))if(v(o))!function(){for(var e=[],t=[{nestedArrIndex:-1,value:o}];t.length;){var c=t.pop(),a=c.nestedArrIndex,s=c.value;if(k(s))if(g(s)&&!M(s)){var u={v:s,i:a,n:n.norm.get(s)};e.push(u)}else v(s)&&s.forEach((function(e,n){t.push({nestedArrIndex:n,value:e})}))}r.$[i]=e}();else if(g(o)&&!M(o)){var c={v:o,n:n.norm.get(o)};r.$[i]=c}})),this.records.push(r)}},{key:"toJSON",value:function(){return{keys:this.keys,records:this.records}}}]),e}();function F(e,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{},r=n.getFn,i=void 0===r?I.getFn:r,o=n.fieldNormWeight,c=void 0===o?I.fieldNormWeight:o,a=new $({getFn:i,fieldNormWeight:c});return a.setKeys(e.map(_)),a.setSources(t),a.create(),a}function R(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=t.errors,r=void 0===n?0:n,i=t.currentLocation,o=void 0===i?0:i,c=t.expectedLocation,a=void 0===c?0:c,s=t.distance,u=void 0===s?I.distance:s,h=t.ignoreLocation,l=void 0===h?I.ignoreLocation:h,f=r/e.length;if(l)return f;var d=Math.abs(a-o);return u?f+d/u:d?1:f}function N(){for(var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[],t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:I.minMatchCharLength,n=[],r=-1,i=-1,o=0,c=e.length;o<c;o+=1){var a=e[o];a&&-1===r?r=o:a||-1===r||((i=o-1)-r+1>=t&&n.push([r,i]),r=-1)}return e[o-1]&&o-r>=t&&n.push([r,o-1]),n}var P=32;function W(e){for(var t={},n=0,r=e.length;n<r;n+=1){var i=e.charAt(n);t[i]=(t[i]||0)|1<<r-n-1}return t}var T=function(){function e(t){var n=this,i=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},o=i.location,c=void 0===o?I.location:o,a=i.threshold,s=void 0===a?I.threshold:a,u=i.distance,h=void 0===u?I.distance:u,l=i.includeMatches,f=void 0===l?I.includeMatches:l,d=i.findAllMatches,v=void 0===d?I.findAllMatches:d,g=i.minMatchCharLength,y=void 0===g?I.minMatchCharLength:g,p=i.isCaseSensitive,m=void 0===p?I.isCaseSensitive:p,k=i.ignoreLocation,M=void 0===k?I.ignoreLocation:k;if(r(this,e),this.options={location:c,threshold:s,distance:h,includeMatches:f,findAllMatches:v,minMatchCharLength:y,isCaseSensitive:m,ignoreLocation:M},this.pattern=m?t:t.toLowerCase(),this.chunks=[],this.pattern.length){var b=function(e,t){n.chunks.push({pattern:e,alphabet:W(e),startIndex:t})},x=this.pattern.length;if(x>P){for(var w=0,L=x%P,S=x-L;w<S;)b(this.pattern.substr(w,P),w),w+=P;if(L){var _=x-P;b(this.pattern.substr(_),_)}}else b(this.pattern,0)}}return o(e,[{key:"searchIn",value:function(e){var t=this.options,n=t.isCaseSensitive,r=t.includeMatches;if(n||(e=e.toLowerCase()),this.pattern===e){var i={isMatch:!0,score:0};return r&&(i.indices=[[0,e.length-1]]),i}var o=this.options,c=o.location,a=o.distance,s=o.threshold,u=o.findAllMatches,h=o.minMatchCharLength,l=o.ignoreLocation,d=[],v=0,g=!1;this.chunks.forEach((function(t){var n=t.pattern,i=t.alphabet,o=t.startIndex,y=function(e,t,n){var r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:{},i=r.location,o=void 0===i?I.location:i,c=r.distance,a=void 0===c?I.distance:c,s=r.threshold,u=void 0===s?I.threshold:s,h=r.findAllMatches,l=void 0===h?I.findAllMatches:h,f=r.minMatchCharLength,d=void 0===f?I.minMatchCharLength:f,v=r.includeMatches,g=void 0===v?I.includeMatches:v,y=r.ignoreLocation,p=void 0===y?I.ignoreLocation:y;if(t.length>P)throw new Error(w(P));for(var m,k=t.length,M=e.length,b=Math.max(0,Math.min(o,M)),x=u,L=b,S=d>1||g,_=S?Array(M):[];(m=e.indexOf(t,L))>-1;){var O=R(t,{currentLocation:m,expectedLocation:b,distance:a,ignoreLocation:p});if(x=Math.min(O,x),L=m+k,S)for(var j=0;j<k;)_[m+j]=1,j+=1}L=-1;for(var A=[],C=1,E=k+M,$=1<<k-1,F=0;F<k;F+=1){for(var W=0,T=E;W<T;)R(t,{errors:F,currentLocation:b+T,expectedLocation:b,distance:a,ignoreLocation:p})<=x?W=T:E=T,T=Math.floor((E-W)/2+W);E=T;var z=Math.max(1,b-T+1),D=l?M:Math.min(b+T,M)+k,K=Array(D+2);K[D+1]=(1<<F)-1;for(var q=D;q>=z;q-=1){var B=q-1,J=n[e.charAt(B)];if(S&&(_[B]=+!!J),K[q]=(K[q+1]<<1|1)&J,F&&(K[q]|=(A[q+1]|A[q])<<1|1|A[q+1]),K[q]&$&&(C=R(t,{errors:F,currentLocation:B,expectedLocation:b,distance:a,ignoreLocation:p}))<=x){if(x=C,(L=B)<=b)break;z=Math.max(1,2*b-L)}}if(R(t,{errors:F+1,currentLocation:b,expectedLocation:b,distance:a,ignoreLocation:p})>x)break;A=K}var U={isMatch:L>=0,score:Math.max(.001,C)};if(S){var V=N(_,d);V.length?g&&(U.indices=V):U.isMatch=!1}return U}(e,n,i,{location:c+o,distance:a,threshold:s,findAllMatches:u,minMatchCharLength:h,includeMatches:r,ignoreLocation:l}),p=y.isMatch,m=y.score,k=y.indices;p&&(g=!0),v+=m,p&&k&&(d=[].concat(f(d),f(k)))}));var y={isMatch:g,score:g?v/this.chunks.length:1};return g&&r&&(y.indices=d),y}}]),e}(),z=function(){function e(t){r(this,e),this.pattern=t}return o(e,[{key:"search",value:function(){}}],[{key:"isMultiMatch",value:function(e){return D(e,this.multiRegex)}},{key:"isSingleMatch",value:function(e){return D(e,this.singleRegex)}}]),e}();function D(e,t){var n=e.match(t);return n?n[1]:null}var K=function(e){a(n,e);var t=l(n);function n(e){return r(this,n),t.call(this,e)}return o(n,[{key:"search",value:function(e){var t=e===this.pattern;return{isMatch:t,score:t?0:1,indices:[0,this.pattern.length-1]}}}],[{key:"type",get:function(){return"exact"}},{key:"multiRegex",get:function(){return/^="(.*)"$/}},{key:"singleRegex",get:function(){return/^=(.*)$/}}]),n}(z),q=function(e){a(n,e);var t=l(n);function n(e){return r(this,n),t.call(this,e)}return o(n,[{key:"search",value:function(e){var t=-1===e.indexOf(this.pattern);return{isMatch:t,score:t?0:1,indices:[0,e.length-1]}}}],[{key:"type",get:function(){return"inverse-exact"}},{key:"multiRegex",get:function(){return/^!"(.*)"$/}},{key:"singleRegex",get:function(){return/^!(.*)$/}}]),n}(z),B=function(e){a(n,e);var t=l(n);function n(e){return r(this,n),t.call(this,e)}return o(n,[{key:"search",value:function(e){var t=e.startsWith(this.pattern);return{isMatch:t,score:t?0:1,indices:[0,this.pattern.length-1]}}}],[{key:"type",get:function(){return"prefix-exact"}},{key:"multiRegex",get:function(){return/^\^"(.*)"$/}},{key:"singleRegex",get:function(){return/^\^(.*)$/}}]),n}(z),J=function(e){a(n,e);var t=l(n);function n(e){return r(this,n),t.call(this,e)}return o(n,[{key:"search",value:function(e){var t=!e.startsWith(this.pattern);return{isMatch:t,score:t?0:1,indices:[0,e.length-1]}}}],[{key:"type",get:function(){return"inverse-prefix-exact"}},{key:"multiRegex",get:function(){return/^!\^"(.*)"$/}},{key:"singleRegex",get:function(){return/^!\^(.*)$/}}]),n}(z),U=function(e){a(n,e);var t=l(n);function n(e){return r(this,n),t.call(this,e)}return o(n,[{key:"search",value:function(e){var t=e.endsWith(this.pattern);return{isMatch:t,score:t?0:1,indices:[e.length-this.pattern.length,e.length-1]}}}],[{key:"type",get:function(){return"suffix-exact"}},{key:"multiRegex",get:function(){return/^"(.*)"\$$/}},{key:"singleRegex",get:function(){return/^(.*)\$$/}}]),n}(z),V=function(e){a(n,e);var t=l(n);function n(e){return r(this,n),t.call(this,e)}return o(n,[{key:"search",value:function(e){var t=!e.endsWith(this.pattern);return{isMatch:t,score:t?0:1,indices:[0,e.length-1]}}}],[{key:"type",get:function(){return"inverse-suffix-exact"}},{key:"multiRegex",get:function(){return/^!"(.*)"\$$/}},{key:"singleRegex",get:function(){return/^!(.*)\$$/}}]),n}(z),G=function(e){a(n,e);var t=l(n);function n(e){var i,o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},c=o.location,a=void 0===c?I.location:c,s=o.threshold,u=void 0===s?I.threshold:s,h=o.distance,l=void 0===h?I.distance:h,f=o.includeMatches,d=void 0===f?I.includeMatches:f,v=o.findAllMatches,g=void 0===v?I.findAllMatches:v,y=o.minMatchCharLength,p=void 0===y?I.minMatchCharLength:y,m=o.isCaseSensitive,k=void 0===m?I.isCaseSensitive:m,M=o.ignoreLocation,b=void 0===M?I.ignoreLocation:M;return r(this,n),(i=t.call(this,e))._bitapSearch=new T(e,{location:a,threshold:u,distance:l,includeMatches:d,findAllMatches:g,minMatchCharLength:p,isCaseSensitive:k,ignoreLocation:b}),i}return o(n,[{key:"search",value:function(e){return this._bitapSearch.searchIn(e)}}],[{key:"type",get:function(){return"fuzzy"}},{key:"multiRegex",get:function(){return/^"(.*)"$/}},{key:"singleRegex",get:function(){return/^(.*)$/}}]),n}(z),H=function(e){a(n,e);var t=l(n);function n(e){return r(this,n),t.call(this,e)}return o(n,[{key:"search",value:function(e){for(var t,n=0,r=[],i=this.pattern.length;(t=e.indexOf(this.pattern,n))>-1;)n=t+i,r.push([t,n-1]);var o=!!r.length;return{isMatch:o,score:o?0:1,indices:r}}}],[{key:"type",get:function(){return"include"}},{key:"multiRegex",get:function(){return/^'"(.*)"$/}},{key:"singleRegex",get:function(){return/^'(.*)$/}}]),n}(z),Q=[K,H,B,J,V,U,q,G],X=Q.length,Y=/ +(?=(?:[^\"]*\"[^\"]*\")*[^\"]*$)/;function Z(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return e.split("|").map((function(e){for(var n=e.trim().split(Y).filter((function(e){return e&&!!e.trim()})),r=[],i=0,o=n.length;i<o;i+=1){for(var c=n[i],a=!1,s=-1;!a&&++s<X;){var u=Q[s],h=u.isMultiMatch(c);h&&(r.push(new u(h,t)),a=!0)}if(!a)for(s=-1;++s<X;){var l=Q[s],f=l.isSingleMatch(c);if(f){r.push(new l(f,t));break}}}return r}))}var ee=new Set([G.type,H.type]),te=function(){function e(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},i=n.isCaseSensitive,o=void 0===i?I.isCaseSensitive:i,c=n.includeMatches,a=void 0===c?I.includeMatches:c,s=n.minMatchCharLength,u=void 0===s?I.minMatchCharLength:s,h=n.ignoreLocation,l=void 0===h?I.ignoreLocation:h,f=n.findAllMatches,d=void 0===f?I.findAllMatches:f,v=n.location,g=void 0===v?I.location:v,y=n.threshold,p=void 0===y?I.threshold:y,m=n.distance,k=void 0===m?I.distance:m;r(this,e),this.query=null,this.options={isCaseSensitive:o,includeMatches:a,minMatchCharLength:u,findAllMatches:d,ignoreLocation:l,location:g,threshold:p,distance:k},this.pattern=o?t:t.toLowerCase(),this.query=Z(this.pattern,this.options)}return o(e,[{key:"searchIn",value:function(e){var t=this.query;if(!t)return{isMatch:!1,score:1};var n=this.options,r=n.includeMatches;e=n.isCaseSensitive?e:e.toLowerCase();for(var i=0,o=[],c=0,a=0,s=t.length;a<s;a+=1){var u=t[a];o.length=0,i=0;for(var h=0,l=u.length;h<l;h+=1){var d=u[h],v=d.search(e),g=v.isMatch,y=v.indices,p=v.score;if(!g){c=0,i=0,o.length=0;break}if(i+=1,c+=p,r){var m=d.constructor.type;ee.has(m)?o=[].concat(f(o),f(y)):o.push(y)}}if(i){var k={isMatch:!0,score:c/i};return r&&(k.indices=o),k}}return{isMatch:!1,score:1}}}],[{key:"condition",value:function(e,t){return t.useExtendedSearch}}]),e}(),ne=[];function re(e,t){for(var n=0,r=ne.length;n<r;n+=1){var i=ne[n];if(i.condition(e,t))return new i(e,t)}return new T(e,t)}var ie="$and",oe="$or",ce="$path",ae="$val",se=function(e){return!(!e[ie]&&!e[oe])},ue=function(e){return!!e[ce]},he=function(e){return!v(e)&&m(e)&&!se(e)},le=function(e){return c({},ie,Object.keys(e).map((function(t){return c({},t,e[t])})))};function fe(e,t){var n=t.ignoreFieldNorm,r=void 0===n?I.ignoreFieldNorm:n;e.forEach((function(e){var t=1;e.matches.forEach((function(e){var n=e.key,i=e.norm,o=e.score,c=n?n.weight:null;t*=Math.pow(0===o&&c?Number.EPSILON:o,(c||1)*(r?1:i))})),e.score=t}))}function de(e,t){var n=e.matches;t.matches=[],k(n)&&n.forEach((function(e){if(k(e.indices)&&e.indices.length){var n={indices:e.indices,value:e.value};e.key&&(n.key=e.key.src),e.idx>-1&&(n.refIndex=e.idx),t.matches.push(n)}}))}function ve(e,t){t.score=e.score}function ge(e,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{},r=n.includeMatches,i=void 0===r?I.includeMatches:r,o=n.includeScore,c=void 0===o?I.includeScore:o,a=[];return i&&a.push(de),c&&a.push(ve),e.map((function(e){var n=e.idx,r={item:t[n],refIndex:n};return a.length&&a.forEach((function(t){t(e,r)})),r}))}var ye=function(){function e(n){var i=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},o=arguments.length>2?arguments[2]:void 0;r(this,e),this.options=t(t({},I),i),this.options.useExtendedSearch,this._keyStore=new S(this.options.keys),this.setCollection(n,o)}return o(e,[{key:"setCollection",value:function(e,t){if(this._docs=e,t&&!(t instanceof $))throw new Error("Incorrect 'index' type");this._myIndex=t||F(this.options.keys,this._docs,{getFn:this.options.getFn,fieldNormWeight:this.options.fieldNormWeight})}},{key:"add",value:function(e){k(e)&&(this._docs.push(e),this._myIndex.add(e))}},{key:"remove",value:function(){for(var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:function(){return!1},t=[],n=0,r=this._docs.length;n<r;n+=1){var i=this._docs[n];e(i,n)&&(this.removeAt(n),n-=1,r-=1,t.push(i))}return t}},{key:"removeAt",value:function(e){this._docs.splice(e,1),this._myIndex.removeAt(e)}},{key:"getIndex",value:function(){return this._myIndex}},{key:"search",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=t.limit,r=void 0===n?-1:n,i=this.options,o=i.includeMatches,c=i.includeScore,a=i.shouldSort,s=i.sortFn,u=i.ignoreFieldNorm,h=g(e)?g(this._docs[0])?this._searchStringList(e):this._searchObjectList(e):this._searchLogical(e);return fe(h,{ignoreFieldNorm:u}),a&&h.sort(s),y(r)&&r>-1&&(h=h.slice(0,r)),ge(h,this._docs,{includeMatches:o,includeScore:c})}},{key:"_searchStringList",value:function(e){var t=re(e,this.options),n=this._myIndex.records,r=[];return n.forEach((function(e){var n=e.v,i=e.i,o=e.n;if(k(n)){var c=t.searchIn(n),a=c.isMatch,s=c.score,u=c.indices;a&&r.push({item:n,idx:i,matches:[{score:s,value:n,norm:o,indices:u}]})}})),r}},{key:"_searchLogical",value:function(e){var t=this,n=function(e,t){var n=(arguments.length>2&&void 0!==arguments[2]?arguments[2]:{}).auto,r=void 0===n||n,i=function e(n){var i=Object.keys(n),o=ue(n);if(!o&&i.length>1&&!se(n))return e(le(n));if(he(n)){var c=o?n[ce]:i[0],a=o?n[ae]:n[c];if(!g(a))throw new Error(x(c));var s={keyId:j(c),pattern:a};return r&&(s.searcher=re(a,t)),s}var u={children:[],operator:i[0]};return i.forEach((function(t){var r=n[t];v(r)&&r.forEach((function(t){u.children.push(e(t))}))})),u};return se(e)||(e=le(e)),i(e)}(e,this.options),r=function e(n,r,i){if(!n.children){var o=n.keyId,c=n.searcher,a=t._findMatches({key:t._keyStore.get(o),value:t._myIndex.getValueForItemAtKeyId(r,o),searcher:c});return a&&a.length?[{idx:i,item:r,matches:a}]:[]}for(var s=[],u=0,h=n.children.length;u<h;u+=1){var l=e(n.children[u],r,i);if(l.length)s.push.apply(s,f(l));else if(n.operator===ie)return[]}return s},i=this._myIndex.records,o={},c=[];return i.forEach((function(e){var t=e.$,i=e.i;if(k(t)){var a=r(n,t,i);a.length&&(o[i]||(o[i]={idx:i,item:t,matches:[]},c.push(o[i])),a.forEach((function(e){var t,n=e.matches;(t=o[i].matches).push.apply(t,f(n))})))}})),c}},{key:"_searchObjectList",value:function(e){var t=this,n=re(e,this.options),r=this._myIndex,i=r.keys,o=r.records,c=[];return o.forEach((function(e){var r=e.$,o=e.i;if(k(r)){var a=[];i.forEach((function(e,i){a.push.apply(a,f(t._findMatches({key:e,value:r[i],searcher:n})))})),a.length&&c.push({idx:o,item:r,matches:a})}})),c}},{key:"_findMatches",value:function(e){var t=e.key,n=e.value,r=e.searcher;if(!k(n))return[];var i=[];if(v(n))n.forEach((function(e){var n=e.v,o=e.i,c=e.n;if(k(n)){var a=r.searchIn(n),s=a.isMatch,u=a.score,h=a.indices;s&&i.push({score:u,key:t,value:n,idx:o,norm:c,indices:h})}}));else{var o=n.v,c=n.n,a=r.searchIn(o),s=a.isMatch,u=a.score,h=a.indices;s&&i.push({score:u,key:t,value:o,norm:c,indices:h})}return i}}]),e}();return ye.version="6.6.2",ye.createIndex=F,ye.parseIndex=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=t.getFn,r=void 0===n?I.getFn:n,i=t.fieldNormWeight,o=void 0===i?I.fieldNormWeight:i,c=e.keys,a=e.records,s=new $({getFn:r,fieldNormWeight:o});return s.setKeys(c),s.setIndexRecords(a),s},ye.config=I,function(){ne.push.apply(ne,arguments)}(te),ye},"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e="undefined"!=typeof globalThis?globalThis:e||self).Fuse=t();