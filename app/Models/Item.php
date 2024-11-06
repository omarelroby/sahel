<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

protected $fillable = [
'description', 'quantity', 'price_unit','total','invoice_id'
];
public function invoice()
{
    return $this->belongsTo(Invoice::class,'invoice_id');
}

}
