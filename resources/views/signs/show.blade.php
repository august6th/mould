@extends('layouts.default')
@section('title', '分享')

@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <section class="user_info">
                <img src="{{ $wechat_user->getAvatar() }}" alt="{{ $wechat_user->getNickname() }}" class="gravatar"/>
                <h1>{{ $wechat_user->getNickname() }}</h1>
            </section>
        </div>
    </div>
    </div>
@endsection
