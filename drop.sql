/* ---------------------------------------------------------------------- */
/* Script generated with: DeZign for Databases v6.2.1                     */
/* Target DBMS:           PostgreSQL 9                                    */
/* Project file:          report3.dez                                     */
/* Project name:                                                          */
/* Author:                                                                */
/* Script type:           Database drop script                            */
/* Created on:            2012-11-05 00:31                                */
/* ---------------------------------------------------------------------- */


/* ---------------------------------------------------------------------- */
/* Drop foreign key constraints                                           */
/* ---------------------------------------------------------------------- */

ALTER TABLE faculty DROP CONSTRAINT staff_faculty;

ALTER TABLE department DROP CONSTRAINT faculty_department;

ALTER TABLE department DROP CONSTRAINT staff_department;

ALTER TABLE staff DROP CONSTRAINT department_staff;

ALTER TABLE staff DROP CONSTRAINT academic_position_staff;

ALTER TABLE staff DROP CONSTRAINT administrative_position_staff;

ALTER TABLE staff DROP CONSTRAINT scientific_rank_staff;

ALTER TABLE vice_dean DROP CONSTRAINT staff_vice_dean;

ALTER TABLE vice_dean DROP CONSTRAINT faculty_vice_dean;

ALTER TABLE candidate DROP CONSTRAINT department_candidate;

ALTER TABLE candidate DROP CONSTRAINT speciality_candidate;

ALTER TABLE candidate DROP CONSTRAINT staff_candidate;

ALTER TABLE speciality DROP CONSTRAINT science_branch_speciality;

ALTER TABLE disser DROP CONSTRAINT candidate_disser;

ALTER TABLE disser DROP CONSTRAINT staff_disser;

ALTER TABLE advisor DROP CONSTRAINT staff_advisor;

ALTER TABLE advisor DROP CONSTRAINT disser_advisor;

ALTER TABLE disser_speciality DROP CONSTRAINT disser_disser_speciality;

ALTER TABLE disser_speciality DROP CONSTRAINT speciality_disser_speciality;

ALTER TABLE science_degree DROP CONSTRAINT staff_science_degree;

ALTER TABLE science_degree DROP CONSTRAINT science_branch_science_degree;

ALTER TABLE defence DROP CONSTRAINT disser_defence;

ALTER TABLE defence DROP CONSTRAINT thesis_board_defence;

ALTER TABLE thesis_board DROP CONSTRAINT staff_thesis_board_1;

ALTER TABLE thesis_board DROP CONSTRAINT staff_thesis_board_2;

ALTER TABLE thesis_board DROP CONSTRAINT staff_thesis_board_3;

ALTER TABLE member DROP CONSTRAINT staff_member;

ALTER TABLE member DROP CONSTRAINT thesis_board_member;

ALTER TABLE cite DROP CONSTRAINT staff_cite;

ALTER TABLE exam_result DROP CONSTRAINT exam_exam_result;

ALTER TABLE exam_result DROP CONSTRAINT candidate_exam_result;

ALTER TABLE thesis_board_speciality DROP CONSTRAINT thesis_board_thesis_board_speciality;

ALTER TABLE thesis_board_speciality DROP CONSTRAINT speciality_thesis_board_speciality;

ALTER TABLE member_defence DROP CONSTRAINT member_member_defence;

ALTER TABLE member_defence DROP CONSTRAINT defence_member_defence;

/* ---------------------------------------------------------------------- */
/* Drop table "member_defence"                                            */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

/* Drop table */

DROP TABLE member_defence;

/* ---------------------------------------------------------------------- */
/* Drop table "thesis_board_speciality"                                   */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE thesis_board_speciality DROP CONSTRAINT PK_thesis_board_speciality;

/* Drop table */

DROP TABLE thesis_board_speciality;

/* ---------------------------------------------------------------------- */
/* Drop table "exam_result"                                               */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE exam_result DROP CONSTRAINT PK_exam_result;

/* Drop table */

DROP TABLE exam_result;

/* ---------------------------------------------------------------------- */
/* Drop table "cite"                                                      */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE cite DROP CONSTRAINT PK_cite;

/* Drop table */

DROP TABLE cite;

/* ---------------------------------------------------------------------- */
/* Drop table "member"                                                    */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE member DROP CONSTRAINT PK_member;

ALTER TABLE member DROP CONSTRAINT TUC_member_1;

/* Drop table */

DROP TABLE member;

/* ---------------------------------------------------------------------- */
/* Drop table "thesis_board"                                              */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE thesis_board DROP CONSTRAINT PK_thesis_board;

/* Drop table */

DROP TABLE thesis_board;

