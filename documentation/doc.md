Start project in background (server:stop)
```
symfony serve -d
```

Start server with public folder as main
```
bin/console server:run
```
Secret Vault Key (DEV - blank usually + PROD)
```
php bin/console secret:set SENTRY_DSN
php bin/console secret:set SENTRY_DSN --env=prod
```

Secret list DEV + PROD
```
php bin/console secret:list
php bin/console secret:list --reveal
php bin/console secret:list --env=prod
php bin/console secret:list --reveal --env=prod
```


Maker
```
php bin/console make:command
```

# Debug and config files
Commandes
```
bin/console
```

Services
```
php bin/console debug:container
php bin/console debug:container markdown (look for specific name)
php bin/console debug:container --parameters (parameters)
php bin/console debug:container --parameters --end=prod (forcer env en prod)
```

Autowired classes 
```
php bin/console debug:autowiring
php bin/console debug:autowiring markdown (look for specific name)
```

Twig docs
```
php bin/console debug:twig
```

Config bundle
```
php bin/console config:dump KnpMarkdownBundle
php bin/console config:dump FrameworkBundle
```

Config en cours bundle
```
php bin/console debug:config FrameworkBundle 
```

Routes
```
php bin/console debug:router
```

See environnement variables env + env.local
```
php bin/console about
```