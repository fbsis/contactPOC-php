<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configs extends Model
{
    use HasFactory;

    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'key',
        'value',
        'description'
    ];

    static function getByKey($key)
    {
        return Configs::where('key', $key)->first();
    }
}
