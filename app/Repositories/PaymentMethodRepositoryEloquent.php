<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\PaymentMethodRepository;
use App\Models\PaymentMethod;
use App\Validators\PaymentMethodValidator;

/**
 * Class PaymentMethodRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PaymentMethodRepositoryEloquent extends BaseRepository implements PaymentMethodRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PaymentMethod::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PaymentMethodValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
