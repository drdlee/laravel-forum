<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }
    
    /** @test */
    public function test_a_user_can_browse_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title)
        ;
        
    }

    /** @test */
    public function test_a_user_can_read_a_single_thread()
    {
        $this->get('/threads/'.$this->thread->id)
            ->assertSee($this->thread->title)
        ;
    }

    /** @test */
    function test_a_user_can_read_replies_from_a_single_thread()
    {
        // kita punya thread
        // $this->thread = factory('App\Thread')->create();

        // threadnya ada replies
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
        
        // saat kita buka thread tsb
        $response = $this->get('/threads/'.$this->thread->id);

        // kita bisa lihat replies-nya
        $response->assertSee($reply->body);
    }
}
