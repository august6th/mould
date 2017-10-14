@extends('defaults.forms')
@section('title', '签到')

@section('content')
        <!-- Top content -->
<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>中国模具网</strong></h1>
                    <div class="description">
                        <p>
                            欢迎参观由<a href="http://www.mould.net.cn"><strong>中国模具网</strong></a>举办的全国模具展会
                            这里有展会的最新消息和参展商信息。完成信息登录后将获得丰厚的奖品。
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>完成签到</h3>
                            <p>填入信息完成签到，赢取丰厚奖品:</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-pencil-square-o"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form role="form" action="#" method="post" class="login-form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="sr-only" for="form-username">您的姓名</label>
                                <input type="text" name="name" placeholder="您的姓名..." class="form-username form-control" id="form-username" value="{{ old('name') }}">
                            </div>

                            <div class="form-group">
                                <label class="sr-only" for="form-telphone">联系方式</label>
                                <input type="text" name="tel" placeholder="联系方式..." class="form-telphone form-control" id="form-telphone" value="{{ old('tel') }}">
                            </div>

                            <div class="form-group">
                                <label class="sr-only" for="form-corporate">公司名称</label>
                                <input type="text" name="corporate" placeholder="公司名称..." class="form-corporate form-control" id="form-corporate" value="{{ old('corporate') }}">
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="openid" value="{{ $wechat_user->getId() }}">
                            </div>

                            <button type="submit" class="btn">签到</button>
                        </form>
                        <p></p>
                        <p class="login-ask"><small>请填写真实数据，便于奖品兑换</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@stop
