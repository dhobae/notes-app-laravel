<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notes extends Model
{
    use HasFactory;

    protected $table = 'notes';

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('judul', 'like', '%' . $search . '%');
    }
}
