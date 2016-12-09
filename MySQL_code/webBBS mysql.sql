create database webBBS CHARACTER SET = utf8mb4;
use webBBS;

CREATE TABLE bbsUser(
  uID int UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  uName VARCHAR(15) NOT NULL UNIQUE ,
  uPassWord VARCHAR(20) NOT NULL ,
  uSex ENUM('Male','Female'),
  uTrueName VARCHAR(8),
  uDateOfBirth DATE,
  uEmail VARCHAR(30),
  uSign TEXT,
  uAvater VARCHAR(100),
  uRegTime TIMESTAMP NOT NULL DEFAULT current_timestamp
);

INSERT INTO bbsUser SET uName='Demo1',uPassWord='123456';
INSERT INTO bbsUser SET uName='demo2',uPassWord='123456';
INSERT INTO bbsUser SET uName='demo3',uPassWord='123456';

CREATE TABLE adminUser(
  aID INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  aName VARCHAR(15) NOT NULL ,
  aPassWord VARCHAR(20) NOT NULL
);

INSERT INTO adminUser SET aName='admin',aPassWord='123456';

CREATE TABLE forumTopic(
  tID BIGINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  tTitle VARCHAR(30) NOT NULL ,
  tContent TEXT NOT NULL ,
  tCreatedByUID INT UNSIGNED NOT NULL ,
  tCreatedTime TIMESTAMP NOT NULL DEFAULT current_timestamp,
  tEditTime TIMESTAMP NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  tClickCount INT UNSIGNED DEFAULT 0 ,
  CONSTRAINT FKTopicUID FOREIGN KEY (tCreatedByUID) REFERENCES bbsUser(uID)
);

CREATE TABLE forumReply(
  cID BIGINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  tID BIGINT UNSIGNED NOT NULL ,
  cContent TEXT NOT NULL ,
  cSendUID INT UNSIGNED NOT NULL ,
  cSendTime TIMESTAMP NOT NULL DEFAULT current_timestamp,
  CONSTRAINT FKContactTopicID FOREIGN KEY (tID) REFERENCES forumTopic(tID),
  CONSTRAINT FKContactUID FOREIGN KEY (cSendUID) REFERENCES bbsUser(uID)
);

CREATE VIEW viewTopics AS
  SELECT
    a.tID,
    a.tTitle,
    a.tContent,
    time_format(a.tCreatedTime,'%Y-%m-%d') AS 'tCreatedDate',
    time_format(a.tCreatedTime,'%H:%i:%s') AS 'tCreatedTime',
    a.tCreatedByUID,
    b.uName,
    a.tClickCount
  FROM forumtopic a,
    bbsuser b
  WHERE a.tCreatedByUID=b.uID;
  
CREATE VIEW viewTopicReply AS
  SELECT
    a.cID,
    a.tID,
    a.cContent,
    b.uName,
    a.cSendUID,
    time_format(a.cSendTime,'%Y-%m-%d') AS 'cSendDate',
    time_format(a.cSendTime,'%H:%i:%s') AS 'cSendTime',
    c.tCreatedByUID
  FROM forumreply a,
    bbsuser b,
    forumtopic c
  WHERE a.cSendUID=b.uID
        AND a.tID=c.tID
  GROUP BY a.cID;

DELIMITER ||

CREATE TRIGGER trgDelTopic
  BEFORE DELETE ON forumtopic
  FOR EACH ROW
  BEGIN
    DELETE FROM forumreply WHERE tID=old.tID;
  END ||
