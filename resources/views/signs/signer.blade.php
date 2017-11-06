@extends('layouts.default')
@section('title', '签到用户')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <a href="{{ route('sign.output') }}" class="btn btn-success"><i class="fa fa-table" aria-hidden="true"></i> 导出 Excel 表格</a>
            <p></p>
            <table class="table table-striped table-hover table-responsive">
                <caption>签到用户列表 | 合计 {{ $counts }} 条数据</caption>
                <thead>
                <tr>
                    <th>姓名</th>
                    <th>公司</th>
                    <th>联系方式</th>
                </tr>
                </thead>
                <tbody>
                @foreach($signs as  $sign)
                    <tr>
                        <td>{{ $sign->name }}</td>
                        <td>{{ $sign->corporate }}</td>
                        <td>{{ $sign->telephone }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $signs->render() !!}
        </div>
    </div>
@endsection
