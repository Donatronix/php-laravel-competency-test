<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PaymentMethodServiceInterface extends BaseServiceInterface
{

    /**
     * @param string $search
     *
     * @return mixed
     */
    public function filter(string $search): mixed;

    /**
     * @return LengthAwarePaginator
     */
    public function allWithTrashed(): LengthAwarePaginator;

    /**
     * @param mixed $id
     *
     * @return mixed
     */
    public function restorePaymentMethod(mixed $id): mixed;

}

