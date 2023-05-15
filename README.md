# Introducción
Recuérdame2.0 es una herramienta diseñada para agilizar y acelerar las terapias de reminiscencia que los terapeutas utilizan para tratar a pacientes con alzheimer.

Esta aplicación está basada en su predecesora Recuérdame, que se ha utilizado de base con el objetivo de añadir mejoras y funcionalidades que no fueron implementadas en la versión anterior. Recuérdame2.0 es una aplicación orientada al usuario, centrada en la usabilidad y con un lavado de imagen que se ha construido a partir de los requisitos especificados por los mismos usuarios finales.

La aplicación es una aplicación web construida principalmente bajo el framework Laravel, que sigue el Modelo Vista Controlador, de PHP y su motor de plantillas blade. A lo que se le suman HTML, CSS y JavaScript.


# Instalación
Clonar o descargar el repositorio

    git clone https://github.com/NILGroup/TFG-22-23-Recuerdame2.0.git

Acceder a la carpeta del repositorio

    cd TFG-22-23-Recuerdame2.0
    
Instalar todas las dependencias utilizando Composer

    composer install
    
Copiar el .env.example a .env y configurar las variables necesarias

    cp .env.example .env
    
Configurar la base de datos

    DB_CONNECTION=mysql
    DB_HOST=<host>
    DB_PORT=<port>
    DB_DATABASE=<database>
    DB_USERNAME=<username>
    DB_PASSWORD=<password>
   
Configurar key de [Creatomate](https://creatomate.com) para la generación de vídeos 

    CREATOMATE_KEY=<your_key>
    
Configurar la generación de voces de [VoiceRSS](https://www.voicerss.org)

    VOICERRS_KEY=<your_key>
    
Configurar la generación de resúmenes de [ChatGPT](https://openai.com/blog/chatgpt)

    OPENAI_API_KEY=<your_key>
    
  
    
 
