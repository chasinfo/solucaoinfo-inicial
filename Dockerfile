FROM php:7.3.6-fpm-alpine3.9
RUN apk add --no-cache openssl bash mysql-client nodejs npm ssmtp
RUN docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# root is the person who gets all mail for userids < 1000
RUN echo "root=yourAdmin@email.com" >> /etc/ssmtp/ssmtp.conf

# Here is the gmail configuration (or change it to your private smtp server)
RUN echo "mailhub=smtp.gmail.com:587" >> /etc/ssmtp/ssmtp.conf
RUN echo "AuthUser=your@gmail.com" >> /etc/ssmtp/ssmtp.conf
RUN echo "AuthPass=yourGmailPass" >> /etc/ssmtp/ssmtp.conf

RUN echo "UseTLS=YES" >> /etc/ssmtp/ssmtp.conf
RUN echo "UseSTARTTLS=YES" >> /etc/ssmtp/ssmtp.conf


# Set up php sendmail config
RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini

WORKDIR /var/www/html
RUN rm -Rf /var/www/html/*

# COPY . /var/www
# RUN composer install

EXPOSE 9000
ENTRYPOINT ["php-fpm"]
