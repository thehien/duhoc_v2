<?php /* Smarty version 2.6.13, created on 2017-11-10 00:22:50
         compiled from welcome.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo @langcms_weltkc; ?>
</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-3">
                <i class="fa fa-shopping-cart fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
                <div class="huge"><?php echo $this->_tpl_vars['orders_news']; ?>
</div>
                <div><?php echo @langcms_weldhm; ?>
!</div>
            </div>
        </div>
    </div>
    <a href="<?php echo @URL_ADMIN; ?>
?module=porders&main=views&status=1">
        <div class="panel-footer">
            <span class="pull-left"><?php echo @langcms_welxct; ?>
</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
        </div>
    </a>
    </div>
    </div>
    
        
    </div>

<div class="row">
    <div class="col-lg-6">
    <div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-shopping-cart"></i><?php echo @langcms_weltkdh; ?>
 ( <strong><?php echo $this->_tpl_vars['orders_all']; ?>
</strong> )
    </div>
    <div class="panel-body">
        <div class="list-group">
            <a href="#" class="list-group-item">
                <i class="fa fa-comment fa-fw"></i> <?php echo @langcms_weldhm; ?>

                <span class="pull-right text-muted small"><em> <?php echo $this->_tpl_vars['orders_news']; ?>
 </em>
                </span>
            </a>
            <a href="#" class="list-group-item">
                <i class="fa fa-twitter fa-fw"></i> <?php echo @langcms_weldxnn; ?>
 
                <span class="pull-right text-muted small"><em> <?php echo $this->_tpl_vars['orders_2']; ?>
 </em>
                </span>
            </a>
                        <a href="#" class="list-group-item">
                <i class="fa fa-tasks fa-fw"></i> <?php echo @langcms_weldtt; ?>
 
                <span class="pull-right text-muted small"><em> <?php echo $this->_tpl_vars['orders_4']; ?>
 </em>
                </span>
            </a>
            <a href="#" class="list-group-item">
                <i class="fa fa-tasks fa-fw"></i> <?php echo @langcms_weldgb; ?>
 
                <span class="pull-right text-muted small"><em> <?php echo $this->_tpl_vars['orders_5']; ?>
 </em>
                </span>
            </a>
        </div>
    </div>
    </div>
    </div>
    
    <div class="col-lg-6">
    <div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-th-large"></i> <?php echo @langcms_weltkcc; ?>
 
    </div>
    <div class="panel-body">
        <div class="list-group">
            <a href="#" class="list-group-item">
                <i class="fa fa-user fa-fw"></i> <?php echo @langcms_weltvcc; ?>

                <span class="pull-right text-muted small"><em><?php echo $this->_tpl_vars['users_all']; ?>
 </em>
                </span>
            </a>
            <a href="#" class="list-group-item">
                <i class="fa fa-th-large fa-fw"></i> <?php echo @langcms_welsp; ?>
 
                <span class="pull-right text-muted small"><em><?php echo $this->_tpl_vars['products_all']; ?>
 </em>
                </span>
            </a>
            <a href="#" class="list-group-item">
                <i class="fa fa-hacker-news fa-fw"></i> <?php echo @langcms_welbvv; ?>
 
                <span class="pull-right text-muted small"><em><?php echo $this->_tpl_vars['news_all']; ?>
 </em>
                </span>
            </a>
            <a href="#" class="list-group-item">
                <i class="fa fa-globe fa-fw"></i> <?php echo @langcms_weltkk; ?>

                <span class="pull-right text-muted small"><em><?php echo $this->_tpl_vars['keyword_all']; ?>
 </em>
                </span>
            </a>
                        
        </div>
    </div>
    </div>
    </div>

    
</div>


</div>