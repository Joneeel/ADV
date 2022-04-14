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
Route::any('/', [lmscontroller::class, 'login'])->name('login'); // login
Route::any('/signup', [lmscontroller::class, 'signup'])->name('signup'); // signup
Route::any('/dashboard', [lmscontroller::class, 'dashboard'])->name('dashboard'); // dashboard
Route::any('/books', [lmscontroller::class, 'books'])->name('books'); // books
Route::any('/borrower', [lmscontroller::class, 'borrower'])->name('borrower'); // borrower
Route::any('/notreturnedbooks', [lmscontroller::class, 'notreturnedbooks'])->name('notreturnedbooks'); // notreturnedbooks
Route::any('/borrow', [lmscontroller::class, 'borrow'])->name('borrow'); // borrow
Route::any('/transactionhistory', [lmscontroller::class, 'transactionhistory'])->name('transactionhistory'); // transactionhistory

// Admin Acc Login-Logout-Signup
Route::any('/loginvalidation', [lmscontroller::class, 'loginvalidation'])->name('loginvalidation'); // loginvalidation
Route::any('/signupvalidation', [lmscontroller::class, 'signupvalidation'])->name('signupvalidation'); // signupvalidation
Route::any('/logout', [lmscontroller::class, 'logout'])->name('logout'); // logout

// Books CRUD
Route::any('/book/create', [bookcontroller::class, 'createdisplay'])->name('bookcreate'); // bookcreate
Route::any('/book/edit/{Book_id}', [bookcontroller::class, 'editdisplay'])->name('bookedit'); // bookedit
Route::any('/book/view/{Book_id}', [bookcontroller::class, 'bookview'])->name('bookview'); // bookview
Route::any('/bookdelete/{Book_id}', [bookcontroller::class, 'delete'])->name('bookdelete'); // bookdelete
Route::any('/bookcreateprocess', [bookcontroller::class, 'create'])->name('bookcreateprocess'); // bookcreateprocess
Route::any('/bookeditprocess', [bookcontroller::class, 'edit'])->name('bookeditprocess'); // bookeditprocess
Route::any('/searchbook', [bookcontroller::class, 'searchbook'])->name('searchbook'); // searchbook
Route::any('/searchbookcategory', [bookcontroller::class, 'searchbookcategory'])->name('searchbookcategory'); // searchbookcategory
Route::any('/searcharchivebook', [bookcontroller::class, 'searcharchivebook'])->name('searcharchivebook'); // searcharchivebook

// Books Sorter
Route::any('/sortidbook', [bookcontroller::class, 'bookidsort'])->name('bookidsort'); // bookidsort
Route::any('/sorttitlebook', [bookcontroller::class, 'titlesort'])->name('titlesort'); // titlesort
Route::any('/sortauthorbook', [bookcontroller::class, 'authorsort'])->name('authorsort'); // authorsort
Route::any('/sortcopyrightbook', [bookcontroller::class, 'copyrightsort'])->name('copyrightsort'); // copyrightsort
Route::any('/sorttypebook', [bookcontroller::class, 'typesort'])->name('typesort'); // typesort
Route::any('/sortcategorybook', [bookcontroller::class, 'categorysort'])->name('categorysort'); // categorysort
Route::any('/sortnopagebook', [bookcontroller::class, 'nopagesort'])->name('nopagesort'); // nopagesort
Route::any('/sortnostockbook', [bookcontroller::class, 'nostocksort'])->name('nostocksort'); // nostocksort

// Borrower CRUD
Route::any('/borrower/create', [borrowercontroller::class, 'createdisplay'])->name('borrowercreate'); // borrowercreate
Route::any('/borrower/edit/{Borrower_id}', [borrowercontroller::class, 'editdisplay'])->name('borroweredit'); // borroweredit
Route::any('/borrower/{Borrower_id}', [borrowercontroller::class, 'delete'])->name('borrowerdelete'); // borrowerdelete
Route::any('/borrowernotactive/{Borrower_id}', [borrowercontroller::class, 'borrowernotactive'])->name('borrowernotactive'); // borrowernotactive
Route::any('/borrowercreateprocess', [borrowercontroller::class, 'create'])->name('borrowercreateprocess'); // borrowercreateprocess
Route::any('/borrowereditprocess', [borrowercontroller::class, 'edit'])->name('borrowereditprocess'); // borrowereditprocess
Route::any('/searchborroweractive', [borrowercontroller::class, 'searchborroweractive'])->name('searchborroweractive'); // searchborroweractive
Route::any('/searchborrowernotactive', [borrowercontroller::class, 'searchborrowernotactive'])->name('searchborrowernotactive'); // searchborrowernotactive

// Borrower Sorter
Route::any('/borroweridsort', [borrowercontroller::class, 'borroweridsort'])->name('borroweridsort'); // borroweridsort
Route::any('/borrowerfullnamesort', [borrowercontroller::class, 'fullnamesort'])->name('fullnamesort'); // fullnamesort
Route::any('/borrowergendersort', [borrowercontroller::class, 'gendersort'])->name('gendersort'); // gendersort
Route::any('/borrowerStatussort', [borrowercontroller::class, 'statussort'])->name('statussort'); // statussort
Route::any('/borrowerAddressSort', [borrowercontroller::class, 'addresssort'])->name('addresssort'); // addresssort
Route::any('/borrowerDueBooksSort', [borrowercontroller::class, 'viocountsort'])->name('viocountsort'); // viocountsort
Route::any('/borrowerCreateSort', [borrowercontroller::class, 'createdatsort'])->name('createdatsort'); // createdatsort
Route::any('/borrowerUpdateSort', [borrowercontroller::class, 'updatesort'])->name('updatesort'); // updatesort

// ISSUE CRUD
Route::any('/borrow/issue/', [borrowcontroller::class, 'issue'])->name('issue'); // issue
Route::any('/borrow/{Transac_id}', [borrowcontroller::class, 'returned'])->name('returned'); // returned
Route::any('/borrowissueprocess', [borrowcontroller::class, 'issuedisplay'])->name('issuedisplay'); // issuedisplay
Route::any('/searchissue', [borrowcontroller::class, 'searchissue'])->name('searchissue'); // searchissue

// NOT RETURNED DELETE AND SEARCH
Route::any('/notreturnedbook/{Transac_id}', [notreturnedbookscontroller::class, 'notreturnedbook'])->name('notreturnedbook'); // returned
Route::any('/searchnotreturned', [notreturnedbookscontroller::class, 'searchnotreturned'])->name('searchnotreturned'); // searchnotreturned

// TRANSACTION SEARCH
Route::any('/searchhistory', [transactionhistorycontroller::class, 'searchhistory'])->name('searchhistory'); // searchhistory

//ADMIN ACC CHANGE PASSWORD
Route::any('/changepassadmin', [adminacccontroller::class, 'changepassadmin'])->name('changepassadmin'); // changepassadmin
Route::any('/displaychangepass', [adminacccontroller::class, 'displaychangepass'])->name('displaychangepass'); // displaychangepass



