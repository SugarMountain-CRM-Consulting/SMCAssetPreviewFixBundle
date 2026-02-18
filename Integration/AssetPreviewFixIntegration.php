<?php

declare(strict_types=1);

namespace MauticPlugin\SMCAssetPreviewFixBundle\Integration;

use Mautic\IntegrationsBundle\Integration\BasicIntegration;
use Mautic\IntegrationsBundle\Integration\ConfigurationTrait;

class AssetPreviewFixIntegration extends BasicIntegration
{
    use ConfigurationTrait;

    public const INTEGRATION_NAME = 'AssetPreviewFix';

    public function getName(): string
    {
        return self::INTEGRATION_NAME;
    }

    public function getDisplayName(): string
    {
        return 'SMC Asset Preview Fix';
    }

    public function getAuthenticationType()
    {
        return 'none';
    }

    public function getRequiredKeyFields()
    {
        return [];
    }

    public function getIcon(): string
    {
        return 'plugins/SMCAssetPreviewFixBundle/Assets/img/icon.svg';
    }
}
