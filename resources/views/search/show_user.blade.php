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

                            <!-- Кнопка добавления в друзья или статус -->
                            @if (is_null($userStatus))
                                <a href="{{ route('add_friend', $foreignUserProfile->id) }}" class="btn btn-default" style="border: 3px solid #bfdeff; margin: 10px 0 10px; width: 80%">Add as Friend</a>
                            @elseif ($userStatus->status == 0)
                                <div style="width: 100%; color: #34ce57; margin: 10px 0 10px;">Application sent</div>
                                <a style="border: 3px solid #bfdeff; color: #c82333; width: 80%; margin-bottom: 10px;" href="{{ route('friend.remove', $foreignUserProfile->id) }}" class="btn btn-default">Reject</a>
                            @elseif ($userStatus->status == 1)
                                <div style="width: 100%; color: #34ce57; margin: 10px 0 10px;">Incoming application</div>
                                <a style="border: 3px solid #bfdeff; width: 80%; margin-bottom: 10px;" href="{{ route('confirm_friend', $foreignUserProfile->id) }}" class="btn btn-default">Accept</a><br>
                                <a style="border: 3px solid #bfdeff; color: #c82333; width: 80%; margin-bottom: 10px;" href="{{ route('friend.remove', $foreignUserProfile->id) }}" class="btn btn-default">Reject</a>
                            @else
                                <div style="width: 100%; color: #34ce57; margin: 10px 0 10px">Friend &#10004;</div>
                                <a style="border: 3px solid #bfdeff; color: #c82333; width: 80%; margin-bottom: 10px;" href="{{ route('friend.remove', $foreignUserProfile->id) }}" class="btn btn-default">Remove &#10007</a>
                            @endif
                            <a href="{{ route('dialog', $foreignUserProfile->id) }}" class="btn btn-default" style="border: 3px solid #bfdeff; width: 80%; margin-bottom: 40px;">Write message</a>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
