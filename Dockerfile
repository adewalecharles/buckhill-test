FROM Ubuntu:22.04

# Set working directory
WORKDIR /var/www

ENV TZ=UTC

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nano \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installing cron package
RUN apt-get update && apt-get install -y cron

# Add crontab file in the cron directory
#ADD docker-compose/cron/crontab /etc/cron.d/cron
#
#RUN chmod 0644 /etc/cron.d/cron
#
#RUN touch /var/log/cron.log
#
#RUN service cron restart

# Add files
USER root

#ADD docker-compose/cron/run.sh /run.sh
#ADD docker-compose/cron/entrypoint.sh /entrypoint.sh
#
#RUN chmod +x /run.sh /entrypoint.sh
#
#ENTRYPOINT /entrypoint.sh

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

USER $user

