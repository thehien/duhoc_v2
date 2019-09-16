<?php /* Smarty version 2.6.13, created on 2019-06-28 17:07:12
         compiled from banners/views.html */ ?>
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

<div class="row shows_insert" <?php if ($this->_tpl_vars['id_edit']): ?>style="display:block"<?php else: ?>style="display:none"<?php endif; ?>>
<div class="col-lg-12">
<div class="panel panel-default">
    <div class="panel-heading heading_title">
        <i class="fa fa-plus-circle fa-fw"></i> <?php if ($this->_tpl_vars['id_edit']):  echo @langcms_capnhat;  else:  echo @langcms_them;  endif; ?> <?php echo $this->_tpl_vars['main_name']; ?>

    </div>
    <div class="panel-body">
    <form id="frm_admin" name="frm_admin" method="post" enctype="multipart/form-data"  action="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=insert<?php echo $this->_tpl_vars['url_edit']; ?>
" >
    <div class="col-lg-6">
    <table class="table_insert">
    <thead>
        <tr>
            <td align="right"><span><?php echo @langcms_tieude; ?>
 <?php echo $this->_tpl_vars['main_name']; ?>
 <em>*</em></span></td>
            <td><input type="text" class="check_input" name="banner_name"  id="banner_name" value="<?php echo $this->_tpl_vars['rs_edit']['banner_name']; ?>
" /></td>
        </tr>
        <tr>
        <td align="right"><span><?php echo @langcms_danhmuc; ?>
 <em>*</em></span></td>
            <td>
            <select class="select_option check_input" name="category_id" id="category_id" >
                <option value=""><?php echo @langcms_chondanhmuc; ?>
</option>
                <?php $_from = $this->_tpl_vars['tree_select']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
                <option value="<?php echo $this->_tpl_vars['val']['category_id']; ?>
" <?php if ($this->_tpl_vars['val']['category_id'] == $this->_tpl_vars['rs_edit']['category_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['val']['category_name']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
            </td>
        </tr>
        <tr>
            <td align="right" valign="top"><span><?php echo @langcms_hinhanh; ?>
</span></td>
            <td> <input type="file" name="filename" id="filename" class="border_solid" value=""/>
            <?php if ($this->_tpl_vars['rs_edit']['banner_img']): ?>
            <div style="float:left">
            <input type="hidden" name="image_old" id="image_old" value="<?php echo $this->_tpl_vars['rs_edit']['banner_img']; ?>
" />
            <img src="<?php echo @IMG_UPLOAD;  echo $this->_tpl_vars['url']; ?>
/<?php echo $this->_tpl_vars['rs_edit']['banner_img']; ?>
" height="50" style="padding:5px 0px; float:left" />
            <label style="padding:5px 10px; float:left; color:#F00; width:34px">
            <input type="checkbox" value="1" name="delete_img" >
            <i style="font-size:15px" class="fa fa-trash-o"></i>
            </label>
            </div>
            <?php endif; ?>
            </td>
    	</tr>
        <tr>
            <td align="right"><span><?php echo @langcms_lienket; ?>
</span></td>
            <td><input type="text" name="banner_link"  id="banner_link" value="<?php echo $this->_tpl_vars['rs_edit']['banner_link']; ?>
" placeholder="Ex: www.web.com"/></td>
        </tr>
        <tr>
           <td align="right"><span>Color bg</span></td>
           <td><input type="text"  name="banner_bg" id="banner_bg" value="<?php echo $this->_tpl_vars['rs_edit']['banner_bg']; ?>
" placeholder="Ex: ffffff"/></td>
        </tr>
        <tr>
    	<td align="right"><b><?php echo @langcms_loaibn; ?>
:</b></td>
        <td ><select name="banner_category" id="banner_category" class="select_option">
		 <option value="0" <?php if ($this->_tpl_vars['rs_edit']['banner_category'] == 0): ?> selected="selected"<?php endif; ?>>Banner</option>
          <option value="1" <?php if ($this->_tpl_vars['rs_edit']['banner_category'] == 1): ?> selected="selected"<?php endif; ?>><?php echo @langcms_banner1; ?>
</option>
		  <option value="2" <?php if ($this->_tpl_vars['rs_edit']['banner_category'] == 2): ?> selected="selected"<?php endif; ?>><?php echo @langcms_banner2; ?>
</option>
		  <option value="3" <?php if ($this->_tpl_vars['rs_edit']['banner_category'] == 3): ?> selected="selected"<?php endif; ?>><?php echo @langcms_banner3; ?>
</option>
		  <option value="4" <?php if ($this->_tpl_vars['rs_edit']['banner_category'] == 4): ?> selected="selected"<?php endif; ?>><?php echo @langcms_banner4; ?>
</option>
          <option value="5" <?php if ($this->_tpl_vars['rs_edit']['banner_category'] == 5): ?> selected="selected"<?php endif; ?>><?php echo @langcms_banner5; ?>
</option>
          <option value="6" <?php if ($this->_tpl_vars['rs_edit']['banner_category'] == 6): ?> selected="selected"<?php endif; ?>><?php echo @langcms_banner6; ?>
</option>
        </select>
        </td>
    	</tr>
        <tr>
           <td align="right"><span><?php echo @langcms_vitri; ?>
</span></td>
           <td><input type="text"  name="pos" id="pos"  class="check_num wnum" value="<?php echo $this->_tpl_vars['rs_edit']['pos']; ?>
