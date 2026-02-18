<?php

declare(strict_types=1);

namespace MauticPlugin\SMCAssetPreviewFixBundle\Integration\Support;

use Mautic\IntegrationsBundle\Integration\DefaultConfigFormTrait;
use Mautic\IntegrationsBundle\Integration\Interfaces\ConfigFormInterface;
use MauticPlugin\SMCAssetPreviewFixBundle\Integration\AssetPreviewFixIntegration;

class ConfigSupport extends AssetPreviewFixIntegration implements ConfigFormInterface
{
    use DefaultConfigFormTrait;
}
