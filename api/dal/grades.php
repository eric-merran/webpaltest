<?php
require_once("dbInfo.php");

class Grade {
	public $user_id;
    public $exam_id;
    public $grade;
    public $exam_name;

	public function addGrade() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `grades`
				(
					`user_id`,
					`exam_id`,
					`grade`
				)
				VALUES
				(
					:user_id,
					:exam_id,
					:grade
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$result = $stmt->execute(array(
			":user_id" => $this->user_id,
			":exam_id" => $this->exam_id,
			":grade" => $this->grade));

		
		// Close the database connection.
		$conn = NULL;
        return $result;    
    }

    public function updateGrade() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "UPDATE `grades`
				SET    `grade` = :grade
				WHERE  `user_id` = :user_id AND  `exam_id` = :exam_id;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$result = $stmt->execute(array(
			":user_id" => $this->user_id,
			":exam_id" => $this->exam_id,
			":grade" => $this->grade));

		
		// Close the database connection.
		$conn = NULL;
        return $result;    
    }


    public static function deleteGrade($user_id,$exam_id) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `grades`
				WHERE	`user_id` = :user_id AND `exam_id` = :exam_id;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
        $result =  $stmt->execute(array(":user_id" => $user_id,
                             ":exam_id" => $exam_id));

		// Close the database connection.
        $conn = NULL;
        return $result;
    }
    
    public static function getUserGrades($user_id) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`exam_name`";
		$sortColumn = $defaultSortColumn;
		$sortOrder = "ASC";

		

		$sql = "SELECT	`user_id`,
                         E.exam_id,
						`exam_name`,
						`grade`
				FROM	`grades` G JOIN  `exams` E ON G.exam_id = E.exam_id 

                WHERE `user_id` = :user_id 

				ORDER BY $sortColumn $sortOrder;";
				

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":user_id" => $user_id));

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$grades = new Grade();
            $grades->user_id = $row["user_id"];
            $grades->exam_id = $row["exam_id"];
			$grades->exam_name = $row["exam_name"];
			$grades->grade = $row["grade"];
			
			array_push($list, $grades);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}