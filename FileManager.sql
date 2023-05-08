USE mysql;

CREATE DATABASE file_manager;

USE file_manager;

CREATE TABLE user_info(
    username VARCHAR(100) NOT NULL UNIQUE KEY,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100) NOT NULL,
    user_email VARCHAR(100) NOT NULL UNIQUE KEY,
    user_mobile VARCHAR(12) NOT NULL UNIQUE KEY,
    user_dob date NOT NULL,
    user_image LONGBLOB
);

CREATE TABLE feedback(
    name VARCHAR(100) NOT NULL,
    feedback VARCHAR(255) NOT NULL,
    feedback_time DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- CREATE TABLE username(
--     file_id INTEGER PRIMARY KEY AUTO_INCREMENT,
--     file_name VARCHAR(255) NOT NULL,
--     file_extension VARCHAR(20),
--     file_size INTEGER,
--     file_content LONGBLOB,
--     upload_time datetime
-- );