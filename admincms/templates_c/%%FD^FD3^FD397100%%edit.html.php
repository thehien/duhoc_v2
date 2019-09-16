<?php /* Smarty version 2.6.13, created on 2018-12-11 19:17:35
         compiled from users/edit.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="page-wrapper">
<div class="row">
<div class="col-lg-12">
    <h1 class="page-header"><a href="#" ><i class="fa fa-home"></i> <?php echo @langcms_capnhat; ?>
 <?php echo $this->_tpl_vars['main_name']; ?>
</a></h1>
</div>
</div>

<div class="row shows_insert" style="display:block">
<div class="col-lg-12">
<div class="panel panel-default">
    <div class="panel-heading heading_title">
        <i class="fa fa-plus-circle fa-fw"></i> <?php echo @langcms_capnhat; ?>
 <?php echo $this->_tpl_vars['main_name']; ?>

    </div>
    <div class="panel-body">
    <form id="frm_admin" name="frm_admin" method="post"  action="<?php echo @URL_ADMIN; ?>
?module=users&main=edit" >
    <div class="col-lg-6">
        <table class="table_insert">
        <thead>
            <tr>
              <td align="right"><?php echo @langcms_tentv; ?>
:  <em>*</em></td>
              <td><input type="text" class="check_input" name="firstname"  id="firstname" value="<?php echo $this->_tpl_vars['rs_edit']['firstname']; ?>
" /></td>
            </tr>
            <tr>
              <td align="right"><?php echo @langcms_tendn; ?>
 <em>*</em></td>
              <td><input type="text" class="check_input" name="username"  id="username" value="<?php echo $this->_tpl_vars['rs_edit']['username']; ?>
" readonly="readonly"/></td>
            </tr>
            <tr>
              <td align="right"><?php echo @langcms_matk; ?>
</td>
              <td><input type="text" name="password"  id="password" value=""  /></td>
            </tr>
           
            <tr>
                <td class="left"></td>
                <td class="center">
                <input type="hidden" id="user_role" name="user_role" value="<?php echo $this->_tpl_vars['rs_edit']['user_role']; ?>
" />
                <input type="hidden" id="status" name="status" value="<?php echo $this->_tpl_vars['rs_edit']['status']; ?>
" />
                <button type="submit" name="submit" id="submit" value="submit" class="bg_edit"><?php echo @langcms_capnhat; ?>
 </button>
                </td>
                </tr>
          </thead>  
        </table>
    </div>
    <div class="col-lg-6">
        <table class="table_insert">
        <thead>
        	<tr>
              <td align="right">Email</td>
              <td><input type="text" name="email"  id="email" value="<?php echo $this->_tpl_vars['rs_edit']['email']; ?>
" /></td>
            </tr>
            <tr>
              <td align="right">Phone</td>
              <td><input type="text" name="mobile"  id="mobile" value="<?php echo $this->_tpl_vars['rs_edit']['mobile']; ?>
" /></td>
            </tr>
           
          </thead>  
        </table>
    </div>
    </form>
    </div>
</div>
</div>
</div>



</div>
