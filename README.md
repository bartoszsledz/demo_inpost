**Install:**

```bash
  docker-compose -f docker/docker-compose.yml up -d --build
```

```bash
  docker exec -it inpost-demo-app composer install --no-interaction --prefer-dist --optimize-autoloader
```

**Usage:**

```bash
  docker exec -it inpost-demo-app php bin/console app:fetch-inpost-data points Kozy
```

```
  http://localhost:9000/points
```

**Tests:**

```bash
  docker exec -it inpost-demo-app php bin/phpunit
```