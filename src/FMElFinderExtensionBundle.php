<?php
/**
 * Created by PhpStorm.
 * User: dljy-technology
 * Date: 2018/12/18
 * Time: 下午4:40
 */

namespace Liz\ElfinderExtensionBundle;


use Liz\ElfinderExtensionBundle\DependencyInjection\FMElFinderExtensionExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FMElFinderExtensionBundle extends Bundle
{

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new FMElFinderExtensionExtension();
        }
        return $this->extension;
    }

}