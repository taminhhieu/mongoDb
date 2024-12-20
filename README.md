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
       ```
      # Kiểm tra trạng thái MongoDB
        ```bash
           sudo systemctl status mongod
        ```
   - Bước 6: Kiểm tra MongoDB đã cài đặt thành công chưa
       ```bash
       mongosh
3. 
