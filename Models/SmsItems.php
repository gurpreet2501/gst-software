<?php
namespace Models;
use Illuminate\Database\Eloquent\Model;

class SmsItems extends Model
{
	protected $table    = 'sms_items';
	protected $fillable = ['name','stock','category_id','weight'];

	public function category()
	{
	    return $this->belongsTo(SmsCategory::class, 'category_id', 'id');
	}
}