@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Global search</div>

                    <div class="card-body row justify-content-center">

                        <!-- Возможно, вы знакомы -->
                        <div class="col-md-12 text-center" style="border-top: 3px solid #f2f2f2; border-bottom: 3px solid #f2f2f2; background: #fbfbfb">
                            <div style="margin: 15px 0">Perhaps you've met:
                                <div class="row justify-content-center text-center" style="margin: 15px 0 25px">

                                    <!-- php -->
                                    <div class="col-md-3" style="margin: 0 15px; padding: 10px">
                                        <img src="/uploads/avatars/{{$userProfile->avatar}}" style="width:140px; height:140px; border-radius:50%; margin: 5px 0 0;" class="img-fluid"><br>
                                        <div style="margin: 5px">
                                            Фамилия <br>
                                            Имя <br>
                                        </div>
                                        <input type="button" class="btn btn-default" value="Add as Friend">
                                    </div>

                                    <div class="col-md-3" style="margin: 0 15px; padding: 10px">
                                        <img src="/uploads/avatars/{{$userProfile->avatar}}" style="width:140px; height:140px; border-radius:50%; margin: 5px 0 0;" class="img-fluid"><br>
                                        <div style="margin: 5px">
                                            Фамилия <br>
                                            Имя <br>
                                        </div>
                                        <input type="button" class="btn btn-default" value="Add as Friend">
                                    </div>

                                    <div class="col-md-3" style="margin: 0 15px; padding: 10px">
                                        <img src="/uploads/avatars/{{$userProfile->avatar}}" style="width:140px; height:140px; border-radius:50%; margin: 5px 0 0;" class="img-fluid"><br>
                                        <div style="margin: 5px">
                                            Фамилия <br>
                                            Имя <br>
                                        </div>
                                        <input type="button" class="btn btn-default" value="Add as Friend">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Параметры поиска -->
                        <div class="col-md-12 text-center" style="margin: 30px 0 10px">

                            {!! Form::open(['route' => 'search', 'method'=>'POST']) !!}
                                <div class="row justify-content-center" style="margin-top: 15px;">

                                    <div class="form-group col-md-3" style="margin: 0 10px;">
                                        <label for="inputSearchName" class="control-label">Name:</label>
                                        <input type="text" class="form-control" id="inputSearchName" name="searchName" value="{{ $search->searchName }}">
                                    </div>

                                    <div class="form-group col-md-3" style="margin: 0 10px;">
                                        <label for="inputSearchLastName" class="control-label">Last Name:</label>
                                        <input type="text" class="form-control" id="inputSearchLastName" name="searchLastName" value="{{ $search->searchLastName }}">
                                    </div>

                                    <div class="form-group col-md-3" style="margin: 0 10px;">
                                        <label for="inputSearchCity" class="control-label">City:</label>
                                        <input type="text" class="form-control" id="inputSearchCity" name="searchCity" value="{{ $search->searchCity }}">
                                    </div>

                                    <div class="col-md-12" style="margin: 25px 0;">
                                        <input type="submit" class="btn btn-primary" value="Search" style="width: 150px">
                                    </div>

                                </div>
                            {!! Form::close() !!}
                        </div>

                        <!-- Вывод пользователей -->
                        <div class="col-md-11">

                            @forelse ($allUsers as $user)
                                <div class="row justify-content-center" style="padding: 15px 0; border-top: 1px solid #d8d8d8">
                                    <div class="col-md-4 text-center">
                                        <img src="/uploads/avatars/{{$user->avatar}}" style="width:140px; height:140px; border-radius:50%;" class="img-fluid">
                                    </div>

                                    <div class="col-md-4">
                                        <br><h5><a href="{{ route('search.showUser', $user->id) }}">{{$user->name}} {{$user->lastName}}</a></h5>
                                        {{$user->birthday}}<br>
                                        {{$user->city}}<br>
                                    </div>

                                    <div class="col-md-3 text-center">
                                        <br><input type="button" class="btn btn-default" value="Add as Friend">
                                        <br><a href="" class="btn btn-default">Write message</a>
                                    </div>
                                </div>
                            @empty <div align="center">Users not found</div><br>
                            @endforelse

                            <!-- Нижний бордюр и пагинация -->
                            <div class="row justify-content-center" style="padding: 15px 0; border-top: 1px solid #d8d8d8">
                                <div style="margin-top: 15px">
                                    {{ $allUsers->appends([ 'searchName' => $search->searchName,
                                                            'searchLastName' => $search->searchLastName,
                                                            'searchCity' => $search->searchCity ])
                                                ->links()
                                    }}
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection