# Product API
This API provides products data.

### Getting Started
Use `devenvironment` repo to start application.
You can then browse to http://localhost:8080.

### Development mode
Enabling development mode will also clear your configuration cache, to
allow safely updating dependencies and ensuring any new configuration is picked
up by your application.

```
composer development-enable
```
```
composer development-disable
```
```
composer development-status
```

### Configuration cache
By default, will create a configuration cache in
`data/config-cache.php`. When in development mode, the configuration cache is
disabled, and switching in and out of development mode will remove the
configuration cache.

You may need to clear the configuration cache in production when deploying if
you deploy to the same directory. You may do so using the following:

```
composer clear-config-cache
```

You may also change the location of the configuration cache itself by editing
the `config/config.php` file and changing the `config_cache_path` entry of the
local `$cacheConfig` variable.

## Endpoints
TBC
