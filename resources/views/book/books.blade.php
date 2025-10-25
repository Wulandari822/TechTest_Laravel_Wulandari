@extends('layouts.main')

@section('title', 'Books')

@section('content')
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">My Book</h1>
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-3 flex-wrap">
                        <form method="GET" action="{{ route('books') }}" class="input-group"
                            style="flex: 1; min-width: 200px;">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search by title or author" value="{{ request('search') }}">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fa-solid fa-search"></i>
                            </button>
                        </form>

                        <form method="GET" action="{{ route('books') }}" class="ms-2" style="min-width: 150px;">
                            <select class="form-select" name="kategori_id" onchange="this.form.submit()">
                                <option value="" {{ request('kategori_id') == null ? 'selected' : '' }}>All</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->kategori_id }}"
                                        {{ request('kategori_id') == $category->kategori_id ? 'selected' : '' }}>
                                        {{ $category->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </form>

                        @auth
                            @if (auth()->user()->role === 'admin')
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addBookModal">
                                    <i class="fa-solid fa-upload me-1"></i> Upload
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>

            <div class="row g-3">
                @foreach ($books as $book)
                    <div class="col-6 col-md-4 col-xl-3 col-xxl-2">
                        <div class="app-card app-card-doc shadow-sm h-100">
                            @php
                                $coverPath = $book->cover
                                    ? asset('storage/' . $book->cover)
                                    : asset('assets/img/no-cover.png');
                            @endphp
                            <div class="app-card-thumb-holder p-3">
                                @if ($book->cover)
                                    <div class="app-card-thumb-holder p-3">
                                        <div class="app-card-thumb">
                                            <img class="thumb-image"
                                                src="{{ $book->cover ? asset('storage/' . $book->cover) : asset('assets/img/no-cover.png') }}"
                                                alt="{{ $book->judul }}" data-bs-toggle="modal"
                                                data-bs-target="#bookDetailModal" data-judul="{{ $book->judul }}"
                                                data-stok="{{ $book->stok }}"
                                                data-author="{{ $book->author->nama ?? '-' }}"
                                                data-category="{{ $book->category->nama ?? '-' }}"
                                                data-harga-jual="{{ number_format($book->harga_jual, 0, ',', '.') }}"
                                                data-harga-sewa="{{ number_format($book->harga_sewa, 0, ',', '.') }}"
                                                data-deskripsi="{{ $book->deskripsi ?? '-' }}"
                                                data-cover="{{ $book->cover ? asset('storage/' . $book->cover) : asset('assets/img/no-cover.png') }}">
                                        </div>
                                    </div>
                                @else
                                    <span class="icon-holder" data-bs-toggle="modal" data-bs-target="#bookDetailModal"
                                        data-judul="{{ $book->judul }}" data-stok="{{ $book->stok }}"
                                        data-author="{{ $book->author->nama ?? '-' }}"
                                        data-category="{{ $book->category->nama ?? '-' }}"
                                        data-harga-jual="{{ number_format($book->harga_jual, 0, ',', '.') }}"
                                        data-harga-sewa="{{ number_format($book->harga_sewa, 0, ',', '.') }}"
                                        data-deskripsi="{{ $book->deskripsi ?? '-' }}"
                                        data-cover="{{ asset('assets/img/no-cover.png') }}" <!-- default cover -->
                                        >
                                        <i class="fas fa-file-alt text-file"></i>
                                    </span>
                                @endif
                            </div>

                            <div class="app-card-body p-3 has-card-actions">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h4 class="app-doc-title truncate mb-0">
                                        <a href="#">{{ $book->judul }}</a>
                                    </h4>
                                    @if ($book->stok <= 0)
                                        <span class="badge bg-danger">Stok Habis</span>
                                    @endif
                                    @auth
                                        @if (auth()->user()->role === 'admin')
                                            <div class="dropdown">
                                                <a href="#" class="text-muted" id="bookActionDropdown"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="bookActionDropdown">
                                                    <li>
                                                        <a class="dropdown-item editBookBtn" href="#"
                                                            data-id="{{ $book->buku_id }}" data-judul="{{ $book->judul }}"
                                                            data-deskripsi="{{ $book->deskripsi }}"
                                                            data-stok="{{ $book->stok }}"
                                                            data-harga-jual="{{ $book->harga_jual }}"
                                                            data-harga-sewa="{{ $book->harga_sewa }}"
                                                            data-author="{{ $book->author->nama ?? '-' }}"
                                                            data-category="{{ $book->category->nama ?? '-' }}"
                                                            data-cover="{{ $book->cover ? asset('storage/' . $book->cover) : asset('assets/img/no-cover.png') }}"
                                                            data-route="{{ route('book.update', $book->buku_id) }}">

                                                            <i class="fas fa-pen me-2"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('book.destroy', $book->buku_id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Apakah yakin ingin menghapus buku ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item text-danger" type="submit">
                                                                <i class="fas fa-trash me-2"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>

                                            </div>
                                        @endif
                                    @endauth
                                </div>


                                <div class="app-doc-meta d-flex align-items-start justify-content-between">
                                    <ul class="list-unstyled mb-0">
                                        <li><span class="text-muted">Stok:</span> {{ $book->stok }}</li>
                                        <li><span class="text-muted">Author:</span> {{ $book->author->nama ?? '-' }}</li>
                                        <li><span class="text-muted">Category:</span> {{ $book->category->nama ?? '-' }}
                                        </li>

                                    </ul>

                                    <ul class="list-unstyled mb-2 mt-2">
                                        <li><span class="text-muted">Harga Jual:</span> Rp
                                            {{ number_format($book->harga_jual, 0, ',', '.') }}</li>
                                        <li><span class="text-muted">Harga Sewa:</span> Rp
                                            {{ number_format($book->harga_sewa, 0, ',', '.') }}</li>
                                    </ul>



                                </div>
                                @auth
                                    @if (auth()->user()->role === 'user')
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#transactionModal" data-buku-id="{{ $book->buku_id }}"
                                                data-judul="{{ $book->judul }}" data-harga-jual="{{ $book->harga_jual }}"
                                                data-harga-sewa="{{ $book->harga_sewa }}"
                                                {{ $book->stok <= 0 ? 'disabled' : '' }}>
                                                Belanja
                                            </button>
                                        </div>
                                    @endif
                                @endauth

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-3">
                {{ $books->links('pagination::bootstrap-5') }}
            </div>


            <nav class="app-pagination">
                <ul class="pagination justify-content-center">
                    <li class="page-item {{ $books->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $books->previousPageUrl() }}" tabindex="-1">Previous</a>
                    </li>

                    @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                        <li class="page-item {{ $books->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    <li class="page-item {{ $books->currentPage() == $books->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $books->nextPageUrl() }}">Next</a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>
    </div>

    <div class="modal fade" id="addBookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Author</label>
                            <select name="author_id" class="form-control" required>
                                <option value="" disabled selected>-- Pilih Author --</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->author_id }}">{{ $author->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Kategori</label>
                            <select name="kategori_id" class="form-control" required>
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->kategori_id }}">{{ $category->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Harga Jual</label>
                            <input type="number" name="harga_jual" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Harga Sewa</label>
                            <input type="number" name="harga_sewa" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Cover Buku</label>
                            <input type="file" name="cover" class="form-control" accept="image/*">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bookDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-3">

                <div class="modal-header border-0">
                    <h5 class="modal-title" id="modalBookTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="card mb-3 shadow-sm border-0">
                        <div class="row g-0">
                            <div class="col-md-4 text-center p-3">
                                <img id="modalBookCover" src="" class="img-fluid rounded" alt=""
                                    style="max-height: 300px; object-fit: cover;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <ul class="list-unstyled mb-2">
                                        <li><strong>Stok:</strong> <span id="modalBookStok"></span></li>
                                        <li><strong>Author:</strong> <span id="modalBookAuthor"></span></li>
                                        <li><strong>Category:</strong> <span id="modalBookCategory"></span></li>
                                        <li><strong>Harga Jual:</strong> Rp <span id="modalBookHargaJual"></span></li>
                                        <li><strong>Harga Sewa:</strong> Rp <span id="modalBookHargaSewa"></span></li>
                                    </ul>
                                    <p><strong>Deskripsi:</strong></p>
                                    <p id="modalBookDeskripsi" class="text-muted"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editBookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editBookForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul" id="editJudul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" id="editDeskripsi" class="form-control" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Stok</label>
                            <input type="number" name="stok" id="editStok" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Author</label>
                            <input type="text" id="editAuthor" class="form-control" disabled>
                        </div>

                        <div class="mb-3">
                            <label>Kategori</label>
                            <input type="text" id="editKategori" class="form-control" disabled>
                        </div>

                        <div class="mb-3">
                            <label>Harga Jual</label>
                            <input type="number" name="harga_jual" id="editHargaJual" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Harga Sewa</label>
                            <input type="number" name="harga_sewa" id="editHargaSewa" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Cover Buku (optional)</label>
                            <input type="file" name="cover" class="form-control" accept="image/*">
                            <img id="editCoverPreview" src="" class="img-fluid mt-2" style="max-height: 150px;">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="transactionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('transactions.store') }}" method="POST" id="transactionForm">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">
                <input type="hidden" name="buku_id" id="modalBukuId">
                <input type="hidden" name="total_harga" id="modalTotalHargaRaw">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Transaksi Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Nama Akun: {{ auth()->user()->name }}</p>

                        <p>Buku: <span id="modalJudul"></span></p>

                        <div class="mb-3">
                            <label for="modalTipe">Tipe:</label>
                            <select name="tipe" id="modalTipe" class="form-select" required>
                                <option value="sell">Beli</option>
                                <option value="rent">Sewa</option>
                            </select>
                        </div>

                        <div class="mb-3" id="rentalFields" style="display: none;">
                            <label>Tanggal Mulai:</label>
                            <input type="date" name="tanggal_mulai" class="form-control">
                            <label>Tanggal Akhir:</label>
                            <input type="date" name="tanggal_akhir" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Jumlah:</label>
                            <input type="number" name="jumlah" value="1" min="1" class="form-control"
                                id="modalJumlah">
                        </div>

                        <div class="mb-3">
                            <label>Total Harga:</label>
                            <input type="text" id="modalTotalHarga" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Bayar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="ratingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('ratings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="buku_id" id="ratingBukuId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Berikan Rating untuk Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Rating (1-5):</label>
                            <select name="rating" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="1">1 ⭐</option>
                                <option value="2">2 ⭐⭐</option>
                                <option value="3">3 ⭐⭐⭐</option>
                                <option value="4">4 ⭐⭐⭐⭐</option>
                                <option value="5">5 ⭐⭐⭐⭐⭐</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Komentar (optional):</label>
                            <textarea name="komentar" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit Rating</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    @if (session('rating_id'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ratingModal = new bootstrap.Modal(document.getElementById('ratingModal'));
                document.getElementById('ratingBukuId').value = "{{ session('rating_id') }}";
                ratingModal.show();
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookModal = document.getElementById('bookDetailModal');

            bookModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const judul = button.getAttribute('data-judul');
                const stok = button.getAttribute('data-stok');
                const author = button.getAttribute('data-author');
                const category = button.getAttribute('data-category');
                const hargaJual = button.getAttribute('data-harga-jual');
                const hargaSewa = button.getAttribute('data-harga-sewa');
                const deskripsi = button.getAttribute('data-deskripsi');
                const cover = button.getAttribute('data-cover');

                bookModal.querySelector('#modalBookTitle').textContent = judul;
                bookModal.querySelector('#modalBookStok').textContent = stok;
                bookModal.querySelector('#modalBookAuthor').textContent = author;
                bookModal.querySelector('#modalBookCategory').textContent = category;
                bookModal.querySelector('#modalBookHargaJual').textContent = hargaJual;
                bookModal.querySelector('#modalBookHargaSewa').textContent = hargaSewa;
                bookModal.querySelector('#modalBookDeskripsi').textContent = deskripsi;
                bookModal.querySelector('#modalBookCover').setAttribute('src', cover);
                bookModal.querySelector('#modalBookCover').setAttribute('alt', judul);
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.editBookBtn');
            const editForm = document.getElementById('editBookForm');

            editButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const id = this.dataset.id;
                    const judul = this.dataset.judul;
                    const deskripsi = this.dataset.deskripsi;
                    const stok = this.dataset.stok;
                    const hargaJual = this.dataset.hargaJual;
                    const hargaSewa = this.dataset.hargaSewa;
                    const author = this.dataset.author;
                    const kategori = this.dataset.category;
                    const cover = this.dataset.cover;

                    editForm.action = this.dataset.route;

                    document.getElementById('editJudul').value = judul;
                    document.getElementById('editDeskripsi').value = deskripsi;
                    document.getElementById('editStok').value = stok;
                    document.getElementById('editHargaJual').value = hargaJual;
                    document.getElementById('editHargaSewa').value = hargaSewa;
                    document.getElementById('editAuthor').value = author; // read-only
                    document.getElementById('editKategori').value = kategori; // read-only
                    document.getElementById('editCoverPreview').src = cover.startsWith('http') ?
                        cover : '{{ asset('storage/') }}/' + cover;


                    const editModal = new bootstrap.Modal(document.getElementById('editBookModal'));
                    editModal.show();
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var transactionModal = document.getElementById('transactionModal');

            transactionModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;

                var bukuId = button.getAttribute('data-buku-id');
                var judul = button.getAttribute('data-judul');
                var hargaJual = parseFloat(button.getAttribute('data-harga-jual'));
                var hargaSewa = parseFloat(button.getAttribute('data-harga-sewa'));

                var modal = transactionModal;
                var jumlahInput = modal.querySelector('#modalJumlah');
                var totalHargaInputDisplay = modal.querySelector('#modalTotalHarga');
                var totalHargaInputRaw = modal.querySelector('#modalTotalHargaRaw');
                var tipeSelect = modal.querySelector('#modalTipe');
                var rentalFields = modal.querySelector('#rentalFields');
                var modalJudul = modal.querySelector('#modalJudul');

                modal.querySelector('#modalBukuId').value = bukuId;
                modalJudul.textContent = judul;
                jumlahInput.value = 1;

                function updateTotal() {
                    var jumlah = parseInt(jumlahInput.value) || 1;
                    var total = tipeSelect.value === 'sell' ? jumlah * hargaJual : jumlah * hargaSewa;
                    totalHargaInputDisplay.value = total.toLocaleString(); 
                    totalHargaInputRaw.value = total; 
                }

                function toggleRentalFields() {
                    if (tipeSelect.value === 'rent') {
                        rentalFields.style.display = 'block';
                        rentalFields.querySelector('input[name="tanggal_mulai"]').required = true;
                        rentalFields.querySelector('input[name="tanggal_akhir"]').required = true;
                    } else {
                        rentalFields.style.display = 'none';
                        rentalFields.querySelector('input[name="tanggal_mulai"]').required = false;
                        rentalFields.querySelector('input[name="tanggal_akhir"]').required = false;
                    }
                    updateTotal();
                }

                tipeSelect.addEventListener('change', toggleRentalFields);
                jumlahInput.addEventListener('input', updateTotal);

                toggleRentalFields();
            });
        });
    </script>


@endsection
