<?php

namespace Neptrox\ProductBasket\Models;

use App\Models\ProductData;

class ProductBasketData extends ProductData {

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'product_type_id', 'sku', 'price', 'image',
        'quantity', 'is_available', 'available_start', 'available_end', 'is_promotion',
        'promotion_start', 'promotion_end', 'views', 'points', 'length_class_id', 'length',
        'width', 'height', 'weight_class_id', 'weight', 'status', 'is_perishable', 'is_special', 'is_featured', 'sort_order',
        'manufacturer_id', 'tax_class_id', 'rating_cache', 'rating_count', 'custom_field'
    ];


}
