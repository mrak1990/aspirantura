/* ---------------------------------------------------------------------- */
/* Script generated with: DeZign for Databases v6.2.1                     */
/* Target DBMS:           PostgreSQL 9                                    */
/* Project file:          report_2012.dez                                 */
/* Project name:                                                          */
/* Author:                                                                */
/* Script type:           Database creation script                        */
/* Created on:            2012-11-17 19:23                                */
/* ---------------------------------------------------------------------- */


/* ---------------------------------------------------------------------- */
/* Sequences                                                              */
/* ---------------------------------------------------------------------- */

CREATE SEQUENCE institute_sequence INCREMENT 1 START 1;

CREATE SEQUENCE faculty_sequence INCREMENT 1 START 1;

CREATE SEQUENCE department_sequence INCREMENT 1 START 1;

CREATE SEQUENCE staff_sequence INCREMENT 1 START 1;

CREATE SEQUENCE science_sequence INCREMENT 1 START 1;

CREATE SEQUENCE candidate_sequence INCREMENT 1 START 1;

CREATE SEQUENCE user_sequence INCREMENT 1 START 1;

CREATE SEQUENCE disser_sequence INCREMENT 1 START 1;

CREATE SEQUENCE speciality_sequence INCREMENT 1 START 1;

CREATE SEQUENCE academic_position_sequence INCREMENT 1 START 1;

CREATE SEQUENCE administrative_position_sequence INCREMENT 1 START 1;

CREATE SEQUENCE exam_result_sequence INCREMENT 1 START 1;

CREATE SEQUENCE exam_sequence INCREMENT 1 START 1;

CREATE SEQUENCE scientific_rank_sequence INCREMENT 1 START 1;

CREATE SEQUENCE scientific_degree_sequence INCREMENT 1 START 1;

CREATE SEQUENCE thesis_board_sequence INCREMENT 1 START 1;

CREATE SEQUENCE defence_sequence INCREMENT 1 START 1;

CREATE SEQUENCE member_sequence INCREMENT 1 START 1;

CREATE SEQUENCE thesis_board_speciality_sequence INCREMENT 1 START 1;

/* ---------------------------------------------------------------------- */
/* Tables                                                                 */
/* ---------------------------------------------------------------------- */

/* ---------------------------------------------------------------------- */
/* Add table "faculty"                                                    */
/* ---------------------------------------------------------------------- */

CREATE TABLE faculty (
    id INTEGER DEFAULT nextval('faculty_sequence')  NOT NULL,
    institute_id INTEGER DEFAULT 1  NOT NULL,
    title CHARACTER VARYING(100)  NOT NULL,
    short_title CHARACTER VARYING(20)  NOT NULL,
    staff_id INTEGER,
    secretariat CHARACTER VARYING(10),
    deleted BOOLEAN DEFAULT false  NOT NULL,
    CONSTRAINT PK_faculty PRIMARY KEY (id)
);

COMMENT ON TABLE faculty IS '����������';

COMMENT ON COLUMN faculty.id IS '��������� ����';

COMMENT ON COLUMN faculty.institute_id IS '��������';

COMMENT ON COLUMN faculty.title IS '�������� ����������';

COMMENT ON COLUMN faculty.short_title IS '����������� �������� ����������';

COMMENT ON COLUMN faculty.staff_id IS '����� ����������';

COMMENT ON COLUMN faculty.secretariat IS '������������ ������������';

COMMENT ON COLUMN faculty.deleted IS '����, ��� ������ � �������';

/* ---------------------------------------------------------------------- */
/* Add table "department"                                                 */
/* ---------------------------------------------------------------------- */

CREATE TABLE department (
    id INTEGER DEFAULT nextval('department_sequence')  NOT NULL,
    faculty_id INTEGER  NOT NULL,
    number INTEGER,
    title CHARACTER VARYING(100)  NOT NULL,
    staff_id INTEGER,
    deleted BOOLEAN DEFAULT false  NOT NULL,
    CONSTRAINT PK_department PRIMARY KEY (id)
);

COMMENT ON TABLE department IS '�������';

COMMENT ON COLUMN department.id IS '��������� ����';

COMMENT ON COLUMN department.faculty_id IS '���������';

COMMENT ON COLUMN department.number IS '����� �������';

COMMENT ON COLUMN department.title IS '�������� �������';

