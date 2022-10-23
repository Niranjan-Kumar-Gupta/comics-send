# comics send
**[ comics send](https://github.com/Niranjan-Kumar-Gupta/comics-send)** is a xkcd chhalange

## Installation
For running this example, you need to clone this project in your local machine

```
git clone https://github.com/Niranjan-Kumar-Gupta/comics-send
```



## Folder Structure
In this example, we have some files and folder that you need to concentrate about, as follows:
- index.php
- dbcon.php
- savedata.php
- verify.php
- sendComics.php
- unsubcribe.php

### index.php
This file will contains html and javascript code for collecting a visitor's email

### dbcon.php
This file will contains database related information like dbname,user,password and connect to the database.

### savedata.php

In this file we will save the in database.First we will connect to the database and check this email is already register or not if email is already register then we will give a notification to the user that email is already register.
if email is not register then we generate a verify token and save email and verify token in database for verification of email. and send email to verify email address.

### verify.php

in this file we will verify the email address.we will check email address and verification token or correct are not,if correct then update the column name is_verifed to 1 and email will be verified.

### sendComics.php

in this file first we will check verified emails and send random coimcs to the those verified emails.for cheacking verified emails we will check  column name is_verifed are  1 or 0,if 1 then email is verified, if 0 then email is not verified

### unsubcribe.php

in this file we will unsubcribe the user.if user want to stop comics's email then click on the link sent in the mail.if user click the link then we will check email exit or not if exit then we will delete the email for unsubcribe.
