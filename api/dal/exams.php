<?php
require_once("dbInfo.php");

class Exam {
	public $exam_id;
	public $exam_name;

	public function addExam() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `exams`
				(
					`exam_name`
				)
				VALUES
				(
					:exam_name
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":exam_name" => $this->exam_name));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->exam_id = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateExam() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`exams`
				SET		`exam_name` = :exam_name
				WHERE	`exam_id` = :exam_id;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$result=$stmt->execute(array( ":exam_name" => $this->exam_name, ":exam_id" => $this->exam_id));

		// Close the database connection.
		$conn = NULL;
		return $result;
	}

	public static function deleteExam($exam_id) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `exams`
				WHERE	`exam_id` = :exam_id;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$result= $stmt->execute(array(":exam_id" => $exam_id));

		// Close the database connection.
		$conn = NULL;
		return $result;
	}

	public static function getExam($exam_id) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`exam_id`,
						`exam_name`
				FROM	`exams`
				WHERE	`exam_id` = :exam_id;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":exam_id" => $exam_id));

		// Fetch record.
		$exams = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$exams = new Exam();
			$exams->exam_id = $row["exam_id"];
			$exams->exam_name = $row["exam_name"];
		}

		// Close the database connection.
		$conn = NULL;

		return $exams;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`exam_id`";
		$sortColumns = Array("EXAM_ID", "EXAM_NAME");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`exams`;";

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

		$sql = "SELECT	`exam_id`,
						`exam_name`
				FROM	`exams`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$exams = new Exam();
			$exams->exam_id = $row["exam_id"];
			$exams->exam_name = $row["exam_name"];

			array_push($list, $exams);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}

	public static function getAllExams() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`exam_name`";
		$sortColumn =  $defaultSortColumn;
		$sortOrder = "ASC";

		
		$sql = "SELECT	`exam_id`,
						`exam_name`
				FROM	`exams`
				ORDER BY $sortColumn $sortOrder";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$exams = new Exam();
			$exams->exam_id = $row["exam_id"];
			$exams->exam_name = $row["exam_name"];

			array_push($list, $exams);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}

	public static function getRemainingExams($user_id) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`exam_name`";
		$sortColumn =  $defaultSortColumn;
		$sortOrder = "ASC";

		
		$sql = "SELECT	`exam_id`,
						`exam_name`
				FROM	`exams`
				WHERE `exam_id` NOT IN (SELECT `exam_id` from `grades` WHERE	`user_id` = :user_id)
				ORDER BY $sortColumn $sortOrder";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":user_id" => $user_id));

		// Fetch all records.
		$list = Array();
		
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$exams = new Exam();
			$exams->exam_id = $row["exam_id"];
			$exams->exam_name = $row["exam_name"];

			array_push($list, $exams);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>