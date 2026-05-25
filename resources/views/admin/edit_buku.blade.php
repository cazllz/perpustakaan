@extends('layouts.admin')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

<style>
    /* Reset layout bawaan agar background krem asli terlihat bersih */
    .content-area { padding: 0 !important; }
    .card-inner { 
        background: transparent !important; 
        box-shadow: none !important; 
        padding: 0 !important; 
        border: none !important;
    }

    .workspace-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #2C1F17;
        padding: 25px 30px;
    }

    /* Container utama agar posisi form pas di tengah layar */
    .nexus-form-container {
        max-width: 1040px;
        margin: 0 auto;
    }

    /* Grid layout untuk membagi bagian kiri dan kanan agar sejajar otomatis */
    .form-layout-nexus {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 30px;
        align-items: stretch;
    }

    /* Desain kotak bento putih */
    .bento-panel-form {
        background: #ffffff;
        border-radius: 28px;
        padding: 30px;
        border: 1.5px solid rgba(62, 44, 35, 0.06); 
        box-shadow: 0 10px 35px rgba(44, 31, 23, 0.02);
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
    }

    /* Pembagian kolom input di dalam form */
    .form-fields-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .form-group { display: flex; flex-direction: column; }
    .form-group-full { grid-column: span 2; }

    .form-label-premium {
        font-size: 11px; font-weight: 800; text-transform: uppercase;
        color: #A89C90; margin-bottom: 8px; letter-spacing: 1px;
    }

    /* Gaya kolom input, select, dan textarea */
    .form-input-premium, .form-select-premium, .form-textarea-premium {
        width: 100%; padding: 14px 18px; border-radius: 14px;
        border: 2px solid #F8F5F2; font-size: 14px; font-weight: 700;
        outline: none; transition: 0.3s; background-color: #FBFAFA;
        color: #2C1F17; box-sizing: border-box;
    }

    .form-input-premium:focus, .form-select-premium:focus, .form-textarea-premium:focus { 
        border-color: #D4A373; 
        background-color: #ffffff; 
        box-shadow: 0 8px 20px rgba(212, 163, 115, 0.05);
    }

    .form-select-premium {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23D4A373'%3E%3Cpath d='M12 14L16.59 9.41L18 10.83L12 16.83L6 10.83L7.41 9.41L12 14Z'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 18px center; background-size: 18px;
        padding-right: 45px; cursor: pointer;
    }

    .form-textarea-premium { height: 110px; resize: none; line-height: 1.5; padding-top: 14px; }

    /* Kotak preview gambar agar tingginya otomatis sama rata dengan form kiri */
    .preview-box-premium {
        width: 100%;
        flex: 1; 
        min-height: 410px; 
        border: 2px dashed #EFEBE4;
        border-radius: 22px; 
        display: flex; 
        align-items: center; 
        justify-content: center;
        overflow: hidden; 
        background: #FBFAFA; 
        position: relative; 
        transition: 0.3s ease;
        box-sizing: border-box;
    }
    
    .preview-box-premium.has-image { border: 2px solid #D4A373; box-shadow: 0 12px 25px rgba(44, 31, 23, 0.06); }
    .preview-img-premium { width: 100%; height: 100%; object-fit: cover; }

    /* Desain tombol submit dan batal */
    .btn-submit-premium {
        background: #2C1F17; color: #D4A373; border: 1px solid rgba(212, 163, 115, 0.15); 
        padding: 15px 30px; border-radius: 16px; font-weight: 800; font-size: 11px;
        text-transform: uppercase; letter-spacing: 1.5px; cursor: pointer; transition: 0.3s;
        display: inline-flex; align-items: center; gap: 8px;
    }
    .btn-submit-premium:hover { background: #000; transform: translateY(-2px); }

    .btn-cancel {
        text-decoration: none; color: #A89C90; font-weight: 800; font-size: 11px; 
        text-transform: uppercase; letter-spacing: 1px; transition: 0.3s;
        align-self: center; padding: 12px 18px; border-radius: 12px;
    }
    .btn-cancel:hover { color: #2C1F17; background: rgba(44,31,23,0.04); }
</style>

@php
    $prefix = request()->is('admin/*') ? 'admin' : 'petugas';
@endphp

<div class="workspace-wrapper">
    <div class="nexus-form-container">
        
        <div style="border-left: 6px solid #D4A373; padding-left: 20px; margin-bottom: 35px;">
            <h2 style="font-weight: 900; font-size: 34px; letter-spacing: -1.5px; margin: 0; color: #2C1F17;">Sunting Buku.</h2>
            <p style="color: #A89C90; font-size: 14px; font-weight: 500; margin-top: 4px; margin-bottom: 0;">Memperbarui arsip: <b style="color: #2C1F17;">{{ $book->judul }}</b></p>
        </div>

        @if($errors->any())
        <div style="background:#fff0f0; border:1px solid #e74c3c; border-radius:16px; padding:20px 25px; margin-bottom:25px;">
            <b style="color:#e74c3c;">Gagal menyimpan, ada kesalahan:</b>
            <ul style="margin:10px 0 0; padding-left:20px; color:#c0392b;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ url($prefix . '/buku/update/' . $book->id) }}" method="POST" enctype="multipart/form-data" id="editBookForm">
            @csrf
            @method('PUT')
            <div class="form-layout-nexus">
                
                <div class="bento-panel-form">
                    <div style="margin-bottom: 25px; border-bottom: 1.5px solid #F8F5F2; padding-bottom: 15px;">
                        <h3 style="font-size: 16px; font-weight: 800; margin: 0; color: #2C1F17; display: flex; align-items: center; gap: 10px;">
                            <i class="ri-draft-line" style="color:#D4A373; font-size: 18px;"></i> Informasi Buku
                        </h3>
                    </div>

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
                            <input type="number" name="tahun" class="form-input-premium" value="{{ $book->tahun }}" required>
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
                            <textarea name="deskripsi" class="form-textarea-premium" placeholder="Tulis sinopsis singkat buku...">{{ $book->deskripsi ?? $book->sinopsis }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bento-panel-form">
                    <div style="border-bottom: 1.5px solid #F8F5F2; padding-bottom: 15px; width: 100%; margin-bottom: 20px;">
                        <h3 style="font-size: 15px; font-weight: 800; margin: 0; color: #2C1F17; display: flex; align-items: center; gap: 10px;">
                            <i class="ri-image-line" style="color:#D4A373; font-size: 18px;"></i> Sampul Buku
                        </h3>
                    </div>

                    <div class="preview-box-premium {{ $book->cover ? 'has-image' : '' }}" id="previewContainer">
                        <img src="{{ $book->cover ? asset('storage/' . $book->cover) : '' }}" 
                             class="preview-img-premium" 
                             id="imagePreview" 
                             style="{{ $book->cover ? 'display:block;' : 'display:none;' }}">
                        
                        <div class="preview-placeholder" id="placeholderText" style="{{ $book->cover ? 'display:none;' : 'text-align:center; color:#a89c90;' }}">
                            <i class="ri-image-add-line" style="font-size: 36px; color:#D4A373; opacity: 0.6;"></i>
                            <p style="font-size: 10px; font-weight: 800; margin: 8px 0 0; letter-spacing: 1px; color: #A89C90;">BELUM ADA COVER</p>
                        </div>
                    </div>

                    <div style="width:100%; margin-top: 20px;">
                        <label for="coverInput" style="display:flex; align-items:center; justify-content:center; gap:8px; width:100%; text-align:center; padding:13px; background:#FDF9F4; color:#2C1F17; border-radius:14px; font-size:11px; font-weight:800; cursor:pointer; border:1.5px solid rgba(212, 163, 115, 0.25); transition: 0.3s; box-sizing: border-box;">
                            <i class="ri-upload-cloud-2-line" style="font-size: 14px; color:#D4A373;"></i> GANTI FILE GAMBAR
                        </label>
                        <input type="file" name="cover" id="coverInput" accept="image/*" style="display:none;">
                    </div>
                    <small style="color: #a89c90; font-size: 10px; font-weight: 700; text-align: center; display: block; margin-top: 10px;">*Abaikan jika tidak ingin mengubah cover.</small>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 30px; border-top: 1.5px solid #EFEBE4; padding-top: 25px;">
                <a href="{{ url($prefix . '/buku') }}" class="btn-cancel">BATALKAN</a>
                <button type="button" onclick="confirmUpdate()" class="btn-submit-premium">
                    <i class="ri-checkbox-circle-fill"></i> SIMPAN PERUBAHAN
                </button>
            </div>
        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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

    function confirmUpdate() {
        Swal.fire({
            title: 'Simpan Perubahan?',
            text: "Pastikan data identitas buku sudah benar sebelum memperbarui arsip.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2C1F17',
            cancelButtonColor: '#D4A373',
            confirmButtonText: 'Ya, Update Data',
            cancelButtonText: 'Periksa Kembali'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('editBookForm').submit();
            }
        });
    }
</script>
@endsection