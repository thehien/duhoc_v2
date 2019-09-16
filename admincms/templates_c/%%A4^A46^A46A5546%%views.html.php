<?php /* Smarty version 2.6.13, created on 2019-07-10 18:51:24
         compiled from categorys/views.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script src="<?php echo @URL_HOMEPAGE; ?>
editor/ckeditor/ckeditor.js"></script>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><a href="#"><i class="fa fa-hand-o-right"></i> <?php echo $this->_tpl_vars['main_content']; ?>
</a></h1>
        </div>
    </div>

    <div class="row shows_insert" <?php if ($this->_tpl_vars['id_edit']): ?>style="display:block" <?php else: ?>style="display:none" <?php endif; ?>>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading heading_title">
                <i class="fa fa-plus-circle fa-fw"></i> <?php if ($this->_tpl_vars['id_edit']):  echo @langcms_capnhat;  else:  echo @langcms_them;  endif; ?> <?php echo $this->_tpl_vars['main_name']; ?>

            </div>
            <div class="panel-body">
                <form id="frm_admin" name="frm_admin" method="post" enctype="multipart/form-data"
                      action="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=insert<?php echo $this->_tpl_vars['url_edit']; ?>
">
                    <div class="col-lg-6 no-padding">
                        <table class="table_insert">
                            <thead>
                            <tr>
                                <td align="right"><span><?php echo @langcms_ten; ?>
 <?php echo $this->_tpl_vars['main_name']; ?>
<em>*</em></span></td>
                                <td><input type="text" class="check_input" name="category_name" id="category_name"
                                           value="<?php echo $this->_tpl_vars['rs_edit']['category_name']; ?>
"/></td>
                            </tr>
                            <tr>
                                <td align="right"><span><?php echo @langcms_linkdm; ?>
</span></td>
                                <td><input class="check_url" type="text" name="category_url" id="category_url"
                                           value="<?php echo $this->_tpl_vars['rs_edit']['category_url']; ?>
" placeholder="Ex: san-pham"/></td>
                            </tr>
                            <tr>
                                <td align="right"><span><?php echo @langcms_danhmuc; ?>
</span></td>
                                <td>
                                    <select class="select_option" name="parent_id" id="parent_id">
                                        <option value="0"><?php echo @langcms_chondanhmuc; ?>
</option>
                                        <?php $_from = $this->_tpl_vars['tree_select']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
                                        <!-- <option value="<?php echo $this->_tpl_vars['val']['category_id']; ?>
" <?php if ($this->_tpl_vars['val']['category_id'] == $this->_tpl_vars['rs_edit']['parent_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['val']['category_name']; ?>
</option>-->
                                        <?php if ($this->_tpl_vars['rs_edit']['category_id']): ?>
                                        <option value="<?php echo $this->_tpl_vars['val']['category_id']; ?>
" <?php if ($this->_tpl_vars['val']['category_id'] == $this->_tpl_vars['rs_edit']['parent_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['val']['category_name']; ?>
</option>
                                        <?php else: ?>
                                        <option value="<?php echo $this->_tpl_vars['val']['category_id']; ?>
" <?php if ($this->_tpl_vars['val']['category_id'] == $_SESSION['info']['parent_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['val']['category_name']; ?>
</option>
                                        <?php endif; ?>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" valign="top"><span><?php echo @langcms_hinhanh; ?>
</span></td>
                                <td><input type="file" name="filename" id="filename" class="border_solid" value=""/>
                                    <?php if ($this->_tpl_vars['rs_edit']['category_img']): ?>
                                    <div style="float:left">
                                        <input type="hidden" name="image_old" id="image_old"
                                               value="<?php echo $this->_tpl_vars['rs_edit']['category_img']; ?>
"/>
                                        <img src="<?php echo @IMG_UPLOAD;  echo $this->_tpl_vars['url']; ?>
/<?php echo $this->_tpl_vars['rs_edit']['category_img']; ?>
" height="50"
                                             style="padding:5px 0px; float:left"/>
                                        <label style="padding:5px 10px; float:left; color:#F00; width:34px">
                                            <input type="checkbox" value="1" name="delete_img">
                                            <i style="font-size:15px" class="fa fa-trash-o"></i>
                                        </label>
                                    </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><span><?php echo @langcms_lienket; ?>
</span></td>
                                <td><input type="text" name="link" id="link" value="<?php echo $this->_tpl_vars['rs_edit']['link']; ?>
"
                                           placeholder="Ex: www.web.com"/></td>
                            </tr>

                            <tr>
                                <td align="right"><span>Category code</span></td>
                                <td><input type="text" name="category_code" id="category_code" value="<?php echo $this->_tpl_vars['rs_edit']['category_code']; ?>
"
                                           placeholder="category content"/></td>
                            </tr>

                            <tr>
                                <td class="left"></td>
                                <td class="center">
                                    <?php if ($this->_tpl_vars['id_edit']): ?>
                                    <button type="submit" name="submit" id="submit" value="submit" class="bg_edit">
                                        <?php echo @langcms_capnhat; ?>

                                    </button>
                                    <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_limit'];  echo $this->_tpl_vars['url_order']; ?>
" class="status_undo"><i
                                            class="fa fa-undo"></i> <?php echo @langcms_quaylai; ?>
</a>
                                    <?php else: ?>
                                    <button type="submit" name="submit" id="submit" value="submit" class="bg_insert">
                                        <?php echo @langcms_themmoi; ?>

                                    </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-lg-6 no-padding">
                        <table class="table_insert">
                            <thead>
                            <tr>
                                <td align="right"><span><?php echo @langcms_loaitin; ?>
</span></td>
                                <td colspan="3">
                                    <select name="news_url" id="news_url" class="select_option">
                                        <option value=""><?php echo @langcms_sanpham; ?>
</option>
                                        <option value="menu/" <?php if ($this->_tpl_vars['rs_edit']['news_url']): ?>selected<?php endif; ?>><?php echo @langcms_baiviet; ?>
</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><span><?php echo @langcms_giaodien; ?>
</span></td>
                                <td colspan="3">
                                    <select name="layout" id="layout" class="select_option">
                                        <option value="">layout</option>
                                        <option value="01" <?php if ($this->_tpl_vars['rs_edit']['layout'] == 01): ?>selected<?php endif; ?>>layout 1</option>
                                        <option value="02" <?php if ($this->_tpl_vars['rs_edit']['layout'] == 02): ?>selected<?php endif; ?>>layout 2</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><span><?php echo @langcms_mauchu; ?>
</span></td>
                                <td><input type="text" name="color" id="color" value="<?php echo $this->_tpl_vars['rs_edit']['color']; ?>
" class="wnum"/>
                                </td>

                                <td align="right"><span><?php echo @langcms_tilept; ?>
</span></td>
                                <td><input type="text" name="total_percent" id="total_percent" maxlength="2"
                                           class="check_num wnum" value="<?php echo $this->_tpl_vars['rs_edit']['total_percent']; ?>
"/></td>
                            </tr>
                            <tr>
                                <td align="right"><span><?php echo @langcms_vitri; ?>
</span></td>
                                <td><input type="text" name="pos" id="pos" class="check_num wnum" value="<?php echo $this->_tpl_vars['rs_edit']['pos']; ?>
"
                                           maxlength="3"/></td>

                                <td align="right"><span><?php echo @langcms_trangthai; ?>
</span></td>
                                <td>
                                    <select class="select_option wnum" name="status" id="status">
                                        <option value="1" <?php if ($this->_tpl_vars['rs_edit']['status'] == 1): ?>selected<?php endif; ?>>On</option>
                                        <option value="0" <?php if ($this->_tpl_vars['rs_edit']['status'] == 0): ?>selected<?php endif; ?>>Off</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"></td>
                                <td colspan="3">
                                    <div class="note">META SEO</div>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><span>Seo Title</span></td>
                                <td colspan="3"><input type="text" name="seo_title" id="seo_title"
                                                       value="<?php echo $this->_tpl_vars['rs_edit']['seo_title']; ?>
" placeholder="Seo H1"/></td>
                            </tr>
                            <tr>
                                <td align="right"><span>Meta Keywords</span></td>
                                <td colspan="3"><input type="text" name="seo_key" id="seo_key"
                                                       value="<?php echo $this->_tpl_vars['rs_edit']['seo_key']; ?>
" placeholder="Seo Keywords"/></td>
                            </tr>
                            <tr>
                                <td align="right" valign="top"><span>Meta Content</span></td>
                                <td colspan="3"><textarea class="form-control" rows="5" name="seo_desc" id="seo_desc"
                                                          placeholder="Seo H2"><?php echo $this->_tpl_vars['rs_edit']['seo_desc']; ?>
</textarea></td>
                            </tr>


                            </thead>
                        </table>

                    </div>

                    <div class="col-lg-12 no-padding">
                        <tr>
                            <td align="right" valign="top"><span><strong>Content</strong></span></td>
                            <td>
                                    <textarea rows="5"
                                              class="form-control ckeditor" name="category_content"
                                              id="category_content"><?php echo $this->_tpl_vars['rs_edit']['category_content']; ?>
</textarea>

                            </td>
                        </tr>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <form name="frm_news" method="POST">
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
                            <a href="javascript:void(0);" onclick="status_off('frm_news');" class="bg_off">
                                <i class="fa fa-minus-square"></i> <?php echo @langcms_vohieu; ?>
</a>
                            <a href="javascript:void(0);" onClick="update_order('frm_news');" class="bg_edit">
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
                                <?php echo @langcms_ten; ?>
 <?php echo $this->_tpl_vars['main_name']; ?>

                                <div class="order">
                                    <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_limit']; ?>
&order=category_name&sc=asc"><i
                                            class="fa fa-caret-up"></i></a>
                                    <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_limit']; ?>
&order=category_name&sc=desc"><i
                                            class="fa fa-caret-down"></i></a>
                                </div>
                            </td>
                            <td align="center" class="mw_100"><?php echo @langcms_loaitin; ?>
</td>
                                                        <td align="center"><?php echo @langcms_tilept; ?>
</td>
                            <td align="center"><?php echo @langcms_vitri; ?>
</td>
                            <td align="center">ID</td>
                            <td align="center" class="mw_80"><?php echo @langcms_trangthai; ?>
</td>
                            <?php if ($this->_tpl_vars['action_edit']): ?>
                            <td align="center" class="mw_80"><?php echo @langcms_capnhat; ?>
</td>
                            <?php endif; ?>
                            <td align="center"><label><input type="checkbox" data-toggle="checkall"
                                                             data-target="input[id=checks]"/></label></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $_from = $this->_tpl_vars['rs_tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rs']):
        $this->_foreach['rs']['iteration']++;
?>
                        <tr data-tt-id="<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" <?php if ($this->_tpl_vars['rs']['parent_id'] > 0): ?>data-tt-parent-id="<?php echo $this->_tpl_vars['rs']['parent_id']; ?>
" <?php endif; ?>>
                        <td><?php echo $this->_tpl_vars['rs']['category_name']; ?>
</td>
                        <td>
                            <a href="<?php echo @URL_HOMEPAGE;  echo $this->_tpl_vars['rs']['news_url'];  echo $this->_tpl_vars['rs']['category_url']; ?>
.html" target="_blank">
                                <i class="fa fa-hand-o-right"></i>
                                <?php if ($this->_tpl_vars['rs']['news_url']):  echo @langcms_baiviet;  else: ?><strong><?php echo @langcms_sanpham; ?>
</strong><?php endif; ?>
                            </a>
                        </td>
                        
                        <td align="center"><input type="text" maxlength="2" size="1" name="total_percent<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
"
                                                  value="<?php echo $this->_tpl_vars['rs']['total_percent']; ?>
" class="check_num"
                                                  <?php if ($this->_tpl_vars['rs']['news_url']): ?>style="display:none" <?php endif; ?> />
                        </td>
                        <td align="center"><input type="text" maxlength="3" size="1" name="pos<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
"
                                                  value="<?php echo $this->_tpl_vars['rs']['pos']; ?>
" class="check_num"/></td>
                        <td align="center"><?php echo $this->_tpl_vars['rs']['category_id']; ?>
</td>
                        <td align="center">
                            <a href="<?php echo $this->_tpl_vars['url_views']; ?>
&main=status&id=<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
&status=<?php echo $this->_tpl_vars['rs']['status']; ?>
"
                               <?php if ($this->_tpl_vars['rs']['status'] == 1): ?>class="status_on" <?php else: ?>class="status_off" <?php endif; ?>><i
                                class="fa fa-check-square"></i>
                            </a>
                        </td>
                        <?php if ($this->_tpl_vars['action_edit']): ?>
                        <td align="center">
                            <a href="<?php echo $this->_tpl_vars['url_views'];  echo $this->_tpl_vars['url_limit'];  echo $this->_tpl_vars['url_order']; ?>
&id_edit=<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
" class="status_edit"><i
                                    class="fa fa-pencil-square-o"></i></a>
                        </td>
                        <?php endif; ?>
                        <td align="center"><label><input type="checkbox" id="checks" name="checkbox_id[]"
                                                         value="<?php echo $this->_tpl_vars['rs']['id_tem']; ?>
"/></label></td>
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