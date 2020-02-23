# Install Instructions

1. Go to the directory where you want the to install to
2. `git clone git://github.com/tareko/Kitab-Al-Shifa.git kitab`
3. `cd kitab`

4. Initialize submodules:
```
git submodule init
git submodule update
```

5. Make sure `app/tmp/` and subdirectories are writeable by the webserver

6. Config directory
	a. `cp app/Config/core.php.default app/Config/core.php`
	b. `cp app/Config/database.php.default app/Config/database.php.default`
	c. `cp app/Config/email.php.default app/Config/email.php`

7. Create a cron that hits the following:
	a. /trades/startUnprocessed
	b. /trades/completeAccepted


# Docker instructions

```
cd docker
docker-compose up
```

# Docker development instructions

```
cd docker
docker-compose -f docker-compose.yml -f docker-compose.dev.yml
```

The dev server's ports are:

 * Web: http://localhost:9180
 * Mailhog: http://localhost:9125
 * Mysql: http://localhost:9106 

# Non-Docker instructions
8. Add the `kitab.sql` and `joomla.sql` schema if needed

9. Add to your php.ini: `max_input_vars = 10000`

10. Install `wkhtmltopdf` from the site (otherwise, you may not have proper PDFs):
	a. http://wkhtmltopdf.org/downloads.html
	b. Configure the location in `bootstrap.php`

