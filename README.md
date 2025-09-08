# Laravel

## Jetstream Starter kit (con Livewire)

```bash
composer require laravel/jetstream
```

```bash
php artisan jetstream:install livewire
```

### Crear modelo, migracion y factory

```bash
php artisan make:model Post -mf
```

## Relaciones

```php
public function friends() {
    return $this->belongsToMany('friends', 'from_id', 'to_id');
}
```

- __friends:__ Tabla intermedia
- __from_id:__ pk
- __to_id:__ fk
