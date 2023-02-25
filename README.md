# konectaCafeteria
## Tabla de contenidos
1. [Informacion General](#informacion-general)
2. [Tecnologias](#tecnologias)
3. [Creacion y ejecucion del proyecto](#creacion-y-ejecucion-del-proyecto)
4. [Consultas directas a la BD](#consultas-directas-a-la-bd)

### Informacion General
***
El software que se ha subido en este repositorio pretednde dar solucion a un sistema de alamacenamiento y gestion para una cafeteria en la sede de la empresa Konecta. Dicho software permite agregar productos y ventas, asi como su respectivas operaciones CRUD.
Se implemento tambien un sistema de registro e ingreso de usuarios.
### Screenshot
A continuacion se presentan imagenes de como se ve el software ya en funcionamiento.

En primer lugar se puede ver la pagina de registro para los usuarios:
![Image text](https://raw.githubusercontent.com/juanda943/konectaCafeteria/main/register.PNG)

A continuacion se muestra el listado de productos:
![Image text](https://raw.githubusercontent.com/juanda943/konectaCafeteria/main/productos.PNG)

Por ultimo se enseña el formulario para registro de ventas:
![Image text](https://raw.githubusercontent.com/juanda943/konectaCafeteria/main/addventa.PNG)



## Tecnologias
***
Las tecnologias utilizadas para realizar este proyecto fueron:
* [PHP](https://www.php.net/): Version 8.0.25 
* [Composer](https://getcomposer.org/): Version 2.5.4
* [Laravele](https://laravel.com/): Version 9.52.4
* [MySQL/MariaDB](https://www.mysql.com/): Version 10.4.27
## Creacion y ejecucion del proyecto
***
Para la creacion del proyecto se utilizo la ayuda del manejador de dependencias Composer. Los siguientes comandos se utilizaron para la creacion del proyecto asi como la ejecucion del servidor y la instalacion de la base de datos: 
```
$ composer create-project laravel/laravel konectaCafeteria
$ cd example-app
$ composer require laravel/ui
$ php artisan serve
$ php artisan make:migration
$ php artisan ui bootstrap --auth
```
Ademas de los comandos anteriormente expuestos tambien se utilizo el manejador de paquetes de node con sus respectivos comandos:
```
$ npm install
$ npm run dev
```

## Consultas directas a la BD
***
Como ultimo apartado tenemos las 2 ```consultas directas a la base de datos``` con el objetivo de obtener el producto con mayor stock y tmabien el producto con mayor cantidad vendidad.
Tenemos entonces

1. **Consulta para el producto con mayor stock**
```
Select max(stock),id from productos order by max(stock) desc limit 1;
```
2. **Consulta para el producto mas vendido**
```
select sum(cantidad), producto_id from ventas group by producto_id
```
