<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class LikeController extends Controller
{
    public function store(Request $request, Post $post){

        return back();
    }

    public function destroy(Request $request, Post $post){

    }
}
