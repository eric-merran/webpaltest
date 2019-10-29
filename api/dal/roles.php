<?php
require_once("dbInfo.php");

class Role {
	public $role_id;
	public $role_name;

	public function addRole() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `roles`
				(
					`role_name`
				)
				VALUES
				(
					:role_name
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":role_name" => $this->role_name));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->role_id = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateRole() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`roles`
				SET		`role_name` = :role_name
				WHERE	`role_id` = :role_id;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":role_id" => $this->role_id, ":role_name" => $this->role_name));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteRole($role_id) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `roles`
				WHERE	`role_id` = :role_id;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":role_id" => $role_id));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getRole($role_id) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`role_id`,
						`role_name`
				FROM	`roles`
				WHERE	`role_id` = :role_id;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":role_id" => $role_id));

		// Fetch record.
		$roles = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$roles = new Roles();
			$roles->role_id = $row["role_id"];
			$roles->role_name = $row["role_name"];
		}

		// Close the database connection.
		$conn = NULL;

		return $roles;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`role_id`";
		$sortColumns = Array("ROLE_ID", "ROLE_NAME");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`roles`;";

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

		$sql = "SELECT	`role_id`,
						`role_name`
				FROM	`roles`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$roles = new Roles();
			$roles->role_id = $row["role_id"];
			$roles->role_name = $row["role_name"];

			array_push($list, $roles);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>