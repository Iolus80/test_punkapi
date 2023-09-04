# Test Punk Api
## Contexto
Este repositorio es un ejercicio para la siguiente prueba [técnica](https://github.com/mo2o/backend-exercise)

Se ha realizado todos los requisitos y ademas se ha realizado el apunte extra de documentación de la API generada (http://localhost:8080/api/doc).

# Herramientas necesarias
Instala Docker y Docker Compose:
Asegúrate de tener Docker y Docker Compose instalados en tu sistema. Puedes descargarlos e instalarlos siguiendo las instrucciones en los sitios oficiales:
* Docker (https://docs.docker.com/get-docker/) 
* Docker Compose (https://docs.docker.com/compose/install/).

# Instalación
Una vez clonado el repo, nos situamos en al directorio raíz del proyecto y ejecutamos el siguiente comando:

<pre>
docker-compose build
docker-compose up -d
</pre>

Accedemos al contenedor con el siguiente comando:
<pre>
docker-compose run www bash
</pre>

una vez dentro del contenedor se instalan las actualizaciones y dependencias del proyecto con sl siguiente commando
<pre>
composer install
</pre>
