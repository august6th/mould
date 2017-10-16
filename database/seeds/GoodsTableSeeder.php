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
            ['gname' => '充电数据线', 'gimg' => 'sjx', 'con_point' => '温州浩瑞网络科技有限公司', 'dstock' => '30', 'gstock' => 999, 'probability' => 5],
            ['gname' => '充电宝', 'gimg' => 'cdb', 'con_point' => '温州浩瑞网络科技有限公司', 'dstock' => '30', 'gstock' => 999, 'probability' => 3],
            ['gname' => '矿泉水', 'gimg' => 'kqs', 'con_point' => '温州浩瑞网络科技有限公司', 'dstock' => '30', 'gstock' => 999, 'probability' => 20],
            ['gname' => '电热水壶', 'gimg' => 'rsh', 'con_point' => '温州浩瑞网络科技有限公司', 'dstock' => '30', 'gstock' => 999, 'probability' => 1],
            ['gname' => '矿泉水', 'gimg' => 'kqs', 'con_point' => '温州浩瑞网络科技有限公司', 'dstock' => '30', 'gstock' => 999, 'probability' => 20],
            ['gname' => '玻璃杯套装', 'gimg' => 'blb', 'con_point' => '温州浩瑞网络科技有限公司', 'dstock' => '30', 'gstock' => 999, 'probability' => 3],
            ['gname' => '保温杯', 'gimg' => 'bwb', 'con_point' => '温州浩瑞网络科技有限公司', 'dstock' => '30', 'gstock' => 999, 'probability' => 3],
            ['gname' => '矿泉水', 'gimg' => 'kqs', 'con_point' => '温州浩瑞网络科技有限公司', 'dstock' => '30', 'gstock' => 999, 'probability' => 20],
        ]);
    }
}
