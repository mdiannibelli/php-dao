# Sistema de Gestión de Libros y Autores

Este proyecto es un sistema de gestión para libros y autores, implementado en PHP siguiendo una arquitectura MVC (Modelo-Vista-Controlador).

## Estructura del Proyecto

```
├── app/                    # Directorio principal de la aplicación
│   ├── config/            # Configuraciones y helpers
│   ├── controllers/       # Controladores de la aplicación
│   │   ├── AuthorController.php
│   │   └── BookController.php
│   ├── model/            # Modelos y entidades
|   |   ├── repositories/ # Acceso a datos
│   │   |   ├── FileDao.impl.php
│   │   |   └── PdoDao.impl.php
|   |   ├── interfaces/   # Interfaces
|   |   ├── validators/   # Validaciones
│   │   |   ├── AuthorValidator.php
│   │   |   └── BookValidator.php
│   │   └── entities/     # Entidades
│   │       ├── Author.php
│   │       ├── Book.php
│   │       └── Model.php
│   ├── services/         # Servicios de la aplicación
│   └── views/            # Vistas de la aplicación
├── public/              # Archivos públicos y punto de entrada
├── authors.json         # Almacenamiento de autores (modo archivo)
└── books.json          # Almacenamiento de libros (modo archivo)
```

## Componentes Principales

### Controladores

- **AuthorController**: Gestiona las operaciones relacionadas con autores (crear, leer, actualizar, eliminar)
- **BookController**: Gestiona las operaciones relacionadas con libros (crear, leer, actualizar, eliminar)

### Modelos

- **Author**: Representa la entidad Autor con propiedades como nombre y nacionalidad
- **Book**: Representa la entidad Libro con propiedades como título, ISBN y referencia al autor
- **Model**: Clase base abstracta que proporciona funcionalidad común a todas las entidades

### Validadores

- **AuthorValidator**: Realiza validaciones sobre los datos de autores
- **BookValidator**: Realiza validaciones sobre los datos de libros

### Repositorios

- **FileDao.impl.php**: Implementación del acceso a datos usando archivos JSON
- **PdoDao.impl.php**: Implementación del acceso a datos usando base de datos SQL

## Características

1. **Almacenamiento Flexible**:

   - Soporte para almacenamiento en archivos JSON
   - Soporte para almacenamiento en base de datos SQL

2. **Validaciones**:

   - Validación de campos requeridos
   - Validación de formato ISBN
   - Validación de unicidad de ISBN
   - Validación de tipos de datos

3. **Entidades**:
   - Autores con nombre y nacionalidad
   - Libros con título, ISBN, fecha de publicación y referencia al autor

## Uso

El sistema permite realizar las siguientes operaciones:

### Autores

- Crear nuevos autores
- Listar todos los autores
- Buscar autor por ID
- Actualizar información de autores
- Eliminar autores

### Libros

- Crear nuevos libros
- Listar todos los libros
- Buscar libro por ID
- Actualizar información de libros
- Eliminar libros

## Requisitos

- PHP 7.0 o superior
- Extensión PDO (para uso con base de datos)
- Permisos de escritura en el directorio para almacenamiento en archivos
