<?php /* Smarty version 2.6.13, created on 2018-02-03 09:06:24
         compiled from translater/insert.html */ ?>
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
<table class="table_insert category_tree table-striped table-hover" style="margin-top:0px" >
    <tbody class="pro_tbody">
    <tr data-tt-id="20" class="pro_tr" >
        <td><strong><?php echo @langcms_spttcb; ?>
 </strong></td>
    </tr>
    <tr data-tt-id="21" data-tt-parent-id="20" style="display: none;">
    <td>
    <div class="col-lg-12">
    <table class="table_insert">
    <thead>
        <tr>

        <td align="right" class="mmw_150"><span>Tên người phiên dịch <em>*</em></span></td>
        <td style="width:40%"><input type="text" class="check_input" placeholder="Tên người phiên dịch" name="name" id="name" value="<?php echo $this->_tpl_vars['rs_edit']['name']; ?>
" /></td>
         
        <td align="right" class="mmw_150"><span>Địa chỉ</span></td>
        <td><input type="text" name="address" placeholder="Địa chỉ" id="address" value="<?php echo $this->_tpl_vars['rs_edit']['address']; ?>
" class="ali_left" /></td>
        </tr>
        <tr>
             <td align="right" class="mmw_150"><span>Kinh độ</span></td>
             <td><input type="text" name="longitude" id="longitude" placeholder="Kinh độ(longitude)" value="<?php echo $this->_tpl_vars['rs_edit']['longitude']; ?>
" /></td> 
          <td align="right" class="mmw_150"><span>Vĩ độ</span></td>
        <td style="width:40%"><input type="text" name="latitude" id="latitude" value="<?php echo $this->_tpl_vars['rs_edit']['latitude']; ?>
" placeholder="Vĩ độ (latitude)"/></td>
        
        </tr>
        
         <tr>
           <td align="right" class="mmw_150"><span>Điện thoại</span></td>
             <td ><input type="text" name="mobile" placeholder="Điện thoại" id="mobile" value="<?php echo $this->_tpl_vars['rs_edit']['mobile']; ?>
" class="ali_left" /> </td>

            <td align="right" class="mmw_150"><span>Email</span></td>
             <td ><input type="text" name="news_email" placeholder="Email" id="news_email" value="<?php echo $this->_tpl_vars['rs_edit']['news_email']; ?>
" class="ali_left" /> </td>

        </tr> 
     
          <tr>

             <td align="right" valign="top"><span>Images</span></td>
            <td valign="top"> <input type="file" name="filename" id="filename" class="border_solid" value=""/>
            <?php if ($this->_tpl_vars['rs_edit']['news_img']): ?>
            <div style="float:left">
            <input type="hidden" name="image_old" id="image_old" value="<?php echo $this->_tpl_vars['rs_edit']['news_img']; ?>
" />
            <input type="hidden" name="file_old" id="file_old" value="<?php echo $this->_tpl_vars['rs_edit']['img_file']; ?>
" />
            <img src="<?php echo @IMG_UPLOAD;  echo $this->_tpl_vars['url']; ?>
/<?php echo $this->_tpl_vars['rs_edit']['img_file']; ?>
/<?php echo $this->_tpl_vars['rs_edit']['news_img']; ?>
" height="50" style="padding:5px 0px; float:left" />
            <label style="padding:5px 10px; float:left; color:#F00; width:34px">
            <input type="checkbox" value="1" name="delete_img" >
            <i style="font-size:15px" class="fa fa-trash-o"></i>
            </label>
            </div>
            <?php endif; ?>
           
            </td>
         <td align="right" class="mmw_150"><span><?php echo @langcms_linkdm; ?>
</span></td>
        <td style="width:40%"><input class="check_url" type="text" name="url" id="url" value="<?php echo $this->_tpl_vars['rs_edit']['url']; ?>
" placeholder="Url link"/></td>
         </tr>
         

        
         <tr>
             <td align="right" class="mmw_150"><span>Dịch từ ngôn ngữ</span></td>
             <td colspan="3">
                 <textarea class="ckeditor" name="fromlanguage" id="fromlanguage"><?php echo $this->_tpl_vars['rs_edit']['fromlanguage']; ?>
</textarea>
             <?php echo '<script type="text/javascript">CKEDITOR.replace(\'fromlanguage\'); </script>'; ?>

             </td>
            
         </tr>

          <tr>
             <td align="right" class="mmw_150"><span>Dịch sang Ngôn ngữ</span></td>
             <td colspan="3">
                 <textarea class="ckeditor" name="tolanguage" id="tolanguage"><?php echo $this->_tpl_vars['rs_edit']['tolanguage']; ?>
</textarea>
             <?php echo '<script type="text/javascript">CKEDITOR.replace(\'tolanguage\'); </script>'; ?>

             </td>
            
         </tr>
      </thead>  
    </table>
    </div>
    </td>
    </tr>
    </tbody>

    <tbody class="pro_tbody">
    <tr data-tt-id="40" class="pro_tr" >
        <td><strong><?php echo @langcms_spqlht; ?>
</strong></td>
    </tr>
    <tr data-tt-id="41" data-tt-parent-id="40" style="display: none; background:none !important">
    <td>
    <div class="col-lg-12">
    <table class="table_insert">
    <thead>
    <tr>
        
        <td align="right" class="mmw_150"><span><?php echo @langcms_trangthai; ?>
</span></td>
        <td>
        <select class="select_option check_input" name="status" id="status">
            <option value="1" <?php if ($this->_tpl_vars['rs_edit']['status'] == 1): ?>selected<?php endif; ?>>Hiển thị</option>
            <option value="0" <?php if ($this->_tpl_vars['rs_edit']['status'] == 0): ?>selected<?php endif; ?>>Không hiển thị</option>
        </select>
        </td>
       

        
    </tr>
    
   </thead>  
    </table>
    </div>
    </td>
    </tr>
    </tbody>

    <tbody class="pro_tbody">
    <tr data-tt-id="60" class="pro_tr" >
        <td><strong>Meta Seo</strong></td>
    </tr>
    <tr data-tt-id="61" data-tt-parent-id="60" style="display: none;">
    <td>
    <div class="col-lg-12">
    <table class="table_insert">
    <thead>
        <tr>
            <td align="right" class="mmw_150"><span>Seo Title</span></td>
            <td style="width:40%"><input type="text" name="seo_title"  id="seo_title" value="<?php echo $this->_tpl_vars['rs_edit']['seo_title']; ?>
" placeholder="Seo H1"  /></td>
            <td align="right" class="mmw_150"><span>Meta Keywords</span></td>
            <td style="width:40%"><input type="text" name="seo_key"  id="seo_key" value="<?php echo $this->_tpl_vars['rs_edit']['seo_key']; ?>
" placeholder="Seo Keywords"  /></td>
        </tr>
        <tr>
          <td align="right" valign="top"><span>Meta Content</span></td>
          <td colspan="3"><textarea class="form-control" rows="3" name="seo_desc"  id="seo_desc" placeholder="Seo H2" ><?php echo $this->_tpl_vars['rs_edit']['seo_desc']; ?>
</textarea></td>
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
