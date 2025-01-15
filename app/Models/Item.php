<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * Campos permitidos para preenchimento em massa.
     */
    protected $fillable = ['title', 'body'];
}
