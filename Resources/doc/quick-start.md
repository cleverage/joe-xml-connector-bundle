# Quick Start

## 1. Install JOE XML Connector Bundle

If you haven't already, [install Composer](https://getcomposer.org). Once you
have, you can install the bundle:

```bash
$ composer require arii/joe-xml-connector-bundle
```

## 2. Registering in the kernel

You have to define AriiJoeXmlConnectorBundle on `AppKernel`

```php
// ...
$bundles[] = new Arii\JoeXmlConnectorBundle\AriiJoeXmlConnectorBundle();
// ...
```

### 3. Configuration.

```yaml
#app/config.yml

arii_joe_xml_connector:
    live_folder_path: Path of your live folder. (Required)

```
