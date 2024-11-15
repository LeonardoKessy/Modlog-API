# Modlog
## Catalogo de mods | Projecto TUDAI Web 2

API REST de Modlog.


## Tabla de contenidos:
- [Modlog](#modlog)
- [Cargar Sitio](#como-cargar-el-sitio)
- [Usuarios](#usuarios)
- [Endpoints](#endpoints)
  - [Games](#games)
  - [Categories](#categories)
  - [Mods](#mods)
  - [Creators](#creators)
  - [Users](#users)
- [JWT](#jwt)




---

## Como cargar el sitio:
- Clonar el repositorio y colocar la carpeta "Modlog" en "xampp/htdocs/". 
- Asegurarse de tener Apache y MySQL activos en xampp.
- En caso de utilizar Postman: Asegurarse de abrir Postman Agent para utilizar localhost.
- Hacer request a cualquier endpoint. Se ejecuta autodeploy de ser necesario. 

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

<div style="width: 100%, border-bottom: 2px solid #ccc" ></div>

### Games
#### Campos: 
**id**(int), name(varchar), description(varchar), image(varchar)

*description e image pueden ser null.*
| Metodo    | URI                              |
|-----------|----------------------------------|
| GET       | localhost/Modlog/api/games       |
| GET       | localhost/Modlog/api/games/:id   |
| POST      | localhost/Modlog/api/games       | 
| PATCH     | localhost/Modlog/api/games       | 
| DELETE    | localhost/Modlog/api/games/:id   | 

#### POST Example (JSON):
{
  "name": "New Game",
  "description": "New Description"
}

<div style="width: 100%, border-bottom: 2px solid #ccc" ></div>

### Categories
#### Campos: 
**id**(int), *id_game*(int), name(varchar)
| Metodo    | URI                                 |
|-----------|-------------------------------------|
| GET       | localhost/Modlog/api/category       |
| GET       | localhost/Modlog/api/category/:id   |
| POST      | localhost/Modlog/api/category       | 
| PATCH     | localhost/Modlog/api/category       | 
| DELETE    | localhost/Modlog/api/category/:id   | 

#### POST Example (JSON):
{
  "id_game": 1,
  "name": "New Category"
}

<div style="width: 100%, border-bottom: 2px solid #ccc" ></div>

### Mods
#### Campos: 
**id**(int), *game_id*(int), *category_id*(int), *creator_id*(int), name(varchar), description(varchar), creation_date(date), github_link(varchar), download_link(varchar), image(varchar)

*description, github_link e image pueden ser null.*
| Metodo    | URI                             |
|-----------|---------------------------------|
| GET       | localhost/Modlog/api/mods       |
| GET       | localhost/Modlog/api/mods/:id   |
| POST      | localhost/Modlog/api/mods       | 
| PATCH     | localhost/Modlog/api/mods       | 
| DELETE    | localhost/Modlog/api/mods/:id   | 

#### POST Example (JSON):
{
  "game_id": 1,
  "category_id": 1,
  "creator_id": 1,
  "name": "New Game",
  "description": "New Description"
  "creation_date": "2024-11-17",
  "download_link": "www.link.com"
}

<div style="width: 100%, border-bottom: 2px solid #ccc" ></div>

### Creators
#### Campos: 
**id**(int), name(varchar), profile_link(varchar)
| Metodo    | URI                                 |
|-----------|-------------------------------------|
| GET       | localhost/Modlog/api/creators       |
| GET       | localhost/Modlog/api/creators/:id   |
| POST      | localhost/Modlog/api/creators       | 
| PATCH     | localhost/Modlog/api/creators       | 
| DELETE    | localhost/Modlog/api/creators/:id   | 

#### POST Example (JSON):
{
  "name": "Creator",
  "profile_link": "www.github.com"
}

<div style="width: 100%, border-bottom: 2px solid #ccc" ></div>

### Users
Campos: **id**(int), username(varchar), email(varchar), password(varchar)
| Metodo    | URI                                 |
|-----------|-------------------------------------|
| POST      | localhost/Modlog/api/users          | 
| GET       | localhost/Modlog/api/users/token    |

#### POST Example (JSON):
*Crea nuevo usuario. No requiere permisos especiales.*
{
  "username": "NotHomer",
  "email": "email@godmail.com",
  "password": "Simpson"
}

---

## JWT
Necesario para llamados a funciones de POST, PATCH y DELETE.

#### Utilizando Postman:
- Seleccionar en la pestaña de Authorization "Basic Token"
- Ingresar en la misma pestaña email y contraseña del usuario que se pretende logear.
- Hacer un request GET a localhost/Modlog/api/users/token. 
  - Esto devuelve un token JWT en el cuerpo de la respuesta.
- Cambiar el tipo de Authorization a "Bearer Token"
- Ingresar el token recibido (*sin comillas*)
- Listo. Mientras este seteado el token, el usuario se va a mantener.
  - Tener en cuenta que solo un usuario administrador puede utilizar POST, PATCH, y DELETE.

