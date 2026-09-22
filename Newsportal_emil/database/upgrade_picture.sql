-- Käivita ainult siis, kui olemasolevas newsportal andmebaasis on picture BLOB.
ALTER TABLE news MODIFY COLUMN picture MEDIUMBLOB NOT NULL;
