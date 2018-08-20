<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User as User;

class ProjectViewPageTest extends TestCase
{
    /**
     * check for the result of pressing the button ==> Add task
     *
     * @return void
     */
    public function testClickLinkAddTask()
    {
        $admin = User::find(3);

        $this->actingAs($admin)
            ->visit('project/view/2')
            ->click('Add task')
            ->seePageIs('project/2/task/new');
    }

    /**
     * check for the result of pressing the link ==> View
     *
     * @return void
     */
    public function testClickLinkView()
    {
        $admin = User::find(3);

        $this->actingAs($admin)
            ->visit('project/view/2')
            ->click('View')
            ->seePageIs('/project/2/task/view/10');
    }

}
