<?php

namespace App\Models;

use App\Traits\OwnerTrait;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PaymentMethod.
 *
 * @package namespace App\Models;
 */
class PaymentMethod extends Model
{
    use HasFactory;
    use OwnerTrait;
    use SoftDeletes;
    use UuidTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'charge',
    ];


    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_payment_method', 'payment_method_id', 'user_id')
            ->withTimestamps()
            ->withPivot('status');
    }

}
