@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{ $userProfile->email }}</div>

                    <div class="card-body row">

                        @if (session('status')) <!-- ??? -->
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="col-md-4 offset-md-1 item text-center"><br>
                            <h3>{{ $userProfile->lastName }} {{ $userProfile->name }}</h3> <br>
                            <p><img src="/uploads/avatars/{{$userProfile->avatar}}" style="width:200px; height:200px;" class="img-fluid"></p>
                            <br>
                        </div>

                        <div class="col-md-4 offset-md-2 item text-center">
                            <br>
                            <p><strong>Gender: </strong> {{ $userProfile->gender or 'unknown'}} <br></p>
                            <p><strong>Birthday: </strong> {{ $userProfile->birthday or 'unknown' }} <br></p>
                            <p><strong>City: </strong> {{ $userProfile->city or 'unknown'}} <br></p>

                            <p><strong>University: </strong><br>
                                @forelse($userUniversities as $u)
                                    &#10004; {{ $u->university_name }} <br>
                                @empty unknown <br>
                                @endforelse
                            </p>
                            <br>
                            <a href="{{ route('profile.edit') }}" style="border: 3px solid #bfdeff; width: 70%" class="btn btn-default">Edit</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
