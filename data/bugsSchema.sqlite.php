<?php
$statements = array();

$statements[] =<<<EOQ
CREATE TABLE "user" (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(64) NOT NULL,
    email VARCHAR(255) NOT NULL,
    fullname VARCHAR(128) NOT NULL,
    password CHAR(32) NOT NULL,
    role VARCHAR(32) NOT NULL DEFAULT 'user',
    date_created DATE NOT NULL,
    date_banned DATE NULL
);
EOQ;

$statements[] =<<<EOQ
CREATE INDEX "user_username" ON "user" ("username");
EOQ;

$statements[] =<<<EOQ
CREATE INDEX "user_email" ON "user" ("email");
EOQ;

$statements[] =<<<EOQ
CREATE TABLE "bug" (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    reporter_id INTEGER NOT NULL,
    developer_id INTEGER NULL,
    priority_id INTEGER NOT NULL,
    type_id INTEGER NOT NULL,
    resolution_id INTEGER NULL,
    summary TEXT,
    description TEXT,
    date_created DATE NOT NULL,
    date_resolved DATE,
    date_closed DATE,
    date_deleted DATE
);
EOQ;

$statements[] =<<<EOQ
CREATE INDEX "bug_date_created" ON "bug" ("date_created");
EOQ;

$statements[] =<<<EOQ
CREATE INDEX "bug_date_resolved" ON "bug" ("date_resolved");
EOQ;

$statements[] =<<<EOQ
CREATE INDEX "bug_date_closed" ON "bug" ("date_closed");
EOQ;

$statements[] =<<<EOQ
CREATE INDEX "bug_date_deleted" ON "bug" ("date_deleted");
EOQ;

$statements[] =<<<EOQ
CREATE TABLE "comment" (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    path TEXT NOT NULL,
    "comment" TEXT,
    date_created DATE NOT NULL,
    date_deleted DATE
);
EOQ;

$statements[] =<<<EOQ
CREATE INDEX "comment_path" ON "comment" ("path");
EOQ;

$statements[] =<<<EOQ
CREATE INDEX "comment_user_id" ON "comment" ("user_id");
EOQ;

$statements[] =<<<EOQ
CREATE TABLE "issue_type" (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    "type" VARCHAR(255)
);
EOQ;

$statements[] =<<<EOQ
CREATE INDEX "issue_type_type" ON "issue_type" ("type");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "issue_type" VALUES (1, "Bug");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "issue_type" VALUES (2, "Feature request");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "issue_type" VALUES (3, "Documentation issue");
EOQ;

$statements[] =<<<EOQ
CREATE TABLE "resolution_type" (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    "resolution" VARCHAR(255)
);
EOQ;

$statements[] =<<<EOQ
CREATE INDEX "resolution_type_type" ON "resolution_type" ("resolution");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "resolution_type" VALUES (1, "Open");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "resolution_type" VALUES (2, "In progress");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "resolution_type" VALUES (3, "Will not fix");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "resolution_type" VALUES (4, "Bogus");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "resolution_type" VALUES (5, "Resolved");
EOQ;

$statements[] =<<<EOQ
CREATE TABLE "priority_type" (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    "priority" VARCHAR(255)
);
EOQ;

$statements[] =<<<EOQ
CREATE INDEX "priority_type_type" ON "priority_type" ("priority");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "priority_type" VALUES (1, "Trivial");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "priority_type" VALUES (2, "Minor");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "priority_type" VALUES (3, "Normal");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "priority_type" VALUES (4, "Major");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "priority_type" VALUES (5, "Critical");
EOQ;

$statements[] =<<<EOQ
CREATE TABLE "relation_type" (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    "relation" VARCHAR(255)
);
EOQ;

$statements[] =<<<EOQ
CREATE INDEX "relation_type_type" ON "relation_type" ("relation");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "relation_type" VALUES (1, "depends on");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "relation_type" VALUES (2, "relates to");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "relation_type" VALUES (3, "is dependent on");
EOQ;

$statements[] =<<<EOQ
INSERT INTO "relation_type" VALUES (4, "duplicates");
EOQ;

$statements[] =<<<EOQ
CREATE TABLE "bug_relation" (
    "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    "bug_id" INTEGER NOT NULL,
    "related_id" INTEGER NOT NULL,
    "relation_type" INTEGER NOT NULL
);
EOQ;

$statements[] =<<<EOQ
CREATE INDEX "bug_relation_bug" ON "bug_relation" ("bug_id");
EOQ;

$statements[] =<<<EOQ
CREATE INDEX "bug_relation_related" ON "bug_relation" ("related_id");
EOQ;

return $statements;
