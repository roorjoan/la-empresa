<?php

namespace App\Models;

use App\Models\Contract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'tax_id_number',
        'name',
        'last_name',
        'birth_date',
        'email',
        'cell_phone'
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }
}
