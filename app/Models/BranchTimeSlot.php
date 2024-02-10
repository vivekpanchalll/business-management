<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchTimeSlot extends Model
{
    use HasFactory;
    protected $fillable = [ 'week_days', 'start_time', 'end_time'];
}
