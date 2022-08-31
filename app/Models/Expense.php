<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'per_person',
        'description',
        'paid_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'paid_by');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
}
