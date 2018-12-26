<?php
/**
 * Created by PhpStorm.
 * User: dljy-technology
 * Date: 2018/12/18
 * Time: 下午4:48
 */

namespace Liz\ElfinderExtensionBundle\DependencyInjection;


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

        if (isset($config['flysystem_adapter_aliyun']) && $aliyunAdapterConfig = $config['flysystem_adapter_aliyun']){
            $definition = $container->getDefinition('liz.fly_system_adapter.ali_yun');
            $definition->setArgument(0, $aliyunAdapterConfig['access_key']);
            $definition->setArgument(1, $aliyunAdapterConfig['secret_key']);
            $definition->setArgument(2, $aliyunAdapterConfig['bucket']);
            $definition->setArgument(3, $aliyunAdapterConfig['end_point']);
        }

        if (isset($config['flysystem_adapter_qiniu']) && $aliyunAdapterConfig = $config['flysystem_adapter_qiniu']){
            $definition = $container->getDefinition('liz.fly_system_adapter.qiniu');
            $definition->setArgument(0, $aliyunAdapterConfig['access_key']);
            $definition->setArgument(1, $aliyunAdapterConfig['secret_key']);
            $definition->setArgument(2, $aliyunAdapterConfig['bucket']);
            $definition->setArgument(3, $aliyunAdapterConfig['cdn_host']);
        }


    }

    public function getAlias()
    {
        return 'liz_elfinder_extension';
    }

}