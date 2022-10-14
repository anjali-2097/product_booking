/*
 * Form Validation
 */
 $(document).ready(function() {
   // add the rule here
   $.validator.addMethod("valueNotEquals", function(value, element, arg){
    return arg !== value;
  }, "Select an element");

   $(document).on('submit', '#book_order_form', function(e) {
    e.preventDefault();
    var total_amount=$('#total_amount').text();
    var formdata = new FormData($('#book_order_form')[0]);
    formdata.append("total_amount",total_amount);
    if( $("#book_order_form").valid()){
      $.ajax({
        type: 'POST',
        url: base_url+"book_order", 
        data: formdata,
        dataType: "json",
        contentType: false,
        cache: false,
        processData:false,
        success: function(data){
          if(data.success==1){
            window.location=base_url;
          }
        }
      })
    }
  });

   $(".reset_btn").click(function() {
    $('#book_order_form').validate().resetForm();
    $('#total_amount').text('');
  });

 });