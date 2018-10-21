Yii2 ydb
===========
Database reader for Yii2 framework.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Add

```
"repositories":[
    {
        "type": "git",
        "url": "https://github.com/Apache02/yii2-ydb.git"
    }
]
```

to your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

Add

```php
'db' => [
	'class' => 'apache02\ydb\Module'
]

```
to config of your application.
