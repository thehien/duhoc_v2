<?php /* Smarty version 2.6.13, created on 2019-05-18 10:08:07
         compiled from users_cv/views.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="page-wrapper">
<div class="row">
<div class="col-lg-12">
    <h1 class="page-header"><a href="#" ><i class="fa fa-home"></i> <?php echo $this->_tpl_vars['main_content']; ?>
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
    <div class="col-lg-6">
        <table class="table_insert">
        <thead>
            <tr>
              <td align="right">First name:  <em>*</em></td>
              <td><input type="text" class="check_input" name="firstname"  id="firstname" value="<?php echo $this->_tpl_vars['rs_edit']['firstname']; ?>
" /></td>
            </tr>

             <tr>
              <td align="right">Last name:  <em>*</em></td>
              <td><input type="text" class="check_input" name="lastname"  id="lastname" value="<?php echo $this->_tpl_vars['rs_edit']['lastname']; ?>
" /></td>
            </tr>
            <tr>
              <td align="right"><?php echo @langcms_matk; ?>
</td>
              <td><input type="text" name="password"  id="password" value="" /></td>
            </tr>
            <tr>
              <td align="right">Email</td>
              <td><input type="text" name="email"  id="email" value="<?php echo $this->_tpl_vars['rs_edit']['email']; ?>
" /></td>
            </tr>
            <tr>
                <td class="left"></td>
                <td class="center">
                <?php if ($this->_tpl_vars['id_edit']): ?><button type="submit" name="submit" id="submit" value="submit" class="bg_edit"><?php echo @langcms_capnhat; ?>
 </button>
                <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_limit'];  echo $this->_tpl_vars['url_order']; ?>
" class="status_undo"><i class="fa fa-undo"></i> <?php echo @langcms_quaylai; ?>
</a>
                <?php else: ?><button type="submit" name="submit" id="submit" value="submit" class="bg_insert"><?php echo @langcms_themmoi; ?>
 </button><?php endif; ?>
                </td>
                </tr>
          </thead>  
        </table>
    </div>
    <div class="col-lg-6">
        <table class="table_insert">
        <thead>
            <tr>
              <td align="right">Phone</td>
              <td><input type="text" name="mobile"  id="mobile" value="<?php echo $this->_tpl_vars['rs_edit']['mobile']; ?>
" /></td>
            </tr>
           
            <tr>
            <td align="right"><?php echo @langcms_trangthai; ?>
</td>
            <td>
                <select class="select_option wnum" name="status" id="status"  >
                   <option value="1" <?php if ($this->_tpl_vars['rs_edit']['status'] == 1): ?>selected<?php endif; ?>>On</option>
                   <option value="0" <?php if ($this->_tpl_vars['rs_edit']['status'] == 0): ?>selected<?php endif; ?>>Off</option>
                </select>
            </td>
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
<div class="col-lg-5">
    <form name="frm_search" method="post" action="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=search" class="search_text">
    <div class="input-group custom-search-form">
            <input type="text" class="form-control" placeholder="Search..." name="name_search" id="name_search" value="<?php echo $this->_tpl_vars['name_search']; ?>
" >
            <span class="input-group-btn">
            <button class="btn btn-default" type="submit" name="submit" id="submit">
                <i class="fa fa-search"></i>
            </button>
        </span>
    </div>
    </form> 
</div>
    
<div class="col-lg-12">
<form name="frm_news" method="POST" >
<div class="panel panel-default">
<div class="panel-heading">
    <div class="row">
    <div class="col-lg-6 heading_title">
        <i class="fa fa-windows"></i> <?php echo $this->_tpl_vars['main_content']; ?>
  <strong>( <?php echo $this->_tpl_vars['numf']; ?>
 <?php echo $this->_tpl_vars['main_name']; ?>
 )</strong>
    </div>   
    <div class="col-lg-6 click_right">
    	<?php if ($this->_tpl_vars['action_delete']): ?>
        <a href="javascript:void(0);" onclick="del_news('frm_news');" class="bg_del">
        <i class="fa fa-trash-o"></i> <?php echo @langcms_xoa; ?>
</a>  
        <?php endif; ?>
        <?php if ($this->_tpl_vars['action_edit']): ?>
        <a href="javascript:void(0);" onclick="status_on('frm_news');" class="bg_on">
        <i class="fa fa-check-square"></i> <?php echo @langcms_kichhoat; ?>
</a>        
        <a href="javascript:void(0);" onclick="status_off('frm_news');" class="bg_off" >
        <i class="fa fa-minus-square"></i> <?php echo @langcms_vohieu; ?>
</a>
        <a href="javascript:void(0);" onClick="update_order('frm_news');"class="bg_edit">
        <i class="fa fa-pencil-square-o"></i> <?php echo @langcms_capnhat; ?>
</a></li>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['action_insert']): ?>
        <a href="javascript:void(0);" class="name_insert bg_ins">
        <i class="fa fa-plus-circle fa-fw"></i> <?php echo @langcms_them; ?>
</a> 
        <?php endif; ?>
    </div>
    </div>
</div>
    
<div class="panel-body">
 <ul class="table_ul">
    <li class="lileft">
        <select class="limit_option" onchange="MM_jumpMenu('parent',this,0)" >
            <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_order']; ?>
&limit=10" <?php if ($this->_tpl_vars['limit'] == 20): ?>selected="selected"<?php endif; ?>>10</option>
            <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_order']; ?>
&limit=20" <?php if ($this->_tpl_vars['limit'] == 20): ?>selected="selected"<?php endif; ?>>20</option>
            <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_order']; ?>
&limit=50" <?php if ($this->_tpl_vars['limit'] == 50): ?>selected="selected"<?php endif; ?>>50</option>
            <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_order']; ?>
&limit=100" <?php if ($this->_tpl_vars['limit'] == 100): ?>selected="selected"<?php endif; ?>>100</option>
            <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_order']; ?>
&limit=200" <?php if ($this->_tpl_vars['limit'] == 200): ?>selected="selected"<?php endif; ?>>200</option>
       </select>
    </li>
    <li class="left" style="width:40%"><div class="paging_news"><?php echo $this->_tpl_vars['paging']; ?>
</div></li>
    </ul>
    <table class="table_views table-striped table-hover">
        <thead>
        <tr class="two">
 <td align="center"> ID
          <div class="order">
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_limit']; ?>
&order=id_tem&sc=asc"><i class="fa fa-caret-up"></i></a>  
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_limit']; ?>
&order=id_tem&sc=desc"><i class="fa fa-caret-down"></i></a>
          </div>
          </td>
          <td>
          <?php echo @langcms_tieude; ?>

          <div class="order">
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_limit']; ?>
&order=firstname&sc=asc"><i class="fa fa-caret-up"></i></a>  
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_limit']; ?>
&order=firstname&sc=desc"><i class="fa fa-caret-down"></i></a>
          </div>
          </td>
          <td><?php echo @langcms_country; ?>
</td>
          <td><?php echo @lang_from_trans; ?>
</td>
          <td><?php echo @lang_to_trans; ?>
</td>
          <td>Email</td>
          <td>Phone</td>
          <td><?php echo @langcms_regist_date; ?>
</td>
          <td><?php echo @langcms_hoso; ?>
</td>
          <td><?php echo @langcms_trangthai; ?>
</td>
          <td>Accept</td>
          <?php if ($this->_tpl_vars['action_edit']): ?><td align="center"><?php echo @langcms_capnhat; ?>
</td><?php endif; ?>
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
           <td align="center" class="mw_80"><?php echo $this->_tpl_vars['rs']['id_tem']; ?>
</td>
          <td>
            <?php if ($this->_tpl_vars['rs']['name'] != "" && $this->_tpl_vars['rs']['google_name'] == "" && $this->_tpl_vars['rs']['facebook_name'] == ""): ?>
            <input type="text" name="name<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['name']; ?>
" />
            <?php endif; ?>

            <?php if ($this->_tpl_vars['rs']['google_name'] != ""): ?>
            <input type="text" name="name<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['google_name']; ?>
" />
            <?php endif; ?>

            <?php if ($this->_tpl_vars['rs']['facebook_name'] != ""): ?>
            <input type="text" name="name<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['facebook_name']; ?>
" />
            <?php endif; ?>


          </td>
          <td align="center" class="mw_80"><?php echo $this->_tpl_vars['rs']['country_name']; ?>
</td>
           <td align="center" class="mw_80">
              <?php $_from = $this->_tpl_vars['rs']['from_language']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
                <?php if ($this->_tpl_vars['key'] == 0): ?>
                  <?php echo $this->_tpl_vars['val']['from_language_name']; ?>

               <?php endif; ?>
              <?php endforeach; endif; unset($_from); ?>
           </td>
            <td align="center" class="mw_80">
              <?php $_from = $this->_tpl_vars['rs']['to_language']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
               <?php if ($this->_tpl_vars['key'] == 0): ?>
                   <?php echo $this->_tpl_vars['val']['to_language_name']; ?>

               <?php endif; ?>
              <?php endforeach; endif; unset($_from); ?>
            </td>

          <td>
            <?php if ($this->_tpl_vars['rs']['email'] != "" && $this->_tpl_vars['rs']['google_email'] == "" && $this->_tpl_vars['rs']['facebook_email'] == ""): ?>
            <input type="text" name="email<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['email']; ?>
" />
            <?php endif; ?>

            <?php if ($this->_tpl_vars['rs']['google_email'] != ""): ?>
            <input type="text" name="email<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['google_email']; ?>
" />
            <?php endif; ?>

            <?php if ($this->_tpl_vars['rs']['facebook_email'] != ""): ?>
            <input type="text" name="name<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['facebook_email']; ?>
" />
            <?php endif; ?>
            

          </td>
          <td><input type="text" name="mobile<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['mobile']; ?>
" /></td>

          <td>
            <input type="text" name="date<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['created_date']; ?>
" />
          </td>

          <td>
            <a href="#" target="_blank">Link profile</a>
          </td>
          
          <td align="center">
              <a href="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=status&id=<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
&status=<?php echo $this->_tpl_vars['rs']['status']; ?>
"  
              <?php if ($this->_tpl_vars['rs']['status'] == 1): ?>class="status_on"<?php else: ?>class="status_off"<?php endif; ?>><i class="fa fa-check-square"></i>
              </a>
          </td>
          
           <td align="center">
              <a href="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=active_translate&id=<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
&active_translate=<?php echo $this->_tpl_vars['rs']['active_translate']; ?>
"  
              <?php if ($this->_tpl_vars['rs']['active_translate'] == 1): ?>class="status_on"<?php else: ?>class="status_off"<?php endif; ?>><i class="fa fa-check-square"></i>
              </a>
          </td>

          <?php if ($this->_tpl_vars['action_edit']): ?>
          <td align="center">
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_limit'];  echo $this->_tpl_vars['url_order']; ?>
&id_edit=<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" class="status_edit"><i class="fa fa-pencil-square-o"></i></a>
          </td>
          <?php endif; ?>


          <td align="center"> <label><input type="checkbox" id="checks" name="checkbox_id[]" value="<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
"  /></label></td>
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
