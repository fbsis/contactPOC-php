<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\SendEmail;
use App\Mail\DeleteEmail;
use Illuminate\Support\Facades\Mail;

class Contacts extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($item) {
            Mail::to("teste@teste.com")
                ->queue(new DeleteEmail($item));
        });
    }
}
