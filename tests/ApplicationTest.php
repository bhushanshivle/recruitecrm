<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ApplicationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testApplication()
    {

        $response = $this->call('GET', '/candidates');

        $this->assertEquals(200, $response->status());

        $response = $this->call( 'POST','/candidates', ['first_name' => 'Test']);

        $this->assertEquals(200, $response->status());
    }
}
