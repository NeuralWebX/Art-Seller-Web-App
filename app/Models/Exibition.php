<?php

namespace App\Models;

use App\Models\ExibitionSubmittion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exibition extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get all of the comments for the Exibition
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exibitionSubmittion(): HasMany
    {
        return $this->hasMany(ExibitionSubmittion::class, 'exibition_id', 'id');
    }
}
