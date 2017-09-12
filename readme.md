![alt text](https://lunapunto.com/remoteassets/github.png)

# Luna Punto Corps WP v1.0

Esqueleto para templates de Wordpress

## Prerequisitos

* [MAMP](https://www.mamp.info/en/) - Apache - MySQL - PHP local server o similar
* [Node.js](https://nodejs.org/es/) - Dependecy Manager JS
* [PHP > 5.6 ](http://php.net/manual/es/intro-whatis.php) - Backend
* [Composer](https://getcomposer.org/) - Dependecy Manager PHP
* [Grunt](https://gruntjs.com/) - Task runner

Clonar proyecto en htdocs o directorio raiz del servidor local.

Busca actualizaciones

```
git status
```
y

```
git pull
```

## Instalación

Instala las dependencias

```
npm install
```
```
composer install
```

Si no funciona elimina el directorio node_modules y vendor

```
rm -rf node_modules
```

```
rm -rf vendor
```

Corre en servidor local

```
grunt dev
```

## Subir en producción

Corre el comando

```
grunt public
```

Copia los contenidos de / en  wp-content/themes 

## Autores

* **Mauricio Martínez Robles** - *Desarrollo Inicial* - *2016-* [Luna Punto](https://lunapunto.com)
