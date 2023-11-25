<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
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

    public function getScore(QuestionRequest $request) : array
    {
        
    }

}
