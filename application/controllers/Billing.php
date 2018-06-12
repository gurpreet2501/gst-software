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
		
		$items = Models\SmsItems::with('category')->get();
		
		$this->load->view('billing/create',[
				'tax_rates' => $tax_rates,
				'items' => $items,
				'js_files' => [
					base_url('assets/js/billing-form.js'),
				],
				'for_js' => [
					'add_tiles' => $items
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

		if(!isset($data['gst_rates']))
			$data['gst_rates'] = [];
		
		//Freight Charges included in bill amount
		$total = getBillTotal($data['item'], $data['gst_rates'], $data['freight_charges']);
		
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

			
	
		foreach ($data['item'] as $item) {

			
			 $item['bill_id'] = $bill->id;
			 $item['item_id'] = get_item_id($item['item_name']);
		
			 Models\SmsBillingItems::create($item);
		}

		redirect('billing/print_bill/'.$bill->id);

	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */