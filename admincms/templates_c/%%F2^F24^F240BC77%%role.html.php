<?php /* Smarty version 2.6.13, created on 2017-11-27 18:22:35
         compiled from users/role.html */ ?>
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
<div class="row">
<div class="col-lg-12">
<form name="frm_news" method="POST" >
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-lg-5 heading_title">
                <i class="fa fa-windows"></i> <strong><?php echo @langcms_cqctv; ?>
</strong> : <strong><?php echo $this->_tpl_vars['firstname']; ?>
</strong>
            </div>
      
            <div class="col-lg-7 click_right">
               <a href="javascript:void(0);" onClick="update_action('frm_news');" class="bg_edit">
               <?php if ($this->_tpl_vars['action_edit']): ?><i class="fa fa-pencil-square-o"></i> <?php echo @langcms_capnhat; ?>
</a><?php endif; ?>
               <a id="check-all" href="javascript:void(0);" class="name_check"><i class="fa fa-check-circle-o"></i> <?php echo @langcms_chonall; ?>
</a>
               <a id="uncheck-all" href="javascript:void(0);"  class="name_check"><i class="fa fa-circle-thin"></i> <?php echo @langcms_nochon; ?>
</a>
            </div>
        </div>
    </div>
    
    <div class="panel-body">
        <table class="table_views category_tree table-striped table-hover">
            <thead>
            <tr class="two">
              <td><?php echo @langcms_dscn; ?>
</td>
              <td  align="center"><?php echo @langcms_xem; ?>
</td>
              <td  align="center"><?php echo @langcms_them; ?>
</td>
              <td  align="center"><?php echo @langcms_sua; ?>
</td>
              <td  align="center"><?php echo @langcms_xoa; ?>
</td>
              <td  align="center"><?php echo @langcms_trangthai; ?>
</td>
            </tr>
            </thead>
            <tbody>
            <?php $_from = $this->_tpl_vars['rs_tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs']):
        $this->_foreach['rs']['iteration']++;
?>
              <tr  data-tt-id="<?php echo $this->_tpl_vars['rs']['module_id']; ?>
" <?php if ($this->_tpl_vars['rs']['parent'] > 0): ?>data-tt-parent-id="<?php echo $this->_tpl_vars['rs']['parent']; ?>
"<?php endif; ?>>
              <?php if ($this->_tpl_vars['rs']['sub_category']): ?>
              <td><?php echo $this->_tpl_vars['rs']['name']; ?>
</td>
              <td  align="center"></td>
              <td  align="center"></td>
              <td  align="center"></td>
              <td  align="center"></td>
              <td  align="center"><label><input type="checkbox"  name="status<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="1" <?php if ($this->_tpl_vars['rs']['status']): ?>checked<?php endif; ?>/></label> </td>
              <?php else: ?>
              <td><?php echo $this->_tpl_vars['rs']['name']; ?>
</td>
              <td  align="center"><input type="checkbox"  name="action_views<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="1" <?php if ($this->_tpl_vars['rs']['action_views']): ?>checked<?php endif; ?> /> </td>
              <td  align="center"><input type="checkbox"  name="action_insert<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="1" <?php if ($this->_tpl_vars['rs']['action_insert']): ?>checked<?php endif; ?>/> </td>
              <td  align="center"><input type="checkbox"  name="action_edit<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="1"  <?php if ($this->_tpl_vars['rs']['action_edit']): ?>checked<?php endif; ?>/> </td>
              <td  align="center"><input type="checkbox"  name="action_delete<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="1"  <?php if ($this->_tpl_vars['rs']['action_delete']): ?>checked<?php endif; ?>/> </td>
              <td  align="center"><input type="checkbox"   name="status<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="1"   <?php if ($this->_tpl_vars['rs']['status']): ?>checked<?php endif; ?>/> </td>
              <?php endif; ?>
            </tr>
            <label><input type="hidden" name="checkbox_id[]" value="<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" /> </label>
            <?php endforeach; endif; unset($_from); ?>
            </tbody>
        </table>
    </div>
</div>
</form>
</div>
</div> 
 
 
  