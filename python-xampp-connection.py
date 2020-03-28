import pymysql

#database connection
connection = pymysql.connect(host="localhost",user="root",passwd="",database="multi_login" )
cursor = connection.cursor()
print (cursor)
# some other statements  with the help of cursor
connection.close()
