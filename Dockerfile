# 1. Gunakan PHP 8.2 dengan Apache (Web Server pengganti artisan serve)
FROM php:8.2-apache

# 2. Install dependensi server untuk Laravel & PostgreSQL (Neon)
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl libpq-dev \
    && docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# 3. Install Node.js untuk memproses frontend (karena ada Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# 4. Aktifkan modul rewrite Apache agar routing Laravel berjalan lancar
RUN a2enmod rewrite

# 5. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Atur folder kerja di dalam server Render
WORKDIR /var/www/html

# 7. Copy SEMUA file project fhudhel-wifda kamu ke dalam server
COPY . .

# 8. Install paket PHP dan Node.js, lalu build frontend-nya
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# 9. Beri izin ke folder storage agar Laravel bisa berjalan
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 10. Arahkan Apache ke folder /public milik Laravel
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# 11. Buka akses port internet
EXPOSE 80

# 12. Saat server hidup: otomatis migrate database Neon lalu jalankan web server!
CMD php artisan migrate --force && apache2-foreground
