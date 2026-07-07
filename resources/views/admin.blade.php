<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard & CMS</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,400;0,600;1,400&family=Manrope:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { navy: '#0B1220', navylight: '#131C2E', gold: '#C9A24B', ivory: '#FBF6EC' },
                    fontFamily: { display: ['Fraunces', 'serif'], body: ['Manrope', 'sans-serif'] }
                }
            }
        }
    </script>
    @vite(['resources/js/app.js'])
</head>
<body class="bg-[#0B1220] text-[#FBF6EC] font-body min-h-screen p-6 md:p-12 relative overflow-x-hidden">
    
    <div class="absolute inset-0 z-[-1] opacity-5" style="background-image: radial-gradient(#C9A24B 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="max-w-6xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-6">
            <div>
                <h1 class="font-display text-3xl md:text-4xl font-semibold text-gold mb-1">Command Center</h1>
                <p class="text-ivory/60">Sistem Kendali Pusat Undangan Wifda & Pasangan.</p>
            </div>
            
            <div class="flex items-center gap-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-red-500/20 text-red-400 border border-red-500/30 font-bold rounded-full hover:bg-red-500/30 transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/50 text-green-400 p-4 rounded-xl mb-6 flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-400 hover:text-green-300 font-bold">✕</button>
            </div>
        @endif

        <div class="flex border-b border-gold/20 mb-8 space-x-8">
            <button onclick="switchTab('guestbook')" id="tab-guestbook" class="pb-4 text-gold font-bold border-b-2 border-gold text-lg transition-all">Buku Tamu</button>
            <button onclick="switchTab('settings')" id="tab-settings" class="pb-4 text-ivory/50 font-semibold border-b-2 border-transparent hover:text-gold transition-all text-lg">Pengaturan Website (CMS)</button>
        </div>

        <div id="content-guestbook" class="block">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-navylight/80 p-6 rounded-2xl border border-gold/20">
                    <p class="text-ivory/50 uppercase tracking-widest text-xs font-semibold mb-2">Total Ucapan</p>
                    <p class="text-4xl font-display text-white" id="stat-total">{{ $totalTamu }}</p>
                </div>
                <div class="bg-navylight/80 p-6 rounded-2xl border border-gold/20 flex justify-between items-center">
                    <div>
                        <p class="text-ivory/50 uppercase tracking-widest text-xs font-semibold mb-2">Hadir</p>
                        <p class="text-4xl font-display text-green-400" id="stat-hadir">{{ $totalHadir }}</p>
                    </div>
                    <a href="/admin/export" class="p-3 bg-gold/20 text-gold rounded-xl hover:bg-gold hover:text-navy transition-colors" title="Download Excel">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    </a>
                </div>
                <div class="bg-navylight/80 p-6 rounded-2xl border border-gold/20">
                    <p class="text-ivory/50 uppercase tracking-widest text-xs font-semibold mb-2">Tidak Hadir</p>
                    <p class="text-4xl font-display text-red-400" id="stat-tidak">{{ $totalTidakHadir }}</p>
                </div>
            </div>

            <div class="bg-navylight/60 rounded-2xl border border-gold/10 overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-navylight/90 text-gold uppercase text-xs tracking-wider">
                                <th class="px-6 py-4 border-b border-gold/10">Waktu</th>
                                <th class="px-6 py-4 border-b border-gold/10">Nama Tamu</th>
                                <th class="px-6 py-4 border-b border-gold/10">Kehadiran</th>
                                <th class="px-6 py-4 border-b border-gold/10">Ucapan</th>
                                <th class="px-6 py-4 border-b border-gold/10 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse ($comments as $comment)
                                <tr class="hover:bg-ivory/5 transition-colors group">
                                    <td class="px-6 py-4 border-b border-gold/5 text-ivory/50 whitespace-nowrap">{{ $comment->created_at ? $comment->created_at->format('d M Y - H:i') : '-' }}</td>
                                    <td class="px-6 py-4 border-b border-gold/5 font-semibold text-ivory">{{ $comment->nama }}</td>
                                    <td class="px-6 py-4 border-b border-gold/5">
                                        @if ($comment->hadir)
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-400/10 text-green-400 border border-green-400/20">Hadir</span>
                                        @else
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-400/10 text-red-400 border border-red-400/20">Tidak Hadir</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 border-b border-gold/5 text-ivory/80 min-w-[200px]">{{ $comment->komentar }}</td>
                                    <td class="px-6 py-4 border-b border-gold/5 text-center">
                                        <form action="/admin/comments/{{ $comment->id }}" method="POST" onsubmit="return confirm('Hapus ucapan ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-500/10 text-red-400 rounded-lg border border-red-500/20 hover:bg-red-500 hover:text-white transition-colors" title="Hapus"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr id="empty-row"><td colspan="5" class="px-6 py-12 text-center text-ivory/50">Belum ada tamu.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="content-settings" class="hidden pb-20">
            <form action="/admin/settings" method="POST" id="main-settings-form" class="space-y-8">
                @csrf
                
                <div class="bg-navylight/60 p-8 rounded-2xl border border-gold/20 shadow-xl">
                    <h2 class="text-2xl font-display text-gold mb-6 border-b border-gold/20 pb-2">1. Tema & Tampilan Dasar</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-ivory/80 text-sm font-semibold mb-2">Warna Background (Latar Belakang)</label>
                            <div class="flex items-center space-x-4">
                                <input type="color" name="theme_bg_color" value="{{ $settings->theme_bg_color }}" class="w-14 h-14 bg-transparent border-0 cursor-pointer rounded-lg">
                                <span class="text-ivory/50 text-xs">Pilih warna latar yang kamu inginkan.</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-ivory/80 text-sm font-semibold mb-2">Warna Teks Utama</label>
                            <div class="flex items-center space-x-4">
                                <input type="color" name="theme_text_color" value="{{ $settings->theme_text_color }}" class="w-14 h-14 bg-transparent border-0 cursor-pointer rounded-lg">
                                <span class="text-ivory/50 text-xs">Warna untuk teks cerita & detail acara.</span>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-ivory/80 text-sm font-semibold mb-2">Link Lagu Latar (Music URL)</label>
                            <input type="text" name="music_url" value="{{ $settings->music_url }}" class="w-full px-4 py-3 bg-[#0B1220] border border-gold/30 rounded-xl text-ivory focus:outline-none focus:border-gold">
                        </div>
                    </div>
                </div>

                <div class="bg-navylight/60 p-8 rounded-2xl border border-gold/20 shadow-xl">
                    <h2 class="text-2xl font-display text-gold mb-6 border-b border-gold/20 pb-2">2. Data Mempelai</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-ivory/80 text-sm font-semibold mb-2">Nama Mempelai Wanita</label>
                            <input type="text" name="bride_name" value="{{ $settings->bride_name }}" class="w-full px-4 py-3 bg-[#0B1220] border border-gold/30 rounded-xl text-ivory focus:outline-none focus:border-gold">
                        </div>
                        <div>
                            <label class="block text-ivory/80 text-sm font-semibold mb-2">Nama Orang Tua Wanita</label>
                            <input type="text" name="bride_parents" value="{{ $settings->bride_parents }}" class="w-full px-4 py-3 bg-[#0B1220] border border-gold/30 rounded-xl text-ivory focus:outline-none focus:border-gold">
                        </div>
                        <div>
                            <label class="block text-ivory/80 text-sm font-semibold mb-2">Link Foto Wanita (URL)</label>
                            <input type="text" name="bride_photo_url" value="{{ $settings->bride_photo_url }}" class="w-full px-4 py-3 bg-[#0B1220] border border-gold/30 rounded-xl text-ivory focus:outline-none focus:border-gold">
                        </div>
                        <div class="md:col-span-2 border-t border-gold/10 my-4"></div>
                        <div>
                            <label class="block text-ivory/80 text-sm font-semibold mb-2">Nama Mempelai Pria</label>
                            <input type="text" name="groom_name" value="{{ $settings->groom_name }}" class="w-full px-4 py-3 bg-[#0B1220] border border-gold/30 rounded-xl text-ivory focus:outline-none focus:border-gold">
                        </div>
                        <div>
                            <label class="block text-ivory/80 text-sm font-semibold mb-2">Nama Orang Tua Pria</label>
                            <input type="text" name="groom_parents" value="{{ $settings->groom_parents }}" class="w-full px-4 py-3 bg-[#0B1220] border border-gold/30 rounded-xl text-ivory focus:outline-none focus:border-gold">
                        </div>
                        <div>
                            <label class="block text-ivory/80 text-sm font-semibold mb-2">Link Foto Pria (URL)</label>
                            <input type="text" name="groom_photo_url" value="{{ $settings->groom_photo_url }}" class="w-full px-4 py-3 bg-[#0B1220] border border-gold/30 rounded-xl text-ivory focus:outline-none focus:border-gold">
                        </div>
                    </div>
                </div>

                <div class="bg-navylight/60 p-8 rounded-2xl border border-gold/20 shadow-xl">
                    <h2 class="text-2xl font-display text-gold mb-6 border-b border-gold/20 pb-2">3. Kutipan Pembuka & Love Story</h2>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-ivory/80 text-sm font-semibold mb-2">Kutipan Pembuka (Ayat/Quotes)</label>
                            <textarea name="welcome_quote" rows="3" class="w-full px-4 py-3 bg-[#0B1220] border border-gold/30 rounded-xl text-ivory focus:outline-none focus:border-gold">{{ $settings->welcome_quote }}</textarea>
                        </div>
                        <div>
                            <label class="block text-ivory/80 text-sm font-semibold mb-2">Kisah Cinta Singkat (Love Story)</label>
                            <textarea name="love_story" rows="4" class="w-full px-4 py-3 bg-[#0B1220] border border-gold/30 rounded-xl text-ivory focus:outline-none focus:border-gold">{{ $settings->love_story }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-navylight/60 p-8 rounded-2xl border border-gold/20 shadow-xl">
                    <h2 class="text-2xl font-display text-gold mb-6 border-b border-gold/20 pb-2">4. Waktu & Lokasi Acara</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-ivory/80 text-sm font-semibold mb-2">Tanggal Pernikahan (Untuk Hitung Mundur)</label>
                            <input type="date" name="wedding_date" value="{{ $settings->wedding_date }}" class="w-full md:w-1/2 px-4 py-3 bg-[#0B1220] border border-gold/30 rounded-xl text-ivory focus:outline-none focus:border-gold">
                        </div>
                        <div>
                            <label class="block text-ivory/80 text-sm font-semibold mb-2">Lokasi Akad</label>
                            <input type="text" name="akad_location" value="{{ $settings->akad_location }}" class="w-full px-4 py-3 bg-[#0B1220] border border-gold/30 rounded-xl text-ivory focus:outline-none focus:border-gold">
                        </div>
                        <div>
                            <label class="block text-ivory/80 text-sm font-semibold mb-2">Waktu Akad</label>
                            <input type="text" name="akad_time" value="{{ $settings->akad_time }}" class="w-full px-4 py-3 bg-[#0B1220] border border-gold/30 rounded-xl text-ivory focus:outline-none focus:border-gold">
                        </div>
                        <div>
                            <label class="block text-ivory/80 text-sm font-semibold mb-2">Lokasi Resepsi</label>
                            <input type="text" name="reception_location" value="{{ $settings->reception_location }}" class="w-full px-4 py-3 bg-[#0B1220] border border-gold/30 rounded-xl text-ivory focus:outline-none focus:border-gold">
                        </div>
                        <div>
                            <label class="block text-ivory/80 text-sm font-semibold mb-2">Waktu Resepsi</label>
                            <input type="text" name="reception_time" value="{{ $settings->reception_time }}" class="w-full px-4 py-3 bg-[#0B1220] border border-gold/30 rounded-xl text-ivory focus:outline-none focus:border-gold">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-ivory/80 text-sm font-semibold mb-2">Link Google Maps (Tombol Navigasi)</label>
                            <input type="text" name="google_maps_url" value="{{ $settings->google_maps_url }}" class="w-full px-4 py-3 bg-[#0B1220] border border-gold/30 rounded-xl text-ivory focus:outline-none focus:border-gold">
                        </div>
                    </div>
                </div>
            </form>

            <div class="sticky bottom-6 flex justify-end gap-4 mt-8 z-50">
                <form action="/admin/settings/reset" method="POST" onsubmit="return confirm('Apakah kamu YAKIN ingin mereset semua teks & warna ke bawaan awal?');">
                    @csrf
                    <button type="submit" class="px-6 py-4 bg-red-500/10 text-red-400 border border-red-500/30 font-bold rounded-full hover:bg-red-500 hover:text-white transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Reset ke Default
                    </button>
                </form>

                <button type="submit" form="main-settings-form" class="px-10 py-4 bg-gradient-to-r from-gold to-yellow-600 text-navy font-bold text-lg rounded-full shadow-[0_10px_25px_rgba(201,162,75,0.5)] hover:scale-105 transition-transform flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Perubahan
                </button>
            </div>
        </div>

    </div>

    <script>
        function switchTab(tab) {
            document.getElementById('content-guestbook').classList.toggle('hidden', tab !== 'guestbook');
            document.getElementById('content-settings').classList.toggle('hidden', tab !== 'settings');
            
            document.getElementById('tab-guestbook').className = tab === 'guestbook' 
                ? 'pb-4 text-gold font-bold border-b-2 border-gold text-lg transition-all' 
                : 'pb-4 text-ivory/50 font-semibold border-b-2 border-transparent hover:text-gold transition-all text-lg';
                
            document.getElementById('tab-settings').className = tab === 'settings' 
                ? 'pb-4 text-gold font-bold border-b-2 border-gold text-lg transition-all' 
                : 'pb-4 text-ivory/50 font-semibold border-b-2 border-transparent hover:text-gold transition-all text-lg';
        }
    </script>
    <script type="module">
        window.Echo.private('admin-channel')
            .listen('.tamu.hadir', (e) => {
                const tamu = e.comment;
                const emptyRow = document.getElementById('empty-row');
                if (emptyRow) emptyRow.remove();

                const statusHtml = tamu.hadir 
                    ? '<span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-400/10 text-green-400 border border-green-400/20">Hadir</span>'
                    : '<span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-400/10 text-red-400 border border-red-400/20">Tidak Hadir</span>';

                const newRow = `
                    <tr class="hover:bg-ivory/5 transition-colors group bg-gold/20 animate-pulse">
                        <td class="px-6 py-4 border-b border-gold/5 text-gold whitespace-nowrap font-bold">Baru Saja</td>
                        <td class="px-6 py-4 border-b border-gold/5 font-semibold text-ivory">${tamu.nama}</td>
                        <td class="px-6 py-4 border-b border-gold/5">${statusHtml}</td>
                        <td class="px-6 py-4 border-b border-gold/5 text-ivory/80 min-w-[200px]">${tamu.komentar}</td>
                        <td class="px-6 py-4 border-b border-gold/5 text-center text-ivory/30 text-xs">Refresh web<br>untuk hapus</td>
                    </tr>
                `;

                const tbody = document.querySelector('#content-guestbook tbody');
                if(tbody) tbody.insertAdjacentHTML('afterbegin', newRow);

                const totalEl = document.getElementById('stat-total');
                if(totalEl) totalEl.textContent = parseInt(totalEl.textContent) + 1;
                
                if (tamu.hadir) {
                    const hadirEl = document.getElementById('stat-hadir');
                    if(hadirEl) hadirEl.textContent = parseInt(hadirEl.textContent) + 1;
                } else {
                    const tidakEl = document.getElementById('stat-tidak');
                    if(tidakEl) tidakEl.textContent = parseInt(tidakEl.textContent) + 1;
                }
                alert(`🔔 Pesan Baru dari ${tamu.nama}:\n"${tamu.komentar}"`);
            });
    </script>
</body>
</html>
