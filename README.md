# Trumpet

A simple twitter-like CRUD app written in php.

### Prerequisites

- php
- mysql
- composer
- npm (optional)

### How to install

```bash
# install composer dependencies
composer install 
# install tailwind (optional)
npm install 
# run tailwind cli (optional)
npx tailwindcss -i ./public/css/input.css -o ./public/css/output.css --watch 
```

configure db credentials in bootstrap.php </br>
defaults are: </br>
<pre>
user: root
password: &lt;empty&gt;
db name: trumpet
</pre>

import db

```bash
mysql -u <username> -p <db_name> < trumpet_dump.sql
```
