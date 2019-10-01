<?php
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Home
Breadcrumbs::for('home', static function ($trail) {
    $trail->push('Home', route('home'));
});

// Categories
Breadcrumbs::for('categories', static function ($trail) {
    $trail->push('Категории', route('categories.index'));
});

// Categories > Create
Breadcrumbs::for('categories.create', static function ($trail) {
    $trail->parent('categories');
    $trail->push('Добавление категории', route('categories.create'));
});

// Categories > Category 123 > Edit
Breadcrumbs::for('categories.edit', static function ($trail, $category) {
    $trail->parent('categories');
    $trail->push('Изменение категории', route('categories.edit', ['category' => $category]));
});

// Projects
Breadcrumbs::for('projects', static function ($trail) {
    $trail->push('Проекты', route('projects.index'));
});

// Projects > Create
Breadcrumbs::for('projects.create', static function ($trail) {
    $trail->parent('projects');
    $trail->push('Добавление проекта', route('projects.create'));
});

// Projects > Project 123 > Edit
Breadcrumbs::for('projects.edit', static function ($trail, $project) {
    $trail->parent('projects');
    $trail->push('Изменение проекта', route('projects.edit', ['project' => $project]));
});

// Tags
Breadcrumbs::for('tags', static function ($trail) {
    $trail->push('Теги', route('tags.index'));
});

// Tags > Create
Breadcrumbs::for('tags.create', static function ($trail) {
    $trail->parent('tags');
    $trail->push('Добавление тега', route('tags.create'));
});

// Tags > Tag 123 > Edit
Breadcrumbs::for('tags.edit', static function ($trail, $tag) {
    $trail->parent('tags');
    $trail->push('Изменение тега', route('tags.edit', ['tag' => $tag]));
});

// Users
Breadcrumbs::for('users', static function ($trail) {
    $trail->push('Пользователи', route('users.index'));
});

// Users > Create
Breadcrumbs::for('users.create', static function ($trail) {
    $trail->parent('users');
    $trail->push('Добавление пользователя', route('users.create'));
});

// Users > User 123 > Edit
Breadcrumbs::for('users.edit', static function ($trail, $user) {
    $trail->parent('users');
    $trail->push('Изменение пользователя', route('users.edit', ['user' => $user]));
});