<?php
session_start();
include_once 'PDOHelper.php';
if ( ! isset( $_SESSION['user'] ) ) {
	exit();
} else {
	$pdohelper = new PDOHelper();
	if ( $bainop = $pdohelper->get_bainop( $_SESSION['user']['id'], $_POST['sttbai'] ) ) {
		$file = $bainop['link'];

		if ( file_exists( $file ) ) {
			if ( false !== ( $handler = fopen( $file, 'r' ) ) ) {
				header( 'Content-Description: File Transfer' );
				header( 'Content-Type: application/octet-stream' );
				header( 'Content-Disposition: attachment; filename=' . basename( $file ) );
				header( 'Content-Transfer-Encoding: binary' );
				header( 'Expires: 0' );
				header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
				header( 'Pragma: public' );
				header( 'Content-Length: ' . filesize( $file ) ); //Remove

				//Send the content in chunks
				while ( false !== ( $chunk = fread( $handler, 4096 ) ) ) {
					echo $chunk;
				}
			}
			exit;
		}
	} else {
		echo 'Bạn chưa nộp bài này';
	}

}
?>