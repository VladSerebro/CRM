<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User as User;

class TemplateTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $admin = User::find(3);

        $this->actingAs($admin)
            ->visit('/project/all')
            ->click('My projects')
            ->see('Project555');
            //->seePageIs('/project/all');
    }
}
