@extends('layouts.default')
@section('title', '分享')

@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <section class="user_info">
                <img src="{{ $wechat_user->getAvatar() }}" alt="{{ $wechat_user->getNickname() }}" class="gravatar"/>
                <h1>{{ $wechat_user->getNickname() }}</h1>
                <button class="btn btn-md btn-info share_btn">查看分享</button>
            </section>
        </div>
    </div>
    </div>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        wx.config( {!! $config_json !!} );
        wx.ready(function () {
            var shareData = {
                title: '2017年乐清市模具展会邀请函',
                desc: '欢迎您来参加',
                link: 'http://lh5.mouldzj.com/go',
                imgUrl: 'http://lh5.mouldzj.com/assets/img/yqh.png',
                success: function (res) {
                    alert('感谢您的分享！');
                },
                cancel: function (res) {
                    alert('您已取消了分享！');
                }
            };

            wx.onMenuShareQQ(shareData);
            wx.onMenuShareWeibo(shareData);
            wx.onMenuShareTimeline(shareData);
            wx.onMenuShareAppMessage(shareData);
        });

        wx.error(function (res) {
            alert(res.errMsg);
        });
    </script>
@endsection
