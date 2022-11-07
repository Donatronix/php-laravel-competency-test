<?php
declare(strict_types=1);

namespace App\Services;


use App\Repositories\Interfaces\PaymentMethodRepository;
use App\Services\Interfaces\PaymentMethodServiceInterface;
use App\Validators\PaymentMethodValidator;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class PaymentMethodsService.
 *
 * Package App\Domain\Shared\Services
 *
 */
class PaymentMethodService extends BaseService implements PaymentMethodServiceInterface
{
    /**
     * @param PaymentMethodRepository $repository
     * @param PaymentMethodValidator  $validator
     */
    public function __construct(
        protected PaymentMethodRepository $repository,
        protected PaymentMethodValidator  $validator,
    )
    {
        //
    }

    /**
     * @throws Exception
     */
    public function getValidator(): PaymentMethodValidator
    {
        return $this->validator;
    }

    /**
     * @throws Exception
     */
    public function getRepository(): PaymentMethodRepository
    {
        return $this->repository;
    }

    /**
     * @param string|null $search
     *
     * @return mixed
     * @throws RepositoryException
     */
    public function filter(string $search = null): mixed
    {
        $this->repository->pushCriteria(app(RequestCriteria::class));

        if ($search) {
            return $this->repository->scopeQuery(function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('charge', 'like', '%' . $search . '%');

            })->scopeQuery(function ($query) {
                return $query->orderBy('name', 'asc');
            })
                ->paginate();
        }

        return $this->repository->scopeQuery(function ($query) {
            return $query->orderBy('name', 'asc');
        })->paginate();

    }

    /**
     * @return LengthAwarePaginator
     */
    public function allWithTrashed(): LengthAwarePaginator
    {
        $PaymentMethodModel = $this->repository->model();
        return $PaymentMethodModel::query()->withTrashed()
            ->orderBy('last_name', 'DESC')
            ->paginate();
    }

    /**
     * @param mixed $id
     *
     * @return mixed
     */
    public function restorePaymentMethod(mixed $id): mixed
    {
        $PaymentMethodModel = $this->repository->model();
        return $PaymentMethodModel::query()->withTrashed()->where('id', $id)->restore();
    }

}
