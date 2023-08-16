<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testThatTrueIsTrue()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
