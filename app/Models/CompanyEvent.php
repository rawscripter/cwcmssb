<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'name',
        'slug',
        'description',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function pdfs()
    {
        return $this->hasMany(EventsPdf::class, 'company_event_id');
    }

    public function fullUrl()
    {
        return config('app.url') . '/' . $this->company->slug . '/' . $this->slug;
    }
}
