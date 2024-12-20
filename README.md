# mongoDb
Tài liệu về mongoDb ( NOSQL )
1. Cách setup mongoDb
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

   - Bước 7: Sử dụng Composer để cài MongoDB driver:
        ```bash
        composer require mongodb/mongodb

2. Tạo User và Bật Authentication
   Trước tiên, mở terminal và kết nối vào MongoDB:
   ```bash
   mongosh
   ```
   2.2 Chuyển vào database admin
      MongoDB có một database đặc biệt để quản lý người dùng, đó là database admin. Sử dụng lệnh sau để chuyển sang database admin:
      ```bash
      use admin
      ```
   2.3 Tạo User
      Tạo một user mới trong MongoDB với quyền đọc và ghi trong một database cụ thể:
      ```bash
         db.createUser({ user: "root", pwd: "123123", roles: [ { role: "readWrite", db: "myDatabase" }] })
         user: Tên người dùng
         pwd: Mật khẩu của người dùng
         roles: Các quyền của người dùng, ví dụ:
         readWrite: Quyền đọc và ghi trong database
         read: Quyền chỉ đọc trong database
         dbAdmin: Quyền quản trị cơ sở dữ liệu
      ```
   2.4 Bật Authentication trong MongoDB
   Để bật tính năng xác thực, bạn cần chỉnh sửa file cấu hình MongoDB:
      
4. đá
5. sfđ
6.   
