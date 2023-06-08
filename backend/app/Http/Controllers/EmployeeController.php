<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Wonde\Client as wClient;

class EmployeeController extends Controller
{
   
    public function getEmployees() : JsonResponse
    {
        $client = new wClient('7231f99ac6a9e6e7f6bc54976efe1401fe4dac60​');
        $school = $client->school('A1930499544');
        $my_employees = get_object_vars($school->employees->all(['classes'], ['per_page' => '100', 'has_class' => 'true', 'has_student' => 'true']));
        return $this->respondWithSuccess($my_employees);
    }

   
}
