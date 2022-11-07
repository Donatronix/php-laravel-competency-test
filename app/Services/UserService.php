<?php
declare(strict_types=1);

namespace App\Services;


use App\Repositories\Interfaces\UserRepository;
use App\Services\Interfaces\UserServiceInterface;
use App\Validators\UserValidator;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class UsersService.
 *
 * Package App\Domain\Shared\Services
 *
 */
class UserService extends BaseService implements UserServiceInterface
{
    /**
     * @param UserRepository $repository
     * @param UserValidator  $validator
     */
    public function __construct(
        protected UserRepository $repository,
        protected UserValidator  $validator,
    )
    {
        //
    }

    /**
     * @throws Exception
     */
    public function getValidator(): UserValidator
    {
        return $this->validator;
    }

    /**
     * @throws Exception
     */
    public function getRepository(): UserRepository
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
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('email', '<>', 'admin@mail.com');
            })->scopeQuery(function ($query) {
                return $query->orderBy('last_name', 'asc');
            })->paginate();
        }

        return $this->repository->scopeQuery(function ($query) {
            return $query->orderBy('last_name', 'asc');
        })->paginate();

    }

    /**
     * @return LengthAwarePaginator
     */
    public function allWithTrashed(): LengthAwarePaginator
    {
        $userModel = $this->repository->model();
        return $userModel::query()->withTrashed()
            ->orderBy('last_name', 'DESC')
            ->paginate();
    }

    /**
     * @param mixed $id
     *
     * @return mixed
     */
    public function restoreUser(mixed $id): mixed
    {
        $userModel = $this->repository->model();
        return $userModel::query()->withTrashed()->where('id', $id)->restore();
    }

}
