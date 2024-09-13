<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $primaryKey = 'id';

    public function residence()
    {
        return $this->hasMany(Residence::class);
    }
    
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
