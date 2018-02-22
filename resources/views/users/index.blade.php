@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">{{ Auth::user()->surname }} {{ Auth::user()->name }} [email - {{ Auth::user()->email }}]</div>

                <div class="card-body row">

                    @if (session('status')) <!-- ??? -->
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-md-4 offset-md-1 item text-center">
                        <img src="{{asset('images/avatar.png')}}" class="img-fluid">
                    </div>

                    <div class="col-md-4 offset-md-1 item text-center">
                        <br>
                        <strong>Пол:</strong> женский <br>
                        <strong>День рождения:</strong> 29.11.1995г. <br>
                        <strong>Город:</strong> Ульяновск <br>
                        <strong>Образование:</strong> УлГУ <br>
                        <br>
                        <!-- ссылка -->
                        <a href="{{ route('users.edit') }}" class="btn btn-default">Редактировать</a>

                        <!--<button type="button" class="btn btn-default">Редактировать</button>-->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
