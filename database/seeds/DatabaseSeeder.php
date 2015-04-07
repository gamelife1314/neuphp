<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
        \DB::table('users')->delete();
        \DB::table('topics')->delete();
        \DB::table('replies')->delete();



		$faker = Faker::create();
		//users数据表
   	      foreach (range(1, 100) as $index) {
            App\User::create([
                'name'             => $faker->userName(),
                'personal_website' => $faker->url(),
                'introduction'      => $faker->sentence(),
                'email'            => $faker->email(),
                'password'         => $faker->md5(),
                'image_url'        => 'image/avatars/img'.rand(1,44).'.png',
                'github'           => $faker->url(),
                'city'             => $faker->city(),
                'real_name'        => $faker->userName(),
                'topic_count'      => rand(1,13),
                'reply_count'      => rand(5,20),
                'university'       => $faker->userName(),
                'major'            => $faker->userName()
            ]);
        }
    //topics数据表
     foreach (range(1, 500) as $index) {
            App\Topic::create([
                'title'             => "test topic-->".$faker->sentence($nbWords = 5),
                'content'           => $faker->text($maxNbChars = 2000),
                'user_id'           => rand(1,100),
                'node_id'           => rand(7,42),
                'is_excellent'      => rand(0,1),
                'last_reply_user_id' => rand(1,50),
                'reply_count'        => rand(2,9),
                'view_count'        => rand(0,30),
                'vote_count'        => rand(4,15),
                'favorite_count'    => rand(6,12),
                'is_wiki'           => rand(0,1),
                'is_right_recommend' => rand(0,1),
                'created_at'         =>date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s')
            ]);
        }
    for ($i = 10; $i < 30; $i++) {
        if ($i < 20) {
            $topic = App\Topic::find($i);
            $topic->stick = 1;
            $topic->save();
        }
        else {
            $topic = App\Topic::find($i);
            $topic->recommend = 1;
            $topic->save();
        }
    }
	//填充replies数据库
	foreach (range(1,2000) as $index) {
          App\Reply::create([
             'body' => $faker->paragraph($nbSentences = 3),
             'user_id'           => rand(1,60),
             'topic_id'          => rand(1,500)
            ]);
    }
    //更新nodes数据表时间戳
    $nodes = App\Node::all();
    foreach ($nodes as  $node) {
        $node->touch();
    }

    //建立收藏关系表
    foreach (range(1,500) as $index) {
       \DB::table('collects')->insert(['topic_id' => rand(1,500),'user_id' => rand(1,100)]);
    }
	}

}
