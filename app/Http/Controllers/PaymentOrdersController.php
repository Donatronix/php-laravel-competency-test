<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PaymentOrderCreateRequest;
use App\Http\Requests\PaymentOrderUpdateRequest;
use App\Repositories\Interfaces\PaymentOrderRepository;
use App\Validators\PaymentOrderValidator;

/**
 * Class PaymentOrdersController.
 *
 * @package namespace App\Http\Controllers;
 */
class PaymentOrdersController extends Controller
{
    /**
     * @var PaymentOrderRepository
     */
    protected $repository;

    /**
     * @var PaymentOrderValidator
     */
    protected $validator;

    /**
     * PaymentOrdersController constructor.
     *
     * @param PaymentOrderRepository $repository
     * @param PaymentOrderValidator $validator
     */
    public function __construct(PaymentOrderRepository $repository, PaymentOrderValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $paymentOrders = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $paymentOrders,
            ]);
        }

        return view('paymentOrders.index', compact('paymentOrders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PaymentOrderCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PaymentOrderCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $paymentOrder = $this->repository->create($request->all());

            $response = [
                'message' => 'PaymentOrder created.',
                'data'    => $paymentOrder->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentOrder = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $paymentOrder,
            ]);
        }

        return view('paymentOrders.show', compact('paymentOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentOrder = $this->repository->find($id);

        return view('paymentOrders.edit', compact('paymentOrder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PaymentOrderUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PaymentOrderUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $paymentOrder = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PaymentOrder updated.',
                'data'    => $paymentOrder->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'PaymentOrder deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PaymentOrder deleted.');
    }
}
