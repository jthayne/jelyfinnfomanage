FROM webdevops/php-apache:8.0-alpine

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN docker-php-ext-install xdebug && docker-php-ext-enable xdebug

COPY dev.apache.conf /etc/apache2/conf-available/sow-creator.conf

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf &&\
    a2enmod rewrite &&\
    a2dissite 000-default &&\
    a2ensite my-apache-site &&\
    service apache2 restart
