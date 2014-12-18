facebook
---  

[![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/cfralick/facebook?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

A Guzzle client for consuming the Graph Api. 

[![Build Status](https://travis-ci.org/cfralick/facebook.svg)](https://travis-ci.org/cfralick/facebook)  


__install:__  
```bash
$ composer require cfralick/facebook
$ export FACEBOOK_CLIENT_ID=your-client-id
$ export FACEBOOK_CLIENT_SECRET=your-client-secret
```  

__use:__  
```php
php> require_once __DIR__ . '/vendor/autoload.php';
php> $container = new Facebook\Container;
php> echo $container['facebook.client']->page('facebook');
{
    "facebook_id": 9898993, 
    "username": "facebook", 
    "name": "Facebook",
    "category": "Company"
}
```

