@extends('layouts.default')
@section('title', '分享')

@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <section class="user_info">
                <img src="{{ $wechat_user->getAvatar() }}" alt="{{ $wechat_user->getNickname() }}" class="gravatar"/>
                <h1>{{ $wechat_user->getNickname() }}</h1>
                <div class="share-btns">
                    @if ( $wechat_user->getId()  == 'od-pK0ggVR3vpOAJwic9DFMyzX1Q' )
                        <a href="{{ route('lottery.show') }}" class="btn btn-md share-btn btn-success"><i class="fa fa-cog" aria-hidden="true"></i>管理</a>
                    @endif
                    @if ( $flag )
                        <a href="{{ route('lottery.index') }}" class="btn btn-md btn-danger share-lottery"><span class="glyphicon glyphicon-gift"></span> 抽奖</a>
                    @else
                        <button class="btn btn-md btn-info share-btn share-touch"><i class="fa fa-share" aria-hidden="true"></i> 点击右上角
                            <img src="assets/img/dian.png" alt="" class="img-responsive point"> 分享后可参与抽奖
                        </button>
                    @endif
                </div>
            </section>
        </div>
    </div>
    </div>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        wx.config( {!! $config_json !!} );
        wx.ready(function () {
            var shareData = {
                title: '第 19 届乐清模具设备塑机自动化展已开幕！请接收参观指南！',
                desc: '欢迎您来参加',
                link: 'http://lh5.mouldzj.com/words',
                imgUrl: 'http://lh5.mouldzj.com/assets/img/op_start.png',
                success: function (res) {

                    $.post("/share_flag", {'_token':'{{csrf_token()}}', share_flag : 1}, function (data) {
                        if (data) {
                            swal("感谢分享", "您的支持是对我们最大的动力", "success");
                        } else {
                            swal('', "抱歉，服务出错，请稍后重试！", "error")
                        }
                    });
                    if($('.share-lottery').length == 0){
                        $('.share-touch').css('display', 'none');
                        $('.share-btns').append('<a href="{{ route('lottery.index') }}" class="btn btn-md btn-danger share-lottery"><span class="glyphicon glyphicon-gift"></span> 抽奖</a>');
                    }
                },
                cancel: function (res) {
                    swal("", "您取消了分享", "error");
                }
            };
            wx.onMenuShareQQ(shareData);
            wx.onMenuShareWeibo(shareData);
            wx.onMenuShareTimeline(shareData);
            wx.onMenuShareAppMessage(shareData);
        });

        wx.error(function (res) {
            // alert(res.errMsg);
        });
    </script>
@endsection
