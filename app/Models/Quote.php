<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    // Table name (optional if using "quotes")
    protected $table = 'quotations';

    // Fields that can be mass assigned
    protected $fillable = [
        'customer',
        'system',
        'base',
        'tax',
        'final',
        'status'
    ];

    // Optional: Type casting (recommended for calculations)
    protected $casts = [
        'base' => 'decimal:2',
        'tax' => 'decimal:2',
        'final' => 'decimal:2',
    ];
}