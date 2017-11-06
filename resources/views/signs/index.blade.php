@extends('defaults.forms')
@section('title', '签到')

@section('content')
        <!-- Top content -->
<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>乐清市模具行业协会</strong></h1>
                    <div class="description">
                        <p>
                            欢迎参观第十九届乐清模具设备塑机展暨工业自动化展。完成信息并分享可参与抽奖。
                        </p>
                    </div>
                </div>
            </div>
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="alert alert-danger show-errors">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li><small>{{ $error }}</small></li>
                                @endforeach
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            @else
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(session()->has($msg))
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="flash-message">
                                    <p class="alert alert-{{ $msg }} show-messages">
                                        <small>{{ session()->get($msg) }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>完成签到</h3>
                            <p>填入信息完成签到，赢取奖品:</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-pencil-square-o"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form role="form" action="{{ route('sign.store') }}" method="post" class="login-form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="sr-only" for="form-username">您的姓名</label>
                                <input type="text" name="name" placeholder="您的姓名..." class="form-username form-control" id="form-username" value="{{ old('name') }}">
                            </div>

                            <div class="form-group">
                                <label class="sr-only" for="form-telphone">联系方式</label>
                                <input type="text" name="telephone" placeholder="联系方式..." class="form-telphone form-control" id="form-telphone" value="{{ old('telephone') }}">
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
