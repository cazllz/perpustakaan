@extends('layouts.app')

@section('content')

<div style="max-width:1100px; margin:auto; padding:40px 20px;">

    <h2 style="
        margin-bottom:35px;
        color:#2f241d;
        font-size:24px;
        font-weight:600;
        letter-spacing:0.3px;
    ">
        🕒 Riwayat Peminjaman
    </h2>

    <div style="
        display:grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap:28px;
    ">

    @forelse($riwayat as $item)

        @php
            $isArray = is_array($item);
            $status = $isArray ? $item['status'] : $item->status;
            $judul = $isArray ? $item['judul'] : ($item->book->judul ?? '📕 Buku tidak tersedia');

            $tgl_pinjam = $isArray ? ($item['tanggal_pinjam'] ?? '-') : ($item->tanggal_pinjam ?? '-');
            $tgl_kembali = $isArray ? ($item['tanggal_kembali'] ?? '-') : ($item->tanggal_kembali ?? '-');
        @endphp

        <div style="
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(10px);
            border-radius:22px;
            padding:22px;
            box-shadow:0 15px 35px rgba(0,0,0,0.08);
            position:relative;
            transition:all 0.3s ease;
        "
        onmouseover="this.style.transform='translateY(-8px) scale(1.02)'"
        onmouseout="this.style.transform='translateY(0) scale(1)'"
        >

            <!-- STATUS BADGE PREMIUM -->
            @if($status == 'dipinjam')
                <span style="
                    position:absolute;
                    top:18px;
                    right:18px;
                    background:rgba(243,156,18,0.15);
                    color:#b9770e;
                    padding:6px 14px;
                    border-radius:30px;
                    font-size:12px;
                    font-weight:500;
                ">Dipinjam</span>

            @elseif($status == 'dikembalikan')
                <span style="
                    position:absolute;
                    top:18px;
                    right:18px;
                    background:rgba(46,204,113,0.15);
                    color:#1e8449;
                    padding:6px 14px;
                    border-radius:30px;
                    font-size:12px;
                    font-weight:500;
                ">Dikembalikan</span>

            @elseif($status == 'terlambat')
                <span style="
                    position:absolute;
                    top:18px;
                    right:18px;
                    background:rgba(231,76,60,0.15);
                    color:#922b21;
                    padding:6px 14px;
                    border-radius:30px;
                    font-size:12px;
                    font-weight:500;
                ">Terlambat</span>
            @endif

            <!-- JUDUL -->
            <h3 style="
                color:#2f241d;
                margin-bottom:12px;
                font-size:18px;
                font-weight:600;
                line-height:1.4;
            ">
                {{ $judul }}
            </h3>

            <!-- GARIS HALUS -->
            <div style="
                height:1px;
                background:rgba(0,0,0,0.05);
                margin:10px 0 15px 0;
            "></div>

            <!-- INFO -->
            <div style="
                font-size:13px;
                color:#6d6257;
                display:flex;
                flex-direction:column;
                gap:6px;
            ">

                <div style="display:flex; align-items:center; gap:6px;">
                    📅 <span>Pinjam:</span>
                    <b style="color:#3e3a35;">{{ $tgl_pinjam }}</b>
                </div>

                <div style="display:flex; align-items:center; gap:6px;">
                    ⏳ <span>Kembali:</span>
                    <b style="color:#3e3a35;">{{ $tgl_kembali }}</b>
                </div>

            </div>

        </div>

    @empty

        <p style="
            grid-column:1/-1;
            text-align:center;
            color:#8B5E3C;
            font-size:14px;
        ">
            Belum ada riwayat peminjaman
        </p>

    @endforelse

    </div>

</div>

@endsection