-- time
SHOW TIMEZONE;
SELECT EXTRACT(EPOCH FROM NOW())::BIGINT;
SELECT TO_TIMESTAMP('2023-01-01 08:00:00', 'YYYY-MM-DD HH24:MI:SS');
SELECT '2023-01-01 08:00:00'::TIMESTAMP WITH TIME ZONE;

-- IF NULL
SELECT COALESCE('select_v', 'default_v');
SELECT COALESCE(NULL, 'default_v');

-- unnest
SELECT semver,
       (SPLIT_PART(semver, '.', 1)::BIGINT) AS major,
       (SPLIT_PART(semver, '.', 2)::BIGINT) AS minor,
       (SPLIT_PART(semver, '.', 3)::BIGINT) AS patch
FROM (SELECT UNNEST(STRING_TO_ARRAY('4.2.1,4.2.3,4.20.2,5.12.2,1.2.32,1.0.0,0.0.1', ',')) AS semver) t0
ORDER BY major DESC, minor DESC, patch DESC;

-- Copy Table
CREATE TABLE new_table_name (LIKE exist_table_name INCLUDING INDEXES INCLUDING COMMENTS);
INSERT INTO new_table_name SELECT * FROM exist_table_name WHERE deleted_at IS NULL;

-- postgres views
-- databases
SELECT * FROM pg_database;
-- tables
SELECT * FROM pg_tables WHERE schemaname = CURRENT_SCHEMA();
-- table columns
SELECT * FROM information_schema.columns WHERE table_schema = CURRENT_SCHEMA() AND table_name = '{table_name}';
-- table columns description
SELECT columns.column_name, pg_description.description
FROM pg_catalog.pg_description
         LEFT JOIN information_schema.columns
                   ON columns.ordinal_position = pg_description.objsubid
                       AND columns.table_schema = CURRENT_SCHEMA() AND columns.table_name = '{table_name}'
WHERE objoid IN (
    SELECT oid FROM pg_catalog.pg_class
    WHERE relname = '{table_name}' AND relnamespace = (SELECT oid FROM pg_catalog.pg_namespace WHERE nspname = CURRENT_SCHEMA())
);
