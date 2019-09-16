<?php /* Smarty version 2.6.13, created on 2017-11-20 17:45:05
         compiled from modules/views.html */ ?>
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
          <td align="right"><span><?php echo @langcms_tencn; ?>
</span> <em>*</em></td>
          <td><input type="text" class="check_input" name="name"  id="name" value="<?php echo $this->_tpl_vars['rs_edit']['name']; ?>
" /></td>
        </tr>
        <tr>
          <td align="right"><span><?php echo @langcms_mota; ?>
</span> <em>*</em></td>
          <td><input type="text" class="check_input" name="content"  id="content" value="<?php echo $this->_tpl_vars['rs_edit']['content']; ?>
" /></td>
        </tr>
        <tr>
          <td align="right"><span>Link</span></td>
          <td><input class="check_url" type="text" name="link"  id="link" value="<?php echo $this->_tpl_vars['rs_edit']['link']; ?>
" /></td>
        </tr>
        <tr>
          <td align="right"><span>Icon</span></td>
          <td><input type="text" name="icon"  id="icon" value="<?php echo $this->_tpl_vars['rs_edit']['icon']; ?>
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
        <td align="right"><span><?php echo @langcms_danhmuc; ?>
</span></td>
        <td>
            <select class="select_option" name="parent" id="parent" >
                <option value="0"><?php echo @langcms_chondanhmuc; ?>
</option>
                <?php $_from = $this->_tpl_vars['tree_select']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
                <option value="<?php echo $this->_tpl_vars['val']['module_id']; ?>
" <?php if ($this->_tpl_vars['val']['module_id'] == $this->_tpl_vars['rs_edit']['parent']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['val']['name']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        </td>
        </tr>
        <tr>
          <td align="right"><span><?php echo @langcms_vitri; ?>
</span></td>
          <td><input type="text"  name="pos" id="pos" class="wnum check_num" value="<?php echo $this->_tpl_vars['rs_edit']['pos']; ?>
"/></td>
        </tr>
        <tr>
        <td align="right"><span><?php echo @langcms_trangthai; ?>
</span></td>
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
<div class="col-lg-12">
<form name="frm_news" method="POST" >
<div class="panel panel-default">
<div class="panel-heading">
    <div class="row">
    <div class="col-lg-6 heading_title">
        <i class="fa fa-windows"></i> <?php echo $this->_tpl_vars['main_content']; ?>

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
    <table class="table_views category_tree table-striped table-hover">
    <thead>
    <tr class="two">
        <td>
        <?php echo @langcms_tencn; ?>

        <div class="order">
          <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_limit']; ?>
&order=name&sc=asc"><i class="fa fa-caret-up"></i></a>  
          <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_limit']; ?>
&order=name&sc=desc"><i class="fa fa-caret-down"></i></a>
        </div>
        </td>
        <td>Link</td>
        <td>Icon</td>
        <td align="center"><?php echo @langcms_vitri; ?>
</td>
        <td align="center"><?php echo @langcms_trangthai; ?>
</td>
        <?php if ($this->_tpl_vars['action_edit']): ?><td align="center"><?php echo @langcms_capnhat; ?>
</td><?php endif; ?>
        <td align="center"><label><input type="checkbox" data-toggle="checkall" data-target="input[id=checks]" /></label></td>
    </tr>
    </thead>
    <tbody>
    <?php $_from = $this->_tpl_vars['rs_tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs']):
        $this->_foreach['rs']['iteration']++;
?>
     <tr  data-tt-id="<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" <?php if ($this->_tpl_vars['rs']['parent'] > 0): ?>data-tt-parent-id="<?php echo $this->_tpl_vars['rs']['parent']; ?>
"<?php endif; ?>>
        <td><?php echo $this->_tpl_vars['rs']['name']; ?>
</td>
        <td><input type="text" name="link<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['link']; ?>
" /> </td>
        <td><input type="text" name="icon<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['icon']; ?>
" /> </td>
        <td align="center"><input type="text" name="pos<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['pos']; ?>
" size="1" class="check_num"/></td>
        <td align="center">
          <a href="<?php echo $this->_tpl_vars['url_views']; ?>
&main=status&id=<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
&status=<?php echo $this->_tpl_vars['rs']['status']; ?>
"  
          <?php if ($this->_tpl_vars['rs']['status'] == 1): ?>class="status_on"<?php else: ?>class="status_off"<?php endif; ?>><i class="fa fa-check-square"></i>
          </a>
        </td>
        <?php if ($this->_tpl_vars['action_edit']): ?>
        <td align="center">
          <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_limit'];  echo $this->_tpl_vars['url_order']; ?>
&id_edit=<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" class="status_edit"><i class="fa fa-pencil-square-o"></i></a>
        </td>
        <?php endif; ?>
        <td align="center"><label><input type="checkbox" id="checks" name="checkbox_id[]" value="<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
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