<?php

namespace App\Extensions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class NotAllowed extends \Slim\Handlers\NotFound
{
    /**
     * Twig View Handler
     */
    protected $ci;

    /**
     * Monolog Logger
     */
    protected $logger;
    protected $ip;
    protected $analytics;
    /**
     * Constructor
     *
     * @param Slim\Views\Twig $view Slim Twig view handler
     */
    public function __construct(\Slim\Views\Twig $view, \Monolog\Logger $logger)
    {
        global $ip, $analytics;
        $this->view = $view;
        $this->logger = $logger;
        $this->ip = $ip;
        $this->analytics = $analytics;
    }


    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        // Log request
        $path = $request->getUri()->getPath();
        $this->logger->info("Not Allowed (405): {$request->getMethod()} {$path} IP {$this->ip} Analytics {$this->analytics}");
        /* If request is for a file or image then just return and do no more
        if (preg_match('/^.*\.(jpg|jpeg|png|gif)$/i', $path)) {
            return $response->withStatus(404);
        }
        */

        $response = $this->view->render($response->withStatus(405), 'errors/405.twig', ['path' => $path]);
        return $response;
    }

}