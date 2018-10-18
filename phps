#!/bin/bash

version=$1
main=${version:0:1}

brew list -1 | grep php | while read line; do brew unlink $line; done
brew link php@$version --force

sed -i -e "s/php@[0-9]\.[0-9]/php@$version/g" /usr/local/etc/httpd/httpd.conf
sed -i -e "s/php[0-9]/php$main/g" /usr/local/etc/httpd/httpd.conf

sudo brew services restart httpd
