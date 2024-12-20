<?php

require 'vendor/autoload.php';
require_once "src/load_envs.php";

use MongoDB\Client;

class MongoDBConnection
{
    protected $client;
    protected $database;

    public function __construct()
    {
        global $envs;

        $host = $envs['MG_DB_HOST'];
        $port = $envs['MG_DB_PORT'];
        $dbName = $envs['MG_DB_NAME'];
        $username = $envs['MG_DB_USERNAME'];
        $password = $envs['MG_DB_PASSWORD'];

        // Kết nối tới MongoDB, nếu có username và password thì thêm vào chuỗi kết nối
        $uri = "mongodb://$host:$port";
        if ($username && $password) {
            $uri = "mongodb://$username:$password@$host:$port/$dbName";
        }

        $this->client = new Client($uri);
        $this->database = $this->client->selectDatabase($dbName);
    }

    // Hàm tạo collection mới
    public function createCollection($collectionName)
    {
        try {
            $this->database->createCollection($collectionName);
        } catch (\Exception $e) {
            echo "Lỗi khi tạo collection: " . $e->getMessage() . "\n";
        }
    }

    // Hàm thêm document vào collection
    public function insertDocument($collectionName, $document)
    {
        try {
            $collection = $this->database->selectCollection($collectionName);
            $result = $collection->insertOne($document);
            echo "Đã thêm 1 document vào collection '$collectionName'. ID: " . $result->getInsertedId() . "\n";
        } catch (\Exception $e) {
            echo "Lỗi khi thêm document: " . $e->getMessage() . "\n";
        }
    }

    // Hàm lấy tất cả các document trong collection
    public function getAllDocuments($collectionName)
    {
        try {
            $collection = $this->database->selectCollection($collectionName);
            return $collection->find()->toArray();
        } catch (\Exception $e) {
            echo "Lỗi khi lấy document: " . $e->getMessage() . "\n";
        }
    }

    // Hàm xóa collection
    public function deleteCollection($collectionName)
    {
        try {
            $collection = $this->database->selectCollection($collectionName);
            $collection->drop();
            echo "Collection '$collectionName' đã bị xóa.\n";
        } catch (\Exception $e) {
            echo "Lỗi khi xóa collection: " . $e->getMessage() . "\n";
        }
    }
}
