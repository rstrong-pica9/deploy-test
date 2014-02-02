#!/bin/bash
set -e

yum install -y passwd sudo
echo "source /etc/environment" >> ~/.bash_profile
