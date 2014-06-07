# LaravelPress


Laravel package that works with Wordpress CMS Backend. This package is meant for people who want to create a custom front end for Wordpress

This is based on the work of Junior Grossi. More info [here](http://grossi.io/2014/working-with-laravel-4-and-wordpress-together/)

## Installation

### Package Installation
To install, simply add it to your requirements in the composer.json file
```
"asianchris/laravelpress":"*"
```

Then run composer update to install the package
```
composer update
```

You'll then need to add it to the Service Providers in your app.php
```
'Asianchris\Laravelpress\LaravelpressServiceProvider'
```

### Publish Package

#### Config
```
php artisan config:publish asianchris/laravelpress
```

#### View
```
php artisan view:publish asianchris/laravelpress
```
The view blade templates are very basic and are meant to give you a quick step into building your site. Once published, feel free to modify to match your needs.

*The views are mainly for developer who want to create their site from the ground up. Why else you be looking at this?*

#### Assets
```
php artisan asset:publish asianchris/laravelpress
```
This is optional, but it will give you basic CSS for the packaged templates.

Don't forget to include it in your layout blade if you use it. Like the views, feel free to modify as you seem fit.
```
<link rel='stylesheet' href='/package/asianchris/laravelpress/css/laravelpress.css' type='text/css' />
```


## Usage

### Config
There's only a few configurations that are required, and most of them use the default values for Laravel

* **database_connection** This is the database connection to use. Don't forget to set the prefix in your database config file
* **baseURL** This is the base url for the routing. This is done in case you want to change to something else, like /blog
* **layout** This is the layout blade that views will extend

### Views
Your layout view will need to yield() sections that the views are using.

Towards the top of the <head>, include the meta section. This will handle the logic for things like the <title> tag
```php
yield('meta')
```

Then include the content section into the area where you want the content
```php
yield('content')
```

### Routes
Other than the baseURL in the configuration settings, you can change the routes by adding it into your routes.php. The routes here will take precedence over the package routes when they overlap.

## Models
To understand the models, you need to have some knowledge of the Wordpress database.

### Content
This is the main model that looks at the posts table. Model follows standard Eloquent functions

Additional Functions
```php
//Published Content
$content = Content::published()->get();

//Content By Tag Slug
$content = Content::tagSlug('tag-slug')->get();

//Content By Category Slug
$content = Content::categorySlug('category-slug')->get();

//Content by Post Type (example shows post post-type)
$content = Content::type('post')->get();

```

### Post
Extends the Content Model. Automatically sets the post-type as 'post'

### Page
Extends the Content Model. Automatically sets the post-type as  'page'

### Media
Extends the Content Model. Automatically sets the post-type as  'attachment'

### Option
Looks at the options table.

```php
//Get option
$option = Option::option($name)->get();

//Get option value. This only returns the value of that option!
$option_value = Option::getOption($name);

```

### Author
Looks at the users table. This is named Author as to not conflict w/ the default Laravel User model
