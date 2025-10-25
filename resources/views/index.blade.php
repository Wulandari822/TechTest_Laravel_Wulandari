@extends('layouts.main')

@section('title', 'Overview')
@section('content')


    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <h1 class="app-page-title">Overview</h1>

                <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                    <div class="inner">
                        <div class="app-card-body p-3 p-lg-4">
                            <h3 class="mb-3">Welcome, developer!</h3>
                            <div class="row gx-5 gy-3">
                                <div class="col-12 col-lg-9">

                                    <div>Sistem ini dibuat sebagai bagian dari Project Technical Testing dari PT Timedoor
                                        Indonesia, dengan tujuan mengevaluasi kemampuan dalam perancangan basis data,
                                        penggunaan framework Laravel, serta implementasi fungsi CRUD dan fitur manajemen
                                        transaksi pada sebuah sistem informasi.</div>
                                </div>

                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Books</h4>
                                <div class="stats-figure">$12,628</div>
                            </div>
                            <a class="app-card-link-mask" href="#"></a>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Authors</h4>
                                <div class="stats-figure">$2,250</div>
                            </div>
                            <a class="app-card-link-mask" href="#"></a>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Customers</h4>
                                <div class="stats-figure">23</div>
                            </div>
                            <a class="app-card-link-mask" href="#"></a>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4 d-flex flex-row flex-nowrap overflow-auto">
                    <div class="col-auto me-3" style="min-width: 350px;">
                        <div class="app-card app-card-stats-table h-100 shadow-sm">
                            <div class="app-card-header p-2">
                                <h5 class="app-card-title mb-0">Top 10 Most Of Books</h5>
                            </div>
                            <div class="app-card-body p-2">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0 table-sm">
                                        <thead>
                                            <tr>
                                                <th class="meta">Name</th>
                                                <th class="meta stat-cell">Voter</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($topBooks as $book)
                                                <tr>
                                                    <td>{{ $book->judul }}</td>
                                                    <td class="stat-cell">{{ $book->total_voter }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto" style="min-width: 350px;">
                        <div class="app-card app-card-stats-table h-100 shadow-sm">
                            <div class="app-card-header p-2">
                                <h5 class="app-card-title mb-0">Top 10 Most Famous Authors</h5>
                            </div>
                            <div class="app-card-body p-2">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0 table-sm">
                                        <thead>
                                            <tr>
                                                <th class="meta">Author</th>
                                                <th class="meta stat-cell">Avg Rating</th>
                                                <th class="meta stat-cell">Votes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($topAuthors as $author)
                                                <tr>
                                                    <td>{{ $author->nama }}</td>
                                                    <td class="stat-cell">{{ number_format($author->avg_rating, 2) }}</td>
                                                    <td class="stat-cell">{{ $author->total_votes }}</td>
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
