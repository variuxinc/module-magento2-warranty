# Mage2 Module Variux Warranty

    ``variux/module-warranty``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
Variux Warranty allows creating, checking, and managing the Warranty information. This module also helps the Indmar Authorized Dealers make most determinations about their end customers' warranties immediately

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Variux`
 - Enable the module by running `php bin/magento module:enable Variux_Warranty`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require variux/module-warranty`
 - enable the module by running `php bin/magento module:enable Variux_Warranty`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration




## Specifications

 - Model
	- Warranty

 - Model
	- Sro

 - Model
	- SroLabor

 - Model
	- SroDocument

 - Model
	- SroMaterial

 - Model
	- SroMisc

 - Model
	- Workcode

 - Model
	- Unit


## Attributes



