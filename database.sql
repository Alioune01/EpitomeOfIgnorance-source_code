/*Create the following databases in your server for the whole application to work*/

CREATE TABLE answers 
(
  qid int(250),
  answer varchar(250),
  id int(11) AUTO_INCREMENT PRIMARY
)

CREATE TABLE questions
(
  id int(250) AUTO_INCREMENT PRIMARY,
  question varchar(250)
)
