NovaSaaS — Demo Data
====================

This folder contains the demo content files used by the One Click Demo Import
plugin to set up the StreamFlow demonstration site.

────────────────────────────────────────────────────────────────────────────
FILES IN THIS FOLDER
────────────────────────────────────────────────────────────────────────────

demo-content.xml    — WordPress eXtended RSS (WXR) export file containing all
                      demo pages, posts, categories, menus, and custom content.

widgets.wie         — Widget export file (Widget Importer & Exporter format)
                      containing sidebar and footer widget configurations.

customizer.dat      — Customizer export file (Customizer Export/Import format)
                      with all theme-mod settings for colors, fonts, and text.

preview.jpg         — 1280×720 screenshot shown in the OCDI import chooser.

────────────────────────────────────────────────────────────────────────────
HOW TO IMPORT THE DEMO
────────────────────────────────────────────────────────────────────────────

STEP 1  Install and activate the required plugins:
        - Elementor (free, wordpress.org)
        - One Click Demo Import (free, wordpress.org)

STEP 2  Go to Appearance > Import Demo Data in your WordPress dashboard.

STEP 3  You will see a preview card labelled "StreamFlow — Main Demo".
        Click the preview image to start the import.

STEP 4  The importer will:
        - Import all pages and posts from demo-content.xml
        - Import widgets from widgets.wie
        - Apply customizer settings from customizer.dat
        - Set the front page to "Home"
        - Set the posts page to "Blog"
        - Assign menus to Primary Menu and Footer Menu locations

STEP 5  After import, go to Appearance > Menus to verify menu assignments,
        and Appearance > Customize to fine-tune colors, fonts, and text.

────────────────────────────────────────────────────────────────────────────
IMPORTANT NOTES
────────────────────────────────────────────────────────────────────────────

* The demo uses placeholder images from the bundled SVG mockups. To replace
  them with your own images, use the WordPress Media Library after import.

* Demo import should be performed on a FRESH WordPress installation to avoid
  conflicts with existing content.

* If you encounter a timeout during import, increase your server's
  max_execution_time to at least 300 seconds in php.ini or via wp-config.php:
      set_time_limit(300);

* After import, remove any unused demo posts and pages before launching
  your live site.

────────────────────────────────────────────────────────────────────────────
SUPPORT
────────────────────────────────────────────────────────────────────────────

If you have questions about the demo import process, please post in the
ThemeForest item comments or email: support@novasaas.com
