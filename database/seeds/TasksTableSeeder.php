<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert(
            [
                [
                    'title' => 'Make models',
                    'project_id' => rand(1,5),
                    'description' => 'Description for Task "Make models"',
                    'status_id' => rand(1, 4),
                    'master_id' => rand(1, App\User::all()->count()),
                    'performer_id' => rand(1, App\User::all()->count())
                ],
                [
                    'title' => 'Make controllers',
                    'project_id' => rand(1,5),
                    'description' => 'Description for Task "Make controllers"',
                    'status_id' => rand(1, 4),
                    'master_id' => rand(1, App\User::all()->count()),
                    'performer_id' => rand(1, App\User::all()->count())
                ],
                [
                    'title' => 'Make views',
                    'project_id' => rand(1,5),
                    'description' => 'Description for Task "Make views"',
                    'status_id' => rand(1, 4),
                    'master_id' => rand(1, App\User::all()->count()),
                    'performer_id' => rand(1, App\User::all()->count())
                ],
                [
                    'title' => 'Make routes',
                    'project_id' => rand(1,5),
                    'description' => 'Description for Task "Make routs"',
                    'status_id' => rand(1, 4),
                    'master_id' => rand(1, App\User::all()->count()),
                    'performer_id' => rand(1, App\User::all()->count())
                ],
                [
                    'title' => 'Test routes',
                    'project_id' => rand(1,5),
                    'description' => 'Description for Task "Test routs"',
                    'status_id' => rand(1, 4),
                    'master_id' => rand(1, App\User::all()->count()),
                    'performer_id' => rand(1, App\User::all()->count())
                ],
                [
                    'title' => 'Configure server',
                    'project_id' => rand(1,5),
                    'description' => 'Description for Task "Configure server"',
                    'status_id' => rand(1, 4),
                    'master_id' => rand(1, App\User::all()->count()),
                    'performer_id' => rand(1, App\User::all()->count())
                ],
                [
                    'title' => 'Test connections',
                    'project_id' => rand(1,5),
                    'description' => 'Description for Task "Test connections"',
                    'status_id' => rand(1, 4),
                    'master_id' => rand(1, App\User::all()->count()),
                    'performer_id' => rand(1, App\User::all()->count())
                ],
                [
                    'title' => 'Add email validation',
                    'project_id' => rand(1,5),
                    'description' => 'Description for Task "Add email validation"',
                    'status_id' => rand(1, 4),
                    'master_id' => rand(1, App\User::all()->count()),
                    'performer_id' => rand(1, App\User::all()->count())
                ],
                [
                    'title' => 'Add password validation',
                    'project_id' => rand(1,5),
                    'description' => 'Description for Task "Add password validation"',
                    'status_id' => rand(1, 4),
                    'master_id' => rand(1, App\User::all()->count()),
                    'performer_id' => rand(1, App\User::all()->count())
                ],
                [
                    'title' => 'Fixed bugs',
                    'project_id' => rand(1,5),
                    'description' => 'Description for Task "Fixed bugs"',
                    'status_id' => rand(1, 4),
                    'master_id' => rand(1, App\User::all()->count()),
                    'performer_id' => rand(1, App\User::all()->count())
                ],


            ]
        );
    }
}
