<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;


    protected $fillable = [
        'type',
        'amount',
        'description',
        'user_id',
        'expense_data',
        'photo',
    ];

    protected $dates = ['expense_data'];


    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }

    protected function expense_date(): Attribute
    {
        return Attribute::make(
           
            set: fn ($value) => (DateTime::createFromFormat('d/m/Y Hm:i:s',$value))->format('Y-m-d H:i:s'),
        );
    }



    public function user(){
        
        return $this->belongsTo(User::class);
       
    }
}