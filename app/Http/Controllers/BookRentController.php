<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    public function index()
    {
        $booklist = Book::all();
        $userlist = User::where('role_id', 2)->get();
        return view('book-rent', [
            'booklist' => $booklist,
            'userlist' => $userlist
        ]);
    }

    public function store(Request $request)
    {
        $request['rent_date'] = Carbon::now()->toDateString();
        // mengambil tanggal hari ini
        $request['return_date'] = Carbon::now()->addDay(3)->toDateString();
        // mengambil tanggal 3 hari kedepan

        // cek status buku
        $checkbook = Book::findOrFail($request->book_id)->only('status');

        // verifikasi status dari buku
        if ($checkbook['status'] != 'in stock') {
            Session::flash('status', 'danger');
            Session::flash('message', 'Buku sedang tidak tersedia');
            return redirect('/book-rent');
        } else {
            try {
                $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)->count();

                if ($count >= 3) {
                    Session::flash('status', 'danger');
                    Session::flash('message', 'Sudah mencapat batas peminjaman!');
                    return redirect('/book-rent');
                } else {
                    DB::beginTransaction();
                    // process insert to rent table
                    RentLogs::create($request->all());
                    // process update book table
                    $book = Book::findOrFail($request->book_id);
                    $book->status = 'not stock';
                    $book->save();
                    DB::commit();

                    Session::flash('status', 'success');
                    Session::flash('message', 'Buku berhasil dipinjam');
                    return redirect('/book-rent');
                }

            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }
    }
}
