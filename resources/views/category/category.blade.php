@extends('layouts.main')

@section('title', 'Category')

@section('content')
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Category</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <form class="table-search-form row gx-1 align-items-center">
                                        <div class="col-auto">
                                            <form class="table-search-form row gx-1 align-items-center">
                                                <div class="col-auto">
                                                    <input type="text" id="search-category" class="form-control"
                                                        placeholder="Search">
                                                </div>
                                            </form>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addCategoryModal">
                                        <i class="fa-solid fa-plus"></i> Add Category
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">No</th>
                                                <th class="cell">Name</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($category as $index => $kategori)
                                                <tr>
                                                    <td>{{ ($category->currentPage() - 1) * $category->perPage() + $index + 1 }}
                                                    </td>
                                                    <td><span class="truncate">{{ $kategori->nama }}</span></td>
                                                    <td>
                                                        <button class="btn-sm app-btn-secondary editCategoryBtn"
                                                            data-id="{{ $kategori->kategori_id }}"
                                                            data-nama="{{ $kategori->nama }}" data-bs-toggle="modal"
                                                            data-bs-target="#editCategoryModal">
                                                            Edit
                                                        </button>
                                                        <form
                                                            action="{{ route('category.destroy', $kategori->kategori_id) }}"
                                                            method="POST" style="display:inline-block;"
                                                            onsubmit="return confirm('Yakin ingin hapus kategori ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn-sm app-btn-secondary">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">No categories found</td>
                                                </tr>
                                            @endforelse



                                        </tbody>
                                    </table>
                                    <nav class="app-pagination d-flex justify-content-center align-items-center mt-3 mb-3">
    <ul class="pagination mb-0 me-3">

        <!-- Tombol Previous -->
        <li class="page-item {{ $category->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link"
               href="{{ $category->onFirstPage() ? '#' : $category->previousPageUrl() }}">
               Previous
            </a>
        </li>

        <!-- Tombol Next -->
        <li class="page-item {{ $category->currentPage() == $category->lastPage() ? 'disabled' : '' }}">
            <a class="page-link"
               href="{{ $category->currentPage() == $category->lastPage() ? '#' : $category->nextPageUrl() }}">
               Next
            </a>
        </li>
    </ul>

    <!-- Dropdown jumlah data per halaman -->
    <form method="GET" action="{{ route('category') }}" class="d-inline-block ms-2">
        <select name="perPage" onchange="this.form.submit()" class="form-select form-select-sm">
            @foreach([10, 20, 50, 100] as $size)
                <option value="{{ $size }}" {{ request('perPage', 100) == $size ? 'selected' : '' }}>
                    {{ $size }} per page
                </option>
            @endforeach
        </select>
    </form>
</nav>

                                </div>


                                <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('category.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Category</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Nama Category</label>
                                                        <input type="text" name="nama" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Add</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form id="editCategoryForm" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Category</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Category Name</label>
                                                        <input type="text" name="nama" id="editCategoryName"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>






                    </div>





                </div>
            </div>


        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editButtons = document.querySelectorAll('.editCategoryBtn');
                const editForm = document.getElementById('editCategoryForm');
                const editNameInput = document.getElementById('editCategoryName');

                editButtons.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const id = this.dataset.id;
                        const nama = this.dataset.nama;

                        editNameInput.value = nama;
                        editForm.action = `/category/update/${id}`; 
                    });
                });

                const searchInput = document.getElementById('search-category');
                if (searchInput) {
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
                                row.style.display = (noText === filter) ? '' : 'none';
                            } else {
                                row.style.display = nameText.includes(filter) ? '' : 'none';
                            }
                        });
                    });
                }
            });
        </script>


    @endsection