" maxlength="10"/></td>
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
        <tr>
            <td class="left"></td>
            <td class="center">
            <?php if ($this->_tpl_vars['id_edit']): ?><button type="submit" name="submit" id="submit" value="submit" class="bg_edit"><?php echo @langcms_capnhat; ?>
 </button>
            <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_limit'];  echo $this->_tpl_vars['url_order']; ?>
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
          <td colspan="2">
          	<script src="<?php echo @URL_HOMEPAGE; ?>
editor/standard/ckeditor.js"></script>
			<textarea class="ckeditor" id="banner_content" name="banner_content" >
            <?php echo $this->_tpl_vars['rs_edit']['banner_content']; ?>

            </textarea>
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
<!--Search-->
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
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_order']; ?>
&limit=10" <?php if ($this->_tpl_vars['limit'] == 20): ?>selected="selected"<?php endif; ?>>10</option>
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_order']; ?>
&limit=20" <?php if ($this->_tpl_vars['limit'] == 20): ?>selected="selected"<?php endif; ?>>20</option>
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_order']; ?>
&limit=50" <?php if ($this->_tpl_vars['limit'] == 50): ?>selected="selected"<?php endif; ?>>50</option>
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_order']; ?>
&limit=100" <?php if ($this->_tpl_vars['limit'] == 100): ?>selected="selected"<?php endif; ?>>100</option>
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_order']; ?>
&limit=200" <?php if ($this->_tpl_vars['limit'] == 200): ?>selected="selected"<?php endif; ?>>200</option>
           </select>
        </li>
    	<li class="lileft" style="width:40%"><div class="paging_news"><?php echo $this->_tpl_vars['paging']; ?>
</div></li>
        <li>
           <select class="cate_option" onchange="MM_jumpMenu('parent',this,0)" >
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_order'];  echo $this->_tpl_vars['url_limit']; ?>
"><?php echo @langcms_loctheo; ?>
</option>
                <?php $_from = $this->_tpl_vars['tree_select']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
                <option value="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_order'];  echo $this->_tpl_vars['url_limit']; ?>
&category=<?php echo $this->_tpl_vars['val']['category_id']; ?>
" <?php if ($this->_tpl_vars['val']['category_id'] == $this->_tpl_vars['category']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['val']['category_name']; ?>
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
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_limit']; ?>
&order=id_tem&sc=asc"><i class="fa fa-caret-up"></i></a>
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_limit']; ?>
&order=id_tem&sc=desc"><i class="fa fa-caret-down"></i></a>
          </div>
          </td>
          <td align="center"><?php echo @langcms_hinhanh; ?>
</td>
          <td><?php echo @langcms_tieude; ?>
 <?php echo $this->_tpl_vars['main_name']; ?>

          <div class="order">
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_limit']; ?>
&order=banner_name&sc=asc"><i class="fa fa-caret-up"></i></a>
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_limit']; ?>
&order=banner_name&sc=desc"><i class="fa fa-caret-down"></i></a>
          </div>
          </td>
          <td ><?php echo @langcms_danhmuc; ?>

          <div class="order">
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_limit']; ?>
&order=a.category_id&sc=asc"><i class="fa fa-caret-up"></i></a>
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_limit']; ?>
&order=a.category_id&sc=desc"><i class="fa fa-caret-down"></i></a>
          </div>
          </td>
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
        <?php $_from = $this->_tpl_vars['rs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs']):
        $this->_foreach['rs']['iteration']++;
?>
          <tr>
          <td align="center" class="mw_80"><?php echo $this->_tpl_vars['rs']['id_tem']; ?>
</td>
          <td align="center" class="mw_80">
          <?php if ($this->_tpl_vars['rs']['banner_img']): ?>
          <img src="<?php echo @IMG_UPLOAD;  echo $this->_tpl_vars['url']; ?>
/<?php echo $this->_tpl_vars['rs']['banner_img']; ?>
" height="35"/>
          <?php else: ?>
          <i class="fa fa-picture-o status_img"></i>
          <?php endif; ?>
          </td>
          <td><input type="text" name="banner_name<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['banner_name']; ?>
" /></td>
          <td><?php echo $this->_tpl_vars['rs']['category_name']; ?>
</td>
          <td align="center" class="mw_80"><input type="text" maxlength="3" size="1"  name="pos<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" value="<?php echo $this->_tpl_vars['rs']['pos']; ?>
" class="check_num" /></td>
          <td align="center" class="mw_80">
            <a href="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=status&id=<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
&status=<?php echo $this->_tpl_vars['rs']['status']; ?>
"
            <?php if ($this->_tpl_vars['rs']['status'] == 1): ?>class="status_on"<?php else: ?>class="status_off"<?php endif; ?>><i class="fa fa-check-square"></i>
            </a>
          </td>
          <?php if ($this->_tpl_vars['action_edit']): ?>
          <td align="center" class="mw_80">
              <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_category'];  echo $this->_tpl_vars['url_page'];  echo $this->_tpl_vars['url_limit'];  echo $this->_tpl_vars['url_order']; ?>
&id_edit=<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" class="status_edit">
              <i class="fa fa-pencil-square-o"></i></a>
              &nbsp;
              <a href="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=copys<?php echo $this->_tpl_vars['url_category']; ?>
&id_edit=<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" class="status_copy" title="Copy">
              <i class="fa fa-copy"></i></a>
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
