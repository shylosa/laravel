$(document).ready(function (){
	$("#example1").DataTable();
	$(".select2").select2();
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
  //Tempus-dominus bootstrap-4 datetimepicker
  $(function () {
    $('#datetimepicker4').datetimepicker({
      format: 'Y-MM-DD',
      locale: 'ru',
     /* defaultDate: moment()*/
    });
  });
  //CKEditor
  $(document).ready(function(){
    var editor = CKEDITOR.replaceAll();
    CKFinder.setupCKEditor( editor );
  });
});