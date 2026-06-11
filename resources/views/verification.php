<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Verifikasi Klaim — Lost &amp; Found</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
  <style>
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
    :root{--green:#1D9E75;--green-d:#0F6E56;--green-l:#E1F5EE;--green-b:#9FE1CB;--orange-l:#FAECE7;--orange-t:#993C1D;--orange-b:#F0997B;--amber-l:#FAEEDA;--amber-t:#633806;--amber-b:#FAC775;--blue-l:#E6F1FB;--blue-t:#0C447C;--bg:#F7F9F8;--surface:#FFFFFF;--border:#E2E8E5;--text:#1A1F1C;--muted:#6B7C74;--hint:#A0AFA8;}
    body{font-family:'Inter',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;}
    nav{background:var(--surface);border-bottom:1px solid var(--border);padding:0 2rem;display:flex;align-items:center;justify-content:space-between;height:60px;position:sticky;top:0;z-index:100;}
    .logo{display:flex;align-items:center;gap:10px;text-decoration:none;}
    .logo-icon{width:36px;height:36px;background:var(--green);border-radius:10px;display:flex;align-items:center;justify-content:center;}
    .logo-icon svg{width:20px;height:20px;stroke:#fff;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;}
    .logo-text{font-size:16px;font-weight:600;color:var(--text);}
    .logo-sub{font-size:10px;color:var(--muted);letter-spacing:.05em;text-transform:uppercase;}
    .nav-links{display:flex;align-items:center;gap:1.5rem;}
    .nav-links a{font-size:14px;color:var(--muted);text-decoration:none;}
    .nav-links a.active{color:var(--green);font-weight:500;}
    .main{max-width:800px;margin:0 auto;padding:2rem;}

    /* STEPPER */
    .stepper{display:flex;align-items:center;margin-bottom:2rem;}
    .step{display:flex;align-items:center;gap:8px;flex:1;}
    .step-dot{width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;flex-shrink:0;border:1.5px solid var(--border);background:var(--surface);color:var(--muted);}
    .step-dot.done{background:var(--green-l);border-color:var(--green-b);color:var(--green-d);}
    .step-dot.active{background:var(--green);border-color:var(--green);color:#fff;}
    .step-label{font-size:12px;color:var(--muted);}
    .step-label.active{color:var(--text);font-weight:500;}
    .step-line{flex:1;height:1px;background:var(--border);margin:0 4px;}
    .step-line.done{background:var(--green-b);}

    /* CARDS */
    .card{background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:1.5rem;margin-bottom:1.25rem;}
    .card-title{font-size:15px;font-weight:600;display:flex;align-items:center;gap:8px;margin-bottom:1.25rem;}

    /* NOTIF */
    .notif{display:flex;align-items:flex-start;gap:12px;border-radius:12px;padding:13px 16px;margin-bottom:1.5rem;font-size:14px;line-height:1.6;}
    .notif svg{flex-shrink:0;width:20px;height:20px;margin-top:1px;}
    .notif.warn{background:var(--amber-l);color:var(--amber-t);border:1px solid var(--amber-b);}
    .notif.success{background:var(--green-l);color:var(--green-d);border:1px solid var(--green-b);}

    /* ITEM HEADER */
    .item-header{display:flex;align-items:center;gap:12px;padding-bottom:1rem;border-bottom:1px solid var(--border);margin-bottom:1rem;}
    .item-icon{width:46px;height:46px;background:var(--bg);border-radius:12px;display:flex;align-items:center;justify-content:center;}
    .item-icon svg{width:24px;height:24px;stroke:var(--muted);fill:none;stroke-width:1.5;}
    .item-name{font-size:15px;font-weight:600;}
    .item-meta{font-size:12px;color:var(--muted);display:flex;gap:12px;margin-top:3px;}
    .badge{display:inline-block;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;}
    .badge-found{background:var(--green-l);color:var(--green-d);}

    /* QA */
    .qa-list{display:flex;flex-direction:column;gap:10px;}
    .qa-item{border:1px solid var(--border);border-radius:12px;overflow:hidden;}
    .qa-q{padding:10px 14px;background:var(--bg);font-size:13px;font-weight:500;display:flex;align-items:center;gap:8px;}
    .qa-q svg{width:18px;height:18px;stroke:var(--green);fill:none;stroke-width:2;flex-shrink:0;}
    .qa-body{padding:10px 14px;display:flex;flex-direction:column;gap:8px;}
    .qa-input{font-family:'Inter',sans-serif;font-size:13px;width:100%;padding:9px 12px;border-radius:9px;border:1px solid var(--border);background:var(--surface);color:var(--text);outline:none;transition:border-color .15s;}
    .qa-input:focus{border-color:var(--green);box-shadow:0 0 0 3px rgba(29,158,117,.1);}
    .qa-status{font-size:12px;display:flex;align-items:center;gap:5px;}
    .qa-status svg{width:14px;height:14px;fill:none;stroke-width:2;}
    .qa-status.match{color:var(--green-d);}
    .qa-status.match svg{stroke:var(--green-d);}
    .qa-status.nomatch{color:var(--orange-t);}
    .qa-status.nomatch svg{stroke:var(--orange-t);}
    .qa-status.pending{color:var(--muted);}
    .qa-status.pending svg{stroke:var(--muted);}

    /* SCORE BAR */
    .score-wrap{margin-top:1.25rem;}
    .score-lbl{display:flex;justify-content:space-between;font-size:13px;color:var(--muted);margin-bottom:6px;}
    .score-bg{height:8px;background:var(--bg);border-radius:8px;overflow:hidden;border:1px solid var(--border);}
    .score-fill{height:100%;border-radius:8px;background:var(--green);transition:width .4s;}

    /* ADMIN COMPARE */
    .compare-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px;}
    .compare-col-lbl{font-size:11px;color:var(--hint);margin-bottom:4px;}
    .compare-val{font-size:13px;color:var(--text);padding:8px 12px;background:var(--bg);border:1px solid var(--border);border-radius:8px;line-height:1.5;}

    /* INFO TABLE */
    .info-table{width:100%;border-collapse:collapse;font-size:13px;}
    .info-table td{padding:7px 0;vertical-align:middle;}
    .info-table td:first-child{color:var(--muted);display:flex;align-items:center;gap:6px;width:130px;}
    .info-table td:first-child svg{width:14px;height:14px;stroke:var(--hint);fill:none;stroke-width:2;}
    .info-table td:last-child{font-weight:500;text-align:right;}
    .info-table tr{border-bottom:1px solid var(--border);}
    .info-table tr:last-child{border-bottom:none;}

    /* SCORE BIG */
    .score-big{display:flex;align-items:center;gap:1.5rem;padding:1rem 1.25rem;background:var(--bg);border-radius:12px;margin-bottom:1.25rem;}
    .score-num{font-size:32px;font-weight:600;color:var(--green);}
    .score-desc{font-size:13px;color:var(--muted);margin-top:2px;}
    .score-min{font-size:11px;color:var(--hint);margin-top:2px;}

    /* UPLOAD */
    .upload-zone{border:1.5px dashed var(--border);border-radius:12px;padding:1.5rem;text-align:center;cursor:pointer;background:var(--bg);transition:border-color .15s;}
    .upload-zone:hover{border-color:var(--green);}
    .upload-zone svg{width:30px;height:30px;stroke:var(--hint);fill:none;stroke-width:1.5;margin-bottom:6px;}
    .upload-text{font-size:13px;color:var(--muted);}
    .upload-text span{color:var(--green);font-weight:500;}

    /* BUTTONS */
    .btn-row{display:flex;gap:10px;margin-top:1.25rem;}
    .btn-primary{flex:1;padding:11px;background:var(--green);color:#fff;border:none;border-radius:11px;font-size:14px;font-weight:600;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:background .15s;}
    .btn-primary:hover{background:var(--green-d);}
    .btn-primary:disabled{background:var(--bg);color:var(--hint);cursor:not-allowed;border:1px solid var(--border);}
    .btn-primary svg{width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;}
    .btn-danger{flex:1;padding:11px;background:var(--orange-l);color:var(--orange-t);border:1px solid var(--orange-b);border-radius:11px;font-size:14px;font-weight:600;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;}
    .btn-danger:hover{background:#F5C4B3;}
    .btn-ghost{padding:11px 18px;background:transparent;color:var(--muted);border:1px solid var(--border);border-radius:11px;font-size:14px;cursor:pointer;}
    .btn-ghost:hover{background:var(--bg);}

    /* VIEW TOGGLE */
    .view-toggle{display:flex;gap:8px;margin-bottom:1.5rem;}
    .vtab{display:flex;align-items:center;gap:7px;padding:9px 18px;border-radius:10px;font-size:14px;font-weight:500;cursor:pointer;border:1px solid var(--border);background:var(--surface);color:var(--muted);transition:all .15s;}
    .vtab.active{background:var(--green);color:#fff;border-color:var(--green);}
    .vtab svg{width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;}
    .vp{display:none;}
    .vp.active{display:block;}
  </style>
</head>
<body>
<nav>
  <a class="logo" href="{{ url('/') }}">
    <div class="logo-icon"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
    <div><div class="logo-text">Lost &amp; Found</div><div class="logo-sub">Universitas Portal</div></div>
  </a>
  <div class="nav-links">
    <a href="{{ url('/') }}">Beranda</a>
    <a href="{{ url('/verification') }}" class="active">Verifikasi</a>
    <a href="{{ url('/admin') }}">Admin</a>
</div>
</nav>

<div class="main">
  <div class="view-toggle">
    <button class="vtab active" onclick="setView('claimer',this)"><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Tampilan pengklaim</button>
    <button class="vtab" onclick="setView('admin',this)"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>Tampilan admin</button>
  </div>

  <!-- CLAIMER VIEW -->
  <div id="vp-claimer" class="vp active">
    <div class="stepper">
      <div class="step"><div class="step-dot done"><svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div><div class="step-label">Klaim</div></div>
      <div class="step-line done"></div>
      <div class="step"><div class="step-dot active">2</div><div class="step-label active">Verifikasi</div></div>
      <div class="step-line"></div>
      <div class="step"><div class="step-dot">3</div><div class="step-label">Bukti</div></div>
      <div class="step-line"></div>
      <div class="step"><div class="step-dot">4</div><div class="step-label">Approval</div></div>
    </div>

    <div class="notif warn">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      Jawab pertanyaan berikut untuk membuktikan bahwa barang ini milikmu. Jawaban akan dicocokkan dengan data penemu dan admin.
    </div>

    <div class="card">
      <div class="item-header">
        <div class="item-icon"><svg viewBox="0 0 24 24"><path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4z"/></svg></div>
        <div style="flex:1"><div class="item-name" id="item-title">Dompet kulit cokelat</div><div class="item-meta"><span>📍 Kantin Pusat</span><span>📅 3 Juni 2026</span></div></div>
        <span class="badge badge-found">Ditemukan</span>
      </div>
      <div class="card-title"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>Tanya jawab kepemilikan</div>
      <div class="qa-list">
        <div class="qa-item"><div class="qa-q"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>Apa warna bagian dalam dompet?</div><div class="qa-body"><input class="qa-input" type="text" placeholder="Tulis jawabanmu..." id="q1" oninput="checkAnswers()"><div class="qa-status pending" id="s1"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Menunggu jawaban</div></div></div>
        <div class="qa-item"><div class="qa-q"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>Ada berapa kartu di dalam dompet?</div><div class="qa-body"><input class="qa-input" type="text" placeholder="Tulis jawabanmu..." id="q2" oninput="checkAnswers()"><div class="qa-status pending" id="s2"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Menunggu jawaban</div></div></div>
        <div class="qa-item"><div class="qa-q"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>Merek atau nama yang tertera pada dompet?</div><div class="qa-body"><input class="qa-input" type="text" placeholder="Tulis jawabanmu..." id="q3" oninput="checkAnswers()"><div class="qa-status pending" id="s3"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Menunggu jawaban</div></div></div>
        <div class="qa-item"><div class="qa-q"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>Ada identitas apa di dalamnya?</div><div class="qa-body"><input class="qa-input" type="text" placeholder="cth: KTM, KTP, SIM..." id="q4" oninput="checkAnswers()"><div class="qa-status pending" id="s4"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Menunggu jawaban</div></div></div>
      </div>
      <div class="score-wrap">
        <div class="score-lbl"><span>Skor kecocokan jawaban</span><span id="score-pct">0%</span></div>
        <div class="score-bg"><div class="score-fill" id="score-fill" style="width:0%"></div></div>
      </div>
    </div>

    <div class="card">
      <div class="card-title"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>Bukti kepemilikan tambahan</div>
      <p style="font-size:13px;color:var(--muted);margin-bottom:1rem;line-height:1.6;">Upload foto atau dokumen yang membuktikan ini milikmu — foto lama bersama barang, nota pembelian, atau foto KTM.</p>
      <div class="upload-zone"><svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg><div class="upload-text"><span>Klik untuk upload</span> atau seret file ke sini</div><div style="font-size:11px;color:var(--hint);margin-top:4px">JPG, PNG, PDF — maks 10MB</div></div>
      <div class="btn-row">
        <button class="btn-ghost" onclick="window.location.href='index.html'">← Kembali</button>
        <button class="btn-primary" id="submit-btn" disabled onclick="submitClaim()"><svg viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>Kirim verifikasi</button>
      </div>
    </div>
  </div>

  <!-- ADMIN VIEW -->
  <div id="vp-admin" class="vp">
    <div class="notif success">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
      <div><strong>Klaim baru masuk</strong> — Rina Aulia mengklaim <strong>dompet kulit cokelat</strong>. Skor tanya jawab: <strong>75%</strong>. Menunggu keputusan admin &amp; penemu.</div>
    </div>

    <div class="card">
      <div class="item-header">
        <div class="item-icon"><svg viewBox="0 0 24 24"><path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4z"/></svg></div>
        <div style="flex:1"><div class="item-name">Dompet kulit cokelat</div><div class="item-meta"><span>📍 Kantin Pusat</span><span>📅 3 Juni 2026</span></div></div>
        <span class="badge" style="background:var(--amber-l);color:var(--amber-t);">Menunggu approval</span>
      </div>
      <div class="card-title"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>Hasil validasi data</div>
      <div class="qa-list" style="margin-bottom:1.25rem;">
        <div class="qa-item"><div class="qa-q"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>Warna bagian dalam dompet?</div><div class="qa-body"><div class="compare-grid"><div><div class="compare-col-lbl">Jawaban pengklaim</div><div class="compare-val">Merah marun</div></div><div><div class="compare-col-lbl">Data penemu</div><div class="compare-val">Merah tua / maroon</div></div></div><div class="qa-status match"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Cocok</div></div></div>
        <div class="qa-item"><div class="qa-q"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>Jumlah kartu di dalam?</div><div class="qa-body"><div class="compare-grid"><div><div class="compare-col-lbl">Jawaban pengklaim</div><div class="compare-val">4 kartu</div></div><div><div class="compare-col-lbl">Data penemu</div><div class="compare-val">3 kartu</div></div></div><div class="qa-status nomatch"><svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>Tidak cocok</div></div></div>
        <div class="qa-item"><div class="qa-q"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>Merek dompet?</div><div class="qa-body"><div class="compare-grid"><div><div class="compare-col-lbl">Jawaban pengklaim</div><div class="compare-val">Fossil</div></div><div><div class="compare-col-lbl">Data penemu</div><div class="compare-val">Fossil</div></div></div><div class="qa-status match"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Cocok</div></div></div>
        <div class="qa-item"><div class="qa-q"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>Identitas di dalamnya?</div><div class="qa-body"><div class="compare-grid"><div><div class="compare-col-lbl">Jawaban pengklaim</div><div class="compare-val">KTM dan KTP</div></div><div><div class="compare-col-lbl">Data penemu</div><div class="compare-val">KTM, KTP</div></div></div><div class="qa-status match"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Cocok</div></div></div>
      </div>

      <div class="score-big">
        <div><div class="score-num">75%</div><div class="score-desc">Skor kecocokan (3/4 jawaban cocok)</div><div class="score-min">Ambang batas minimal: 60%</div></div>
        <div style="flex:1"><div class="score-bg"><div class="score-fill" style="width:75%"></div></div></div>
      </div>

      <div class="card-title" style="margin-bottom:1rem;"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Info pengklaim</div>
      <table class="info-table" style="margin-bottom:1.25rem;">
        <tr><td><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>Nama</td><td>Rina Aulia Putri</td></tr>
        <tr><td><svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>NIM</td><td>2211010042</td></tr>
        <tr><td><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="9" y1="3" x2="9" y2="21"/></svg>Prodi</td><td>Teknik Informatika</td></tr>
        <tr><td><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 10.23 19.79 19.79 0 0 1 1.61 1.68a2 2 0 0 1 1.97-2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 7a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>WhatsApp</td><td style="color:var(--green)">0812-xxxx-3847</td></tr>
        <tr><td><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>Bukti</td><td style="color:#185FA5;cursor:pointer">foto-bukti.jpg ↗</td></tr>
      </table>

      <div class="btn-row">
        <button class="btn-danger" onclick="decide('reject')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>Tolak klaim</button>
        <button class="btn-primary" onclick="decide('approve')"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Setujui &amp; hubungi penemu</button>
      </div>
      <div id="decision-result" style="display:none;margin-top:1rem;"></div>
    </div>
  </div>
</div>

<script>
const answers={q1:'merah',q2:'3',q3:'fossil',q4:'ktm'};
function checkAnswers(){
  let filled=0;
  [1,2,3,4].forEach(n=>{
    const val=document.getElementById('q'+n).value.trim().toLowerCase();
    const s=document.getElementById('s'+n);
    const checkSVG='<svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>';
    const xSVG='<svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>';
    const clkSVG='<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>';
    if(!val){s.className='qa-status pending';s.innerHTML=clkSVG+'Menunggu jawaban';return;}
    filled++;
    const key=Object.values(answers)[n-1];
    if(val.includes(key)||key.includes(val)){s.className='qa-status match';s.innerHTML=checkSVG+'Terlihat cocok';}
    else{s.className='qa-status nomatch';s.innerHTML=xSVG+'Perlu ditinjau admin';}
  });
  const pct=Math.round((filled/4)*100);
  document.getElementById('score-pct').textContent=pct+'%';
  document.getElementById('score-fill').style.width=pct+'%';
  document.getElementById('submit-btn').disabled=filled<4;
}
function setView(v,el){document.querySelectorAll('.vtab').forEach(t=>t.classList.remove('active'));document.querySelectorAll('.vp').forEach(p=>p.classList.remove('active'));el.classList.add('active');document.getElementById('vp-'+v).classList.add('active');}
function submitClaim(){alert('Verifikasi terkirim! Menunggu review admin dan penemu.');window.location.href='admin.html';}
function decide(action){
  const el=document.getElementById('decision-result');
  el.style.display='block';
  if(action==='approve'){el.innerHTML='<div class="notif success"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><polyline points="20 6 9 17 4 12"/></svg><div>Klaim <strong>disetujui</strong>. Notifikasi dikirim ke penemu dan pengklaim via WhatsApp untuk penyerahan barang. <a href="pickup.html" style="color:var(--green-d);font-weight:600;">Lihat lokasi pengambilan →</a></div></div>';}
  else{el.innerHTML='<div class="notif warn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg><div>Klaim <strong>ditolak</strong>. Pengklaim akan diberitahu dan dapat mengajukan banding dengan bukti tambahan.</div></div>';}
}
const params=new URLSearchParams(window.location.search);
const itemName=params.get('item');
if(itemName&&document.getElementById('item-title'))document.getElementById('item-title').textContent=itemName;
</script>
</body>
</html>