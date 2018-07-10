# Pyxl_ShippingNotes
This module adds a textarea field to the checkout process for the user to provide any 
shipping notes to the order. 

## Getting Started
To install into your existing Magento site run the following two commands.

    composer config repositories.pyxl-shippingnotes git https://bitbucket.org/pyxlinc/module-shippingnotes.git
    composer require pyxl/module-shippingnotes:^1.0.0
    bin/magento module:enable Pyxl_ShippingNotes
    bin/magento setup:upgrade
    bin/magento cache:clean


There are no settings for this module. The field will automatically appear between the 
shipping address and shipping methods components on checkout. It saves the notes to the 
quote and order in the database and displays them in the Order view for both the customer
and the admin. 

## Authors
* Justin Rhyne <jrhyne@pyxl.com>
* Joel Rainwater <jrainwater@pyxl.com>
