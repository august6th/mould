@extends('layouts.default')
@section('title', '奖品列表')

@section('content')
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            @if (!empty($goods))
                <table class="table table-hover table-striped table-goods">
                    <caption>
                        已设置的奖品信息
                        &nbsp;&nbsp;<a href="{{ route('lottery.edit') }}" class="btn btn-sm btn-success"><i
                                    class="fa fa-plus" aria-hidden="true"></i> 添加</a>
                    </caption>

                    <thead>
                    <tr>
                        <th>id</th>
                        <th>名称</th>
                        <th>外库</th>
                        <th>总库</th>
                        <th class="mobile_hide">图片</th>
                        <th class="mobile_hide">概率</th>
                        <th class="mobile_hide">位置</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($goods as $good)
                        <tr>
                            <td>{{ $good->id }}</td>
                            <td>{{ $good->gname }}</td>
                            <td>{{ $good->dstock }}</td>
                            <td>{{ $good->gstock }}</td>
                            <td class="mobile_hide">{{ $good->gimg }}</td>
                            <td class="mobile_hide">{{ $good->probability }}</td>
                            <td class="mobile_hide">{{ $good->con_point }}</td>
                            <td>
                                <form action="{{ route('lottery.destroy', $good->id) }}" method="post" class="lottery-form">
                                    <form action="#" method="post" class="lottery-form">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-sm btn-danger">删除</button>
                                </form>
                                <a href="{{ route('lottery.change', $good->id) }}" class="btn btn-sm btn-primary">修改</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <small>目前暂未设置任何奖品</small>
                <a href="{{ route('lottery.edit') }}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> 添加</a>
            @endif
        </div>
    </div>
@stop