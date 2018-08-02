<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert(
            [
                [
                    'title' => 'Project1',
                    'description' => 'Description for Project1"',
                    'status_id' => rand(1, 4),
                    'master_id' => rand(1, App\User::all()->count()),
                ],
                [
                    'title' => 'Project2',
                    'description' => 'Description for Project2"',
                    'status_id' => rand(1, 4),
                    'master_id' => rand(1, App\User::all()->count()),
                ],
                [
                    'title' => 'Project3',
                    'description' => 'Description for Project3"',
                    'status_id' => rand(1, 4),
                    'master_id' => rand(1, App\User::all()->count()),
                ],
                [
                    'title' => 'Project4',
                    'description' => 'Description for Project4"',
                    'status_id' => rand(1, 4),
                    'master_id' => rand(1, App\User::all()->count()),
                ],
                [
                    'title' => 'Project5',
                    'description' => 'Description for Project5"',
                    'status_id' => rand(1, 4),
                    'master_id' => rand(1, App\User::all()->count()),
                ],
            ]
        );
    }
}
