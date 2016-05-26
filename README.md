# Mlemer

![Progress](https://img.shields.io/badge/Status-Heavy%20Development-red.svg)
![Status](https://img.shields.io/badge/Progress-Incomplete-orange.svg)

**SUCH FILES, MANY BUGS, MUCH CODE, NO WOW**

**Mlemer** is a quiz, exercise, CTF or questionnaire system designed for trainer. It is designed meant to be simplified and easy to manage. This system is not suitable to be used for public access. It is designed for local network only and to assist trainer. Used at your own risk. 

## Table of Content
  1. [Requirement](#requirement)
  2. [Installation](#installation)
  3. [Usage](#usage)
  4. [Screenshot](#screenshot)
  5. [Wiki](#wiki)
  6. [Credit](#credit)
  7. [License](#license)


## Requirement

The requirement to get started is fairly simple. You need the following:

  * Any of your favorite Apache and MySQL manager. Mine use Wamp on Windows.
  * Any operating system that support PHP service.
  * You already have a set of question and answer to be input later.
  * and little patient.

## Installation

To install, follow these step:

  * Download latest release.
  * Extract into your web public directory (Eg: `C:\Wamp\www\mlemer` ).
  * Create MySQL database lets say `mlem_db`.
  * Import `mlem_db.sql` into your database.
  * Almost done, navigate to `http://localhost/mlemer/admin/`
  * Default username and password is `admin:adminadmin987`
  * Now your system is ready.

Configure config file:

  * Navigate and find `inc/config_sample.php`.
  * Rename `config_sample.php` to `config.php`.
  * Edit and enter your server configuration and database.

  * Navigate and find another admin file `.htaccess` and `.htpasswd`.
  * Edit `.htaccess` file as the following:

```
AuthUserFile <YOUR WEB PATH>\.htpasswd
AuthName "Adminitrative Area"
AuthType Basic

require user <YOUR ADMIN NAME>
```

Example `.htaccess` file:
```
AuthUserFile C:\wamp\www\Mlemer\admin\.htpasswd
AuthName "Adminitrative Area"
AuthType Basic

require user admin
```

  * Then you need to edit `.htpasswd` file.
  * The content format should be look like this `admin:$apr1$xQj29hba$wl0DuaxDk8Or9RIi8XPJ70`
  * To generate your own password hash you can use the following link:
    * http://www.htaccesstools.com/htpasswd-generator/ , or
    * https://www.transip.nl/htpasswd/

  * You can add multiple administrator username and password separated per line.

Configure for extra security (optional):

  * You may hide your 404 error message to prevent user from knowing your server info.

## Usage

This system is not suitable to be used for public access. It is designed for local network only and to assist the trainer. Used at your own risk.

As a player or training participant:
  * Once admin have setup everything, go to the following URL: `http://localhost/mlemer/`
  * At this point, system will automatically record your IP address, hostname and generate unique ID.
  * You will be prompt to register your username, real name and password (optional).
  * Once you have registered, you will be taken to the Dashboard page.
  * You are ready to take an exercise if available.


## Screenshot

Here some screenshot on working system:
![main-player-dash](https://cloud.githubusercontent.com/assets/1006000/15361660/faf92ab0-1d44-11e6-8d1e-c3fa18c5b621.png "Image show you player dashboard.")

## Wiki

In progress. Will be ready soon.

## Credit

  1. Twitter [Bootstrap v3.3.6](https://github.com/twbs/bootstrap)
  2. Dashboard Statistic inspired by [SB Admin v2.0](http://blackrockdigital.github.io/startbootstrap-sb-admin-2/pages/index.html).
  3. [Jquery](https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js)

## License

[![CC Attribution 4.0 International License](https://i.creativecommons.org/l/by/4.0/88x31.png)](http://creativecommons.org/licenses/by/4.0/legalcode.txt)

This work is licensed under a Creative Commons Attribution 4.0 International License.
