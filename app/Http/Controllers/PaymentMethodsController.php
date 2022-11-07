<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentMethodCreateRequest;
use App\Http\Requests\PaymentMethodUpdateRequest;
use App\Services\Interfaces\PaymentMethodServiceInterface;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use Throwable;

/**
 * Class PaymentMethodsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PaymentMethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PaymentMethodServiceInterface $service
     * @param Request                       $request
     *
     * @return View|Factory|Application|RedirectResponse
     */

    public function index(PaymentMethodServiceInterface $service, Request $request): View|Factory|Application|RedirectResponse
    {
        try {
            $service->getRepository()->pushCriteria(app(RequestCriteria::class));
            $paymentMethods = $service->filter($request);

            return view('payment-methods.index', compact('paymentMethods'));
        } catch (Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PaymentMethodServiceInterface $service
     * @param PaymentMethodCreateRequest    $request
     *
     * @return RedirectResponse
     *
     * @throws Exception
     */
    public function store(PaymentMethodServiceInterface $service, PaymentMethodCreateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            //get validated fields
            $validated = $request->validated();

            $payment_method = $service->store($validated());

            $response = [
                'message' => 'PaymentMethod created.',
            ];
            DB::commit();
            return redirect()->back()->with('message', $response['message']);
        } catch (Throwable $e) {
            DB::rollBack();
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
            return view('payment-methods.create');
        } catch (Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentMethodServiceInterface $service
     * @param int                           $id
     *
     * @return Application|Factory|View
     * @throws Exception
     */
    public function show(PaymentMethodServiceInterface $service, int $id): Application|Factory|View
    {
        $paymentMethods = $service->getRepository()->find($id);

        return view('payment-methods.show', compact('paymentMethods'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PaymentMethodServiceInterface $service
     * @param int                           $id
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(PaymentMethodServiceInterface $service, int $id): Application|Factory|View|RedirectResponse
    {
        try {
            $paymentMethod = $service->getRepository()->find($id);

            return view('payment-methods.edit', compact('paymentMethod'));
        } catch (Throwable $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PaymentMethodServiceInterface $service
     * @param PaymentMethodUpdateRequest    $request
     * @param int                           $id
     *
     * @return RedirectResponse
     *
     */
    public function update(PaymentMethodServiceInterface $service, PaymentMethodUpdateRequest $request, int $id): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $payment_method = $service->update($request->validated(), $id);

            $response = [
                'message' => 'PaymentMethod updated.',
            ];
            DB::commit();
            return redirect()->back()->with('message', $response['message']);
        } catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentMethodServiceInterface $service
     * @param int                           $id
     *
     * @return RedirectResponse
     */
    public function destroy(PaymentMethodServiceInterface $service, int $id): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $deleted = $service->delete($id);
            DB::commit();
            return redirect()->back()->with('message', 'PaymentMethod deleted.');
        } catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }
}
