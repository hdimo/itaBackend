<?php
/**
 * User: khaled
 * Date: 8/2/15 at 3:41 PM
 */

namespace Common\Listeners;


use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;

class ApiProblemListener extends AbstractListenerAggregate
{
    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER, [$this, 'onRender'], 1000
        );
    }

    public function onRender(MvcEvent $e)
    {
        if ($e->getResponse()->isOk()) {
            return;
        }
        $httpCode = $e->getResponse()->getStatusCode();
        $sm = $e->getApplication()->getServiceManager();
        $viewModel = $e->getViewModel();
        $exception = $viewModel->getVariable('exception');

        $model = new JsonModel();
        if ($exception) {
            $model->setVariables([
                'errorCode' => $exception->getCode,
                'errorMessage' => $exception->getMessage()
            ]);
        } else {
            $model->setVariables([
                'errorCode'=> $httpCode,
                'errorMessage'=> 'error has been trigger'
            ]);
        }
        $e->setResult($model);
        $e->setViewModel($model);
        $e->getResponse()->setStatusCode($httpCode);
    }


}