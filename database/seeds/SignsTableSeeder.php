<?php

use Illuminate\Database\Seeder;

class SignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('signs')->insert([
            ['openid' => 'od-pK0ggVR3vpOAJwic9DFMyzX1Q', 'name' => '李恒', 'corporate' => '温州浩瑞网络科技有限公司', 'telephone' => '15623054630', 'lottery_flag' => 0, 'is_admin' => 1, 'share_flag' => 0]
        ]);
    }
}
