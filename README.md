# mongoDb
## Tài liệu về mongoDb ( NOSQL )
## 1. Cách setup mongoDb
   - Bước 1: Import khóa GPG của MongoDB
      ```bash
      wget -qO - https://www.mongodb.org/static/pgp/server-6.0.asc | sudo apt-key add -
      
   - Bước 2: Thêm MongoDB Repository vào hệ thống
      ```bash
      echo "deb [ arch=amd64,arm64 ] https://repo.mongodb.org/apt/ubuntu $(lsb_release -cs)/mongodb-org/6.0 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-org-6.0.list

   - Bước 3: Cập nhật lại danh sách gói
       ```bash
       sudo apt update
   - Bước 4: Cài đặt MongoDB
       ```bash
       sudo apt install -y mongodb-org
   - Bước 5: Khởi động MongoDB
       ```bash
      sudo systemctl start mongod
      sudo systemctl enable mongod

     #Kiểm tra trạng thái MongoDB
      sudo systemctl status mongod
      ```
   - Bước 6: Kiểm tra MongoDB đã cài đặt thành công chưa
       ```bash
       mongosh

   - Bước 7: Sử dụng Composer để cài MongoDB driver
        ```bash
        composer require mongodb/mongodb
        ```

## 2. Tạo User và Bật Authentication.
- Chuyển vào database admin
	+ Trước tiên, mở terminal và kết nối vào MongoDB:
	   ```bash
	   mongosh
	   ```
- Chuyển vào database admin
  + MongoDB có một database đặc biệt để quản lý người dùng, đó là database admin. Sử dụng lệnh sau để chuyển sang database admin:
      ```bash
      use admin
      ```
- Tạo User
  + Tạo một user mới trong MongoDB với quyền đọc và ghi trong một database cụ thể:
      ```bash
      	use eric-v2> db.createUser({ user: "root", pwd: "123123", /* Mật khẩu cho tài khoản admin*/ roles: [{ role: "readWrite", db: "eric-v2" }] /* Quyền "root" cho toàn bộ hệ thống*/ })
         db.createUser({ user: "root", pwd: "123123", roles: [ { role: "readWrite", db: "myDatabase" }] })
         user: Tên người dùng
         pwd: Mật khẩu của người dùng
         roles: Các quyền của người dùng, ví dụ:
         readWrite: Quyền đọc và ghi trong database
         read: Quyền chỉ đọc trong database
         dbAdmin: Quyền quản trị cơ sở dữ liệu
      ```
- Bật Authentication trong MongoDB
   + Để bật tính năng xác thực, bạn cần chỉnh sửa file cấu hình MongoDB:
   	```bash
      sudo nano /etc/mongod.conf
## 3. Đổi port
 - Mở file cấu hình MongoDB
   ```bash
   sudo nano /etc/mongod.conf
 - Tìm phần cấu hình net và thay đổi port
   ```bash
   net:
 		bindIp: 127.0.0.1  # Hoặc 0.0.0.0 nếu bạn muốn MongoDB chấp nhận kết nối từ mọi địa chỉ
  		port: 27018         # Thay đổi cổng ở đây, ví dụ từ 27017 sang 27018
 - Lưu và thoát
   ```bash
	Đối với nano: nhấn Ctrl + O để lưu và Ctrl + X để thoát.
	Đối với vim: nhấn :wq và nhấn Enter.
 - Khởi động lại MongoDB
   ```bash
   sudo systemctl restart mongod
 - Kiểm tra lại MongoDB ( cái này không cần kiểm tra cũng được )
   ```bash
   sudo netstat -plnt | grep mongod
 - Kết nối tới MongoDB trên cổng mới
   ```bash
   mongosh --port 27018
## 4. Để tạo một cơ sở dữ liệu
   - Kết nối vào MongoDB
     ```bash
     mongosh # Nếu bạn sử dụng cổng mặc định 27014
     mongosh --port 27018  # Nếu bạn sử dụng cổng khác
   - Chọn hoặc tạo cơ sở dữ liệu mới
     ```bash
     use myNewDatabase
   - Thêm dữ liệu vào cơ sở dữ liệu
     Khi bạn đã chọn cơ sở dữ liệu, bạn có thể thêm dữ liệu vào cơ sở dữ liệu đó bằng cách tạo một collection và chèn một document.
		Ví dụ:
     ```bash
     db.myCollection.insertOne({ name: "John", age: 30 })
   - Kiểm tra cơ sở dữ liệu
     + Liệt kê tất cả cơ sở dữ liệu:
       ```bash
       show dbs
     + Hiển thị các collection trong cơ sở dữ liệu hiện tại:
     	```bash
     	show collections
   - Xóa cơ sở dữ liệu
     ```bash
     db.dropDatabase()
     ```
## 5. Cài cho php
- đầu tiên nên cho php8.1 sang mặc định
  ```bash
  sudo update-alternatives --set php /usr/bin/php8.1
- Cài ext ext-mongodb
  + Cài đặt MongoDB PHP extension: Trước tiên, bạn cần cài đặt MongoDB extension cho PHP. Để làm điều này, bạn có thể sử dụng các lệnh sau trong terminal.
	Đối với PHP 7.x hoặc 8.x, sử dụng lệnh sau:
	```bash
  	sudo apt-get update
	sudo apt-get install php-pear php-dev
	sudo apt-get install libmongoc-dev
	sudo pecl install mongodb
+ Kích hoạt extension: Sau khi cài đặt thành công, bạn cần thêm extension MongoDB vào file cấu hình PHP. Mở file php.ini của bạn bằng cách sử dụng lệnh:
  ```bash
  sudo nano /etc/php/7.x/cli/php.ini
  ```
  Thay 7.x bằng phiên bản PHP của bạn. Thêm dòng sau vào cuối file:
  ```bash
  extension=mongodb.so
+ Khởi động lại Apache hoặc PHP-FPM (tuỳ thuộc vào web server bạn đang sử dụng):
	Nếu bạn đang sử dụng Apache:
	```bash
	sudo systemctl restart apache2
	```
	Nếu bạn đang sử dụng PHP-FPM (ví dụ, PHP 7.4-FPM):
	```bash
	sudo systemctl restart php7.4-fpm
-	dadas
-	


