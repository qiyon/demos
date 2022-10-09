-- datetime
SELECT DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s') AS dtstr;
SELECT NOW() AS now, UNIX_TIMESTAMP(NOW()) AS unixtime, FROM_UNIXTIME(UNIX_TIMESTAMP(NOW())) AS timestmp;
SELECT FROM_UNIXTIME(UNIX_TIMESTAMP(NOW()), '%Y%m%d%H%i%s') AS dtnumstr;
SELECT CONVERT_TZ(NOW(), @@session.time_zone, '+00:00') AS utcnow;
SELECT CAST('2000-01-01 00:00:00' AS DATETIME) = '2000-01-01' AS mixed, '2000-01-01 00:00:00' = '2000-01-01' AS str;

-- strings
SELECT SUBSTRING_INDEX(SUBSTRING_INDEX('{"field_1":"val","filed_2":0}', '"field_1":"', -1), '",', 1) AS split_get;
SELECT UPPER('abc') AS strupper, LOWER('XYZ') AS strlower;

-- if
SELECT IF(TRUE, 1, 0), IF(FALSE, 1, 0);
SELECT IFNULL(NULL, 'default_v'), IFNULL('select_v', 'default_v');

-- math
SELECT (5 MOD 2) AS 5_mod_2_get_1;

-- number format
SELECT CONCAT(CONVERT(3.1415926, DECIMAL(11, 3)), '') AS dot3f_round;
SELECT CONCAT(CONVERT(1.0, DECIMAL(11, 3)), '') AS dot3f_zero;
