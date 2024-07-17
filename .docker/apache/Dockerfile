FROM debian:stable

ARG PROJECT_NAME 

ENV HTTPD_PREFIX /usr/local/apache2
ENV PATH $HTTPD_PREFIX/bin:$PATH
RUN mkdir -p "$HTTPD_PREFIX" \
    && chown www-data:www-data "$HTTPD_PREFIX"
WORKDIR $HTTPD_PREFIX

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
    apache2 curl \
    && rm -r /var/lib/apt/lists/*
RUN a2enmod proxy_fcgi ssl rewrite proxy proxy_balancer proxy_http proxy_ajp
RUN sed -i '/Global configuration/a \
ServerName localhost \
' /etc/apache2/apache2.conf
# autorise .htaccess files
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

COPY config/vhosts/wordpress.conf /etc/apache2/sites-enabled/wordpress.conf
RUN sed -i "s/project.local/${PROJECT_NAME}.local/g" /etc/apache2/sites-enabled/wordpress.conf
RUN sed -i "s/\/var\/www\/project/\/var\/www\/${PROJECT_NAME}/g" /etc/apache2/sites-enabled/wordpress.conf
RUN sed -i "s/proxy:fcgi:\/\/project_wp_php:9000/proxy:fcgi:\/\/${PROJECT_NAME}_wp_php:9000/g" /etc/apache2/sites-enabled/wordpress.conf

EXPOSE 80 443
RUN rm -f /run/apache2/apache2.pid
CMD apachectl  -DFOREGROUND -e info
