<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Kategori; // Pastikan menggunakan model yang benar
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Dompdf\Dompdf;
use Dompdf\Options;

class ItemController extends Controller
{
    // Method untuk menampilkan halaman utama dengan daftar items
    public function index()
    {
        $items = Item::all();
        return view('frontend.admin.admin', compact('items'));
    }
    public function item()
    {
        $items = Item::all();
        return view('frontend.admin.tampil_item', compact('items'));
    }

    // Method untuk menampilkan form tambah data
    public function create()
    {
        $categories = Kategori::all(); // Mengambil data dari model Kategori
        return view('frontend.admin.create', compact('categories'));
    }

    // Method untuk menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'sku' => 'required|string|max:255|unique:items,sku',
            'description' => 'required|string|max:255', // Menambah validasi untuk deskripsi
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $image = null;

        if ($request->hasFile('gambar')) {
            $image = time().'.'.$request->gambar->extension();
            $request->gambar->storeAs('public', $image);
        }

        Item::create([
            'name' => $request->nama,
            'id_kategori' => $request->id_kategori,
            'sku' => $request->sku,
            'description' => $request->description, // Menambahkan 'description'
            'gambar' => $image,
        ]);

        return redirect()->route('tampil_item')->with('success', 'Item berhasil ditambahkan');
    }


   // Method untuk menampilkan form edit data
   public function edit($id)
   {
       $item = Item::findOrFail($id);
       $categories = Kategori::all();
       return view('frontend.admin.edit', compact('item', 'categories'));
   }

   public function update(Request $request, $id)
{
    Log::info('Update method called with data: ', $request->all());

    $request->validate([
        'nama' => 'required|string|max:255',
        'id_kategori' => 'required|exists:kategori,id_kategori',
        'sku' => 'required|string|max:255|unique:items,sku,'.$id,
        'description' => 'nullable|string|max:255',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $item = Item::findOrFail($id);

    if ($request->hasFile('gambar')) {
        $image = time().'.'.$request->gambar->extension();
        $request->gambar->storeAs('public', $image);

        if ($item->gambar) {
            Storage::delete('public/'.$item->gambar);
        }

        $item->gambar = $image;
    }

    $item->name = $request->nama;
    $item->id_kategori = $request->id_kategori;
    $item->sku = $request->sku;
    $item->description = $request->description;

    $item->save();

    Log::info('Item updated successfully');

    return redirect()->route('admin.tampil_item')->with('success', 'Item berhasil diperbarui');
}

public function destroy($id)
{
    $item = Item::findOrFail($id); // Temukan item berdasarkan ID
    $item->delete(); // Hapus item dari database

    return redirect()->route('admin.tampil_item')->with('success', 'Item berhasil dihapus');
}


public function generatePDF()
{
    $items = Item::all();

    $pdf = new Dompdf();
    $pdf->loadHtml(view('frontend.admin.items', compact('items')));

    $pdf->setPaper('A4', 'landscape');

    $pdf->render();

    // if(auth()->check()) {
    // }
    return $pdf->stream('items.pdf');
}

}
