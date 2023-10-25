<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RekamMedis extends Model
{
    use HasFactory;

    public function pasien() : BelongsTo {
        return $this->belongsTo(User::class, 'pasien_id');
    }

    public function dokter() : BelongsTo {
        return $this->belongsTo(User::class, 'dokter_id');
    }
}
