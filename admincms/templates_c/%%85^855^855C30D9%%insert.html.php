<?php /* Smarty version 2.6.13, created on 2018-01-03 04:58:42
         compiled from jobseekers/insert.html */ ?>
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

        <td align="right" class="mmw_150"><span><?php echo @langcms_ten; ?>
 <em>*</em></span></td>
        <td style="width:40%"><input type="text" class="check_input" placeholder="Name" name="news_name" id="news_name" value="<?php echo $this->_tpl_vars['rs_edit']['news_name']; ?>
" /></td>
         
         <td align="right" class="mmw_150"><span>Job title</span></td>
             <td><input type="text" name="news_title" placeholder="Job title" id="news_title" value="<?php echo $this->_tpl_vars['rs_edit']['news_title']; ?>
" class="ali_left" /></td>
        </tr>
        <tr>
             <td align="right" class="mmw_150"><span><?php echo @langcms_sptimma; ?>
</span></td>
             <td><input type="text" name="news_code"  id="news_code" placeholder="Code" value="<?php echo $this->_tpl_vars['rs_edit']['news_code']; ?>
" /></td> 
          <td align="right" class="mmw_150"><span><?php echo @langcms_linkdm; ?>
</span></td>
        <td style="width:40%"><input class="check_url" type="text" name="news_url" id="news_url" value="<?php echo $this->_tpl_vars['rs_edit']['news_url']; ?>
" placeholder="Url link"/></td>
        
        </tr>
        <tr>
            <td align="right"><span><?php echo @langcms_danhmuc; ?>
 <em>*</em></span></td>
            <td>
            <select class="select_option check_input" name="news_category" id="news_category" >
                <option value=""><?php echo @langcms_chondanhmuc; ?>
</option>
                <?php $_from = $this->_tpl_vars['tree_select']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['val'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['val']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['val']):
        $this->_foreach['val']['iteration']++;
?>
                <option value="<?php echo $this->_tpl_vars['val']['category_id']; ?>
" <?php if ($this->_tpl_vars['val']['category_id'] == $this->_tpl_vars['rs_edit']['news_category']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['val']['category_name']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
            </td>

            <td align="right" class="mmw_150"><span>Location</span></td>
             <td ><input type="text" name="news_location" placeholder="Location" id="news_location" value="<?php echo $this->_tpl_vars['rs_edit']['news_location']; ?>
" class="ali_left" /> </td>

        </tr> 
         <tr>
           <td align="right" class="mmw_150"><span>Phone</span></td>
             <td ><input type="text" name="news_phone" placeholder="DeadLine" id="news_phone" value="<?php echo $this->_tpl_vars['rs_edit']['news_phone']; ?>
" class="ali_left" /> </td>

            <td align="right" class="mmw_150"><span>Email</span></td>
             <td ><input type="text" name="news_email" placeholder="Location" id="news_email" value="<?php echo $this->_tpl_vars['rs_edit']['news_email']; ?>
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
             <td align="right" class="mmw_150"><span>Level Japanese</span></td>
             <td ><input type="text" name="news_language" placeholder="Level" id="news_language" value="<?php echo $this->_tpl_vars['rs_edit']['news_language']; ?>
" class="ali_left" /> </td>
         </tr>
          <tr>
             

            <td align="right" class="mmw_150"><span>Salary</span></td>
             <td ><input type="text" name="news_salary" placeholder="Salary" id="news_salary" value="<?php echo $this->_tpl_vars['rs_edit']['news_salary']; ?>
" class="ali_left" /> </td>

              <td align="right" class="mmw_150"><span>Experience</span></td>
             <td ><input type="text" name="news_exp" placeholder="Experience" id="news_exp" value="<?php echo $this->_tpl_vars['rs_edit']['news_exp']; ?>
" class="ali_left" /> </td>

            
         </tr>

         <tr>
           <td align="right" class="mmw_150"><span>Download CV(Resume)</span></td>
             <td ><a href="<?php echo @URL_HOME; ?>
/<?php echo $this->_tpl_vars['rs_edit']['cv_file']; ?>
"> Download : <i class="fa fa-download"></i></a></td>

        </tr> 
         <tr>
             <td align="right" class="mmw_150"><span>Request Working</span></td>
             <td colspan="3">
                 <textarea class="ckeditor" name="news_message" id="news_message"><?php echo $this->_tpl_vars['rs_edit']['news_message']; ?>
</textarea>
             <?php echo '<script type="text/javascript">CKEDITOR.replace( \'news_message\'); </script>'; ?>

             </td>
            
         </tr>

        <tr>
             <td align="right" class="mmw_150"><span>Education</span></td>
             <td colspan="3">
                 <textarea class="ckeditor" name="news_education" id="news_education"><?php echo $this->_tpl_vars['rs_edit']['news_education']; ?>
</textarea>
             <?php echo '<script type="text/javascript">CKEDITOR.replace( \'news_education\'); </script>'; ?>

             </td>
            
         </tr>

         <tr>
             <td align="right" class="mmw_150"><span>Experience</span></td>
             <td colspan="3">
             <textarea class="ckeditor" name="news_experience_detail" id="news_experience_detail"><?php echo $this->_tpl_vars['rs_edit']['news_experience_detail']; ?>
</textarea>
             <?php echo '<script type="text/javascript">CKEDITOR.replace(\'news_experience_detail\'); </script>'; ?>

             </td>
         </tr>


         <tr>
             <td align="right" class="mmw_150"><span>About me</span></td>
             <td colspan="3">
             <textarea class="ckeditor" name="news_contact" id="news_contact"><?php echo $this->_tpl_vars['rs_edit']['news_contact']; ?>
</textarea>
             <?php echo '<script type="text/javascript">CKEDITOR.replace(\'news_contact\'); </script>'; ?>

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
        <td align="right" class="mmw_150"><span style="font-weight: bold;">Job Type</span></td>
        <td>
        <select class="select_option check_input" name="job_type" id="job_type">
              <option value="0" <?php if ($this->_tpl_vars['rs_edit']['job_type'] == 0): ?>selected<?php endif; ?>>Job Part-time</option>
            <option value="1" <?php if ($this->_tpl_vars['rs_edit']['job_type'] == 1): ?>selected<?php endif; ?>>Job Full-time</option>
            
        </select>
        </td>
        <td align="right" class="mmw_150"><span><?php echo @langcms_trangthai; ?>
</span></td>
        <td>
        <select class="select_option check_input" name="status" id="status">
            <option value="1" <?php if ($this->_tpl_vars['rs_edit']['status'] == 1): ?>selected<?php endif; ?>>Display</option>
            <option value="0" <?php if ($this->_tpl_vars['rs_edit']['status'] == 0): ?>selected<?php endif; ?>>Don't display</option>
        </select>
        </td>
        <td align="right" class="mmw_150"><span>Hot job</span></td>
        <td>
        <select class="select_option check_input" name="home" id="home">
            <option value="1" <?php if ($this->_tpl_vars['rs_edit']['home'] == 1): ?>selected<?php endif; ?>>Display</option>
            <option value="0" <?php if ($this->_tpl_vars['rs_edit']['home'] == 0): ?>selected<?php endif; ?>>Don't display</option>
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
