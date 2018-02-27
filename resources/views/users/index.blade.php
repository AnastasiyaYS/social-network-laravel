@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{ $user->email }}</div>

                    <div class="card-body row">

                        @if (session('status')) <!-- ??? -->
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="col-md-4 offset-md-1 item text-center"><br>
                            <h3>{{ $user->surname }} {{ $user->name }}</h3> <br>
                            <p><img src="/uploads/avatars/{{$user->avatar}}" style="width:200px; height:200px;" class="img-fluid"></p>
                            <br>
                        </div>

                        <div class="col-md-4 offset-md-2 item text-center">
                            <br>
                            <p><strong>Gender: </strong> {{ $user->gender or '-- ? --'}} <br></p>
                            <p><strong>Birthday: </strong> {{ $user->birthday or '-- ? --'}} <br></p>
                            <p><strong>City: </strong> {{ $user->city or '-- ? --'}} <br></p>
                            <p><strong>University: </strong> {{ $user->university or '-- ? --'}} <br></p>
                            <br>

                            <a href="{{ route('users.edit') }}" class="btn btn-default">Edit</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
