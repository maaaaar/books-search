# Books Search

Webservice en PHP que permite buscar libros por título y autor a partir de un dataset en JSON.

---

## Requisitos

- PHP 8.0 o superior
- No requiere ninguna dependencia ni instalación adicional

---

## Instalación y uso

**1. Clona el repositorio:**
```bash
git clone https://github.com/maaaaar/books-search.git
cd books-search
```

**2. Levanta el servidor:**
```bash
php -S localhost:8080
```

**3. Realiza una búsqueda:**
```bash
curl "http://localhost:8080/buscar.php?texto=Cristina"
```

O abre directamente en el navegador:
```
http://localhost:8080/buscar.php?texto=Cristina
```

---

## Ejemplos de llamadas

Buscar por título o autor:
```bash
curl "http://localhost:8080/buscar.php?texto=Cristina"
```

Búsqueda con menos de 3 caracteres (devuelve error):
```bash
curl "http://localhost:8080/buscar.php?texto=a"
```

---

## Estructura del proyecto

```
books-search/
├── buscar.php      # Webservice principal con la lógica de búsqueda
└── dataset.json    # Dataset con los libros disponibles
```

---

## Respuesta JSON

La respuesta contiene dos arrays independientes:

```json
{
    "books": [
        {
            "titulo": "\"\u00a1Gracias, Cristina!\" (Mauricio Macri)",
            "autor": "Carlos M. Reymundo Roberts",
            "isbn": "9789500760539",
            "fecha_nov": "20171201",
            "portada": "http:\/\/static.megustaleer.com\/images\/libros_244_x\/9789500760539.jpg"
        }
    ],
    "authors": [
        {
            "autor": "Cristina Morat\u00f3",
            "last_books": [
                {
                    "titulo": "Divas rebeldes",
                    "autor": "Cristina Morat\u00f3",
                    "isbn": "9788401020599",
                    "fecha_nov": "20170901",
                    "portada": "http:\/\/static.megustaleer.com\/images\/libros_244_x\/EADB0599.jpg"
                },
                {
                    "titulo": "Divina Lola",
                    "autor": "Cristina Morat\u00f3",
                    "isbn": "9788401019258",
                    "fecha_nov": "20170316",
                    "portada": "http:\/\/static.megustaleer.com\/images\/libros_244_x\/EL019258.jpg"
                }
            ]
        },
        {
            "autor": "Cristina Bajo",
            "last_books": [
                {
                    "titulo": "Esa lejana barbarie",
                    "autor": "Cristina Bajo",
                    "isbn": "9789500759519",
                    "fecha_nov": "20170801",
                    "portada": "http:\/\/static.megustaleer.com\/images\/libros_244_x\/9789500759519.jpg"
                }
            ]
        },
        {
            "autor": "Mar\u00eda Cristina Restrepo",
            "last_books": [
                {
                    "titulo": "Al otro lado del mar",
                    "autor": "Mar\u00eda Cristina Restrepo",
                    "isbn": "9789585428256",
                    "fecha_nov": "20170726",
                    "portada": "http:\/\/static.megustaleer.com\/images\/libros_244_x\/9789585428256.jpg"
                }
            ]
        }
    ]
}
```

- **books** — libros cuyo título coincide con el texto buscado
- **authors** — autores cuyo nombre coincide con el texto buscado, cada uno con sus 2 últimos libros ordenados por fecha de novedad descendente

