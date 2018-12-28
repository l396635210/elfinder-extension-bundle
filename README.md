## Elfinder bundle extension
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
目前提供了 flysystem-aliyun 和 flysystem-qiniu 适配器service

## Installation
### Step 1: Installation
composer require liz/elfinder-extension-bundle
### Step 2: Enabled the bundle

```php
<?php
// config/bundles.php

return [
    // ...  
    Liz\ElfinderExtensionBundle\FMElFinderExtensionBundle::class => ['all'=>true],
];

```
### Step 3: config example
in the path `liz_elfinder_extension.yaml`
#### 3.1 aliyun_adapter config
```yaml
liz_elfinder_extension:

    flysystem_adapter_aliyun:
        access_key: 'aliyun_oss_access_key'
        secret_key: 'aliyun_oss_secret_key'
        bucket: 'bucket'
        end_point: 'end_point.aliyuncs.com'
```

enable to elfinder bundle
```yaml
fm_elfinder:
    instances:
        ali:
            include_assets: true
            relative_path: true
            connector:
                roots:
                    uploads:
                        driver: Flysystem
                        url: https://bucket.end_point.aliyuncs.com
                        tmb_url: '/elfinder/.tmb'
                        tmb_path: 'elfinder/.tmb'
                        path: 'bucket'
                        flysystem:
                            type: custom
                            adapter_service: Liz\ElfinderExtensionBundle\FlySystemCustom\Adapter\AliYunOssAdapter
                            options: ~
                        upload_allow: ['all']
```
#### 3.2 qiniu_adapter config
```yaml
liz_elfinder_extension:
    flysystem_adapter_qiniu:
        access_key: 'qiniu_access_key'
        secret_key: 'qiniu_secret_key'
        bucket: 'bucket'
        cdn_host: 'cdn.host.com'
        trans_coder:
            pipe_line: 'first'
            notify_url: 'url'
            wm_image: 'image_path'
            to_bucket: 'to_bucket'
```

enable to elfinder bundle
```yaml
fm_elfinder:
    instances:
        qiniu:
            include_assets: true
            relative_path: true
            connector:
                roots:
                    uploads:
                        driver: Flysystem
                        url: 'cdn.host.com/bucket'
                        tmb_url: '/elfinder/.tmb'
                        tmb_path: 'elfinder/.tmb'
                        path: 'bucket'
                        flysystem:
                            type: custom
                            adapter_service: Liz\ElfinderExtensionBundle\FlySystemCustom\Adapter\QiNiuOssAdapter
                            options: ~
                        upload_allow: ['all']

```

之后就可以嗨嗨皮皮的使用七牛云和elfinder bundle了


