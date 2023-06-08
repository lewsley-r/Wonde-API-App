<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClassTest extends TestCase
{
   
    public function test_classes_request_sucess(): void
    {
        $response = $this->get('/api/classes');

        $response->assertStatus(200);
    }

    public function test_classes_returned(): void
    {
        $response = $this->get('/api/classes');

        $data = $response->getData();
        $this->assertGreaterThan(0, count($data->array));
    }

    
}
