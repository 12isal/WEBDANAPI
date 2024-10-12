<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;
    protected $table ='tamu';
    protected $fillable = [
        'pesan',
        'user_id'
        
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

}
