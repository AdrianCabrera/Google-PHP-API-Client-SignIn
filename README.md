# Google PHP API Client Examples
A simple Sign In example using Google PHP API Client.

## Steps

1. Create a Google Developer account on [Google Developer Console](https://console.developers.google.com). 
2. Create an App on [Google Developer Console - Create Project ](https://console.developers.google.com/projectcreate).
3. Create an OAuth Client ID on [Google Developer Console - Create Client ID ](https://console.developers.google.com/apis/credentials/oauthclient).
4. Install Google PHP API Client through composer.
```cmd
composer install
```
5. Use your App's CLIENT_ID and CLIENT_SECRET on the file app/classes/GoogleAuth.php.

```php
$this->client->setClientId('CLIENT_ID');
$this->client->setClientSecret('CLIENT_SECRET');
$this->client->setRedirectUri('http://localhost');
$this->client->setScopes('email');
```
6. Start your server from the root folder. For example:
```cmd
php -S localhost:80
```

7. Access the web page going to: [Localhost](http://localhost).