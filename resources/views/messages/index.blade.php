@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Dialogs</div>

                    <div class="card-body row justify-content-center">

                        <div class="col-md-12">

                            @forelse($dialogs as $dialog)
                                    <div class="row justify-content-center" style="padding: 15px; border-top: 1px solid #d8d8d8; cursor: pointer;
                                            @if($dialog->status == 0 && $dialog->sender_id == $dialog->chat_id /* Входящее непрочитанное */) background-color: #f0f4f7; @endif"
                                            onclick="location.href='{{ route('dialog', $dialog->chat_id) }}';" >
                                        <div class="col-md-2">
                                            <a href="{{ route('search.showUser', $dialog->chat_id) }}">
                                                <img src="/uploads/avatars/{{ $dialog->avatar }}" style="width:80px; height:80px; border-radius:50%;" class="img-fluid">
                                            </a>
                                        </div>

                                        <div class="col-md-10">
                                            <div class="row" style="font-size: 100%; margin-bottom: 10px; padding-left: 5px;">
                                                <div class="col-md-8">
                                                    <a href="{{ route('search.showUser', $dialog->chat_id) }}"> {{$dialog->name}} {{$dialog->lastName}}</a>
                                                </div>

                                                <div class="col-md-4">
                                                    {{ $dialog->created_at }}
                                                </div>
                                            </div>

                                            <div class="row col-md-12" style="font-size: 90%; margin-left: 0; padding: 5px 5px 0 5px;
                                            @if($dialog->sender_id != $dialog->chat_id && $dialog->status == 0/*Исходящее непрочитанное*/) background-color: #e4ecf1; @endif">
                                                <p> @if($dialog->sender_id != $dialog->chat_id /*Исходящее*/) <b><span style="color: #007bff">You: </span></b> @endif
                                                    {{ $dialog->text }}
                                                    @if($dialog->sender_id == $dialog->chat_id && $dialog->status == 0 /* Входящее непрочитанное */)<span style="color: #e6283c">(new) </span> @endif
                                                    @if($dialog->sender_id != $dialog->chat_id && $dialog->status == 0/*Исходящее непрочитанное*/) <span style="color: #e6283c">(unread)</span> @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                            @empty <div align="center">No messages</div><br>
                            @endforelse

                             <!-- Нижний бордюр -->
                             <div class="row justify-content-center" style="border-top: 1px solid #d8d8d8"></div>

                         </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection