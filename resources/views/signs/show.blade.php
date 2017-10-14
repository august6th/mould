@extends('layouts.default')
@section('title', '分享')

@section('content')
没什么特殊的内容



<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    wx.config( {!! $config_json !!} );
    wx.ready(function () {
        var shareData = {
            title: '乐清市模具展会邀请函',
            desc: '欢迎参加',
            link: 'http://baidu.com',
            imgUrl: 'http://baidu.com/logo.jpg'
        };
        wx.onMenuShareAppMessage(shareData);
        wx.onMenuShareTimeline(shareData);
    });
    wx.error(function (res) {
        alert(res.errMsg);
    });
</script>

@stop