# turpentine-varnish

This is a fork. Work in progress.

To install, run: `composer require "luigifab/openmage-turpentine-varnish":"dev-devel"`

Some new features:
- compatible with blackfire
- varnish will close the connexion when url is unknown (444)
- you can now flush blocks from backend (with post requests)
- you can now flush public blocks with events

For public events (be careful if you have an observer on predispatch events):
```xml
# layout
<action method="setEsiOptions">
    <params>
        <access>public_events</access>
        <scope>page</scope>
        <flush_events>
            <my_event_allsessions /><!-- for public_events -->
            <my_event /><!-- original way -->
        </flush_events>
    </params>
</action>
```
```php
# from frontend or backend
if (Mage::app()->useCache('turpentine_pages') || Mage::app()->useCache('turpentine_esi_blocks'))
    Mage::dispatchEvent('my_event_allsessions');
```

- For: Varnish 4.x / 5.x / 6.x / 7.x
- Compatibility: OpenMage 19.x / 20.x / 21.x, PHP 7.2 / 7.3 / 7.4 / 8.0 / 8.1 / 8.2 / 8.3?
- License: GNU GPL 2+
