# Patrón Modelo Vista Controlador

1. Todas las peticiones van a ir a index.php
2. Recoger las urls y enviar la responsabilidad de qué hacer a los controladores
3. Controladores harán preguntas BBDD y cargaran las vistas



CASCADA
    DELETE PEPE --> DELETE ARTICULOS 
                --> DELETE COMENTARIOS

RESTRICT
    DELETE PEPE --> DELETE ARTICULOS 
                --> DELETE COMENTARIOS   

NULL
    


PEPE

    Articulo 1
        titulo
        texto
        img_1
        img_2
        img_2

    Articulo 2
    Articulo 3
    Articulo 4
    Articulo 5









INDEX.PHP (Controlador principal)

    /profesor/1   -->
                        1. GET * FROM PROFESOR WHERE id = 1
                        2. Require_once(profesor.php)

    /home/          --> require_once(home.php)

    /contacto


    /profesor/edit/1  ---> edit_profesor.php...



CRUD : CREATE READ UPDATE DELETE
    CREATE          POST  /profesor                 --> ProfesorController create()
    READ ONE        GET   /profesor/{id}            --> ProfesorController show() 
                                                            { Obtener profesor y mostrar vista }
    READ LIST       GET   /profesores
    UPDATE          POST  /profesor/{id}
    DELETE          POST  /profesor/delete/{id}

    VIEWS
        UPDATE     GET     /profesor/edit/{id}
        CREATE     GET     /profesor/create



WEB CONTROLLER
    --> ProfesorController
    --> HomeController  
    --> ContactController 



WEB
    GET     / o /home       --> home.php
    GET     /servicios      --> servicios.php
    GET     /quienes-somos  --> about.php
    GET     /login          --> login.php
    GET     /register       --> sigunp.php

ARTICULOS  (CRUD)

    READ        GET     /articulo/1     
                                        Articulo::getByID(1)
                                    --> articulo.php
                GET     /articulo/create     
                            --> views/article/create.php
    CREATE      POST    /articulo
                        Article::create();

    DELETE      POST    /articulo/delete/2
                        $articulo = Articulo::findByID(2)
                        $articulo->delete();

    UPDATE      POST    /articulo/edit/2
                        $articulo = Articulo::findByID(2)
                        $articulo->edit();

 


GET     /servicios
        --> require_once("views/servicios.php");

GET     /user/1
    1. Ir a buscar el usuario número
        $user = User::findByID(1);

    2. Cargar una vista, con la info de $user
        require_once("views/user.php")
        
POST    /user/1


1 . Como pediriamos datos a un modelo desde controlador
2. Registro de ussuario
    2.1 GET / signup --> maquetacion formulario views/user/create.php
    2.2 POST / signup

3. Login
    3.1  Vista / login          --> formulario login.php
    3.2  POST / login           --> comprobar en BBDD el login
    3.3  CREAR SESSION          --> 
    3.4  Preguntar por session  --> 


Como pordriamos acceder al ususario del articulo
GET /user/7  --> ruta dinamica

1. Hacer el logout
2. desde la vista hacer una petion 











