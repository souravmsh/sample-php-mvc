<!DOCTYPE html>
<html>
    <head>
    <title><?= $title ?? null ?></title>
    </head>

    <body>
        
    <b><?= $title ?? null ?></b>

    <ul>
        <li><a href="<?php url() ?>">Home</a></li>
        <li><a href="<?php url('users') ?>">Users</a></li>
        <li><a href="<?php url('about') ?>">About</a></li>
        <li><a href="<?php url('contact') ?>">Contact</a></li>
    </ul>
