<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard Admin
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

// --- BREADCRUMBS UNTUK CATEGORY ---

// Dashboard > Kategori
Breadcrumbs::for('admin.category.index', function (BreadcrumbTrail $trail) {
    $trail->push('Categories', route('admin.category.index'));
});

// Dashboard > Kategori > Tambah Kategori
Breadcrumbs::for('admin.category.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.category.index');
    $trail->push('Create Category', route('admin.category.create'));
});

// Dashboard > Kategori > Edit [Nama Kategori]
Breadcrumbs::for('admin.category.edit', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('admin.category.index');
    $trail->push('Edit: ' . $category->category_name, route('admin.category.edit', $category->id));
});

// --- BREADCRUMBS UNTUK PRODUCT ---

// Dashboard > Produk
Breadcrumbs::for('admin.product.index', function (BreadcrumbTrail $trail) {
    $trail->push('Products', route('admin.product.index'));
});

// Dashboard > Produk > Tambah Produk
Breadcrumbs::for('admin.product.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.product.index');
    $trail->push('Create Product', route('admin.product.create'));
});

// Dashboard > Produk > Detail [Nama Produk]
Breadcrumbs::for('admin.product.show', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('admin.product.index');
    $trail->push($product->name, route('admin.product.show', $product->id));
});

// Dashboard > Produk > Edit [Nama Produk]
Breadcrumbs::for('admin.product.edit', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('admin.product.index'); // Atau bisa ke .show jika mau lebih dalam
    $trail->push('Edit: ' . $product->name, route('admin.product.edit', $product->id));
});