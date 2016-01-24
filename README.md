# dokify2
Proyecto para la prueba 2 de dokify

# Demo
http://jonijnm.es/all/pags/dokify2/

# Instalación

* Instalar dependecias

```bash
npm install
bower install
```

* Copiar archivo Config.example.php a Config.php y establecer los datos de conexión MySQLi

* Importar a la BD los archivos db/structure.sql y db/sample_data.sql (opcional)

* Añadir al include_path de PHP el proyecto [JNMFW](https://github.com/JoniJnm/JNMFW) (o descargar la carpeta en el root del proyecto)

* Correr build

```bash
gulp default
```

# Herramientas, frameworks y librerías utilizadas

* [JNMFW](https://github.com/JoniJnm/JNMFW) (framework PHP para hacer API Rest-full)
* npm (gestor de proyectos)
* bower (gestor de dependecias)
* jQuery
* bootstrap
* [jstemplate](https://github.com/JoniJnm/jstemplate) (plantillas en el lado del cliente)
* underscore
* requirejs (javascript en módulos)
* less
* i18n (internacionalización de idiomas)
* [langs](https://github.com/JoniJnm/langs) (Gestor de idiomas para el i18n)

# Características

* Completa separación de cliente y servidor (comunicacón a través de API - JSON)
* Modelo MVC en cliente y servidor
* Soporte de múltiples idiomas (sólo hay que añadir más y registrarlos)
* Single Page Application (página web única que trabaja completamente con operaciones AJAX)
