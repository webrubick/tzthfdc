		
		<link href="public/css/portal/house.common.css" rel="stylesheet" type="text/css">
		
<?php if (is_login()) : ?>

        <div class="session-module">
		    <div class="fixed-sub-container">
		        您好，<?php print_r($true_name); ?>！
		        [<a id="session-logout" href="javascript:logout();" class="session-btn">注销</a>]
		        &nbsp;|&nbsp;
		        <a href="<?php print_r($adminhouse_url); ?>" class="session-btn" target="_blank">我的房源</a>
		    </div>
		</div>
		
<?php else : ?>

        <div class="session-module">
		    <div class="fixed-sub-container">
		        <a href="javascript:;" class="session-btn">登录 | 注册</a>
		        
		        <div class="session-dropdown" style="display: none;">
		            <div class="op">
		                <a href="javascript:;" onclick="hideSessionDropdown();">
		                    <img src="public/img/portal/close.png" />
		                </a>
		            </div>
		            
		            <div id="dltc_main">
		                <ul>
		                    <li class="session-personal">
		                        <ul class="tab">
                    	            <li id="tab-register" tabindex="0">注册</li><li id="tab-login" tabindex="0">登录</li>        	    
                      	        </ul>
                      	        <div class="content">
                      	            <div id="content-register" style="display:block;">
                                        <form id="registForm" method="post">
                                            <label for="inputUsername">账户</label>
                                            <input type="text" name="user_name" id="inputUsername" >
                                            <br/>
                                            
                                            <label for="inputPassword">密码</label>
                                            <input type="password" name="password" id="inputPassword" >
                                            <br/>
                                            
                                            <label for="inputConfirmPwd">确认密码</label>
                                            <input type="password" name="confirm_pwd" id="inputConfirmPwd" >
                                            <br/>
                                            
                                            <label for="inputTruename">姓名</label>
                                            <input type="text" name="true_name" id="inputTruename" >
                                            <br/>
                                            
                                            <label for="inputContact">联系方式</label>
                                            <input type="text" name="contact_mobile" id="inputContact" >
                                            <br/>
                                            
                                            <label for="inputCode">验证码</label>
                                            <input type="text" name="code" id="inputCode" >
                                            <img src="/register_vercode" id="registcode" align="absmiddle" style="height:22px">
                                            <span class="kbq"><a href="javascript:;" id="change_registcode">看不清楚？换一张</a></span>&nbsp;&nbsp;
                                            <br/>
                                            
                                            <input type="button" value="立即注册" onclick="register(this)">
                                        </form>
                                    </div>
                                    
                                    <div id="content-login" style="display:none;">
                                	    <form id="loginForm" method="post">
                                	        <label for="inputUsername">账户</label>
                                            <input type="text" name="user_name" id="inputUsername" >
                                            <br/>
                                            
                                            <label for="inputPassword">密码</label>
                                            <input type="password" name="password" id="inputPassword" >
                                            <br/>
                                            
                                            <label for="inputCode">验证码</label>
                                            <input type="text" name="code" id="inputCode" >
                                            <img src="/login_vercode" id="logincode" align="absmiddle" style="height:22px">
                                            <span class="kbq"><a href="javascript:;" id="change_logincode">看不清楚？换一张</a></span>&nbsp;&nbsp;
                                            <br/>
                                            
                                            <input type="button" value="立即登录" onclick="login(this)" > 
                                        </form>
                                    </div>
                      	        </div>
		                    </li>
		                    
		                    <li class="session-admin">
		                        <div id="dltc_main_r">
		                            我是经纪人<br>
                                    <a href="/admin/login" target="_blank">从这里登录</a>
                                </div>
		                    </li>
		                </ul>
                    </div>
		        </div>
		        
		        
		    </div>
		</div>
		
