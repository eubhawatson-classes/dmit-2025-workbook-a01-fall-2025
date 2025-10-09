/*
    UPDATE and DELETE are the U and D of CRUD. They are the most dangerous.

    In order to make sure we aren't affecting every single record in a table, we must use the WHERE clause to limit or specify what we really want to edit. 

    The syntax for UPDATE looks like: 

    UPDATE table_name
    SET coulmn_1 = value1, column_2 = value2 ...
    WHERE condition;
*/

-- The SET command is used with UPDATE to specify which columns and values should be updated in a table. 
UPDATE cities SET city_name = 'Trana' WHERE cid = 1;

-- Here, we're adding 1000 to the population of an city in Alberta or Saskatchewan. 
UPDATE cities SET population = population + 1000 WHERE province = 'AB' OR province = 'SK';

/*
    The syntax for DELETE looks like: 

    DELETE FROM table_name WHERE condition;

    Remember that this operation is permanent. There is no undo.
*/

-- So long, Cow Town!
DELETE FROM cities WHERE cid = 16;

-- Here, we'll get rid of anything that is not a city (i.e. a population less than 10,000).
DELETE FROM cities WHERE population < 10000;