<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

/**
 * Trait OwnerTrait
 *
 * @package App\Http\Traits
 */
trait OwnerTrait
{
    /**
     * @param             $query
     * @param string|null $user_id
     *
     * @return mixed
     */
    public function scopeByOwner($query, string $user_id = null): mixed
    {
        return $query->where('user_id', $user_id ?? Auth::user()->getAuthIdentifier());
    }
}
