<?php
/**
 * Created by PhpStorm.
 * User: dljy-technology
 * Date: 2018/12/18
 * Time: 下午4:48.
 */

namespace Liz\ElfinderExtensionBundle\DependencyInjection;

use Liz\ElfinderExtensionBundle\FlySystemCustom\Adapter\AliYunOssAdapter;
use Liz\ElfinderExtensionBundle\FlySystemCustom\Adapter\QiNiuOssAdapter;
use Liz\ElfinderExtensionBundle\FlySystemCustom\Plugins\QiNiuTransCoder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class FMElFinderExtensionExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        if (isset($config['flysystem_adapter_aliyun']) && $aliyunAdapterConfig = $config['flysystem_adapter_aliyun']) {
            $definition = $container->getDefinition(AliYunOssAdapter::class);
            $definition->setArgument(0, $aliyunAdapterConfig['access_key']);
            $definition->setArgument(1, $aliyunAdapterConfig['secret_key']);
            $definition->setArgument(2, $aliyunAdapterConfig['bucket']);
            $definition->setArgument(3, $aliyunAdapterConfig['end_point']);
        }

        if (isset($config['flysystem_adapter_qiniu']) && $qiniuAdapterConfig = $config['flysystem_adapter_qiniu']) {
            $definition = $container->getDefinition(QiNiuOssAdapter::class);
            $definition->setArgument(0, $qiniuAdapterConfig['access_key']);
            $definition->setArgument(1, $qiniuAdapterConfig['secret_key']);
            $definition->setArgument(2, $qiniuAdapterConfig['bucket']);
            $definition->setArgument(3, $qiniuAdapterConfig['cdn_host']);

            if (isset($qiniuAdapterConfig['trans_coder'])) {
                $definition = $container->getDefinition(QiNiuTransCoder::class);
                $transCoderConfig = $qiniuAdapterConfig['trans_coder'];
                $definition->setArgument(0, $transCoderConfig['notify_url']);
                $definition->setArgument(1, $transCoderConfig['pipe_line']);
                $definition->setArgument(2, $transCoderConfig['to_bucket']);
                $definition->setArgument(3, $transCoderConfig['wm_image']);
            }
        }
    }

    public function getAlias()
    {
        return 'liz_elfinder_extension';
    }
}
