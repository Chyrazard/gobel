# Belctech Ecommerce

Current version: 1.0.36.

Belctech Ecommerce is an installable WooCommerce theme derived from the existing
site contract while replacing its setup framework and optional feature plugins
with a focused native layer.

## Requirements

- WordPress 6.5 or newer.
- PHP 7.2 or newer; PHP 8.2 is recommended.
- WooCommerce for catalog and checkout functionality.
- WPBakery Page Builder only when editing pages that use `vc_*` content.

WPBakery is the single intentional builder integration. Kirki, Meta Box,
WooCommerce Variation Swatches, Merlin, TGM and any external core plugin are
not required.

## Migration

1. Make a database and uploads backup.
2. Keep WooCommerce and WPBakery active.
3. Install and activate `belctech-ecommerce.zip`.
4. Open **Appearance > Customize** and verify logos, header and product defaults.
5. Open **Appearance > Widgets** and edit the four `Footer de 4 columnas` areas
   with Gutenberg blocks or Custom HTML blocks.
6. Resave **Settings > Permalinks** once if portfolio URLs return 404.
7. Purge page, object and CDN caches.

Existing `et_*` shortcodes remain unchanged. Version 1.0.36 performs a one-time,
idempotent namespace migration for legacy metadata, widgets, options, theme
mods and stored WPBakery content before templates render. Product, variation,
order and customer records are otherwise untouched.

## Native commerce features

- Four product card styles and secondary hover image.
- AJAX quick view using the real WooCommerce product summary.
- Color, image and button attribute types.
- Catalog swatches that switch the variation image.
- Unavailable variation state with a crossed swatch.
- Product video, size guide and per-product layout controls.
- Carousel, column and grid product galleries.
- Transparent header with a white sticky fade state.
- Four block-widget footer columns and a Gutenberg footer pattern.

## Performance decisions

- No setup wizard, remote plugin installer or remote demo template library.
- WordPress native image lazy loading and async decoding.
- Dynamic theme CSS cached from the current theme-mod signature.
- Isotope, Packery, Slick, Magnific Popup and Arrive loaded by page context.
- Lightweight mobile detection shim instead of the previous full library.
- Theme scripts use the WordPress `defer` strategy where dependency ordering
  allows it.
- Emoji and embed scripts are removed from the public frontend.

Performance still depends on hosting, image dimensions, third-party payment and
analytics scripts, database health, WPBakery content depth and cache/CDN setup.
