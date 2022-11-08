<?php

namespace App\Http\Controllers;


use App\Enums\PaymentMethodStatus;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\Interfaces\PaymentMethodServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Prettus\Repository\Criteria\RequestCriteria;
use RuntimeException;
use Throwable;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @param UserServiceInterface $service
     * @param Request              $request
     *
     * @return View|Factory|Application|RedirectResponse
     */

    public function index(UserServiceInterface $service, Request $request): View|Factory|Application|RedirectResponse
    {
        try {
            $service->getRepository()->pushCriteria(app(RequestCriteria::class));
            $users = $service->filter($request);

            return view('users.index', compact('users'));
        } catch (Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserServiceInterface $service
     * @param UserCreateRequest    $request
     *
     * @return RedirectResponse
     *
     * @throws Exception
     */
    public function store(UserServiceInterface $service, UserCreateRequest $request): RedirectResponse
    {
        try {
            //get validated fields
            $validated = $request->validated();

            DB::transaction(function () use ($validated, $service) {
                $user = $service->store($validated());
            });

            $response = [
                'message' => 'User created.',
            ];

            return redirect()->back()->with('message', $response['message']);
        } catch (Throwable $e) {

            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for creating the specified resource.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function create(): Application|Factory|View|RedirectResponse
    {
        try {
            return view('users.create');
        } catch (Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param UserServiceInterface $service
     * @param int                  $id
     *
     * @return Application|Factory|View
     * @throws Exception
     */
    public function show(UserServiceInterface $service, int $id): Application|Factory|View
    {
        $user = $service->getRepository()->find($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UserServiceInterface $service
     * @param int                  $id
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(UserServiceInterface $service, int $id): Application|Factory|View|RedirectResponse
    {
        try {
            $user = $service->getRepository()->find($id);

            return view('users.edit', compact('user'));
        } catch (Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserServiceInterface $service
     * @param UserUpdateRequest    $request
     * @param int                  $id
     *
     * @return RedirectResponse
     *
     */
    public function update(UserServiceInterface $service, UserUpdateRequest $request, int $id): RedirectResponse
    {
        try {

            $user = $service->update($request->validated(), $id);

            $response = [
                'message' => 'User updated.',
            ];

            return redirect()->back()->with('message', $response['message']);
        } catch (Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserServiceInterface $service
     * @param int                  $id
     *
     * @return RedirectResponse
     */
    public function destroy(UserServiceInterface $service, int $id): RedirectResponse
    {
        try {
            $deleted = $service->delete($id);

            return redirect()->back()->with('message', 'User deleted.');
        } catch (Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Make default.
     *
     * @param UserServiceInterface $service
     * @param int                  $id
     * @param string               $paymentMethod
     *
     * @return RedirectResponse
     */
    public function makeDefault(UserServiceInterface $service, int $id, string $paymentMethod): RedirectResponse
    {
        try {
            $user = $service->getRepository()->find($id);
            foreach ($user->paymentmethods as $method) {
                $user->paymentmethods()->updateExistingPivot($method->id, ['status' => PaymentMethodStatus::INACTIVE]);
            }

            $user->paymentmethods()->updateExistingPivot($paymentMethod, ['status' => PaymentMethodStatus::DEFAULT]);

            return redirect()->back()->with('message', 'Payment method has been update to default.');
        } catch (Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * @param PaymentMethodServiceInterface $service
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function addNewPaymentMethod(PaymentMethodServiceInterface $service): Application|Factory|View|RedirectResponse
    {
        try {
            $payments = $service->getRepository()->all();
            return view('users.create', compact('payments'));
        } catch (Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * @param UserServiceInterface $service
     * @param Request              $request
     * @param int                  $id
     *
     * @return RedirectResponse
     */
    public function addPaymentMethod(UserServiceInterface $service, Request $request, int $id): RedirectResponse
    {
        try {

            $validator = Validator::make($request->all(), [
                'payment_method' => ['required', 'numeric', 'exists:payment_methods,id'],
            ]);

            if ($validator->fails()) {
                throw new RuntimeException($validator->errors()->first());
            }

            $user = $service->getRepository()->find($id);
            $user->paymentmethods()->attach($validator->validated()['payment_method']);
            return redirect()->back()->with('message', 'Payment method removed.');
        } catch (Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * @param UserServiceInterface $service
     * @param Request              $request
     * @param int                  $id
     * @param string               $paymentMethod
     *
     * @return RedirectResponse
     */
    public function removePaymentMethod(UserServiceInterface $service, Request $request, int $id, string $paymentMethod): RedirectResponse
    {
        try {
            $user = $service->getRepository()->find($id);
            $user->paymentmethods()->dettach($paymentMethod);
            return redirect()->back()->with('message', 'Payment method removed.');
        } catch (Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * @param UserServiceInterface $service
     * @param Request              $request
     * @param int                  $id
     *
     * @return RedirectResponse
     */
    public function removeAllPaymentMethods(UserServiceInterface $service, Request $request, int $id): RedirectResponse
    {
        try {
            $user = $service->getRepository()->find($id);
            $user->paymentmethods()->dettach();
            return redirect()->back()->with('message', 'Payment method added.');
        } catch (Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }
}
