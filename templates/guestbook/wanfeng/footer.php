	<!-- 底部 -->
	<div class="foot">
		<div class="footer">
			<div class="left">
				<div class="leftimg">
					<img data-src="<?php echo $theme_config['logo']; ?>" alt="logo">
				</div>
				<a><?php echo $site['keywords']; ?></a>
			</div>
			<div class="center">
				<div class="biaoqian"><ul></ul></div>
				<div class="banquan" style="color: #969CA9;">
				    <?php 
				    if(!empty($copyright)){
				        echo "<a>{$copyright}</a> · ";
				    }
				    if(!empty($ICP)){
				        echo "<a>{$ICP}</a> · ";
				    }
				    if(!empty($theme_config['disclaimers'])){
				        echo "<a>{$theme_config['disclaimers']}</a>";
				    }
				    if(!empty($site['custom_footer'])) {
				        echo '<br />'.$site['custom_footer'];
				    }
				    if(!empty($global_config['global_footer'])) {
				        echo '<br />'.$global_config['global_footer'];
				    }
				    ?>
				</div>
				<div class="tb"></div>
			</div>
			<div class="right"><ul></ul></div>
		</div>
	</div>
	<div class="tongji">
		<div class="tongjinr"><?php echo $theme_config['tongji'];?></div>
	</div>
	<!--底部波浪开始-->
	<div class="wiiuii_layout">
		<svg class="editorial" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none">
			<defs>
				<path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
			</defs>
			<g class="parallax">
				<use xlink:href="#gentle-wave" x="50" y="0" fill="#4579e2" />
				<use xlink:href="#gentle-wave" x="50" y="3" fill="#3461c1" />
				<use xlink:href="#gentle-wave" x="50" y="6" fill="#2d55aa" />
			</g>
		</svg>
	</div>
	<!--底部波浪结束-->