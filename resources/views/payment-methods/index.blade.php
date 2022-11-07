@extends('layouts.main')

@section('title')
    Payment Methods
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Payment Methods</h4>
            <p class="card-title-desc">Listing of available payment methods</p>

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Charge</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($paymentMethods as $method)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $method->name }}</td>
                            <td>{{ $method->description }}</td>
                            <td>
                                <a href="{{ route('payment-methods.edit',$method->id)  }}" class="btn btn-primary">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('payment-methods.delete',$method->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $paymentMethods->links() }}
        </div>
    </div>
@endsection
