<?php

declare(strict_types=1);

return [
    'name'        => 'SMC Asset Preview Fix',
    'description' => 'Provides an optional fix for missing @MauticAsset/Asset/preview.html.twig.',
    'version'     => '1.0.0',
    'author'      => 'SMC',
    'services'    => [
        'events' => [
            'mautic.smc_asset_preview_fix.twig_template_path_subscriber' => [
                'class'     => MauticPlugin\SMCAssetPreviewFixBundle\EventListener\TwigTemplatePathSubscriber::class,
                'arguments' => [
                    'mautic.helper.integration',
                    'twig.loader.native_filesystem',
                    '%kernel.project_dir%',
                ],
            ],
        ],
        'integrations' => [
            'mautic.integration.assetpreviewfix' => [
                'class' => MauticPlugin\SMCAssetPreviewFixBundle\Integration\AssetPreviewFixIntegration::class,
                'tags'  => [
                    'mautic.basic_integration',
                ],
            ],
            'smc_asset_preview_fix.integration.configuration' => [
                'class' => MauticPlugin\SMCAssetPreviewFixBundle\Integration\Support\ConfigSupport::class,
                'tags'  => [
                    'mautic.config_integration',
                ],
            ],
        ],
    ],
];
