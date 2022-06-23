<?php
if (!extension_loaded('mysql') && !function_exists('mysql_connect')) {

	if (!extension_loaded('mysqli')) {
		trigger_error('The extension "MySQLi" is not available', E_USER_ERROR);
	}

	if (function_exists('getLinkIdentifier')) {
		trigger_error('The function name "getLinkIdentifier" is already defined, please change the function name', E_USER_ERROR);
	}

	define('MYSQL_CLIENT_COMPRESS', MYSQLI_CLIENT_COMPRESS);
	define('MYSQL_CLIENT_IGNORE_SPACE', MYSQLI_CLIENT_IGNORE_SPACE);
	define('MYSQL_CLIENT_INTERACTIVE', MYSQLI_CLIENT_INTERACTIVE);
	define('MYSQL_CLIENT_SSL', MYSQLI_CLIENT_SSL);

	define('MYSQL_ASSOC', MYSQLI_ASSOC);
	define('MYSQL_NUM', MYSQLI_NUM);
	define('MYSQL_BOTH', MYSQLI_BOTH);

	$__MYSQLI_WRAPPER_LINK = null;

	function getLinkIdentifier(mysqli $mysqli = null){
		if (!$mysqli) {
			global $__MYSQLI_WRAPPER_LINK;
			$mysqli = $__MYSQLI_WRAPPER_LINK;
		}

		return $mysqli;
	}

	function mysql_connect($server, $username, $password, $new_link = false, $client_flags = 0){
		global $__MYSQLI_WRAPPER_LINK;

		$__MYSQLI_WRAPPER_LINK = mysqli_connect($server, $username, $password);
		return $__MYSQLI_WRAPPER_LINK;
	}

	function mysql_pconnect($server, $username, $password, $client_flags = 0){
		return mysql_connect('p:' . $server, $username, $password, false, $client_flags);
	}

	function mysql_select_db($databaseName, mysqli $mysqli = null){
		return getLinkIdentifier($mysqli)->select_db($databaseName);
	}

	function mysql_query($query, mysqli $mysqli = null){
		return getLinkIdentifier($mysqli)->query($query);
	}

	function mysql_real_escape_string($string, mysqli $mysqli = null){
		return getLinkIdentifier($mysqli)->escape_string($string);
	}

	function mysql_escape_string($string){
		return mysql_real_escape_string($string);
	}
	function mysql_fetch_assoc(mysqli_result $result){
		$result = $result->fetch_assoc();
		if ($result === NULL) {
			$result = false;
		}

		return $result;
	}

	function mysql_fetch_object(mysqli_result $result){
		$result = $result->fetch_object();
		if ($result === NULL) {
			$result = false;
		}

		return $result;
	}

	function mysql_num_rows(mysqli_result $result){
		$result = $result->num_rows;
		if ($result === NULL) {
			$result = false;
		}

		return $result;
	}

	function mysql_fetch_row(mysqli_result $result){
		$result = $result->fetch_row();
		if ($result === NULL) {
			$result = false;
		}

		return $result;
	}

	function mysql_affected_rows(mysqli $mysqli = null){
		return mysqli_affected_rows(getLinkIdentifier($mysqli));
	}

	function mysql_client_encoding(mysqli $mysqli = null){
		return mysqli_character_set_name(getLinkIdentifier($mysqli));
	}

	function mysql_close(mysqli $mysqli = null){
		return mysqli_close(getLinkIdentifier($mysqli));
	}

	function mysql_create_db($database_name, mysqli $mysqli = null){
		trigger_error('This function was deprecated in PHP 4.3.0 and is therefor not supported', E_USER_DEPRECATED);
		return false;
	}

	function mysql_errno(mysqli $mysqli = null){
		return mysqli_errno(getLinkIdentifier($mysqli));
	}

	function mysql_db_name(mysqli_result $result, $row, $field=null){
	    mysqli_data_seek($result,$row);
	    $f = mysqli_fetch_row($result);

	    return $f[0];
	}

	function mysql_error(mysqli $mysqli = null){
		return mysqli_error(getLinkIdentifier($mysqli));
	}

	function mysql_fetch_array(mysqli_result $result, $result_type = MYSQL_BOTH){
		return mysqli_fetch_array($result, $result_type);
	}

	function mysql_ping(mysqli $mysqli = null){
		return mysqli_ping(getLinkIdentifier($mysqli));
	}

	function mysql_unbuffered_query($query, mysqli $mysqli = null){
		return mysqli_query(getLinkIdentifier($mysqli), $query, MYSQLI_USE_RESULT);
	}

	function mysql_get_client_info(){
		global $__MYSQLI_WRAPPER_LINK;		
		return mysqli_get_client_info($__MYSQLI_WRAPPER_LINK);		
	}

	function mysql_free_result(mysqli_result $result){
		mysqli_free_result($result);
		return TRUE;
	}

	function mysql_list_dbs(mysqli $mysqli = null){
		trigger_error('This function is deprecated. It is preferable to use mysql_query() to issue an SQL Query: SHOW DATABASES statement instead.', E_USER_DEPRECATED);

		return mysqli_query(getLinkIdentifier($mysqli), 'SHOW DATABASES');
	}

	function mysql_list_fields($database_name, $table_name, mysqli $mysqli = null){
		trigger_error('This function is deprecated. It is preferable to use mysql_query() to issue an SQL SHOW COLUMNS FROM table [LIKE \'name\'] statement instead.', E_USER_DEPRECATED);

		$mysqli = getLinkIdentifier($mysqli);
		$db = mysqli_escape_string($mysqli, $database_name);
		$table = mysqli_escape_string($mysqli, $table_name);

		return mysqli_query($mysqli, sprintf('SHOW COLUMNS FROM %s.%s', $db, $table));
	}

	function mysql_list_processes(mysqli $mysqli = null){
		return mysqli_query(getLinkIdentifier($mysqli), 'SHOW PROCESSLIST');
	}

	function mysql_set_charset($charset, mysqli $mysqli = null){
		return mysqli_set_charset(getLinkIdentifier($mysqli), $charset);
	}

	function mysql_info(mysqli $mysqli = null){
		$result = mysqli_info(getLinkIdentifier($mysqli));
		if ($result === NULL) {
			$result = false;
		}

		return $result;
	}

	function mysql_stat(mysqli $mysqli = null){
		return mysqli_stat(getLinkIdentifier($mysqli));
	}

	function mysql_thread_id(mysqli $mysqli = null){
		return mysqli_thread_id(getLinkIdentifier($mysqli));
	}

	
	function mysql_get_host_info(mysqli $mysqli = null){
		return mysqli_get_host_info(getLinkIdentifier($mysqli));
	}

	
	function mysql_get_proto_info(mysqli $mysqli = null){
		return mysqli_get_proto_info(getLinkIdentifier($mysqli));
	}

	
	function mysql_get_server_info(mysqli $mysqli = null){
		return mysqli_get_server_info(getLinkIdentifier($mysqli));
	}

	
	function mysql_tablename(mysqli_result $result, $row){
	    mysqli_data_seek($result, $row);
	    $f = mysqli_fetch_array($result);

	    return $f[0];
	}

	function mysql_insert_id(mysqli $mysqli = null){
		return mysqli_insert_id(getLinkIdentifier($mysqli));
	}

	function mysql_result($result, $row, $field = 0){
		$result->data_seek($row);
		$row = $result->fetch_array();
		if (!isset($row[$field])) {
			return false;
		}

		return $row[$field];
	}

	function mysql_num_fields(mysqli_result $result){
		return mysqli_num_fields($result);
	}

	function mysql_list_tables($database_name, mysqli $mysqli = null){
		trigger_error('This function is deprecated. It is preferable to use mysql_query() to issue an SQL SHOW TABLES [FROM db_name] [LIKE \'pattern\'] statement instead.', E_USER_DEPRECATED);

		$mysqli = getLinkIdentifier($mysqli);
		$db = mysqli_escape_string($mysqli, $database_name);

		return mysqli_query($mysqli, sprintf('SHOW TABLES FROM %s', $db));
	}

	function mysql_fetch_field(mysqli_result $result, $field_offset = 0){
		if ($field_offset) {
			mysqli_field_seek($result, $field_offset);
		}

		return mysqli_fetch_field($result);
	}

	function mysql_field_len(mysqli_result $result, $field_offset = 0){
	    $fieldInfo = mysqli_fetch_field_direct($result, $field_offset);
	    return $fieldInfo->length;
	}

	function mysql_drop_db(){
		trigger_error('This function is deprecated since PHP 4.3.0 and therefore not implemented', E_USER_DEPRECATED);
		return false;
	}

	function mysql_data_seek(mysqli_result $result, $row_number = 0){
		return mysqli_data_seek($result, $row_number);
	}

	function mysql_field_name($result, $field_offset = 0){
		$props = mysqli_fetch_field_direct($result, $field_offset);
		return is_object($props) ? $props->name : false;
	}

	
	function mysql_fetch_lengths(mysqli_result $result){
		return mysqli_fetch_lengths($result);
	}

	function mysql_field_type(mysqli_result $result, $field_offset = 0){
		$unknown = 'unknown';
		$info = mysqli_fetch_field_direct($result, $field_offset);
		if (empty($info->type)) {
			return $unknown;
		}

		switch ($info->type) {
			case MYSQLI_TYPE_FLOAT:
			case MYSQLI_TYPE_DOUBLE:
			case MYSQLI_TYPE_DECIMAL:
			case MYSQLI_TYPE_NEWDECIMAL:
				return 'real';

			case MYSQLI_TYPE_BIT:
				return 'bit';

			case MYSQLI_TYPE_TINY:
				return 'tinyint';

			case MYSQLI_TYPE_TIME:
				return 'time';

			case MYSQLI_TYPE_DATE:
				return 'date';

			case MYSQLI_TYPE_DATETIME:
				return 'datetime';

			case MYSQLI_TYPE_TIMESTAMP:
				return 'timestamp';

			case MYSQLI_TYPE_YEAR:
				return 'year';

			case MYSQLI_TYPE_STRING:
			case MYSQLI_TYPE_VAR_STRING:
				return 'string';

			case MYSQLI_TYPE_SHORT:
			case MYSQLI_TYPE_LONG:
			case MYSQLI_TYPE_LONGLONG:
			case MYSQLI_TYPE_INT24:
				return 'int';

			case MYSQLI_TYPE_CHAR:
				return 'char';

			case MYSQLI_TYPE_ENUM:
				return 'enum';

			case MYSQLI_TYPE_TINY_BLOB:
			case MYSQLI_TYPE_MEDIUM_BLOB:
			case MYSQLI_TYPE_LONG_BLOB:
			case MYSQLI_TYPE_BLOB:
				return 'blob';

			case MYSQLI_TYPE_NULL:
				return 'null';

			case MYSQLI_TYPE_NEWDATE:
			case MYSQLI_TYPE_INTERVAL:
			case MYSQLI_TYPE_SET:
			case MYSQLI_TYPE_GEOMETRY:
			default:
				return $unknown;
		}
	}

	
	function mysql_field_table(mysqli_result $result, $field_offset = 0){
		$info = mysqli_fetch_field_direct($result, $field_offset);
		if (empty($info->table)) {
			return false;
		}

		return $info->table;
	}

	
	function mysql_field_flags(mysqli_result $result , $field_offset = 0){
	    $flags_num = mysqli_fetch_field_direct($result,$field_offset)->flags;

	    if (!isset($flags))
	    {
	        $flags = array();
	        $constants = get_defined_constants(true);
	        foreach ($constants['mysqli'] as $c => $n) if (preg_match('/MYSQLI_(.*)_FLAG$/', $c, $m)) if (!array_key_exists($n, $flags)) $flags[$n] = $m[1];
	    }

	    $result = array();
	    foreach ($flags as $n => $t) if ($flags_num & $n) $result[] = $t;

	    $return = implode(' ', $result);
	    $return = str_replace('PRI_KEY','PRIMARY_KEY',$return);
	    $return = strtolower($return);

	    return $return;
	}

	function mysql_field_seek(mysqli_result $result, $field_offset = 0){
		return mysqli_field_seek($result, $field_offset);
	}

	function mysql_db_query($database, $query, mysqli $mysqli = null){
		if(mysql_select_db($database, $mysqli))
		{
			return mysql_query($query, $mysqli);
		}

		return false;
	}
}