<?php
namespace ThousandMonkeys\PHPBBAuthBundle\Security\Firewall;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;

use ThousandMonkeys\PHPBBAuthBundle\Security\Authentication\PHPBBToken;


class PHPBBListener implements ListenerInterface
{
    protected $securityContext;
    protected $authenticationManager;

    public function __construct(SecurityContextInterface $securityContext, AuthenticationManagerInterface $authenticationManager)
    {
        $this->securityContext = $securityContext;
        $this->authenticationManager = $authenticationManager;
    }

    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        $token = new PHPBBToken();

        try {
            $authToken = $this->authenticationManager->authenticate($token);

            $this->securityContext->setToken($authToken);
        } catch (AuthenticationException $failed) {

        	$authToken = new PHPBBToken();
			$this->securityContext->setToken($authToken);
        }
    }
}
