# Laravel 4 Asset Pipeline Package For Emblem.js

Bring in your `.emblem` templates into your Laravel 4 application.

## Installation

Edit your project's `composer.json` file to require `andriybazyuta/l4-asset-emblem`.

It might look something like:

```php
  "require": {
    "laravel/framework": "4.0.*",
    "andriybazyuta/l4-asset-emblem": "dev-master"
  }
```

Next, update Composer from the Terminal:

```php
    composer update
```

Once this operation completes, add the service provider. Open `app/config/app.php`, and add a new item to the providers array.

```php
    'Andriybazyuta\L4AssetEmblemjs\L4AssetEmblemjsServiceProvider'
```


## Usage

Once installed you can add this your Asset pipeline manifest file `[laravel_root]/app/assets/javascripts/application.js`

```
	//= require handlebars
  //= require ember
  and
  <?= javascript_include_tag("emblem") ?> in your view
```

Now create a file `app/assets/javascripts/myfirst.jst.hbs`

```html
	Put some .emblem templates to, /assets/javascript/templates of /assets/javascript/SOME_FOLDER/templates  folder 
```

After refreshing the page inspect JST object in the javascript console and the function

```
  Ember.TEMPLATES["mytemplate"] = Emblem.compile(Ember.Handlebars, "template content");
```
