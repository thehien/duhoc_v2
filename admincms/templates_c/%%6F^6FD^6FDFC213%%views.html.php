<?php /* Smarty version 2.6.13, created on 2019-01-02 11:00:04
         compiled from porders/views.html */ ?>
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
          <div class="col-lg-6" >
            <table class="table_insert">
              <thead>
                <tr>
                  <td align="right"><span><?php echo @langcms_carthvt; ?>
 <em>*</em></span></td>
                  <td><input type="text" class="check_input" name="fullname"  id="fullname" value="<?php echo $this->_tpl_vars['rs_edit']['name']; ?>
" /></td>
                </tr>
                <tr>
                  <td align="right"><span>Mobile Code</span></td>
                  <td>
                  <input type="text" class="check_input" name="mobile_code" id="mobile_code" value="<?php echo $this->_tpl_vars['rs_edit']['mobile_code']; ?>
" />
                  </td>
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
                  <td align="right"><span>Country</span></td>
                  <td>
                 <input type="text" class="check_input" name="country" id="country" value="<?php echo $this->_tpl_vars['rs_edit']['country_name']; ?>
" />
                  </td>
                </tr>
                <tr>
                  <td align="right"><span><?php echo @langcms_cartdchi; ?>
</span></td>
                  <td><input type="text" class="check_input" name="address"  id="address" value="<?php echo $this->_tpl_vars['rs_edit']['address']; ?>
" /></td>
                </tr>

               <tr>
                <td class="left"></td>
                <td class="left">
                    <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_status'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_limit'];  echo $this->_tpl_vars['url_order']; ?>
" class="status_undo">
                      <i class="fa fa-undo"></i> <?php echo @langcms_quaylai; ?>
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
                   <td align="right"><span>Payment</span></td>
                   <td>
                    <select disabled="disabled" class="select_option" name="coupon_status" id="coupon_status" style="font-weight:bold" >
                      <?php $_from = $this->_tpl_vars['rs_payment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_st'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_st']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs_st']):
        $this->_foreach['rs_st']['iteration']++;
?>	
                      <option value="<?php echo $this->_tpl_vars['rs_st']['coupon_status']; ?>
" <?php if ($this->_tpl_vars['rs_edit']['coupon_status'] == $this->_tpl_vars['rs_st']['coupon_status']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['rs_st']['status_name']; ?>
</option>
                      <?php endforeach; endif; unset($_from); ?>
                    </select>
                  </td>
                </tr>
                <tr>
               
               </tr>

             </thead>  
           </table>
         </div>
       </form>
     </div>
   </div>
 </div>
</div>

<div class="row">
  <!--Search-->
  <form name="frm_search" method="post" action="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=search" class="search_date">
    <div class="col-lg-2">
      <div class="input-group custom-search-form">
       <input type="text" class="form-control" placeholder="Email" name="email_search" id="email_search" value="" >
       <span class="input-group-btn">
        <button class="btn btn-default" type="submit" name="submit" id="submit">
          <i class="fa fa-search"></i>
        </button>
      </span>

    </div>
  </div>
  <div class="col-lg-2">
    <div class="input-group custom-search-form">
      <select class="form-control mw_160" onchange="MM_jumpMenu('parent',this,0)" >
        <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order'];  echo $this->_tpl_vars['url_limit']; ?>
">Create Date</option>
       <?php $_from = $this->_tpl_vars['rs_month']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_date'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_date']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs_date']):
        $this->_foreach['rs_date']['iteration']++;
?> 
       <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order'];  echo $this->_tpl_vars['url_limit']; ?>
&create_date=<?php echo $this->_tpl_vars['rs_date']['month']; ?>
"><?php echo $this->_tpl_vars['rs_date']['month']; ?>
</option>
       <?php endforeach; endif; unset($_from); ?>
     </select>
   </div>
 </div>
 <div class="col-lg-2">
  <div class="input-group custom-search-form">

    <select class="form-control mw_160"  onchange="MM_jumpMenu('parent',this,0)" >
     <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order'];  echo $this->_tpl_vars['url_limit']; ?>
">Translate from</option>
     <?php $_from = $this->_tpl_vars['rs_all_language']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_language'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_language']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs_language']):
        $this->_foreach['rs_language']['iteration']++;
?> 
       <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order'];  echo $this->_tpl_vars['url_limit']; ?>
&translate_from=<?php echo $this->_tpl_vars['rs_language']['id']; ?>
"><?php echo $this->_tpl_vars['rs_language']['name']; ?>
</option>
       <?php endforeach; endif; unset($_from); ?>
   </select>
 </div>
</div>
<div class="col-lg-2">
  <div class="input-group custom-search-form">
    <select class="form-control mw_160"  onchange="MM_jumpMenu('parent',this,0)" >
     <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order'];  echo $this->_tpl_vars['url_limit']; ?>
">Translate to</option>
    <?php $_from = $this->_tpl_vars['rs_all_language']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_language'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_language']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs_language']):
        $this->_foreach['rs_language']['iteration']++;
