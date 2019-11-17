<?php 
namespace App\EventListener;

use App\Annotations\InternalUser;
use Doctrine\Common\Annotations\Reader;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ControllerCheckRequestListener
{
    /** @var Reader */
    private $reader;
    
    /**
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }
    
    /**
     * {@inheritdoc}
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        if (!is_array($controllers = $event->getController())) {
            return;
        }
        
        $request = $event->getRequest();
        $content = $request->getContent();
        
        list($controller, $methodName) = $controllers;
        
        $reflectionClass = new \ReflectionClass($controller);
        $classAnnotation = $this->reader
        ->getClassAnnotation($reflectionClass, InternalUser::class);
        
        $reflectionObject = new \ReflectionObject($controller);
        $reflectionMethod = $reflectionObject->getMethod($methodName);
        $methodAnnotation = $this->reader
        ->getMethodAnnotation($reflectionMethod, InternalUser::class);
        
        if (!($classAnnotation || $methodAnnotation)) {
            return;
        }
        
        if ($request->getContentType() !== 'json' ) {
            return $event->setController(
                function() {
                    return new JsonResponse(['success' => false]);
                }
                );
        }
        
        if (empty($content)) {
            throw new BadRequestHttpException('Content is empty');
        }
        
        $data = json_decode($content, true);
        
        if ($request->getContentType() !== 'json' ) {
            return $event->setController(
                function() {
                    return new JsonResponse(['success' => false]);
                }
                );
        }
    }
}