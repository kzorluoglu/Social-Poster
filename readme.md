# Social Poster 
Master [![Build Status](https://travis-ci.com/kzorluoglu/Social-Poster.svg?branch=master)](https://travis-ci.com/kzorluoglu/socialposter)

develop [![Build Status](https://travis-ci.com/kzorluoglu/Social-Poster.svg?branch=develop)](https://travis-ci.com/kzorluoglu/Social-Poster)


Social Poster is a simple Post with Images/Videos/File sender for Multi Accounts/Pages (Facebook Pages and Twitter Accounts)

  - Text Posting for Multiple Pages and Accounts
  - Text with Image-\s Posting for Multiple Pages and Accounts

# Screenshots
Home

![Home](https://i.ibb.co/pfMDSWS/Home.png)

Admin

![Home](https://i.ibb.co/XW1hxSr/Admin.png)

Queue

![Queue](https://i.ibb.co/fF3JJFV/Queue.png)

Success

![Success](https://i.ibb.co/0n0m95q/Success.png)

Error

![Error](https://i.ibb.co/HzHGMyC/Error.png)

 
# New Features?

  - Please create new Issue.

### Tech

Social Poster uses a number of open source projects to work properly:

* [facebook/graph-sdk] - Facebook SDK for PHP (v5)
* [dg/twitter-php] - Twitter for PHP is a very small and easy-to-use library for sending messages to Twitter and receiving status updates.
* [dillinger.io] - Markdown editor for this readme.md creating/editing. Fast and easy to extend.
* [Twitter Bootstrap] - great UI boilerplate for modern web apps
* [jQuery] - duh

### Standarts

* PSR-2

### Installation

1. Update **Uploads** Settings.
```
src\Helper\Upload.php
```
```
 */
class Upload {

    protected $allowedTypes = ['image/jpg', 'image/jpeg', 'image/gif', 'image/png'];
    ...
    protected $uploadDirectory = "/var/www/uploads/";
```
2. Open Admin Page and add your Socail Media Accounts
    
### Integration

Facebook
 - Create Facebook Developer Account
 - Create Simple App
    -  Fill **App Domains** and **Privacy Policy URL**  under **Settings -> Basic**
    -  Call **https://developers.facebook.com/tools/explorer/**
    -  Select **Your App** under **Application** Select
    -  Select **Get User Access Token** under **Get Token** Button
        - Select **manage_pages**, **pages_messaging**, **pages_show_list** Permissions from opened Pop-up
        - Click then Get Access Token
    -  Select Your Page from **Page Access Token** under **Get Token** Button
    -  Click **i** icon after Access Token Creating
    -  Click Open in **Access Token Tool** from **opened Pop-up**
    -  Click **Generate Long Lived Token**

Twitter
 - Create Twitter Developer Account
 - Create App
    - Click App Details 
    -  This Keys will be located under **Keys and tokens** Menu

### Todos

 - Write Tests

### Tests & Coding standard

```
# Run PHPUnit
./vendor/bin/phpunit
# Run PHP_CodeSniffer
./vendor/bin/phpcs
```

License
----

MIT


**Free Software, Hell Yeah!**

[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)

   [facebook/graph-sdk]: <https://github.com/facebook/php-graph-sdk>
   [dg/twitter-php]: <https://github.com/dg/twitter-php>
   [dillinger.io]: <https://dillinger.io/>
   [Twitter Bootstrap]: <http://twitter.github.com/bootstrap/>
   [jQuery]: <http://jquery.com>
  