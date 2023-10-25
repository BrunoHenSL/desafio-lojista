<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Authenticatable
{
    public function carteira()
    {
        return $this->hasOne(Wallet::class);
    }
}
