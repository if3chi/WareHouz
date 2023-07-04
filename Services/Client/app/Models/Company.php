<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class Company extends Model
{
    use HasFactory, HasUlids, Notifiable;

    protected $fillable = ['name', 'website', 'email'];

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class, 'company_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class, 'company_id');
    }
}
