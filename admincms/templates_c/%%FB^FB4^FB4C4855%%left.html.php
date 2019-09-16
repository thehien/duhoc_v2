<?php /* Smarty version 2.6.13, created on 2018-06-18 04:58:00
         compiled from left.html */ ?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="<?php echo @URL_ADMIN; ?>
?module=homes" style="text-transform:uppercase"><?php echo @langcms_ngonngu; ?>
</a>
<?php if (@LANG_AUGE_CMS): ?>
<a class="navbar-brand" href="<?php echo @URL_HOME; ?>
/lang.php?lang=en" target="_blank"><i class="fa fa-hand-o-right"></i> Home</a>
<?php else: ?>
<a class="navbar-brand" href="<?php echo @URL_HOME; ?>
/lang.php?lang=vn" target="_blank"><i class="fa fa-hand-o-right"></i> Home</a>
<?php endif; ?>

</div>
<ul class="nav navbar-top-links navbar-right">
    <li><a href="<?php echo @URL_ADMINCMS; ?>
langcms.php?cms_lang=cms_vn"><i class="fa fa-flag"></i> VN</a></li>
    <li><a href="<?php echo @URL_ADMINCMS; ?>
langcms.php?cms_lang=cms_en"><i class="fa fa-flag"></i> EN</a></li>
    <li><a href="<?php echo @URL_ADMIN; ?>
?module=users&main=edit"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
    <li><a href="<?php echo @URL_ADMIN; ?>
?module=logout"> <i class="fa fa-power-off"></i> <?php echo @langcms_dangx; ?>
</a></li>
</ul>


<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
    <ul class="nav" id="side-menu">
    <li><a href="<?php echo @URL_ADMIN; ?>
?module=homes"><i class="fa fa-home"></i> <?php echo @langcms_home; ?>
</a></li>
    <?php unset($this->_sections['r1']);
$this->_sections['r1']['name'] = 'r1';
$this->_sections['r1']['loop'] = is_array($_loop=$this->_tpl_vars['r1']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['r1']['show'] = true;
$this->_sections['r1']['max'] = $this->_sections['r1']['loop'];
$this->_sections['r1']['step'] = 1;
$this->_sections['r1']['start'] = $this->_sections['r1']['step'] > 0 ? 0 : $this->_sections['r1']['loop']-1;
if ($this->_sections['r1']['show']) {
    $this->_sections['r1']['total'] = $this->_sections['r1']['loop'];
    if ($this->_sections['r1']['total'] == 0)
        $this->_sections['r1']['show'] = false;
} else
    $this->_sections['r1']['total'] = 0;
if ($this->_sections['r1']['show']):

            for ($this->_sections['r1']['index'] = $this->_sections['r1']['start'], $this->_sections['r1']['iteration'] = 1;
                 $this->_sections['r1']['iteration'] <= $this->_sections['r1']['total'];
                 $this->_sections['r1']['index'] += $this->_sections['r1']['step'], $this->_sections['r1']['iteration']++):
$this->_sections['r1']['rownum'] = $this->_sections['r1']['iteration'];
$this->_sections['r1']['index_prev'] = $this->_sections['r1']['index'] - $this->_sections['r1']['step'];
$this->_sections['r1']['index_next'] = $this->_sections['r1']['index'] + $this->_sections['r1']['step'];
$this->_sections['r1']['first']      = ($this->_sections['r1']['iteration'] == 1);
$this->_sections['r1']['last']       = ($this->_sections['r1']['iteration'] == $this->_sections['r1']['total']);
?>
    <?php if ($this->_tpl_vars['r1'][$this->_sections['r1']['index']]['link']): ?>
        <li <?php if ($this->_tpl_vars['r1'][$this->_sections['r1']['index']]['link'] == $this->_tpl_vars['url']): ?>class="menu_active"<?php endif; ?>>
        <a href="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['r1'][$this->_sections['r1']['index']]['link']; ?>
"><i class="fa <?php echo $this->_tpl_vars['r1'][$this->_sections['r1']['index']]['icon']; ?>
"></i> <?php echo $this->_tpl_vars['r1'][$this->_sections['r1']['index']]['name']; ?>
</a>
        </li>
    <?php else: ?>
        <li >
            <a href="javascript:void(0);"><i class="fa <?php echo $this->_tpl_vars['r1'][$this->_sections['r1']['index']]['icon']; ?>
"></i> <?php echo $this->_tpl_vars['r1'][$this->_sections['r1']['index']]['name']; ?>
<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <?php unset($this->_sections['r2']);
$this->_sections['r2']['name'] = 'r2';
$this->_sections['r2']['loop'] = is_array($_loop=$this->_tpl_vars['r2'][$this->_sections['r1']['index']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['r2']['show'] = true;
$this->_sections['r2']['max'] = $this->_sections['r2']['loop'];
$this->_sections['r2']['step'] = 1;
$this->_sections['r2']['start'] = $this->_sections['r2']['step'] > 0 ? 0 : $this->_sections['r2']['loop']-1;
if ($this->_sections['r2']['show']) {
    $this->_sections['r2']['total'] = $this->_sections['r2']['loop'];
    if ($this->_sections['r2']['total'] == 0)
        $this->_sections['r2']['show'] = false;
} else
    $this->_sections['r2']['total'] = 0;
if ($this->_sections['r2']['show']):

            for ($this->_sections['r2']['index'] = $this->_sections['r2']['start'], $this->_sections['r2']['iteration'] = 1;
                 $this->_sections['r2']['iteration'] <= $this->_sections['r2']['total'];
                 $this->_sections['r2']['index'] += $this->_sections['r2']['step'], $this->_sections['r2']['iteration']++):
$this->_sections['r2']['rownum'] = $this->_sections['r2']['iteration'];
$this->_sections['r2']['index_prev'] = $this->_sections['r2']['index'] - $this->_sections['r2']['step'];
$this->_sections['r2']['index_next'] = $this->_sections['r2']['index'] + $this->_sections['r2']['step'];
$this->_sections['r2']['first']      = ($this->_sections['r2']['iteration'] == 1);
$this->_sections['r2']['last']       = ($this->_sections['r2']['iteration'] == $this->_sections['r2']['total']);
?>
                    <li <?php if ($this->_tpl_vars['r2'][$this->_sections['r1']['index']][$this->_sections['r2']['index']]['link'] == $this->_tpl_vars['url']): ?>class="menu_active"<?php endif; ?>>
                    <a href="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['r2'][$this->_sections['r1']['index']][$this->_sections['r2']['index']]['link']; ?>
"><i class="fa <?php echo $this->_tpl_vars['r2'][$this->_sections['r1']['index']][$this->_sections['r2']['index']]['icon']; ?>
"></i> <?php echo $this->_tpl_vars['r2'][$this->_sections['r1']['index']][$this->_sections['r2']['index']]['name']; ?>
</a>
                    </li>
                <?php endfor; endif; ?>
            </ul>
        </li>
    <?php endif; ?>
    <?php endfor; endif; ?>
    </ul>
    </div>
</div>
</nav>