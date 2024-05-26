<?php 
$sleep = ($is_login?($transition_page['admin_stay_time']??3):($transition_page['visitor_stay_time']??5)); //延迟多少秒
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="UTF-8">
  <title><?php echo $link['title']; ?> - TwoNav </title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo $theme_dir ?>/css/link.css">
  <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
  <meta name="keywords" content="<?php echo $link['keywords'] ?? $link['title']; ?>" />
  <meta name="description" content="<?php echo $link['description']; ?>" />
  <link rel="shortcut icon" href="<?php echo $favicon;?>">
  <script>
    window.onload = function () {
      document.querySelector(".root").style.opacity = 1;
      document.querySelector(".ok").onclick;
      <?php if( empty($link['url_standby']) ) echo 'document.querySelector(".ok").click();'; ?>
    }
  </script>
</head>
<body class="root">
  <h2> TwoNav </h2>
  <section class="info-box">
    <h3>链接信息</h3>
    <ul>
      <li>
        <span>名称</span>
        <span><?php echo $link['title']; ?></span>
      </li>
      <li>
        <span>描述:</span>
        <span tips><?php echo $link['description']; ?> </span>
      </li>
      <li>
        <span>链接地址:</span>
        <div link>
          <a href="<?php echo $link['url']; ?>" class="main" rel="<?php echo $link['title']; ?>"><?php echo $link['url']; ?></a>
          <div class="copy" data-copy="<?php echo $link['url']; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="none" version="1.1"
              width="24" height="24" viewBox="0 0 24 24">
              <clipPath id="master_svg0_3_09738">
                <rect x="0" y="0" width="24" height="24" rx="0" />
              </clipPath>
              <g clip-path="url(#master_svg0_3_09738)" style="mix-blend-mode:passthrough">
                <g>
                  <g style="mix-blend-mode:passthrough">
                    <path
                      d="M4,3C3.73478,3,3.48043,3.10536,3.29289,3.29289C3.10536,3.48043,3,3.73478,3,4C3,4,3,13,3,13C3,13.2652,3.10536,13.5196,3.29289,13.7071C3.48043,13.8946,3.73478,14,4,14C4,14,5,14,5,14C5.55228,14,6,14.4477,6,15C6,15.5523,5.55228,16,5,16C5,16,4,16,4,16C3.20435,16,2.44129,15.6839,1.8786800000000001,15.1213C1.31607,14.5587,1,13.7956,1,13C1,13,1,4,1,4C1,3.20435,1.31607,2.44129,1.8786800000000001,1.8786800000000001C2.44129,1.31607,3.20435,1,4,1C4,1,13,1,13,1C13.7956,1,14.5587,1.31607,15.1213,1.8786800000000001C15.6839,2.44129,16,3.20435,16,4C16,4,16,5,16,5C16,5.55228,15.5523,6,15,6C14.4477,6,14,5.55228,14,5C14,5,14,4,14,4C14,3.73478,13.8946,3.48043,13.7071,3.29289C13.5196,3.10536,13.2652,3,13,3C13,3,4,3,4,3C4,3,4,3,4,3ZM11,10C10.44771,10,10,10.44771,10,11C10,11,10,20,10,20C10,20.5523,10.44771,21,11,21C11,21,20,21,20,21C20.5523,21,21,20.5523,21,20C21,20,21,11,21,11C21,10.44771,20.5523,10,20,10C20,10,11,10,11,10C11,10,11,10,11,10ZM8,11C8,9.34315,9.34315,8,11,8C11,8,20,8,20,8C21.6569,8,23,9.34315,23,11C23,11,23,20,23,20C23,21.6569,21.6569,23,20,23C20,23,11,23,11,23C9.34315,23,8,21.6569,8,20C8,20,8,11,8,11C8,11,8,11,8,11Z"
                      fill-rule="evenodd" fill="#0088EA" fill-opacity="1" />
                  </g>
                </g>
              </g>
            </svg>
          </div>
        </div>
      </li>
