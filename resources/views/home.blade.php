<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lost & Found — Kampus</title>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --green:   #1D9E75; --green-d: #0F6E56; --green-l: #E1F5EE; --green-b: #9FE1CB;
      --orange-l:#FAECE7; --orange-t:#993C1D;
      --bg: #F7F9F8; --surface: #FFFFFF; --border: #E2E8E5;
      --text: #1A1F1C; --muted: #6B7C74; --hint: #A0AFA8;
    }
    body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }
    nav { background: var(--surface); border-bottom: 1px solid var(--border); padding: 0 2rem; display: flex; align-items: center; justify-content: space-between; height: 60px; position: sticky; top: 0; z-index: 100; }
    .logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
    .logo-icon { width: 36px; height: 36px; background: var(--green); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
    .logo-icon svg { width: 20px; height: 20px; stroke: #fff; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
    .logo-text { font-size: 16px; font-weight: 600; color: var(--text); }
    .logo-sub  { font-size: 10px; color: var(--muted); letter-spacing: .05em; text-transform: uppercase; }
    .nav-links { display: flex; align-items: center; gap: 1.5rem; }
    .nav-links a { font-size: 14px; color: var(--muted); text-decoration: none; }
    .nav-links a:hover { color: var(--text); }
    .nav-links a.active { color: var(--green); font-weight: 500; }
    .btn-login { background: var(--green); color: #fff; border: none; border-radius: 8px; padding: 8px 18px; font-size: 14px; font-weight: 500; cursor: pointer; }
    .btn-login:hover { background: var(--green-d); }
    .hero { background: var(--surface); border-bottom: 1px solid var(--border); padding: 3rem 2rem 2.5rem; text-align: center; }
    .hero-badge { display: inline-flex; align-items: center; gap: 6px; background: var(--green-l); color: var(--green-d); font-size: 12px; font-weight: 500; padding: 5px 14px; border-radius: 20px; margin-bottom: 1.25rem; }
    .hero h1 { font-size: 36px; font-weight: 600; line-height: 1.2; margin-bottom: .75rem; }
    .hero h1 span { color: var(--green); }
    .hero p { font-size: 15px; color: var(--muted); max-width: 460px; margin: 0 auto 2rem; line-height: 1.7; }
    .stats { display: flex; gap: 3rem; justify-content: center; }
    .stat-num { font-size: 26px; font-weight: 600; color: var(--green); }
    .stat-lbl { font-size: 12px; color: var(--muted); margin-top: 2px; }
    .main { max-width: 860px; margin: 0 auto; padding: 2rem; }
    .tabs { display: flex; gap: 8px; margin-bottom: 1.5rem; }
    .tab { display: flex; align-items: center; gap: 7px; padding: 9px 20px; border-radius: 10px; font-size: 14px; font-weight: 500; cursor: pointer; border: 1px solid var(--border); background: var(--surface); color: var(--muted); transition: all .15s; }
    .tab.active { background: var(--green); color: #fff; border-color: var(--green); }
    .tab:hover:not(.active) { background: var(--bg); color: var(--text); }
    .panel { display: none; }
    .panel.active { display: block; }
    .form-card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 1.5rem; }
    .form-heading { font-size: 15px; font-weight: 600; color: var(--text); display: flex; align-items: center; gap: 8px; margin-bottom: 1.25rem; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .form-group { display: flex; flex-direction: column; gap: 6px; }
    .form-group.full { grid-column: 1 / -1; }
    label { font-size: 13px; font-weight: 500; color: var(--muted); }
    input, select, textarea { font-family: 'Inter', sans-serif; font-size: 14px; color: var(--text); background: var(--bg); border: 1px solid var(--border); border-radius: 9px; padding: 10px 13px; width: 100%; outline: none; transition: border-color .15s; }
    input:focus, select:focus, textarea:focus { border-color: var(--green); box-shadow: 0 0 0 3px rgba(29,158,117,.12); }
    textarea { resize: vertical; min-height: 88px; }
    .upload-zone { border: 1.5px dashed var(--border); border-radius: 12px; padding: 1.5rem; text-align: center; cursor: pointer; background: var(--bg); transition: border-color .15s; }
    .upload-zone:hover { border-color: var(--green); }
    .upload-zone svg { width: 32px; height: 32px; stroke: var(--hint); fill: none; stroke-width: 1.5; margin-bottom: 8px; }
    .upload-text { font-size: 13px; color: var(--muted); }
    .upload-text span { color: var(--green); font-weight: 500; }
    .btn-submit { width: 100%; margin-top: 1.25rem; padding: 12px; background: var(--green); color: #fff; border: none; border-radius: 11px; font-size: 15px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: background .15s; }
    .btn-submit:hover { background: var(--green-d); }
    .recent-section { margin-top: 2.5rem; }
    .section-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; }
    .section-header h2 { font-size: 17px; font-weight: 600; }
    .search-wrap { display: flex; align-items: center; gap: 8px; background: var(--surface); border: 1px solid var(--border); border-radius: 9px; padding: 8px 13px; }
    .search-wrap input { background: transparent; border: none; font-size: 13px; padding: 0; box-shadow: none; width: 180px; }
    .search-wrap svg { width: 16px; height: 16px; stroke: var(--hint); fill: none; stroke-width: 2; flex-shrink: 0; }
    .items-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 14px; }
    .item-card { background: var(--surface); border: 1px solid var(--border); border-radius: 14px; padding: 1rem; cursor: pointer; transition: border-color .15s, transform .1s; }
    .item-card:hover { border-color: var(--green-b); transform: translateY(-2px); }
    .item-thumb { height: 96px; background: var(--bg); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; }
    .item-thumb svg { width: 36px; height: 36px; stroke: var(--hint); fill: none; stroke-width: 1.5; }
    .item-name { font-size: 14px; font-weight: 500; color: var(--text); margin-bottom: 4px; }
    .item-date { font-size: 12px; color: var(--muted); display: flex; align-items: center; gap: 4px; margin-bottom: 8px; }
    .badge { display: inline-block; font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; }
    .badge-lost  { background: var(--orange-l); color: var(--orange-t); }
    .badge-found { background: var(--green-l);  color: var(--green-d); }
    .item-loc { font-size: 12px; color: var(--hint); display: flex; align-items: center; gap: 4px; margin-top: 6px; }
    @media (max-width: 600px) { .form-grid { grid-template-columns: 1fr; } .stats { gap: 1.5rem; } nav { padding: 0 1rem; } .nav-links a { display: none; } }
  </style>
</head>
<body>
<nav>
  <a class="logo" href="index.html">
    <div class="logo-icon"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
    <div><div class="logo-text">Lost &amp; Found</div><div class="logo-sub">UIN AR-RANIRY</div></div>
  </a>
  <div class="nav-links">
    <a href="{{ route('home') }}" class="active">Beranda</a>
    <a href="{{ route('verification') }}">Verifikasi</a>
    <a href="{{ route('admin')}}">Admin</a>
    <button class="btn-login">Masuk</button>
  </div>
</nav>

<section class="hero">
  <div class="hero-badge"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg> Platform resmi kampus</div>
  <h1>Temukan barang<br><span>yang kamu cari</span></h1>
  <p>Laporkan barang hilang atau yang kamu temukan di lingkungan kampus. Kami bantu pertemukan kembali.</p>
  <div class="stats">
    <div><div class="stat-num">142</div><div class="stat-lbl">Barang dilaporkan</div></div>
    <div><div class="stat-num">98</div><div class="stat-lbl">Berhasil dikembalikan</div></div>
    <div><div class="stat-num">69%</div><div class="stat-lbl">Tingkat keberhasilan</div></div>
  </div>
</section>

<div class="main">
  <div class="tabs">
    <button class="tab active" onclick="switchTab('lost',this)"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>Lapor Barang Hilang</button>
    <button class="tab" onclick="switchTab('found',this)"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>Lapor Barang Ditemukan</button>
  </div>

  <div id="panel-lost" class="panel active">
    <div class="form-card">
      <div class="form-heading"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#D85A30" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>Detail barang yang hilang</div>
      <div class="form-grid">
        <div class="form-group"><label>Nama barang</label><input type="text" placeholder="cth: Dompet hitam, Laptop Asus..."></div>
        <div class="form-group"><label>Kategori</label><select><option value="">Pilih kategori</option><option>Elektronik</option><option>Dokumen / Kartu</option><option>Pakaian &amp; Aksesoris</option><option>Tas &amp; Dompet</option><option>Kunci</option><option>Lainnya</option></select></div>
        <div class="form-group"><label>Lokasi terakhir terlihat</label><input type="text" placeholder="cth: Gedung A, Kantin, Perpustakaan..."></div>
        <div class="form-group"><label>Tanggal hilang</label><input type="date"></div>
        <div class="form-group full"><label>Deskripsi (ciri khusus, warna, dll)</label><textarea placeholder="Jelaskan ciri-ciri barang agar mudah dikenali..."></textarea></div>
        <div class="form-group full"><label>Foto barang (jika ada)</label><div class="upload-zone" onclick="document.getElementById('file-lost').click()"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg><div class="upload-text"><span>Klik untuk upload</span> atau seret file ke sini</div><div style="font-size:11px;color:var(--hint);margin-top:4px">PNG, JPG hingga 5MB</div></div><input id="file-lost" type="file" accept="image/*" style="display:none;"></div>
        <div class="form-group"><label>Nama pelapor</label><input type="text" placeholder="Nama lengkap"></div>
      </div>
      <button class="btn-submit" onclick="submitForm()"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>Kirim Laporan</button>
    </div>
  </div>

  <div id="panel-found" class="panel">
    <div class="form-card">
      <div class="form-heading"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1D9E75" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>Detail barang yang ditemukan</div>
      <div class="form-grid">
        <div class="form-group"><label>Nama barang</label><input type="text" placeholder="cth: Kunci motor, Kartu mahasiswa..."></div>
        <div class="form-group"><label>Kategori</label><select><option value="">Pilih kategori</option><option>Elektronik</option><option>Dokumen / Kartu</option><option>Pakaian &amp; Aksesoris</option><option>Tas &amp; Dompet</option><option>Kunci</option><option>Lainnya</option></select></div>
        <div class="form-group"><label>Lokasi ditemukan</label><input type="text" placeholder="cth: Mushola Gedung B, Parkiran..."></div>
        <div class="form-group"><label>Tanggal ditemukan</label><input type="date"></div>
        <div class="form-group full"><label>Deskripsi barang</label><textarea placeholder="Jelaskan kondisi dan ciri-ciri barang yang ditemukan..."></textarea></div>
        <div class="form-group full"><label>Foto barang</label><div class="upload-zone" onclick="document.getElementById('file-found').click()"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg><div class="upload-text"><span>Klik untuk upload</span> atau seret file ke sini</div><div style="font-size:11px;color:var(--hint);margin-top:4px">PNG, JPG hingga 5MB</div></div><input id="file-found" type="file" accept="image/*" style="display:none;"></div>
        <div class="form-group"><label>Nama penemu</label><input type="text" placeholder="Nama lengkap"></div>      </div>
      <button class="btn-submit" onclick="submitForm()"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>Kirim Laporan</button>
    </div>
  </div>

  <div class="recent-section">
    <div class="section-header">
      <h2>Laporan terbaru</h2>
      <div class="search-wrap"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg><input type="text" placeholder="Cari barang..." oninput="filterItems(this.value)"></div>
    </div>
    <div class="items-grid" id="items-grid"></div>
  </div>
</div>

<script>
const items=[{name:'Dompet kulit cokelat',date:'3 Jun 2026',status:'lost',loc:'Kantin Pusat',icon:'wallet'},{name:'Kartu Tanda Mahasiswa',date:'4 Jun 2026',status:'found',loc:'Perpustakaan Lt. 2',icon:'card'},{name:'Charger laptop hitam',date:'5 Jun 2026',status:'found',loc:'Ruang Kelas B204',icon:'laptop'},{name:'Kunci motor Honda',date:'5 Jun 2026',status:'lost',loc:'Parkiran Gedung A',icon:'key'},{name:'Tas ransel biru navy',date:'6 Jun 2026',status:'lost',loc:'Aula Serbaguna',icon:'bag'},{name:'Earphone putih',date:'7 Jun 2026',status:'found',loc:'Mushola Gedung C',icon:'earphone'}];
const icons={wallet:'<path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4z"/>',card:'<rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/>',laptop:'<rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>',key:'<path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/>',bag:'<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>',earphone:'<path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>'};
function renderItems(list){document.getElementById('items-grid').innerHTML=list.map(it=>`<div class="item-card" onclick="window.location.href='/verification'"><div class="item-thumb"><svg viewBox="0 0 24 24">${icons[it.icon]}</svg></div><div class="item-name">${it.name}</div><div class="item-date"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>${it.date}</div><span class="badge badge-${it.status}">${it.status==='lost'?'Hilang':'Ditemukan'}</span><div class="item-loc"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>${it.loc}</div></div>`).join('');}
function filterItems(q){renderItems(items.filter(i=>i.name.toLowerCase().includes(q.toLowerCase())||i.loc.toLowerCase().includes(q.toLowerCase())));}
function switchTab(type,el){document.querySelectorAll('.tab').forEach(t=>t.classList.remove('active'));document.querySelectorAll('.panel').forEach(p=>p.classList.remove('active'));el.classList.add('active');document.getElementById('panel-'+type).classList.add('active');}
function submitForm(){alert('Laporan berhasil dikirim.');}
renderItems(items);
</script>
</body>
</html>