<?php
/**
 * Created by PhpStorm.
 * User: dljy-technology
 * Date: 2018/12/27
 * Time: 下午5:30.
 */

namespace Liz\ElfinderExtensionBundle\FlySystemCustom;

use League\Flysystem\Filesystem;
use Liz\ElfinderExtensionBundle\FlySystemCustom\Adapter\QiNiuOssAdapter;
use Liz\ElfinderExtensionBundle\FlySystemCustom\Plugins\QiNiuTransCoder;

/**
 * Class QiNiu.
 *
 * @method int transCoding($path, $rules, $saveAs=null, $notifyUrl=null, $pipeline=null, $bucket=null)
 */
class QiNiu extends Filesystem
{
    public function __construct(QiNiuOssAdapter $adapter, QiNiuTransCoder $transCoder)
    {
        parent::__construct($adapter, null);
        $this->addPlugin($transCoder);
    }
}
