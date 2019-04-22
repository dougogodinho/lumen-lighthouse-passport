<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class BasicTest extends TestCase
{
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    public function testGraphQLHello()
    {
        $this->graphql('{hello}');
        $this->assertNotNull($this->getJson('data.hello'));
    }
}
