#!/bin/bash
set -e

yum install -y passwd sudo
echo "source /etc/environment" >> /root/.bash_profile
