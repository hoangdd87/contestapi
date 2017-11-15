<?php
include_once 'PDOHelper.php';
$ROOT = '/contestapi/';

session_start();
$pdohelper = new PDOHelper();

if ( ! isset( $_SESSION['user'] ) ) { //User chua dang nhap
	header( 'Location: login.php' );
	exit();

} else {
	$user = $_SESSION['user'];
	// print_r( $user );
	if ( $_POST ) {
		print_r( $_POST );
		$path = "uploads/";
		$name = $_FILES['uploaded_file']['name'];
		echo $name;
		$array = explode( ".", $name );
		$ext   = end( $array );
		$path  = $path . 'SBD' . $user['id'] . '_BAI' . $_POST['sttbai'] . '.' . $ext;
		if ( move_uploaded_file( $_FILES['uploaded_file']['tmp_name'], $path ) ) {
			echo "The file " . basename( $_FILES['uploaded_file']['name'] ) .
			     " has been uploaded";
			$pdohelper->insert_bai_nop( $user['id'], $_POST['sttbai'], $path );

		} else {
			echo "There was an error uploading the file, please try again!";
		}
	}
	$bai1 = $pdohelper->get_bainop( $user['id'], '1' );
	print_r( $bai1 );
	$bai2 = $pdohelper->get_bainop( $user['id'], '2' );
	print_r( $bai2 );
	?>
    <a href="uploads/SBD1_BAI1.xlsx">Download</a>
    <h1>Xin chào bạn: <?php echo $user['fullname'] ?>. SBD: <?php echo $user['id']; ?></h1>

    <h2>Bài nộp của bạn:</h2>
    <br><br>

    <form enctype="multipart/form-data" action="index.php" method="POST">
        <label>Bài 1: </label>
        <input type="file" name="uploaded_file" required>
        <input type="submit" value="Upload">
        <input type="hidden" name="sttbai" value='1'/>
        <p> Thời gian nộp lần cuối: <b><?php echo substr($bai1['time'],10); ?></b></p>

    </form>

    <form action="getfile.php" method="POST">
        <button style="background: green;">Download xem lại bài 1 đã nộp</button>
        <input type="hidden" name="sttbai" value='1'/>
    </form>

    <br><br>
    <form enctype="multipart/form-data" action="index.php" method="POST">
        <label>Bài 2: </label>
        <input type="file" name="uploaded_file" required>
        <input type="submit" value="Upload">
        <input type="hidden" name="sttbai" value='2'/>
        <p> Thời gian nộp lần cuối: <b><?php echo substr($bai2['time'],10); ?></b></p>

    </form>
    <form action="getfile.php" method="POST">
        <button style="background: green;">Download xem lại bài 2 đã nộp</button>
        <input type="hidden" name="sttbai" value='2'/>
    </form>
 

<?php } ?>