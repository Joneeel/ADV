<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class borrowercontroller extends Controller
{
    public function create() {

    }

    public function edit() {
        
    }

    public function delete() {
        
    }

    public function createdisplay() {
        return view('borrower.create');
    }

    public function editdisplay() {
        return view('borrower.edit');
    }

}
