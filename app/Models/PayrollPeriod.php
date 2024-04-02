<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollPeriod extends Model
{
    use HasFactory;

    protected $appends = ['from_to'];

    protected $fillable = [
        'cutoff',
        'date_from',
        'date_to',
    ];

    protected $casts = [
        'date_from' => 'date:Y-m-d',
        'date_to' => 'date:Y-m-d',
    ];

    public function getFromToAttribute()
    {
        return date('M d, Y', strtotime($this->date_from)) . ' - ' . date('M d, Y', strtotime($this->date_to));
    }

}
