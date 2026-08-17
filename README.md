# Mlemer

![Progress](https://img.shields.io/badge/Status-Heavy%20Development-red.svg)
![Status](https://img.shields.io/badge/Progress-Incomplete-orange.svg)

**SUCH FILES, MANY BUGS, MUCH CODE, NO WOW**

**Mlemer** is a quiz, exercise, CTF or questionnaire system designed for a trainer running a session on a local network (a classroom, a workshop, an internal CTF). It is not suitable for public-internet deployment. Used at your own risk.

## Table of Content
  1. [Requirement](#requirement)
  2. [Installation](#installation)
  3. [Usage](#usage)
  4. [Security](#security)
  5. [Screenshot](#screenshot)
  6. [Credit](#credit)
  7. [License](#license)


## Requirement

  * PHP 8.0+ with the `mysqli` extension.
  * MySQL or MariaDB.
  * Apache with `mod_rewrite`/`.htaccess` support (for `/admin` Basic Auth), or an equivalent auth layer if you're on a different web server.
  * A set of exercise questions and answers ready to load once the admin panel is up.

## Installation

  * Download/clone the repo into your web root (e.g. `C:\wamp64\www\mlemer`).
  * Create a MySQL/MariaDB database, e.g. `mlem_db`, and import `mlem_db.sql` into it.
  * Copy `inc/config_sample.php` to `inc/config.php` and fill in your database host/user/password/database name. `inc/config.php` is gitignored - never commit it.
  * Generate `admin/.htpasswd`:

    ```
    htpasswd -c admin/.htpasswd admin
    ```

    (drop `-c` if the file already exists and you're adding another admin user). `admin/.htpasswd` is gitignored - never commit it. See `admin/.htpasswd.sample` for a reminder.
  * Edit `admin/.htaccess` so `AuthUserFile` points at the real, absolute path of your `admin/.htpasswd` on disk, e.g.:

    ```
    AuthUserFile C:\wamp64\www\mlemer\admin\.htpasswd
    AuthName "Administrative Area"
    AuthType Basic

    require user admin
    ```
  * Browse to `http://localhost/mlemer/` and register a player account, or `http://localhost/mlemer/admin/` (prompts for the Basic Auth credentials you just set) to configure categories, exercises and questions first.

## Usage

As a player or training participant:
  * Go to `http://localhost/mlemer/` and register a username, real name and password.
  * You'll land on the Dashboard once registered/logged in, and can pick an available exercise to answer questions and rack up points on the leaderboard.
  * The Account page lets you change your username/password or delete your account.

As the trainer/admin:
  * `http://localhost/mlemer/admin/` (behind Basic Auth) lets you set the page title/branding, and manage categories, exercises, questions and registered players.

## Security

This started as a small 2016 training tool and had accumulated a number of real vulnerabilities: SQL injection via string-concatenated queries, stored/reflected XSS from unescaped output, plaintext password storage, a non-functional login system (visitor identity was derived from the *server's* own hostname rather than the visitor, so concurrent users collided into the same account), missing CSRF protection (including GET-triggered admin deletes), a route that let any logged-in player reach admin-only pages without the `/admin` Basic Auth, and a committed `admin/.htpasswd` with a real password hash.

This pass fixed all of the above: every database query now uses parametrized `mysqli` prepared statements, all output is escaped with `htmlspecialchars()`, passwords are hashed with `password_hash()`/verified with `password_verify()`, login/registration use real PHP sessions (`session_regenerate_id()` on login to prevent fixation), every state-changing form carries and checks a CSRF token, admin deletes are POST-only, and the admin-page router bypass is closed.

**If you have an existing deployment of this app from before this change:** the admin password hash that was previously committed to this repo (and the `admin:adminadmin987` default this README used to publish) must be treated as compromised. Regenerate `admin/.htpasswd` with a new password. Existing player rows have empty passwords (the old registration flow didn't hash anything) - players will need to re-register.

This is still meant for a trusted local network, not the open internet - there's no rate limiting on login attempts, no email verification, and no "remember me"/password-reset flow.

## Screenshot

Here some screenshot on working system:
![main-player-dash](https://cloud.githubusercontent.com/assets/1006000/15361660/faf92ab0-1d44-11e6-8d1e-c3fa18c5b621.png "Image show you player dashboard.")

## Credit

  1. Twitter [Bootstrap v3.3.6](https://github.com/twbs/bootstrap)
  2. Dashboard Statistic inspired by [SB Admin v2.0](http://blackrockdigital.github.io/startbootstrap-sb-admin-2/pages/index.html).
  3. [jQuery](https://jquery.com/)

## License

[![CC Attribution 4.0 International License](https://i.creativecommons.org/l/by/4.0/88x31.png)](http://creativecommons.org/licenses/by/4.0/legalcode.txt)

This work is licensed under a Creative Commons Attribution 4.0 International License.