COMMENT ON COLUMN department.staff_id IS '���������� ��������';

COMMENT ON COLUMN department.deleted IS '����, ��� ������ � �������';

/* ---------------------------------------------------------------------- */
/* Add table "staff"                                                      */
/* ---------------------------------------------------------------------- */

CREATE TABLE staff (
    id INTEGER DEFAULT nextval('staff_sequence')  NOT NULL,
    department_id INTEGER  NOT NULL,
    fio CHARACTER VARYING(50)  NOT NULL,
    birth DATE,
    academic_position_id INTEGER,
    administrative_position_id INTEGER,
    deleted BOOLEAN DEFAULT false  NOT NULL,
    CONSTRAINT PK_staff PRIMARY KEY (id)
);

COMMENT ON TABLE staff IS '����������';

COMMENT ON COLUMN staff.id IS '��������� ����';

COMMENT ON COLUMN staff.department_id IS '�������';

COMMENT ON COLUMN staff.fio IS '��� ����������';

COMMENT ON COLUMN staff.birth IS '���� ��������';

COMMENT ON COLUMN staff.academic_position_id IS '������������� ���������';

COMMENT ON COLUMN staff.administrative_position_id IS '���������������� ���������';

COMMENT ON COLUMN staff.deleted IS '����, ��� ������ � �������';

/* ---------------------------------------------------------------------- */
/* Add table "vice_dean"                                                  */
/* ---------------------------------------------------------------------- */

CREATE TABLE vice_dean (
    id CHARACTER(40)  NOT NULL,
    faculty_id INTEGER  NOT NULL,
    staff_id INTEGER  NOT NULL,
    position CHARACTER VARYING(50)  NOT NULL,
    CONSTRAINT PK_vice_dean PRIMARY KEY (id)
);

COMMENT ON TABLE vice_dean IS '����������� ������';

COMMENT ON COLUMN vice_dean.id IS '��������� ����';

COMMENT ON COLUMN vice_dean.faculty_id IS '���������';

COMMENT ON COLUMN vice_dean.staff_id IS '���������';

COMMENT ON COLUMN vice_dean.position IS '���������';

/* ---------------------------------------------------------------------- */
/* Add table "candidate"                                                  */
/* ---------------------------------------------------------------------- */

CREATE TABLE candidate (
    id INTEGER DEFAULT nextval('candidate_sequence')  NOT NULL,
    department_id INTEGER  NOT NULL,
    fio CHARACTER VARYING(50)  NOT NULL,
    enter_date DATE  NOT NULL,
    done_date DATE,
    birth DATE,
    doctor BOOLEAN DEFAULT false  NOT NULL,
    speciality_id INTEGER  NOT NULL,
    staff_id INTEGER  NOT NULL,
    CONSTRAINT PK_candidate PRIMARY KEY (id)
);

COMMENT ON TABLE candidate IS '����������';

COMMENT ON COLUMN candidate.id IS '��������� ����';

COMMENT ON COLUMN candidate.department_id IS '�������';

COMMENT ON COLUMN candidate.fio IS '���';

COMMENT ON COLUMN candidate.enter_date IS '���� ����������';

COMMENT ON COLUMN candidate.done_date IS '���� ���������';

COMMENT ON COLUMN candidate.birth IS '���� ��������';

COMMENT ON COLUMN candidate.doctor IS '������';

COMMENT ON COLUMN candidate.speciality_id IS '�������������, �� ������� �������� ��������';

COMMENT ON COLUMN candidate.staff_id IS '������� ������������';

/* ---------------------------------------------------------------------- */
/* Add table "speciality"                                                 */
/* ---------------------------------------------------------------------- */

CREATE TABLE speciality (
    id INTEGER DEFAULT nextval('speciality_sequence')  NOT NULL,
    code CHARACTER VARYING(8)  NOT NULL,
    title CHARACTER VARYING(200),
    science_branch_id INTEGER  NOT NULL,
    CONSTRAINT PK_speciality PRIMARY KEY (id)
);

COMMENT ON TABLE speciality IS '�������������';

COMMENT ON COLUMN speciality.id IS '��������� ����';

COMMENT ON COLUMN speciality.code IS '��� �������������';

COMMENT ON COLUMN speciality.title IS '�������� �������������';

