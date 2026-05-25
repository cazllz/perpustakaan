<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
</head>

<body>

<h2>Tambah Buku</h2>

<form method="POST" action="/tambah" enctype="multipart/form-data">
    @csrf

    <p>Judul</p>
    <input type="text" name="judul">

    <p>Penulis</p>
    <input type="text" name="penulis">

    <p>Penerbit</p>
    <input type="text" name="penerbit">

    <p>Tahun</p>
    <input type="text" name="tahun">

    <p>Kategori</p>
    <input type="text" name="kategori">

    <p>Cover Buku</p>
<input type="file" name="cover">

    <p>Status</p>
    <select name="status">
        <option value="tersedia">Tersedia</option>
        <option value="dipinjam">Dipinjam</option>
    </select>

    <br><br>
    <button type="submit">Simpan</button>

</form>

</body>
</html>