<?php

namespace Winter\Component\Http\Session\SessionHandler;

/**
 * PdoSessionHandler, handler to store session in database
 *
 * @author Lorenzo Iannone
 */
class PdoSessionHandler implements \SessionHandlerInterface {

    const TABLE_ID = "wps_id";
    const TABLE_DATA = "wps_data";
    const TABLE_TIMESTAMP = "wps_timestamp";
    const TABLE_NAME = "winter_pdo_session";

    /**
     * As the name says, the instance of pdo
     * @var resource
     */
    protected $pdoInstance;

    /**
     * Default PdoSessionHandler constructor
     */
    public function __construct(\PDO $pdo) {

        $this->pdoInstance = $pdo;
        $query = "SELECT 1 FROM " . self::TABLE_NAME;
        try {
            $stmt = $this->pdoInstance->prepare($query);
            $stmt->bindParam(':sessionid', $sessionId, \PDO::PARAM_STR);
            $stmt->execute();
        } catch (\PDOException $e) {
            $this->createSessionTable();
        }
    }

    /**
     * Create the session table;
     * @throws \RuntimeException
     */
    public function createSessionTable() {
        
        $query = "CREATE table " . self::TABLE_NAME .
                "( " .
                self::TABLE_ID . " CHAR(32), " .
                self::TABLE_TIMESTAMP . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP, " .
                self::TABLE_DATA . " TEXT, " .
                "PRIMARY KEY(" . self::TABLE_ID . "), " .
                "KEY(" . self::TABLE_TIMESTAMP . ")" .
                ")";

        try {
            $stmt = $this->pdoInstance->prepare($query);
            $stmt->execute();
        } catch (\PDOException $e) {
            throw new \RuntimeException("Unable to create session table due to PDO error " . $e->getMessage);
        }
    }

    /**
     * Open
     * 
     * @param type $save_path
     * @param type $name
     * @return boolean
     */
    public function open($save_path, $name) {
        
        //nothing to do when open
        return true;
    }

    /**
     * Close
     * @return boolean
     */
    public function close() {
        //nothing to do when close
        return true;
    }

    /**
     * Destroy the session
     * 
     * @param string $sessionId
     * @return boolean
     * @throws \RuntimeException
     */
    public function destroy($sessionId) {

        // delete the record associated with this id
        $query = sprintf("DELETE FROM %s WHERE %s = :sessionid", self::TABLE_NAME, self::TABLE_ID);

        try {
            $stmt = $this->pdoInstance->prepare($query);
            $stmt->bindParam(':sessionid', $sessionId, \PDO::PARAM_STR);
            $stmt->execute();
        } catch (\PDOException $e) {
            throw new \RuntimeException("Unable to destroy session {$sessionId} due to PDO Exception " . $e->getMessage());
        }

        return true;
    }

    /**
     * Garbage collection of expired session
     * 
     * @param string $maxlifetime
     * @return boolean
     * @throws \RuntimeException
     */
    public function gc($maxlifetime) {
        
        $query = sprintf("DELETE FROM %s WHERE %s < :maxtime", self::TABLE_NAME, self::TABLE_TIMESTAMP);
        try {
            $stmt = $this->pdoInstance->prepare($sql);
            $stmt->bindValue(':maxtime', time() - $lifetime, \PDO::PARAM_INT);
            $stmt->execute();
        } catch (\PDOException $e) {
            throw new \RuntimeException('Unable to collect session due to PDO Exception ' . $e->getMessage());
        }

        return true;
    }

