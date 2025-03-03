FROM hyperf/hyperf:8.3-alpine-v3.19-swoole

LABEL maintainer="Hyperf Developers <group@hyperf.io>" \
    version="1.0" \
    license="MIT" \
    app.name="Hyperf"

ARG timezone=UTC

ENV TIMEZONE=${timezone} \
    APP_ENV=dev \
    SCAN_CACHEABLE=true


RUN set -ex \
    # Install base dependencies
    && apk add --no-cache bash git unzip curl libpng-dev libjpeg-turbo-dev freetype-dev \
    # Install build dependencies
    && apk add --no-cache $PHPIZE_DEPS openssl-dev \
    && apk add --no-cache php83-pecl-mongodb php83-dev \
    # Configure PHP
    && cd /etc/php* \
    && { \
        echo "extension=mongodb.so"; \
    } | tee conf.d/00-extensions.ini \
    # Set timezone
    && ln -sf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && echo "${TIMEZONE}" > /etc/timezone \
    # Install composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    # Cleanup
    && rm -rf /var/cache/apk/* /tmp/* /usr/share/man

WORKDIR /opt/www

COPY composer.* ./

RUN composer install --no-scripts --no-interaction --prefer-dist \
    && composer dump-autoload -o \
    && chmod -R 777 vendor/

COPY . .

RUN mkdir -p runtime/container \
    && chmod -R 777 runtime/

EXPOSE 9501

ENTRYPOINT php /opt/www/bin/hyperf.php server:watch
