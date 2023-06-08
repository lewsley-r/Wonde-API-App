<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
 
    
    public function test_employees_returned(): void
    {
        $response = $this->get('/api/employees');

        $data = $response->getData();
        $this->assertGreaterThan(0, count($data->array));
    }
}
