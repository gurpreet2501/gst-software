<?php
namespace Models;
use Illuminate\Database\Eloquent\Model;

class SmsBillingItems extends Model
{
	protected $table    = 'sms_billing_items';
	protected $fillable = ['tile_id','price','tile_name','bill_id','stock'];

}