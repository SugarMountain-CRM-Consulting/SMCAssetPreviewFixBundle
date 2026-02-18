<?php

declare(strict_types=1);

namespace MauticPlugin\SMCAssetPreviewFixBundle\EventListener;

use Mautic\PluginBundle\Helper\IntegrationHelper;
use MauticPlugin\SMCAssetPreviewFixBundle\Integration\AssetPreviewFixIntegration;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Loader\FilesystemLoader;

class TwigTemplatePathSubscriber implements EventSubscriberInterface
{
    private bool $templatePathRegistered = false;
    private string $pluginViewsPath;

    public function __construct(
        private readonly IntegrationHelper $integrationHelper,
        private readonly FilesystemLoader $filesystemLoader,
        string $kernelProjectDir,
    ) {
        $this->pluginViewsPath = $kernelProjectDir.'/plugins/SMCAssetPreviewFixBundle/Resources/views';
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 255],
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest() || $this->templatePathRegistered) {
            return;
        }

        $integration = $this->integrationHelper->getIntegrationObject(AssetPreviewFixIntegration::INTEGRATION_NAME);
        if (false === $integration) {
            return;
        }

        $integrationSettings = $integration->getIntegrationSettings();
        if (null === $integrationSettings || !$integrationSettings->isPublished()) {
            return;
        }

        $this->filesystemLoader->prependPath($this->pluginViewsPath, 'MauticAsset');
        $this->templatePathRegistered = true;
    }
}
