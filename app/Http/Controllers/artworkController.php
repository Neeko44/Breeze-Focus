<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artwork;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{
    public function index()
    {
        $artworks = Artwork::orderBy('ID_ARTWORK', 'asc')->paginate(12);
        return view('artwork.index', compact('artworks'));
    }

    public function create(Request $request): RedirectResponse
    {
        // Validasi input sebelum menyimpan ke database
        $validatedData = $request->validate([
            'JUDUL_ARTWORK' => 'required|string|max:255',
            'IMAGE_ARTWORK' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'ARTIST_ARTWORK' => 'required|string|max:255',
            'DESKRIPSI_ARTWORK' => 'required|string',
            'DATE_ARTWORK' => 'required|date',
            'CATEGORY_ARTWORK' => 'required|string|max:255',
        ]);

        // Simpan gambar ke storage
        if ($request->hasFile('IMAGE_ARTWORK')) {
            $file = $request->file('IMAGE_ARTWORK');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/artworks', $filename,'public'); // Simpan di storage/app/public/
            $imagePath = 'storage/uploads/artworks/' . $filename; // Simpan path yang bisa diakses
        } else {
            $imagePath = null;
        }

        // Tambahkan path gambar ke data yang sudah divalidasi
        $validatedData['IMAGE_ARTWORK'] = $imagePath;

        // Simpan data ke database
        $artwork = Artwork::create($validatedData);

        // Debugging: Cek apakah data tersimpan
        if (!$artwork) {
            return back()->with('error', 'Data gagal disimpan.');
        }

        return redirect()->route('artwork.index')->with('success', 'Data berhasil disimpan.');
    }



    public function edit($id)
    {
        $artwork = Artwork::findOrFail($id);
        return view('artwork.edit', compact('artwork'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'JUDUL_ARTWORK' => 'required|string|max:255',
            'IMAGE_ARTWORK' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'ARTIST_ARWORK' => 'required|string|max:255',
            'DESKRIPSI_ARTWORK' => 'required|string',
            'DATE_ARTWORK' => 'required|date',
            'CATEGORY_ARTWORK' => 'required|string|max:255',
        ]);

        $artwork = Artwork::findOrFail($id);

        // Periksa apakah ada gambar baru yang diupload
        if ($request->hasFile('IMAGE_ARTWORK')) {
            // Hapus gambar lama jika ada
            if ($artwork->image) {
                Storage::delete('public/images/' . $artwork->image);
            }

            // Simpan gambar baru
            $image = $request->file('IMAGE_ARTWORK');
            $imagePath = $image->store('public/images');

            // Update data dengan gambar baru
            $artwork->update([
                'IMAGE_ARTWORK' => $imagePath,
                'JUDUL_ARTWORK' => $request->JUDUL_ARTWORK,
                'CATEGORY_ARTWORK' => $request->CATEGORY_ARTWORK,
                'DESKRIPSI_ARTWORK' => $request->DESKRIPSI_ARTWORK,
                'ARTIST_ARTWORK' => $request->ARTIST_ARTWORK,
                'DATE_ARTWORK' => $request->DATE_ARTWORK,
            ]);
        } else {
            // Update tanpa mengganti gambar
            $artwork->update([
                'JUDUL_ARTWORK' => $request->JUDUL_ARTWORK,
                'CATEGORY_ARTWORK' => $request->CATEGORY_ARTWORK,
                'DESKRIPSI_ARTWORK' => $request->DESKRIPSI_ARTWORK,
                'ARTIST_ARTWORK' => $request->ARTIST_ARTWORK,
                'DATE_ARTWORK' => $request->DATE_ARTWORK,
            ]);
        }

        return redirect()->route('artwork.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Cari user berdasarkan ID
        $user = Artwork::findOrFail($id);

        // Hapus user
        $user->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('artwork.index')->with('success', 'User berhasil dihapus.');
    }
}
