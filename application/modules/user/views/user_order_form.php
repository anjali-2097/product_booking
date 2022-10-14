<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('user_template/header.php');
?>
<script type="text/javascript" src="http://underscorejs.org/underscore-min.js"></script>
<!-- BEGIN: Page Main-->
<div id="main">
	<div class="row">
		<div class="col s12">
			<div class="container-fluid">
				<!--card stats start-->
				<div class="row">
					<div class="col s12 m12 32 x12 main_header">
						<div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
							<div class="padding-4">
								<div class="col s5 m5">
									<p class="company_name">Company Name</p>
								</div>
								<div class="col s7 m7 right-align">
									<img class="responsive-img" src="<?php echo base_url();?>user_assets/images/gallery/44.jpg" alt="style typography">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--card stats end-->

	<div class="row">
		<div class="col s12">
			<div class="container">
				<div class="row">
					<div class="col s12">
						<div class="card">
							<div class="card-content px-36">
								<div class="row">
									<div class="col s12 m12 l12">
										<h4 class="card-title center">Fill Order Details</h4>
									</div>
								</div>

								<div class="invoice-product-details mb-3">
									<form class="form" id="book_order_form" method="post">

										<div class="row">
											<div class="input-field col s12 m6">
												<label for="customer_name">Name *</label>
												<input type="text" id="customer_name" name="customer_name">
											</div>

											<div class="input-field col s12 m6">
												<label for="mobile_number" class="">Mobile Number *</label>
												<input id="mobile_number" type="text" name="mobile_number">
											</div>
										</div>

										<div class="row">
											<div class="col s12 m6">
												<label for="pick_up_loc">Pick Up Location *</label>
												<div class="input-field">
													<select class="browser-default" id="pick_up_loc" name="pick_up_loc" id="pick_up_loc" name="pick_up_loc">
														<option value="default">Choose your location</option>
														<option value="1">Manager</option>
														<option value="2">Developer</option>
														<option value="3">Business</option>
													</select>
												</div>
											</div>

											<div class="input-field col s12 m6">
												<div id="view-date-picker">
													<label for="pick_up_date">Pick Up Date *</label>
													<input for="pick_up_date" type="text" class="datepicker" id="pick_up_date" name="pick_up_date">
												</div>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="add_new">
												<div class="mb-2">
													<div class="row mb-1">
														<div class="col s3 m4">
															<h6 class="m-0">Item</h6>
														</div>
														<div class="col s3">
															<h6 class="m-0">Cost</h6>
														</div>
														<div class="col s3">
															<h6 class="m-0">Qty</h6>
														</div>
														<div class="col s3 m2">
															<h6 class="m-0">Total</h6>
														</div>
													</div>
													<div class="invoice-item display-flex mb-1">
														<div class="invoice-item-filed row col s12 pt-1">
															<div class="input-field col s12 m2">
																<select class="product_name invoice-item-select browser-default" name="product_detail[0][product_name]" id="product_name0">
																	<option value="" selected disabled>Choose your product</option>
																	<?php
																	foreach ($product_names as $product_name) { ?>
																		<option value="<?php print_r($product_name['product_id']); ?>"><?php print_r($product_name['product_name']); ?></option>
																	<?php } ?>
																</select>
															</div>
															<div class="input-field col s12 m2">
																<select class="invoice-item-select browser-default" name="product_detail[0][product_sub_category]" id="product_sub_category0">
																	<option value="" selected disabled>Choose your product</option>
																</select>
															</div>
															<div class="col m3 s12 input-field">
																<input type="text" name="product_detail[0][cost_per_product]" id="cost_per_product0" placeholder="Unit Price" readonly>
															</div>
															<div class="col m3 s12 input-field">
																<input type="text" name="product_detail[0][quantity]" id="quantity0" placeholder="Enter Quantity" readonly>
															</div>
															<div class="col m2 s12 input-field">
																<input type="text" name="product_detail[0][total_cost]" id="total_cost0" placeholder="Total Price" readonly>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="input-field">
												<button class="add_new_product btn" type="button">
													<i class="material-icons left">add</i>
													<span>Add Item</span>
												</button>
											</div>

											<div class="col m5 s12">
											</div>
											<div class="col xl4 m7 s12 offset-xl3">
												<ul>
													<li class="display-flex justify-content-between">
														<span class="invoice-subtotal-title">Total Amount(In Rs.)</span>
														<h6 class="invoice-subtotal-value" id="total_amount"></h6>
													</li>
												</ul>
											</div>
										</div>
										<div class="input-field col s12 m12 center">
											<button class="calculate_price submit_btn btn cyan waves-effect waves-light" type="submit" name="submit" style="margin-bottom: 5px;">Confirm Order
												<i class="material-icons right">send</i>
											</button>
											<button class="reset_btn btn cyan waves-effect waves-light " type="reset" name="reset" style="margin-bottom: 5px;">Reset Order
												<i class="material-icons right">cached</i>
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- invoice action  -->
				</div>
				<!-- </section>START RIGHT SIDEBAR NAV -->
			</div>
<!-- 			<div class="content-overlay"></div>
-->		</div>
</div>

</div>
<!-- END: Page Main-->  
<script type="text/html" id="form_tpl">
	<div class="mb-2"  id="addrow_<%= element.i %>">
		<div class="row mb-1">
			<div class="col s3 m4">
				<h6 class="m-0">Item</h6>
			</div>
			<div class="col s3">
				<h6 class="m-0">Cost</h6>
			</div>
			<div class="col s3">
				<h6 class="m-0">Qty</h6>
			</div>
			<div class="col s3 m2">
				<h6 class="m-0">Total</h6>
			</div>
		</div>
		<div class="invoice-item display-flex mb-1">
			<div class="invoice-item-filed row col s12 pt-1">
				<div class="input-field col s12 m2">
					<select class="product_name browser-default" name="product_detail[<%= element.i %>][product_name]" id="product_name<%= element.i %>">
						<option value="" selected disabled>Choose your product</option>
						<?php
						foreach ($product_names as $product_name) { ?>
							<option value="<?php print_r($product_name['product_id']); ?>"><?php print_r($product_name['product_name']); ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="input-field col s12 m2">
					<select class="browser-default" name="product_detail[<%= element.i %>][product_sub_category]" id="product_sub_category<%= element.i %>">
						<option value="" selected disabled>Choose your product</option>
					</select>
				</div>
				<div class="col m3 s12 input-field">
					<input type="text" name="product_detail[<%= element.i %>][cost_per_product]" id="cost_per_product<%= element.i %>" placeholder="Unit Price" readonly>
				</div>
				<div class="col m3 s12 input-field">
					<input type="text" name="product_detail[<%= element.i %>][quantity]" id="quantity<%= element.i %>" placeholder="Enter Quantity" readonly>
				</div>
				<div class="col m2 s12 input-field">
					<input type="text" name="product_detail[<%= element.i %>][total_cost]" id="total_cost<%= element.i %>" placeholder="Total Price" readonly>
				</div>
			</div>
			<div class="remove_row invoice-icon display-flex flex-column justify-content-between" id="remove_<%= element.i %>">
				<span class="delete-row-btn">
					<i class="material-icons">clear</i>
				</span>
			</div>
		</div>
	</div>
</script>
<?php include('user_template/footer.php');?>