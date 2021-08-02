<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fix_message extends Model
{
    protected $table = 'fix_messages';
    protected $fillable = ['complaint_id','developer_id','message'];
}
