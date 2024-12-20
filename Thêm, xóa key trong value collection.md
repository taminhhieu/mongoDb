Ví dụ:
Giả sử bạn có một collection chứa các document dạng:
```json
{ "name": "John", "age": 30 }
{ "name": "Alice", "age": 25 }
```
## Bạn muốn thêm một key mới có tên city và giá trị mặc định là "New York".
Code PHP:
```php
<?php

require 'vendor/autoload.php'; // Composer's autoloader

use MongoDB\Client;

// Kết nối tới MongoDB
$client = new Client("mongodb://localhost:27017");

// Chọn database và collection
$database = $client->selectDatabase('your_database_name');
$collection = $database->selectCollection('your_collection_name');

// Thêm key mới vào tất cả các document trong collection
$result = $collection->updateMany(
    [], // Điều kiện để chọn document, [] nghĩa là áp dụng cho tất cả
    ['$set' => ['city' => 'New York']] // Thêm key mới với giá trị mặc định
);

// Xóa key 'city' khỏi tất cả document
$result = $collection->updateMany(
    [], // Điều kiện, [] nghĩa là áp dụng cho tất cả document
    ['$unset' => ['city' => '']] // Xóa key 'city'
);

// In kết quả
echo "Matched " . $result->getMatchedCount() . " documents.\n";
echo "Modified " . $result->getModifiedCount() . " documents.\n";
```
Kết Quả Sau Khi Chạy:
Dữ liệu trong collection sẽ được cập nhật như sau:
```json
{ "name": "John", "age": 30, "city": "New York" }
{ "name": "Alice", "age": 25, "city": "New York" }
```
Giải Thích:
1. updateMany():
 + Dùng để cập nhật nhiều document cùng lúc.
 + Tham số đầu tiên [] chọn tất cả các document trong collection.
 + $set được dùng để thêm hoặc cập nhật giá trị cho một trường (key) trong document.

2. Trường city:
 + Nếu key đã tồn tại, $set sẽ cập nhật giá trị của key.
 + Nếu key chưa tồn tại, MongoDB sẽ thêm key đó vào document.
   
Ví dụ: Chỉ thêm key cho các document có age > 25:
```php
$result = $collection->updateMany(
    ['age' => ['$gt' => 25]],
    ['$set' => ['city' => 'New York']]
);

## 

