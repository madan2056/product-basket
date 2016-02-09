<?php

return [

    'status'              => [
        'created'                   => 'Basket successfully created',
        'updated'                   => 'Basket successfully updated',
        'deleted'                   => 'Basket successfully deleted',
        'generated'                 => 'Successfully generated :number Basket  from routes.',
        'global-enabled'            => 'Selected Basket enabled.',
        'global-disabled'           => 'Selected Basket  disabled.',
        'enabled'                   => 'Basket enabled.',
        'disabled'                  => 'Basket disabled.',
        'no-perm-selected'          => 'No Product selected.',
    ],

    'error'               => [
        'cant-delete-this-attribute-group'       => 'This Basket cannot be deleted',
        'cant-delete-attribute-group-in-use'     => 'This Basket is in use',
        'cant-edit-this-attribute-group'         => 'This Basket cannot be edited',
        'no-data-found'                          => 'Invalid Request',
        'duplicate-url'                          => 'Update failed!! ":url " already exist. Please add unique  SEO URL.',
        'duplicate-sku'                          => 'Basket could not be added!! ":url " already exist. Please add unique SKU value.'
    ],

    'page'              => [
        'index'              => [
            'title'             => 'Admin | Basket | Lists',
            'description'       => 'List of Basket ',
            'table-title'       => 'Basket list',
        ],
        'show'              => [
            'title'             => 'Admin | Basket | Show',
            'description'       => 'Displaying Basket : :name',
            'section-title'     => 'Basket details'
        ],
        'create'            => [
            'title'                     => 'Admin | Basket | Create',
            'description'               => 'Creating a new Basket ',
            'section-title'             => 'New Basket ',
            'meta-title-help'           => 'Page title which displays in  Page.',
            'product-seo-url-help'      => 'Basket page will be accessed using this URL.',
            'product-sku-help'          => 'Stock Keeping Unit. Unique unchangable code for each product.'
        ],
        'edit'              => [
            'title'                     => 'Admin | Basket | Edit',
            'description'               => 'Editing Basket : :name',
            'section-title'             => 'Edit Basket '
        ],
    ],

    'columns'           => [
        'id'                        =>  'ID',
        'product_id'                =>  'Product ID',
        'name'                      =>  'Name',
        'product-name'              =>  'Basket Name',
        'short_description'         =>  'Short Description',
        'description'               =>  'Description',
        'is_special'                =>  'Is Special',
        'is_featured'               =>  'Is Featured',
        'meta_title'                =>  'Meta Title',
        'meta_keywords'             =>  'Meta Keywords',
        'meta_description'          =>  'Meta Description',
        'display_name'              =>  'Display name',
        'status'                    =>  'Status',
        'created_date'              =>  'C.Date',
        'created'                   =>  'Created',
        'updated'                   =>  'Updated',
        'actions'                   =>  'Actions',
        'primary-image'             =>  'Listing Image',
        'image'                     =>  'Additional images',
        'url'                       =>  'SEO URL',
        'url-note'                  => '<strong>Note:</strong> Do not use spaces, instead replace spaces with - and make sure the keyword is globally unique.',
        'is-perishable'             =>  'Is Perishable',
        'sort-order'                =>  'Sort Order',
        'sort-order-note'           => '<strong>Note:</strong> Number 0-999',
        'choose_category'           =>  'Choose Category',
        'is_parent'                 =>  '--- Is Parent ---',
        'choose_filters'            =>  'Filters',
        'attribute_name'            =>  'Attribute',
        'text'                      =>  'Text',
        'sku'                       =>  'SKU',
        'price'                     =>  'Price',
        'price-note'                =>  '<strong>Note:</strong> Number / Decimal',
        'weight_in'                 =>  'Weight In',
        'weight'                    =>  'Weight',
        'quantity'                  =>  'Quantity',
        'attribute'                 =>  'Attribute',
        'attribute_values'          =>  'Values',
        'data'                      =>  'Data',
        'product'                   =>  'Products',
        'general'                   =>  'General',
        'multiple-images'           =>  'Images',
        'alt-tag'                   =>  'Alt Tag',
        'from'                      =>  'From',
        'to'                        =>  'To',
    ],

    'action'               => [
        'create'                => 'Create New Basket ',
        'generate'              => 'Generate Basket ',
        'note'                  => 'General Notes',
        'edit'                  => 'Edit Basket ',
        'search'                    =>  'Search',
        'reset'                     =>  'Reset',
    ],

];
