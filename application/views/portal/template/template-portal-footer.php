	
    
    <footer>
    	<div>
    		<span class=“copyright”>© <?php print_r(WEBSITE_C_YEAR); ?> <?php echo WEBSITE_NAME; ?></span>
    	</div>
    </footer>
    
    <style>
        .qr-panel {
            position: fixed;
            top: 20%;
            box-shadow:2px 2px 3px #aaaaaa;
            text-align: center;
            font-size: 12px;
        }
        .qr-panel h4 {
            margin: 0;
            background: #888;
            color: #fff;
            line-height: 2em;
            border:1px solid #BFBFBF;
            font-size: 1.2em;
        }
        .qr-panel p {
            margin: 0;
            line-height: 1.75em;
        }
        .private-house {
            margin: 10px 0 0 0;
        }
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
    <div class="qr-panel">
        <h4>
            二维码扫描
        </h4>
        <img src="public/img/portal/qr.png" style="width: 120px"/>
        <p>
            微信联系人
        </p>
        
        <div class="private-house">
            <a href="other/addsell" style="background: #f46">
            我要卖房
            </a>
            <a href="other/addrent" style="background: #f46">
            我要出租
            </a>
        </div>
    </div>
	</body>
</html>