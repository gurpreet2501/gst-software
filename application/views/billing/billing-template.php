<div class="sp-50"></div>
<div class="container billing-temp">
	<div class="row">
		<div class="col-xs-2"></div>	
		<div class="col-xs-8">
		  <div class="sp-50"></div>
			<div class="text-center">
				<h3 class="text-center"><strong>Tax Invoice</strong></h3>
				<h1 class="text-center title"><strong>TILE ZONE</strong></h1>
				<div class="sub-headings">Sirhind Road, Village Baran, Opp Amar Klassic, Patiala.</div>
				<div class="sub-headings">Mobile: 9814086241, +91-9855798999, Email: gargramesh241@gmail.com</div>
				<br/>
			</div>
		</div>	
		<div class="col-xs-2">
		  <br>
			<a class="no-print" href="<?=site_url('billing/create')?>" on:click><button type="button" class="btn btn-danger no-print">Back</button></a>
			<a class="no-print" onclick="window.print()"><button type="button" class="btn btn-danger no-print">Print</button></a>
		</div>	
	</div>
<!-- --------------- -->

<!-- --------------- -->

<!-- --------------- -->
<div class="row">
  <div class="col-xs-1"></div>
	<div class="col-xs-10">
		<table class="table">
			<tr>
				<td>GSTIN: <strong>03AATPG4917F1ZS<strong></td>
				<td>State: <strong>Punjab</strong></td>
				<td>State Code: <strong>03</strong></td>
			</tr>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-xs-1"></div>
	<div class="col-xs-5">
		<table class="table"> 
			<tr>
				<td colspan="2" align="center">
					<strong>Invoice Details</strong>
				</td>
			</tr>
			<tr>
				<td width="40%"><?=(is_booking($bill->id)) ? 'Booking' : 'Invoice'?>  No:</td>
				<td> <strong>#<?=$bill->id?></h4></td>
			</tr>
			<tr>
				<td>Invoice Date:</td>
				<td><?=date('d-m-Y',strtotime($bill->bill_date))?></td>
			</tr>
			<tr>
				<td class="address_field">Place Of Supply:</td>
				<td></td>
			</tr>
			<tr>
				<td class="address_field">Party's GSTIN No:</td>
				<td></td>
			</tr>
		</table>
	</div>
	<div class="col-xs-5">
		<!-- Right Side -->
		<table class="table">
			<tr>
				<td colspan="2" align="center">
					<strong>Details of Consignment | Shipped To</strong>
				</td>
			</tr>
			<tr>
				<td width="30%">
					Vehicle No:
				</td>
				<td>
					
				</td>
			</tr>

			<tr>
				<td class="address_field">
					Time:
				</td>
				<td>
					<?=date("H:i:s")?>
				</td>
			</tr>
			<tr>
				<td>Mode Of Dispatch:</td>
				<td></td>
			</tr>
			</table>
		<!-- Right Side ends -->
	</div>
	<div class="col-xs-1"></div>
</div>
<!-- --------------- -->

	<div class="row">
		<div class="col-xs-1"></div>
		<div class="col-xs-10">
		 <h4>Billing Items</h4>
			<div class="billing_items">
					<table class="table table-stripped" border="1px" cellpadding="8px">
						<tr>
							<td align="center"><strong>Sno</strong></th>
							<td align="center"><strong>Tile</strong></th>
							<td align="center"><strong>HSN Code</strong></th>
							<td align="center"><strong>Price</strong></th>
							<td align="center"><strong>Stock</strong></th>
							<td align="center"><strong>Sub Total (Price x Stock)</strong></th>
						</tr>
						<?php 
						$sub_total = 0;
						 foreach ($bill->billingItems as $key => $item):
						 	$sub_total = $sub_total + ($item->price * $item->stock);
						 	?>
							<tr>
								<td align="center"><?=++$key?></td>
								<td align="center"><?=$item->tile_name?></td>
								<td align="center"></td>
								<td align="center"><?=$item->price?></td>
								<td align="center"><?=$item->stock?></td>
								<td align="center"><?=$item->price * $item->stock?></td>
							</tr>
						<?php endforeach ?>
					
					</table>
				</div>
		</div>
		<div class="col-xs-1"></div>
			
	</div>
	<div class="row">
		<div class="col-xs-1"></div>
		<div class="col-xs-6">
			<table class="table">
					<tr>
						<td>Bank Details: </td>
						<td><strong>INDIAN BANK, PATIALA</strong></td>
					</tr>
					<tr>
						<td>Bank Account No.</td>
						<td><strong>CA6132997465</strong></td>
					</tr>
					<tr>
						<td>Bank Branch IFSC</td>
						<td><strong>IDIB000U037</strong></td>
					</tr>
				</table>
		
				<table class="table">
					<tr>
						<td>Bank Details:</td>
						<td><strong>ORIENTAL BANK  OF COMMERCE, PATIALA</strong></td>
					</tr>
					<tr>
						<td>Bank Account No.</td>
						<td><strong>20231131000223</strong></td>
					</tr>
					<tr>
						<td>Bank Branch IFSC</td>
						<td><strong>ORBC0102023</strong></td>
					</tr>
				</table>
		
		</div> <!-- col-xs-6 -->
		<div class="col-xs-4">
		<div class="col-xs-1"></div>
			<table class="table">
					<tr>
						<td><strong>Total Amount Before Tax:</strong></td>
						<td>Rs.<?=$sub_total?></td>
					</tr>
					<?php
					 $total_gst_amount = 0;	
					 foreach ($tax_rates as $key => $rate):
					 	if($rate->taxRates->is_fright_gst)
					 		continue;
					 	$subtotal = ($sub_total * $rate->taxRates->rate_percent)/100.0;
						$total_gst_amount = $total_gst_amount + $subtotal;
					  ?>
						<tr>
							<td align="center"><?=$rate->taxRates->slab_name?> (<?=$rate->taxRates->rate_percent ?>%)</td>
							<td>Rs.<?=$subtotal?> </td>
						</tr>
					<?php endforeach ?>
					<tr>
						<td><strong>Total GST amount:</strong></td>
						<td>Rs.<?=$total_gst_amount.' '?></td>
					</tr>
					<tr>
						<td><strong>Fright Charges:</strong></td>
						<td>Rs.<?=$bill->freight_charges.' '?></td>
					</tr>
					<?php
					 $total_gst_amount = 0;	
					 foreach ($tax_rates as $key => $rate):
					 	if(!$rate->taxRates->is_fright_gst)
					 		continue;
					 	$frieght_sub_total = ($bill->freight_charges * $rate->taxRates->rate_percent)/100.0;
						
					  ?>
						<tr>
							<td align="center"><?=$rate->taxRates->slab_name?> (<?=$rate->taxRates->rate_percent ?>%)</td>
							<td>Rs.<?=$frieght_sub_total?> </td>
						</tr>
					<?php endforeach ?>
					<tr>
						<td><strong>Total amount after tax:</strong></td>
						<td>Rs.<?=ceil($bill->bill_total).' '?></td>
					</tr>
			</table>
			<blockquote>
			 <footer>Total invoice amount in words</footer>
			  <p><?=ucfirst(str_replace('-',' ',convert_number_to_words(ceil($bill->bill_total))))?> Only</p>
			</blockquote>
			
		</div>
	</div>
 <?php $this->load->view('billing/terms-and-conditions')?>	
	<br/>
	<br/>
	<br/>