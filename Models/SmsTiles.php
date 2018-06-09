<?php
namespace Models;
use Illuminate\Database\Eloquent\Model;

class SmsTiles extends Model
{
	protected $table    = 'sms_tiles';
	protected $fillable = ['name','stock','separate_tiles_stock','category_id','separate_tiles_stock'];

	public function category()
	{
	    return $this->belongsTo(SmsCategory::class, 'category_id', 'id');
	}
}