<?php
/**
 * Created by PhpStorm.
 * User: dljy-technology
 * Date: 2018/12/18
 * Time: 下午6:38.
 */

namespace Liz\ElfinderExtensionBundle\Services;

use Liz\ElfinderExtensionBundle\FlySystemCustom\Adapter\AliYunOssAdapter;
use Liz\ElfinderExtensionBundle\FlySystemCustom\Adapter\QiNiuOssAdapter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AutoAdapter
{
    protected $tokenStorage;

    protected $adapter;

    protected $aliYunOssAdapter;

    protected $qiNiuOssAdapter;

    public function __construct(TokenStorageInterface $tokenStorage,
                                AliYunOssAdapter $aliYunOssAdapter,
                                QiNiuOssAdapter $qiNiuOssAdapter,
                                $defaultAdapter)
    {
        $user = $tokenStorage->getToken()->getUser();
        $this->aliYunOssAdapter = $aliYunOssAdapter;
        $this->qiNiuOssAdapter = $qiNiuOssAdapter;
        if (method_exists($user, 'getFlySystemAdapter')) {
            $defaultAdapter = $user->getFlySystemAdapter();
        }
        $this->setAdapter($defaultAdapter);
    }

    protected function setAdapter($name)
    {
        switch ($name) {
            case 'aliyun':
                $this->adapter = $this->aliYunOssAdapter;
                break;
            case 'qiniu':
                $this->adapter = $this->qiNiuOssAdapter;
                break;
        }
    }

    public function __call($name, $arguments)
    {
        $result = call_user_func_array([$this->adapter, $name], $arguments);
        return $result;
    }
}
