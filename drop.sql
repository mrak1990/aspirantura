/* ---------------------------------------------------------------------- */
/* Script generated with: DeZign for Databases v6.2.1                     */
/* Target DBMS:           PostgreSQL 9                                    */
/* Project file:          Project2.dez                                    */
/* Project name:                                                          */
/* Author:                                                                */
/* Script type:           Database drop script                            */
/* Created on:            2012-06-01 22:26                                */
/* ---------------------------------------------------------------------- */


/* ---------------------------------------------------------------------- */
/* Drop table "userrr"                                                    */
/* ---------------------------------------------------------------------- */

/* Drop constraints */

ALTER TABLE userrr DROP CONSTRAINT PK_userrr;

/* Drop table */

DROP TABLE userrr;
