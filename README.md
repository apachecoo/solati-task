# Proyecto Laravel 12 Contenerizado

Este proyecto corresponde a una aplicación **Laravel 12** configurada para ejecutarse en un entorno completamente contenerizado mediante **Docker**. La estructura principal del entorno se encuentra dentro del directorio `.docker/`.

A continuación se explica cómo levantar el entorno local, ejecutar migraciones y acceder a la API.

---

## 📁 Estructura del entorno Docker

```
.docker/
└── local
    ├── db
    │   ├── data
    │   ├── my.cnf
    │   └── sql
    ├── docker-compose.yml
    ├── logs
    │   ├── mysql-error.log
    │   ├── mysql-query.log
    │   └── mysql-slow.log
    ├── nginx
    │   ├── default.conf
    │   └── nginx.conf
    ├── php
    │   ├── docker.conf
    │   ├── Dockerfile
    │   ├── laravel_cron
    │   ├── php.ini
    │   ├── scripts
    │   │   ├── init.sh
    │   │   └── run_schedule.sh
    │   └── supervisord.conf
    ├── phpmyadmin
    └── redis
        └── data
            ├── appendonlydir
            │   ├── appendonly.aof.1.base.rdb
            │   ├── appendonly.aof.1.incr.aof
            │   └── appendonly.aof.manifest
            └── dump.rdb
```

---

## 🚀 Levantar el entorno de desarrollo

1. Ubicarse dentro del directorio:

```bash
cd .docker/local
```

2. Construir y levantar los contenedores:

```bash
docker compose up -d --build
```

Esto levantará los servicios configurados (PHP, Nginx, MySQL, Redis, etc.).

---

## 🔧 Ejecutar migraciones de Laravel

Una vez los contenedores estén arriba, ingresar al contenedor de PHP:

```bash
docker exec -it back-php-tasks bash
```

Luego ejecutar:

```bash
php artisan migrate
```

---

## 🌐 Acceso a la API

La API estará disponible en el puerto configurado para Nginx. Por defecto:

```
http://localhost:81
```

Si cambiaste el puerto en el `docker-compose.yml`, usa el correspondiente.

---

## ✔️ Notas

* Asegúrate de tener Docker y Docker Compose instalados correctamente.
* Verifica permisos de escritura sobre los directorios `data/` y `logs/`.
* Puedes acceder a phpMyAdmin si está habilitado en el `docker-compose.yml`.

---

## 📬 Soporte

Para cualquier duda o mejora, puedes extender este README o documentar configuraciones adicionales del entorno.
