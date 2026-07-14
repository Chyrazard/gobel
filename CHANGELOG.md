# Changelog

## 1.0.38

- Added removable active-filter tags beside the catalog filter control and
  inside the filter panel.
- Preserved the native `on_sale` filter when combining it with colors, sizes,
  prices, ratings, or other product attributes.
- Kept the sale checkbox synchronized with the actual catalog query.
- Added built-in Spanish translations for the public theme interface without
  requiring Loco Translate.

## 1.0.37

- Restored the native visual stylesheet after the namespace migration by
  linking it to the registered Belctech theme handle.
- Restored the Spanish quick-view label without relying on an external theme
  translation package.
- Restored the existing campaign-bar color settings from the inherited
  Customizer keys.
- Limited stored-data migration to internal identifiers so visible page and
  product copy is never rewritten.

## 1.0.36

- Replaced the inherited theme namespace across PHP, JavaScript, CSS, asset
  handles, translations, classes, hooks and filenames with Belctech naming.
- Added a one-time storage migration for existing product/page metadata,
  widgets, options, theme mods and WPBakery content.
- Preserved safe coexistence during an update if the previous core plugin is
  still active, without retaining its branded namespace in the source tree.

## 1.0.35

- Reduced desktop navigation hit testing to the visible anchor text while
  preserving native hover continuity inside full-width mega menus.
- Removed the navigation workaround script; the behavior is now CSS-native.
- Versioned Belctech assets from their modification times so LiteSpeed cannot
  keep serving an older theme stylesheet after an update.
- Added the small navigation rule to the inline critical CSS so it is active
  before asynchronously loaded stylesheets finish.

## 1.0.34

- Replaced the inherited full-list-item mega-menu mouseenter handler with an
  anchor-only trigger.
- Added delayed submenu handoff so moving from the label into the dropdown
  remains smooth without restoring the accidental full-header hover zone.

## 1.0.33

- Overrode the inherited desktop `height: 100%` rule on primary-menu list items so
  both the real hover box and the anchor box now match the text line.

## 1.0.32

- Removed inherited flex stretching from desktop primary-menu anchors so their
  actual clickable boxes match the visible text line.

## 1.0.31

- Restricted desktop navigation hover and click targets to the visible menu
  links instead of the complete header-height list-item boxes.
- Preserved full-width mega-menu positioning and submenu hover continuity.

## 1.0.30

- Added a native, dependency-free "En descuento" catalog filter that combines
  correctly with price and attribute filters.
- Included the sale criterion in active-filter clearing, counting and the
  persistent mobile filter workflow.
- Added mobile spacing below the header on shop, category and catalog search
  pages without changing the single-product layout.

## 1.0.29

- Kept quick-view galleries inside the existing modal height while displaying
  complete product images without bottom cropping.
- Centered quick-view slider arrows inside the visible image stage.
- Added a direct "Ver producto completo" action above the quick-view title.

## 1.0.28

- Removed the header bottom divider in normal and sticky states.
- Forced WooCommerce account, login and registration screens below an opaque
  header on desktop and mobile.

## 1.0.1

- Prevented fatal `Cannot redeclare` errors while the previous core plugin remains active
  during or after the theme switch.
- Added multisite and renamed-plugin-safe class detection for that transition.
- Removed the simulated Woo Variation Swatches class that could collide while
  activating the real plugin.
- Added explicit native/external swatch provider selection to prevent duplicate
  variation markup.
- Replaced PHP 7.4 arrow functions and validated the complete theme as PHP 7.2
  compatible.
- Namespaced internal portfolio and widget bootstrap symbols to reduce global
  collision risk.

## 1.0.0

- Initial Belctech Ecommerce build.
