#!/bin/sh

cd /var/www/digmore/app

sudo chown -R coder:coder cache logs

sudo setfacl -R -m mask::rwx cache/* logs/*
