USE mysql;

CREATE DATABASE file_manager;

USE file_manager;

CREATE TABLE user_info(
    username VARCHAR(100) NOT NULL UNIQUE KEY,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100) NOT NULL,
    user_email VARCHAR(100) NOT NULL UNIQUE KEY,
    user_mobile VARCHAR(100) NOT NULL UNIQUE KEY,
    user_dob date NOT NULL,
    user_image BLOB
);

-- CREATE TABLE sanket(
--     file_name VARCHAR(255) NOT NULL,
--     file_content BLOB NOT NULL,
--     upload_time datetime NOT NULL
-- );