<?php 
$i = 0;
foreach ($link['url_standby'] as $key => $url_standby){
    $i++;
    if(preg_match('/\[(.*?)\]\((.*?)\)/', $url_standby, $match)){
        $title = $match[1];
        $url = $match[2];
    }else{
        $title = $url_standby;
        $url = $url_standby;
    }
    ?>
		<li>
        <span>备用<?php echo $i;?>：</span>
        <div link><a href="<?php echo $url; ?>" class="standby"  id="standby" rel="<?php echo $link['title']; ?>"><?php echo $title; ?></a>
          <div class="copy" data-copy="<?php echo $url; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="none" version="1.1"
              width="24" height="24" viewBox="0 0 24 24">
              <clipPath id="master_svg0_3_09738">
                <rect x="0" y="0" width="24" height="24" rx="0" />
              </clipPath>
              <g clip-path="url(#master_svg0_3_09738)" style="mix-blend-mode:passthrough">
                <g>
                  <g style="mix-blend-mode:passthrough">
                    <path
                      d="M4,3C3.73478,3,3.48043,3.10536,3.29289,3.29289C3.10536,3.48043,3,3.73478,3,4C3,4,3,13,3,13C3,13.2652,3.10536,13.5196,3.29289,13.7071C3.48043,13.8946,3.73478,14,4,14C4,14,5,14,5,14C5.55228,14,6,14.4477,6,15C6,15.5523,5.55228,16,5,16C5,16,4,16,4,16C3.20435,16,2.44129,15.6839,1.8786800000000001,15.1213C1.31607,14.5587,1,13.7956,1,13C1,13,1,4,1,4C1,3.20435,1.31607,2.44129,1.8786800000000001,1.8786800000000001C2.44129,1.31607,3.20435,1,4,1C4,1,13,1,13,1C13.7956,1,14.5587,1.31607,15.1213,1.8786800000000001C15.6839,2.44129,16,3.20435,16,4C16,4,16,5,16,5C16,5.55228,15.5523,6,15,6C14.4477,6,14,5.55228,14,5C14,5,14,4,14,4C14,3.73478,13.8946,3.48043,13.7071,3.29289C13.5196,3.10536,13.2652,3,13,3C13,3,4,3,4,3C4,3,4,3,4,3ZM11,10C10.44771,10,10,10.44771,10,11C10,11,10,20,10,20C10,20.5523,10.44771,21,11,21C11,21,20,21,20,21C20.5523,21,21,20.5523,21,20C21,20,21,11,21,11C21,10.44771,20.5523,10,20,10C20,10,11,10,11,10C11,10,11,10,11,10ZM8,11C8,9.34315,9.34315,8,11,8C11,8,20,8,20,8C21.6569,8,23,9.34315,23,11C23,11,23,20,23,20C23,21.6569,21.6569,23,20,23C20,23,11,23,11,23C9.34315,23,8,21.6569,8,20C8,20,8,11,8,11C8,11,8,11,8,11Z"
                      fill-rule="evenodd" fill="#0088EA" fill-opacity="1" />
                  </g>
                </g>
              </g>
            </svg>
          </div>
        </div>
<?php } ?>
      
      

    </ul>
    <div class="next">
      <button class="ok">继续访问</button>
      <button class="load" >
        <span id="load" >打开中<?php echo $sleep; ?></span>
        <div class="loads">

          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="none" version="1.1"
            width="20" height="20" viewBox="0 0 20 20">
            <path
              d="M10,0C10.5523,0,11,0.447715,11,1L11,4C11,4.55228,10.5523,5,10,5C9.44771,5,9,4.55228,9,4L9,1C9,0.447715,9.44771,0,10,0ZM10,15C10.5523,15,11,15.4477,11,16L11,19C11,19.5523,10.5523,20,10,20C9.44771,20,9,19.5523,9,19L9,16C9,15.4477,9.44771,15,10,15ZM20,10C20,10.5523,19.5523,11,19,11L16,11C15.4477,11,15,10.5523,15,10C15,9.44771,15.4477,9,16,9L19,9C19.5523,9,20,9.44771,20,10ZM5,10C5,10.5523,4.55228,11,4,11L1,11C0.447715,11,0,10.5523,0,10C0,9.44771,0.447715,9,1,9L4,9C4.55228,9,5,9.44771,5,10ZM17.071,17.071C16.6805,17.4614,16.0475,17.4614,15.657,17.071L13.536,14.95C13.157,14.5576,13.1625,13.9339,13.5482,13.5482C13.9339,13.1625,14.5576,13.157,14.95,13.536L17.071,15.656C17.462,16.0466,17.462,16.6804,17.071,17.071ZM6.464,6.464C6.0735,6.85438,5.4405,6.85438,5.05,6.464L2.93,4.344C2.53926,3.95353,2.53903,3.32024,2.9295,2.9295C3.31997,2.53876,3.95326,2.53853,4.344,2.929L6.464,5.05C6.85438,5.4405,6.85438,6.0735,6.464,6.464ZM2.93,17.071C2.53962,16.6805,2.53962,16.0475,2.93,15.657L5.051,13.536C5.4394,13.1339,6.08206,13.1283,6.47739,13.5236C6.87273,13.9189,6.86714,14.5616,6.465,14.95L4.345,17.071C3.95439,17.462,3.32061,17.462,2.93,17.071ZM13.536,6.464C13.1456,6.0735,13.1456,5.4405,13.536,5.05L15.656,2.929C16.0465,2.53826,16.6798,2.53803,17.0705,2.9285C17.4612,3.31897,17.4615,3.95226,17.071,4.343L14.95,6.464C14.5595,6.85438,13.9265,6.85438,13.536,6.464Z"
              fill="#D8D8D8" fill-opacity="1" />
          </svg>
        </div>
      </button>
    </div>

  </section>
  <footer><img src='<?php echo $theme_dir ?>/image/copyright-fill.png' />2022 Powered by 落幕</footer>