<?php endif ; ?>
		
		
		
		<script type="text/javascript">
        var sessionBtn = $('.session-module .session-btn');
        var sessionDropdown = $('.session-dropdown');
        sessionBtn.hover(function() {
            if (sessionDropdown.is(":hidden")) {
                sessionDropdown.show();
            }
        }, function() {
            
        });
        
        function hideSessionDropdown() {
            sessionDropdown.hide();
        }
        
        var tabRegister = $('#tab-register');
        var contentRegister = $('#content-register');
        var tabLogin = $('#tab-login');
        var contentLogin = $('#content-login');
        tabRegister.data('next', tabLogin);
        tabRegister.data('content', contentRegister);
        tabLogin.data('next', tabRegister);
        tabLogin.data('content', contentLogin);
        // init
        tabRegister.addClass('hover');
        contentRegister.show();
        
        function changeSessionTab() {
            var me = $(this);
            if (me.hasClass('hover')) {
                return ;
            }
            var next = me.data('next');
            next.removeClass('hover');
            next.data('content').hide();
            me.addClass('hover');
            me.data('content').show();
        }
        tabRegister.click(changeSessionTab);
        tabLogin.click(changeSessionTab);
        
        
        function login() {
            var formobj=$("#loginForm");
        	var loginname=formobj.find("input[name='user_name']");
        	
        	if(loginname.val()==""){
        		loginname.focus();
        		showToast("用户名不能为空");
        		return false;
        	}
        	var postData = 'user_name=' + $.urlencode(loginname.val());
        	
        	var password=formobj.find("input[name='password']");
        	if(password.val()==""){
        		password.focus();
        		showToast("密码不能为空");
        		return false;
        	}
        	postData += '&password=' + hex_md5(password.val());
        	
        	var logincode=formobj.find("input[name='code']");
        	if(logincode.val()==""){
        		logincode.focus();
        		showToast("验证码不能为空");
        		return false;
        	}
        	postData += '&code=' + $.urlencode(logincode.val());
        	
        	simplePost('/login', postData, {
        	    ok : function() {
        	        (top || window).location.reload();
        	    }
        	});
        }
        
        function register() {
            var formobj=$("#registForm");
        	var loginname=formobj.find("input[name='user_name']");
        	if(loginname.val()==""){
        		loginname.focus();
        		showToast("用户名不能为空");
        		return false;
        	}
        	var postData = 'user_name=' + $.urlencode(loginname.val());
        	
        	var password=formobj.find("input[name='password']");
        	if(password.val()==""){
        		password.focus();
        		showToast("密码不能为空");
        		return false;
        	}
        	var confirm_pwd=formobj.find("input[name='confirm_pwd']");
        	if(confirm_pwd.val()==""){
        		confirm_pwd.focus();
        		showToast("确认密码不能为空");
        		return false;
        	}
        	if (password.val() != confirm_pwd.val()) {
        	    confirm_pwd.focus();
        		showToast("两次密码不一致");
        		return false;
        	}
        	postData += '&password=' + hex_md5(password.val());
        	
        	var truename=formobj.find("input[name='true_name']");
        	if(truename.val()==""){
        		truename.focus();
        		showToast("姓名不能为空");
        		return false;
        	}
        	postData += '&true_name=' + $.urlencode(truename.val());
        	
        	var contact=formobj.find("input[name='contact_mobile']");
        	if(contact.val()==""){
        		contact.focus();
        		showToast("联系方式不能为空");
        		return false;
        	}
        	postData += '&contact_mobile=' + $.urlencode(contact.val());
        	
        	var logincode=formobj.find("input[name='code']");
        	if(logincode.val()==""){
        		logincode.focus();
        		showToast("验证码不能为空");
        		return false;
        	}
        	postData += '&code=' + $.urlencode(logincode.val());
        	
        	simplePost('/register', postData, {
        	    ok : function() {
        	        (top || window).location.reload();
        	    }
        	});
        }
        
        function logout() {
            simplePost('/logout', '', {
        	    ok : function() {
        	        (top || window).location.reload();
        	    }
        	});
        }
        
        $("#change_registcode").click(function(){
    		$("#registcode").get(0).src="/register_vercode?rand="+Math.random();
    	});
        
        $("#change_logincode").click(function(){
    		$("#logincode").get(0).src="/login_vercode?rand="+Math.random();
    	});
	    </script>
        <script type="text/javascript" src="public/scripts/md5.js"></script>
        