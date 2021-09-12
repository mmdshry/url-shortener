<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urls extends Model
{
    use HasFactory;

    protected $table = 'urls';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'url',
        'redirectId',
        'expires_at'
    ];


    /**
     * Date columns
     * @var string[]
     */
    protected $dates = ['expires_at'];

    /**
     * Hidden columns
     * @var string[]
     */
    protected $hidden = ['id'];
}
