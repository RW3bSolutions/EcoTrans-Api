<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BillingStatement extends Model
{
    use HasFactory;

    protected $fillable = [
        'bs_no',
        'client_id',
        'date',
        'tin',
        'terms',
        'address',
        'items',
        'vatable_amount',
        'vat_amount',
        'total_amount',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    public function client ()
    {
        return $this->belongsTo(Client::class);
    }

}
