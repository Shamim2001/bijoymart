<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
   $trail->push('Home', route('index'));
});

// Home > Products
Breadcrumbs::for('products', function (BreadcrumbTrail $trail) {
   $trail->parent('home');
   $trail->push('Products', route('product'));
});

// Home > Products > [Product Name]
Breadcrumbs::for('product', function (BreadcrumbTrail $trail, $product) {
   $trail->parent('products');
   $trail->push($product->slug, route('product.quickview', $product->slug));
});
