<?php
declare(strict_types=1);

namespace App\Services;


use App\Repositories\Interfaces\PaymentOrderRepository;
use App\Services\Interfaces\PaymentOrderServiceInterface;
use App\Validators\PaymentOrderValidator;
use Exception;

/**
 * Class PaymentOrdersService.
 *
 * Package App\Domain\Shared\Services
 *
 */
class PaymentOrderService extends BaseService implements PaymentOrderServiceInterface
{
    /**
     * @param PaymentOrderRepository $repository
     * @param PaymentOrderValidator  $validator
     */
    public function __construct(
        protected PaymentOrderRepository $repository,
        protected PaymentOrderValidator  $validator,
    )
    {
        //
    }

    /**
     * @throws Exception
     */
    public function getValidator(): PaymentOrderValidator
    {
        return $this->validator;
    }

    /**
     * @throws Exception
     */
    public function getRepository(): PaymentOrderRepository
    {
        return $this->repository;
    }


}
