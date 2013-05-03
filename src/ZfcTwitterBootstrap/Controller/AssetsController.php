<?php
/**
 * ZfcTwitterBootstrap
 */

namespace ZfcTwitterBootstrap\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use DateTime;
use DateInterval;

/**
 * Assets Controller
 */
class AssetsController extends AbstractActionController
{
    protected $assetsDir = '/../../../public';
    
    public function loadJsAction()
    {
        $response = $this->getFile('js');
        $response->getHeaders()->addHeaderLine('Content-Type', 'application/javascript');
        
        return $response;
    }
    
    public function loadCssAction()
    {
        $response = $this->getFile('css');
        $response->getHeaders()->addHeaderLine('Content-Type', 'text/css');
        
        return $response;
    }
    
    protected function getFile($type = null)
    {
        
        $response = $this->getResponse();
        
        $ns = $this->params('namespace', false);
        $file = $this->params('file', false);
        
        if ($ns && $file) {
        
            $file = __DIR__ . $this->assetsDir . '/' . $type . '/' . $ns . '/' . $file;
            
            if (file_exists($file) !== false) {
                
                $response->setStatusCode(200);
                
                // remove cache control as that files can be cache by client.
                //60*60*24*1 seven days expire.
                $response->getHeaders()->addHeaderLine('Cache-Control', 'public, max-age=' . 60*60*24*1);
                // exspires 1 day from now.
                $expires = new DateTime();
                $expires->add(new DateInterval('P1D'));
                $response->getHeaders()->addHeaderLine('Expires', $expires->format('D, d M Y H:i:s \G\M\T'));
                $response->getHeaders()->addHeaderLine('Pragma', '');
                $fileread = file_get_contents($file);
                $response->setContent($fileread);
            } else {
                $response->setContent('File not found');
                $response->setStatusCode(404);
            }
        }
        
        return $response;
    }
}