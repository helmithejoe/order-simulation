# Order Simulation
Aplikasi Order Simulation mempunyai 2 jenis user Login: `User` dan `Driver`. Aplikasi memiliki 1 `User` dan 2 `Driver`.
`User` melakukan pesanan dan `Driver` mengambil pesanan untuk diantar ke alamat tujuan. Apabila pesanan telah diambil oleh salah satu `Driver`, maka `Driver` lain sudah tidak bisa mengambil order yang sama.


## Business Process

### 1. User melakukan login dan memilih SKU untuk dipesan
![alt text](https://github.com/lincgroup/order-simulation/raw/master/images/1-create-order.png "Create Order")

### 2. User mengisi alamat tujuan pesanan
![alt text](https://github.com/lincgroup/order-simulation/raw/master/images/2-input-delivery-address.png "Input Delivery Address")

### 3. Pesanan telah terbuat dengan rincian status dan waktu terbuatnya
![alt text](https://github.com/lincgroup/order-simulation/raw/master/images/3-order-created.png "Order Created")

### 4. Driver melakukan login dan melihat ada pesanan yang perlu diproses
![alt text](https://github.com/lincgroup/order-simulation/raw/master/images/4-driver-view-order.png "Driver View Order")

### 5a. Driver mengambil pesanan tersebut untuk diproses
![alt text](https://github.com/lincgroup/order-simulation/raw/master/images/5-driver-job-created.png "Driver Job Created")

### 5b. Driver lain yang login sudah tidak dapat melihat order yang telah diambil oleh driver pertama
![alt text](https://github.com/lincgroup/order-simulation/raw/master/images/5-driver-other-dont-see-order.png "Other Driver Don't See Taken Order")

### 6. Driver siap untuk berangkat dan mengubah status order menjadi "On Delivery"
![alt text](https://github.com/lincgroup/order-simulation/raw/master/images/6-driver-on-delivery.png "Driver On Delivery")

### 7. Driver telah tiba di tujuan dan mengubah status order menjadi "Delivered"
![alt text](https://github.com/lincgroup/order-simulation/raw/master/images/7-driver-order-delivered.png "Driver Job Created")

## Data Diagram
Aplikasi Order Simulation ini mempunyai struktur data sebagai berikut:

![alt text](https://github.com/lincgroup/order-simulation/raw/master/images/0-data-diagram.png "Data Diagram")
