@extends('layouts.admin')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

<style>
    .content-area{
        padding:0 !important;
        background:#f7f3ee;
    }

    .card-inner{
        background:transparent !important;
        border:none !important;
        box-shadow:none !important;
        padding:0 !important;
    }

    *{
        box-sizing:border-box;
    }

    .dashboard-v2{
        font-family:'Plus Jakarta Sans',sans-serif;
        padding:28px;
        color:#3e2c23;
        animation:fadeSmooth .5s ease;
    }

    @keyframes fadeSmooth{
        from{
            opacity:0;
            transform:translateY(10px);
        }
        to{
            opacity:1;
            transform:translateY(0);
        }
    }

    :root{
        --dark:#3e2c23;
        --gold:#d4a373;
        --soft:#fdfbf8;
        --muted:#9f9185;
    }

    /* HERO */
    .hero-glass{
        position:relative;
        overflow:hidden;
        padding:48px;
        border-radius:38px;
        margin-bottom:28px;
        background:
        radial-gradient(circle at top right, rgba(255,255,255,0.06), transparent 35%),
        linear-gradient(135deg,#3e2c23 0%,#241811 100%);
        color:#fff;
        box-shadow:
        0 25px 60px rgba(62,44,35,.18),
        inset 0 0 80px rgba(255,255,255,.03);
    }

    .badge-top{
        display:inline-flex;
        align-items:center;
        gap:8px;
        background:rgba(255,255,255,.08);
        border:1px solid rgba(255,255,255,.06);
        color:#d4a373;
        padding:8px 16px;
        border-radius:999px;
        font-size:11px;
        font-weight:800;
        letter-spacing:1px;
        text-transform:uppercase;
        backdrop-filter:blur(10px);
    }

    .hero-glass h1{
        margin:18px 0 0;
        font-family:'Instrument Serif',serif;
        font-size:58px;
        line-height:1;
        font-weight:400;
        letter-spacing:-1px;
    }

    .hero-desc{
        margin-top:14px;
        color:rgba(255,255,255,.55);
        font-size:14px;
        max-width:420px;
        line-height:1.7;
        font-weight:500;
    }

    .hero-icon{
        position:absolute;
        right:-20px;
        bottom:-20px;
        font-size:240px;
        opacity:.03;
    }

    /* GRID */
    .bento-container{
        display:grid;
        grid-template-columns:repeat(3,1fr) 1.15fr;
        gap:24px;
    }

    .bento-card{
        position:relative;
        overflow:hidden;
        background:rgba(255,255,255,.92);
        backdrop-filter:blur(20px);
        border-radius:30px;
        padding:30px;
        border:1px solid rgba(212,163,115,.10);
        transition:.35s ease;
        box-shadow:
        0 10px 30px rgba(62,44,35,.05),
        0 2px 10px rgba(62,44,35,.03);
    }

    .bento-card:hover{
        transform:translateY(-6px);
        border-color:rgba(212,163,115,.35);
        box-shadow:
        0 22px 50px rgba(62,44,35,.10),
        0 5px 15px rgba(62,44,35,.04);
    }

    .bento-card::before{
        content:'';
        position:absolute;
        top:-60px;
        right:-60px;
        width:150px;
        height:150px;
        background:radial-gradient(circle, rgba(212,163,115,.08), transparent 70%);
    }

    .label-mini{
        font-size:10px;
        font-weight:800;
        letter-spacing:1.6px;
        text-transform:uppercase;
        color:#b0a295;
        margin-bottom:8px;
    }

    .value-bold{
        font-size:46px;
        font-weight:800;
        letter-spacing:-2px;
        color:var(--dark);
        line-height:1;
    }

    .sub-info{
        margin-top:10px;
        font-size:13px;
        color:#a89c90;
        font-weight:600;
    }

    /* CHART */
    .bento-chart{
        grid-column:span 3;
        min-height:380px;
    }

    .chart-head{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:25px;
    }

    .chart-title{
        font-size:20px;
        font-weight:800;
        letter-spacing:-0.5px;
    }

    /* ACTIVITY */
    .bento-activity{
        grid-row:span 2;
        background:linear-gradient(180deg,#3e2c23 0%,#241811 100%);
        color:white;
        box-shadow:
        0 30px 60px rgba(62,44,35,.20);
    }

    .activity-title{
        font-family:'Instrument Serif',serif;
        font-size:34px;
        font-weight:400;
        margin-top:8px;
        margin-bottom:25px;
    }

    .activity-list{
        display:flex;
        flex-direction:column;
        gap:18px;
    }

    .activity-item{
        display:flex;
        align-items:center;
        gap:14px;
    }

    .avatar-sm{
        width:42px;
        height:42px;
        border-radius:14px;
        background:var(--gold);
        color:var(--dark);
        display:flex;
        align-items:center;
        justify-content:center;
        font-weight:800;
        font-size:14px;
        flex-shrink:0;
        box-shadow:0 10px 18px rgba(212,163,115,.20);
    }

    .activity-name{
        font-size:13px;
        font-weight:700;
        white-space:nowrap;
        overflow:hidden;
        text-overflow:ellipsis;
    }

    .activity-text{
        font-size:11px;
        opacity:.5;
        margin-top:3px;
    }

    .pending-box{
        margin-top:28px;
        padding-top:24px;
        border-top:1px solid rgba(255,255,255,.08);
    }

    .pending-count{
        font-size:36px;
        font-weight:800;
        line-height:1;
    }

    .pending-count span{
        font-size:12px;
        opacity:.5;
        font-weight:500;
    }

    .btn-action{
        margin-top:28px;
        display:flex;
        align-items:center;
        justify-content:center;
        gap:10px;
        text-decoration:none;
        background:var(--gold);
        color:var(--dark);
        height:56px;
        border-radius:18px;
        font-size:13px;
        font-weight:800;
        transition:.3s ease;
        box-shadow:0 12px 24px rgba(212,163,115,.20);
    }

    .btn-action:hover{
        transform:translateY(-2px);
        background:#e4b07d;
    }

    @media(max-width:1100px){
        .bento-container{
            grid-template-columns:1fr 1fr;
        }

        .bento-chart{
            grid-column:span 2;
        }

        .bento-activity{
            grid-column:span 2;
        }
    }

    @media(max-width:768px){
        .dashboard-v2{
            padding:18px;
        }

        .hero-glass{
            padding:35px 28px;
            border-radius:30px;
        }

        .hero-glass h1{
            font-size:42px;
        }

        .bento-container{
            grid-template-columns:1fr;
        }

        .bento-chart,
        .bento-activity{
            grid-column:span 1;
        }

        .value-bold{
            font-size:38px;
        }
    }
</style>

<div class="dashboard-v2">

    <div class="hero-glass">
        <span class="badge-top">
            <i class="ri-shining-2-line"></i>
            Admin Portal
        </span>

        <h1>
            Welcome back,<br>
            {{ explode(' ', auth()->user()->name)[0] }}.
        </h1>

        <div class="hero-desc">
            Manage books, readers, and activity in one premium workspace.
        </div>

        <i class="ri-quill-pen-line hero-icon"></i>
    </div>

    <div class="bento-container">

        <div class="bento-card">
            <div class="label-mini">Readers</div>
            <div class="value-bold">{{ number_format($totalUser) }}</div>
            <div class="sub-info">Registered members</div>
        </div>

        <div class="bento-card">
            <div class="label-mini">Books</div>
            <div class="value-bold">{{ number_format($totalBuku) }}</div>
            <div class="sub-info">Library collection</div>
        </div>

        <div class="bento-card" style="background:#fcfaf7;">
            <div class="label-mini" style="color:#d4a373;">Loans</div>
            <div class="value-bold" style="color:#d4a373;">
                {{ number_format($totalPinjam) }}
            </div>
            <div class="sub-info">Currently borrowed</div>
        </div>

        <div class="bento-card bento-activity">

            <div class="label-mini" style="color:#d4a373;">
                Live Activity
            </div>

            <div class="activity-title">
                Stream
            </div>

            <div class="activity-list">

                @forelse($peminjamans->take(5) as $p)
                <div class="activity-item">

                    <div class="avatar-sm">
                        {{ substr($p->user->name ?? 'U',0,1) }}
                    </div>

                    <div style="overflow:hidden;">
                        <div class="activity-name">
                            {{ $p->user->name }}
                        </div>

                        <div class="activity-text">
                            Borrowed a book
                        </div>
                    </div>

                </div>
                @empty
                <div class="activity-text" style="text-align:center;padding:25px 0;">
                    No recent activity
                </div>
                @endforelse

            </div>

            <div class="pending-box">
                <div class="label-mini" style="color:#d4a373;">
                    Pending
                </div>

                <div class="pending-count">
                    {{ $pending }}
                    <span>Needs review</span>
                </div>
            </div>

            <a href="/admin/peminjaman" class="btn-action">
                <i class="ri-checkbox-circle-line"></i>
                Verify Loans
            </a>

        </div>

        <div class="bento-card bento-chart">

            <div class="chart-head">
                <div class="chart-title">
                    Reading Analytics
                </div>

                <div class="label-mini">
                    Last 6 Months
                </div>
            </div>

            <div style="height:280px;">
                <canvas id="chartPremium"></canvas>
            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('chartPremium').getContext('2d');

    const gradient = ctx.createLinearGradient(0,0,0,280);
    gradient.addColorStop(0,'rgba(62,44,35,0.18)');
    gradient.addColorStop(0.5,'rgba(212,163,115,0.08)');
    gradient.addColorStop(1,'rgba(212,163,115,0)');

    new Chart(ctx,{
        type:'line',
        data:{
            labels:{!! json_encode($chart->labels) !!},
            datasets:[{
                data:{!! json_encode($chart->data) !!},
                borderColor:'#3e2c23',
                borderWidth:3,
                fill:true,
                backgroundColor:gradient,
                tension:.45,
                pointRadius:4,
                pointBackgroundColor:'#3e2c23',
                pointBorderColor:'#fff',
                pointBorderWidth:2,
                pointHoverRadius:7,
                pointHoverBackgroundColor:'#d4a373',
                pointHoverBorderColor:'#fff',
                pointHoverBorderWidth:3
            }]
        },
        options:{
            responsive:true,
            maintainAspectRatio:false,
            plugins:{
                legend:{
                    display:false
                }
            },
            interaction:{
                intersect:false,
                mode:'index'
            },
            scales:{
                y:{
                    beginAtZero:true,
                    grid:{
                        color:'rgba(0,0,0,0.04)',
                        drawBorder:false
                    },
                    ticks:{
                        color:'#a89c90',
                        font:{
                            family:'Plus Jakarta Sans',
                            size:11
                        }
                    }
                },
                x:{
                    grid:{
                        display:false
                    },
                    ticks:{
                        color:'#a89c90',
                        font:{
                            family:'Plus Jakarta Sans',
                            size:11
                        }
                    }
                }
            }
        }
    });

});
</script>
@endsection