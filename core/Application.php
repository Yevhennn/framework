<?php
namespace PHPFramework;





class Application
{
    protected mixed $uri;
    public Request $request;

    public Router $router;
    public Response $response;

    public View $view;

    public Session $session;
    public Database $db;

    public static Application $app;

    public function __construct()
    {
        self::$app = $this;
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->request = new Request($this->uri);
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View(LAYOUT);
        $this->session = new Session();
        $this->generateCsrfToken();
        $this->db = new Database();
    }

    public function run(): void
    {
        echo $this->router->dispatch();
    }

    public function generateCsrfToken(): void
    {
        if (!session()->has('csrf_token')) {
            session()->set('csrf_token', md5(uniqid(mt_rand(), true)));
        }
    }






}
