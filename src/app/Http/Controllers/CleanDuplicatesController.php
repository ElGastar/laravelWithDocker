<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class CleanDuplicatesController extends Controller
{
    public function removeDuplicateTags($tag)
    {
            $duplicates = Tag::where("name",$tag)->get();
            $rest = $duplicates->skip(1);
            foreach($rest as $res ){
                $res->delete();
            }
    }
}
