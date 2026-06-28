<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Admin — Lost &amp; Found</title>
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
    .main{max-width:1000px;margin:0 auto;padding:2rem;}
    h1{font-size:22px;font-weight:600;margin-bottom:.25rem;}
    .page-sub{font-size:14px;color:var(--muted);margin-bottom:2rem;}

    /* STATS */
    .stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:2rem;}
    .stat-card{background:var(--surface);border:1px solid var(--border);border-radius:14px;padding:1.25rem;}
    .stat-label{font-size:12px;color:var(--muted);font-weight:500;margin-bottom:.5rem;display:flex;align-items:center;gap:6px;}
    .stat-label svg{width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;}
    .stat-value{font-size:28px;font-weight:600;}
    .stat-sub{font-size:12px;color:var(--muted);margin-top:2px;}
    .stat-green .stat-value{color:var(--green);}
    .stat-orange .stat-value{color:#D85A30;}
    .stat-blue .stat-value{color:#185FA5;}
    .stat-amber .stat-value{color:#854F0B;}

    /* TABLE */
    .table-card{background:var(--surface);border:1px solid var(--border);border-radius:16px;overflow:hidden;}
    .table-header{padding:1rem 1.5rem;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
    .table-title{font-size:15px;font-weight:600;}
    .filter-row{display:flex;gap:8px;align-items:center;}
    .filter-select{font-family:'Inter',sans-serif;font-size:13px;color:var(--text);background:var(--bg);border:1px solid var(--border);border-radius:8px;padding:7px 12px;outline:none;cursor:pointer;}
    .search-wrap{display:flex;align-items:center;gap:7px;background:var(--bg);border:1px solid var(--border);border-radius:8px;padding:7px 12px;}
    .search-wrap input{background:transparent;border:none;font-size:13px;outline:none;width:160px;color:var(--text);}
    .search-wrap svg{width:14px;height:14px;stroke:var(--hint);fill:none;stroke-width:2;}
    table{width:100%;border-collapse:collapse;font-size:13px;}
    th{padding:10px 16px;text-align:left;font-size:11px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.04em;border-bottom:1px solid var(--border);background:var(--bg);}
    td{padding:13px 16px;border-bottom:1px solid var(--border);vertical-align:middle;}
    tr:last-child td{border-bottom:none;}
    tr:hover td{background:var(--bg);}
    .badge{display:inline-block;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;}
    .b-lost{background:var(--orange-l);color:var(--orange-t);}
    .b-found{background:var(--green-l);color:var(--green-d);}
    .b-pending{background:var(--amber-l);color:var(--amber-t);}
    .b-approved{background:var(--green-l);color:var(--green-d);}
    .b-rejected{background:var(--orange-l);color:var(--orange-t);}
    .b-new{background:var(--blue-l);color:var(--blue-t);}
    .btn-sm{font-size:12px;padding:5px 12px;border-radius:7px;border:none;cursor:pointer;font-weight:500;font-family:'Inter',sans-serif;}
    .btn-green{background:var(--green);color:#fff;}
    .btn-green:hover{background:var(--green-d);}
    .btn-outline{background:transparent;border:1px solid var(--border);color:var(--muted);}
    .btn-outline:hover{background:var(--bg);}
    .btn-red{background:var(--orange-l);color:var(--orange-t);border:1px solid var(--orange-b);}
    .avatar-sm{width:32px;height:32px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-size:11px;font-weight:600;vertical-align:middle;margin-right:8px;}
    .item-cell{display:flex;align-items:center;gap:10px;}
    .item-thumb-sm{width:34px;height:34px;background:var(--bg);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;border:1px solid var(--border);}
    .item-thumb-sm svg{width:18px;height:18px;stroke:var(--muted);fill:none;stroke-width:1.5;}
    .actions{display:flex;gap:6px;}
    @media(max-width:768px){.stats-grid{grid-template-columns:1fr 1fr;}.table-header{flex-direction:column;align-items:flex-start;}}
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
    <a href="{{ url('/verification') }}">Verifikasi</a>
    <a href="{{ url('/admin') }}" class="active">Admin</a>
    <a href="{{ url('/pickup') }}">Lokasi</a>
</div>
  </div>
</nav>

<div class="main">
  <h1>Dashboard Admin</h1>
  <p class="page-sub">Kelola semua laporan, klaim, dan proses verifikasi barang hilang &amp; ditemukan.</p>

  <div class="stats-grid">
    <div class="stat-card stat-green">
      <div class="stat-label"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>Total laporan</div>
      <div class="stat-value">142</div>
      <div class="stat-sub">+8 minggu ini</div>
    </div>
    <div class="stat-card stat-orange">
      <div class="stat-label"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>Barang hilang</div>
      <div class="stat-value">67</div>
      <div class="stat-sub">Belum ditemukan</div>
    </div>
    <div class="stat-card stat-blue">
      <div class="stat-label"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Berhasil kembali</div>
      <div class="stat-value">98</div>
      <div class="stat-sub">69% tingkat sukses</div>
    </div>
    <div class="stat-card stat-amber">
      <div class="stat-label"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Menunggu review</div>
      <div class="stat-value">7</div>
      <div class="stat-sub">Perlu tindakan</div>
    </div>
  </div>

  <div class="table-card">
    <div class="table-header">
      <div class="table-title">Semua laporan</div>
      <div class="filter-row">
        <select class="filter-select" onchange="filterTable(this.value,'status')">
          <option value="">Semua status</option>
          <option value="Hilang">Hilang</option>
          <option value="Ditemukan">Ditemukan</option>
          <option value="Proses klaim">Proses klaim</option>
          <option value="Selesai">Selesai</option>
        </select>
        <select class="filter-select" onchange="filterTable(this.value,'cat')">
          <option value="">Semua kategori</option>
          <option value="Elektronik">Elektronik</option>
          <option value="Dokumen">Dokumen</option>
          <option value="Dompet">Dompet</option>
          <option value="Kunci">Kunci</option>
        </select>
        <div class="search-wrap">
          <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <input type="text" placeholder="Cari nama barang..." oninput="searchTable(this.value)">
        </div>
      </div>
    </div>
    <div style="overflow-x:auto;">
      <table id="main-table">
        <thead>
          <tr>
            <th>Barang</th>
            <th>Kategori</th>
            <th>Pelapor</th>
            <th>Lokasi</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="table-body"></tbody>
      </table>
    </div>
  </div>
</div>

<script>
const data=[
  {item:'Dompet kulit cokelat',cat:'Dompet',icon:'wallet',pelapor:'Rina Aulia',nim:'2211010042',loc:'Kantin Pusat',date:'3 Jun 2026',status:'Proses klaim'},
  {item:'Kartu Tanda Mahasiswa',cat:'Dokumen',icon:'card',pelapor:'Budi Santoso',nim:'1910050017',loc:'Perpustakaan Lt. 2',date:'4 Jun 2026',status:'Ditemukan'},
  {item:'Charger laptop hitam',cat:'Elektronik',icon:'laptop',pelapor:'Dian Pratiwi',nim:'2010030055',loc:'Ruang Kelas B204',date:'5 Jun 2026',status:'Selesai'},
  {item:'Kunci motor Honda',cat:'Kunci',icon:'key',pelapor:'Ahmad Fauzi',nim:'2111020034',loc:'Parkiran Gedung A',date:'5 Jun 2026',status:'Hilang'},
  {item:'Tas ransel biru navy',cat:'Dompet',icon:'bag',pelapor:'Sari Dewi',nim:'2210040021',loc:'Aula Serbaguna',date:'6 Jun 2026',status:'Hilang'},
  {item:'Earphone putih',cat:'Elektronik',icon:'earphone',pelapor:'Rizky Maulana',nim:'2310010088',loc:'Mushola Gedung C',date:'7 Jun 2026',status:'Ditemukan'},
  {item:'Laptop Lenovo IdeaPad',cat:'Elektronik',icon:'laptop',pelapor:'Fitri Handayani',nim:'2011030067',loc:'Lab Komputer A',date:'8 Jun 2026',status:'Proses klaim'},
  {item:'Dompet merah muda',cat:'Dompet',icon:'wallet',pelapor:'Mega Putri',nim:'2210060044',loc:'Kantin Selatan',date:'9 Jun 2026',status:'Selesai'},
];
const icons={wallet:'<path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/>',card:'<rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/>',laptop:'<rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>',key:'<path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777z"/>',bag:'<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/>',earphone:'<path d="M3 18v-6a9 9 0 0 1 18 0v6"/>'};
const badgeClass={Hilang:'b-lost',Ditemukan:'b-found','Proses klaim':'b-pending',Selesai:'b-approved'};
let filtered=[...data];
function renderTable(list){
  document.getElementById('table-body').innerHTML=list.map((r,i)=>`<tr>
    <td><div class="item-cell"><div class="item-thumb-sm"><svg viewBox="0 0 24 24">${icons[r.icon]}</svg></div><div><div style="font-weight:500">${r.item}</div></div></div></td>
    <td>${r.cat}</td>
    <td><span class="avatar-sm av-green" style="background:var(--green-l);color:var(--green-d)">${r.pelapor.split(' ').map(w=>w[0]).slice(0,2).join('')}</span>${r.pelapor}<br><span style="font-size:11px;color:var(--hint)">${r.nim}</span></td>
    <td>${r.loc}</td>
    <td>${r.date}</td>
    <td><span class="badge ${badgeClass[r.status]||'b-new'}">${r.status}</span></td>
    <td><div class="actions">
      <button class="btn-sm btn-outline" onclick="viewItem(${i})">Detail</button>
      ${r.status==='Proses klaim'?'<button class="btn-sm btn-green" onclick="window.location.href=\'verification.html\'">Review</button>':''}
      ${r.status==='Hilang'||r.status==='Ditemukan'?'<button class="btn-sm btn-outline" onclick="markDone('+i+')">Tandai selesai</button>':''}
    </div></td>
  </tr>`).join('');}
function filterTable(val,type){
  if(type==='status')filtered=val?data.filter(r=>r.status===val):[...data];
  if(type==='cat')filtered=val?data.filter(r=>r.cat.includes(val)):[...data];
  renderTable(filtered);
}
function searchTable(q){renderTable(q?data.filter(r=>r.item.toLowerCase().includes(q.toLowerCase())||r.pelapor.toLowerCase().includes(q.toLowerCase())):[...data]);}
function viewItem(i){alert('Detail: '+data[i].item+'\nPelapor: '+data[i].pelapor+'\nLokasi: '+data[i].loc+'\nStatus: '+data[i].status);}
function markDone(i){data[i].status='Selesai';renderTable(filtered);}
renderTable(data);
</script>
</body>
</html>


