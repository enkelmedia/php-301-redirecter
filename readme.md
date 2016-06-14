301 redirecter for PHP
=====
## What's this?
This little framework is very usable when you're moving a website from one domain to another. It helps you to redirect (using 301 or 302) to a new domain to keep your SEO-rankings.

## How does it work? 
All incomming requests to the webservers routes to the index.php-file. This file opens a list of predefined redirects - it the current URI matches one of the redirects a 301 (or 302) is returned to redirect the client browser (or a search engine) to this page.

If no match is found the URI is stored on the "notFound.json"-file so that an administrator can check this file to found out missing redirects and updage the predefined redirects. After this the script returns a 301 (or 302) pointing to the "defaultRedirect" configured in the redirects.json-file.

## Configuration
Open the redircts.json-file and change the settings to suite your needs.

## Disclaimer
The coode is buildt for small scale redirects and the code is quite "crappy" I know. This time it was done with the the KISS-principle very much in mind =D.
