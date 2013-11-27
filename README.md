1km1kt Library
==============

This is a document based library for free roleplaying games that will replace the library on [1KM1KT](http://www.1km1kt.net). It is built as a couple of bundles on top of the [Symfony Framework](http://www.symfony.com). The library works alongside [PHPBB3](http://www.phpbb.net), so you will need a vanilla install of that too. The codename for the library is 2km2kt, which makes local URLs easier to understand.

The Library is not ready for use and is under development.

Pre-requisites
==============

  * PHP 5.3 or later
  * MySQL 5.5.* or later
  * Web host (Apache/IIS)
  * [smtp4Dev]() if you would like to test emails

Installation
============

PHPBB First
------------
It's not imperative to get PHPBB first but it certainly helps in configuring Symfony later.

  * Go to [PHPBB Downloads](https://www.phpbb.com/downloads/) and download PHPBB3
  * Install PHPBB and have it run under the URL localhost/1km1kt/phpbb
  * For the database name, user 1km1kt as the database schema name, username and password

Symfony and Bundles
-------------------
This repository contains Symfony and the bundles you need.

  * Download the repository to where it is going to run
  * Point your web host software at the /web/ folder, call it 2km2kt
  * Go to app/config/parameters.yml
    * There are two sets of databases to configure, the Library one (simply listed as database) and the phpbb one.
    * Put your phpbb "1km1kt" credentials into the PHP database
  * Set the version_upload_absolute_path to the place where the files (documents/games) will go on your hard drive
    * Your Web host must have read and write permission to this folder

Creating Tables
---------------
Symfony uses doctrine to manage the database tables. On Windows, makes sure that you [can run PHP from your command line](http://php.net/manual/en/install.windows.commandline.php). Doctrine works by analysing Entity classes in the Library and Security Bundles and then creating the tables for you. And changes you make to these Entities will require doctrine to update the database.

To create (or update) the database, do the following:

  * Open cmd (or shell)
  * Navigate to the 1km1kt-library root folder
  * Run the following command:

(This should only be used for development, there is a migration framework for the live DB!)

`php app/console doctrine:schema:update --force`

Running Library
===============

  * Log into PHPBB using your admin username and password
  * Navigate to localhost/2km2kt/app_dev.php


Versions and Notes
==================
Only the homepage is working at the moment, although you will notice your user is logged in and that there is a dump of the user object. The other piecs of Library are still coming together!