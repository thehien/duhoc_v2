<?php /* Smarty version 2.6.13, created on 2019-05-19 09:46:30
         compiled from service/insert.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" src="<?php echo @URL_HOMEPAGE; ?>
editor/ckeditor/ckeditor.js"></script>
<div id="page-wrapper">
    <form id="frm_admin" name="frm_admin" method="post" enctype="multipart/form-data" action="<?php echo @URL_ADMIN; ?>
?module=<?php echo $this->_tpl_vars['url']; ?>
&main=insert<?php echo $this->_tpl_vars['url_edit']; ?>
">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><a href="<?php echo $this->_tpl_vars['url_views']; ?>
" ><i class="fa fa-home"></i> 
                <?php if ($this->_tpl_vars['id_edit']):  echo @langcms_capnhat;  else:  echo @langcms_them;  endif; ?> <?php echo $this->_tpl_vars['main_name']; ?>
</a>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" >
            <table class="table_insert category_tree table-striped" style="margin-top:0px" >
                <tbody class="pro_tbody">
                    <tr data-tt-id="20" class="pro_tr" >
                        <td><strong><?php echo @langcms_spttcb; ?>
 </strong></td>
                    </tr>
                    <tr data-tt-id="21" data-tt-parent-id="20" style="display: none;">
                        <td>
                            <div class="col-lg-12">
                                <table class="table_insert" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <td align="right" class="mmw_250"><span><?php echo @langcms_service; ?>
 <em>*</em></span></td>
                                            <td style="width: 300px;"><input type="text" class="check_input" placeholder="<?php echo @langcms_service; ?>
" name="name" id="name" value="<?php echo $this->_tpl_vars['rs_edit']['name']; ?>
" /></td>

                                            <td align="right" class="mmw_250"><span>Code <em>*</em></span></td>
                                            <td style="width: 300px;">
                                               <input type="text" class="check_input" placeholder="Code" name="code" id="code" value="<?php echo $this->_tpl_vars['rs_edit']['code']; ?>
" />
                                           </td>

                                       </tr>
                               <tr>

                                    <td align="right" class="mmw_250"><span><?php echo @langcms_trangthai; ?>
</span></td>
                                    <td>
                                        <select class="select_option check_input" name="status" id="status">
                                            <option value="1" <?php if ($this->_tpl_vars['rs_edit']['status'] == 1): ?>selected<?php endif; ?>>Hiển thị</option>
                                            <option value="0" <?php if ($this->_tpl_vars['rs_edit']['status'] == 0): ?>selected<?php endif; ?>>Không hiển thị</option>
                                        </select>
                                    </td>

                                <td align="right"><span><?php echo @langcms_linkdm; ?>
</span></td>
                                <td style="width:40%"><input class="check_url" type="text" name="service_url" id="service_url" value="<?php echo $this->_tpl_vars['rs_edit']['service_url']; ?>
" placeholder="Ex: san-pham"/>
                                </td>
                                </tr>

                                 <tr>
                                <td align="right" valign="top"><span><?php echo @langcms_small; ?>
</span></td>
                                <td class="center" colspan="3">
                                    <textarea class="ckeditor" name="service_content" id="service_content"><?php echo $this->_tpl_vars['rs_edit']['service_content']; ?>
</textarea>
                                    <?php echo '
                                    <script type="text/javascript">CKEDITOR.replace(\'service_content\'); </script>
                                    '; ?>

                                </td>
                            </tr>
                            </thead>  
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>

        <tr>
            <td align="right" style="background:#FFF; height:100px ">
                <?php if ($this->_tpl_vars['id_edit']): ?><button type="submit" name="submit" id="submit" value="submit" class="bg_edit" ><?php echo @langcms_capnhat; ?>
 </button>
                <a href="<?php echo $this->_tpl_vars['rs_undo']; ?>
" class="status_undo"><i class="fa fa-undo"></i> <?php echo @langcms_quaylai; ?>
</a>
                <?php else: ?><button type="submit" name="submit" id="submit" value="submit" class="bg_insert" ><?php echo @langcms_themmoi; ?>
 </button><?php endif; ?>
            </td>
        </tr>
    </table>
</div>     
</div>
</form>
</div>

<?php echo '
<script>
    loadstatustext = \'Loading...\';
    function ajaxLoad(url,id)
    {
        if (document.getElementById){var x = (window.ActiveXObject) ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest();}
        if (x)
        {
            x.onreadystatechange = function()
            {
                el = document.getElementById(id);
                el.innerHTML = loadstatustext;
                if (x.readyState == 4 && x.status == 200){el.innerHTML = x.responseText;}
            }
            x.open("GET", url, true);
            x.send(null);
        }
    }
    function pb_display(x) 
    {
        ajaxLoad(\'';  echo @URL_ADMINCMS;  echo 'district.php?cityid=\'+x,\'district_shows\');
    }
    ajaxLoad(\'';  echo @URL_ADMINCMS; ?>
district.php?cityid=<?php echo $this->_tpl_vars['rs_edit']['cityid']; ?>
&district_id=<?php echo $this->_tpl_vars['rs_edit']['district'];  echo '\',\'district_shows\');
</script>
'; ?>
