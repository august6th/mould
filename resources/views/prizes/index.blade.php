@extends('layouts.default')
@section('title', '我的奖品')

@section('content')
    @if (count($prizes) > 0)
    <div class="flash-message">
        <p class="alert alert-danger">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i> 请到指定位置进行奖品的兑换。
        </p>
    </div>
    @else
        <div class="flash-message">
            <p class="alert alert-info">
                <i class="fa fa-hand-o-right" aria-hidden="true"></i> <a href="{{ route('lottery.index') }}">去抽奖</a>。
            </p>
        </div>
    @endif
    <div class="col-md-offset-1 col-md-10 np">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    奖品列表
                </h3>
            </div>
            <div class="panel-body">
                @if (count($prizes) > 0)
                    <table class="table table-hover table-striped table-goods">
                        <thead>
                        <tr>
                            <th>奖品名称</th>
                            <th>领取位置</th>
                            <th>状态</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($prizes as $prize)
                            <tr>
                                <td>{{ $prize->gname }}</td>
                                <td>{{ $prize->con_point }}</td>
                                <td>
                                    @if($prize->receive)
                                        <a class="btn btn-sm btn-default" href="javascript:;">已领取</a>
                                        @else
                                        <form action="{{ route('prize.update') }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <input type="hidden" name="id" value="{{ $prize->id }}">
                                            <input type="submit" class="btn btn-sm btn-success" value="待领取">
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <ul class="list-unstyled empty-list text-center">
                        <li><img src="/img/empty.png" alt="empty" class="img-responsive"></li>
                        <li><small>Oops.. 没有检索到任何奖品。</small></li>
                    </ul>
                @endif
            </div>
        </div>
    </div>
@stop
