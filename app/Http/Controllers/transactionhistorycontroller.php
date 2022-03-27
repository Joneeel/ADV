<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class transactionhistorycontroller extends Controller
{
    public function create() {

    }

    public function edit() {
        
    }

    public function delete() {
        
    }

    public function createdisplay() {
        return view('transactionhistory.create');
    }

    public function editdisplay() {
        return view('transactionhistory.edit');
    }

}
