# PHPRestAPIExample

A simple PHP REST API to demonstrate CRUD functionality on a MySQL Database. This API is built without the use of any frameworks for the purposes of demonstrating what happens in pure PHP.

This project uses Object Oriented concepts for the creation of a database class object as well as PDO to connect to the MySQL database.


## Structure
There are two resources the API can access: 
Category and Post

#### Post

| Endpoint  | HTTP Method | CRUD Method | Action |
| ------------- | ------------- | ------------- | ------------- |
| post/read    | GET| READ | Get all posts |
| post/read_single/:id| GET  | READ | Get a single post |
| post/create    | POST| CREATE | Get all posts |
| post/update/:id | PUT  | UPDATE | Update a single post |
| post/delete | DELETE  | DELETE | Delete a single post |

#### Category

| Endpoint  | HTTP Method | CRUD Method | Action |
| ------------- | ------------- | ------------- | ------------- |
| category/read    | GET| READ | Get all categories |
| category/read_single/:id| GET  | READ | Get a single category |
| category/create    | POST| CREATE | Get all categories |
| category/update/:id | PUT  | UPDATE | Update a single category |
| category/delete | DELETE  | DELETE | Delete a single category |


## Environment
[XAMPP](https://www.apachefriends.org/index.html) for its inclusion of MariaDB, Apache, PHP, and PHPMyAdmin


## Usage
We can test the API using [Postman](https://www.getpostman.com) or [curl](https://curl.haxx.se) to make requests.

## Example
To get the post with an id of 1:
```
GET post/read_single.php?id=1
```

It will return:
```
{
    "id": "1",
    "title": "Technology Post One",
    "body": "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
    "author": "Sam Smith",
    "category_id": "1",
    "category_name": "Technology"
}
```
