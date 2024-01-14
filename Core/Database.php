<?

namespace Core;

use PDO;

class Database 
{
    private $connection;
    private $statement;

    public function __construct($config, $username =  'root', $password = 'dreamsql') {

        $dsn = 'mysql:' . http_build_query($config,'', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

    }
    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;
    }


    public function get() {
        return $this->statement->fetchAll();
    }

    public function getLastID() {
        return (int)$this->connection->lastInsertId();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function totlaRows() {
        return $this->statement->rowCount();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (!$result) abort();
        

        return $result;
    }

    public function findAllOrFail()
    {
        $result = $this->get();

        if (!$result) abort();
        

        return $result;
    }
}
