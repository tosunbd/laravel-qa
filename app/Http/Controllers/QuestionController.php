<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\AskQuestionRequest;

class QuestionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        $this->middleware('auth', ['except' => ['index','show']]);
     }

    public function index()
    {
        //\DB::enableQueryLog();

        $questions = Question::with('user')->latest()->paginate(10);

        //view('questions.index', compact('questions'))->render();
        return view('questions.index', compact('questions'));

        //dd(\DB::getQueryLog());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question();

        return view('questions.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->only('title','body'));
        //$request->user()->questions()->create($request->all());
        //dd('store');

        //return redirect('/questions');
        return redirect()->route('questions.index')->with('success', "Your question has been submitted.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //dd($question->body);
        /*$question->view = $question->view + 1;
        $question->save();*/
        $question->increment('views');
        return view('questions.show',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        /*
        if(\Gate::allows('update-question',$question))
        {
            return view("questions.edit", compact('question'));
        }
        abort(403, "Access Denied.");
        */

        /*
        if(\Gate::denies('update-question',$question))
        {
            abort(403, "Access Denied.");
        }
        return view("questions.edit", compact('question'));
        */

        $this->authorize("update", $question);
        return view("questions.edit", compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        /*
        if(\Gate::denies('update-question',$question))
        {
            abort(403, "Access Denied.");
        }
        */

        $this->authorize("update", $question);

        $question->update($request->only('title','body'));

        return redirect('/questions')->with('success', "Your question has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        /*
        if(\Gate::denies('delete-question',$question))
        {
            abort(403, "Access Denied.");
        }
        */

        $this->authorize("delete", $question);

        $question->delete();

        return redirect('questions')->with('success', "Your question has been deleted.");
    }
}
