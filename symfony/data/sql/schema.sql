CREATE TABLE backlog_task (id BIGINT AUTO_INCREMENT, project_id BIGINT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT, estimate BIGINT NOT NULL, priority VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX project_id_idx (project_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE iteration (id BIGINT AUTO_INCREMENT, project_id BIGINT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT, start_date DATE NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX project_id_idx (project_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE migration_version (id BIGINT AUTO_INCREMENT, version BIGINT, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE product (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), UNIQUE INDEX product_sluggable_idx (slug), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE project (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, product_id BIGINT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT, version VARCHAR(16) NOT NULL, website VARCHAR(255), status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), UNIQUE INDEX project_sluggable_idx (slug), INDEX user_id_idx (user_id), INDEX product_id_idx (product_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE project_member (id BIGINT AUTO_INCREMENT, project_id BIGINT NOT NULL, member_id BIGINT NOT NULL, INDEX member_id_idx (member_id), INDEX project_id_idx (project_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE project_relation (parent_id BIGINT, child_id BIGINT, PRIMARY KEY(parent_id, child_id)) ENGINE = INNODB;
CREATE TABLE story (id BIGINT AUTO_INCREMENT, iteration_id BIGINT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT, priority VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX iteration_id_idx (iteration_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE task (id BIGINT AUTO_INCREMENT, story_id BIGINT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT, original_estimate BIGINT NOT NULL, current_estimate BIGINT NOT NULL, status VARCHAR(255) NOT NULL, priority VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX story_id_idx (story_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE team (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, email VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE user_per_team (user_id BIGINT, team_id BIGINT, PRIMARY KEY(user_id, team_id)) ENGINE = INNODB;
CREATE TABLE user_profile (id BIGINT AUTO_INCREMENT, user_id BIGINT UNIQUE NOT NULL, picture_url VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE working_unit (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, task_id BIGINT NOT NULL, effort_spent BIGINT NOT NULL, date DATE NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), INDEX task_id_idx (task_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
ALTER TABLE backlog_task ADD CONSTRAINT backlog_task_project_id_project_id FOREIGN KEY (project_id) REFERENCES project(id) ON DELETE CASCADE;
ALTER TABLE iteration ADD CONSTRAINT iteration_project_id_project_id FOREIGN KEY (project_id) REFERENCES project(id) ON DELETE CASCADE;
ALTER TABLE project ADD CONSTRAINT project_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE project ADD CONSTRAINT project_product_id_product_id FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE;
ALTER TABLE project_member ADD CONSTRAINT project_member_project_id_project_id FOREIGN KEY (project_id) REFERENCES project(id);
ALTER TABLE project_member ADD CONSTRAINT project_member_member_id_sf_guard_user_id FOREIGN KEY (member_id) REFERENCES sf_guard_user(id);
ALTER TABLE project_relation ADD CONSTRAINT project_relation_parent_id_project_id FOREIGN KEY (parent_id) REFERENCES project(id) ON DELETE CASCADE;
ALTER TABLE project_relation ADD CONSTRAINT project_relation_child_id_project_id FOREIGN KEY (child_id) REFERENCES project(id);
ALTER TABLE story ADD CONSTRAINT story_iteration_id_iteration_id FOREIGN KEY (iteration_id) REFERENCES iteration(id) ON DELETE CASCADE;
ALTER TABLE task ADD CONSTRAINT task_story_id_story_id FOREIGN KEY (story_id) REFERENCES story(id) ON DELETE CASCADE;
ALTER TABLE user_per_team ADD CONSTRAINT user_per_team_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE user_per_team ADD CONSTRAINT user_per_team_team_id_team_id FOREIGN KEY (team_id) REFERENCES team(id) ON DELETE CASCADE;
ALTER TABLE user_profile ADD CONSTRAINT user_profile_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE working_unit ADD CONSTRAINT working_unit_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE working_unit ADD CONSTRAINT working_unit_task_id_task_id FOREIGN KEY (task_id) REFERENCES task(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
