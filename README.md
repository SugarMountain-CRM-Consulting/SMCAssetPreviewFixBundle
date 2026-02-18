# SMC Asset Preview Fix Bundle

Small Mautic plugin that fixes missing template errors around `@MauticAsset/Asset/preview.html.twig` without modifying Mautic core.

Issue reference:
- https://github.com/mautic/mautic/issues/15794

## Why this plugin exists

A quick core workaround is to copy:

`app/bundles/AssetBundle/Resources/views/Modules/preview.html.twig`

into:

`app/bundles/AssetBundle/Resources/views/Asset/preview.html.twig`

This plugin provides the same effect as an override, so you can keep core untouched.

## What it does

- Adds a Twig override for `@MauticAsset/Asset/preview.html.twig`.
- The override delegates to `@MauticAsset/Modules/preview.html.twig`.
- Can be toggled on/off from **Integrations** by publishing/unpublishing the integration.

## Installation

1. Put this bundle in your Mautic `plugins/` directory.
2. Clear cache:
   - `bin/console cache:clear`
   - or in DDEV: `ddev exec bin/console cache:clear`

## Activation (required)

Do not forget this step.

1. In Mautic, go to **Settings -> Integrations**.
2. Open **SMC Asset Preview Fix**.
3. **Publish/Enable** it.
4. Save.

To disable the fix quickly, unpublish the integration.

## Compatibility

- Designed for Mautic 7.x.
- Tested on Mautic 7.0.0.
- Non-invasive: no core file edits.

## Troubleshooting

- If the icon or integration does not appear, clear cache again.
- If the fix seems inactive, verify the integration is published.

## Notes

- This is intentionally minimal and scoped to the template-path issue.
- If Mautic core fixes this permanently in your version, you can unpublish or remove this plugin.
- This repository is intended as a temporary workaround and can be archived once the upstream fix is released and widely available.
