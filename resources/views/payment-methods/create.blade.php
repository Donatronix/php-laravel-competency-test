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

            <form class="custom-validation" action="{{ route('payment-methods.store') }}" novalidate="" method="POST">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required=""
                           placeholder="Entered payment method" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" id="description" class="form-control" required=""
                           placeholder="Describe payment method" value="{{ old('description') }}">

                </div>

                <div class="form-group">
                    <label>Service Charge</label>
                    <div>
                        <input type="text" name="charge" class="form-control" required=""
                               placeholder="Enter percentage charge in decimals" value="{{ old('charge') }}">
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
