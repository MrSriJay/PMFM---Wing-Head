<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    protected $table = 'complaints';
    protected $fillable = ['system_name','description','date'];
}