COMMENT ON COLUMN speciality.science_branch_id IS '������� �����';

/* ---------------------------------------------------------------------- */
/* Add table "disser"                                                     */
/* ---------------------------------------------------------------------- */

CREATE TABLE disser (
    id INTEGER DEFAULT nextval('disser_sequence')  NOT NULL,
    candidate_id INTEGER  NOT NULL,
    title CHARACTER VARYING(200)  NOT NULL,
    status INTEGER  NOT NULL,
    CONSTRAINT PK_disser PRIMARY KEY (id)
);

COMMENT ON TABLE disser IS '�����������';

COMMENT ON COLUMN disser.id IS '��������� ����';

COMMENT ON COLUMN disser.candidate_id IS '����������';

COMMENT ON COLUMN disser.title IS '���� �����������';

COMMENT ON COLUMN disser.status IS '������ ������';

/* ---------------------------------------------------------------------- */
/* Add table "advisor"                                                    */
/* ---------------------------------------------------------------------- */

CREATE TABLE advisor (
    id CHARACTER(40)  NOT NULL,
    staff_id INTEGER  NOT NULL,
    disser_id INTEGER  NOT NULL,
    consultant BOOLEAN DEFAULT FALSE  NOT NULL,
    CONSTRAINT PK_advisor PRIMARY KEY (id)
);

COMMENT ON TABLE advisor IS '������� ������������';

COMMENT ON COLUMN advisor.id IS '��������� ����';

COMMENT ON COLUMN advisor.staff_id IS '���������';

COMMENT ON COLUMN advisor.disser_id IS '�����������';

COMMENT ON COLUMN advisor.consultant IS '����������� ��� ������������';

/* ---------------------------------------------------------------------- */
/* Add table "disser_speciality"                                          */
/* ---------------------------------------------------------------------- */

CREATE TABLE disser_speciality (
    id INTEGER  NOT NULL,
    disser_id INTEGER  NOT NULL,
    speciality_id INTEGER  NOT NULL,
    PRIMARY KEY (id)
);

COMMENT ON TABLE disser_speciality IS '������������� �� ������������';

COMMENT ON COLUMN disser_speciality.id IS '��������� ����';

COMMENT ON COLUMN disser_speciality.disser_id IS '�����������';

COMMENT ON COLUMN disser_speciality.speciality_id IS '�������������';

/* ---------------------------------------------------------------------- */
/* Add table "academic_position"                                          */
/* ---------------------------------------------------------------------- */

CREATE TABLE academic_position (
    id INTEGER DEFAULT nextval('academic_position_sequence')  NOT NULL,
    title CHARACTER VARYING(25)  NOT NULL,
    full_title CHARACTER VARYING(50),
    CONSTRAINT PK_academic_position PRIMARY KEY (id)
);

COMMENT ON TABLE academic_position IS '������������� ���������';

COMMENT ON COLUMN academic_position.id IS '��������� ����';

COMMENT ON COLUMN academic_position.title IS '��������';

COMMENT ON COLUMN academic_position.full_title IS '����������� ��������';

/* ---------------------------------------------------------------------- */
/* Add table "administrative_position"                                    */
/* ---------------------------------------------------------------------- */

CREATE TABLE administrative_position (
    id INTEGER DEFAULT nextval('administrative_position_sequence')  NOT NULL,
    title CHARACTER VARYING(25)  NOT NULL,
    full_title CHARACTER VARYING(50),
    CONSTRAINT PK_administrative_position PRIMARY KEY (id)
);

COMMENT ON TABLE administrative_position IS '���������������� ���������';

COMMENT ON COLUMN administrative_position.id IS '��������� ����';

COMMENT ON COLUMN administrative_position.title IS '��������';

COMMENT ON COLUMN administrative_position.full_title IS '����������� ��������';

/* ---------------------------------------------------------------------- */
/* Add table "science_branch"                                             */
/* ---------------------------------------------------------------------- */

CREATE TABLE science_branch (
    id INTEGER DEFAULT nextval('scientific_degree_sequence')  NOT NULL,
    title CHARACTER VARYING(25)  NOT NULL,
    full_title CHARACTER VARYING(50),
    full_title_nom CHARACTER VARYING(50)  NOT NULL,
    CONSTRAINT PK_science_branch PRIMARY KEY (id)
);

COMMENT ON TABLE science_branch IS '������� �����';

