@extends('layouts.default')
@section('title', '抽奖')

@section('content')
    <div class="col-md-12 np">
        <div class="lottery-body">
            <div class="lottery-head"></div>
            <div id="lottery">
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="lottery-unit lottery-unit-0"><img src="/assets/img/mlottery/sjx.png"><div class="mask"></div></td>
                        <td class="lottery-unit lottery-unit-1"><img src="/assets/img/mlottery/cdb.png"><div class="mask"></div></td>
                        <td class="lottery-unit lottery-unit-2"><img src="/assets/img/mlottery/kqs.png"><div class="mask"></div></td>
                    </tr>
                    <tr>
                        <td class="lottery-unit lottery-unit-7"><img src="/assets/img/mlottery/kqs.png"><div class="mask"></div></td>
                        <td><a href="javascript:;"></a></td>
                        <td class="lottery-unit lottery-unit-3"><img src="/assets/img/mlottery/rsh.png"><div class="mask"></div></td>
                    </tr>
                    <tr>
                        <td class="lottery-unit lottery-unit-6"><img src="/assets/img/mlottery/bwb.png"><div class="mask"></div></td>
                        <td class="lottery-unit lottery-unit-5"><img src="/assets/img/mlottery/blb.png"><div class="mask"></div></td>
                        <td class="lottery-unit lottery-unit-4"><img src="/assets/img/mlottery/kqs.png"><div class="mask"></div></td>
                    </tr>
                </table>
            </div>
            <!-- 九宫格中奖列表 -->
            <div class="lottery-footer">
                <div class="list lottery-list">
                </div>
                <div class="lottery-rule">
                    <h3>活动规则</h3>
                    <ul>
                        <li>1. 请到对应的领奖处领取奖品，<a href="#">点击这里</a>查看自己的奖品和领取详情。</li>
                        <li>2. 每个签到用户只有一次抽奖机会。请勿重复抽奖。</li>
                        <li>3. 本活动最终解释权归中国模具网所有。</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
