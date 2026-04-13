<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard Admin
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

// Profile Edit
Breadcrumbs::for('profile.edit', function (BreadcrumbTrail $trail) {
    $trail->push('Profile', route('profile.edit'));
});

// --- BREADCRUMBS UNTUK USERS ---
// User
Breadcrumbs::for('admin.user.index', function (BreadcrumbTrail $trail) {
    $trail->push('Users', route('admin.user.index'));
});

// User > Tambah User
Breadcrumbs::for('admin.user.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.user.index');
    $trail->push('Create User', route('admin.user.create'));
});

// User > Edit [Nama User]
Breadcrumbs::for('admin.user.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.user.index');
    $trail->push('Edit: ' . $user->name, route('admin.user.edit', $user->id));
});

// --- BREADCRUMBS UNTUK CATEGORY ---
// Kategori
Breadcrumbs::for('admin.category.index', function (BreadcrumbTrail $trail) {
    $trail->push('Categories', route('admin.category.index'));
});

// Kategori > Tambah Kategori
Breadcrumbs::for('admin.category.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.category.index');
    $trail->push('Create Category', route('admin.category.create'));
});

// Kategori > Edit [Nama Kategori]
Breadcrumbs::for('admin.category.edit', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('admin.category.index');
    $trail->push('Edit: ' . $category->category_name, route('admin.category.edit', $category->id));
});

// --- BREADCRUMBS UNTUK PRODUCT ---
// Produk
Breadcrumbs::for('admin.product.index', function (BreadcrumbTrail $trail) {
    $trail->push('Products', route('admin.product.index'));
});

// Produk > Tambah Produk
Breadcrumbs::for('admin.product.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.product.index');
    $trail->push('Create Product', route('admin.product.create'));
});

// Produk > Detail [Nama Produk]
Breadcrumbs::for('admin.product.show', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('admin.product.index');
    $trail->push($product->name, route('admin.product.show', $product->id));
});

// Produk > Edit [Nama Produk]
Breadcrumbs::for('admin.product.edit', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('admin.product.index');
    $trail->push('Edit: ' . $product->name, route('admin.product.edit', $product->id));
});

// --- BREADCRUMBS UNTUK CHECKOUT ---
// Checkout
Breadcrumbs::for('admin.checkout.index', function (BreadcrumbTrail $trail) {
    $trail->push('Checkouts', route('admin.checkout.index'));
});

// Checkout > Detail [Ref Number]
Breadcrumbs::for('admin.checkout.show', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.checkout.index');
});

// --- BREADCRUMBS UNTUK LAPORAN ---
// Laporan
Breadcrumbs::for('admin.report.index', function (BreadcrumbTrail $trail) {
    $trail->push('Reports', route('admin.report.index'));
});

// Laporan > PDF
Breadcrumbs::for('admin.report.pdf', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.report.index');
    $trail->push('Generate PDF', route('admin.report.pdf'));
});