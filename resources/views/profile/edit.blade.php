@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{ $userProfile->email }}</div>

                    {!! Form::open(['route' => ['profile.update'], 'method'=>'POST', 'files'=>'true']) !!}

                    @csrf

                        <div class="card-body row">

                            @if (session('status')) <!-- ??? -->
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="col-md-4 offset-md-1 item text-center"><br>
                                <h3>{{ $userProfile->lastName }} {{ $userProfile->name }}</h3> <br>
                                <p><img src="/uploads/avatars/{{$userProfile->avatar}}" style="width:200px; height:200px;" class="img-fluid"></p>
                                <div class="file_upload">
                                    <input type="file" name="avatar">
                                    <div style="color: #f4595c">(Only for square photos)</div>
                                </div>
                            </div>

                            <ul class="col-md-4 offset-md-2 item text-center"><br>

                                <div class="form-group">    <!-- Бутстраповская форма - form-group, все элементы - form-control -->
                                    <div class="row">
                                        <div class="col-md-4"><label for="gender" class="control-label"><strong>Gender:</strong></label></div>

                                        <div class="radio col-md-4">
                                            <label>
                                                <input class="form-control" type="radio" name="gender" id="gender1" value="male" {{ ($userProfile->gender == 'male') ? 'checked' : '' }}>
                                                Male
                                            </label>
                                        </div>
                                        <div class="radio col-md-4">
                                            <label>
                                                <input class="form-control" type="radio" name="gender" id="gender2" value="female" {{ ($userProfile->gender == 'female') ? 'checked' : '' }}>
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputBirthday"><strong>Birthday:</strong></label>
                                    <input type="date" class="form-control" name="birthday" value="{{ $userProfile->birthday }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputCity" class="control-label"><strong>City:</strong></label>
                                    <input type="text" class="form-control" id="inputCity" name="city" value="{{ $userProfile->city }}" >
                                </div>

                                <!-- Вывод всех университетов php -->
                                <p><strong>University:</strong><br>
                                    @foreach($userUniversities as $u)
                                        &#10004; {{ $u->university_name }}<br>
                                        <!-- Удаление ссылкой -->
                                        <a href="{{ route('university.destroy', $u->university_id) }}" class="btn btn-default">delete</a><br>
                                    @endforeach

                                    <div id="uniAdd">
                                        <div id="uniCopy">
                                            <div class="form-group" id="divUni">
                                                <input class="form-control" name="university[]" list="university">
                                                <datalist id="university">
                                                    @foreach($universities as $u)
                                                        <option> {{ $u->university_name }} </option>
                                                    @endforeach;
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </p>

                                <input type="button" class="btn btn-default" onclick="plus()" value="Add another university">
                                <br><br>
                                <input type="submit" class="btn btn-primary" value="Save changes">
                            </div>
                        </div>

                        <script>
                            function plus() {
                                document.getElementById('uniAdd').innerHTML += document.getElementById('uniCopy').innerHTML;
                            }
                        </script>
                    {!! Form::close() !!}
                    <!-- -->
                </div>
            </div>
        </div>
    </div>
@endsection
