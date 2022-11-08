@extends('layouts.main')

@section('title')
    Users
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Users</h4>
            <p class="card-title-desc">Listing of users</p>

            <div class="table-responsive">
                <table class="table mb-0 table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Payment methods</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <ul class="list-unstyled">
                                    @foreach($user->paymentMethods as $method)
                                        <li>
                                            <div class="pull-left">
                                                {{ $method->name }}
                                            </div>
                                            <div class="pull-right">
                                                <form method="POST"
                                                      action="{{ route('users.payment-methods.remove-payment-method',['id'=>$user->id,'paymentMethod'=>$method->id])  }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Remove</button>
                                                </form>
                                                @if($method->status!== 1)
                                                    <a href="{{ route('users.payment-methods.default',['id'=>$user->id,'paymentMethod'=>$method->id])  }}"
                                                       class="btn btn-success">
                                                        Make Default
                                                    </a>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                @if($user->paymentMethods->count() < 3)
                                    <a href="{{ route('users.payment-methods.add-new-payment-method',$method->id)  }}"
                                       class="btn btn-success">
                                        Add Payment Method
                                    </a>
                                @endif
                                <form method="POST"
                                      action="{{ route('users.payment-methods.remove-all-payment-methods') }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove All Payment Methods</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
    </div>
@endsection
