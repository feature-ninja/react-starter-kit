# Feature Ninja + React Starter Kit

This starter kit is based on the official [Laravel React Starter Kit](https://github.com/laravel/react-starter-kit) that
has been restructured in an opinionated way. It consists of marketing section and control panel, each with their own
asset bundle. It also ships with a fully configured [PHPStan](https://github.com/phpstan/phpstan) setup thanks to
[Larastan](https://github.com/larastan/larastan)!

## Asset bundling

In order to simplify handling multiple asset bundles you can use the `php artisan bundle <npm script>` command. You can
use the `--clean-install` flag to ensure the NPM dependencies are reinstalled, and limit which bundles to build by using
the `--only=<bundle a,bundle b,bundle c>` option.

```bash
# Start Vite development server for both sections
php artisan bundle dev

# Build asset for production
php artisan bundle build
```

## Structure

Besides the multiple sections the code is also grouped by feature and placed next to each other. So instead of putting
all the controllers in a `Controllers` directory and all the form requests in a `Requests` directory they are now
grouped together. Additionally, all the tests have been placed inlined with their feature.
