
# Tamkeen Self-assessment

## Installation

First clone the project repo from : git@github.com:engmohamedamer/selfassessment-backend.git

Enter the project folder then Run
- cp .env.dist .env 
- create database and configure .env file with the required data 
####Run commands
- composer install
- php console/yii app/setup
#### prepare the virtual domains
* http://api.selfassessment.localhost   map to folder project_folder/api/web
* http://backend.selfassessment.localhost   map to folder project_folder/backend/web
* http://storage.selfassessment.localhost   map to folder project_folder/storage/web
* http://organization.selfassessment.localhost   map to folder project_folder/organization/web

And for each organization name we will generate a virtual domain to be linked to the frontend app which we will present later

 Ex :
- Organization X will have subdomain x.selfassessment.localhost And will refer to the app frontend folder


## Demo Data
Super Admin (can manage all other admins)
-----------------------------------------
- user : tamkeen-superadmin@takeen.com
- pass : superadmin@321

Tamkeen admin
---------------------------
- URL         :  http://backend.selfassessment.localhost
- User        :  manager@takeen.com 
- Password : manager@321

### Now you can add your first organization from admin dashboard
 - For each organization you can add one or more "organization-admin". we will use the organization-admin to login to  http://organization.selfassessment.localhost/

