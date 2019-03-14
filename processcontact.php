<!--
Katelyn Jaing
CPSC 431-01
Homework 1: processed contact file
-->
<?php

	//get user input
	$name = preg_replace( '/\t|\R/', ' ', $_POST[ 'name' ] );
	$email = preg_replace( '/\t|\R/', ' ', $_POST[ 'email' ] );
	$comment = preg_replace( '/\t|\R/', ' ', $_POST[ 'comment' ] );
	$color = $_POST[ 'color' ];

	require( 'header.php' );

	if( empty( $name ) || empty( $email ) ){
		echo "<p>You forgot your name and/or email!</p>";
	}
	else{
		if( empty( $comment ) ){
			$comment = ' ';
		}
		$contactinfo = $name . " | " . $email . " | " . $comment . " | " . $color . "\n";
		//open file for appending
		@$fp = fopen( "form.txt", 'ab' );
		if( !$fp ){
			echo "<p><strong>Your order could not be processed at this time Please try again later.</strong></p>";
			exit;
		}
		else{
			flock( $fp, LOCK_EX );
			fwrite( $fp, $contactinfo );
			flock( $fp, LOCK_UN );
			fclose( $fp );
			echo "<p>Info written</p>";
		}
	}


	require( 'footer.php' );
?>








