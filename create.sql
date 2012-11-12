/* ---------------------------------------------------------------------- */
/* Script generated with: DeZign for Databases v6.2.1                     */
/* Target DBMS:           PostgreSQL 9                                    */
/* Project file:          report3.dez                                     */
/* Project name:                                                          */
/* Author:                                                                */
/* Script type:           Database creation script                        */
/* Created on:            2012-11-12 23:57                                */
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
/* Domains                                                                */
/* ---------------------------------------------------------------------- */

CREATE DOMAIN candidate_status AS ENUM('study', 'done', 'left');

CREATE DOMAIN member_status AS ENUM('work', 'not_work');

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

COMMENT ON TABLE faculty IS 'Факультеты - название - секретариат - декан (FK)';

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

COMMENT ON TABLE department IS 'Кафедры - факультет (FK) - название - заведующий кафедрой (FK)';

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
    scientific_rank_id INTEGER,
    deleted BOOLEAN DEFAULT false  NOT NULL,
    CONSTRAINT PK_staff PRIMARY KEY (id)
);

COMMENT ON TABLE staff IS 'Сотрудники - кафедра (FK) - ФИО - дата рождения - доктор каких наук (FK)';

/* ---------------------------------------------------------------------- */
/* Add table "vice_dean"                                                  */
/* ---------------------------------------------------------------------- */

CREATE TABLE vice_dean (
    faculty_id INTEGER  NOT NULL,
    staff_id INTEGER  NOT NULL,
    position CHARACTER VARYING(50)  NOT NULL,
    CONSTRAINT PK_vice_dean PRIMARY KEY (faculty_id, staff_id)
);

COMMENT ON TABLE vice_dean IS 'Заместители декана - факультет (FK) - сотрудник (FK) - должность';

/* ---------------------------------------------------------------------- */
/* Add table "candidate"                                                  */
/* ---------------------------------------------------------------------- */

CREATE TABLE candidate (
    id INTEGER DEFAULT nextval('candidate_sequence')  NOT NULL,
    department_id INTEGER  NOT NULL,
    fio CHARACTER VARYING(50)  NOT NULL,
    birth DATE,
    is_postgrad BOOLEAN DEFAULT true  NOT NULL,
    whence CHARACTER VARYING(150),
    status candidate_status DEFAULT 'study'  NOT NULL,
    speciality_id INTEGER  NOT NULL,
    staff_id INTEGER  NOT NULL,
    enter DATE  NOT NULL,
    done DATE,
    CONSTRAINT PK_candidate PRIMARY KEY (id)
);

COMMENT ON TABLE candidate IS 'Аспиранты - кафедра (FK) - ФИО - дата рождения';

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

COMMENT ON TABLE speciality IS 'Специальности - код - название';

/* ---------------------------------------------------------------------- */
/* Add table "disser"                                                     */
/* ---------------------------------------------------------------------- */

CREATE TABLE disser (
    id INTEGER DEFAULT nextval('disser_sequence')  NOT NULL,
    candidate_id INTEGER  NOT NULL,
    title CHARACTER VARYING(200)  NOT NULL,
    status INTEGER  NOT NULL,
    staff_id INTEGER  NOT NULL,
    CONSTRAINT PK_disser PRIMARY KEY (id)
);

COMMENT ON TABLE disser IS 'Диссертации - аспирант (FK) - название';

/* ---------------------------------------------------------------------- */
/* Add table "advisor"                                                    */
/* ---------------------------------------------------------------------- */

CREATE TABLE advisor (
    staff_id INTEGER  NOT NULL,
    disser_id INTEGER  NOT NULL,
    consultant BOOLEAN DEFAULT FALSE  NOT NULL,
    CONSTRAINT PK_advisor PRIMARY KEY (staff_id, disser_id)
);

COMMENT ON TABLE advisor IS 'Научные руководители - сотрудник (FK) - аспирант (FK) - руководитель или консультант';

/* ---------------------------------------------------------------------- */
/* Add table "disser_speciality"                                          */
/* ---------------------------------------------------------------------- */

CREATE TABLE disser_speciality (
    id INTEGER  NOT NULL,
    disser_id INTEGER  NOT NULL,
    speciality_id INTEGER  NOT NULL
);

COMMENT ON TABLE disser_speciality IS 'Сопоставление диссертаций и специальностей - диссертация (FK) - специальность (FK)';

/* ---------------------------------------------------------------------- */
/* Add table "academic_position"                                          */
/* ---------------------------------------------------------------------- */

CREATE TABLE academic_position (
    id INTEGER DEFAULT nextval('academic_position_sequence')  NOT NULL,
    title CHARACTER VARYING(25)  NOT NULL,
    full_title CHARACTER VARYING(50),
    CONSTRAINT PK_academic_position PRIMARY KEY (id)
);

/* ---------------------------------------------------------------------- */
/* Add table "administrative_position"                                    */
/* ---------------------------------------------------------------------- */

CREATE TABLE administrative_position (
    id INTEGER DEFAULT nextval('administrative_position_sequence')  NOT NULL,
    title CHARACTER VARYING(25)  NOT NULL,
    full_title CHARACTER VARYING(50),
    CONSTRAINT PK_administrative_position PRIMARY KEY (id)
);

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

/* ---------------------------------------------------------------------- */
/* Add table "scientific_rank"                                            */
/* ---------------------------------------------------------------------- */

CREATE TABLE scientific_rank (
    id INTEGER DEFAULT nextval('scientific_rank_sequence')  NOT NULL,
    title CHARACTER VARYING(25)  NOT NULL,
    full_title CHARACTER VARYING(50),
    CONSTRAINT PK_scientific_rank PRIMARY KEY (id)
);

