<script language="javascript">
var excelUpload=function(){
	document.form_file.action="<?=$url?>";
	document.form_file.submit();
	parent.dialog.dialog( "close" );
}
</script>
<form name="form_file" id="form_file" method="post" enctype="multipart/form-data">
	<input type="hidden" name="idx" id="idx" value="<?=$idx?>"/>
  <input type="file" name="file" id="file" value="file" onchange="excelUpload();"/>
</form>
