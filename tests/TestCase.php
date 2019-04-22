<?php

use App\User;

abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__ . '/../bootstrap/app.php';
    }

    /**
     * @param $query
     * @param null|string|User $userToken
     * @param null $variables
     * @return TestCase
     */
    public function graphql($query, $userToken = null, $variables = null)
    {
        $userToken = $userToken instanceof User ? $userToken->createToken('Test Case Request')->accessToken : $userToken;

        $headers = $userToken ? ['Authorization' => 'Bearer ' . $userToken] : [];

        return $this->post('/graphql', compact('query', 'variables'), $headers);
    }

    /**
     * @param null $key
     * @return mixed
     */
    public function getJson($key = null)
    {
        return data_get(json_decode($this->response->getContent(), true), $key);
    }
}
