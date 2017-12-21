<?php
class Model {
	public static $fillable = [];
	public $properties = [];
	protected static $table;

	public function __construct($args) {
		foreach (static::$fillable as $prop) {
			// If the args came with the fillable property
			// Then fill it
			if (array_key_exists($prop, $args)) {
				$this->properties[$prop] = $args[$prop];
			}
		}
		$this->init();
	}

	protected function init() {
		// this is hook for child class initialization
	}

	public static function all() {
		return static::find_by();
	}

	// Find by id
	public static function find($id) {
		return static::find_by(['id' => $id]);
	}

	// Find by any k => v pair
	public static function find_by($args = null) {
		$results = [];
		$db = Db::getInstance();
		$className = get_called_class();
		$query = 'SELECT * FROM ' . static::$table;

		if (is_array($args)) {
			$count = 0;
			foreach ($args as $k => $v) {
				// Only if the key is in the fillable array
				// Otherwise it's not a column in the table
				
				if (in_array($k, static::$fillable)) {
					$count++;

					$val = mysqli_real_escape_string($db, trim($v));
					$val = is_numeric($val) ? $val : "'$val'";
					if ($count > 1) {
						$query .= ' AND ' . $k . '= ' . $val;
					} else {
						$query .= ' WHERE ' . $k . '= ' . $val;
					}
				}
			}
		}
		$result = @mysqli_query($db, $query);

		if ($result) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$object = [];
				foreach (static::$fillable as $prop) {
					$object[$prop] = $row[$prop];
				}
				$results[] = new $className($object);
			}

			mysqli_free_result($result);
		} else {
			echo '<p class="error">The model could not be retrieved. ' .
				 'We apologize for any inconvenience.</p>';

			echo '<p>' . mysqli_error($db) . '<br /><br />Query: ' . $query . '</p>';
		}

		if (count($args) == 1 && array_key_exists('id', $args) && count($results) > 0)
			return $results[0];
		else
			return $results;
	}

	public function save() {
		if ($this->id) {
			$this->update();
		} else {
			$this->insert();
		}
	}

	// insert into {table_name} (f1, f2, f3, f4) values (v1, v2, v3, v4)
	protected function insert() {
		// Guard clause
		if (count($this->properties) <= 0)
			return;

		$db = Db::getInstance();

		// Build query
		$query = 'INSERT INTO ' . static::$table;
		$query .= ' (' . implode(', ', array_keys($this->properties)) . ')';

		$props = [];

		foreach ($this->properties as $prop) {
			if (is_numeric($prop)) {
				$props[] = mysqli_real_escape_string($db, trim($prop));
			} else {
				$props[] = "'" . mysqli_real_escape_string($db, trim($prop)) . "'";
			}
		}
		$query .= ' VALUES (' . implode(', ', array_values($props)) . ')';

		$result = mysqli_query($db, $query);

		if ($result) {
			$this->properties['id'] = mysqli_insert_id($db);
		} else {
			echo '<h1>System Error</h1>' .
			'<p class="error">Error inserting entry.</p>';
			echo '<p>' . mysqli_error($db) . '<br /><br />Query: ' . $query . '</p>';
		}
	}

	public function destroy() {
		if (!$this->id)
			return null;
		
		$this->cascade();
		$db = Db::getInstance();

		// Build query
		$query = 'DELETE FROM ' . static::$table . ' WHERE id=' . $this->id;

		$result = @mysqli_query($db, $query);

		return $result;
	}

	// delete fk associations
	// handled at inheritance level
	protected function cascade() {
		// implement in child class
	}

	//TODO: implement an update if needed/have time
	protected function update() {
		echo '<pre>';
		print_r('update');
		echo '</pre>';
	}

	public function __get($strName) {
		if (array_key_exists($strName, $this->properties)) {
			return $this->properties[$strName];
		}
	}

	public function __set($strName, $value) {
		if (array_key_exists($strName, $this->properties)) {
			return ($this->properties[$strName] = $value);
		}
	}
}