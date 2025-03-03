<x-app-layout>
    <div class="container">
        <h1 class="text-center text-white my-64">List barang di Storage</h1>
        <p class="text-center fw-light text-white">Barang-barang yang saat ini tersedia di storage.</p>

        <div class="row">
            @forelse ($artworks as $art)
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm rounded">
                        <img src="{{ asset('/uploads/artworks' . $art->image) }}" class="card-img-top"
                            style="width:100%; height:350px; object-fit:cover;" alt="{{ $art->nama }}">
                        <div class="card-body text-center">
                            <p class="card-text">ID. {{ $art->ID_ARTWORK }}</p>
                            <h5 class="card-title fw-bold">{{ $art->JUDUL_ARTWORK }}</h5>
                            <p class="card-text">{{ $art->DESKRIPSI_ARTWORK }}</p>
                            {{-- <p class="card-text">
                                <strong>Rp. {{ $art->harga }}</strong>
                            </p> --}}
                            <p class="card-text text-muted">Kategori: {{ $art->CATEGORY_ARTWORK }}</p>
                            {{--  <p class="card-text text-muted">{{ $art->stok }} in stock</p>
                            <p class="card-text text-muted">{{ $art->tgl_masuk }} (Masuk)</p>
                            <p class="card-text text-muted">{{ $art->tgl_beli }} (Pembelian)</p>--}}
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('artwork.show', $art->ID_ARTWORK) }}"
                                    class="btn btn-sm btn-outline-dark fw-bold mx-1 mt-2">Details</a>
                                <a href="{{ route('artwork.edit', $art->ID_ARTWORK) }}"
                                    class="btn btn-sm btn-outline-dark fw-bold mx-1 mt-2">Edit</a>
                                <form onsubmit="return confirm('Are you sure?');"
                                    action="{{ route('artwork.destroy', $art->ID_ARTWORK) }}" method="DELETE" class="ml-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-sm btn-outline-dark fw-bold mx-1 mt-2">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-white text-center">
                    Inventaris kosong.
                </div>
                <!-- Link ke halaman ubah role -->
                <a href="{{ route('artwork.create') }}"
                   class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">
                    Upload artworks
                </a>
            @endforelse
        </div>
        {{ $artworks->links() }}
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

    <script>
        toastr.options = {
            "positionClass": "toast-style",
        };

        @if(session()->has('success'))
            toastr.success('{{ session('success') }}', 'Sukses!');
        @elseif(session()->has('error'))
            toastr.error('{{ session('error') }}', 'Gagal!');
        @endif
    </script>
</x-app-layout>
