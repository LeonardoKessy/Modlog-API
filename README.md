# Modlog
## Catalogo de mods | Projecto TUDAI Web 2

Modlog es un catalogo de mods de videojuegos, que categoriza y provee links de acceso a las distintas creaciones.
¿Que es un mod? Un mod, proveniente de "modificación". Es un contenido o cambio aplicado a un juego creado por fans del mismo, usualmente programado en el lenguaje base de este.


## Tabla de contenidos:
- [Modlog](#modlog)
- [Cargar Sitio](#como-cargar-el-sitio)
- [Usuarios](#usuarios)
- [Endpoints](#endpoints)
  - [Games](#games)
  - [Categories](#categories)
  - [Games](#games)
  - [Creators](#creators)





---

## Como cargar el sitio:
- Clonar el repositorio y colocar la carpeta "Modlog" en "xampp/htdocs/". 
- Hacer request a cualquier endpoint. Se ejecuta autodeploy. 

---

## Usuarios
#### User sin permisos:
- Email: user@gmail.com
- Password: user

#### User con permisos:
- Email: admin@gmail.com
- Password: admin

---

## Endpoints
*Cualquier campo no perteneciente a la tabla llamada sera ignorado. POST no necesita obligatoriamente los campos opcionales.*

#### Games
Campos: **id**(int), name(varchar), description(varchar), image(varchar)
*description e image pueden ser null.*
| Metodo    | URI                              |
|-----------|----------------------------------|
| GET       | localhost/Modlog/api/games       |
| GET       | localhost/Modlog/api/games/:id   |
| POST      | localhost/Modlog/api/games       | 
| PATCH     | localhost/Modlog/api/games       | 
| DELETE    | localhost/Modlog/api/games/:id   | 

*POST Example:*
{
  "name": "New Game",
  "description": "New Description"
}



#### Categories
Campos: **id**(int), *id_game*(int), name(varchar)
| Metodo    | URI                                 |
|-----------|-------------------------------------|
| GET       | localhost/Modlog/api/category       |
| GET       | localhost/Modlog/api/category/:id   |
| POST      | localhost/Modlog/api/category       | 
| PATCH     | localhost/Modlog/api/category       | 
| DELETE    | localhost/Modlog/api/category/:id   | 


*POST Example:*
{
  "id_game": 1,
  "name": "New Category"
}



#### Mods
Campos: **id**(int), *game_id*(int), *category_id*(int), *creator_id*(int), name(varchar), description(varchar), creation_date(date), github_link(varchar), download_link(varchar), image(varchar)
*description e image pueden ser null.*
| Metodo    | URI                              |
|-----------|----------------------------------|
| GET       | localhost/Modlog/api/games       |
| GET       | localhost/Modlog/api/games/:id   |
| POST      | localhost/Modlog/api/games       | 
| PATCH     | localhost/Modlog/api/games       | 
| DELETE    | localhost/Modlog/api/games/:id   | 

*POST Example:*
{
  "game_id": 1,
  "category_id": 1,
  "creator_id": 1,
  "name": "New Game",
  "description": "New Description"
  "creation_date": "2024-11-17",
  "download_link": "www.link.com"
}



#### Creators
Campos: **id**(int), name(varchar), profile_link(varchar)
| Metodo    | URI                                 |
|-----------|-------------------------------------|
| GET       | localhost/Modlog/api/creators       |
| GET       | localhost/Modlog/api/creators/:id   |
| POST      | localhost/Modlog/api/creators       | 
| PATCH     | localhost/Modlog/api/creators       | 
| DELETE    | localhost/Modlog/api/creators/:id   | 

*POST Example:*
{
  "name": "Creator",
  "profile_link": "www.github.com"
}