FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev

# 2. Clear cache agar image tidak bengkak
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Configure GD (Agar support JPG & WebP)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp

# Database MySQL
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy code
COPY . .

# Tambahan Install Dependencies Laravel
RUN composer install --optimize-autoloader --no-dev

# Ownership setup
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
