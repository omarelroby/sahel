<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

protected $fillable = [
'invoice_number', 'client_id' ,'invoice_date','due_date','total_amount'
];

protected $casts = [
'due_date' => 'date',
'invoice_date' => 'date',

];
static public function checkNumber($code)
{
    return self::where('invoice_number', $code)->exists();
}
public function client()
{
    return $this->belongsTo(Customer::class,'client_id');
}
public function items()
{
    return $this->hasMany(Item::class);
}
}
