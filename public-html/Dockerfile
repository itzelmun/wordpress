# Utiliza la imagen base de Ubuntu 22.04
FROM wordpress:latest

ENV ACCEPT_EULA=Y

RUN apt-get update && apt-get install -y nano wget gnupg2

# Configura la zona horaria y evita las interacciones durante la construcción
ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=America/Mexico_City

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Configura las variables de entorno para configuración adicional
ENV SOURCE=wordpress
ENV WORDPRESS_DB_HOST=mysql-wordpress
ENV WORDPRESS_DB_NAME=proyecto
ENV WORDPRESS_DB_USER=user
ENV WORDPRESS_DB_PASSWORD=psswrd-proyecto-user!
ENV SIMPLE=simple-wordpress

# Configura el directorio de trabajo en el contenedor
WORKDIR /var/www/html

# Copia el contenido de los directorios públicos y privados
COPY ./wp-config-sample.php /var/www/html/
COPY ./wp-config-docker.php /var/www/html/
COPY . /var/www/html

# Configura WordPress (cambia las variables según tus necesidades)
RUN mkdir -p /var/www/wordpress/public_content
RUN mkdir -p /var/www/private_content

# Mueve el directorio 'simplesaml' a la ubicación correcta
RUN mv /var/www/html/simplesaml /var/www/simplesaml

# Configura los permisos de los directorios
RUN chown -R www-data:www-data /var/www/html/ && \
    chmod -R 755 /var/www/html/
    
# Enable session
RUN echo "session.save_path=\"/tmp\"" >> /usr/local/etc/php/php.ini

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