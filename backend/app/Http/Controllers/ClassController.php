<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ClassController extends Controller
{
   
    public function getClass(Request $request) : Object  
    {
        $client = new \Wonde\Client('7231f99ac6a9e6e7f6bc54976efe1401fe4dac60​');

        $school = $client->school('A1930499544');
        $classes = $school->classes;
        $my_class = $classes->get($request->class_id, ['lessons', 'employees']);
        return ($my_class);
    }


    public function getClasses(Request $request)   
    {
        $client = new \Wonde\Client('7231f99ac6a9e6e7f6bc54976efe1401fe4dac60​');
        $school = $client->school('A1930499544');
        $classes = get_object_vars($school->classes->all(['lessons', 'lessons.period', 'students'], ['per_page' => 200, 'page' => $request->page_no]));
        return ($classes);
    }

   
}
