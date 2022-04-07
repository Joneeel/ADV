<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\lmscontroller;
use App\Http\Controllers\bookcontroller;
use App\Http\Controllers\borrowcontroller;
use App\Http\Controllers\borrowercontroller;
use App\Http\Controllers\notreturnedbookscontroller;
use App\Http\Controllers\transactionhistorycontroller;
use App\Http\Controllers\adminacccontroller;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Index Displays

Route::get('/', [lmscontroller::class, 'login'])->name('login'); // login
Route::get('/signup', [lmscontroller::class, 'signup'])->name('signup'); // signup
Route::get('/dashboard', [lmscontroller::class, 'dashboard'])->name('dashboard'); // dashboard
Route::get('/books', [lmscontroller::class, 'books'])->name('books'); // books
Route::get('/borrower', [lmscontroller::class, 'borrower'])->name('borrower'); // borrower
Route::get('/notreturnedbooks', [lmscontroller::class, 'notreturnedbooks'])->name('notreturnedbooks'); // notreturnedbooks
Route::get('/borrow', [lmscontroller::class, 'borrow'])->name('borrow'); // borrow
Route::get('/transactionhistory', [lmscontroller::class, 'transactionhistory'])->name('transactionhistory'); // transactionhistory

// Admin Acc Login-Logout-Signup
Route::get('/loginvalidation', [lmscontroller::class, 'loginvalidation'])->name('loginvalidation'); // loginvalidation
Route::get('/signupvalidation', [lmscontroller::class, 'signupvalidation'])->name('signupvalidation'); // signupvalidation
Route::get('/logout', [lmscontroller::class, 'logout'])->name('logout'); // logout

// Books CRUD
Route::get('/book/create', [bookcontroller::class, 'createdisplay'])->name('bookcreate'); // bookcreate
Route::post('/book/edit/{Book_id}', [bookcontroller::class, 'editdisplay'])->name('bookedit'); // bookedit
Route::post('/bookdelete/{Book_id}', [bookcontroller::class, 'delete'])->name('bookdelete'); // bookdelete
Route::post('/bookcreateprocess', [bookcontroller::class, 'create'])->name('bookcreateprocess'); // bookcreateprocess
Route::post('/bookeditprocess', [bookcontroller::class, 'edit'])->name('bookeditprocess'); // bookeditprocess
Route::post('/searchbook', [bookcontroller::class, 'searchbook'])->name('searchbook'); // searchbook
Route::post('/searcharchivebook', [bookcontroller::class, 'searcharchivebook'])->name('searcharchivebook'); // searcharchivebook

// Borrower CRUD
Route::get('/borrower/create', [borrowercontroller::class, 'createdisplay'])->name('borrowercreate'); // borrowercreate
Route::post('/borrower/edit/{Borrower_id}', [borrowercontroller::class, 'editdisplay'])->name('borroweredit'); // borroweredit
Route::post('/borrower/{Borrower_id}', [borrowercontroller::class, 'delete'])->name('borrowerdelete'); // borrowerdelete
Route::post('/borrowernotactive/{Borrower_id}', [borrowercontroller::class, 'borrowernotactive'])->name('borrowernotactive'); // borrowernotactive
Route::post('/borrowercreateprocess', [borrowercontroller::class, 'create'])->name('borrowercreateprocess'); // borrowercreateprocess
Route::post('/borrowereditprocess', [borrowercontroller::class, 'edit'])->name('borrowereditprocess'); // borrowereditprocess
Route::post('/searchborroweractive', [borrowercontroller::class, 'searchborroweractive'])->name('searchborroweractive'); // searchborroweractive
Route::post('/searchborrowernotactive', [borrowercontroller::class, 'searchborrowernotactive'])->name('searchborrowernotactive'); // searchborrowernotactive

// ISSUE CRUD
Route::post('/borrow/issue/', [borrowcontroller::class, 'issue'])->name('issue'); // issue
Route::post('/borrow/{Transac_id}', [borrowcontroller::class, 'returned'])->name('returned'); // returned
Route::get('/borrowissueprocess', [borrowcontroller::class, 'issuedisplay'])->name('issuedisplay'); // issuedisplay
Route::post('/searchissue', [borrowcontroller::class, 'searchissue'])->name('searchissue'); // searchissue

// NOT RETURNED DELETE AND SEARCH
Route::post('/notreturnedbook/{Transac_id}', [notreturnedbookscontroller::class, 'notreturnedbook'])->name('notreturnedbook'); // returned
Route::post('/searchnotreturned', [notreturnedbookscontroller::class, 'searchnotreturned'])->name('searchnotreturned'); // searchnotreturned

// TRANSACTION SEARCH
Route::post('/searchhistory', [transactionhistorycontroller::class, 'searchhistory'])->name('searchhistory'); // searchhistory

//ADMIN ACC CHANGE PASSWORD
Route::post('/changepassadmin', [adminacccontroller::class, 'changepassadmin'])->name('changepassadmin'); // changepassadmin
Route::get('/displaychangepass', [adminacccontroller::class, 'displaychangepass'])->name('displaychangepass'); // displaychangepass



