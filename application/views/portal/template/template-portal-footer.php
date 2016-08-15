
    <footer>
    	<div>
    		<span class=“copyright”>© <?php print_r(WEBSITE_C_YEAR); ?> <?php echo WEBSITE_NAME; ?></span>
    	</div>
    	<div>
    		<span>联系方式： <?php echo WEBSITE_CONTACT; ?></span>
    	</div>
    	<div>
    		<span>联系地址： <?php echo WEBSITE_COM_ADDRESS; ?></span>
    	</div>
    </footer>
    
    <style>
        .side-float {
            position: fixed; top: 20%;
            box-shadow:2px 2px 3px #aaaaaa;
            text-align: center;
            font-size: 12px;
        }
        .side-float h4 {
            margin: 0;
            background: #888; color: #fff; border:1px solid #BFBFBF;
            line-height: 2em;
            font-size: 1.2em;
        }
        .side-float p { margin: 0; line-height: 1.75em; }
        .private-house { margin: 10px 0 0 0; }
        .private-house a {
            display: block;
            text-decoration: none;
            margin: .5em .5em;
            color: #fff;
            line-height: 2.5em;
            transition: all .3s ease;
        }
        .private-house a:hover {
            transform: scale(1.2);
            -ms-transform: scale(1.2);
            -moz-transform: scale(1.2);
            -webkit-transform: scale(1.2);
            -o-transform: scale(1.2);
        }
    </style>
    <div class="qr-panel side-float">
        <h4>
            二维码扫描
        </h4>
        <img src="public/img/portal/qr.jpg" style="width: 120px"/>
        <p>
            微信联系人
        </p>
        
<?php // 如果用户登录了，则不显示这一项 ?>
<?php if (!is_login()) : ?>
        <div class="private-house">
            <a href="other/addsell" style="background: #f46">
            我要卖房
            </a>
            <a href="other/addrent" style="background: #f46">
            我要出租
            </a>
        </div>
<?php endif; ?>
    </div>

<?php if (isset($realtors) && !empty($realtors)) : ?>
    <style>
        #side-online-kefu { right: 0; background: #fff; }
        #side-online-kefu > * { position: relative; display: block;}
        #side-online-kefu ul { width: 150px; max-height: 500px; line-height: 2.5; overflow: auto; }
        #side-online-kefu ul li { display: inline-block; vertical-align: top; }
        #side-online-kefu ul img, #side-online-kefu ul p { max-width: 60px }
    </style>
    <div id="side-online-kefu" class="side-float">
        <div>
        <h4>在线客服</h4>
        <ul>
<?php foreach ($realtors as $realtor) : ?>
<?php if (isset($realtor['qqchat']) && !empty($realtor['qqchat'])) : ?>
            <li>
                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php print_r($realtor['qqchat']); ?>&site=tzfc.com&menu=yes" target="_blank">
                    <img border="0" src="http://wpa.qq.com/pa?p=2:<?php print_r($realtor['qqchat']); ?>:41" title="我是<?php print_r($realtor['true_name']); ?>，请给我发消息"/>
                </a>
                <p><?php echo $realtor['true_name'];?></p>
            </li>
<?php endif; ?>
<?php endforeach; ?>
        </ul>
        </div>
    </div>
<?php endif; ?>
	</body>
</html>