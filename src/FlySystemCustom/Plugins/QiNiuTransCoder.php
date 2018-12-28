<?php
/**
 * Created by PhpStorm.
 * User: dljy-technology
 * Date: 2018/12/27
 * Time: 下午4:25.
 */

namespace Liz\ElfinderExtensionBundle\FlySystemCustom\Plugins;

use Liz\Flysystem\QiNiu\Plugins\TransCoder;

class QiNiuTransCoder extends TransCoder
{
    public function __construct($notifyUrl = null, $pipeLine = null, $toBucket = null, $wmImage = null)
    {
        parent::__construct($notifyUrl, $pipeLine, $toBucket, $wmImage);
    }
}
