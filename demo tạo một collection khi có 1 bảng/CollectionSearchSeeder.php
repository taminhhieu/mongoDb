<?php

declare(strict_types=1);
namespace db;
require_once 'MongoDBConnection.php';

$mongo = new \MongoDBConnection();
$mongo->createCollection('testo1');
