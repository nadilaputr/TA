<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('permission:delete posts', ['only' => ['destroy']]);
    }


}

