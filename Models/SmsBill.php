<?php
namespace Models;
use Illuminate\Database\Eloquent\Model;

class SmsBill extends Model
{
	protected $table    = 'sms_bill';
	protected $fillable = ['party_name','bill_date','bill_total','is_booking','freight_charges'];

	function billingItems(){
		return $this->hasMany(SmsBillingItems::class, 'bill_id', 'id');
	}

	function billGstRelation(){
		return $this->hasMany(BillGst::class, 'bill_id', 'id');
	}

}