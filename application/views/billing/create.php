<?php $this->load->view('admin/partials/header'); ?>
<div id="billing_form">
		<div class="row">
			<div class="col-xs-4"></div>
			<div class="col-xs-4">
				<h3 class="text-center">Tile Zone Patiala</h3>
				<h5 class="text-center">Deals in all types of tile variety</h5>
			</div>
			<div class="col-xs-4"></div>
		</div>
		<div class="row pull-right">
			<div class="col-xs-12">
				<button class="btn btn-danger" v-on:click="tile_count += 1">Add Tiles</button>
			</div>
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
					<div class="col-xs-4">Stock (in Boxes)</div>
					<div class="col-xs-4"></div>
				</div> 
				<div class="row"  v-for="n in tile_count" v-model="tile_count">
					<div class="col-xs-4">
						<div class="form-group">
							<select class="form-control chosen-select" v-bind:name="'tile['+n+'][tile_id]'" >
							   <option selected disabled>-Select Tiles-</option>
								<option  v-bind:value="tile.id" v-for='tile in tiles'>{{tile.name}}</option>
							</select>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="form-group">
							<input class="form-control" type="number" v-bind:name="'tile['+n+'][price]'" placeholder="Enter Price"/>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="form-group">
							<input class="form-control" type="number" v-bind:name="'tile['+n+'][stock]'" placeholder="Enter Stock"/>
						</div>
					</div>
					<div class="col-xs-4"></div>
				</div> <!-- row -->
				<div class="row">
				<div class="col-xs-4"></div>
				<div class="col-xs-4"></div>
				<div class="col-xs-4">
						<input type="submit" id="pre_booking" class="btn btn-success no-print" name="pre_booking" value="Pre Booking" />
						<input type="submit" id="print_bill" class="btn btn-success no-print" name="print_bill" value="Save And Print Bill" />
					</div>
				</div>
				
		</form>

</div>		
<?php $this->load->view('admin/partials/footer'); ?>