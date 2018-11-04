<?php

namespace App\Http\Resources\Question;

use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class QuestionResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {


        return [
            'id'   =>($this->id),
            'text' => $this->text,
            'file' => "d",
        ];
    }

}