COMMENT ON COLUMN science_branch.id IS '��������� ����';

COMMENT ON COLUMN science_branch.title IS '����������� �������� ������� ���� � ����������� ������';

COMMENT ON COLUMN science_branch.full_title IS '������ �������� ������� ���� � ����������� ������';

COMMENT ON COLUMN science_branch.full_title_nom IS '����������� �������� ������� ����';

/* ---------------------------------------------------------------------- */
/* Add table "science_degree"                                             */
/* ---------------------------------------------------------------------- */

CREATE TABLE science_degree (
    id INTEGER  NOT NULL,
    staff_id INTEGER  NOT NULL,
    science_branch_id INTEGER  NOT NULL,
    doctor BOOLEAN DEFAULT true  NOT NULL,
    CONSTRAINT PK_science_degree PRIMARY KEY (id)
);

COMMENT ON TABLE science_degree IS '������ �������';

COMMENT ON COLUMN science_degree.id IS '��������� ����';

COMMENT ON COLUMN science_degree.staff_id IS '���������';

COMMENT ON COLUMN science_degree.science_branch_id IS '������� �����';

COMMENT ON COLUMN science_degree.doctor IS '�������� ��� �������� ����';

/* ---------------------------------------------------------------------- */
/* Add table "defence"                                                    */
/* ---------------------------------------------------------------------- */

CREATE TABLE defence (
    id INTEGER DEFAULT nextval('defence_sequence')  NOT NULL,
    disser_id INTEGER  NOT NULL,
    thesis_board_id INTEGER  NOT NULL,
    date DATE,
    success BOOLEAN DEFAULT TRUE  NOT NULL,
    CONSTRAINT PK_defence PRIMARY KEY (id),
    CONSTRAINT TUC_defence_1 UNIQUE (disser_id, thesis_board_id, date)
);

COMMENT ON COLUMN defence.id IS '��������� ����';

COMMENT ON COLUMN defence.disser_id IS '�����������';

COMMENT ON COLUMN defence.thesis_board_id IS '��������������� �����';

COMMENT ON COLUMN defence.date IS '���� ������';

COMMENT ON COLUMN defence.success IS '���������� ������';

/* ---------------------------------------------------------------------- */
/* Add table "thesis_board"                                               */
/* ---------------------------------------------------------------------- */

CREATE TABLE thesis_board (
    id INTEGER DEFAULT nextval('thesis_board_sequence')  NOT NULL,
    code CHARACTER VARYING(20)  NOT NULL,
    staff_id INTEGER  NOT NULL,
    staff2_id INTEGER,
    staff3_id INTEGER,
    deleted BOOLEAN DEFAULT false  NOT NULL,
    CONSTRAINT PK_thesis_board PRIMARY KEY (id)
);

COMMENT ON TABLE thesis_board IS '��������������� ������';

COMMENT ON COLUMN thesis_board.id IS '��������� ����';

COMMENT ON COLUMN thesis_board.code IS '��� ���������������� ������';

COMMENT ON COLUMN thesis_board.staff_id IS '������������ ���������������� ������';

COMMENT ON COLUMN thesis_board.staff2_id IS '����������� ������������ ���������������� ������';

COMMENT ON COLUMN thesis_board.staff3_id IS '������ ��������� ���������������� ������';

COMMENT ON COLUMN thesis_board.deleted IS '����, ��� ������ � �������';

/* ---------------------------------------------------------------------- */
/* Add table "member"                                                     */
/* ---------------------------------------------------------------------- */

CREATE TABLE member (
    id INTEGER DEFAULT nextval('member_sequence')  NOT NULL,
    staff_id INTEGER  NOT NULL,
    thesis_board_id INTEGER  NOT NULL,
    CONSTRAINT PK_member PRIMARY KEY (id),
    CONSTRAINT TUC_member_1 UNIQUE (staff_id, thesis_board_id)
);

COMMENT ON TABLE member IS '������� ��������������� �������';

COMMENT ON COLUMN member.id IS '��������� ����';

COMMENT ON COLUMN member.staff_id IS '���������';

COMMENT ON COLUMN member.thesis_board_id IS '��������������� �����';

/* ---------------------------------------------------------------------- */
/* Add table "user"                                                       */
/* ---------------------------------------------------------------------- */

