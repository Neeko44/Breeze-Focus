<style>
    /* Styling khusus untuk form */
section {
    background-color: #f8f9fa; /* Warna background lembut */
    padding: 40px 0;
}

.card {
    border: none;
    border-radius: 12px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Efek shadow */
}

.card-header {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    text-align: center;
    padding: 15px;
}

.card-body {
    padding: 30px;
}

.form-control {
    border-radius: 8px;
    border: 1px solid #ced4da;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0px 0px 8px rgba(0, 123, 255, 0.3);
}

.invalid-feedback {
    font-size: 14px;
    font-weight: 500;
}

textarea {
    resize: none;
}

.btn-primary {
    background-color: #007bff;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-secondary {
    background-color: #6c757d;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background-color: #545b62;
}

</style>

<section>
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="mb-0">Tambah Artwork</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('artwork.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="JUDUL_ARTWORK" class="form-label">Judul Artwork</label>
                        <input type="text" class="form-control @error('JUDUL_ARTWORK') is-invalid @enderror"
                            name="JUDUL_ARTWORK" value="{{ old('JUDUL_ARTWORK') }}" required>
                        @error('JUDUL_ARTWORK')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="IMAGE_ARTWORK" class="form-label">Gambar Artwork</label>
                        <input type="file" class="form-control @error('IMAGE_ARTWORK') is-invalid @enderror"
                            name="IMAGE_ARTWORK" accept="image/*" required>
                        @error('IMAGE_ARTWORK')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="ARTIST_ARTWORK" class="form-label">Nama Artist</label>
                        <input type="text" class="form-control @error('ARTIST_ARTWORK') is-invalid @enderror"
                            name="ARTIST_ARTWORK" value="{{ old('ARTIST_ARTWORK') }}" required>
                        @error('ARTIST_ARTWORK')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="DESKRIPSI_ARTWORK" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('DESKRIPSI_ARTWORK') is-invalid @enderror"
                            name="DESKRIPSI_ARTWORK" rows="4" required>{{ old('DESKRIPSI_ARTWORK') }}</textarea>
                        @error('DESKRIPSI_ARTWORK')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="DATE_ARTWORK" class="form-label">Tanggal Dibuat</label>
                        <input type="date" class="form-control @error('DATE_ARTWORK') is-invalid @enderror"
                            name="DATE_ARTWORK" value="{{ old('DATE_ARTWORK') }}" required>
                        @error('DATE_ARTWORK')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="CATEGORY_ARTWORK" class="form-label">Kategori</label>
                        <input type="text" class="form-control @error('CATEGORY_ARTWORK') is-invalid @enderror"
                            name="CATEGORY_ARTWORK" value="{{ old('CATEGORY_ARTWORK') }}" required>
                        @error('CATEGORY_ARTWORK')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Artwork</button>
                    <a href="{{ route('artwork.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</section>
