<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\artwork;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class artworkController extends Controller
{
    //-----------------------------------------------------------------------------------------------------------//

    public function index()
    {
        $artwork = artwork::orderBy('id', 'asc')->paginate(12);
        return view('artwork.index', compact('artwork'));
    }

    //-----------------------------------------------------------------------------------------------------------//

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'judul_artwork' => 'required|string|max:255',
            'gambar_artwork' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'artist_artwork' => 'required|string',
            'deskripsi_artwork' => 'required|string',
            'date_artwork' => 'required|date',
            'category_artwork' => 'required|string',
        ]);

        $image = $request->file('image');
        $imagePath = $image->storeAs('public/artwork', $image->hashName());

        if ($imagePath) {
            artwork::create([
                'image' => $image->hashName(),
                'nama' => $request->input('nama'),
                'kategori' => $request->input('kategori'),
                'harga' => $request->input('harga'),
                'deskripsi' => $request->input('deskripsi'),
                'lokasi' => $request->input('lokasi'),
                'stok' => $request->input('stok'),
                'tgl_beli' => $request->input('tgl_beli'),
                'tgl_masuk' => $request->input('tgl_masuk'),
            ]);

            return redirect()->route('artwork.index')->with(['success' => 'Data sukses disimpan.']);
        } else {
            return redirect()->back()->with(['error' => 'Image upload failed.']);
        }
    }

    //-----------------------------------------------------------------------------------------------------------//

    public function edit(string $id)
    {
        $artwork = artwork::findOrFail($id);
        return view('artwork.edit', compact('artwork'));
    }

    //-----------------------------------------------------------------------------------------------------------//

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'judul_artwork' => 'required|string|max:255',
            'gambar_artwork' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'artist_artwork' => 'required|string',
            'deskripsi_artwork' => 'required|string',
            'date_artwork' => 'required|date',
            'category_artwork' => 'required|string',
        ]);

        $artwork = artwork::findOrFail($id);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $image->storeAs('public/artwork', $image->hashName());

            Storage::delete('public/artwork/' . $artwork->image);

            $artwork->update([
                'image' => $image->hashName(),
                'nama' => $request->input('nama'),
                'kategori' => $request->input('kategori'),
                'harga' => $request->input('harga'),
                'deskripsi' => $request->input('deskripsi'),
                'lokasi' => $request->input('lokasi'),
                'stok' => $request->input('stok'),
                'tgl_beli' => $request->input('tgl_beli'),
                'tgl_masuk' => $request->input('tgl_masuk'),
            ]);

        } else {
            $artwork->update([
                'nama' => $request->input('nama'),
                'kategori' => $request->input('kategori'),
                'harga' => $request->input('harga'),
                'deskripsi' => $request->input('deskripsi'),
                'lokasi' => $request->input('lokasi'),
                'stok' => $request->input('stok'),
                'tgl_beli' => $request->input('tgl_beli'),
                'tgl_masuk' => $request->input('tgl_masuk'),
            ]);
        }

        return redirect()->route('artwork.index')->with(['success' => 'Data sukses diubah.']);
    }

}
