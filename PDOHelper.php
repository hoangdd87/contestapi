<?php

class PDOHelper {
	public $PDO;

	public function __construct() {
		try {

			//include($_SERVER['DOCUMENT_ROOT'] . '/variables/variables_crossword.php');
			$host     = 'localhost';
			$database = 'contest';
			$user     = 'root';
			$pass     = 'mysql';

			$this->PDO = new PDO( "mysql:host=$host;dbname=$database;charset=utf8", $user, $pass );
			$this->PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		} catch
		( PDOException $e ) {
			echo $e->getMessage();
		}
	}

	/**
	 * @param string $email
	 * @param string $password
	 */
	public function getUser( $filters = null ) {
		// $filters = array("id"=>"1", "password" => "29");
		if ( ! $filters ) {
			return;
		}
		$query = 'Select * from users';
		if ( $filters ) {
			$query = $query . ' WHERE';
			$count = 0;
			foreach ( $filters as $key => $value ) {
				$count ++;
				$AND   = $count >= 2 ? ' AND' : '';
				$query = $query . "$AND" . " :$key=$key";
			}

		}
		$sth = $this->PDO->prepare( $query );
		$sth->execute( $filters );

		return $sth->fetch( PDO::FETCH_ASSOC );

	}

	public function get_bainop( $user_id, $bai ) {
		$query = 'SELECT id, user_id, bai, link, time 
		FROM bainop WHERE user_id = :user_id AND bai = :bai ORDER BY time DESC';
		$sth   = $this->PDO->prepare( $query );
		$sth->bindParam( ':user_id', $user_id );
		$sth->bindParam( ':bai', $bai );
		$sth->execute();

		return $sth->fetch( PDO::FETCH_ASSOC );

	}

	public function insert_bai_nop( $user_id, $bai, $link ) {
		$query = 'INSERT INTO bainop(user_id, bai, link, time) VALUES (:user_id, :bai, :link, :time)';
		$sth   = $this->PDO->prepare( $query );
		$sth->bindParam( ':user_id', $user_id );
		$sth->bindParam( ':bai', $bai );
		$sth->bindParam( ':link', $link );
		date_default_timezone_set( 'Asia/Bangkok' );
		$sDate = date( "Y-m-d H:i:s" );
		$sth->bindParam( ':time', $sDate );

		return $sth->execute();
	}

}


?>


