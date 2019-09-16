<?php /* Smarty version 2.6.13, created on 2017-11-10 00:28:34
         compiled from purchases/views.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo @URL_ADMIN_THEM; ?>
calendar/ipopeng.htm" 
scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; left:-500px; top:0px;">
</iframe>
  
<div id="page-wrapper">
<div class="row">
<div class="col-lg-12">
    <h1 class="page-header"><a href="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=unsession" ><i class="fa fa-home"></i> <?php echo $this->_tpl_vars['main_content']; ?>
</a></h1>
</div>
</div>
<!--Insert-->
<?php if ($this->_tpl_vars['check_shop'] == 1): ?>
<div class="row shows_insert" <?php if ($this->_tpl_vars['id_edit']): ?>style="display:block"<?php else: ?>style="display:none"<?php endif; ?>>
<div class="col-lg-12">
<div class="panel panel-default">
    <div class="panel-heading heading_title">
        <i class="fa fa-plus-circle fa-fw"></i> <?php if ($this->_tpl_vars['id_edit']):  echo @langcms_capnhat;  else:  echo @langcms_them;  endif; ?> <?php echo $this->_tpl_vars['main_name']; ?>

    </div>
    <div class="panel-body">
    <form id="frm_admin" name="frm_admin" method="post"  action="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=insert<?php echo $this->_tpl_vars['url_edit']; ?>
" >
    <div class="col-lg-6">
    <table class="table_insert">
    <thead>
        <tr>
            <td align="right"><span><?php echo @langcms_carthvt; ?>
 <em>*</em></span></td>
            <td><input type="text" class="check_input" name="firstname"  id="firstname" value="<?php echo $this->_tpl_vars['rs_edit']['name']; ?>
" /></td>
        </tr>
        <tr>
            <td align="right"><span>Mobile <em>*</em></span></td>
            <td><input type="text" class="check_input" name="mobile"  id="mobile" value="<?php echo $this->_tpl_vars['rs_edit']['mobile']; ?>
" /></td>
        </tr>
        <tr>
            <td align="right"><span>Email</span></td>
            <td><input type="text" class="check_input" name="email"  id="email" value="<?php echo $this->_tpl_vars['rs_edit']['email']; ?>
" /></td>
        </tr>
       
        <tr>
            <td align="right"><span>Address</span></td>
            <td><input type="text" class="check_input" name="address"  id="address" value="<?php echo $this->_tpl_vars['rs_edit']['address']; ?>
" /></td>
        </tr>
        <tr>
           <td align="right" valign="top"><span><?php echo @langcms_cartghichu; ?>
</span></td>
           <td colspan="3"><textarea class="form-control" rows="3" name="message" id="message"><?php echo $this->_tpl_vars['rs_edit']['message']; ?>
</textarea> </td>
        </tr>
        <tr>
            <td class="left"></td>
            <td class="center">
            <?php if ($this->_tpl_vars['rs_edit']['coupon_status'] < 3): ?>
            <button type="submit" name="submit" id="submit" value="submit" class="bg_edit"><?php echo @langcms_capnhat; ?>
 </button>
            <?php endif; ?>
                        <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_limit'];  echo $this->_tpl_vars['url_order']; ?>
" class="status_undo"><i class="fa fa-undo"></i> <?php echo @langcms_quaylai; ?>
</a>
            </td>
        </tr>
      </thead>  
    </table>
    </div>
    <div class="col-lg-6">
    <table class="table_insert">
    <thead>       
       <tr>
           <td align="right"><span>Jobseeker:</span></td>
           <td colspan="3"><strong><a href="<?php echo @URL_ADMIN; ?>
?module=jobseekers&main=insert&id_edit=<?php echo $this->_tpl_vars['rs_edit']['coupon_id']; ?>
" target="_blank" ><?php echo $this->_tpl_vars['rs_edit']['jobseeker_name']; ?>
</a></strong></td>
        </tr>
        <tr>
           <td align="right"><span>Jobseeker title:</span></td>
           <td colspan="3"><strong style="color:#F60"><?php echo $this->_tpl_vars['rs_edit']['jobseeker_title']; ?>
</strong></td>
        </tr>
      
        <tr>
           <td align="right"><span><?php echo @langcms_sptimma; ?>
:</span></td>
           <td colspan="3"><strong style="color:#F60"><?php echo $this->_tpl_vars['rs_edit']['coupon_id']; ?>
</strong></td>
        </tr>
      
      </thead>  
    </table>
    </div>

    </form>
    </div>
</div>
</div>
</div>
<?php endif; ?>

<div class="row">
<!--Search-->
<form name="frm_search" method="post" action="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=search" class="search_date">
<div class="col-lg-2">
<div class="input-group custom-search-form">
	<input name="startdate" class="form-control" type="text" id="startdate" value="" placeholder="<?php echo @langcms_carttn; ?>
"  />
    <span class="input-group-btn">
        <button class="btn btn-default" name="btn" type="button" onclick="if(self.gfPop)gfPop.fPopCalendar(document.frm_search.startdate);return false;">
        <i class="fa fa-angle-double-down"></i>
        </button>
    </span>
</div>
</div>
<div class="col-lg-2">
<div class="input-group custom-search-form">
	<input name="enddate" class="form-control" type="text" id="enddate" value="" placeholder="<?php echo @langcms_cartdn; ?>
" />
    <span class="input-group-btn">
        <button class="btn btn-default" name="btn" type="button" onclick="if(self.gfPop)gfPop.fPopCalendar(document.frm_search.enddate);return false;">
        <i class="fa fa-angle-double-down"></i>
        </button>
    </span>
</div>
</div>
<div class="col-lg-3">
<div class="input-group custom-search-form">
    <input type="text" class="form-control" placeholder="Search..." name="name_search" id="name_search" value="" >
    <span class="input-group-btn">
        <button class="btn btn-default" type="submit" name="submit" id="submit">
        <i class="fa fa-search"></i>
        </button>
    </span>
</div>
</div>
    <div class="col-lg-2 click_right" style="float:right; text-align:right">
    <a href="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=unsession" class="bg_off" > <i class="fa fa-refresh"></i> Refresh</a> 
    </div>
</form> 
<!--Views-->    
<div class="col-lg-12">
<form name="frm_news" method="POST" >
<div class="panel panel-default">
<div class="panel-heading">
    <div class="row">
    <div class="col-lg-5 heading_title">
        <i class="fa fa-windows"></i> <?php echo $this->_tpl_vars['main_content']; ?>
  <strong>( <?php echo $this->_tpl_vars['numf']; ?>
 <?php echo $this->_tpl_vars['main_name']; ?>
 )</strong>
    </div>   
    <div class="col-lg-7 click_right">
    	<?php if ($this->_tpl_vars['action_delete']): ?>
        <a href="javascript:void(0);" onclick="del_news('frm_news');" class="bg_del">
        <i class="fa fa-trash-o"></i> <?php echo @langcms_xoa; ?>
</a>  
        <?php endif; ?>
        <?php if ($this->_tpl_vars['action_edit']): ?>
        <a href="javascript:void(0);" onClick="update_order('frm_news');"class="bg_edit">
        <i class="fa fa-pencil-square-o"></i> <?php echo @langcms_capnhat; ?>
</a></li>
        <?php endif; ?>
        
        
        
         
        
    </div>
    </div>
</div>
    
<div class="panel-body">
    <ul class="table_ul">
        <li class="lileft">
            <select class="limit_option" onchange="MM_jumpMenu('parent',this,0)" >
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_status'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order']; ?>
&limit=10" <?php if ($this->_tpl_vars['limit'] == 20): ?>selected<?php endif; ?>>10</option>
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_status'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order']; ?>
&limit=20" <?php if ($this->_tpl_vars['limit'] == 20): ?>selected<?php endif; ?>>20</option>
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_status'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order']; ?>
&limit=50" <?php if ($this->_tpl_vars['limit'] == 50): ?>selected<?php endif; ?>>50</option>
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_status'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order']; ?>
&limit=100" <?php if ($this->_tpl_vars['limit'] == 100): ?>selected<?php endif; ?>>100</option>
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_status'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order']; ?>
&limit=200" <?php if ($this->_tpl_vars['limit'] == 200): ?>selected<?php endif; ?>>200</option>
           </select>
        </li>
    	<li class="lileft" style="width:40%"><div class="paging_news"><?php echo $this->_tpl_vars['paging']; ?>
</div></li>
        <li >
        <select class="limit_option mw_160"  onchange="MM_jumpMenu('parent',this,0)" >
        	<option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order'];  echo $this->_tpl_vars['url_limit']; ?>
"><?php echo @langcms_cartlttt; ?>
</option>
            <?php $_from = $this->_tpl_vars['rs_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_st'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_st']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs_st']):
        $this->_foreach['rs_st']['iteration']++;
?>	
            <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order'];  echo $this->_tpl_vars['url_limit']; ?>
&status=<?php echo $this->_tpl_vars['rs_st']['coupon_status']; ?>
" 
            <?php if ($this->_tpl_vars['status'] == $this->_tpl_vars['rs_st']['coupon_status']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['rs_st']['status_name']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
         </select>
        </li>
               
    </ul>
    <table class="table_views table-striped table-hover">
    <thead>
        <tr class="two">
          <td align="center"> ID
          <div class="order">
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_status'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_limit']; ?>
&order=id_tem&sc=asc"><i class="fa fa-caret-up"></i></a>  
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_status'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_limit']; ?>
&order=id_tem&sc=desc"><i class="fa fa-caret-down"></i></a>
          </div>
          </td>
          <td class="mw_200"><?php echo @langcms_cartttd; ?>
</td>
          <td><?php echo @langcms_cartttd; ?>
</td>
          <td><?php echo @langcms_trangthai; ?>
</td>
          <td align="center"><label><input type="checkbox" data-toggle="checkall" data-target="input[id=checks]" /></label></td>
        </tr>
    </thead>
    <tbody>
        <?php $_from = $this->_tpl_vars['rs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs']):
        $this->_foreach['rs']['iteration']++;
?>
          <tr>
          <td align="center" class="mw_80">
          <?php echo $this->_tpl_vars['rs']['id_tem']; ?>

          <?php if ($this->_tpl_vars['action_edit']): ?>
          <p><a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_limit'];  echo $this->_tpl_vars['url_order']; ?>
&id_edit=<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" class="status_edit"><i class="fa fa-pencil-square-o"></i></a></p>
          <?php endif; ?>
          </td>
          <td valign="top" style="line-height:19px">
          <i class="name_orders" ><?php echo @langcms_cartmadh; ?>
</i>: <strong><?php echo $this->_tpl_vars['rs']['coupon_code']; ?>
</strong><br />
          <i class="name_orders"><?php echo @langcms_carttngaym; ?>
</i>: <i><?php echo $this->_tpl_vars['rs']['ngay_mua']; ?>
</i><br />
          </td>
          
          <td valign="top">
           <i class="name_orders">Jobseeker</i>: <input type="text" style="font-weight:bold; color:blue;" name="mobile<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['jobseeker_name']; ?>
" class="orders_edit"  /><br />
            <i class="name_orders">Job Title</i>: <input type="text" style="font-weight:bold;" name="mobile<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['jobseeker_title']; ?>
" class="orders_edit"  /><br />
           <i class="name_orders">ID product</i>: <strong><?php echo $this->_tpl_vars['rs']['coupon_id']; ?>
</strong><br />
          <i class="name_orders">Name</i>: <input type="text" name="firstname<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['name']; ?>
" style="font-weight:bold" /><br />
          <i class="name_orders">Phone</i>: <input type="text" name="mobile<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['mobile']; ?>
" class="orders_edit"  /><br />
          <i class="name_orders">Email</i>: <input type="text" name="email<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['email']; ?>
" class="orders_edit"/><br />

          </td>
          <td class="mw_150" valign="top" >
          <select class="limit_option mw_150 orders_edit" name="coupon_status<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" style="font-weight:bold; padding:3px" >
          <?php $_from = $this->_tpl_vars['rs_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_st'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_st']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs_st']):
        $this->_foreach['rs_st']['iteration']++;
?>	
          <option value="<?php echo $this->_tpl_vars['rs_st']['coupon_status']; ?>
" <?php if ($this->_tpl_vars['rs']['coupon_status'] == $this->_tpl_vars['rs_st']['coupon_status']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['rs_st']['status_name']; ?>
</option>
          <?php endforeach; endif; unset($_from); ?>
          </select>
          <?php $_from = $this->_tpl_vars['rs_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_sta'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_sta']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs_sta']):
        $this->_foreach['rs_sta']['iteration']++;
?>	
          <p style="margin:0 0 0 8px">
          <?php if ($this->_tpl_vars['rs']['coupon_status'] == $this->_tpl_vars['rs_sta']['coupon_status']): ?>
              <a style="color:#<?php echo $this->_tpl_vars['rs_sta']['status_color']; ?>
; font-weight:bold"><i class="fa fa-check-square" style="font-size:80%"></i> 
              <?php echo $this->_tpl_vars['rs_sta']['coupon_status']; ?>
 <?php echo $this->_tpl_vars['rs_sta']['status_name']; ?>
</a>
          <?php else: ?>
              <a href="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=status&id=<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
&status=<?php echo $this->_tpl_vars['rs_sta']['coupon_status']; ?>
" style="color:#<?php echo $this->_tpl_vars['rs_sta']['status_color']; ?>
"> 
              <i class="fa fa-caret-right"></i>  &nbsp;<?php echo $this->_tpl_vars['rs_sta']['coupon_status']; ?>
 <?php echo $this->_tpl_vars['rs_sta']['status_name']; ?>
</a>
          <?php endif; ?>
          </p>
          <?php endforeach; endif; unset($_from); ?>
          </td>
          <td align="center"><?php if ($this->_tpl_vars['rs']['coupon_status'] != 4): ?><label><input type="checkbox" id="checks" name="checkbox_id[]" value="<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
"  /></label><?php endif; ?></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
    </tbody>
    </table>  
</div>
</div>
</form>  
</div>

</div>

</div>
