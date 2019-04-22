<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    public function testExample()
    {
        $user = factory(\App\User::class)->create();

        $this->graphql("
            mutation {
                auth(email: \"{$user->email}\" password: \"secret\") { 
                    token 
                    user{
                        id 
                        name
                    } 
                }
            }
        ");

        $this->assertNotNull($this->getJson('data.auth.token'));
        $this->assertNotNull($this->getJson('data.auth.user.id'));
        $this->assertNotNull($this->getJson('data.auth.user.name'));
    }
}
