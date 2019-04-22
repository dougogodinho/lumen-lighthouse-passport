<?php

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
     * @return TestCase
     */
    public function graphql($query)
    {
        return $this->post('/graphql', compact('query'));
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
