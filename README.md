# Welcome to the Store!!! 

This is project 2 for the Advanced Web Development class!
The github repository is used to keep track of versions.

## Guide
`admin.php` - the admin control panel. Lets admin manipulate store items like changing table values

`adminHandler.php` - takes inputs from admin.php and runs SQL to update tables

`cart.php` - similar to adminHandler, takes inputs from store.php and runs SQL to put items into cart (updates tables)

`checkout.php` - displays total cost of items in cart, and provides means of purchasing

`config.php` - provides access to SQL

`drop.php` - drops all tables

`install.php` - installs all tables from test.sql

`login.php` - landing page. Allows users to sign in with account or redirect to account registration

`ordered.php` - a screen to notify the user that order has been placed. Clears cart of items purchased.

`signout.php` - destroys the session, lets user go log in again.

signup.php - account creation page. Asks for username and password.

store.php - the main store page. Allows users to add items to cart, check cart, go to checkout, and if they are an admin, go to the admin page.

the rest are for other stuff


### Database schema:
<img src="https://github.com/cool-mario/The-Store/assets/50786617/df1b205d-ce21-429d-9d0d-2b0a3817b95e" alt="Database schema image" width="600">

**items:** id, store_id, name, price, description, image
**users:** id, username, role (customer/admin), hashed password  
**cart:** id, user_id, item_id 

