CREATE TABLE IF NOT EXISTS users (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     username VARCHAR(50) NOT NULL,
                                     password VARCHAR(255) NOT NULL,
                                     security_question VARCHAR(255) NOT NULL,
                                     security_answer VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password, security_question, security_answer) VALUES
                                                                               ('Edward_Rowntree', 'Scruff123', 'What is your favorite food?', 'Pizza');

