<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Dashboard\Question\CreateQuestionRequest;
use App\Http\Requests\Api\Dashboard\Question\FilterQuestionRequest;
use App\Http\Resources\Question\QuestionCollection;
use App\Http\Resources\Question\QuestionResource;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FilterQuestionRequest $request)
    {

        $questions =Question::where('user_id',$request->input('user_id'))->paginate();


        return QuestionCollection::collection($questions);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.question.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( CreateQuestionRequest $request )
    {


        $question = new Question();

        $question->text= $request->input('text');
        $question->user_id=$request->input('user_id');
        $question->unique_string=uniqid();
        $question->admin_answer_status=false;
        if ($question->save())
        {
            if ($request->has('file'))
            {
                $file = $request->file('file');
                $image = Image::make($file)->encode('jpg', 75);
                $p =Storage::put('upload/sliders/' . (string) $question->unique_string . ".jpg", (string)$image->encode());
            }
        }
        return response([
            'data' => new QuestionResource($question), 'meta' => ['code' => 200]
        ], Response::HTTP_CREATED);



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Model\Post  $post
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, Post $post)
//    {
//
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Question $question)
    {
      if ($question->delete())
          return redirect()->back()->with(['success'=>'سوال با موفقیت حذف شد']);
      else
          return redirect()->back()->with(['error'=>'خطایی در سرور رخ داده است']);





    }
}