</body>
<script src = "<?php echo $libs?>/Other/ClipBoard.min.js"></script>
<script>
	var isSupported = ClipboardJS.isSupported();
    document.querySelector(".ok").onclick = function () {
    document.querySelector(".ok").style.display = 'none'
    document.querySelector(".load").style.display = 'block'
    var load = document.getElementById("load");
    var num = <?php echo $sleep; ?>;//区分登录和匿名

    //存在备用链接时点击直接打开主链接
    if (document.getElementById('standby')) {
        clearInterval(timer);load.innerText = "跳转中";
        location.href = document.querySelector(".main").href;
        return;
    };
    
    var timer = setInterval(function () {
        num --;
        load.innerText = "打开中" + num ;
        if(num <= 1){
            clearInterval(timer);load.innerText = "跳转中";
            location.href = document.querySelector(".main").href;//跳转到第一个链接
        }
    },1000)
  }
  document.querySelectorAll(".copy").forEach(el => {
    el.onclick = function (event) {
        if(isSupported){
			ClipboardJS.copy(el.dataset.copy);
            alt('拷贝成功')
		}else{
			alt('拷贝失败')
		}
    console.log(el.dataset.copy);
    }
  })

  //自己封装的弹出框
  function alt(text) {
    const t = document.createElement("div")
    t.innerText = text;
    Object.assign(t.style, {
      position: 'fixed',
      maxWidth: '300px',
      top: '50px',
      left: '0px',
      right: '0px',
      margin: '0 auto',
      color: '#000',
      background: '#fff',
      boxShadow: '0px 3px 4px rgba(197, 197, 197, 0.115)',
      padding: '15px 20px',
      borderRadius: '8px',
      transition: 'all .5s',
      opacity: 0,
      transform: 'translateY(-10px)'
    })
    document.body.append(t)
    setTimeout(_ => {
      t.style.transform = 'translateY(10px)'
      t.style.opacity = 1;
    }, 100)
    setTimeout(_ => {
      t.style.transform = 'translateY(-10px)'
      t.style.opacity = 0;
    }, 3000)
  }
</script>

</html>
