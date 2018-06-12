<?php $this->load->view('admin/partials/header'); ?>
<div id="billing_form">
		<div class="row">
			<div class="col-xs-4"></div>
			<div class="col-xs-4">
				<h3 class="text-center">Company Name</h3>
				<h5 class="text-center">Your Slogan Here</h5>
			</div>
			<div class="col-xs-4"></div>
		</div>
		
		<br/>
		<form method="post" action="<?=site_url('billing/save')?>">
			  <div class="row">
			  	<div class="col-xs-6">
			  		<div class="form-group">
			  			<label>Party Name</label>
			  			<input class="form-control" name="party_name" type="text" />
			  		</div>
			  		<div class="form-group">
			  			<label>Bill Date</label>
			  			<input class="form-control _datepicker" type="text" name="bill_date" type="text" value="<?=date('Y-m-d')?>"/>
			  		</div>
			  		<div class="form-group">
			  			<label>Select Gst Rates</label>{{gst_rates}}
			  			<select name="gst_rates[]" class="form-control chosen-select" multiple>
			  				<?php foreach ($tax_rates as $key => $rate): ?>
			  					<option value="<?=$rate->id?>" ><?=$rate->slab_name?> (<?=$rate->rate_percent?>%)</option>
			  				<?php endforeach ?>
			  			</select>
			  		</div> <!-- form-group -->
			  		<div class="form-group">
			  			<label>Freight Charges</label>
			  			<input class="form-control" name="freight_charges" type="text" />
			  		</div>
			  	</div>		
			  	<div class="col-xs-4"></div>		
			  </div>
				<div class="row">
					<div class="col-xs-4"></div>
					<div class="col-xs-4">Price (per box)</div>
					<div class="col-xs-4"></div>
				</div> 
				<div class="row"  v-for="n in items_count" v-model="items_count">
					<div class="col-xs-4">
						<!-- //Testing -->
						<div class="form-group">
							<input type="text" list="items" class="form-control" v-bind:name="'item['+n+'][item_name]'" autocomplete="off"/>
								<datalist id="items">
								  <?php foreach ($items as $key => $item): ?>
								  	<option><?=$item->name?></option>
								  <?php endforeach; ?>
								</datalist>
						</div>
						<!-- //Testing -->
					</div>
					<div class="col-xs-4">
						<div class="form-group">
							<input class="form-control" type="number" v-bind:name="'item['+n+'][price]'" placeholder="Enter Price"/>
						</div>
					</div>
					
				
				</div> <!-- row -->
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4"></div>
					<div class="col-md-4 pull-right">
							<button class="btn btn-danger" type="button" v-on:click="items_count += 1">Add Items</button>
					</div>
				</div>
			
				<div class="row">
			
					<div class="col-md-4">
							<input type="submit" id="print_bill" class="btn btn-success no-print" name="print_bill" value="Save And Print Bill" />
						</div>
				</div>
				
		</form>

</div>		
<?php $this->load->view('admin/partials/footer'); ?>