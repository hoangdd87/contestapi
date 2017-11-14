<?php
session_start();
include_once 'PDOHelper.php';
if ( ! isset( $_SESSION['user'] ) ) {
	exit();
} else {
	$pdohelper = new PDOHelper();
	if ( $bainop = $pdohelper->get_bainop( $_SESSION['user']['id'], $_POST['sttbai'] ) ) {
		$file = $bainop['link'];

		$file = 'SBD1_BAI1.xlsx';

		if (file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($file).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			readfile($file);
			exit;
		}
	}else{
		echo 'Bạn chưa nộp bài này';
	}

}
?>