<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Keamanan Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,400;0,600;1,400&family=Manrope:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { navy: '#0B1220', navylight: '#131C2E', gold: '#C9A24B', ivory: '#FBF6EC' }, fontFamily: { display: ['Fraunces', 'serif'], body: ['Manrope', 'sans-serif'] } } } }
    </script>
</head>
<body class="bg-[#0B1220] font-body flex items-center justify-center min-h-screen relative p-4">
    <div class="absolute inset-0 z-[-1] opacity-5" style="background-image: radial-gradient(#C9A24B 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="bg-navylight/80 backdrop-blur-md p-10 rounded-3xl border border-gold/20 max-w-md w-full shadow-[0_0_40px_rgba(201,162,75,0.1)]">
        <div class="text-center mb-8">
            <h1 class="font-display text-3xl font-semibold text-gold mb-2">Akses Terkunci</h1>
            <p class="text-ivory/60 text-sm">Silakan login untuk mengakses pusat data Wifda & Pasangan.</p>
        </div>

        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/50 text-red-500 text-sm p-3 rounded-lg mb-6 text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <div class="mb-5">
                <label class="block text-ivory/80 text-sm font-semibold mb-2">Email Admin</label>
                <input type="email" name="email" required class="w-full px-4 py-3 bg-[#0B1220] border border-gold/30 rounded-xl text-ivory focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold transition-colors">
            </div>
            <div class="mb-8">
                <label class="block text-ivory/80 text-sm font-semibold mb-2">Kata Sandi</label>
                <input type="password" name="password" required class="w-full px-4 py-3 bg-[#0B1220] border border-gold/30 rounded-xl text-ivory focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold transition-colors">
            </div>
            <button type="submit" class="w-full py-3 bg-gradient-to-r from-gold to-yellow-600 text-navy font-bold text-lg rounded-xl shadow-[0_0_15px_rgba(201,162,75,0.4)] hover:scale-[1.02] transition-transform">
                Buka Gembok
            </button>
        </form>
    </div>
</body>
</html>
