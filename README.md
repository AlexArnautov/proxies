## Assigment

Create proxy provider with easy usage of various sources of proxy servers.

## Installation Instructions
1) Clone the repository and navigate to the proxies directory.
2) Run the script up.sh (. up.sh)
   The script may ask for the sudo password to set permissions on the storage directory.

The script will deploy the application on localhost and execute all tests.
You can also add the line 127.0.0.1 laravel.local to the hosts file in your OS.
The application will be accessible at laravel.local.

## Used Third-Party Libraries
1) https://laravel-excel.com/
2) https://jwt-auth.readthedocs.io/en/develop/

## Connecting a New Proxy Provider
1) Create a new provider class analogous to app/Services/RandomProxyProvider.php that implements the ProxyProviderInterface.php interface.
2) Create a repository for this provider (example app/Repositories/RandomProxyRepository.php)
3) In the service provider file app/Providers/ProxyServiceProvider.php, add a binding of the new interface for the created repository.

This way, you can simultaneously use various sources of proxy servers simply by connecting the necessary repositories through Dependency Injection.

Also, there is a Postman collection for testing in the project's root. (uses laravel.local URL)
FileName: laravel.postman_collection.json

