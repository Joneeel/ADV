<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class borrowcontroller extends Controller
{
    public function create() {

    }

    public function edit() {
        
    }

    public function delete() {

    }

    public function createdisplay() {
        return view('borrow.create');
    }

    public function editdisplay() {
        return view('borrow.edit');
    }

}
