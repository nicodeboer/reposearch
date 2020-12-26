#Repository search

Author: Nico de Boer

Date: 2020-12-26

Repo search is a simple RESTful API handler / proxy for searching in public repositories like Github, Gitlab and Bitbucket.

Built in PHP with usage of version 7.4 and composer.

##Setup

Clone or download the repository en run 'composer install' to download the depency packages.

Then make a copy of the .env.example file to '.env' and fill the needed configuration items like the Gitlab token to use that repository search.

All incoming traffic should then be redirected to index.php by webserver configuration. Or run the API server with the PHP built in webserver with 'php -S localhost:8000' (or any other available port).

##Usage

After you have setup the code and server, point your API client to 'http(s)://<url>/v1/search?q=<query>', where <url> is the host you are running the API server and <query> the search query you want to perform.

The search will return a JSON with result from the repositories. For now this is the merged results from the repositories in their own format, so these are not yet made consistent.

##Code layout

All code can be found in the 'src' folder and consists of three 'sub' packages:

* Authorization: For token / IP address based access (not actually implemented).
* ApiRequest: Handling API requests. Now only consists of handling 'GET' requests to search within repositories.
* RepoSearch: The actual search within the repositories. Implemented are searches in Github (no authorization required, but limited search rates) en Gitlab (private token required to search).

A small and rather useless set of PHP Unit tests have been setup as a start.

Exception handling has been setup, but not very well tested.

The 'index.php' file handles all request by performing the next flow:

1. Check for authorization. Always allowed, since some backend setup needs to be implemented for restricting by token and/or IP address whitelisting.
2. Call to API request handler, which will route to the requested query handler with the requested version. The API versioning has also not yet been setup.
3. The repository search is called from the search API handler.

