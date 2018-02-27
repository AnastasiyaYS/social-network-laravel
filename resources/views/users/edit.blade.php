@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{ $user->email }}</div>

                    {!! Form::open(['route' => ['users.update'], 'method'=>'POST', 'files'=>'true']) !!}

                        <div class="card-body row">

                            @if (session('status')) <!-- ??? -->
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="col-md-4 offset-md-1 item text-center"><br>
                                <h3>{{ $user->surname }} {{ $user->name }}</h3> <br>
                                <p><img src="/uploads/avatars/{{$user->avatar}}" style="width:200px; height:200px;" class="img-fluid"></p>

                                <div class="file_upload">
                                    <input type="file" name="avatar">
                                </div>
                            </div>

                            <div class="col-md-4 offset-md-2 item text-center"><br>

                                <div class="form-group">    <!-- Бутстраповская форма - form-group, все элементы - form-control -->
                                    <div class="row">
                                        <div class="col-md-4"><label for="gender" class="control-label"><strong>Gender:</strong></label></div>

                                        <div class="radio col-md-4">
                                            <label>
                                                <input class="form-control" type="radio" name="gender" id="gender1" value="male" {{ ($user->gender == 'male') ? 'checked' : '' }}>
                                                Male
                                            </label>
                                        </div>
                                        <div class="radio col-md-4">
                                            <label>
                                                <input class="form-control" type="radio" name="gender" id="gender2" value="female" {{ ($user->gender == 'female') ? 'checked' : '' }}>
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputBirthday"><strong>Birthday:</strong></label>
                                    <input type="date" class="form-control" name="birthday" value="{{ $user->birthday }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputCity" class="control-label"><strong>City:</strong></label>
                                    <input type="text" class="form-control" id="inputCity" name="city" value="{{ $user->city }}" >
                                </div>

                                <!-- Вывод всех университетов php -->
                                <div class="form-group" id="divUni">
                                    <label for="University"><strong>University:</strong></label>
                                    <select class="form-control" name="university[]">
                                        <option disabled selected>- not selected -</option>
                                        <option {{ ($user->university == 'UlSU, Ulyanovsk State University') ? 'selected' : '' }}>UlSU, Ulyanovsk State University</option>
                                        <option {{ ($user->university == 'UlSTU, Ulyanovsk State Technical University') ? 'selected' : '' }}>UlSTU, Ulyanovsk State Technical University</option>
                                        <option {{ ($user->university == 'UlICA, Ulyanovsk Institute of Civil Aviation') ? 'selected' : '' }}>UlICA, Ulyanovsk Institute of Civil Aviation</option>
                                        <option {{ ($user->university == 'UlSPU, Ulyanovsk State Pedagogical University') ? 'selected' : '' }}>UlSPU, Ulyanovsk State Pedagogical University</option>
                                        <option {{ ($user->university == 'UlSAA, Ulyanovsk State Agricultural Academy') ? 'selected' : '' }}>UlSAA, Ulyanovsk State Agricultural Academy</option>
                                    </select>
                                </div>

                                <input type="button" class="btn btn-default" onclick="plus()" value="Add new university">
                                <br><br>
                                <input type="submit" class="btn btn-primary" value="Save changes">
                            </div>
                        </div>

                        <script>
                            function plus() {
                                document.getElementById('divUni').innerHTML += '<br>' +
                                        '<select class="form-control" name="university[]">' +
                                        '<option disabled selected>- not selected -</option>' +
                                        '<option {{ ($user->university == 'UlSU, Ulyanovsk State University') ? 'selected' : '' }}>UlSU, Ulyanovsk State University</option>' +
                                        '<option {{ ($user->university == 'UlSTU, Ulyanovsk State Technical University') ? 'selected' : '' }}>UlSTU, Ulyanovsk State Technical University</option>' +
                                        '<option {{ ($user->university == 'UlICA, Ulyanovsk Institute of Civil Aviation') ? 'selected' : '' }}>UlICA, Ulyanovsk Institute of Civil Aviation</option>' +
                                        '<option {{ ($user->university == 'UlSPU, Ulyanovsk State Pedagogical University') ? 'selected' : '' }}>UlSPU, Ulyanovsk State Pedagogical University</option>' +
                                        '<option {{ ($user->university == 'UlSAA, Ulyanovsk State Agricultural Academy') ? 'selected' : '' }}>UlSAA, Ulyanovsk State Agricultural Academy</option>' +
                                        '<select>';
                            }
                        </script>
                    {!! Form::close() !!}
                    <!-- -->
                </div>
            </div>
        </div>
    </div>
@endsection
