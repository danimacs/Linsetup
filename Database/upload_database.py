import sys
import mysql.connector

'''Connect DB'''
connect = mysql.connector.connect(host='localhost', database='WPM', user='phpmyadmin', password='root')

'''Open File'''
file = sys.argv[1]

f = open(file, 'r')
software = f.read().splitlines()
f.close()

'''Upload to DB'''
cursor = connect.cursor()
for i in software:
    software = None, i, file
    sql = "INSERT INTO software (id, name, source) VALUES (%s, %s, %s)"
    cursor.execute(sql, software)
connect.commit()
connect.close()

