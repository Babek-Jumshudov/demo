<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAdd extends Model
{
    use HasFactory;
    protected $table = 'company';
    public function adverts()
    {
        return $this->hasMany(Advert::class);
    }
}
