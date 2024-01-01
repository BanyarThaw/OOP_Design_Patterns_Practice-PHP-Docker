<?php
    class Product
    {
        private $id;
        private $name;
        private $price;
        
        // Getters and setters for properties...
    }

    interface ProductRepository
    {
        public function getById($id);
        public function getAll();
        public function save(Product $product);
        public function delete(Product $product);
    }
    class MySQLProductRepository implements ProductRepository
    {
        private $db;

        public function __construct(PDO $db)
        {
            $this->db = $db;
        }

        public function getById($id)
        {
            $query = $this->db->prepare("SELECT * FROM products WHERE id = :id");
            $query->execute(['id' => $id]);
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                return $this->mapToProduct($data);
            }

            return null;
        }

        public function getAll()
        {
            $query = $this->db->query("SELECT * FROM products");
            $data = $query->fetchAll(PDO::FETCH_ASSOC);

            $products = [];
            foreach ($data as $item) {
                $products[] = $this->mapToProduct($item);
            }

            return $products;
        }

        public function save(Product $product)
        {
            $query = $this->db->prepare("INSERT INTO products (name, price) VALUES (:name, :price)");
            $query->execute([
                'name' => $product->getName(),
                'price' => $product->getPrice(),
            ]);

            $productId = $this->db->lastInsertId();
            $product->setId($productId);
        }

        public function delete(Product $product)
        {
            $query = $this->db->prepare("DELETE FROM products WHERE id = :id");
            $query->execute(['id' => $product->getId()]);
        }

        private function mapToProduct($data)
        {
            $product = new Product();
            $product->setId($data['id']);
            $product->setName($data['name']);
            $product->setPrice($data['price']);

            return $product;
        }
    }

    class PostgresProductRepository implements ProductRepository
    {
        private $db;

        public function __construct(PDO $db)
        {
            $this->db = $db;
        }

        public function getById($id)
        {
            $query = $this->db->prepare("SELECT * FROM products WHERE id = :id");
            $query->execute(['id' => $id]);
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                return $this->mapToProduct($data);
            }

            return null;
        }

        public function getAll()
        {
            $query = $this->db->query("SELECT * FROM products");
            $data = $query->fetchAll(PDO::FETCH_ASSOC);

            $products = [];
            foreach ($data as $item) {
                $products[] = $this->mapToProduct($item);
            }

            return $products;
        }

        public function save(Product $product)
        {
            $query = $this->db->prepare("INSERT INTO products (name, price) VALUES (:name, :price)");
            $query->execute([
                'name' => $product->getName(),
                'price' => $product->getPrice(),
            ]);

            $productId = $this->db->lastInsertId();
            $product->setId($productId);
        }

        public function delete(Product $product)
        {
            $query = $this->db->prepare("DELETE FROM products WHERE id = :id");
            $query->execute(['id' => $product->getId()]);
        }

        private function mapToProduct($data)
        {
            $product = new Product();
            $product->setId($data['id']);
            $product->setName($data['name']);
            $product->setPrice($data['price']);

            return $product;
        }
    }

    // Create a PDO instance for MySQL database connection
    $mysqlDb = new PDO('mysql:host=localhost;dbname=your_mysql_database', 'mysql_user', 'mysql_password');

    // Create an instance of the MySQL repository
    $mysqlProductRepository = new MySQLProductRepository($mysqlDb);

    // Example: Get product by ID using MySQL repository
    $product = $mysqlProductRepository->getById(1);
    if ($product) {
        echo $product->getName() . PHP_EOL;
    }

    // Switching to PostgreSQL database

    // Create a PDO instance for PostgreSQL database connection
    $postgresDb = new PDO('pgsql:host=localhost;dbname=your_postgres_database', 'postgres_user', 'postgres_password');

    // Create an instance of the PostgreSQL repository
    $postgresProductRepository = new PostgresProductRepository($postgresDb);

    // Example: Get product by ID using PostgreSQL repository
    $product = $postgresProductRepository->getById(1);
    if ($product) {
        echo $product->getName() . PHP_EOL;
    }
?>