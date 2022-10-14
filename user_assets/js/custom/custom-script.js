$(document).ready(function(){
	$('.datepicker').datepicker({format: 'yyyy-mm-dd'});
	$("#book_order_form").validate({
		rules: {
			customer_name: {
				required: true,
				minlength: 5
			},
			mobile_number: {
				required: true,
				number: true,
				minlength:10,
				maxlength:10,
			},
			pick_up_loc:{
				valueNotEquals: "default",
			},
			pick_up_date:{
				required: true,
			},
			"product_detail[0][product_name]": {
				required: true,
			},
			"product_detail[0][product_sub_category]": {
				required: true,
			},
			"product_detail[0][quantity]": {
				required: true,
				range: [1, 25],
			},
		},
		messages: {
			customer_name: {
				required: "Enter a Customer Name",
				minlength: "Enter at least 5 characters",
			},
			mobile_number: {
				required: "Enter Mobile Number",
				number: "Mobile Number must contain only numbers",
				minlength:"Mobile Number must be of 10 digits",
				maxlength:"Mobile Number must be of 10 digits",
			},
			pick_up_loc:{
				valueNotEquals: "Select Pick Up Location",
			},
			pick_up_date:{
				required: "Select Date",
			},
			"product_detail[0][product_name]": {
				required: "Please Select Product",
			},
			"product_detail[0][product_sub_category]": {
				required: "Please Select Product Subcategory",
			},
			"product_detail[0][quantity]": {
				required: "Please enter Quantity",
				range: "Please enter a value between {0} and {1}.",
			}
		},    
	});

	$('#product_name0').change(function(){
		$("#quantity0").prop("readonly", true); 
		var id=$("#product_name0").val();
		$('#product_sub_category0').empty();
		$('#quantity0').val('');
		$('#cost_per_product0').val('');
		$('#total_cost0').val('');
		$("#product_sub_category0").append('<option value="" selected disabled>Choose your product</option>');
		$.ajax({
			type: 'POST',
			url: base_url+"fetch_subproduct", 
			data: {product_id:id},
			dataType: "json",
			success: function(data){
				if(data.success==1){
					$.each(data.data.subcat_name , function(index, val) {
						if (data.data.subcat_name[0]!="") {
							$("#product_sub_category0").append('<option value="'+data.data.sub_cat_id[index]+'">'+val+'</option>');
						}
					});
				}
			}
		})
	});

	$('#product_sub_category0').change(function(){
		$("#quantity0").prop("readonly", false);
		$('#quantity0').val('');
		$('#cost_per_product0').val('');
		$('#total_cost0').val(''); 
		var id=$("#product_sub_category0").val();
		$.ajax({
			type: 'POST',
			url: base_url+"get_subcat_price", 
			data: {product_subcat_id:id},
			dataType: "json",
			success: function(data){
				if(data.success==1){
					// console.log(data);
					$("#cost_per_product0").val(data.price);
				}
			}
		})
	});

	$('#quantity0').change(function(){
		var quantity=$("#quantity0").val();
		var unit_price=$("#cost_per_product0").val();

		if(counter!=1){
			// console.log(counter);
			var result=0;
			var j=0;
			for (i = 1; i <= counter; i++) {
				if(isNaN($('#total_cost'+j+'').val())){
					// console.log('NaN');
				}else{
					var quantity=$("#quantity0").val();
					var unit_price=$("#cost_per_product0").val();
					var total_price= quantity*unit_price;
					var total_price=total_price.toFixed(2); 
					$("#total_cost0").val(total_price);
					result = result + parseFloat($('#total_cost'+j+'').val());
				}
				j+=1;
			} 
			result=result.toFixed(2); 
			$("#total_amount").text(result);
		}else{

			var total_price= quantity*unit_price;
			var total_price=total_price.toFixed(2); 

			$("#total_cost0").val(total_price);
			$("#total_amount").text(total_price);
		}
	});

	_.templateSettings.variable = "element";
	var tpl = _.template($("#form_tpl").html());

	var counter = 1;

	$(document).on("click", ".add_new_product", function (e) {
		if( $("#book_order_form").valid()){
			e.preventDefault();
			var tplData = {
				i: counter
			};
			$(".add_new").append(tpl(tplData));

			$('select[name="product_detail['+counter+'][product_name]"]').rules("add", {
				required:true,
				messages: {
					required: "Please Select Product"
				}
			});

			$('select[name="product_detail['+counter+'][product_sub_category]"]').rules("add", {
				required:true,
				messages: {
					required: "Please Select Product Subcategory"
				}
			});

			$('input[name="product_detail['+counter+'][quantity]"]').rules("add", {
				required:true,
				range: [1, 25],
				messages: {
					required: "Please enter Quantity",
					range: "Please enter a value between {0} and {1}.",
				}
			});

			$('#product_name'+counter+'').change(function(){
				var select_tag_id = $(this).attr('id');
				var row_id=select_tag_id.slice(12);
				$('#quantity'+row_id+'').prop("readonly", true); 
				$('#quantity'+row_id+'').val('');
				$('#cost_per_product'+row_id+'').val('');
				$('#total_cost'+row_id+'').val('');
				var id=this.value;
				$('#product_sub_category'+row_id+'').empty();
				$('#product_sub_category'+row_id+'').append('<option value="" selected disabled>Choose your product</option>');
				$.ajax({
					type: 'POST',
					url: base_url+"fetch_subproduct", 
					data: {product_id:id},
					dataType: "json",
					success: function(data){
						if(data.success==1){
							$.each(data.data.subcat_name , function(index, val) {
								if (data.data.subcat_name[0]!="") {
									$('#product_sub_category'+row_id+'').append('<option value="'+data.data.sub_cat_id[index]+'">'+val+'</option>');
								}
							});
						}
					}
				})
			})

			$('#product_sub_category'+counter+'').change(function(){
				var tag_id = $(this).attr('id');
				var row_id=tag_id.slice(20);
				$('#quantity'+row_id+'').val('');
				$('#cost_per_product'+row_id+'').val('');
				$('#total_cost'+row_id+'').val('');
				$('#quantity'+row_id+'').prop("readonly", false); 
				var id=this.value;		
				$.ajax({
					type: 'POST',
					url: base_url+"get_subcat_price", 
					data: {product_subcat_id:id},
					dataType: "json",
					success: function(data){
						if(data.success==1){
							$('#cost_per_product'+row_id+'').val(data.price);
						}
					}
				})
			});

			$('#quantity'+counter+'').change(function(){
				var tag_id = $(this).attr('id');
				var row_id=tag_id.slice(8);

				var quantity=$('#quantity'+row_id+'').val();
				var unit_price=$('#cost_per_product'+row_id+'').val();

				var total_price= quantity*unit_price;
				var total_price=total_price.toFixed(2); 

				var result = parseFloat(0);
				var k=0;
				$('#total_cost'+row_id+'').val(total_price);
				for (i = 0; i <= row_id; i++) {

					if(isNaN($('#total_cost'+k+'').val())){
						// console.log('NaN');
					}else{
						var quantity=$("#quantity0").val();
						var unit_price=$("#cost_per_product0").val();
						var total_price= quantity*unit_price;
						var total_price=total_price.toFixed(2); 
						$("#total_cost0").val(total_price);
						result = result + parseFloat($('#total_cost'+k+'').val());
					}
					k+=1;
				}
				var result=result.toFixed(2); 
				$("#total_amount").text(result);

			});

			counter += 1;

		}
	});

	$(document).on('click','.remove_row',function(){

		var id = this.id;
		var split_id = id.split("_");
		var deleteindex = split_id[1];

		var del_cost=$('#total_cost'+deleteindex+'').val();
		var total_cost=$('#total_amount').text();
		if (isNaN(del_cost)) {
			del_cost=parseFloat(0);
		}
		var updated_cost=total_cost - del_cost;
		$('#total_amount').text(updated_cost.toFixed(2));
		// return false;

  // Remove <div> with id
  $("#addrow_" + deleteindex).remove();


});
});
