<?php

use Illuminate\Database\Seeder;

class GoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goods')->insert([
            ['gname' => '多功能伸缩数据线', 'gimg' => 'sjx', 'con_point' => '乐清卡卡健身友情赞助,C馆门口领取', 'dstock' => 100, 'gstock' => 600, 'probability' => 5],
            ['gname' => '全自动茶道套装', 'gimg' => 'cdtz', 'con_point' => '上海索特激光切割机赞助,正大门口特C11展区领取', 'dstock' => 1, 'gstock' => 5, 'probability' => 1],
            ['gname' => '矿泉水', 'gimg' => 'kqs', 'con_point' => '感谢您的参与，逛得累了渴了喝口水,合发模架展区领取', 'dstock' => 30, 'gstock' => 500, 'probability' => 10],
            ['gname' => '便携充电宝', 'gimg' => 'cdb', 'con_point' => '日立模具钢赞助,产业园一楼日立展区领取', 'dstock' => 20, 'gstock' => 100, 'probability' => 3],
            ['gname' => '矿泉水', 'gimg' => 'kqs', 'con_point' => '感谢您的参与，逛得累了渴了喝口水,合发模架展区领取', 'dstock' => 100, 'gstock' => 300, 'probability' => 10],
            ['gname' => '电热水壶', 'gimg' => 'rsh', 'con_point' => '上海索特激光切割机赞助,正大门口特C11展区领取', 'dstock' => 15, 'gstock' => 70, 'probability' => 2],
            ['gname' => '矿泉水', 'gimg' => 'kqs', 'con_point' => '感谢您的参与，逛得累了渴了喝口水,合发模架展区领取', 'dstock' => 100, 'gstock' => 300, 'probability' => 10],
            ['gname' => '保温杯', 'gimg' => 'bwb', 'con_point' => '浙江三奇中走丝赞助,A馆A86-91展区领取', 'dstock' => 40, 'gstock' => 200, 'probability' => 6],
        ]);
    }
}
