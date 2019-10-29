<?php
require_once("dbInfo.php");

class User {
	public $user_id;
	public $last_name;
	public $first_name;
	public $role_id;

	public function addUser() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `users`
				(
					`last_name`,
					`first_name`,
					`role_id`
				)
				VALUES
				(
					:last_name,
					:first_name,
					:role_id
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":last_name" => $this->last_name,
			":first_name" => $this->first_name,
			":role_id" => $this->role_id));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->user_id = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateUser() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`users`
				SET		`last_name` = :last_name,
						`first_name` = :first_name,
						`role_id` = :role_id
				WHERE	`user_id` = :user_id;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$result = $stmt->execute(array(
			":user_id" => $this->user_id,
			":last_name" => $this->last_name,
			":first_name" => $this->first_name,
			":role_id" => $this->role_id));

		// Close the database connection.
		$conn = NULL;
		return $result;
	}

	public static function deleteUser($user_id) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `users`
				WHERE	`user_id` = :user_id;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$result=$stmt->execute(array(":user_id" => $user_id));

		// Close the database connection.
		$conn = NULL;
		return $result;
	}

	public static function getUser($user_id) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`user_id`,
						`last_name`,
						`first_name`,
						`role_id`
				FROM	`users`
				WHERE	`user_id` = :user_id;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":user_id" => $user_id));

		// Fetch record.
		$users = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$users = new User();
			$users->user_id = $row["user_id"];
			$users->last_name = $row["last_name"];
			$users->first_name = $row["first_name"];
			$users->role_id = $row["role_id"];
		}

		// Close the database connection.
		$conn = NULL;

		return $users;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`user_id`";
		$sortColumns = Array("USER_ID", "LAST_NAME", "FIRST_NAME", "ROLE_ID");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`users`;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Get total records count.
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$totalRecords = $row['Count'];
		$stmt = NULL;

		$totalPages = ceil($totalRecords / $pageSize);
		if ($pageNo > $totalPages) {
			$pageNo = $totalPages;
		}

		$start = $pageSize * $pageNo - $pageSize;
		if($start < 0) {
			$start = 0;
		}

		$sql = "SELECT	`user_id`,
						`last_name`,
						`first_name`,
						`role_id`
				FROM	`users`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$users = new User();
			$users->user_id = $row["user_id"];
			$users->last_name = $row["last_name"];
			$users->first_name = $row["first_name"];
			$users->role_id = $row["role_id"];

			array_push($list, $users);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}

	public static function getAllUsers() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`last_name`";
		$sortColumns = Array("USER_ID", "LAST_NAME", "FIRST_NAME", "ROLE_ID");
		$sortColumn = $defaultSortColumn;
		$sortOrder = "ASC";

		

		$sql = "SELECT	`user_id`,
						`last_name`,
						`first_name`,
						`role_id`
				FROM	`users`
				ORDER BY $sortColumn $sortOrder";
				

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$users = new User();
			$users->user_id = $row["user_id"];
			$users->last_name = $row["last_name"];
			$users->first_name = $row["first_name"];
			$users->role_id = $row["role_id"];

			array_push($list, $users);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>