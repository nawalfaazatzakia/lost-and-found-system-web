<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lokasi Pengambilan — Lost &amp; Found</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
  <!--
    GOOGLE MAPS SETUP:
    1. Buka https://console.cloud.google.com
    2. Buat project baru / pilih project
    3. Aktifkan: Maps JavaScript API, Directions API, Geocoding API
    4. Buat API Key di Credentials
    5. Ganti YOUR_GOOGLE_MAPS_API_KEY di bawah dengan key kamu
    6. Ganti FINDER_LAT, FINDER_LNG dengan koordinat GPS penemu (ambil dari profil atau input saat lapor)
  -->
  <style>
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
    :root{--green:#1D9E75;--green-d:#0F6E56;--green-l:#E1F5EE;--green-b:#9FE1CB;--blue-l:#E6F1FB;--blue-t:#0C447C;--blue:#185FA5;--bg:#F7F9F8;--surface:#FFFFFF;--border:#E2E8E5;--text:#1A1F1C;--muted:#6B7C74;--hint:#A0AFA8;}
    body{font-family:'Inter',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;}
    nav{background:var(--surface);border-bottom:1px solid var(--border);padding:0 2rem;display:flex;align-items:center;justify-content:space-between;height:60px;position:sticky;top:0;z-index:200;}
    .logo{display:flex;align-items:center;gap:10px;text-decoration:none;}
    .logo-icon{width:36px;height:36px;background:var(--green);border-radius:10px;display:flex;align-items:center;justify-content:center;}
    .logo-icon svg{width:20px;height:20px;stroke:#fff;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;}
    .logo-text{font-size:16px;font-weight:600;color:var(--text);}
    .logo-sub{font-size:10px;color:var(--muted);letter-spacing:.05em;text-transform:uppercase;}
    .nav-links{display:flex;align-items:center;gap:1.5rem;}
    .nav-links a{font-size:14px;color:var(--muted);text-decoration:none;}
    .nav-links a.active{color:var(--green);font-weight:500;}
    .main{max-width:860px;margin:0 auto;padding:2rem;}

    .notif-approve{display:flex;align-items:flex-start;gap:12px;background:var(--green-l);border:1px solid var(--green-b);border-radius:14px;padding:14px 18px;margin-bottom:1.5rem;}
    .notif-approve svg{flex-shrink:0;width:22px;height:22px;stroke:var(--green-d);fill:none;stroke-width:2;margin-top:1px;}
    .notif-title{font-size:14px;font-weight:600;color:var(--green-d);}
    .notif-sub{font-size:13px;color:var(--green-d);margin-top:2px;opacity:.8;}

    .two-col{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.25rem;}
    .card{background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:1.25rem;}
    .person-row{display:flex;align-items:center;gap:10px;padding-bottom:1rem;border-bottom:1px solid var(--border);margin-bottom:1rem;}
    .avatar{width:42px;height:42px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;flex-shrink:0;}
    .av-green{background:var(--green-l);color:var(--green-d);}
    .av-blue{background:var(--blue-l);color:var(--blue-t);}
    .person-name{font-size:14px;font-weight:600;color:var(--text);}
    .person-role{font-size:12px;color:var(--muted);margin-top:2px;}
    .info-row{display:flex;align-items:center;gap:8px;font-size:13px;color:var(--muted);padding:5px 0;border-bottom:1px solid var(--border);}
    .info-row:last-child{border-bottom:none;}
    .info-row svg{width:14px;height:14px;stroke:var(--hint);fill:none;stroke-width:2;flex-shrink:0;}
    .info-val{margin-left:auto;font-weight:500;color:var(--text);font-size:13px;}
    .info-val.green{color:var(--green-d);}

    /* MAP */
    .map-card{background:var(--surface);border:1px solid var(--border);border-radius:16px;overflow:hidden;margin-bottom:1.25rem;}
    .map-header{padding:14px 18px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
    .map-title{font-size:15px;font-weight:600;display:flex;align-items:center;gap:8px;}
    .map-title svg{width:20px;height:20px;stroke:var(--green);fill:none;stroke-width:2;}
    .map-badge{font-size:11px;font-weight:600;padding:4px 12px;border-radius:20px;background:var(--green-l);color:var(--green-d);}
    #map{width:100%;height:360px;background:var(--bg);}
    .map-placeholder{width:100%;height:360px;background:var(--bg);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;}
    .map-placeholder svg{width:40px;height:40px;stroke:var(--hint);fill:none;stroke-width:1.5;}
    .map-placeholder p{font-size:13px;color:var(--muted);text-align:center;max-width:300px;line-height:1.6;}
    .map-placeholder code{font-size:12px;background:var(--border);padding:2px 8px;border-radius:4px;color:var(--text);}
    .map-footer{padding:12px 18px;display:flex;gap:8px;align-items:center;background:var(--bg);border-top:1px solid var(--border);flex-wrap:wrap;}
    .map-addr{font-size:13px;color:var(--muted);display:flex;align-items:center;gap:6px;flex:1;min-width:180px;}
    .map-addr svg{width:14px;height:14px;stroke:var(--green);fill:none;stroke-width:2;flex-shrink:0;}
    .map-addr strong{color:var(--text);}
    .btn-maps{display:flex;align-items:center;gap:6px;padding:9px 16px;background:var(--green);color:#fff;border:none;border-radius:9px;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;}
    .btn-maps:hover{background:var(--green-d);}
    .btn-nav{display:flex;align-items:center;gap:6px;padding:9px 16px;background:var(--blue-l);color:var(--blue-t);border:none;border-radius:9px;font-size:13px;font-weight:600;cursor:pointer;}
    .btn-nav:hover{background:#B5D4F4;}
    .btn-nav svg,.btn-maps svg{width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:2;}

    .dist-strip{display:flex;gap:1.5rem;padding:12px 18px;background:var(--surface);border-top:1px solid var(--border);flex-wrap:wrap;}
    .dist-item{display:flex;align-items:center;gap:7px;font-size:13px;color:var(--muted);}
    .dist-item svg{width:15px;height:15px;stroke:var(--hint);fill:none;stroke-width:2;}
    .dist-item strong{color:var(--text);}

    /* CHAT */
    .chat-card{background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:1.25rem;}
    .chat-title{font-size:15px;font-weight:600;display:flex;align-items:center;gap:8px;margin-bottom:1.25rem;}
    .chat-title svg{width:20px;height:20px;stroke:var(--green);fill:none;stroke-width:2;}
    .chat-msgs{display:flex;flex-direction:column;gap:12px;margin-bottom:1rem;max-height:320px;overflow-y:auto;padding-right:4px;}
    .bubble-row{display:flex;gap:8px;align-items:flex-end;}
    .bubble-row.right{flex-direction:row-reverse;}
    .bav{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:600;flex-shrink:0;}
    .bubble{max-width:75%;padding:10px 14px;border-radius:14px;font-size:13px;line-height:1.6;}
    .bubble-left{background:var(--bg);color:var(--text);border-radius:4px 14px 14px 14px;border:1px solid var(--border);}
    .bubble-right{background:var(--green);color:#fff;border-radius:14px 4px 14px 14px;}
    .bubble-time{font-size:11px;color:var(--hint);margin-top:3px;}
    .bubble-loc-chip{display:inline-flex;align-items:center;gap:5px;padding:5px 10px;background:rgba(255,255,255,.18);border-radius:8px;margin-top:6px;font-size:12px;}
    .bubble-loc-chip-left{display:inline-flex;align-items:center;gap:5px;padding:5px 10px;background:var(--surface);border:1px solid var(--border);border-radius:8px;margin-top:6px;font-size:12px;color:var(--text);}
    .bubble-loc-chip svg,.bubble-loc-chip-left svg{width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2;}
    .chat-input-row{display:flex;gap:8px;}
    .chat-input{flex:1;font-family:'Inter',sans-serif;font-size:13px;padding:10px 14px;border-radius:11px;border:1px solid var(--border);background:var(--bg);color:var(--text);outline:none;transition:border-color .15s;}
    .chat-input:focus{border-color:var(--green);box-shadow:0 0 0 3px rgba(29,158,117,.1);}
    .chat-send{width:42px;height:42px;background:var(--green);border:none;border-radius:11px;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;}
    .chat-send:hover{background:var(--green-d);}
    .chat-send svg{width:18px;height:18px;stroke:#fff;fill:none;stroke-width:2;}

    @media(max-width:600px){.two-col{grid-template-columns:1fr;}.dist-strip{gap:.75rem;}.map-footer{flex-direction:column;align-items:stretch;}.btn-maps,.btn-nav{justify-content:center;}}
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
    <a href="{{ url('/admin') }}">Admin</a>
    <a href="{{ url('/pickup') }}" class="active">Lokasi</a>
  </div>
</nav>

<div class="main">
  <div class="notif-approve">
    <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
    <div>
      <div class="notif-title">Klaim disetujui oleh penemu!</div>
      <div class="notif-sub">Budi Santoso menyetujui klaim kamu. Lokasi pengambilan dan kontak penemu sudah tersedia di bawah.</div>
    </div>
  </div>

  <div class="two-col">
    <div class="card">
      <div class="person-row">
        <div class="avatar av-green">BS</div>
        <div><div class="person-name">Budi Santoso</div><div class="person-role">Penemu barang</div></div>
      </div>
      <div class="info-row"><svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>NIM<span class="info-val">1910050017</span></div>
      <div class="info-row"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="9" y1="3" x2="9" y2="21"/></svg>Prodi<span class="info-val">Sistem Informasi</span></div>
      <div class="info-row"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 10.23 19.79 19.79 0 0 1 1.61 1.68a2 2 0 0 1 1.97-2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 7a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>WhatsApp<span class="info-val green">0813-xxxx-2291</span></div>
      <div class="info-row"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Tersedia<span class="info-val">08.00 – 16.00</span></div>
    </div>
    <div class="card">
      <div class="person-row">
        <div class="avatar av-blue">RA</div>
        <div><div class="person-name">Rina Aulia</div><div class="person-role">Pemilik barang</div></div>
      </div>
      <div class="info-row"><svg viewBox="0 0 24 24"><path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/></svg>Barang<span class="info-val">Dompet kulit cokelat</span></div>
      <div class="info-row"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>Hilang<span class="info-val">3 Juni 2026</span></div>
      <div class="info-row"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>Terakhir<span class="info-val">Kantin Pusat</span></div>
      <div class="info-row"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Status<span class="info-val" style="background:var(--green-l);color:var(--green-d);padding:2px 10px;border-radius:20px;font-size:11px;">Siap diambil</span></div>
    </div>
  </div>

  <!-- MAP CARD -->
  <div class="map-card">
    <div class="map-header">
      <div class="map-title"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>Lokasi pengambilan barang</div>
      <span class="map-badge">✓ Diverifikasi</span>
    </div>
    <div id="map">
      <!-- Peta Google Maps akan muncul di sini setelah API key dimasukkan -->
      <div class="map-placeholder">
        <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <p>Untuk menampilkan peta, ganti <code>YOUR_GOOGLE_MAPS_API_KEY</code> di bagian bawah file ini dengan Google Maps API Key kamu.</p>
        <p style="font-size:12px;margin-top:4px;">Panduan: <a href="https://developers.google.com/maps/get-started" target="_blank" style="color:var(--blue);">developers.google.com/maps</a></p>
      </div>
    </div>
    <div class="map-footer">
      <div class="map-addr"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg><div><strong>Kantin Pusat, Lantai 1</strong> — meja dekat pintu masuk barat</div></div>
      <button class="btn-nav" onclick="openNav()"><svg viewBox="0 0 24 24"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>Navigasi</button>
      <button class="btn-maps" onclick="openMaps()"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>Buka Google Maps</button>
    </div>
    <div class="dist-strip">
      <div class="dist-item"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Jarak: <strong id="dist-text">~180 m</strong></div>
      <div class="dist-item"><svg viewBox="0 0 24 24"><path d="M17 18a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2"/><rect x="3" y="11" width="18" height="11" rx="2"/><polyline points="3 11 12 2 21 11"/></svg>Jalan kaki: <strong id="walk-text">~3 menit</strong></div>
      <div class="dist-item"><svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>Berkendara: <strong id="drive-text">~1 menit</strong></div>
    </div>
  </div>

  <!-- CHAT -->
  <div class="chat-card">
    <div class="chat-title"><svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>Chat koordinasi dengan penemu</div>
    <div class="chat-msgs" id="chat-msgs">
      <div class="bubble-row">
        <div class="bav av-green">BS</div>
        <div>
          <div class="bubble bubble-left">Halo Rina! Klaim kamu sudah aku setujui. Dompetnya aman di sini.
            <div class="bubble-loc-chip-left"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>Kantin Pusat, meja dekat pintu barat</div>
          </div>
          <div class="bubble-time">14:32</div>
        </div>
      </div>
      <div class="bubble-row right">
        <div class="bav av-blue">RA</div>
        <div style="align-items:flex-end;display:flex;flex-direction:column;">
          <div class="bubble bubble-right">Makasih banget Budi! Aku langsung ke sana sekarang ya
            <div class="bubble-loc-chip"><svg viewBox="0 0 24 24"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>Sudah buka Google Maps</div>
          </div>
          <div class="bubble-time" style="text-align:right;">14:34</div>
        </div>
      </div>
      <div class="bubble-row">
        <div class="bav av-green">BS</div>
        <div>
          <div class="bubble bubble-left">Oke siap! Aku tunggu di sini sampai jam 5 sore.</div>
          <div class="bubble-time">14:35</div>
        </div>
      </div>
    </div>
    <div class="chat-input-row">
      <input class="chat-input" type="text" id="chat-in" placeholder="Ketik pesan..." onkeydown="if(event.key==='Enter')sendMsg()">
      <button class="chat-send" onclick="sendMsg()" aria-label="Kirim"><svg viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg></button>
    </div>
  </div>
</div>

<!--
  ============================================================
  GOOGLE MAPS INTEGRATION
  ============================================================
  Ganti YOUR_GOOGLE_MAPS_API_KEY dengan API key kamu.
  Koordinat penemu (FINDER_LAT, FINDER_LNG) bisa diambil dari:
  - Input lokasi saat penemu membuat laporan (gunakan browser Geolocation API)
  - Atau diisi manual oleh penemu di profil mereka
  ============================================================
-->
<script>
  const FINDER_LAT  = 5.5577;   // <-- Ganti dengan koordinat GPS penemu
  const FINDER_LNG  = 95.3222;  // <-- Ganti dengan koordinat GPS penemu
  const FINDER_ADDR = 'Kantin Pusat, Lantai 1, Universitas';

  function openMaps() {
    window.open('https://www.google.com/maps/search/?api=1&query='+FINDER_LAT+','+FINDER_LNG, '_blank');
  }

  function openNav() {
    window.open('https://www.google.com/maps/dir/?api=1&destination='+FINDER_LAT+','+FINDER_LNG+'&travelmode=walking', '_blank');
  }

  function sendMsg() {
    const inp = document.getElementById('chat-in');
    const msg = inp.value.trim();
    if (!msg) return;
    const wrap = document.getElementById('chat-msgs');
    const now  = new Date();
    const time = now.getHours() + ':' + String(now.getMinutes()).padStart(2,'0');
    const row  = document.createElement('div');
    row.className = 'bubble-row right';
    row.innerHTML = '<div class="bav av-blue">RA</div><div style="align-items:flex-end;display:flex;flex-direction:column;"><div class="bubble bubble-right">'+msg+'</div><div class="bubble-time" style="text-align:right;">'+time+'</div></div>';
    wrap.appendChild(row);
    inp.value = '';
    wrap.scrollTop = wrap.scrollHeight;
  }

  // Inisialisasi Google Maps (dipanggil callback setelah script Maps dimuat)
  function initMap() {
    const finderPos = { lat: FINDER_LAT, lng: FINDER_LNG };
    const mapEl = document.getElementById('map');
    // Hapus placeholder jika ada
    mapEl.innerHTML = '';

    const map = new google.maps.Map(mapEl, {
      zoom: 17,
      center: finderPos,
      mapTypeControl: false,
      streetViewControl: false,
      fullscreenControl: true,
      styles: [
        { featureType: 'poi', stylers: [{ visibility: 'simplified' }] },
        { featureType: 'transit', stylers: [{ visibility: 'off' }] }
      ]
    });

    // Marker penemu (hijau)
    const finderMarker = new google.maps.Marker({
      position: finderPos,
      map: map,
      title: 'Lokasi Penemu — ' + FINDER_ADDR,
      icon: {
        path: google.maps.SymbolPath.CIRCLE,
        scale: 12,
        fillColor: '#1D9E75',
        fillOpacity: 1,
        strokeColor: '#fff',
        strokeWeight: 3
      }
    });

    const infoWindow = new google.maps.InfoWindow({
      content: '<div style="font-family:Inter,sans-serif;padding:4px 2px"><strong style="font-size:13px">Budi Santoso (Penemu)</strong><p style="font-size:12px;color:#6B7C74;margin-top:4px">'+FINDER_ADDR+'</p></div>'
    });
    finderMarker.addListener('click', () => infoWindow.open(map, finderMarker));
    infoWindow.open(map, finderMarker);

    // Jika browser mendukung Geolocation, tampilkan posisi pemilik & hitung rute
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(pos => {
        const ownerPos = { lat: pos.coords.latitude, lng: pos.coords.longitude };

        new google.maps.Marker({
          position: ownerPos,
          map: map,
          title: 'Posisi kamu',
          icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 10,
            fillColor: '#185FA5',
            fillOpacity: 1,
            strokeColor: '#fff',
            strokeWeight: 3
          }
        });

        // Directions (rute jalan kaki)
        const directionsService  = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer({
          suppressMarkers: true,
          polylineOptions: { strokeColor: '#1D9E75', strokeWeight: 4 }
        });
        directionsRenderer.setMap(map);

        directionsService.route({
          origin: ownerPos,
          destination: finderPos,
          travelMode: google.maps.TravelMode.WALKING
        }, (result, status) => {
          if (status === 'OK') {
            directionsRenderer.setDirections(result);
            const leg = result.routes[0].legs[0];
            document.getElementById('dist-text').textContent  = leg.distance.text;
            document.getElementById('walk-text').textContent  = leg.duration.text;
          }
        });

        directionsService.route({
          origin: ownerPos,
          destination: finderPos,
          travelMode: google.maps.TravelMode.DRIVING
        }, (result, status) => {
          if (status === 'OK') {
            const leg = result.routes[0].legs[0];
            document.getElementById('drive-text').textContent = leg.duration.text;
          }
        });
      });
    }
  }
</script>

<!--
  Ganti YOUR_GOOGLE_MAPS_API_KEY dengan API key kamu.
  Pastikan Maps JavaScript API & Directions API sudah diaktifkan.
-->
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=API_KEY_KAMU&callback=initMap&libraries=geometry">
</script>

</body>
</html>