-- create tables
CREATE TABLE users (
  id CHAR(36) NOT NULL PRIMARY KEY DEFAULT UUID(),
  username VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE lists (
  id CHAR(36) NOT NULL PRIMARY KEY DEFAULT UUID(),
  name VARCHAR(255) NOT NULL,
  user_id CHAR(36) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE tasks (
  id CHAR(36) NOT NULL PRIMARY KEY DEFAULT UUID(),
  name VARCHAR(255) NOT NULL,
  note VARCHAR(255),
  done BOOLEAN NOT NULL DEFAULT 0,
  scheduled DATE,
  deadline DATE,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  user_id CHAR(36) NOT NULL,
  list_id CHAR(36),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (list_id) REFERENCES lists(id)
);

-- insert dummy data
INSERT INTO users (id, username, password) VALUES
('f4ce1e4f-7fcf-42f8-ba14-f3db56f05ec4', 'test1', 'password'),
('dd5ea6b4-ea3d-4aeb-b29d-9960176c113b', 'test2', 'password');

INSERT INTO lists (id, name, user_id) VALUES
('85129bfc-6ad3-49c4-804e-413baf4bb0ff', 'Home', 'f4ce1e4f-7fcf-42f8-ba14-f3db56f05ec4');

INSERT INTO tasks (name, note, done, scheduled, deadline, user_id, list_id) VALUES
('buy milk', NULL, 0, NULL, NULL, 'f4ce1e4f-7fcf-42f8-ba14-f3db56f05ec4', '85129bfc-6ad3-49c4-804e-413baf4bb0ff'),
('call mom', 'because you love her', 1, NULL, NULL, 'f4ce1e4f-7fcf-42f8-ba14-f3db56f05ec4', NULL),
('buy christmas gifts', NULL, 0, '2024-12-02', '2024-12-12', 'f4ce1e4f-7fcf-42f8-ba14-f3db56f05ec4', '85129bfc-6ad3-49c4-804e-413baf4bb0ff');