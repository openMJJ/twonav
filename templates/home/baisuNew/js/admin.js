//渲染分类图标选择
var icons = ['glass','music','search','envelope-o','heart','star','star-o','user','film','th-large','th','th-list','check','remove','search-plus','search-minus','power-off','signal','gear','trash-o','home','file-o','clock-o','road','download','arrow-circle-o-down','arrow-circle-o-up','inbox','play-circle-o','rotate-right','refresh','list-alt','lock','flag','headphones','volume-off','volume-down','volume-up','qrcode','barcode','tag','tags','book','bookmark','print','camera','font','bold','italic','text-height','text-width','align-left','align-center','align-right','align-justify','list','dedent','indent','video-camera','photo','pencil','map-marker','adjust','tint','edit','share-square-o','check-square-o','arrows','step-backward','fast-backward','backward','play','pause','stop','forward','fast-forward','step-forward','eject','chevron-left','chevron-right','plus-circle','minus-circle','times-circle','check-circle','question-circle','info-circle','crosshairs','times-circle-o','check-circle-o','ban','arrow-left','arrow-right','arrow-up','arrow-down','mail-forward','expand','compress','plus','minus','asterisk','exclamation-circle','gift','leaf','fire','eye','eye-slash','warning','plane','calendar','random','comment','magnet','chevron-up','chevron-down','retweet','shopping-cart','folder','folder-open','arrows-v','arrows-h','bar-chart-o','twitter-square','facebook-square','camera-retro','key','gears','comments','thumbs-o-up','thumbs-o-down','star-half','heart-o','sign-out','linkedin-square','thumb-tack','external-link','sign-in','trophy','github-square','upload','lemon-o','phone','square-o','bookmark-o','phone-square','twitter','facebook-f','github','unlock','credit-card','feed','hdd-o','bullhorn','bell','certificate','hand-o-right','hand-o-left','hand-o-up','hand-o-down',
'arrow-circle-left','arrow-circle-right','arrow-circle-up','arrow-circle-down','globe','wrench','tasks','filter','briefcase','arrows-alt','group','chain','cloud','flask','cut','copy','paperclip','save','square','navicon','list-ul','list-ol','strikethrough','underline','table','magic','truck','pinterest','pinterest-square','google-plus-square','google-plus','money','caret-down','caret-up','caret-left','caret-right','columns','unsorted','sort-down','sort-up','envelope','linkedin','rotate-left','legal','dashboard','comment-o','comments-o','flash','sitemap','umbrella','paste','lightbulb-o','exchange','cloud-download','cloud-upload','user-md','stethoscope','suitcase','bell-o','coffee','cutlery','file-text-o','building-o','hospital-o','ambulance','medkit','fighter-jet','beer','h-square','plus-square','angle-double-left','angle-double-right','angle-double-up','angle-double-down','angle-left','angle-right','angle-up','angle-down','desktop','laptop','tablet','mobile-phone','circle-o','quote-left','quote-right','spinner','circle','mail-reply','github-alt','folder-o','folder-open-o','smile-o','frown-o','meh-o','gamepad','keyboard-o','flag-o','flag-checkered','terminal','code','mail-reply-all','star-half-empty','location-arrow','crop','code-fork','unlink','question','info','exclamation','superscript','subscript','eraser','puzzle-piece','microphone','microphone-slash','shield','calendar-o','fire-extinguisher','rocket','maxcdn','chevron-circle-left','chevron-circle-right','chevron-circle-up','chevron-circle-down','html5','css3','anchor','unlock-alt','bullseye','ellipsis-h',
'ellipsis-v','rss-square','play-circle','ticket','minus-square','minus-square-o','level-up','level-down','check-square','pencil-square','external-link-square','share-square','compass','toggle-down','toggle-up','toggle-right','euro','gbp','dollar','rupee','cny','ruble','won','bitcoin','file','file-text','sort-alpha-asc','sort-alpha-desc','sort-amount-asc','sort-amount-desc','sort-numeric-asc','sort-numeric-desc','thumbs-up','thumbs-down','youtube-square','youtube','xing','xing-square','youtube-play','dropbox','stack-overflow','instagram','flickr','adn','bitbucket','bitbucket-square','tumblr','tumblr-square','long-arrow-down','long-arrow-up','long-arrow-left','long-arrow-right','apple','windows','android','linux','dribbble','skype','foursquare','trello','female','male','gittip','sun-o','moon-o','archive','bug','vk','weibo','renren','pagelines','stack-exchange','arrow-circle-o-right','arrow-circle-o-left','toggle-left','dot-circle-o','wheelchair','vimeo-square','turkish-lira','plus-square-o','space-shuttle','slack','envelope-square','wordpress','openid','institution','mortar-board','yahoo','google','reddit','reddit-square','stumbleupon-circle','stumbleupon','delicious','digg','pied-piper-pp','pied-piper-alt','drupal','joomla','language','fax','building','child','paw','spoon','cube','cubes','behance','behance-square','steam','steam-square','recycle',
'automobile','cab','tree','spotify','deviantart','soundcloud','database','file-pdf-o','file-word-o','file-excel-o','file-powerpoint-o','file-photo-o','file-zip-o','file-sound-o','file-movie-o','file-code-o','vine','codepen','jsfiddle','life-bouy','circle-o-notch','ra','ge','git-square','git','y-combinator-square','tencent-weibo','qq','wechat','send','send-o','history','circle-thin','header','paragraph','sliders','share-alt','share-alt-square','bomb','soccer-ball-o','tty','binoculars','plug','slideshare','twitch','yelp','newspaper-o','wifi','calculator','paypal','google-wallet','cc-visa','cc-mastercard','cc-discover','cc-amex','cc-paypal','cc-stripe','bell-slash','bell-slash-o','trash','copyright','at','eyedropper','paint-brush','birthday-cake','area-chart','pie-chart','line-chart','lastfm','lastfm-square','toggle-off','toggle-on','bicycle','bus','ioxhost','angellist','cc','shekel','meanpath','buysellads','connectdevelop','dashcube','forumbee','leanpub','sellsy','shirtsinbulk','simplybuilt','skyatlas','cart-plus','cart-arrow-down','diamond','ship','user-secret','motorcycle','street-view','heartbeat','venus','mars','mercury','intersex',
'transgender-alt','venus-double','mars-double','venus-mars','mars-stroke','mars-stroke-v','mars-stroke-h','neuter','genderless','facebook-official','pinterest-p','whatsapp','server','user-plus','user-times','hotel','viacoin','train','subway','medium','yc','optin-monster','opencart','expeditedssl','battery-4','battery-3','battery-2','battery-1','battery-0','mouse-pointer','i-cursor','object-group','object-ungroup','sticky-note','sticky-note-o','cc-jcb','cc-diners-club','clone','balance-scale','hourglass-o','hourglass-1','hourglass-2','hourglass-3','hourglass','hand-grab-o','hand-stop-o','hand-scissors-o','hand-lizard-o','hand-spock-o','hand-pointer-o','hand-peace-o','trademark','registered','creative-commons','gg','gg-circle','tripadvisor','odnoklassniki','odnoklassniki-square','get-pocket','wikipedia-w','safari','chrome','firefox','opera','internet-explorer','tv','contao','500px','amazon','calendar-plus-o','calendar-minus-o','calendar-times-o','calendar-check-o','industry','map-pin','map-signs','map-o','map','commenting','commenting-o','houzz','vimeo','black-tie','fonticons','reddit-alien','edge','credit-card-alt','codiepie','modx','fort-awesome','usb','product-hunt','mixcloud','scribd','pause-circle','pause-circle-o','stop-circle','stop-circle-o','shopping-bag','shopping-basket','hashtag','bluetooth','bluetooth-b','percent','gitlab','wpbeginner',
'wpforms','envira','universal-access','wheelchair-alt','question-circle-o','blind','audio-description','volume-control-phone','braille','assistive-listening-systems','asl-interpreting','deafness','glide','glide-g','signing','low-vision','viadeo','viadeo-square','snapchat','snapchat-ghost','snapchat-square','pied-piper','first-order','yoast','themeisle','google-plus-circle','fa','handshake-o','envelope-open','envelope-open-o','linode','address-book','address-book-o','vcard','vcard-o','user-circle','user-circle-o','user-o','id-badge','drivers-license','drivers-license-o','quora','free-code-camp','telegram','thermometer-4','thermometer-3','thermometer-2','thermometer-1','thermometer-0','shower','bathtub','podcast','window-maximize','window-minimize','window-restore','times-rectangle','times-rectangle-o','bandcamp','grav','etsy','imdb','ravelry','eercast','microchip','snowflake-o','superpowers','wpexplorer','meetup'];
$(document).ready(function() {
    var ul = $('<ul></ul>').addClass('ul-icon-list clearfix').attr('id', 'component_icons_list').css('display', 'none');
    icons.forEach(function(v) {
        var icon = 'fa-' + v;
        var li = $('<li></li>').attr('title', icon);
        var i = $('<i></i>').attr('data-text', icon).addClass('fa ' + icon + ' js-copy');
        var div = $('<div></div>').addClass('name').text(icon);
        li.append(i).append(div);
        ul.append(li);
    });
    $('body').append(ul);
    //分类数据
    var categoryList = $('div.list-type[type="category"]');
    category_parent.forEach(function(d) {
        categoryList.append($('<span></span>').attr('data-fid', d.id).text(d.name));
    });
    categoryList = $('div.list-type[type="link"]');
    categorys.forEach(function(d) {
        categoryList.append($('<span></span>').attr('data-fid', d.id).text(d.name));
    });
});


