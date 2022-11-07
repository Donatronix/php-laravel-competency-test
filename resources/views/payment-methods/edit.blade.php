@extends('layouts.main')

@section('title')
    Edit Payment Method
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Edit Payment Method</h4>
            <p class="card-title-desc">
                Edit the payment method
            </p>

            <form class="custom-validation" action="{{ route('payment-methods.update',$paymentMethod->id) }}"
                  novalidate="" method="POST">
                @method('PUT')
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required=""
                           placeholder="Entered payment method" value="{{ old('name',$paymentMethod->name) }}">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" id="description" class="form-control" required=""
                           placeholder="Describe payment method"
                           value="{{ old('description',$paymentMethod->description) }}">

                </div>

                <div class="form-group">
                    <label>Service Charge</label>
                    <div>
                        <input type="text" name="charge" class="form-control" required=""
                               placeholder="Enter percentage charge in decimals"
                               value="{{ old('charge',$paymentMethod->charge) }}">
                    </div>
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
