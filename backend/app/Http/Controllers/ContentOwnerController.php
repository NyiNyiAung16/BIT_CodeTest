<?php

namespace App\Http\Controllers;

use App\Models\ContentOwner;
use Illuminate\Http\Request;

class ContentOwnerController extends Controller
{
    public function get(){
        return ContentOwner::get();
    }
}
