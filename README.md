
<p align="center">
    <img width="345" alt="image" src="https://github.com/NILGroup/TFG-22-23-Recuerdame2.0/assets/95294905/0d871ff8-6835-4784-83f4-22f28329ed05">
</p>


# Introducción
Recuérdame2.0 es una herramienta diseñada para agilizar y acelerar las terapias de reminiscencia que los terapeutas utilizan para tratar a pacientes con alzheimer.

Esta aplicación está basada en su predecesora Recuérdame, que se ha utilizado de base con el objetivo de añadir mejoras y funcionalidades que no fueron implementadas en la versión anterior. Recuérdame2.0 es una aplicación orientada al usuario, centrada en la usabilidad y con un lavado de imagen que se ha construido y ampliado a partir de los requisitos especificados por los mismos usuarios finales.

La aplicación es una aplicación web construida principalmente bajo el framework Laravel, que sigue el Modelo Vista Controlador, de PHP y su motor de plantillas blade. A lo que se le suman HTML, CSS y JavaScript.

# Herramientas

Para la generación de voz la aplicación utiliza [VoiceRSS](https://www.voicerss.org), un servicio online que convierte cualquier texto en un audio mp3 con
diferentes voces en más de 45 idiomas y con cien voces diferentes para elegir.

Para la generación de vídeos se utiliza [Creatomate](https://creatomate.com), la mejor API de generación de vídeo que permite la creación de vídeos dinámicamente.
Esta librería permite la utilización de plantillas para la generación de vídeos y tiene una curva de aprendizaje más baja que el resto, pues tiene una documentación para el framework Laravel.

Para la generación de resúmenes a partir de recuerdos se utiliza [ChatGPT](https://openai.com/blog/chatgpt), la inteligencia artificial más famosa del mundo actualmente desarrollada por OpenAI.

# Instalación
Clonar o descargar el repositorio.

    git clone https://github.com/NILGroup/TFG-22-23-Recuerdame2.0.git

Acceder a la carpeta del repositorio.

    cd TFG-22-23-Recuerdame2.0
    
Instalar todas las dependencias utilizando Composer.

    composer install
    
Copiar el .env.example a .env para configurar las variables necesarias.

    cp .env.example .env

Generar una nueva key de aplicación.

    php artisan key:generate
    
Configurar la base de datos.

    DB_CONNECTION=mysql
    DB_HOST=<host>
    DB_PORT=<port>
    DB_DATABASE=<database>
    DB_USERNAME=<username>
    DB_PASSWORD=<password>
   
Configurar key de [Creatomate](https://creatomate.com) para la generación de vídeos.

    CREATOMATE_KEY=<your_key>
    
Configurar la generación de voces de [VoiceRSS](https://www.voicerss.org).

    VOICERRS_KEY=<your_key>

Configurar el envío de correos electronicos para la generación de vídeos.

    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=465
    MAIL_USERNAME=<your_mail>
    MAIL_PASSWORD=<gmail_external_apps_password>
    MAIL_ENCRYPTION=ssl
    MAIL_FROM_ADDRESS=<your_mail>
    MAIL_FROM_NAME="${APP_NAME}"

Configurar tareas asíncronas para la generación de vídeos.

    QUEUE_CONNECTION=database

Configurar la generación de resúmenes de [ChatGPT](https://openai.com/blog/chatgpt).

    OPENAI_API_KEY=<your_key>
    
Crear la base de datos de la aplicación.

    php artisan migrate
    
Ejecutar y desplegar la aplicación.

    php artisan serve
    
  
# Observaciones

La generación de vídeos y audios no funcionará con la aplicación desplegada en un servidor local ya que la API [Creatomate](https://creatomate.com) necesita acceder a la multimedia del dispositivo en cuestión, por lo que para generar vídeos y audio la aplicación deberá ser accesible desde la web alojándose en algún servidor.

También será necesario ejecutar el siguiente comando

    php artisan queue:work
    
 
