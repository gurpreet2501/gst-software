<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Billing extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		auth_force();
		$this->load->helper('url');
		$this->load->library('tank_auth');
	}

	function create()
	{

		$tax_rates = Models\Gst::get();
		
		$tiles = Models\SmsItems::with('category')->get();
		
		$this->load->view('billing/create',[
				'tax_rates' => $tax_rates,
				'js_files' => [
					base_url('assets/js/billing-form.js'),
				],
				'for_js' => [
					'add_tiles' => $tiles
				]
			]);
	}

	function print_bill($bill_id)
	{ 
		
		$bill = Models\SmsBill::where('id', $bill_id)->with('billingItems')->with('billGstRelation.taxRates')->first();

		$tax_rates = Models\BillGst::where('bill_id', $bill_id)->with('taxRates')->get();
	
		$this->load->view('billing/print_bill', [
				'bill' => $bill,
				'tax_rates' => $tax_rates
			]);	
	}

	function details($id)
	{ 

		$bill = Models\SmsBill::where('id', $id)->with('billingItems')->first();

		$tax_rates = Models\BillGst::where('bill_id', $id)->with('taxRates')->get();
		
		$this->load->view('billing/details', [
			'bill' => $bill,
			'tax_rates' => $tax_rates
			]);	
	}

	function pre_bookings($id)
	{ 

		$bill = Models\SmsBill::where('id', $id)->with('billingItems')->first();

		$tax_rates = Models\BillGst::where('bill_id', $id)->with('taxRates')->get();
		
		$this->load->view('billing/pre_bookings', [
				'bill' => $bill,
				'tax_rates' => $tax_rates
			]);	
	}

	function save()
	{
		$data = $_POST;
		
		$is_booking = 0;

		if(isset($data['pre_booking']))
			$is_booking = 1;

		
		//Freight Charges included in bill amount
		$total = getBillTotal($data['tile'], $data['gst_rates'], $data['freight_charges']);
		echo "<pre>";
		print_r($total);
		exit;
		$bill = Models\SmsBill::create([
			'party_name' => $data['party_name'] ? $data['party_name'] : 'Name Not Mentioned',
			'bill_total' => $total,
			'freight_charges' => $data['freight_charges'],
			'is_booking' => $is_booking,
			'bill_date' => $data['bill_date']
			]);

		//Add Gst Rates
		foreach($data['gst_rates'] as $rate_id){
			Models\BillGst::create([
				'bill_id' => $bill->id,
				'gst_id' => $rate_id
			]);
		}

		foreach ($data['tile'] as $tile) {
			 if(!isset($tile['tile_id']))
			 	continue;
			 check_if_stock_available($tile);
		}

		foreach ($data['tile'] as $tile) {
			 if(!isset($tile['tile_id']))
			 	continue;

			 $tile['bill_id'] = $bill->id;
			 $tile['tile_name'] = get_tile_name($tile['tile_id']);
			 reduce_tile_stock($tile);
			 Models\SmsBillingItems::create($tile);
		}

		if(isset($data['pre_booking'])){
			success('Pre Booking Saved Successfully');
			redirect('billing/create/');
		}
				  	

		redirect('billing/print_bill/'.$bill->id);

	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */