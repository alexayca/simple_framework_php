<?php

namespace AppFrame\Http;

class Request{

    protected $segments=[];
    protected $controller;  // controlador que requiere el usuario
    protected $method;  // con que metodo se va a responder

    /**
     * Obtenemos la URI del sistema ignorando el dominio
     * El contenido en el index 1 sera el controlador
     * y el index 2 el metodo.
     */
    public function __construct()
    {
        // A medida que se reciban los segmentos en la barra de direcciones se hara referencia a que controlador va a responder y que metodo va a responder
        $this->segments=explode('/',$_SERVER['REQUEST_URI']);   // convertimos un string en un array
        // Permitiendo ignorar el dominio y solo mostrando la URI del sistema
        // Esto es lo que el sistema captura y entiende lo que quiere el usuario (en la barra de direcciones)
        //var_dump($_SERVER['REQUEST_URI']);        
        // observe que al converir en array, tenemos al final el metodo, penultimo el controlador. Con cada segmento enviado en la barra de direcciones separado por una diagonal
        // Siendo la informacion que se requiere para configurar el controlador
        //var_dump($this->segments);
        // con la info anterior se settea el controlador y el metodo, y al final se configurara el metodo send() que usara los datos que se configuran  en el constructor

        $this->setController();
        $this->setMethod();
    }

    // Con los siguientes metodos se recuperan los 2 segmentos finales del URI
    public function setController(){
        /** si el primer segmento esta vacio
        * se llena por defecto home
        * si tenemos informacion, tomamos el elemento
        * Operador ternario if simplificado
        * (condicion)? se_cumple_la_condicion : NO_se_cumple_la_condicion;
        * empty() devuelve true si su parametro esta vacio, en otro caso false
        */
        $this->controller = empty($this->segments[1]) 
            ? 'home'    
            : $this->segments[1];    
    }

    public function setMethod(){
        $this->method = empty($this->segments[2]) 
            ? 'index'    
            : $this->segments[2];   
    }
}
