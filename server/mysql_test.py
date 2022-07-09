from getpass import getpass
from mysql.connector import connect, Error

try:
    with connect(
        host="localhost",
        user=input("Enter username: "),
        password=getpass("Enter password: "),
        database="collection_test",
    ) as connection:
        query = "SHOW DATABASES"
        with connection.cursor() as cursor:
            cursor.execute(query)
            for db in cursor:
                print(db)
except Error as e:
    print(e)