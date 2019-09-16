<?php /* Smarty version 2.6.13, created on 2017-11-10 00:22:42
         compiled from jquery.html */ ?>
<?php if ($this->_tpl_vars['main_search'] != 'search'):  echo '
	<script language="javascript">
        var r={ \'notnumbers\':/[^\\d]/g }
        function valid(o,w){ o.value = o.value.replace(r[w],\'\');  }
    </script>
'; ?>

<?php echo '
	<script type="text/javascript" charset="utf-8">
		function MM_jumpMenu(targ,selObj,restore){ 
		eval(targ+".location=\'"+selObj.options[selObj.selectedIndex].value+"\'"); if 
		(restore) selObj.selectedIndex=0; }
    </script>
'; ?>


<?php echo '
	<script type="text/javascript" charset="utf-8">
		jQuery(document).ready(function() 
		{
			jQuery( \'form#frm_admin\').submit(function() 
			{
				jQuery( \'form#frm_admin .error_note\').remove();
				var hasError = false;
				
				jQuery( \'.check_input\').each(function(){			
					if(jQuery.trim(jQuery(this).val()) == \'\') 
					{
						var labelText = jQuery(this).parent().prev(\'label\').text().replace(\':\',\'\');
						var placeholder = jQuery(this).attr(\'placeholder\');
						jQuery(this).parent().append( \'<span class="error_note">Chưa nhập nội dung \'+labelText+\'</span>\' );
						jQuery(this).addClass( \'inputError\' );
						hasError = true;
					} 
					else{jQuery(this).removeClass( \'inputError\' );}
				});
				
				jQuery( \'.check_email\').each(function(){			
					var emailReg = /^([\\w-\\.]+@([\\w-]+\\.)+[\\w-]{2,4})?$/;
					if(!emailReg.test(jQuery.trim(jQuery(this).val()))) 
					{
						jQuery(this).parent().append( \'<span class="error_note">Email không đúng</span>\' );
						jQuery(this).addClass( \'inputError\' );
						hasError = true;
					}
					else{jQuery(this).removeClass( \'inputError\' );}
				});
				
				jQuery( \'.check_select\').each(function(){			
					if(jQuery.trim(jQuery(this).val()) == \'0\') 
					{
						var labelText = jQuery(this).parent().prev(\'label\').text().replace(\':\',\'\');
						var placeholder = jQuery(this).attr(\'placeholder\');
						jQuery(this).parent().append( \'<span class="error_note">Chưa nhập nội dung \'+labelText+\'</span>\' );
						jQuery(this).addClass( \'inputError\' );
						hasError = true;
					} 
					else{jQuery(this).removeClass( \'inputError\' );}
				});
				
				if(hasError) {return false;}
			});
		});
    </script>
'; ?>


<?php echo '
	<script type="text/javascript" charset="utf-8">
        $jq172  = jQuery.noConflict();
        $jq172(document).ready(function() 
        {
              $jq172(\'#check-all\').click(function(){
                $jq172("input:checkbox").attr(\'checked\', true);
              });
              
              $jq172(\'#uncheck-all\').click(function(){
                $jq172("input:checkbox").attr(\'checked\', false);
              });
        });
        
        function del_news(frmName)
        {
            var frm = document.forms[frmName];
            var items = document.getElementsByName("checkbox_id[]");
            var enable = false;
            for (var i=0; i<items.length; i++)
            {
                if (items[i].checked==true)
                {
                    enable = true;
                    break;
                }
            }
            if (frm && enable)
                {
                    $jq172.prompt(\'Bạn muốn xóa những mục đã chọn!\',{ 
                        buttons:{Ok:true, Cancel:false},
                        callback: function(v,m){
                    
                        if(v){
                        frm.action = "';  echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url'];  echo '&main=delete";
                        frm.submit();
                        }
                        else{}
                        }
                });
            }
            else
                frm.onclick = $jq172.prompt(\'Bạn chưa chọn mục cần xóa!\');		
            return false;
        }
            
        function status_on(frmName)
        {
            var frm = document.forms[frmName];
            var items = document.getElementsByName("checkbox_id[]");
            var enable = false;
            for (var i=0; i<items.length; i++)
            {
                if (items[i].checked==true)
                {
                    enable = true;
                    break;
                }
            }
            if (frm && enable)
                {
                    $jq172.prompt(\'Bạn muốn hiển thị những mục đã chọn!\',{ 
                        buttons:{Ok:true, Cancel:false},
                        callback: function(v,m){
                    
                        if(v){
                        frm.action = "';  echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url'];  echo '&main=status_on";
                        frm.submit();
                        }
                        else{}
                        }
                });
            }
            else
                frm.onclick = $jq172.prompt(\'Bạn chưa chọn mục cần kích hoạt!\');		
            return false;
        }
        
        function status_off(frmName)
        {
            var frm = document.forms[frmName];
            var items = document.getElementsByName("checkbox_id[]");
            var enable = false;
            for (var i=0; i<items.length; i++)
            {
                if (items[i].checked==true)
                {
                    enable = true;
                    break;
                }
            }
            if (frm && enable)
                {
                    $jq172.prompt(\'Bạn muốn ẩn đi những mục đã chọn!\',{ 
                        buttons:{Ok:true, Cancel:false},
                        callback: function(v,m){
                    
                        if(v){
                        frm.action = "';  echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url'];  echo '&main=status_off";
                        frm.submit();
                        }
                        else{}
                        }
                });
            }
            else
                frm.onclick = $jq172.prompt(\'Bạn chưa chọn mục cần vô hiệu!\');		
            return false;
        }
        
        function update_order(frmName)
        {
            var frm = document.forms[frmName];
            var items = document.getElementsByName("checkbox_id[]");
            var enable = false;
            for (var i=0; i<items.length; i++)
            {
                if (items[i].checked==true)
                {
                    enable = true;
                    break;
                }
            }
            if (frm && enable)
                {
                    $jq172.prompt(\'Bạn muốn cập nhật những mục đã chọn!\',{ 
                        buttons:{Ok:true, Cancel:false},
                        callback: function(v,m){
                    
                        if(v){
                        frm.action = "';  echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url'];  echo '&main=update_order";
                        frm.submit();
                        }
                        else{}
                        }
                });
            }
            else
                frm.onclick = $jq172.prompt(\'Bạn chưa chọn mục cần cập nhật!\');		
            return false;
        }
    </script>
'; ?>


<?php echo '
    <script> 
    $(document).ready(function(){
        $("hx").filter(".exp_listcate").click(function(){
            $(".nav_hp").fadeToggle(100);
        });
        
        $("a").filter(".name_insert").click(function(){
            $(".shows_insert").slideToggle("50");
        });	
    });
    </script>
'; ?>

<?php echo '
<script type="text/javascript">
	$(document).ready(function() {
		$(".check_url").keyup(function (e) 
		{
			$(this).val($(this).val().replace(/\\s/g, \'-\'));
		});	
	});
</script>
'; ?>

<?php echo '
<script type="text/javascript">
	$(document).ready(function() {
		$(".check_num").keyup(function (e) 
		{
			$(this).val($(this).val().replace(/[^\\d]/g, \'\'));
		});	
	});
</script>
'; ?>


<!--porders-->
<?php echo '
    <script type="text/javascript" charset="utf-8">
         $jq172  = jQuery.noConflict();
        function update_orders_detail(frmName)
        {
            var frm = document.forms[frmName];
            var items = document.getElementsByName("checkbox_id[]");
            var enable = false;
            for (var i=0; i<items.length; i++)
            {
                if (items[i].checked==true)
                {
                    enable = true;
                    break;
                }
            }
            $jq172.prompt(\'You want to update the selected item!\',{ 
                    buttons:{Ok:true, Cancel:false},
                    callback: function(v,m){
                
                    if(v){
                    frm.action = "';  echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url'];  echo '&main=update_detail";
                    frm.submit();
                    }
                    else{}
                    }
            });
            
            return false;
        }
    </script>
'; ?>
 
 
<!--role-->
<?php echo '
<script type="text/javascript" charset="utf-8">
	 $jq172  = jQuery.noConflict();
	function update_action(frmName)
	{
		var frm = document.forms[frmName];
		var items = document.getElementsByName("checkbox_id[]");
		var enable = false;
		for (var i=0; i<items.length; i++)
		{
			if (items[i].checked==true)
			{
				enable = true;
				break;
			}
		}
		$jq172.prompt(\'You want to update the selected item!\',{ 
				buttons:{Ok:true, Cancel:false},
				callback: function(v,m){
			
				if(v){
				frm.action = "';  echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url'];  echo '&main=action_user";
				frm.submit();
				}
				else{}
				}
		});
		
		return false;
	}
</script>
'; ?>


<!--option-->
<?php echo '
<script type="text/javascript" charset="utf-8">
	 $jq172  = jQuery.noConflict();
	function update_option(frmName)
	{
		var frm = document.forms[frmName];
		var items = document.getElementsByName("checkbox_id[]");
		var enable = false;
		for (var i=0; i<items.length; i++)
		{
			if (items[i].checked==true)
			{
				enable = true;
				break;
			}
		}
		$jq172.prompt(\'You want to update the selected item!\',{ 
				buttons:{Ok:true, Cancel:false},
				callback: function(v,m){
			
				if(v){
				frm.action = "';  echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url'];  echo '&main=upoption";
				frm.submit();
				}
				else{}
				}
		});
		
		return false;
	}
</script>
'; ?>

<?php endif; ?> 
 