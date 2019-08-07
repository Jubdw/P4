<?php

namespace Ju\Blog\Model;

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=db5000143097.hosting-data.io;dbname=dbs138445;charset=utf8', 'dbu91864', '-Ehna999');
        return $db;
    }
}