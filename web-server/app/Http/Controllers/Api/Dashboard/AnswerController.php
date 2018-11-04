<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Answer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Answer\CreateAnswerRequest;
use App\Question;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question )
    {
        $answers= Answer::where('question_id',$question->id)->paginate();
        return view('dashboard.pages.answer.index',compact('question',"answers"));



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Question $question)
    {
        return view('admin.pages.answer.create',compact('question'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question ,CreateAnswerRequest $request )
    {
        $answer = new Answer();

        $answer->text= $request->input('text');
        $answer->user_id= Auth::user()->id;
        $answer->question_id=$question->id;
        $answer->unique_string=uniqid();

        $answer->save();
        $question->admin_answer_status=true;
        $question->save();

            if($request->has('file'))
            {
                $file = $request->file('file');
                $image = Image::make($file)->encode('jpg', 75);
                $p =Storage::put('upload/sliders/' . (string) $answer->unique_string . ".jpg", (string)$image->encode());
            }

        return redirect()->back()->with(['success'=>'جواب با موفقیت ذخیره شد']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {


    }
}
