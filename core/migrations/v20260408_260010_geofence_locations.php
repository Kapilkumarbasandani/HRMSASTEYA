<?php
namespace Classes\Migration;

class v20260408_260010_geofence_locations extends AbstractMigration
{
    public function up()
    {
        $sql = <<<'SQL'
CREATE TABLE IF NOT EXISTS `GeofenceLocations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `latitude` decimal(12,8) NOT NULL,
  `longitude` decimal(12,8) NOT NULL,
  `radius` int(11) NOT NULL DEFAULT 200,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SQL;
        $this->executeQuery($sql);

        $sql = <<<'SQL'
INSERT IGNORE INTO Settings (name, value, description, meta, `category`)
VALUES
('Attendance: Geofencing Enabled', '0', 'Enable geofencing for attendance. Employees must be within the defined radius to punch in/out.', '["value", {"label":"Value","type":"select","source":[["1","Yes"],["0","No"]]}]', 'Attendance'),
('Attendance: Geofence Radius (meters)', '200', 'Default geofence radius in meters if not set per location', '', 'Attendance');
SQL;
        return $this->executeQuery($sql);
    }

    public function down()
    {
        $sql = <<<'SQL'
DROP TABLE IF EXISTS `GeofenceLocations`;
SQL;
        $this->executeQuery($sql);

        $sql = <<<'SQL'
DELETE FROM Settings WHERE name IN ('Attendance: Geofencing Enabled', 'Attendance: Geofence Radius (meters)');
SQL;
        return $this->executeQuery($sql);
    }
}
