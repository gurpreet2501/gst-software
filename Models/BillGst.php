<?php
namespace Models;
use Illuminate\Database\Eloquent\Model;

class BillGst extends Model
{ 
    protected $table    = 'bill_gst';
    protected $fillable    = ['bill_id', 'gst_id'];

    function taxRates(){
    	return $this->hasOne(Gst::class, 'id', 'gst_id');
    }
}
