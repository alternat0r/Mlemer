<?php
	require_once "config.php";

	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    	error_reporting( 0 );
	}

	/**
	 * Run a parametrized SELECT and return the mysqli_result (or false on failure).
	 * $types uses the standard mysqli_stmt_bind_param type string, e.g. "is" for int+string.
	 */
	function db_query( $sql, $types = "", ...$params ) {
		global $link;
		$stmt = mysqli_prepare( $link, $sql );
		if ( $stmt === false ) {
			error_log( "Mlemer DB prepare failed: " . mysqli_error( $link ) . " | SQL: " . $sql );
			return false;
		}
		if ( $types !== "" ) {
			mysqli_stmt_bind_param( $stmt, $types, ...$params );
		}
		if ( !mysqli_stmt_execute( $stmt ) ) {
			error_log( "Mlemer DB execute failed: " . mysqli_stmt_error( $stmt ) . " | SQL: " . $sql );
			mysqli_stmt_close( $stmt );
			return false;
		}
		$result = mysqli_stmt_get_result( $stmt );
		mysqli_stmt_close( $stmt );
		return $result;
	}

	/**
	 * Run a parametrized INSERT/UPDATE/DELETE. Returns true/false for success.
	 */
	function db_execute( $sql, $types = "", ...$params ) {
		global $link;
		$stmt = mysqli_prepare( $link, $sql );
		if ( $stmt === false ) {
			error_log( "Mlemer DB prepare failed: " . mysqli_error( $link ) . " | SQL: " . $sql );
			return false;
		}
		if ( $types !== "" ) {
			mysqli_stmt_bind_param( $stmt, $types, ...$params );
		}
		$ok = mysqli_stmt_execute( $stmt );
		if ( !$ok ) {
			error_log( "Mlemer DB execute failed: " . mysqli_stmt_error( $stmt ) . " | SQL: " . $sql );
		}
		$insert_id = mysqli_stmt_insert_id( $stmt );
		mysqli_stmt_close( $stmt );
		return $ok ? ( $insert_id ?: true ) : false;
	}

	/** Escape a value for safe HTML output. */
	function e( $value ) {
		return htmlspecialchars( (string) $value, ENT_QUOTES, 'UTF-8' );
	}

	/** Generate (or reuse) the per-session CSRF token. */
	function csrf_token() {
		if ( empty( $_SESSION['csrf_token'] ) ) {
			$_SESSION['csrf_token'] = bin2hex( random_bytes( 32 ) );
		}
		return $_SESSION['csrf_token'];
	}

	/** Hidden form field carrying the CSRF token. */
	function csrf_field() {
		return '<input type="hidden" name="csrf_token" value="' . e( csrf_token() ) . '">';
	}

	/** Halt with 403 unless the submitted CSRF token matches the session's. */
	function csrf_verify() {
		$token = $_POST['csrf_token'] ?? '';
		if ( !is_string( $token ) || $token === '' || !hash_equals( csrf_token(), $token ) ) {
			http_response_code( 403 );
			die( "Your form submission could not be verified (invalid or expired). Please go back and try again." );
		}
	}

	/** Currently logged-in user's id, or null if not logged in. */
	function current_user_id() {
		return isset( $_SESSION['user_id'] ) ? (int) $_SESSION['user_id'] : null;
	}

	function is_logged_in() {
		return current_user_id() !== null;
	}

	/** Redirect anonymous visitors to the login page. */
	function require_login() {
		if ( !is_logged_in() ) {
			header( "Location: ?p=login" );
			exit;
		}
	}

	/** Fetch the full row for the currently logged-in user, or null. */
	function current_user() {
		$user_id = current_user_id();
		if ( $user_id === null ) {
			return null;
		}
		$result = db_query( "SELECT * FROM users WHERE id = ? LIMIT 1", "i", $user_id );
		if ( !$result ) {
			return null;
		}
		$row = mysqli_fetch_assoc( $result );
		return $row ?: null;
	}

	function GetCompanyName() {
		global $link;
		$sql = "SELECT * FROM config";
  		$result = mysqli_query( $link, $sql );
  		$row = mysqli_fetch_assoc( $result );

  		return $row['pg_company'] ?? '';
	}

	function GetProductName() {
		global $link;
		$sql = "SELECT * FROM config";
  		$result = mysqli_query( $link, $sql );
  		$row = mysqli_fetch_assoc( $result );

  		return $row['pg_product'] ?? '';
	}

	function GetTitle() {
		global $link;
		$sql = "SELECT * FROM config";
  		$result = mysqli_query( $link, $sql );
  		$row = mysqli_fetch_assoc( $result );

  		return $row['pg_title'] ?? '';
	}

	function GetAbout() {
		global $link;
		$sql = "SELECT * FROM config";
  		$result = mysqli_query( $link, $sql );
  		$row = mysqli_fetch_assoc( $result );

  		return $row['pg_about'] ?? '';
	}

	function get_current_user_realname() {
		$user = current_user();
		return $user ? ( $user['user_realname'] ?? '' ) : '';
	}

	function get_current_username() {
		$user = current_user();
		return $user ? ( $user['user_loginname'] ?? '' ) : '';
	}

	function get_current_user_id() {
		return current_user_id();
	}

	function update_config( $pg_product, $pg_title, $pg_company, $pg_about ) {
		db_execute(
			"UPDATE config SET pg_product = ?, pg_title = ?, pg_company = ?, pg_about = ?",
			"ssss", $pg_product, $pg_title, $pg_company, $pg_about
		);
	}

	function error_msg( $type, $title, $msg, $dismissible ) {
		if ( isset( $msg ) ) {
			if ( $type == "success" ) {
				$type = "success";
			} elseif ( $type == "danger" ) {
				$type = "danger";
			} elseif ( $type == "info" ) {
				$type = "info";
			} elseif ( $type == "warning" ) {
				$type = "warning";
			} else {
				$type = "info";
			}

			if ( $dismissible == "1" ) {
				$final_msg = "<br/>";
				$final_msg .= "<div class=\"popup alert alert-".$type." alert-dismissible\" role=\"alert\">";
	  			$final_msg .= " 	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
	  			$final_msg .= "		<strong>".e( $title )."</strong> " . e( $msg );
				$final_msg .= "</div>";
			} else {
				$final_msg = "<br/><div class=\"panel panel-".$type."\">";
				$final_msg .= "	<div class=\"panel-heading\">";
				$final_msg .= "		<h3 class=\"panel-title\">".e( $msg )."</h3>";
				$final_msg .= "	</div>";
				$final_msg .= "</div>";
			}

			return $final_msg;
		}
	}

	/**
	 * truncate a string provided by the maximum limit without breaking a word
	 * @param string $str
	 * @param integer $maxlen
	 * @return string
	 */
	function shorten( $str, $maxlen ) {
	    if ( strlen( $str ) <= $maxlen ) return $str;

	    $newstr = substr( $str, 0, $maxlen );
	    if ( substr( $newstr, -1, 1 ) != ' ') $newstr = substr($newstr, 0, strrpos( $newstr, " " ) );

	    return $newstr . "...";
	}

	function count_total_available_question() {
		global $link;
		$sql = "SELECT DISTINCT id FROM questionaire";
		$result = mysqli_query( $link, $sql );
		printf( "%d", mysqli_num_rows( $result ) );
	}

	function count_available_question_by_exercise( $exer_id ) {
		$result = db_query( "SELECT * FROM questionaire WHERE exercise_id = ?", "i", $exer_id );
		return $result ? mysqli_num_rows( $result ) : 0;
	}

	function count_total_question_taken() {
		global $link;
		$sql = "SELECT DISTINCT id FROM users_answer";
		$result = mysqli_query( $link, $sql );
		printf( "%d", mysqli_num_rows( $result ) );
	}

	function count_registered_user() {
		global $link;
		$sql = "SELECT * FROM users";
      		$user_count = "";
		$result = mysqli_query( $link, $sql );
		while( $row = @mysqli_fetch_assoc( $result ) ) {
			$user_count++;
		}
		return $user_count;
	}

	function get_last_answer( $exer_id, $qid ) {
		$user_id = get_current_user_id();

		$result = db_query(
			"SELECT * FROM users_answer WHERE user_id = ? AND user_last_exercise_id = ? AND user_last_qid = ?",
			"iii", $user_id, $exer_id, $qid
		);
  		$row = $result ? mysqli_fetch_assoc( $result ) : false;
  		return $row['user_last_answer'] ?? '';
	}

	function check_last_answer_if_correct_return_point( $exer_id, $qid ) {
		$user_id = get_current_user_id();

		$result = db_query(
			"SELECT * FROM users_answer WHERE user_id = ? AND user_last_exercise_id = ? AND user_last_qid = ?",
			"iii", $user_id, $exer_id, $qid
		);
  		$row = $result ? mysqli_fetch_assoc( $result ) : false;
  		$answer_db = $row['correct'] ?? '';

  		if ( $answer_db == "yes" ) {
  			return get_quest_point( $exer_id, $qid);
  		} else {
  			return "0";
  		}
	}

	function check_last_answer_is_correct_or_not( $exer_id, $qid ) {
		$user_id = get_current_user_id();

		$result = db_query(
			"SELECT * FROM users_answer WHERE user_id = ? AND user_last_exercise_id = ? AND user_last_qid = ?",
			"iii", $user_id, $exer_id, $qid
		);
  		$row = $result ? mysqli_fetch_assoc( $result ) : false;
		return $row['correct'] ?? '';
	}

	function calculate_point() {
		/* TODO:
			Calculation is based on the following:
				- How many correct answer on per-exercise.
				- Sum up all correct answer based on pre-defined worth point.
				- Every question may have different point.

				Example:
					Correct answer on Exercise x 5

					Question 1 = 10 point
					Question 2 = 5  point
					Question 3 = 1  point
					Question 4 = 2  point
					Question 5 = 15 point

					Total Scored: 43 point
		*/
		global $link;
		$sql = "SELECT * FROM users_answer";
      	$user_count = 0;
      	$total = 0;
		$result = mysqli_query( $link, $sql );
		while( $row = @mysqli_fetch_assoc( $result ) ) {
			$total_correct = $row['correct'];
			if ( $total_correct == "yes" ) {
				$user_count++;
				$exer_id = $row['user_last_exercise_id'];
				$qid = $row['user_last_qid'];
				$total = $total + check_last_answer_if_correct_return_point( $exer_id, $qid );
			}
		}
		return $total;

	}

	function get_perplayer_total_point( $user_id ) {
		$total = 0;
		$result = db_query( "SELECT * FROM users_answer WHERE user_id = ?", "i", $user_id );
		if ( $result ) {
			while( $row = @mysqli_fetch_assoc( $result ) ) {
				$total_correct = $row['correct'];
				$exer_id = $row['user_last_exercise_id'];
				$qid = $row['user_last_qid'];
				if ( $total_correct == "yes" ) {
					$total = $total + check_peruser_last_answer_if_correct_return_point( $user_id, $exer_id, $qid );
				}
			}
		}
		return $total;
	}

	function save_user_point( $user_id ) {
		$user_point = get_perplayer_total_point( $user_id );
		db_execute( "UPDATE users SET user_point = ? WHERE id = ?", "ii", $user_point, $user_id );
	}

	function check_peruser_last_answer_if_correct_return_point( $user_id, $exer_id, $qid ) {
		$result = db_query(
			"SELECT * FROM users_answer WHERE user_id = ? AND user_last_exercise_id = ? AND user_last_qid = ?",
			"iii", $user_id, $exer_id, $qid
		);
  		$row = $result ? mysqli_fetch_assoc( $result ) : false;
  		$answer_db = $row['correct'] ?? '';

  		if ( $answer_db == "yes" ) {
  			return get_quest_point( $exer_id, $qid);
  		} else {
  			return "0";
  		}
	}

	function count_how_many_correct_answer( $user_id, $exer_id, $quest_id ) {
		global $link;
		$sql = "SELECT * FROM users_answer";
      		$user_count = "";
		$result = mysqli_query( $link, $sql );
		while( $row = @mysqli_fetch_assoc( $result ) ) {
			$user_count++;
		}
		return $user_count;
	}

	/*
		Get point number from specific question id.
		Every question may have different point.
	*/
	function get_quest_point( $exer_id, $quest_id ) {
		$result = db_query(
			"SELECT * FROM questionaire WHERE exercise_id = ? AND id = ?",
			"ii", $exer_id, $quest_id
		);
  		$row = $result ? mysqli_fetch_assoc( $result ) : false;
  		return $row['point'] ?? 0;
	}

	function remove_user_from_db( $user_id ) {
		db_execute( "DELETE FROM users WHERE id = ?", "i", $user_id );
	}

	function remove_user_from_answer( $user_id ) {
		db_execute( "DELETE FROM users_answer WHERE user_id = ?", "i", $user_id );
	}

	function admin_add_category( $cat_name, $cat_description ) {
		if ( !db_execute(
			"INSERT INTO category (category_name, category_description) VALUES (?, ?)",
			"ss", $cat_name, $cat_description
		) ) {
			echo error_msg("danger", "ERROR:", "Could not add the category. Please try again.", "1");
		} else {
			echo error_msg("success", "SUCCESS", "New category has been added.", "1");
		}
	}

	function admin_edit_category( $cat_id, $cat_name, $cat_description ) {
		if ( !db_execute(
			"UPDATE category SET category_name = ?, category_description = ? WHERE id = ?",
			"ssi", $cat_name, $cat_description, $cat_id
		) ) {
			echo error_msg("danger", "ERROR:", "Could not update the category. Please try again.", "1");
		} else {
			echo error_msg("success", "SUCCESS", "Category has been edited.", "1");
		}
	}

	function admin_del_category( $cat_id ) {
		if ( !db_execute( "DELETE FROM category WHERE id = ?", "i", $cat_id ) ) {
			echo error_msg("danger", "ERROR:", "Could not delete the category. Please try again.", "1");
		} else {
			echo error_msg("success", "SUCCESS", "Category has been deleted.", "1");
		}
	}

	function admin_add_exercise( $exer_name, $exer_desc, $exer_desc_long, $exer_cat_id, $exer_active ) {
		if ( !db_execute(
			"INSERT INTO exercise (exer_name, exer_description, exer_long, exer_cat_id, activated) VALUES (?, ?, ?, ?, ?)",
			"sssii", $exer_name, $exer_desc, $exer_desc_long, $exer_cat_id, $exer_active
		) ) {
			echo error_msg("danger", "ERROR:", "Could not add the exercise. Please try again.", "1");
		} else {
			echo error_msg("success", "SUCCESS", "New exercise has been added.", "1");
		}
	}

	function admin_del_exercise( $exer_id ) {
		if ( !db_execute( "DELETE FROM exercise WHERE id = ?", "i", $exer_id ) ) {
			echo error_msg("danger", "ERROR:", "Could not delete the exercise. Please try again.", "1");
		} else {
			echo error_msg("success", "SUCCESS", "Exercise has been deleted.", "1");
		}
	}

	function admin_add_question( $inqQuestion, $inqAnswer, $inqPoint, $inqExer ) {
		if ( !db_execute(
			"INSERT INTO questionaire (exercise_id, question, answer, point) VALUES (?, ?, ?, ?)",
			"issi", $inqExer, $inqQuestion, $inqAnswer, $inqPoint
		) ) {
			echo error_msg("danger", "ERROR:", "Could not add the question. Please try again.", "1");
		} else {
			echo error_msg("success", "SUCCESS", "New Question has been added.", "1");
		}
	}

	function admin_del_question( $quest_id ) {
		if ( !db_execute( "DELETE FROM questionaire WHERE id = ?", "i", $quest_id ) ) {
			echo error_msg("danger", "ERROR:", "Could not delete the question. Please try again.", "1");
		} else {
			echo error_msg("success", "SUCCESS", "Question has been deleted.", "1");
		}
	}

	function admin_add_user( $login, $realname, $password, $activated ) {
		$existing = db_query( "SELECT id FROM users WHERE user_loginname = ? LIMIT 1", "s", $login );
		if ( $existing && mysqli_num_rows( $existing ) > 0 ) {
			echo error_msg("danger", "ERROR:", "That username is already taken.", "1");
			return;
		}

		$hash = password_hash( $password, PASSWORD_DEFAULT );
		if ( !db_execute(
			"INSERT INTO users (user_loginname, user_realname, user_password, user_activated, user_ip, user_hostname, user_uid, user_point) VALUES (?, ?, ?, ?, '', '', ?, 0)",
			"sssis", $login, $realname, $hash, $activated, $login
		) ) {
			echo error_msg("danger", "ERROR:", "Could not add the user. Please try again.", "1");
		} else {
			echo error_msg("success", "SUCCESS", "New user has been added.", "1");
		}
	}

	function admin_del_user( $user_id ) {
		if ( !db_execute( "DELETE FROM users WHERE id = ?", "i", $user_id ) ) {
			echo error_msg("danger", "ERROR:", "Could not delete the user. Please try again.", "1");
		} else {
			echo error_msg("success", "SUCCESS", "User has been deleted.", "1");
		}
	}

?>
