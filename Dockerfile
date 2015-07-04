# build container:
#   sudo docker build --tag=dnb .
# run container:
#   sudo docker run --name=dnb -d -p 80:80 -v $(pwd):/var/www/dnb dnb
#
FROM miramir/docker-debian8-lnpm:latest

ENV COMPOSER_HOME /composer

ADD ./docker/nginx-vhost.conf /etc/nginx/sites-available/default
ADD ./docker/docker_rsa.pub /tmp/docker_rsa.pub

RUN mkdir -p /root/.ssh && cat /tmp/docker_rsa.pub >> /root/.ssh/authorized_keys && \
    composer selfupdate

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
