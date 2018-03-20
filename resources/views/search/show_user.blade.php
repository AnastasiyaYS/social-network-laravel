@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{ $foreignUserProfile->email }}</div>

                    <div class="card-body row">

                        <div class="col-md-4 offset-md-1 item text-center"><br>
                            <h3>{{ $foreignUserProfile->lastName }} {{ $foreignUserProfile->name }}</h3> <br>
                            <p><img src="/uploads/avatars/{{$foreignUserProfile->avatar}}" style="width:200px; height:200px;" class="img-fluid"></p>
                            <br>
                        </div>

                        <div class="col-md-4 offset-md-2 item text-center">
                            <br>
                            <p><strong>Gender: </strong> {{ $foreignUserProfile->gender or 'unknown'}} <br></p>
                            <p><strong>Birthday: </strong> {{ $foreignUserProfile->birthday or 'unknown' }} <br></p>
                            <p><strong>City: </strong> {{ $foreignUserProfile->city or 'unknown'}} <br></p>

                            <p><strong>University: </strong><br>
                                @forelse($userUniversities as $u)
                                    &#10004; {{ $u->university_name }} <br>
                                @empty unknown <br>
                                @endforelse
                            </p>
                            <br>
                            <input type="button" class="btn btn-default" value="Add as friend">
                            <a href="{{ route('profile.edit') }}" class="btn btn-default">Write message</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
