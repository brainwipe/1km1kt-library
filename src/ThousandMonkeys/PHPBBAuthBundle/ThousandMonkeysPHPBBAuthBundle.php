<?php

namespace ThousandMonkeys\PHPBBAuthBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use ThousandMonkeys\PHPBBAuthBundle\DependencyInjection\Security\Factory\PHPBBFactory;

class ThousandMonkeysPHPBBAuthBundle extends Bundle
{
	public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new PHPBBFactory());
    }
}