?> 
       <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order'];  echo $this->_tpl_vars['url_limit']; ?>
&translate_to=<?php echo $this->_tpl_vars['rs_language']['id']; ?>
"><?php echo $this->_tpl_vars['rs_language']['name']; ?>
</option>
    <?php endforeach; endif; unset($_from); ?>
   </select>

 </div>
</div>

<div class="col-lg-2">
  <div class="input-group custom-search-form">

   <select class="form-control mw_160"  onchange="MM_jumpMenu('parent',this,0)" >
     <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order'];  echo $this->_tpl_vars['url_limit']; ?>
">Subject Field</option>
     <?php $_from = $this->_tpl_vars['rs_all_subject_field']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_subject'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_subject']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs_subject']):
        $this->_foreach['rs_subject']['iteration']++;
?> 
       <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order'];  echo $this->_tpl_vars['url_limit']; ?>
&subject=<?php echo $this->_tpl_vars['rs_subject']['id']; ?>
"><?php echo $this->_tpl_vars['rs_subject']['category_name']; ?>
</option>
    <?php endforeach; endif; unset($_from); ?>
   </select>

 </div>
</div>

<div class="col-lg-2">
  <div class="input-group custom-search-form">
    <select class="form-control mw_160"  onchange="MM_jumpMenu('parent',this,0)" >
     <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order'];  echo $this->_tpl_vars['url_limit']; ?>
">Country</option>
      <?php $_from = $this->_tpl_vars['list_country']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_country'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_country']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs_country']):
        $this->_foreach['rs_country']['iteration']++;
?> 
       <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order'];  echo $this->_tpl_vars['url_limit']; ?>
&country=<?php echo $this->_tpl_vars['rs_country']['id']; ?>
"><?php echo $this->_tpl_vars['rs_country']['name']; ?>
</option>
    <?php endforeach; endif; unset($_from); ?>
   </select>

 </div>
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

                 <li class="lileft" style="width:40%"><div class="paging_news"><?php echo $this->_tpl_vars['paging']; ?>
</div></li>
                 <li >
                  <select class="limit_option mw_160"  onchange="MM_jumpMenu('parent',this,0)" >
                   <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_order'];  echo $this->_tpl_vars['url_limit']; ?>
">Filter by payment type</option>
                   <?php $_from = $this->_tpl_vars['rs_payment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_st'] = array('total' => count($_from), 'iteration' => 0);
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
                  <td class="mw_200">Customer Info</td>
                  <td>Information order</td>
                  <td>Payment</td>
                   <td>Status</td>
                  <td valign="top">Source File</td>
                  <td valign="top">Target File</td>
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
                  <td align="center" class="mw_50">
                    <?php echo $this->_tpl_vars['rs']['id_tem']; ?>

                    <?php if ($this->_tpl_vars['action_edit']): ?>
                    <p><a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_status'];  echo $this->_tpl_vars['url_cities'];  echo $this->_tpl_vars['url_limit'];  echo $this->_tpl_vars['url_order']; ?>
&id_edit=<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" class="status_edit">
                      <i class="fa fa-pencil-square-o"></i></a></p>
                      <?php endif; ?>
                    </td>

                    <td valign="top" style="line-height:22px; width: 250px;">
                      <i class="name_orders" >Customer Name :</i> <strong><br/> <?php echo $this->_tpl_vars['rs']['cust_name']; ?>
</strong><br />
                      <i class="name_orders" >Customer Email :</i> <strong><br/> <?php echo $this->_tpl_vars['rs']['cust_email']; ?>
</strong><br />
                      <i class="name_orders" >Project ID :</i> <strong> <?php echo $this->_tpl_vars['rs']['coupon_code']; ?>
</strong><br />
                       <i class="name_orders">Subject Field :</i> <br/><i><?php echo $this->_tpl_vars['rs']['subject_field']; ?>
</i><br />
                      <i class="name_orders">Create Date :</i><i><?php echo $this->_tpl_vars['rs']['ngay_mua']; ?>
</i><br />
                      <i class="name_orders">Country :</i><i><?php echo $this->_tpl_vars['rs']['country_name']; ?>
</i><br />

                    </td>

                    <td valign="top">
                     <i class="name_orders">Project Name :</i> <br/><strong> <?php echo $this->_tpl_vars['rs']['file_translate']; ?>
</strong><br />
                    
                     <i class="name_orders">Translate From :</i> 
                     <?php $_from = $this->_tpl_vars['fromTolanguage']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val_order'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val_order']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val_order']):
        $this->_foreach['val_order']['iteration']++;
?>
                        <?php $_from = $this->_tpl_vars['val_order']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val1']):
        $this->_foreach['val1']['iteration']++;
