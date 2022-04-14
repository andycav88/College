/*
 * ER/Studio Data Architect SQL Code Generation
 * Project :      Model1.DM1
 *
 * Date Created : Wednesday, April 13, 2022 16:50:18
 * Target DBMS : Microsoft SQL Server 2017
 */

/* 
 * TABLE: administrator 
 */
 use collegedb 

CREATE TABLE administrator(
    id          int              IDENTITY(1,1),
    email       nvarchar(100)    NOT NULL,
    password    nvarchar(20)     NOT NULL,
    CONSTRAINT PK3 PRIMARY KEY NONCLUSTERED (id)
)
go



IF OBJECT_ID('administrator') IS NOT NULL
    PRINT '<<< CREATED TABLE administrator >>>'
ELSE
    PRINT '<<< FAILED CREATING TABLE administrator >>>'
go

/* 
 * TABLE: attendance 
 */

CREATE TABLE attendance(
    id            int     IDENTITY(1,1),
    date          date    NOT NULL,
    justified     int     NOT NULL,
    id_class      int     NULL,
    id_student    int     NULL,
    CONSTRAINT PK6 PRIMARY KEY NONCLUSTERED (id)
)
go



IF OBJECT_ID('attendance') IS NOT NULL
    PRINT '<<< CREATED TABLE attendance >>>'
ELSE
    PRINT '<<< FAILED CREATING TABLE attendance >>>'
go

/* 
 * TABLE: class 
 */

CREATE TABLE class(
    id              int             IDENTITY(1,1),
    name            nvarchar(10)    NOT NULL,
    id_level        int             NULL,
    id_professor    int             NULL,
    CONSTRAINT PK5 PRIMARY KEY NONCLUSTERED (id)
)
go



IF OBJECT_ID('class') IS NOT NULL
    PRINT '<<< CREATED TABLE class >>>'
ELSE
    PRINT '<<< FAILED CREATING TABLE class >>>'
go

/* 
 * TABLE: level 
 */

CREATE TABLE level(
    id           int             IDENTITY(1,1),
    level        nvarchar(50)    NOT NULL,
    course       nvarchar(50)    NOT NULL,
    classroom    nvarchar(50)    NOT NULL,
    CONSTRAINT PK7 PRIMARY KEY NONCLUSTERED (id)
)
go



IF OBJECT_ID('level') IS NOT NULL
    PRINT '<<< CREATED TABLE level >>>'
ELSE
    PRINT '<<< FAILED CREATING TABLE level >>>'
go

/* 
 * TABLE: note 
 */

CREATE TABLE note(
    id                      int               NOT NULL,
    note                    decimal(18, 0)    NOT NULL,
    trimester               int               NOT NULL,
    id_student_matricula    int               NULL,
    CONSTRAINT PK8 PRIMARY KEY NONCLUSTERED (id)
)
go



IF OBJECT_ID('note') IS NOT NULL
    PRINT '<<< CREATED TABLE note >>>'
ELSE
    PRINT '<<< FAILED CREATING TABLE note >>>'
go

/* 
 * TABLE: professor 
 */

CREATE TABLE professor(
    id            int              IDENTITY(1,1),
    specialist    int              NOT NULL,
    name          nvarchar(50)     NOT NULL,
    lastname      nvarchar(50)     NOT NULL,
    email         nvarchar(100)    NOT NULL,
    password      nvarchar(20)     NOT NULL,
    CONSTRAINT PK2 PRIMARY KEY NONCLUSTERED (id)
)
go



IF OBJECT_ID('professor') IS NOT NULL
    PRINT '<<< CREATED TABLE professor >>>'
ELSE
    PRINT '<<< FAILED CREATING TABLE professor >>>'
go

/* 
 * TABLE: schedule 
 */

CREATE TABLE schedule(
    id          int             IDENTITY(1,1),
    day         int             NOT NULL,
    startC       nvarchar(10)    NOT NULL,
    endC         nvarchar(10)        NOT NULL,
    id_class    int             NULL,
    CONSTRAINT PK4 PRIMARY KEY NONCLUSTERED (id)
)
go



IF OBJECT_ID('schedule') IS NOT NULL
    PRINT '<<< CREATED TABLE schedule >>>'
ELSE
    PRINT '<<< FAILED CREATING TABLE schedule >>>'
go

/* 
 * TABLE: student 
 */

CREATE TABLE student(
    id          int              IDENTITY(1,1),
    name        nvarchar(50)     NOT NULL,
    lastname    nvarchar(50)     NOT NULL,
    email       nvarchar(100)    NOT NULL,
    password    nvarchar(20)     NOT NULL,
    id_level    int              NULL,
    CONSTRAINT PK1 PRIMARY KEY NONCLUSTERED (id)
)
go



IF OBJECT_ID('student') IS NOT NULL
    PRINT '<<< CREATED TABLE student >>>'
ELSE
    PRINT '<<< FAILED CREATING TABLE student >>>'
go

/* 
 * TABLE: student_matricula 
 */

CREATE TABLE student_matricula(
    id_student_matricula    int    IDENTITY(1,1),
    id_student              int    NULL,
    id_class                int    NULL,
    CONSTRAINT PK9 PRIMARY KEY NONCLUSTERED (id_student_matricula)
)
go



IF OBJECT_ID('student_matricula') IS NOT NULL
    PRINT '<<< CREATED TABLE student_matricula >>>'
ELSE
    PRINT '<<< FAILED CREATING TABLE student_matricula >>>'
go

/* 
 * TABLE: attendance 
 */

ALTER TABLE attendance ADD CONSTRAINT Refclass10 
    FOREIGN KEY (id_class)
    REFERENCES class(id)
go

ALTER TABLE attendance ADD CONSTRAINT Refstudent12 
    FOREIGN KEY (id_student)
    REFERENCES student(id)
go


/* 
 * TABLE: class 
 */

ALTER TABLE class ADD CONSTRAINT Reflevel11 
    FOREIGN KEY (id_level)
    REFERENCES level(id)
go

ALTER TABLE class ADD CONSTRAINT Refprofessor21 
    FOREIGN KEY (id_professor)
    REFERENCES professor(id)
go


/* 
 * TABLE: note 
 */

ALTER TABLE note ADD CONSTRAINT Refstudent_matricula20 
    FOREIGN KEY (id_student_matricula)
    REFERENCES student_matricula(id_student_matricula)
go


/* 
 * TABLE: schedule 
 */

ALTER TABLE schedule ADD CONSTRAINT Refclass2 
    FOREIGN KEY (id_class)
    REFERENCES class(id)
go


/* 
 * TABLE: student 
 */

ALTER TABLE student ADD CONSTRAINT Reflevel8 
    FOREIGN KEY (id_level)
    REFERENCES level(id)
go


/* 
 * TABLE: student_matricula 
 */

ALTER TABLE student_matricula ADD CONSTRAINT Refstudent17 
    FOREIGN KEY (id_student)
    REFERENCES student(id)
go

ALTER TABLE student_matricula ADD CONSTRAINT Refclass18 
    FOREIGN KEY (id_class)
    REFERENCES class(id)
go


