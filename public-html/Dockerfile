# Utiliza la imagen base de wordpress
FROM wordpress:latest

ENV ACCEPT_EULA=Y

RUN apt-get update && apt-get install -y nano wget gnupg2

# Configura la zona horaria y evita las interacciones durante la construcción
ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=America/Mexico_City
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt-get update && apt-get install -y sudo

# Configura las variables de entorno para configuración adicional
ENV SOURCE=wordpress
ENV WORDPRESS_DB_HOST=mysql-wordpress-pre
ENV WORDPRESS_DB_NAME=wordpress
ENV WORDPRESS_DB_USER=wordpress
ENV PASSD=user-W0rdPr3sp#5d?w-Ud3}e
ENV SIMPLE=simple-wordpress

# Configura el directorio de trabajo en el contenedor
WORKDIR /var/www/wordpress
COPY . /var/www/wordpress

# Copiar archivos al contenedor
RUN mkdir -p /var/www/wordpress/public_content
RUN mkdir -p /var/www/private_content

# Mueve el directorio 'simplesaml' a la ubicación correcta
RUN mv /var/www/wordpress/simplesaml /var/www/simplesaml

# Descarga e instala WordPress en /srv/www usando curl y tar
RUN curl -o /tmp/latest.tar.gz https://wordpress.org/latest.tar.gz \
    && tar -zxvf /tmp/latest.tar.gz -C /var/www/wordpress \
    && rm /tmp/latest.tar.gz

# Enable session
RUN echo "session.save_path=\"/tmp\"" >> /usr/local/etc/php/php.ini

# Install xdebug driver
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
#COPY ./config/xdebug/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/


# Install SqlServer PHP driver
RUN cat /etc/os-release \
  && apt-get update \
  && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
  && curl https://packages.microsoft.com/config/ubuntu/22.04/prod.list \
      > /etc/apt/sources.list.d/mssql-release.list \
  && apt-get install -y --no-install-recommends apt-transport-https \
  && apt-get update \
  && ACCEPT_EULA=Y apt-get -y --no-install-recommends install unixodbc-dev msodbcsql17

# Install PHP extensions
RUN docker-php-ext-install calendar
RUN docker-php-ext-install pdo_mysql \
  && pecl install sqlsrv pdo_sqlsrv \
  && docker-php-ext-enable sqlsrv pdo_sqlsrv

# Copia el archivo de configuración de Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Habilita mod_rewrite en Apache
RUN a2enmod rewrite && \
    echo "display_errors = Off" >> /usr/local/etc/php/php.ini && \
    echo "log_errors = On" >> /usr/local/etc/php/php.ini

# Reinicia el servicio de Apache
RUN service apache2 restart

# Exponer el puerto 80 para que se pueda acceder a través del navegador
EXPOSE 80

# Comando que se ejecutará al iniciar el contenedor
CMD ["apache2ctl", "-D", "FOREGROUND"]