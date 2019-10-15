<?php
    class BCPEscucha
    {
        private $contralador = './Controlador/EscuchaController.php';
        public function routes()
        {
            switch ($this->path()) {
                case '/escucha':
                    require $this->contralador;
                    $controller = new EscuchaController();
                    $method = $this->method();
                    if (method_exists(new EscuchaController, $method))
                        echo $controller->$method($this->body(), $this->auth());
                    else
                        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);    
                    break;
                
                default:
                    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
                    break;
            }
            //echo $this->auth();
            //echo "<br/>";
            //print_r($this->body());
        }
        private function body()
        {
            return json_decode(file_get_contents("php://input"));
        }
        private function auth()
        {
            return $_SERVER["PHP_AUTH_USER"].":".$_SERVER["PHP_AUTH_PW"];
        }
        private function path()
        {
            return isset($_REQUEST["rquest"]) ? "/".$_REQUEST["rquest"] : "/" ;
        }
        private function method()
        {
            return $_SERVER['REQUEST_METHOD'];
        }
    }
    