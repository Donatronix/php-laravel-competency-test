@extends('layouts.main')

@section('title')
    Add Payment Method
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Add Payment Method</h4>
            <p class="card-title-desc">
                Add a new payment method
            </p>

            <form class="custom-validation" action="{{ route('users.add-payment-method') }}" novalidate=""
                  method="POST">
                <div class="form-group">
                    <label>Name</label>
                    <select class="form-control">
                        <option>Select</option>
                        @foreach($payments as $payment)
                            <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group mb-0">
                    <div>
                        <button type="submit" class="btn btn-primary waves-light mr-1">
                            Submit
                        </button>
                        <a href="{{ route('payment-methods.index')  }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