?>
                          <?php if ($this->_tpl_vars['val1']['translate_id'] == $this->_tpl_vars['rs']['translate_id']): ?>
                            <?php echo $this->_tpl_vars['val1']['from_language_name'];  if (! ($this->_foreach['val1']['iteration'] == $this->_foreach['val1']['total'])): ?>,<?php endif; ?>
                         <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                     <?php endforeach; endif; unset($_from); ?>
                     <br />

                     <i class="name_orders">Translate To :</i>
                      <?php $_from = $this->_tpl_vars['fromTolanguage']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val_order'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val_order']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val_order']):
        $this->_foreach['val_order']['iteration']++;
?>
                           <?php $_from = $this->_tpl_vars['val_order']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val1']):
        $this->_foreach['val1']['iteration']++;
?>
                          <?php if ($this->_tpl_vars['val1']['translate_id'] == $this->_tpl_vars['rs']['translate_id']): ?>
                            <?php echo $this->_tpl_vars['val1']['to_language_name'];  if (! ($this->_foreach['val1']['iteration'] == $this->_foreach['val1']['total'])): ?>,<?php endif; ?>
                         <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                      <?php endforeach; endif; unset($_from); ?>
                     <br />

                     <i class="name_orders">Estimated Delivery :</i> <input type="text" name="" value="<?php echo $this->_tpl_vars['rs']['estimate']; ?>
 hour(s)" class="orders_edit"/><br />

                     <i class="name_orders">Words :</i> <input type="text" name="" value="<?php echo $this->_tpl_vars['rs']['count_text']; ?>
" class="orders_edit"/><br />

                     <i class="name_orders">Amount :</i> <input type="text" name="" value="$ <?php echo $this->_tpl_vars['rs']['price']; ?>
" class="orders_edit"/><br />

                   </td>


                   <td class="mw_150" valign="top" >
                    <?php $_from = $this->_tpl_vars['rs_payment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_sta'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_sta']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs_sta']):
        $this->_foreach['rs_sta']['iteration']++;
?>	
                    <p style="margin:3px 0 0 8px">
                      <?php if ($this->_tpl_vars['rs']['coupon_status'] == $this->_tpl_vars['rs_sta']['coupon_status']): ?>
                      <a style="color:#<?php echo $this->_tpl_vars['rs_sta']['status_color']; ?>
; font-weight:bold"><i class="fa fa-check-square" style="font-size:80%"></i> 
                      <?php echo $this->_tpl_vars['rs_sta']['status_name']; ?>
</a>
                      <?php else: ?>
                        <i class="fa fa-caret-right"></i>  &nbsp;<strong><?php echo $this->_tpl_vars['rs_sta']['status_name']; ?>
</strong>
                        <?php endif; ?>
                      </p>
                      <?php endforeach; endif; unset($_from); ?>
                    </td>
                    <td class="mw_100" valign="top" >
                    <?php $_from = $this->_tpl_vars['rs_process']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs_sta'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs_sta']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs_sta']):
        $this->_foreach['rs_sta']['iteration']++;
?> 
                     <p style="margin:3px 0 0 8px">
                      <?php if ($this->_tpl_vars['rs']['order_status'] == $this->_tpl_vars['rs_sta']['coupon_status']): ?>
                      <a style="color:#<?php echo $this->_tpl_vars['rs_sta']['status_color']; ?>
; font-weight:bold"><i class="fa fa-check-square" style="font-size:80%"></i> 
                      <?php echo $this->_tpl_vars['rs_sta']['status_name']; ?>
</a>
                      <?php else: ?>
                      <a> 
                        <i class="fa fa-caret-right"></i>  &nbsp;<?php echo $this->_tpl_vars['rs_sta']['status_name']; ?>
</a>
                        <?php endif; ?>
                      </p>
                      <?php endforeach; endif; unset($_from); ?>
                    </td>
                    <td>
                        <?php if ($this->_tpl_vars['rs']['file_zip']): ?>
                          <a href="<?php echo @URL_HOME; ?>
/load/download/<?php echo $this->_tpl_vars['rs']['file_zip']; ?>
">Download</a>
                        <?php else: ?>
                          <a href="<?php echo @URL_HOME; ?>
/load/download/<?php echo $this->_tpl_vars['rs']['file_translate']; ?>
">Download</a>
                        <?php endif; ?>
                    </td>
                     <td>
                       <?php $_from = $this->_tpl_vars['listFileArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val_order'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val_order']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val_order']):
        $this->_foreach['val_order']['iteration']++;
?>
                         <?php $_from = $this->_tpl_vars['val_order']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val1']):
        $this->_foreach['val1']['iteration']++;
?>
                           <?php if ($this->_tpl_vars['val1']['order_id'] == $this->_tpl_vars['rs']['coupon_code']): ?>
                             <a href="<?php echo @URL_HOME; ?>
/upload/trans/<?php echo $this->_tpl_vars['val1']['file_name']; ?>
"><?php echo $this->_tpl_vars['val1']['file_name']; ?>
</a>: <br/>(<?php echo $this->_tpl_vars['val1']['send_date']; ?>
)
                             <br/>
                            <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
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
