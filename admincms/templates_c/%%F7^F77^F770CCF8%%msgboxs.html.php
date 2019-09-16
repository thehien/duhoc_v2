<?php /* Smarty version 2.6.13, created on 2017-11-14 22:55:34
         compiled from msgboxs.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<meta http-equiv="refresh" content="<?php echo $this->_tpl_vars['time']; ?>
;url=<?php echo $this->_tpl_vars['goto']; ?>
" />  
<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
            <br />
            </div>
        </div>
        
        <div class="row">
        <div class="col-lg-12">
           <?php if ($this->_tpl_vars['type'] == 1): ?>
            <div class="alert alert-success">
            <i class="fa fa-smile-o"></i> <?php echo $this->_tpl_vars['thongbao']; ?>

            </div> 
            <?php endif; ?>  
            
            <?php if ($this->_tpl_vars['type'] == 2): ?>
            <div class="alert alert-warning">
            <i class="fa fa-frown-o"></i> <?php echo $this->_tpl_vars['thongbao']; ?>

            </div> 
            <?php endif; ?>  
            
            <?php if ($this->_tpl_vars['type'] == 3): ?>
            <div class="alert alert-danger">
            <i class="fa fa-frown-o"></i> <?php echo $this->_tpl_vars['thongbao']; ?>

            </div> 
            <?php endif; ?>  
        </div>
        </div>
    </div>
