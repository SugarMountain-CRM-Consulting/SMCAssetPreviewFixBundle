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

    public function __construct(
        private readonly IntegrationHelper $integrationHelper,
        private readonly FilesystemLoader $filesystemLoader,
        private readonly string $mauticApplicationDir,
        private readonly string $kernelProjectDir,
    ) {
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

        $pluginViewsPath = $this->resolvePluginViewsPath();
        if (null === $pluginViewsPath) {
            return;
        }

        $this->filesystemLoader->prependPath($pluginViewsPath, 'MauticAsset');
        $this->templatePathRegistered = true;
    }

    private function resolvePluginViewsPath(): ?string
    {
        $candidates = [
            $this->mauticApplicationDir.'/plugins/SMCAssetPreviewFixBundle/Resources/views',
            $this->kernelProjectDir.'/plugins/SMCAssetPreviewFixBundle/Resources/views',
        ];

        foreach ($candidates as $candidate) {
            if (is_dir($candidate)) {
                return $candidate;
            }
        }

        return null;
    }
}