CREATE TABLE "user" (
    id INTEGER DEFAULT nextval('user_sequence')  NOT NULL,
    username CHARACTER VARYING(30)  NOT NULL,
    password_hash CHARACTER(60)  NOT NULL,
    first_name CHARACTER VARYING(30)  NOT NULL,
    middle_name CHARACTER VARYING(30),
    last_name CHARACTER VARYING(30)  NOT NULL,
    fio CHARACTER VARYING(36)  NOT NULL,
    email CHARACTER VARYING(30)  NOT NULL,
    CONSTRAINT PK_user PRIMARY KEY (id),
    CONSTRAINT TUC_user_1 UNIQUE (username)
);

COMMENT ON TABLE "user" IS '������������';

COMMENT ON COLUMN "user".id IS '��������� ����';

COMMENT ON COLUMN "user".username IS '��� ������������';

COMMENT ON COLUMN "user".password_hash IS '��� ������';

COMMENT ON COLUMN "user".first_name IS '���';

COMMENT ON COLUMN "user".middle_name IS '��������';

COMMENT ON COLUMN "user".last_name IS '�������';

COMMENT ON COLUMN "user".fio IS '���';

COMMENT ON COLUMN "user".email IS '����������� �����';

/* ---------------------------------------------------------------------- */
/* Add table "thesis_board_speciality"                                    */
/* ---------------------------------------------------------------------- */

CREATE TABLE thesis_board_speciality (
    id INTEGER DEFAULT nextval('thesis_board_speciality_sequence')  NOT NULL,
    thesis_board_id INTEGER  NOT NULL,
    speciality_id INTEGER  NOT NULL,
    doctor BOOLEAN DEFAULT false  NOT NULL,
    CONSTRAINT PK_thesis_board_speciality PRIMARY KEY (id),
    CONSTRAINT TUC_thesis_board_speciality_1 UNIQUE (thesis_board_id, speciality_id)
);

COMMENT ON TABLE thesis_board_speciality IS '������������� �� ��������������� �������';

COMMENT ON COLUMN thesis_board_speciality.id IS '��������� ����';

COMMENT ON COLUMN thesis_board_speciality.thesis_board_id IS '��������������� �����';

COMMENT ON COLUMN thesis_board_speciality.speciality_id IS '�������������';

COMMENT ON COLUMN thesis_board_speciality.doctor IS '���������������� ������ ������������� ����� ��������� � ������ ������ ����������� �� ��������� ������ ������� ��������� ����';

/* ---------------------------------------------------------------------- */
/* Add table "AuthItem"                                                   */
/* ---------------------------------------------------------------------- */

CREATE TABLE AuthItem (
    name CHARACTER VARYING(64)  NOT NULL,
    type INTEGER  NOT NULL,
    description TEXT,
    bizrule TEXT,
    data TEXT,
    PRIMARY KEY (name)
);

COMMENT ON TABLE AuthItem IS '�������� �����������';

COMMENT ON COLUMN AuthItem.name IS '�������� �������� �����������';

COMMENT ON COLUMN AuthItem.type IS '��� �������� �����������';

COMMENT ON COLUMN AuthItem.description IS '��������';

COMMENT ON COLUMN AuthItem.bizrule IS '������-�������';

COMMENT ON COLUMN AuthItem.data IS '��������� ������';

/* ---------------------------------------------------------------------- */
/* Add table "AuthItemChild"                                              */
/* ---------------------------------------------------------------------- */

CREATE TABLE AuthItemChild (
    parent CHARACTER VARYING(64)  NOT NULL,
    child CHARACTER VARYING(64)  NOT NULL,
    PRIMARY KEY (parent, child)
);

COMMENT ON TABLE AuthItemChild IS '������������ ��������� �����������';

COMMENT ON COLUMN AuthItemChild.parent IS '��������';

COMMENT ON COLUMN AuthItemChild.child IS '���������';

/* ---------------------------------------------------------------------- */
/* Add table "AuthAssignment"                                             */
/* ---------------------------------------------------------------------- */

CREATE TABLE AuthAssignment (
    itemname CHARACTER VARYING(64)  NOT NULL,
    userid CHARACTER VARYING(64)  NOT NULL,
    bizrule TEXT,
    data TEXT,
    PRIMARY KEY (itemname, userid)
);

COMMENT ON TABLE AuthAssignment IS '����� �������������';

