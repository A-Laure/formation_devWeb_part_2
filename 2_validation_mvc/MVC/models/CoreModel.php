<?php 

  abstract class CoreModel 
  {

    private $_engine = DB_ENGINE;
    private $_host = DB_HOST;
    private $_dbname = DB_NAME;
    private $_charset = DB_CHARSET;
    private $_dbuser = DB_USER;
    private $_dbpwd = DB_PWD;

    private $_db;

    # Constructeur qui appele ma méthode connect() pour la connexion a la BDD
    public function __construct()
    {
      $this->connect();
    }

    /**
     * Connexion à la BDD
     * 
     * @return void
     * 
     */
    private function connect() : void
    {
      try
      {
        $dsn = $this->_engine . ':host=' . $this->_host .  ';dbname='.$this->_dbname .';charset='.$this->_charset;
        $this->_db = new PDO($dsn, $this->_dbuser, $this->_dbpwd, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);
    
      } catch(PDOException $e)
      {
         die($e->getMessage());
      }
    }

    /**
     * Getter de _db qui nous retourne un objet PDO
     * 
     * @return PDO
     * 
     */
    protected function getDb() : PDO
    {
      return $this->_db;
    }

  }