layui.use(['form', 'dropdown'], function() {
	var $ = layui.$,
		dropdown = layui.dropdown,
		form = layui.form,
		util = layui.util;
	var baseUrl = Get_baseUrl();
	var isSupported = ClipboardJS.isSupported();
	//初始化分类栏右键菜单
	dropdown.render({
		elem: '.typeList',
		trigger: 'contextmenu',
		data: [{
			title: '编辑',
			id: 'edit',
		}, {
			title: '删除',
			id: 'del'
		}, {
			type: '-'
		}, {
			title: '添加分类',
			id: 'add'
		}],
		click: function(data, othis) {
			var elem = $(this.elem),typeId = elem.data('id');
			if(data.id === 'edit') {
				layer.open({
					type: 1,
					title: '编辑分类',
					shadeClose: true,
					shade: 0.8,
					area: ['460px'],
					content: $('#component_type_edit'),
					success: function(layero, index) {
						$.post(get_api('read_one_category'), {
							cid: typeId
						}, function(data, status) {
							console.log(data);
							data.data.property = data.data.property == 1 ? true : false;
							if(data.code == 1) {
								form.val("type_edit", data.data);
								$('.font_icon_show i').attr('class',data.data.font_icon);
								$("#categoryList span").each(function(i, o) {
									if($(this).data('fid') == data.data.fid) {
										$(this).addClass('hover').siblings().removeClass('hover');
										return;
									}
								});
								return;
							}
							post_error(data.msg);
						});
					}
				});
			} else if(data.id === 'del') {
				layer.confirm('确定删除该分类吗？', {
					btn: ['确定', '取消']
				}, function() {
					del_type(typeId);
				});
			} else if(data.id === 'add') {
				layer.open({
					type: 1,
					title: '添加分类',
					shadeClose: true,
					shade: 0.8,
					area: ['460px'],
					content: $('#component_type_add'),
				});
			}
		}
	});

    //添加分类 > 显示窗口
	$('#nav-add-type').click(function() {
		layer.open({
			type: 1,
			title: '添加分类',
			shadeClose: true,
			shade: 0.8,
			area: ['460px'],
			content: $('#component_type_add'),
		});
	});
	
	//添加/编辑分类 > 选择父分类
	$('#categoryList span').click(function() {
		$(this).addClass('hover').siblings().removeClass('hover');
		var fid = $(this).data('fid');
		$('input#fid').val(fid);
	});
	
	//添加分类 > 提交
	form.on('submit(type_add)', function(data) {
	    data.field.property = data.field.property == 'on' ? 1 : 0 ;
		$.post(get_api('write_category','add'), data.field, function(data, status) {
			if(data.code == 1) {
				layer.msg('添加分类成功！', {
					icon: 6,
					time: 1000,
					end: function() {
						window.location.reload();
					}
				});
				return;
			}
			post_error(data.msg);
		});
		return false;
	});

	//编辑分类 > 提交
	form.on('submit(type_edit)', function(data) {
	    data.field.property = data.field.property == 'on' ? 1 : 0 ;
		$.post(get_api('write_category','edit'), data.field, function(data, status) {
			if(data.code == 1) {
				layer.msg('编辑分类成功！', {
					icon: 6,
					time: 1000,
					end: function() {
						window.location.reload();
					}
				});
				return;
			}
			post_error(data.msg);
		});
		return false;
	});

    //初始化链接右键菜单
	dropdown.render({
		elem: '.siteList',
		trigger: 'contextmenu',
		data: [{
			title: '打开',
			id: 'open',
		}, {
			title: '复制',
			id: 'copy',
		}, {
			title: '编辑',
			id: 'edit',
		}, {
			title: '删除',
			id: 'del'
		}, {
			type: '-'
		}, {
			title: '添加书签',
			id: 'add'
		}],
		click: function(data, othis) {
			var elem = $(this.elem),
				linksId = elem.data('id');
				linksUrl = elem.data('url');
				links = elem.data('links');
			if(data.id === 'open') {
				open_links(linksUrl);
			} else if(data.id === 'edit') {
				layer.open({
					type: 1,
					title: '编辑书签',
					shadeClose: true,
					shade: 0.8,
					area: ['460px'],
					content: $('#component_links_edit'),
					success: function() {
						$.post(get_api('read_one_link'), {lid: linksId}, function(data, status) {
							console.log(data);
							data.data.property = data.data.property == 1 ? true : false;
							if(data.code == 1) {
								form.val("links_edit", data.data);
								$("#categoryList span").each(function(i, o) {
									if($(this).data('fid') == data.data.fid) {
										$(this).addClass('hover').siblings().removeClass('hover');
										return;
									}
								});
								return;
							}
							post_error(data.msg);
						});

					}
				});
			} else if(data.id === 'del') {
				layer.confirm('确定删除该书签吗？', {
					btn: ['确定', '取消'] //按钮
				}, function() {
					del_links(linksId);
				});
			} else if(data.id === 'copy') {
				if(isSupported){
				    url = linksUrl.substr(0, 11) == "./index.php" ? baseUrl + linksUrl.slice(11) : linksUrl;
				    ClipboardJS.copy(url);
                    layer.msg('复制成功', {icon: 1});
				}else{
				    layer.msg('复制失败,您的浏览器不支持', {icon: 5});
				}
			} else if(data.id === 'add') {
				$('#nav-add-link').trigger('click');
			}
		}
	});

    //添加链接 > 显示窗口
	$('#nav-add-link').click(function() {
		layer.open({
			type: 1,
			title: '添加书签',
			shadeClose: true,
			shade: 0.8,
			area: ['460px'],
			content: $('#component_links_add'),
			success: function() {
				$('#component_links_add .list-type span').eq(0).addClass('hover');
				var addfid = $('#component_links_add .list-type span').eq(0).data('fid');
				$('input#fid').val(addfid);
			}
		});
	});

	//添加链接 > 提交
	form.on('submit(links_add)', function(data) {
        data.field.property = data.field.property == 'on' ? 1 : 0 ;
		$.post(get_api('write_link','add'), data.field, function(data, status) {
			if(data.code == 1) {
				layer.msg('添加链接成功！', {
					icon: 6,
					time: 1000,
					end: function() {
						window.location.reload();
					}
				});
				return;
			}
			post_error(data.msg);
		});
		return false;
	});

	//编辑链接 > 提交
	form.on('submit(links_edit)', function(data) {
		data.field.property = data.field.property == 'on' ? 1 : 0 ;
		$.post(get_api('write_link','edit'), data.field, function(data, status) {
			if(data.code == 1) {
				layer.msg('编辑链接成功！', {
					icon: 6,
					time: 1000,
					end: function() {
						window.location.reload();
					}
				});
				return;
			}
			post_error(data.msg);
		});
		return false;
	});

	//识别链接信息
	$('button#get_links_info').click(function() {
		var url = $('input#url').val();
		$.post(get_api('other_get_link_info'), {url: url,}, function(data, status) {
			if(data.code == 1) {
				form.val("links_add", data.data);
				layer.msg('获取链接信息成功！', {
					icon: 6,
					time: 1000,
				});
				return;
			}
			post_error(data.mssg);
		});
		return false;
	});

	//右下角工具栏
	util.fixbar({
		bars: [
		    { 
                type: 'add',
                icon: 'layui-icon-add-1'
            },{ 
                type: 'menu',
                icon: 'layui-icon-shrink-right'
            }
        ],
		css: {right: 30,bottom: 30},
		duration: 100,
		bgcolor: '#393D49',
		click: function(type) {
			if(type === 'add') {
				$('#nav-add-link').trigger('click');
			}else if(type === 'menu'){
			    $(".navlist-main").toggle();
			}
		}
	});

	//选择图标
	$('.select_icons').click(function() {
		layer.open({
			type: 1,
			title: '选择图标',
			shadeClose: true,
			shade: 0.8,
			area: ['534px'],
			content: $('#component_icons_list')
		});
	});
	//给父页面传值
	$('#component_icons_list li').on('click', function() {
		var icon_name = 'fa '+ $(this).attr('title');
		parent.$('input#font_icon').val(icon_name);
		$('.font_icon_show i').attr('class', icon_name);
		layer.close(layer.index);
	});
});