COMMENT ON COLUMN AuthAssignment.itemname IS '������� �����������';

COMMENT ON COLUMN AuthAssignment.userid IS '������� ������';

COMMENT ON COLUMN AuthAssignment.bizrule IS '������-�������';

COMMENT ON COLUMN AuthAssignment.data IS '��������� ������';

/* ---------------------------------------------------------------------- */
/* Foreign key constraints                                                */
/* ---------------------------------------------------------------------- */

ALTER TABLE faculty ADD CONSTRAINT staff_faculty 
    FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE department ADD CONSTRAINT faculty_department 
    FOREIGN KEY (faculty_id) REFERENCES faculty (id) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE department ADD CONSTRAINT staff_department 
    FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE staff ADD CONSTRAINT department_staff 
    FOREIGN KEY (department_id) REFERENCES department (id) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE staff ADD CONSTRAINT academic_position_staff 
    FOREIGN KEY (academic_position_id) REFERENCES academic_position (id) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE staff ADD CONSTRAINT administrative_position_staff 
    FOREIGN KEY (administrative_position_id) REFERENCES administrative_position (id) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE vice_dean ADD CONSTRAINT staff_vice_dean 
    FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE vice_dean ADD CONSTRAINT faculty_vice_dean 
    FOREIGN KEY (faculty_id) REFERENCES faculty (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE candidate ADD CONSTRAINT department_candidate 
    FOREIGN KEY (department_id) REFERENCES department (id) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE candidate ADD CONSTRAINT speciality_candidate 
    FOREIGN KEY (speciality_id) REFERENCES speciality (id);

ALTER TABLE candidate ADD CONSTRAINT staff_candidate 
    FOREIGN KEY (staff_id) REFERENCES staff (id);

ALTER TABLE speciality ADD CONSTRAINT science_branch_speciality 
    FOREIGN KEY (science_branch_id) REFERENCES science_branch (id) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE disser ADD CONSTRAINT candidate_disser 
    FOREIGN KEY (candidate_id) REFERENCES candidate (id);

ALTER TABLE advisor ADD CONSTRAINT staff_advisor 
    FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE advisor ADD CONSTRAINT disser_advisor 
    FOREIGN KEY (disser_id) REFERENCES disser (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE disser_speciality ADD CONSTRAINT disser_disser_speciality 
    FOREIGN KEY (disser_id) REFERENCES disser (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE disser_speciality ADD CONSTRAINT speciality_disser_speciality 
    FOREIGN KEY (speciality_id) REFERENCES speciality (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE science_degree ADD CONSTRAINT staff_science_degree 
    FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE science_degree ADD CONSTRAINT science_branch_science_degree 
    FOREIGN KEY (science_branch_id) REFERENCES science_branch (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE defence ADD CONSTRAINT disser_defence 
    FOREIGN KEY (disser_id) REFERENCES disser (id) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE defence ADD CONSTRAINT thesis_board_defence 
    FOREIGN KEY (thesis_board_id) REFERENCES thesis_board (id) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE thesis_board ADD CONSTRAINT staff_thesis_board_1 
    FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE thesis_board ADD CONSTRAINT staff_thesis_board_2 
    FOREIGN KEY (staff2_id) REFERENCES staff (id) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE thesis_board ADD CONSTRAINT staff_thesis_board_3 
    FOREIGN KEY (staff3_id) REFERENCES staff (id) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE member ADD CONSTRAINT staff_member 
    FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE member ADD CONSTRAINT thesis_board_member 
    FOREIGN KEY (thesis_board_id) REFERENCES thesis_board (id) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE thesis_board_speciality ADD CONSTRAINT thesis_board_thesis_board_speciality 
    FOREIGN KEY (thesis_board_id) REFERENCES thesis_board (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE thesis_board_speciality ADD CONSTRAINT speciality_thesis_board_speciality 
    FOREIGN KEY (speciality_id) REFERENCES speciality (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE AuthItemChild ADD
    FOREIGN KEY (parent) REFERENCES AuthItem (name) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE AuthItemChild ADD
    FOREIGN KEY (child) REFERENCES AuthItem (name) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE AuthAssignment ADD
    FOREIGN KEY (itemname) REFERENCES AuthItem (name) ON DELETE CASCADE ON UPDATE CASCADE;
