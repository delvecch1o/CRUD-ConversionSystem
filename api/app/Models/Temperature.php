<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    use HasFactory;
    protected $table = 'temperature';
    protected $fillable = [
        'in',
        'from',
        'to',
        'result',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