//错误提示
function post_error(msg = '') {
	layer.msg(msg.length == 0 ? '操作失败，请重试！' : msg , {icon: 5,});
}

//删除分类
function del_type(id) {
	$.post(get_api('write_category','del'), {cid: id}, function(data, status) {
		if(data.code == 1) {
			layer.msg('删除分类成功！', {
				icon: 6,
				time: 1000,
				end: function() {
					window.location.reload();
				}
			});
		}else{
		    post_error(data.msg);
		}
	});
}

//删除书签
function del_links(id) {
	$.post(get_api('write_link','del'), {lid: id}, function(data, status) {
		if(data.code == 1) {
			layer.msg('删除书签成功！', {
				icon: 6,
				time: 1000,
				end: function() {
					window.location.reload();
				}
			});
			return;
		}
		post_error(data.msg)
	});
}

//取API地址
function get_api(method,type=null){
    return './index.php?c=api&method=' + method + (type?'&type='+type:'') + '&u=' + u ;
}

//取基本URL
function Get_baseUrl() {
    let url = window.location.href,
        hostname = window.location.hostname,
        protocol = window.location.protocol,
        port = window.location.port,
        pathname = window.location.pathname;
        pathname = pathname.substring(0, pathname.lastIndexOf("/") + 1),
        baseUrl = protocol + "//" + hostname + (port ? ":" + port : "") + pathname;
    return baseUrl;
}