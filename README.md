
# Robot Fight laravel demo #


### What is this repository for? ###

* Robot Fight Portal/api
* Version 1.0.0

### setup ###

    cd [your web project folder]
    
    git clone ---robofight.git
    
    composer install
    
    vi .env
    
    chmod 777 -R storage
    
    php artisan migrate


### quick start ###

 - create an account from Account > Register (found on the right-hand side of menu bar)
 - Once you logged in you, could see "hello your name" in menu bar
 - choose My robots in menu
 - click on Add Button and create your own robot
 - choose Fight! in menu
 - choose your robot and opponent and click on Fight

### APIs ###

The following API paths return json of the same records as shown in the leaderboard.

 - /api/history
 - /api/robots


### DB structures ###


#### robots ####

| Field      | Type             | Null | Key | Default | Extra          |
|------------|------------------|------|-----|---------|----------------|
| id         | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| created_at | timestamp        | YES  |     | NULL    |                |
| updated_at | timestamp        | YES  |     | NULL    |                |
| name       | varchar(255)     | NO   |     | NULL    |                |
| weight     | int(11)          | NO   |     | NULL    |                |
| power      | int(11)          | NO   |     | NULL    |                |
| speed      | int(11)          | NO   |     | NULL    |                |
| avatar     | int(11)          | NO   |     | NULL    |                |
| owner_id   | int(10) unsigned | YES  | MUL | NULL    |                |
| deleted_at | timestamp        | YES  |     | NULL    |                |

The `Robots` table always belongs to one owner, which is represented by `owner_id` (foreign key to users).
The avatar columns hold the integer which can be associated with image, but the thumbnail is not implemented at this point.
On inserting records, the `tr_create_robot` trigger creates a record in the `wlratios` table(expained later).


#### users ####

| Field          | Type             | Null | Key | Default | Extra          |
|----------------|------------------|------|-----|---------|----------------|
| id             | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| name           | varchar(255)     | NO   |     | NULL    |                |
| email          | varchar(255)     | NO   | UNI | NULL    |                |
| password       | varchar(255)     | NO   |     | NULL    |                |
| remember_token | varchar(100)     | YES  |     | NULL    |                |
| created_at     | timestamp        | YES  |     | NULL    |                |
| updated_at     | timestamp        | YES  |     | NULL    |                |

`Users` conforms to the default laravel authenticatable users strucure.


#### wlratios ####

| Field      | Type             | Null | Key | Default  | Extra          |
|------------|------------------|------|-----|----------|----------------|
| id         | int(10) unsigned | NO   | PRI | NULL     | auto_increment |
| created_at | timestamp        | YES  |     | NULL     |                |
| updated_at | timestamp        | YES  |     | NULL     |                |
| robot_id   | int(10) unsigned | NO   | MUL | NULL     |                |
| ratio      | double(7,6)      | NO   |     | 0.000000 |                |
| fight      | int(10) unsigned | NO   |     | NULL     |                |
| win        | int(10) unsigned | NO   |     | NULL     |                |
| lose       | int(10) unsigned | NO   |     | NULL     |                |

The `ratio` column turned out to be unnecessary. Indeed, due to my misunderstanding, I implemented the ranking based on the win rate, instead of number.
Nevertheless, if more sort keys are desired for the future extension, this can be used as one of them. 
`ratio` is calcurated based on the win/loss which the `updated_at` is updated, by the trigger `tr_upd_wl`; 


#### histories ####

| Field      | Type             | Null | Key | Default | Extra          |
|------------|------------------|------|-----|---------|----------------|
| id         | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| playera    | int(10) unsigned | NO   | MUL | NULL    |                |
| playerb    | int(10) unsigned | NO   | MUL | NULL    |                |
| winner     | int(10) unsigned | NO   | MUL | NULL    |                |
| created_at | timestamp        | YES  |     | NULL    |                |
| updated_at | timestamp        | YES  |     | NULL    |                |

This table holds the information about all fight results used in leaderboard.

### csv upload ###

You can create robots from csv:

 - Go to `/robot`
 - Click on `choose the file` from the local drive
 - Click on `Upload` 

csv sample format:

    name,speed,weight,power,avatar
    aaa,12,10,8,2
    bbb,12,10,12,2
    ccc,21,12,10,1
