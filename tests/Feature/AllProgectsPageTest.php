<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User as User;

class AllProgectsPageTest extends TestCase
{
    /**
     * check for the result of pressing the button ==> New
     *
     * @return void
     */
    public function testPressButtonNew()
    {
        $admin = User::find(3);

        $this->actingAs($admin)
            ->visit('project/all')
            ->click('New')
            ->seePageIs('project/new');
    }

    /**
     * check for the result of pressing the link ==> Project1
     *
     * @return void
     */
    public function testClickLinkProject()
    {
        $admin = User::find(3);

        $this->actingAs($admin)
            ->visit('/project/all')
            ->click('Project1')
            ->seePageIs('project/view/1');
    }

    /**
     * check for the result of pressing the link ==> My projects
     *
     * @return void
     */
    public function testClickLinkMyProjects()
    {
        $admin = User::find(3);

        $this->actingAs($admin)
            ->visit('project/all')
            ->click('My projects')
            ->seePageIs('project/my_projects');
    }

    /**
     * check for the result of pressing the link ==> Tasks for me
     *
     * @return void
     */
    public function testClickLinkTasksForMe()
    {
        $admin = User::find(3);

        $this->actingAs($admin)
            ->visit('project/all')
            ->click('Tasks for me')
            ->seePageIs('task/my_tasks');
    }

}
