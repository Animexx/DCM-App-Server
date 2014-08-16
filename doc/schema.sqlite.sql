CREATE TABLE 'competitions' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'preliminary_of' INTEGER DEFAULT NULL, 'animexx_event_id' INTEGER DEFAULT NULL, 'name' TEXT, 'date' DATETIME, 'max_participants' INTEGER, 'group_id' INTEGER);
CREATE TABLE 'competition_adjucators' ('competition_id' INTEGER NOT NULL, 'user_id' INTEGER NOT NULL, PRIMARY KEY ('competition_id', 'user_id'));
CREATE TABLE "competition_groups" ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'name' TEXT);
CREATE TABLE 'users' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'animexx_id' INTEGER, 'username' TEXT, 'password' TEXT, 'sysadmin' INTEGER DEFAULT 0);
CREATE TABLE 'competition_participants' ('competition_id' INTEGER NOT NULL, 'user_id' INTEGER NOT NULL, 'name' TEXT, 'data' TEXT, PRIMARY KEY ('competition_id', 'user_id'));
CREATE TABLE 'competition_rating_criteria' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'competition_group_id' INTEGER, 'name' TEXT, 'max_rating' INTEGER, 'order' INTEGER);
CREATE TABLE 'competition_ratings' ('adjucator_id' INTEGER NOT NULL, 'participant_id' INTEGER NOT NULL, 'rating' INTEGER, PRIMARY KEY ('adjucator_id', 'participant_id'));

INSERT INTO 'competition_groups' ('id','name') VALUES ('1','Test-Reihe');
