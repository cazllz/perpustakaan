<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
</head>

<body>

<h2>Edit Buku</h2>

<form method="POST" action="/tambah" enctype="multipart/form-data">
    
    @csrf

    <p>Judul</p>
    <input type="text" name="judul" value="{{ $book->judul }}">

    <p>Penulis</p>
    <input type="text" name="penulis" value="{{ $book->penulis }}">

    <p>Penerbit</p>
    <input type="text" name="penerbit" value="{{ $book->penerbit }}">

    <p>Tahun</p>
    <input type="text" name="tahun" value="{{ $book->tahun }}">

    <p>Kategori</p>
    <input type="text" name="kategori" value="{{ $book->kategori }}">

    <p>Ganti Cover</p>
<input type="file" name="cover">

    <p>Status</p>
    <select name="status">
        <option value="tersedia" {{ $book->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
        <option value="dipinjam" {{ $book->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
    </select>

    <br><br>
    <button type="submit">Update</button>

</form>

</body>
</html>