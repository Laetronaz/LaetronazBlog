-- TABLES --
DROP TABLE IF EXISTS tagpost;
DROP TABLE IF EXISTS tags;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS password_reset;
DROP TABLE IF EXISTS email_verification;
DROP TABLE IF EXISTS users_lockout;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS users_type;
DROP TABLE IF EXISTS users_state;
DROP TABLE IF EXISTS messages;

-- 	EVENTS --
DROP EVENT IF EXISTS reset_lockout;

DROP TRIGGER IF EXISTS user_lockout;