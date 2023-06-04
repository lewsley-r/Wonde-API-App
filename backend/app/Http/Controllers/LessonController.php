<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class LessonController extends Controller
{
   
    public function getLessons() 
    {
        $client = new \Wonde\Client('7231f99ac6a9e6e7f6bc54976efe1401fe4dac60​');

        $school = $client->school('A1930499544');

        $my_lessons = get_object_vars($school->lessons->all());
        return ($my_lessons);
    }

   
}
