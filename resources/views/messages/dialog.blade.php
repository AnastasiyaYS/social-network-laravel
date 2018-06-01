@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Dialog with {{ $pen_pal->name }} {{ $pen_pal->lastName }} </div>

                    <div class="card-body row justify-content-center">
                        <div class="col-md-12">

                            @forelse ($messages as $message)
                                <!-- Диалог - входящее/исходящее сообщение прочитанное -->
                                <div class="row justify-content-center" style="padding: 7px;
                                        @if($message->status == 0 /* Непрочитанное */) background-color: #eaf0f4 @endif">
                                    <div class="col-md-2 text-center" style="padding: 0 10px;">
                                        <a href="{{ route('search.showUser', $message->chat_id) }}">
                                            <img src="/uploads/avatars/{{ $message->avatar }}" style="width:40px; height:40px; border-radius:50%;" class="img-fluid">
                                        </a>
                                    </div>

                                    <div class="col-md-8" style="font-size: 90%; padding: 5px">
                                        <p>{{ $message->text }}</p>
                                    </div>

                                    <div class="col-md-2 text-center" style="font-size: 80%; margin-left: 0; padding: 0 10px">
                                        {{ $message->created_at }}
                                    </div>
                                </div>
                            @empty <div align="center">No messages</div><br>
                            @endforelse

                        </div>

                        <!-- Написать сообщение -->
                        <div class="col-md-12">
                            {!! Form::open(['route' => ['dialog', $chat_id],'method'=>'POST', 'files'=>'true']) !!}
                                <div class="row" style="margin-top: 20px; padding: 20px 0; border-top: 3px solid #f2f2f2; border-bottom: 3px solid #f2f2f2; background: #fbfbfb;">
                                    <div class="col-md-9 text-center" style="padding: 0">
                                        <textarea style="width: 90%; font-size: 90%" name="message_text"></textarea>
                                        <input type="file" name="message_file">
                                    </div>

                                    <div class="col-md-3 text-center" style="padding: 0">
                                        <input type="submit" class="btn btn-primary" value="Send message" style="margin-top: 5px">
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection