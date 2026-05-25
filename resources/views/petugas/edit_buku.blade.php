@extends('layouts.admin')

@section('content')
<style>
    /* MASTER WORKSPACE - High End Edition */
    .workspace-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #2C1F17;
        padding: 10px;
        animation: fadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

    /* PANEL UTAMA - Dengan Bayangan Berlapis & Garis Tipis */
    .content-box-premium {
        background: #ffffff;
        border-radius: 40px;
        padding: 45px;
        box-shadow: 0 25px 60px rgba(46, 29, 21, 0.03), 0 10px 20px rgba(46, 29, 21, 0.02);
        max-width: 1000px;
        margin: 0 auto;
        width: 100%;
        border: 1.5px solid rgba(62, 44, 35, 0.08); /* Garis cokelat tipis elegan */
    }

    .form-layout-grid {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 40px;
    }

    .form-fields-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .form-group { display: flex; flex-direction: column; }
    .form-group-full { grid-column: span 2; }

    .form-label-premium {
        font-size: 11px; font-weight: 800; text-transform: uppercase;
        color: #A89C90; margin-bottom: 12px; letter-spacing: 1.5px;
    }

    /* INPUT STYLING - Fokus pada kenyamanan visual */
    .form-input-premium, .form-select-premium, .form-textarea-premium {
        width: 100%; padding: 16px 22px; border-radius: 20px;
        border: 2px solid #F8F5F2; font-size: 14px; font-weight: 700;
        outline: none; transition: 0.3s; background-color: #FBFAFA;
        color: #2C1F17;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .form-input-premium:focus, .form-textarea-premium:focus { 
        border-color: #D4A373; 
        background-color: #ffffff; 
        box-shadow: 0 10px 25px rgba(212, 163, 115, 0.08);
    }

    .form-textarea-premium { 
        height: 180px; 
        resize: none; 
        line-height: 1.6;
        padding-top: 18px;
    }

    /* PREVIEW COVER - 3D Tilt Style */
    .preview-box-premium {
        width: 100%; height: 420px; 
        border: 1.5px solid rgba(62, 44, 35, 0.08);
        border-radius: 30px; display: flex; align-items: center; justify-content: center;
        overflow: hidden; background: #FBFAFA; position: relative; 
        box-shadow: 10px 20px 40px rgba(44, 31, 23, 0.15);
        transition: 0.5s cubic-bezier(0.23, 1, 0.32, 1);
    }
    
    .preview-box-premium.has-image { border: 1.5px solid #D4A373; }
    .preview-img-premium { width: 100%; height: 100%; object-fit: cover; }

    /* BUTTONS - Premium UI */
    .btn-submit-premium {
        background: #2C1F17; color: #D4A373; border: 1px solid rgba(212, 163, 115, 0.2); 
        padding: 18px 40px; border-radius: 22px; font-weight: 800; font-size: 12px;
        text-transform: uppercase; letter-spacing: 2px; cursor: pointer; transition: 0.4s;
        box-shadow: 0 10px 20px rgba(44, 31, 23, 0.15);
    }
    .btn-submit-premium:hover { background: #000; transform: translateY(-3px); box-shadow: 0 15px 30px rgba(0,0,0,0.2); }

    .btn-cancel {
        text-decoration: none; color: #A89C90; font-weight: 800; font-size: 12px; 
        text-transform: uppercase; letter-spacing: 1px; transition: 0.3s;
        align-self: center;
    }
    .btn-cancel:hover { color: #2C1F17; }
</style>

@php
    // 🔥 AUTO DETECT ROLE PREFIX: Deteksi otomatis wilayah login berdasarkan URL agar hemat struktur file
    $prefix = request()->is('admin/*') ? 'admin' : 'petugas';
@endphp

<div class="workspace-wrapper">
    <div style="margin-bottom: 35px; max-width: 1000px; margin-left: auto; margin-right: auto; border-left: 6px solid #D4A373; padding: 10px 25px; background: linear-gradient(90deg, rgba(212, 163, 115, 0.05) 0%, transparent 100%);">
        <h2 style="font-weight: 800; font-size: 32px; letter-spacing: -1.5px; margin: 0;">Sunting Buku.</h2>
        <p style="color: #a89c90; font-size: 14px; margin: 5px 0 0 0;">Memperbarui arsip: <b style="color: #2C1F17;">{{ $book->judul }}</b></p>
    </div>

    <div class="content-box-premium">
        <form action="{{ url($prefix . '/buku/update/' . $book->id) }}" method="POST" enctype="multipart/form-data" id="editBookForm">
            @csrf
            @method('PUT')
            
            <div class="form-layout-grid">
                
                <div class="form-fields-grid">
                    <div class="form-group form-group-full">
                        <label class="form-label-premium">Judul Buku</label>
                        <input type="text" name="judul" class="form-input-premium" value="{{ $book->judul }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label-premium">Penulis</label>
                        <input type="text" name="penulis" class="form-input-premium" value="{{ $book->penulis }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label-premium">Penerbit</label>
                        <input type="text" name="penerbit" class="form-input-premium" value="{{ $book->penerbit }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label-premium">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-input-premium" value="{{ $book->tahun_terbit }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label-premium">Jumlah Stok Buku</label>
                        <input type="number" name="stok" class="form-input-premium" min="0" value="{{ $book->stok }}" required>
                    </div>

                    <div class="form-group form-group-full">
                        <label class="form-label-premium">Klasifikasi Kategori</label>
                        <select name="kategori_id" class="form-select-premium" required>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}" {{ $book->kategori_id == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group form-group-full">
                        <label class="form-label-premium">Deskripsi / Sinopsis</label>
                        <textarea name="deskripsi" class="form-textarea-premium" placeholder="Tulis sinopsis singkat buku...">{{ $book->deskripsi }}</textarea>
                    </div>
                </div>

                <div class="cover-preview-wrapper" style="display:flex; flex-direction:column; gap:20px; align-items:center;">
                    <label class="form-label-premium" style="align-self: flex-start;">Visualisasi Cover</label>
                    <div class="preview-box-premium {{ $book->cover ? 'has-image' : '' }}" id="previewContainer">
                        <img src="{{ $book->cover ? asset('storage/' . $book->cover) : '' }}" 
                             class="preview-img-premium" 
                             id="imagePreview" 
                             style="{{ $book->cover ? 'display:block;' : 'display:none;' }}">
                        
                        <div class="preview-placeholder" id="placeholderText" style="{{ $book->cover ? 'display:none;' : 'text-align:center; color:#a89c90;' }}">
                            <i class="ri-image-add-line" style="font-size: 48px; color:#D4A373; opacity: 0.5;"></i>
                            <p style="font-size: 11px; font-weight: 800; margin-top: 15px;">BELUM ADA COVER</p>
                        </div>
                    </div>
                    <div style="width:100%;">
                        <label for="coverInput" style="display:block; width:100%; text-align:center; padding:16px; background:#FDF9F4; color:#2C1F17; border-radius:18px; font-size:11px; font-weight:800; cursor:pointer; border:1.5px solid rgba(62, 44, 35, 0.08); transition: 0.3s;">
                            GANTI FILE GAMBAR
                        </label>
                        <input type="file" name="cover" id="coverInput" accept="image/*" style="display:none;">
                    </div>
                    <small style="color: #a89c90; font-size: 10px; font-weight: 700; text-align: center; letter-spacing: 0.5px;">*Abaikan jika tidak ingin mengganti cover.</small>
                </div>

                <div style="grid-column: span 2; display: flex; justify-content: flex-end; gap: 25px; margin-top: 30px; border-top: 1.5px solid #F8F5F2; padding-top: 35px;">
                    <a href="{{ url($prefix . '/buku') }}" class="btn-cancel">BATALKAN</a>
                    <button type="button" onclick="confirmUpdate()" class="btn-submit-premium">Simpan Perubahan</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    // Logika Preview Gambar
    const coverInput = document.getElementById('coverInput');
    const imagePreview = document.getElementById('imagePreview');
    const placeholderText = document.getElementById('placeholderText');
    const previewContainer = document.getElementById('previewContainer');

    coverInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
                placeholderText.style.display = 'none';
                previewContainer.classList.add('has-image');
            }
            reader.readAsDataURL(file);
        }
    });

    // Pop-up Konfirmasi Premium
    function confirmUpdate() {
        Swal.fire({
            title: 'Simpan Perubahan?',
            text: "Pastikan data identitas buku sudah benar sebelum memperbarui arsip.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2C1F17',
            cancelButtonColor: '#D4A373',
            confirmButtonText: 'Ya, Update Data',
            cancelButtonText: 'Periksa Kembali',
            customClass: { popup: 'oase-popup' }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('editBookForm').submit();
            }
        });
    }
</script>
@endsection