/* ---------------------------------------------------------------------- */
/* Add table "science_degree"                                             */
/* ---------------------------------------------------------------------- */

CREATE TABLE science_degree (
    staff_id INTEGER  NOT NULL,
    science_branch_id INTEGER  NOT NULL,
    doctor BOOLEAN DEFAULT true  NOT NULL,
    CONSTRAINT PK_science_degree PRIMARY KEY (staff_id, science_branch_id)
);

COMMENT ON COLUMN science_degree.doctor IS 'Сотрудник является доктором (не кандидатом) наук.';

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

/* ---------------------------------------------------------------------- */
/* Add table "thesis_board"                                               */
/* ---------------------------------------------------------------------- */

CREATE TABLE thesis_board (
    id INTEGER DEFAULT nextval('thesis_board_sequence')  NOT NULL,
    code CHARACTER VARYING(20)  NOT NULL,
    staff_id INTEGER  NOT NULL,
    staff2_id INTEGER,
    staff3_id INTEGER,
    CONSTRAINT PK_thesis_board PRIMARY KEY (id)
);

COMMENT ON COLUMN thesis_board.id IS 'первичный ключ';

COMMENT ON COLUMN thesis_board.code IS 'шифр диссертационного совета';

COMMENT ON COLUMN thesis_board.staff_id IS 'председатель диссертационного совета';

COMMENT ON COLUMN thesis_board.staff2_id IS 'заместитель председателя диссертационного совета';

COMMENT ON COLUMN thesis_board.staff3_id IS 'учёный секретарь диссертационного совета';

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

COMMENT ON TABLE member IS 'Состав диссертационного совета.';

/* ---------------------------------------------------------------------- */
/* Add table "cite"                                                       */
/* ---------------------------------------------------------------------- */

CREATE TABLE cite (
    staff_id INTEGER  NOT NULL,
    citation_scopus INTEGER,
    citatios_isi INTEGER  NOT NULL,
    hirsch INTEGER,
    CONSTRAINT PK_cite PRIMARY KEY (staff_id)
);

/* ---------------------------------------------------------------------- */
/* Add table "user"                                                       */
/* ---------------------------------------------------------------------- */

CREATE TABLE user (
    id INTEGER DEFAULT nextval('user_sequence')  NOT NULL,
    username CHARACTER VARYING(30)  NOT NULL,
    password_hash CHARACTER(60)  NOT NULL,
    first_name CHARACTER VARYING(30)  NOT NULL,
    middle_name CHARACTER VARYING(30),
    last_name CHARACTER VARYING(30)  NOT NULL,
    fio CHARACTER VARYING(36)  NOT NULL,
    email CHARACTER VARYING(30)  NOT NULL,
    deleted BOOLEAN DEFAULT false  NOT NULL,
    CONSTRAINT PK_user PRIMARY KEY (id),
    CONSTRAINT TUC_user_1 UNIQUE (username)
);

/* ---------------------------------------------------------------------- */
/* Add table "exam_result"                                                */
/* ---------------------------------------------------------------------- */

CREATE TABLE exam_result (
    id INTEGER DEFAULT nextval('exam_result_sequence')  NOT NULL,
    candidate_id INTEGER  NOT NULL,
    examine_id INTEGER  NOT NULL,
    date DATE,
    add_time TIMESTAMP DEFAULT 'now()'  NOT NULL,
    CONSTRAINT PK_exam_result PRIMARY KEY (id)
);

/* ---------------------------------------------------------------------- */
/* Add table "exam"                                                       */
/* ---------------------------------------------------------------------- */

CREATE TABLE exam (
    id INTEGER DEFAULT nextval('exam_sequence')  NOT NULL,
    title CHARACTER VARYING(50)  NOT NULL,
    is_entarance BOOLEAN DEFAULT true  NOT NULL,
    CONSTRAINT PK_exam PRIMARY KEY (id)
);

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

COMMENT ON TABLE thesis_board_speciality IS 'Диссертационный совет создается для рассмотрения диссертаций на соискание ученой степени кандидата наук, на соискание ученой степени доктора наук не более чем по трем специальностям научных работников.';

COMMENT ON COLUMN thesis_board_speciality.doctor IS 'Диссертационному совету предоставлено право принимать к защите только диссертации на соискание ученой степени кандидата наук.';

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

ALTER TABLE staff ADD CONSTRAINT scientific_rank_staff 
    FOREIGN KEY (scientific_rank_id) REFERENCES scientific_rank (id) ON DELETE SET NULL ON UPDATE CASCADE;

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

ALTER TABLE disser ADD CONSTRAINT staff_disser 
    FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE RESTRICT ON UPDATE CASCADE;

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

ALTER TABLE cite ADD CONSTRAINT staff_cite 
    FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE exam_result ADD CONSTRAINT exam_exam_result 
    FOREIGN KEY (examine_id) REFERENCES exam (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE exam_result ADD CONSTRAINT candidate_exam_result 
    FOREIGN KEY (candidate_id) REFERENCES candidate (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE thesis_board_speciality ADD CONSTRAINT thesis_board_thesis_board_speciality 
    FOREIGN KEY (thesis_board_id) REFERENCES thesis_board (id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE thesis_board_speciality ADD CONSTRAINT speciality_thesis_board_speciality 
    FOREIGN KEY (speciality_id) REFERENCES speciality (id) ON DELETE CASCADE ON UPDATE CASCADE;
