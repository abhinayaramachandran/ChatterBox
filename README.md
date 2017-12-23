# ChatterBox

Chat box application which lets the users view, post and reply to messages of other users.

PHP, MySQL

config.php - Contains database connections
login.php - user authentication script
board.php - script to insert messages and replies


## How to run ?

IMPORTANT NOTE: The MySQL port is set to 3308. phpmyadmin needs to be opened from this port for which the
config.ini file of phpmyadmin must be changed (OR) the port number can be changed in config.php (line 4)
to the default 3306 or whichever port is used while testing.

1. Import the SQL file board.sql using phpmyadmin 

    (OR)

    Using phpmyadmin, create a new data base called board and execute the following queries.

   	CREATE TABLE `posts` (
  	`id` varchar(13) NOT NULL,
  	`replyto` varchar(13) DEFAULT NULL,
  	`postedby` varchar(10) DEFAULT NULL,
	 `datetime` datetime DEFAULT NULL,
  	`message` text
		) ;

    	INSERT INTO `posts` (`id`, `replyto`, `postedby`, `datetime`, `message`) VALUES
	('5a023be35b6e8', NULL, 'abhinaya', '2017-11-07 17:04:03', 'Hey How is your day'),
	('5a023c09e0a55', '5a023be35b6e8', 'smith', '2017-11-07 17:04:41', 'It was great');

	CREATE TABLE `users` (
  	`username` varchar(10) NOT NULL,
  	`password` varchar(32) DEFAULT NULL,
  	`fullname` varchar(45) DEFAULT NULL,
  	`email` varchar(45) DEFAULT NULL
	);

	INSERT INTO `users` (`username`, `password`, `fullname`, `email`) VALUES
	('abhinaya', '1a1dc91c907325c69271ddf0c944bc72', 'Abhinaya Ramachandran', 'abhinaya.ramachandran@mavs.uta.edu'),
	('smith', 'a029d0df84eb5549c641e04a9ef389e5', 'John Smith', 'smith@cse.uta.edu');

	ALTER TABLE `posts`
  	ADD PRIMARY KEY (`id`);


	ALTER TABLE `users`
  	ADD PRIMARY KEY (`username`);
	COMMIT;

2. Now there is a database with two users and a few messages. Open login.php from localhost.
localhost/project5/login.php

Login using the credentials:
smith mypass
(OR)
abhinaya pass

Post messages using the "New post" button or "Reply" button on individual messages.

Logout using the "Logout from chatterbox" button on the top right corner of the page.


## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## License

Abhinaya Ramachandran