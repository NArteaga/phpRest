<?php
    class App
    {
        private $route;
        public function __construct()
        {
        }
        private function cors()
        {
            $origin = isset($_SERVER['SERVER_NAME'])? $_SERVER['SERVER_NAME']: "*";
            header("Access-Control-Allow-Origin: $origin");
            header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
            header("Allow: GET, POST, OPTIONS, PUT, DELETE");
            header('content-type: application/json; charset=utf-8');
        }
        public function method() {
            return strtolower($_SERVER['REQUEST_METHOD']);
        }
        public function body() {
            $contenido = file_get_contents("php://input");
            return json_decode($contenido);
        }
        public function route() {
            
        }
        private function path() {
            return $_REQUEST["rquest"];
        }
        public function addRoute($route) {
            $routes = $route->getSubRoute();
            foreach ($routes as $key => $value) {
                $routes[$key]["Controller"] = $route->getController();
                if(!array_key_exists($key, $this->route))
                    $this->route[$key] = $routes[$key];
                else
                    echo throw "route and method duplicated";
            }
            
        }
        public function ejecutar($controlador, $function, ... $params) {
            $class = new $controlador();
            $execurtar = $class->$function($params);
        }
        public function authorization()
        {
            return $_SERVER["PHP_AUTH_USER"].":".$_SERVER["PHP_AUTH_PW"];
        }
    }
    class Route
    {
        private $urlBase;
        private $controller;
        private $subRoutes;
        public function __construct($urlBase, $controller) {
            $this->urlBase = $urlBase;
            $this->controller = $controller;
            $this->subrutas = array();
        }
        public function get($url, $function)
        {
            $ruta = array(
                "funcion" => $function
            );
            $this->subrutas[$urlBase.$url]["get"] = $ruta;
        }
        public function post($url, $function)
        {
            $ruta = array(
                "funcion" => $function
            );
            $this->subrutas[$urlBase.$url]["post"] = $ruta;
        }
        public function put($url, $function)
        {
            $ruta = array(
                "funcion" => $function
            );
            $this->subrutas[$urlBase.$url]["put"] = $ruta;
        }
        public function delete($url, $function)
        {
            $ruta = array(
                "funcion" => $function
            );
            $this->subrutas[$urlBase.$url]["delete"] = $ruta;
        }
        public function option($url, $function)
        {
            $ruta = array(
                "funcion" => $function
            );
            $this->subrutas[$urlBase.$url]["option"] = $ruta;
        }
        public function getController()
        {
            return $this->controller;
        }
        public function getSubRoute()
        {
            return $this->subRoutes;
        }
    }
    class Routes
    {
        public function __construct($app)
        {
            
        }
        public function escuchar() {
            return "hola";
        }
    }