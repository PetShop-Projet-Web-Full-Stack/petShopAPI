<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Responses\QuestionResponse;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        $response = new QuestionResponse($questions->toArray());
        return $response->toArray();
    }
}
