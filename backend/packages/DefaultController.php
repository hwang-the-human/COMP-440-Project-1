<?php
class DefaultController
{
    protected $currControl = 'Blogs';
    protected $currMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->explodeURL();

        if (isset($url[0]) && file_exists('../backend/controllers/' . ucwords($url[0]) . '.php')) {
            $this->currControl = ucwords($url[0]);
            unset($url[0]);
        }

        require_once '../backend/controllers/' . $this->currControl . '.php';

        $this->currControl = new $this->currControl;

        if (isset($url[1])) {
            if (method_exists($this->currControl, $url[1])) {
                $this->currMethod = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->currControl, $this->currMethod], $this->params);
    }

    public function explodeURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
