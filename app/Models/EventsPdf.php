<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsPdf extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'company_event_id',
        'year',
        'file',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
