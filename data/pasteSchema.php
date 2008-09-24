<?php
$statements = array();

$statements[] =<<<EOQ
CREATE TABLE paste (
    id CHAR(13) NOT NULL PRIMARY KEY,
    code TEXT NOT NULL,
    type VARCHAR(32) NOT NULL DEFAULT 'php',
    summary TEXT NULL,
    user VARCHAR(32) NULL,
    parent CHAR(13) NULL,
    created DATETIME NOT NULL,
    expires DATETIME NULL
);
EOQ;

$statements[] =<<<EOQ
CREATE INDEX "id" ON "paste" ("id");
EOQ;

$statements[] =<<<EOQ
CREATE INDEX "parent" ON "paste" ("parent");
EOQ;

$statements[] =<<<EOQ
CREATE INDEX "idExpires" ON "paste" ("id", "expires");
EOQ;

return $statements;
