<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class liquor_mg extends Model
{
    use HasFactory;
    protected $fillable=['liquor_name','liquor_type','remarks'];
}
