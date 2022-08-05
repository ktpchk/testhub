<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'detailed_results',
        'public_results',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }
}
