This project explains on using MongoDB as an example of a document-oriented NOSQL system, and how data is stored and queried in such a system. It also helps in understanding the difference between storing data in a flat (relational) format versus in a document (complex object) JSON or XML format.   

Technology Stack:
Programming Language: Python3
Version: Python 3.8.6/3.8.7
IDE: VS Code
Database: MongoDB NoSQL


Package Required:
1. Json2xml : 3.6.0
2. pymongo : 3.12.0

Steps to run the code:

1)Place PROJECT.csv, EMPLOYEE.csv, DEPARTMENT.csv and WORKS_ON.csv in the same folder as project2final.py file.

2)You can run the code using the following command:
'python3 project2final.py' 
 	This will run reading the csv files one by one while saving them locally as json files.
A database named 'database2' is created in mongo cloud with collection PROJECT,EMPLOYEE,DEPARTMENT,WORKS_ON respectively.
Then, three query functions are written to fetch data from cloud mongoDB (mongo alas) while saving the output in json locally which is again pushed to the collections on cloud mongo.
 
3)Also, converted one of the query result to xml for extra credit. 

4)Default input files are - 'PROJECT.csv' ,'EMPLOYEE.csv' , 'DEPARTMENT.csv' , 'WORKS_ON.csv' which will generate corresponding output files.
