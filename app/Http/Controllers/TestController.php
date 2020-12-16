<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
;

class TestController extends Controller {
    public function add(){
        return view('tests.add');
    }

    public function addSubmit(Request $req){
        print_r($req->all());
    }
    

}
