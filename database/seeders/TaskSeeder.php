<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        foreach ($users->random(20) as $user){
            $user->tasks()->createMany(Task::factory(fake()->numberBetween(1,10))->make([
                "executor_id" => $users->where("id","<>",$user->id)->random(1)->first->id
            ])->toArray());
        }
    }
}
