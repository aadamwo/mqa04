<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        $this->session = service('session');
    }

    // auth render
    public function render_auth($view, $data)
    {
        $uri = service('uri');
        $modules = $uri->getSegment(1);
        $view_path = 'Modules\\' . $modules . '\\Views\\';
        $array = [
            'data'  => $data,
            'view'  => $view_path . $view
        ];

        echo view('layout/auth', $array);
    }
    public function render_mqa($view, $data)
    {
        $view_path = 'Modules\\Mqa\\Views\\' . $view;

        $array = [
            'data' => $data,
            'view' => $view_path
        ];

        echo view('layout/main', $array);
    }

    // Provider render
    public function render_provider($view, $data)
    {
        $uri = service('uri');
        $modules = $uri->getSegment(1);
        $view_path = 'Modules\\' . $modules . '\\Views\\';
        $array = [
            'data'  => $data,
            'view'  => $view_path . $view
        ];

        echo view('provider_layout/main', $array);
    }

    public function render_assessor($view, $data)
    {
        $uri = service('uri');
        $modules = $uri->getSegment(1);
        $view_path = 'Modules\\' . $modules . '\\Views\\';
        $array = [
            'data'  => $data,
            'view'  => $view_path . $view
        ];

        echo view('assessor_layout/main', $array);
    }

    public function render_admin($view, $data)
    {
        $view_path = 'Modules\\Mqa\\Views\\' . $view;

        $array = [
            'data' => $data,
            'view' => $view_path
        ];

        echo view('admin_layout/main', $array);
    }

        public function render_public($view, $data)
            {
                $view_path = 'Modules\\Mqa\\Views\\' . $view;

                $array = [
                    'data' => $data,
                    'view' => $view_path
                ];

                echo view('public_layout/main', $array);
            }




    public function render_super_admin($view, $data)
    {
        $uri = service('uri');
        $modules = $uri->getSegment(1);
        $view_path = 'Modules\\' . $modules . '\\Views\\';
        $array = [
            'data'  => $data,
            'view'  => $view_path . $view
        ];

        echo view('layout/main', $array);
    }
   
}
