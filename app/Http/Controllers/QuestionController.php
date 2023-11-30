<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Animal;
use App\Models\Question;
use App\Responses\QuestionResponse;
use App\Responses\QuestionsResponse;

class QuestionController extends Controller
{
    public function index(): array
    {
        $questions = Question::all();
        $response = new QuestionResponse($questions->toArray());
        return $response->toArray();
    }

    public function answers(QuestionRequest $request) : array
    {
        $animals = Animal::query()->with(['media']);;
        foreach ($request->answers as $answer) {
            $question = Question::find($answer['id_question']);
            $animals->where($question->animals_column, $answer['answer']);
        }
        $response['animals'] = $animals->get()->toArray();
        $response['total'] = $animals->count();

        $response = new QuestionsResponse($response);
        return $response->toArray();
    }
}
