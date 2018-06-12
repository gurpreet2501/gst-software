<?php
namespace Models;
use Illuminate\Database\Eloquent\Model;

class SmsBillingItems extends Model
{
	protected $table    = 'sms_billing_items';
	protected $fillable = ['item_id','price','item_name','bill_id'];

}