    /**
     * Read the data from storage
     * 
     * @param string $session_id
     */
    public function read($sessionId) {

        $session = null;
        try {
            //Ensemble the query
            $query = sprintf("SELECT * from %s WHERE %s = :sessionid",self::TABLE_NAME ,self::TABLE_ID );
            //prepare it
            $stmt = $this->pdoInstance->prepare($query);
            $this->pdoInstance->bindParam(':sessionid', $sessionId, \PDO::PARAM_STR);
            //and now execute
            $stmt->execute();
            $session = $stmt->fetchAll(\PDO::FETCH_NUM);
        } catch (\PDOException $e) {
            throw new \RuntimeException("Unable to read data for session {$sessionId} due to PDO exception " . $e->getMessage());
        }
        //used FECTH_NUM because it is the fastest way

        if (count($session) != 1) {
            //session never created 
            $this->createSession($sessionId);
            return null;
        }

        //finally the values in session are returned
        return base64_decode($session[0][0]);
    }

    /**
     * Write data to pdo session
     * 
     * @param string $sessionId
     * @param string $sessionData
     * @return boolean
     * @throws \RuntimeException
     */
    public function write($sessionId, $sessionData) {
        
        //session data can contain non binary safe characters so we need to encode it
        $encodedSessionData = base64_encode($sessionData);

        try {
            //get the Pdo driver name
            $driverName = $this->pdoInstance->getAttribute(\PDO::ATTR_DRIVER_NAME);

            switch ($driverName) {
                case "mysql":
                    $query = sprintf(
                            "INSERT INTO %s (%s %s, %s) VALUES (:sessionid, :sessiondata, :timestamp) " .
                            "ON DUPLICATE KEY UPDATE %s = :data, %s = :timestampNOW()", self::TABLE_NAME, self::TABLE_ID, self::TABLE_TIMESTAMP, self::TABLE_DATA, self::TABLE_DATA, self::TABLE_TIMESTAMP);
                    $stmt = $this->pdoInstance->prepare($query);
                    $stmt->bindParam(':sessionid', $sessionId, \PDO::PARAM_STR);
                    $stmt->bindParam(':sessiondata', $encodedSessionData, \PDO::PARAM_STR);
                    $stmt->bindParam(':timestamp', time(), \PDO::PARAM_INT);
                    $stmt->execute();
                    break;
                case "oci" : //oracle driver
                    $query = sprintf(
                            "MERGE INTO %s USING DUAL ON(%s = :sessionid) " .
                            "WHEN NOT MATCHED THEN INSERT (%s, %s, %s) VALUES (:sessionid, :sessiondata, sysdate) " .
                            "WHEN MATCHED THEN UPDATE SET %s = :sessiondata WHERE %s = :sessionid", 
                            self::TABLE_NAME, 
                            self::TABLE_ID, 
                            self::TABLE_ID, 
                            self::TABLE_DATA, 
                            self::TABLE_TIMESTAMP, 
                            self::TABLE_DATA, 
                            self::TABLE_ID);
                    
                    $stmt = $this->pdoInstance->prepare($query);
                    $stmt->bindParam(':sessionid', $sessionId, \PDO::PARAM_STR);
                    $stmt->bindParam(':sessiondata', $encodedSessionData, \PDO::PARAM_STR);
                    $stmt->bindParam(':timestamp', time(), \PDO::PARAM_INT);
                    $stmt->execute();

                default:
                    
                    $query = sprintf("UPDATE %s SET %s = :sessiondata, %s = :timestamp WHERE %s = :sessionid",
                                    self::TABLE_NAME,
                                    self::TABLE_DATA,
                                    self::TABLE_TIMESTAMP,
                                    self::TABLE_ID);
                        
                    $stmt = $this->pdoInstance->prepare();
                    $stmt->bindParam(':sessionid', $id, \PDO::PARAM_STR);
                    $stmt->bindParam(':sessiondata', $encoded, \PDO::PARAM_STR);
                    $stmt->bindValue(':timestamp', time(), \PDO::PARAM_INT);
                    $stmt->execute();

                    break;

                if (!$stmt->rowCount()) {
                    $this->createNewSession($sessionId, $sessionData);
                }                
            }
        } catch (\PDOException $e) {
            throw new \RuntimeException(sprintf('PDOException was thrown when trying to write the session data: %s', $e->getMessage()), 0, $e);
        }
        
        return true;
    }

}