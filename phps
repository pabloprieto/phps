#!/bin/bash

version=$1
main=${version:0:1}

brew unlink php@5.6 php@7.0 php@7.1 php@7.2
brew link php@$version --force --overwrite

sed -i -e "s/php@[0-9]\.[0-9]/php@$version/g" /usr/local/etc/httpd/httpd.conf
sed -i -e "s/php[0-9]/php$main/g" /usr/local/etc/httpd/httpd.conf

sudo brew services restart httpd
