<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class notreturnedbookscontroller extends Controller
{
    public function create() {

    }

    public function edit() {
        
    }

    public function delete() {
        
    }

    public function createdisplay() {
        return view('notreturnedbooks.create');
    }

    public function editdisplay() {
        return view('notreturnedbooks.edit');
    }

}
