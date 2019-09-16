<?php /* Smarty version 2.6.13, created on 2018-05-14 04:47:18
         compiled from service/views.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="page-wrapper">

<div class="row">
<div class="col-lg-12">
    <h1 class="page-header"><a href="<?php echo $this->_tpl_vars['url_views']; ?>
" ><i class="fa fa-home"></i> <?php echo $this->_tpl_vars['main_content']; ?>
</a></h1>
</div>
</div>

<div class="row">
<!--Search-->
<div class="col-lg-10">
    <form name="frm_search" method="post" action="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=search" class="search_text">
    
    
    <table>
    <tr>
    <td width="90">Search name</td>
    <td><div class="input-group custom-search-form">
           
            <input type="text" class="form-control" placeholder="Search..." name="name_search" id="name_search" value="<?php echo $this->_tpl_vars['name_search']; ?>
" >
            <span class="input-group-btn">
            <button class="btn btn-default" type="submit" name="submit" id="submit">
                <i class="fa fa-search"></i>
            </button>
            </span>     
    </div></td>
    </tr>
    </table>
    
    
    </form> 
</div>
<!--Views-->    
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
        <a href="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=insert" class="name_insert bg_ins">
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
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_shops'];  echo $this->_tpl_vars['url_order']; ?>
&limit=10" <?php if ($this->_tpl_vars['limit'] == 20): ?>selected="selected"<?php endif; ?>>10</option>
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_shops'];  echo $this->_tpl_vars['url_order']; ?>
&limit=20" <?php if ($this->_tpl_vars['limit'] == 20): ?>selected="selected"<?php endif; ?>>20</option>
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_shops'];  echo $this->_tpl_vars['url_order']; ?>
&limit=50" <?php if ($this->_tpl_vars['limit'] == 50): ?>selected="selected"<?php endif; ?>>50</option>
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_shops'];  echo $this->_tpl_vars['url_order']; ?>
&limit=100" <?php if ($this->_tpl_vars['limit'] == 100): ?>selected="selected"<?php endif; ?>>100</option>
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_shops'];  echo $this->_tpl_vars['url_order']; ?>
&limit=200" <?php if ($this->_tpl_vars['limit'] == 200): ?>selected="selected"<?php endif; ?>>200</option>
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_shops'];  echo $this->_tpl_vars['url_order']; ?>
&limit=1000" <?php if ($this->_tpl_vars['limit'] == 1000): ?>selected="selected"<?php endif; ?>>1000</option>
           </select>
        </li>
    	<li class="lileft" style="width:40%"><div class="paging_news"><?php echo $this->_tpl_vars['paging']; ?>
</div></li>
       
    </ul>
    <table class="table_views table-striped table-hover">
    <thead>
        <tr class="two">
      
          <td align="center"> ID
          <div class="order">
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_shops'];  echo $this->_tpl_vars['url_limit']; ?>
&order=id_tem&sc=asc"><i class="fa fa-caret-up"></i></a>  
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_shops'];  echo $this->_tpl_vars['url_limit']; ?>
&order=id_tem&sc=desc"><i class="fa fa-caret-down"></i></a>
          </div>
          </td>
    
        <td><?php echo @langcms_service; ?>

          <div class="order">
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_shops'];  echo $this->_tpl_vars['url_limit']; ?>
&order=news_name&sc=asc"><i class="fa fa-caret-up"></i></a>  
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_shops'];  echo $this->_tpl_vars['url_limit']; ?>
&order=news_name&sc=desc"><i class="fa fa-caret-down"></i></a>
          </div>
          </td>
         
          <td align="center">Code
          <div class="order">
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_shops'];  echo $this->_tpl_vars['url_limit']; ?>
&order=news_level&sc=asc"><i class="fa fa-caret-up"></i></a>  
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_shops'];  echo $this->_tpl_vars['url_limit']; ?>
&order=news_level&sc=desc"><i class="fa fa-caret-down"></i></a>
          </div>
          </td>

          <td align="center"><?php echo @langcms_trangthai; ?>

          <div class="order">
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_shops'];  echo $this->_tpl_vars['url_limit']; ?>
&order=status&sc=asc"><i class="fa fa-caret-up"></i></a>  
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_shops'];  echo $this->_tpl_vars['url_limit']; ?>
&order=status&sc=desc"><i class="fa fa-caret-down"></i></a>
          </div>
          </td>
          <?php if ($this->_tpl_vars['action_edit']): ?><td align="center"><?php echo @langcms_capnhat; ?>
</td><?php endif; ?>

          <td align="center"><label><input type="checkbox" data-toggle="checkall" data-target="input[id=checks]" /></label></td>
        </tr>
    </thead>
    <tbody>
        <?php $_from = $this->_tpl_vars['rs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['rs']):
        $this->_foreach['rs']['iteration']++;
?>
          <tr>
         
          <td align="center" class="mw_80">
          <a href="<?php echo @URL_HOMEPAGE;  echo $this->_tpl_vars['rs']['id']; ?>
-<?php echo $this->_tpl_vars['rs']['news_url']; ?>
.html" target="_blank" class="status_views">
          <?php echo $this->_tpl_vars['rs']['id']; ?>
 
          </a>
          </td>

           <td valign="center" class="mw_300">
            <input type="text" name="news_name<?php echo $this->_tpl_vars['rs']['name']; ?>
" value="<?php echo $this->_tpl_vars['rs']['name']; ?>
" style="font-weight:bold" />
          </td>


          <td valign="center" class="mw_300">
           <input type="text" name="news_name<?php echo $this->_tpl_vars['rs']['code']; ?>
" value="<?php echo $this->_tpl_vars['rs']['code']; ?>
" />
          </td>

          <td align="center" class="mw_100">
           <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              <td><span>Status:</span></td>
              <td> <a href="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=status&id=<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
&status=<?php echo $this->_tpl_vars['rs']['status']; ?>
"  
            <?php if ($this->_tpl_vars['rs']['status'] == 1): ?>class="status_on"<?php else: ?>class="status_off"<?php endif; ?>><i class="fa fa-check-square"></i>
              </a></td>
            </tr>
            </table>
          </td>

          </td>
          <?php if ($this->_tpl_vars['action_edit']): ?>
          <td align="center" class="mw_80">
          <a href="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=insert<?php echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_page'];  echo $this->_tpl_vars['url_shops'];  echo $this->_tpl_vars['url_limit'];  echo $this->_tpl_vars['url_order']; ?>
&id_edit=<?php echo $this->_tpl_vars['rs']['id']; ?>
" class="status_edit">
          <i class="fa fa-pencil-square-o"></i></a>
             
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
<?php if ($_SESSION['user_role'] == 1): ?>
<div class="col-lg-12 update_price">
<a id="click_price" href="#" remove-link="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=updateprice">
<i class="fa fa-youtube-play"></i> <?php echo @langcms_upgia; ?>
</a>
<a id="click_tang" href="#" remove-link="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=updatetang" >
<i class="fa fa-angle-double-up"></i> <?php echo @langcms_ttilept; ?>
</a>
<a id="click_giam" href="#" remove-link="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=updategiam" >
<i class="fa fa-angle-double-down"></i> <?php echo @langcms_gtilept; ?>
</a>
<a href="<?php echo @URL_ADMIN; ?>
?module=categorys"><i class="fa fa-hand-o-right"></i> <?php echo @langcms_xemtl; ?>
</a>
</div>
<?php endif; ?>
</div>
</div>

<!--Hoi khi xoa-->
<script src="<?php echo @URL_ADMIN_THEM; ?>
delete/jquery.confirmon.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo @URL_ADMIN_THEM; ?>
delete/sample.css"/>
<?php echo '
<script>
	$(function() {
		$(\'#click_giam\').confirmOn({
			classPrepend: \'myprefix\'
		},\'click\', function(e, confirmed) {
			if(confirmed) window.location = $(this).attr("remove-link");
		});
		
		$(\'#click_tang\').confirmOn({
			classPrepend: \'myprefix\'
		},\'click\', function(e, confirmed) {
			if(confirmed) window.location = $(this).attr("remove-link");
		});
		
		$(\'#click_price\').confirmOn({
			classPrepend: \'myprefix\'
		},\'click\', function(e, confirmed) {
			if(confirmed) window.location = $(this).attr("remove-link");
		});
		
	});
</script>
'; ?>
