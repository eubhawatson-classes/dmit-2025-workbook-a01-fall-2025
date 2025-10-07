/*
    SELECT is the READ in CRUD. It allows us to fetch records from the database.

    This action is non-destructive; it does not alter the data in any way (as the other three operations do).

    The syntax looks like: 

    SELECT column_names FROM table_name WHERE condition;
*/

-- In our cities example, we could run:
SELECT city_name FROM cities;
-- This would return all of the names in the database (but nothing else).

-- What if we want to see just a few things at a time?
SELECT * FROM cities LIMIT 3;
-- This will grab the first three records in the table.

-- Now, what if we know the position (primary key) of the record we want to retrieve? 
SELECT * FROM cities WHERE cid = 4;
-- Here, the WHERE clause is adding a condition.

SELECT * FROM cities WHERE province = 'ON';
-- This would select every city in our table from Ontario.

SELECT * FROM cities WHERE is_capital = TRUE;
-- This would give us all of the capital cities.

SELECT * FROM cities WHERE is_capital = 1;
-- In our table, this BOOLEAN value is stored as a 0 or a 1. We could also use a numerical value to return the exact same results.

-- LIKE lets us look for a pattern in our data. 
SELECT * FROM cities WHERE city_name LIKE '%john%';
-- The % is a wildcard character. It allows us to match any string of any length (including zero).
-- The _ character lets us match a single character, rather than a string.

-- SQL also uses logical operators.
SELECT * FROM cities WHERE province = 'ON' AND population > 1000000;
-- We can string together multiple conditions with the AND operator.

-- And we can list our results in any order we like. Here, we'll list them in descending order.
SELECT * FROM cities WHERE province = 'ON' ORDER BY population DESC;

-- What if we want to know which city has the smallest population? 
SELECT population, city_name FROM cities ORDER BY population ASC LIMIT 1;
-- By using LIMIT 1, we're only fetching a single results. 

-- We can also offset our LIMIT. What if I, instead of wanting the top 3 most populated cities, wanted the next group of 3?
SELECT population, city_name FROM cities ORDER BY population DESC LIMIT 3, 3;
-- By adding a comma and number afer the limit, MariaDB knows to start fetching records from that point on.

/*
    This is a 'Canadian Cities' database, but we actually have cities, towns, and villages. They're each defined by their population size, as follows: 

    1. City - 10,000 people or greater
    2. Town - 1,000 people or greater
    3. Village - 300 people or greater
*/

-- So, how might we select only cities? 

-- What about only towns?

-- Only villages? 