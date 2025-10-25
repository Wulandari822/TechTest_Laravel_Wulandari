@extends('layouts.main')

@section('title', 'Author')

@section('content')
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Author</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

                                <div class="col-auto">
                                    <form class="table-search-form row gx-1 align-items-center">
                                        <div class="col-auto">
                                            <input type="text" id="search-authors" class="form-control"
                                                placeholder="Search">
                                        </div>
                                    </form>
                                </div>

                                <div class="col-auto">
                                    <a class="btn app-btn-secondary" href="{{ route('author.export') }}">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                            <path fill-rule="evenodd"
                                                d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                        </svg>
                                        Download Excel
                                    </a>
                                </div>

                                <div class="col-auto">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAuthorModal">
                                        <i class="fa-solid fa-plus"></i> Add Author
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($authors as $index => $author)
                                        <tr>
                                            <td>{{ ($authors->currentPage() - 1) * $authors->perPage() + $index + 1 }}</td>
                                            <td><span class="truncate">{{ $author->nama }}</span></td>
                                            <td>
                                                <button class="btn-sm app-btn-secondary editAuthorBtn"
                                                    data-id="{{ $author->author_id }}" data-nama="{{ $author->nama }}"
                                                    data-bs-toggle="modal" data-bs-target="#editAuthorModal">
                                                    Edit
                                                </button>
                                                <form action="{{ route('author.destroy', $author->author_id) }}"
                                                    method="POST" style="display:inline-block;"
                                                    onsubmit="return confirm('Yakin ingin hapus author ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-sm app-btn-secondary">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No authors found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <nav class="app-pagination d-flex justify-content-center align-items-center mt-3 mb-3">
                                <ul class="pagination mb-0 me-3">

                                    <li class="page-item {{ $authors->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link"
                                            href="{{ $authors->onFirstPage() ? '#' : $authors->previousPageUrl() }}">
                                            Previous
                                        </a>
                                    </li>

                                    <li
                                        class="page-item {{ $authors->currentPage() == $authors->lastPage() ? 'disabled' : '' }}">
                                        <a class="page-link"
                                            href="{{ $authors->currentPage() == $authors->lastPage() ? '#' : $authors->nextPageUrl() }}">
                                            Next
                                        </a>
                                    </li>
                                </ul>

                                <form method="GET" action="{{ route('author') }}" class="d-inline-block ms-2">
                                    <select name="perPage" onchange="this.form.submit()" class="form-select form-select-sm">
                                        @foreach ([10, 20, 50, 100] as $size)
                                            <option value="{{ $size }}"
                                                {{ request('perPage', 100) == $size ? 'selected' : '' }}>
                                                {{ $size }} per page
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </nav>


                        </div>
                        {{-- <div class="mt-3">
                            {{ $authors->links('pagination::bootstrap-5') }}
                        </div> --}}
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>

    <div class="modal fade" id="addAuthorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('author.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Author</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Author Name</label>
                            <input type="text" name="nama" class="form-control" required>
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

    <div class="modal fade" id="editAuthorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editAuthorForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Author</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Author Name</label>
                            <input type="text" name="nama" id="editAuthorName" class="form-control" required>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-authors');
            searchInput.addEventListener('input', function() {
                const filter = this.value.trim().toLowerCase();
                const table = document.querySelector('.table.app-table-hover tbody');
                const rows = table.querySelectorAll('tr');

                rows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    if (!cells.length) return;

                    const noText = cells[0].textContent.trim().toLowerCase();
                    const nameText = cells[1].textContent.trim().toLowerCase();

                    if (/^\d+$/.test(filter)) {
                        if (noText === filter) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    } else {
                        if (nameText.includes(filter)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });
            });
        });
    </script>

@endsection
