# Welcome to the Store!!! (we need a cool name lol)

This is project 2 for the Advanced Web Development class!
The github repository is used to keep track of versions.

## Guide
`login.oho` is the login page. `index.php` also redirects there    
`store.php` is the shop page you go to after you log in  
`test.sql` is our starting database  
`checkout.php` is the page for users to buy everything in their shopping cart  

the rest are for other stuff


### Database schema:
<img src="https://github.com/cool-mario/The-Store/assets/50786617/df1b205d-ce21-429d-9d0d-2b0a3817b95e" alt="Database schema image" width="600">

**store:** id, name, location  
**items:** id, store_id, name, price, description  
**users:** id, username, role (customer/admin), hashed password  

