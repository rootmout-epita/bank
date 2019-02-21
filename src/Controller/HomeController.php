<?php


namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController{

    /**
     * HomeController constructor.
     * @param $twig
     * @var Environment
     */

    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /*
     * @throws: none
     */

    public function index():Response
    {
        try {
            return new Response($this->twig->render('pages/home.html.twig'));
        } catch (\Twig_Error_Loader $e) {
        } catch (\Twig_Error_Runtime $e) {
        } catch (\Twig_Error_Syntax $e) {
        }
        return new Response();
    }
}