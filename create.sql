/* ---------------------------------------------------------------------- */
/* Script generated with: DeZign for Databases v6.2.1                     */
/* Target DBMS:           PostgreSQL 9                                    */
/* Project file:          Project2.dez                                    */
/* Project name:                                                          */
/* Author:                                                                */
/* Script type:           Database creation script                        */
/* Created on:            2012-06-01 22:26                                */
/* ---------------------------------------------------------------------- */


/* ---------------------------------------------------------------------- */
/* Tables                                                                 */
/* ---------------------------------------------------------------------- */

/* ---------------------------------------------------------------------- */
/* Add table "userrr"                                                     */
/* ---------------------------------------------------------------------- */

CREATE TABLE userrr (
    name CHARACTER VARYING(20)  NOT NULL,
    pass CHARACTER VARYING(20)  NOT NULL,
    first_name CHARACTER VARYING(20)  NOT NULL,
    last_name CHARACTER VARYING(20)  NOT NULL,
    middle_name CHARACTER VARYING(20),
    full_name CHARACTER VARYING(60)  NOT NULL,
    CONSTRAINT PK_userrr PRIMARY KEY (name)
);