/* ---------------------------------------------------------------------- */
/* Drop table "defence"                                                   */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE defence DROP CONSTRAINT PK_defence;

/* Drop table */

DROP TABLE defence;

/* ---------------------------------------------------------------------- */
/* Drop table "science_degree"                                            */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE science_degree DROP CONSTRAINT PK_science_degree;

/* Drop table */

DROP TABLE science_degree;

/* ---------------------------------------------------------------------- */
/* Drop table "disser_speciality"                                         */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE disser_speciality DROP CONSTRAINT PK_disser_speciality;

/* Drop table */

DROP TABLE disser_speciality;

/* ---------------------------------------------------------------------- */
/* Drop table "advisor"                                                   */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE advisor DROP CONSTRAINT PK_advisor;

/* Drop table */

DROP TABLE advisor;

/* ---------------------------------------------------------------------- */
/* Drop table "disser"                                                    */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE disser DROP CONSTRAINT PK_disser;

/* Drop table */

DROP TABLE disser;

/* ---------------------------------------------------------------------- */
/* Drop table "candidate"                                                 */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE candidate DROP CONSTRAINT PK_candidate;

/* Drop table */

DROP TABLE candidate;

/* ---------------------------------------------------------------------- */
/* Drop table "vice_dean"                                                 */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE vice_dean DROP CONSTRAINT PK_vice_dean;

/* Drop table */

DROP TABLE vice_dean;

/* ---------------------------------------------------------------------- */
/* Drop table "staff"                                                     */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE staff DROP CONSTRAINT PK_staff;

/* Drop table */

DROP TABLE staff;

/* ---------------------------------------------------------------------- */
/* Drop table "department"                                                */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE department DROP CONSTRAINT PK_department;

/* Drop table */

DROP TABLE department;

/* ---------------------------------------------------------------------- */
/* Drop table "faculty"                                                   */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE faculty DROP CONSTRAINT PK_faculty;

/* Drop table */

DROP TABLE faculty;

/* ---------------------------------------------------------------------- */
/* Drop table "speciality"                                                */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE speciality DROP CONSTRAINT PK_speciality;

/* Drop table */

DROP TABLE speciality;

/* ---------------------------------------------------------------------- */
/* Drop table "exam"                                                      */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE exam DROP CONSTRAINT PK_exam;

/* Drop table */

DROP TABLE exam;

/* ---------------------------------------------------------------------- */
/* Drop table "user"                                                      */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE user DROP CONSTRAINT PK_user;

ALTER TABLE user DROP CONSTRAINT TUC_user_1;

/* Drop table */

DROP TABLE user;

/* ---------------------------------------------------------------------- */
/* Drop table "scientific_rank"                                           */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE scientific_rank DROP CONSTRAINT PK_scientific_rank;

/* Drop table */

DROP TABLE scientific_rank;

/* ---------------------------------------------------------------------- */
/* Drop table "science_branch"                                            */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE science_branch DROP CONSTRAINT PK_science_branch;

/* Drop table */

DROP TABLE science_branch;

/* ---------------------------------------------------------------------- */
/* Drop table "administrative_position"                                   */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE administrative_position DROP CONSTRAINT PK_administrative_position;

/* Drop table */

DROP TABLE administrative_position;

/* ---------------------------------------------------------------------- */
/* Drop table "academic_position"                                         */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE academic_position DROP CONSTRAINT PK_academic_position;

/* Drop table */

DROP TABLE academic_position;

/* ---------------------------------------------------------------------- */
/* Drop domains                                                           */
/* ---------------------------------------------------------------------- */

DROP DOMAIN candidate_status;

DROP DOMAIN member_status;

/* ---------------------------------------------------------------------- */
/* Drop sequences                                                         */
/* ---------------------------------------------------------------------- */

DROP SEQUENCE institute_sequence;

DROP SEQUENCE faculty_sequence;

DROP SEQUENCE department_sequence;

DROP SEQUENCE staff_sequence;

DROP SEQUENCE science_sequence;

DROP SEQUENCE candidate_sequence;

DROP SEQUENCE user_sequence;

DROP SEQUENCE disser_sequence;

DROP SEQUENCE speciality_sequence;

DROP SEQUENCE academic_position_sequence;

DROP SEQUENCE administrative_position_sequence;

DROP SEQUENCE exam_result_sequence;

DROP SEQUENCE exam_sequence;

DROP SEQUENCE scientific_rank_sequence;

DROP SEQUENCE scientific_degree_sequence;

DROP SEQUENCE staff_thesis_board_sequence;

DROP SEQUENCE thesis_board_sequence;

DROP SEQUENCE defence_sequence;

DROP SEQUENCE member_sequence;
