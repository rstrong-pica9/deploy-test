# Sample Deploy Project
This project is an example of what is required to make a project deployable using the Pica9 Deployment tool. 

## Requirements
1. A "build" directory in the root of the project. This will hold all of the required files to build your project
2. A Dockerfile within the "build" directory. This will be run to build your Docker image.
3. A config file called "config.php". Its specifications are listed below

## Config file
The config file must return a PHP array containing the configuration. The config options are:

| Config Key | Description | Default Value |
| ---------- | ----------- | ------------- |
| clone_dir  | This is the directory in your docker container where your repo will be cloned | /var/www |
