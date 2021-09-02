<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $fillable = ['name', 'surname', 'phone', 'email', 'comment', 'company_id'];

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
