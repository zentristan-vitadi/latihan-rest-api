<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::query()
            ->select(['id', 'title', 'author', 'published_year'])
            ->orderBy('id')
            ->get();

        return response()->json(['data' => $books]);
    }

    public function store(Request $request)
    {
        // TODO: Validasi title, author, dan published_year sesuai kontrak latihan.
        // TODO: Simpan data yang lolos validasi dengan model Book.
        // TODO: Kembalikan JSON data buku baru dengan status HTTP 201.
        $request->validate([
            'title' => 'required|string|max:150',
            'author' => 'required|string|max:100',
            'published_year' => 'required|integer|min:1900|max:2026',
        ]);

        $books = Book::create($request->all());
        return response()->json([
            'message' => 'Buku created successfully!',
            'data' => $books,
        ], 201);
        // return response()->json([
        //     'message' => 'Fitur tambah buku belum diimplementasikan. Lengkapi TODO pada BookController.',
        // ], 501);
    }
}
