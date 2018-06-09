<?php
namespace Models;
use Illuminate\Database\Eloquent\Model;

class Gst extends Model
{ 
    protected $table    = 'gst';
    protected $fillable    = ['slab_name', 'rate_percent'];

}
