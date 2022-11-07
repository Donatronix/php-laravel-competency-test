<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\PaymentOrderRepository;
use App\Models\PaymentOrder;
use App\Validators\PaymentOrderValidator;

/**
 * Class PaymentOrderRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PaymentOrderRepositoryEloquent extends BaseRepository implements PaymentOrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PaymentOrder::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PaymentOrderValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
