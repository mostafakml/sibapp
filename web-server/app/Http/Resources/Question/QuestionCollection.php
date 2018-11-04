<?php

namespace App\Http\Resources\Question;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class QuestionCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' =>$this->id,
            'text' => $this->text,
            'file' => $this->addImageUrlToArray($this->id, "public/upload/sliders/")
        ];
    }
    private function addImageUrlToArray($avatar, $urlPath)
    {

        if (file_exists(public_path(Storage::url($urlPath . $avatar.".jpg")))) {
            $filePath = asset(Storage::url($urlPath . $avatar.".jpg"));
        }
        else {
            $filePath = asset('images/avatar.jpg');
        }
        return $filePath;
    }


}
