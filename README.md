# Quizzer
A online portal to host your competitions.
[Quizzer](https://wagh.000webhostapp.com/index.php)

# About the app
This is a online portal to host quiz like competitions. Many Colleges do have a system of taking aptitude test online, and they need that for just 2-3 days, and ofcourse don't want to spend any money for that. This web-app is made to achieve that objective. This is absolutely free of cost, but you may contribute to the project to help us expand :P .

## Usage
To use this web-app the user need to login/signup first.
There are two perspectives of the app, one for the Contest Owner and the other for the Contestant.

### Contest Owner
The contest owner is required to make a question bank which will save all of his questions. He will be able to save, edit or even delete the questions or the options. However there is a limit of options i.e. only 4 options can be saved for a particular question.
The choice of marks for correct answer and incorrect answer is also given, user will have to input the positive integers for correct marks and incorrect marks for each question. It may happen that the user wants to have different marking scheme for different questions, that facility is given here.
Then the user is required to host the exam, by filling a form which needs the information about the contest. e.g Exam name , Organisation name, total number of questions that will appear in the test, and the question bank. The user may create any number of question banks but he can use only one question bank for a exam. If he wish he may create another exam and use the other question bank.
Contest owner then can see the leader board to keep an eye on the scoreboard.

### Contestant
The contestant need to press the start test button and choose the test for which he has appeared and start the test.
Instructions would be given to the contestant before the test.
At the end of his test he is allowed to see his marks as well as the leader board to see where he stands.

# How to use at local Host?
To use this app at local host you need to use [XAMPP](https://www.apachefriends.org/index.html).Start Apache and MySql and use php myadmin to create 2 databases one should be 'questionbank' and the other should be 'quizzer' , the names should be exact. Then download this app and unzip it it the C:/xampp/htdocs , this is the folder were all your projects should be placed.
Create three tables in quizzer database, or just copy and paste these commands in the console of phpmyadmin:
(Console is at the bottom of the screen in phpmyadmin. Press ctrl+enter to execute the command)

```
use quizzer // to use the quizzer database

// The following command should make a table 'user' in quizzer 
CREATE TABLE user (
handle VARCHAR (20) PRIMARY KEY,
password VARCHAR (20),
username VARCHAR (25),
mob VARCHAR(12),
email VARCHAR(25),
college TEXT(25))

// The following command should make a table 'examdetails' in quizzer
CREATE TABLE examdetails (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
handle VARCHAR (20),
qbid INT (11),
examname TEXT (25),
orgname TEXT(25),
tqno INT(11))

// The following command should make a table 'qbdetails' in quizzer
CREATE TABLE qbdetails (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
handle VARCHAR (20),
qbname VARCHAR (25))
```
Once this is done put this link in your browser (http://localhost/Quizer/index.php) and you are ready to go.


## Update 
**The current version is 4.29 (Feb 28th, 2017)**
In this version major changes have been made. The database structure is altered greatly and many features have been improved
The site is completely functioning now.
like:
- The user can now make as many number of question banks as he require
- The user can now host as many Exams as he require
- The user can once give a test, he is not allowed to give a particular test more than once.
- Login/SignUp improved they were having issues.

### TODO
[See issues](https://github.com/Nikhil-Wagh/Quizer/issues).

## License
[BSD License](https://opensource.org/licenses/BSD-3-Clause) © Prototype/Quizzer

