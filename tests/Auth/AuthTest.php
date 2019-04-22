<?php

use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    public function testLogin()
    {
        $user = factory(User::class)->create();

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

    public function testLoginWithVars()
    {
        $user = factory(User::class)->create();

        $this->graphql($q = '
            mutation Auth($email: String!, $password: String!){
                auth(email: $email password: $password) { 
                    token user{ id name } 
                }
            }
        ', null, ['password' => 'secret', 'email' => $user->email]);

        $this->assertNotNull($this->getJson('data.auth.token'));
        $this->assertNotNull($this->getJson('data.auth.user.id'));
        $this->assertNotNull($this->getJson('data.auth.user.name'));
    }

    public function testCheckLogin()
    {
        $user = factory(User::class)->create();

        $this->graphql("{ auth { id  name } }", $user);

        $this->assertNotNull($this->getJson('data.auth.id'));
        $this->assertNotNull($this->getJson('data.auth.name'));
    }
}
