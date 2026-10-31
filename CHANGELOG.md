# Changelog

## 1.0.53

- Keep a click-opened mega menu visible while the pointer moves downward from
  its trigger into the dropdown content.
- Close it only when the pointer enters another top-level menu item or leaves
  the complete header and mega-menu region.

## 1.0.52

- Keep the header fixed in its sticky position when a mega menu is opened after
  scrolling instead of applying the legacy top-of-page mega-menu state.
- Reserve `megamenu-active` for menus opened at the transparent page top so
  closing the menu or scrolling back cannot leave conflicting header states.

## 1.0.51

- Close a click-opened desktop mega menu when the pointer leaves its complete
  area or moves onto another top-level menu item.
- Fade transparent desktop headers to their configured white header background
  on hover, including readable navigation colors and the regular logo, then
  restore transparency when the pointer leaves.
- Preserve the existing white sticky-header behavior after scrolling.

## 1.0.50

- Open desktop mega menus only after an intentional first click instead of on
  hover, and follow the parent menu link on its second click when one exists.
- Close an open mega menu on an outside click, Escape or page scrolling while
  leaving regular dropdowns and the mobile menu unchanged.
- Add `aria-expanded` and keyboard activation state to mega-menu triggers.

## 1.0.49

- Replace the retired bundled header artwork with the current VAAM wordmark.
- Use the local VAAM asset by default for normal and transparent headers on
  fresh installations and every header preset.
- Redirect legacy saved logo URLs and any explicitly named GOYA asset to the
  VAAM fallback so the retired brand cannot resurface after an update.

## 1.0.48

- Add an independently editable "Nuevos colores" product badge in the product
  editor sidebar.
- Display Nuevo first and Nuevos colores second in the same badge row whenever
  both manual product labels are active.
- Keep the new badge visually identical to Nuevo and preserve the existing
  automatic-new and out-of-stock behavior.

## 1.0.47

- Add a right-sidebar "Etiqueta Nuevo" control to the product editor.
- Let manually marked products retain the New badge indefinitely until the
  checkbox is cleared, while unmarked products keep the automatic date rule.

## 1.0.46

- Add a global Customizer color picker for the upper single-product section.
- Force that color across every product by default, using white as the safe
  initial value and overriding stale hidden or per-product backgrounds.
- Link the product editor's individual background field to its global
  Customizer controls and retire the hidden legacy global background options.
- Scope generated CSS caches to the current page or product so one product's
  metadata can never leak its background into every other product page.
- Bypass the generated CSS cache during Customizer previews so color changes
  are visible before publishing.

## 1.0.45

- Keep unavailable color swatches at full color intensity on product cards
  while retaining their crossed-out state.
- Mark every card color as unavailable when the variable product itself is out
  of stock, and refresh previously cached card availability maps.

## 1.0.44

- Restore the editable footer-middle section in the native Customizer, including
  its visibility, content/shortcode and position controls.
- Migrate the store's retired Instagram feed 1 shortcode to feed 3 without
  changing any other footer content or widget configuration.

## 1.0.43

- Let sticky product-bar color and image swatches use all remaining horizontal
  space so long attribute lists no longer appear clipped.
- Add clear spacing between the sticky quantity control and add-to-cart button.

## 1.0.42

- Add an optional same-origin Buy Now checkout modal backed by the real
  WooCommerce checkout, validation, session and payment fields.
- Add native Customizer controls for the Buy Now label, popup behavior and
  normal/hover button colors while retaining the classic checkout fallback.
- Load the modal checkout only after a successful product add and serve its
  dedicated script minified and deferred.
- Replace the size-guide divider with a lightweight inline Font Awesome ruler.

## 1.0.40

- Add an editable HEX color picker to every WooCommerce color attribute term.
- Treat attributes named Color as color swatches even when their stored WooCommerce type is Select.
- Give term-level HEX colors priority while retaining all existing Customizer assignments as fallbacks.
- Show the resolved swatch and HEX value in the attribute terms table.

## 1.0.39

- Keep every catalog filter section expanded when the panel opens on desktop and mobile.
- Restore the mobile catalog header spacer so breadcrumbs never overlap the transparent header.

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
