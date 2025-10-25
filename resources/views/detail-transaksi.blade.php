@extends('layouts.main')

@section('title', 'Detail Transaksi')

@section('content')
    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Detail Transaksi</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <form class="table-search-form row gx-1 align-items-center">
                                        <div class="col-auto">
                                            <input type="text" id="search-orders" name="searchorders"
                                                class="form-control search-orders" placeholder="Search">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn app-btn-secondary">Search</button>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-auto">

                                    <select class="form-select w-auto">
                                        <option selected value="option-1">All</option>
                                        <option value="option-2">This week</option>
                                        <option value="option-3">This month</option>
                                        <option value="option-4">Last 3 months</option>

                                    </select>
                                </div>
                                <div class="col-auto">
                                    <a class="btn app-btn-secondary" href="#">
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
                            </div>
                        </div>
                    </div>
                </div>


                <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab"
                        href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
                    <a class="flex-sm-fill text-sm-center nav-link" id="orders-done-tab" data-bs-toggle="tab"
                        href="#orders-done" role="tab" aria-controls="orders-done" aria-selected="false">Selesai</a>
                    <a class="flex-sm-fill text-sm-center nav-link" id="orders-proses-tab" data-bs-toggle="tab"
                        href="#orders-proses" role="tab" aria-controls="orders-proses"
                        aria-selected="false">Diproses</a>
                    <a class="flex-sm-fill text-sm-center nav-link" id="orders-fine-tab" data-bs-toggle="tab"
                        href="#orders-fine" role="tab" aria-controls="orders-fine" aria-selected="false">Denda</a>
                </nav>


                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Order</th>
                                                <th class="cell">Nama</th>
                                                <th class="cell">Buku</th>
                                                <th class="cell">Jumlah</th>
                                                <th class="cell">Total</th>
                                                <th class="cell">Status</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allTransactions as $trx)
                                                <tr>
                                                    <td class="cell">{{ $trx->transaksi_id }}</td>
                                                    <td class="cell">{{ $trx->user->nama }}</td>
                                                    <td class="cell">{{ $trx->book ? $trx->book->judul : '-' }}</td>
                                                    <td class="cell">{{ $trx->jumlah }}</td>
                                                    <td class="cell">Rp
                                                        {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                                                    <td class="cell">
                                                        @if ($trx->status === 'selesai')
                                                            <span class="badge bg-success">Selesai</span>
                                                        @elseif($trx->status === 'diproses')
                                                            <span class="badge bg-warning">Diproses</span>
                                                        @elseif($trx->status === 'denda')
                                                            <span class="badge bg-danger">Denda</span>
                                                        @endif
                                                    </td>
                                                    <td class="cell"><a class="btn-sm app-btn-secondary"
                                                            href="#">View</a></td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>


                    </div>

                    <div class="tab-pane fade" id="orders-done" role="tabpanel" aria-labelledby="orders-done-tab">
                        <div class="app-card app-card-orders-table mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">

                                    <table class="table mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Order</th>
                                                <th class="cell">Nama</th>
                                                <th class="cell">Buku</th>
                                                <th class="cell">Jumlah</th>
                                                <th class="cell">Total</th>
                                                <th class="cell">Status</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($doneTransactions as $trx)
                                                <tr>
                                                    <td class="cell">{{ $trx->id }}</td>
                                                    <td class="cell">{{ $trx->user->nama }}</td>
                                                    <td class="cell">{{ $trx->book ? $trx->book->judul : '-' }}</td>
                                                    <td class="cell">{{ $trx->jumlah }}</td>
                                                    <td class="cell">Rp
                                                        {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                                                    <td class="cell"><span class="badge bg-success">Selesai</span></td>
                                                    <td class="cell"><a class="btn-sm app-btn-secondary"
                                                            href="#">View</a></td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="orders-proses" role="tabpanel" aria-labelledby="orders-proses-tab">
                        <div class="app-card app-card-orders-table mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Order</th>
                                                <th class="cell">Nama</th>
                                                <th class="cell">Buku</th>
                                                <th class="cell">Jumlah</th>
                                                <th class="cell">Total</th>
                                                <th class="cell">Status</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($prosesTransactions as $trx)
                                                <tr>
                                                    <td class="cell">{{ $trx->id }}</td>
                                                    <td class="cell">{{ $trx->user->nama }}</td>
                                                    <td class="cell">{{ $trx->book ? $trx->book->judul : '-' }}</td>
                                                    <td class="cell">{{ $trx->jumlah }}</td>
                                                    <td class="cell">Rp
                                                        {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                                                    <td class="cell"><span class="badge bg-warning">Diproses</span></td>
                                                    <td class="cell"><a class="btn-sm app-btn-secondary"
                                                            href="#">View</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="orders-fine" role="tabpanel" aria-labelledby="orders-fine-tab">
                        <div class="app-card app-card-orders-table mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Order</th>
                                                <th class="cell">Nama</th>
                                                <th class="cell">Buku</th>
                                                <th class="cell">Jumlah</th>
                                                <th class="cell">Total</th>
                                                <th class="cell">Status</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($fineTransactions as $trx)
                                                <tr>
                                                    <td class="cell">{{ $trx->id }}</td>
                                                    <td class="cell">{{ $trx->user->nama }}</td>
                                                    <td class="cell">{{ $trx->book ? $trx->book->judul : '-' }}</td>
                                                    <td class="cell">{{ $trx->jumlah }}</td>
                                                    <td class="cell">Rp
                                                        {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                                                    <td class="cell"><span class="badge bg-danger">Denda</span></td>
                                                    <td class="cell"><a class="btn-sm app-btn-secondary"
                                                            href="#">View</a></td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>


    </div>

@endsection
