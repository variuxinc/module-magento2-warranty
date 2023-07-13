
# Magento 2 module Variux Warranty 

```
variuxinc/module-magento2-warranty
```

Variux Warranty allows creating, checking, and managing the Warranty information. This module also helps the Authorized Dealers make most determinations about their end customers' warranties immediately.

## 1. Documentation
- [Installation guide](https://docs.google.com/document/d/14SJEHN8uYqmdyoabcNwdHIbz34J_c3d8OsRphX6TQ5U/edit)
- [User Guide](https://docs.google.com/document/d/1CH82beAallKKnhbM3AW4WiqylKRTV3gRpHnKYRT_h_s/edit)

## 2. How to install Variux Warranty Extension

### Install via composer (recommend)

Run the following command in Magento 2 root folder

```
composer require variuxinc/module-magento2-warranty
php bin/magento seup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
php bin/magento cache:flush
``` 

## 2. Highlight features

### Warranty management

Authorized dealers can submit Warranties and follow the details

### Warranty Notifications

Statuses of Warranty is notified to the customer

### Unit management

In the Warranty management system. We use units as the main object to interact
Each sold product is a unit with a unique serial number

### Unit Registration

Register a unit to be warrantied

### Warranty transfer

Engine warranty transfer helps users manage engine warranty transference. During the warranty period, if the customer wants to sell his/her product to another customer, they will announce to the Dealer to transfer the engine warranty information for new customer
