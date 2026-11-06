<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <h2>Daftar Buku</h2>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Form Tambah Book -->
    <div class="card mb-4">
        <div class="card-header">Tambah Buku Baru</div>
        <div class="card-body">
            <form action="{{ route('books.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}">
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">ISBN</label>
                        <input type="text" name="isbn" class="form-control @error('isbn') is-invalid @enderror" value="{{ old('isbn') }}">
                        @error('isbn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control @error('tahun_terbit') is-invalid @enderror" value="{{ old('tahun_terbit') }}">
                        @error('tahun_terbit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" step="0.01" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}">
                        @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}">
                        @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Penulis</label>
                        <select name="author_id" class="form-select @error('author_id') is-invalid @enderror">
                            <option value="">-- Pilih Penulis --</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                    {{ $author->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('author_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Buku</button>
            </form>
        </div>
    </div>

    <!-- Tabel Book -->
    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Judul</th>
                <th>ISBN</th>
                <th>Tahun</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Penulis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->judul }}</td>
                <td>{{ $book->isbn }}</td>
                <td>{{ $book->tahun_terbit }}</td>
                <td>Rp {{ number_format($book->harga, 0, ',', '.') }}</td>
                <td>{{ $book->stok }}</td>
                <td>{{ $book->author->nama ?? '-' }}</td>
                <td>
                    <div class="d-flex gap-1">
                        <!-- Tombol Pinjam -->
                        <form action="{{ route('books.pinjam', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">Pinjam Buku</button>
                        </form>

                        <!-- Tombol Kembalikan -->
                        <form action="{{ route('books.kembali', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Kembalikan Buku</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>