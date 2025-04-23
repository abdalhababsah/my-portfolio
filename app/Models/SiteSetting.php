<?php
// app/Models/SiteSetting.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'key_name', 'value_en', 'value_ar',
    ];

    public $timestamps = false;
}