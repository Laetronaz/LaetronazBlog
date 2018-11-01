var reader = new FileReader();
reader.onload = function (e) {
  	$('#preview').attr('src', e.target.result);
}
   
   function readURL(input) {
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("[name=userfile]").change(function(){
        readURL(this);
    });