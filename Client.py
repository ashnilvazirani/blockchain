# import libraries
import hashlib
import random
import string
import json
import binascii
import numpy as np
import pandas as pd
import pylab as pl
import logging
import datetime
import collections
# following imports are required by PKI
import Crypto
import Crypto.Random
from Crypto.Hash import SHA
from Crypto.PublicKey import RSA
from Crypto.Signature import PKCS1_v1_5
import pymysql

last_block_hash = ""


class Client:
   def __init__(self):
      random = Crypto.Random.new().read
      self._private_key = RSA.generate(1024, random)
      self._public_key = self._private_key.publickey()
      self._signer = PKCS1_v1_5.new(self._private_key)
   @property
   def identity(self):
      return binascii.hexlify(self._public_key.exportKey(format='DER')).decode('ascii')


class Transaction:
   def __init__(self, sender, recipient, value):
      self.sender = sender
      self.recipient = recipient
      self.value = value
      self.time = datetime.datetime.now()

   
   def to_dict(self):
      if self.sender == "Genesis":
         identity = "Genesis"
      else:
         identity = self.sender.identity

      return collections.OrderedDict({
         'sender': identity,
         'recipient': self.recipient,
         'value': self.value,
         'time' : self.time})

   
   def sign_transaction(self):
      private_key = self.sender._private_key
      signer = PKCS1_v1_5.new(private_key)
      h = SHA.new(str(self.to_dict()).encode('utf8'))
      return binascii.hexlify(signer.sign(h)).decode('ascii')

def display_transaction(transaction):
      #for transaction in transactions:
      dict = transaction.to_dict()
      
      print ("sender: " + dict['sender'])
      #file.write("\n")
      #file.write("Sender")
      #file.write(dict['sender'])
      #file.write("\n")
      
      print ('-----')
      #file.write("----------")
      #file.write("\n")
      
      print ("recipient: " + dict['recipient'])
      #file.write("\n")
      #file.write("recipient")
      #file.write(dict['recipient'])
      #file.write("\n")
      
      print ('-----')
      #file.write("----------")
      #file.write("\n")
      
      print ("value: " + str(dict['value']))
      #file.write("\n")
      #file.write("value")
      #file.write(str(dict['value']))
      #file.write("\n")
      
      print ('-----')
      #file.write("----------")
      #file.write("\n")
      
      print ("time: " + str(dict['time']))
      #file.write("\n")
      #file.write("time")
      #file.write(str(dict['time']))
      #file.write("\n")
      
      print ('-----')
      #file.write("----------")
      #file.write("\n")


class Block:
   def __init__(self):
      self.verified_transactions = []
      self.previous_block_hash = ""
      self.Nonce = ""
donor="donor"
acceptor = "acceptor"
#database connection
connection = pymysql.connect(host="localhost",user="root",passwd="",database="multi_login" )
cursor = connection.cursor()
print (cursor)
# queries for retrievint all rows
retrive = "Select * from users where inprogress = 1 and user_type = 'Donor';"
#executing the quires
cursor.execute(retrive)
rows = cursor.fetchall()
print(rows)
for row in rows:
    donor = row[1]
    #print(type(row))

#commiting the connection then closing it.
connection.commit()


retrive_acceptor = "Select * from users where inprogress = 1 and user_type = 'Acceptor';"
#executing the quires
cursor.execute(retrive_acceptor)
rows_acceptor = cursor.fetchall()
print(rows_acceptor)
for row_acceptor in rows_acceptor:
    acceptor = row_acceptor[1]
    #print(type(row))

#commiting the connection then closing it.
connection.commit()
# some other statements  with the help of cursor
connection.close()



transactions = []

#open the file 
file = open("dump.txt",'a+')

#transaction.tofile(file, format = "%s",sep = " ")

#creating the clients
Dinesh = Client()
print (Dinesh.identity)

#file.write("Dinesh's identity \n %s"%Dinesh.identity)

Ramesh = Client()
print (Ramesh.identity)

#file.write("\n Ramesh's identity \n %s"%Ramesh.identity)

Seema = Client()
print (Seema.identity)

#file.write("\n Seema's identity \n %s"%Seema.identity)


Vijay = Client()
print (Vijay.identity)
#file.write("\n Vijay's identity \n %s"%Vijay.identity)


Donor = Client()
print(donor)
print("identity")
print (Donor.identity)
#file.write("\n")
#file.write(donor)
#file.write("identity \n %s"%Vijay.identity)

Acceptor = Client()

print(acceptor)
print("identity")
print(Acceptor.identity)
#file.write("\n")
#file.write(acceptor)
#file.write("identity \n %s"%Vijay.identity)

#Genesis block
t0 = Transaction (
   "Genesis",
   Dinesh.identity,
   "No Organs Defined in Genesis Block"
)

#creating 9 transactions for demo
t1 = Transaction(
   Dinesh,
   Ramesh.identity,
   "Heart"
)

t1.sign_transaction()
transactions.append(t1)

t2 = Transaction(
   Dinesh,
   Seema.identity,
   "eyes"
)
t2.sign_transaction()
transactions.append(t2)
t3 = Transaction(
   Ramesh,
   Vijay.identity,
   "Heart"
)
t3.sign_transaction()
transactions.append(t3)
t4 = Transaction(
   Seema,
   Ramesh.identity,
   "liver"
)
t4.sign_transaction()
transactions.append(t4)
t5 = Transaction(
   Vijay,
   Seema.identity,
   "kidney"
)
t5.sign_transaction()
transactions.append(t5)
t6 = Transaction(
   Ramesh,
   Seema.identity,
   "heart"
)
t6.sign_transaction()
transactions.append(t6)
t7 = Transaction(
   Seema,
   Dinesh.identity,
   "eyes"
)
t7.sign_transaction()
transactions.append(t7)
t8 = Transaction(
   Seema,
   Ramesh.identity,
   "kidney"
)
t8.sign_transaction()
transactions.append(t8)
t9 = Transaction(
   Vijay,
   Dinesh.identity,
   "heart"
)
t9.sign_transaction()
transactions.append(t9)
t10 = Transaction(
   Vijay,
   Ramesh.identity,
   "Heart"
)
t10.sign_transaction()
transactions.append(t10)
#get the blood group, Age Group and the organ donated by the donor
#creating the transaction
t11 = Transaction(
   Donor,
   Donor.identity,
   "heart"
)
t11.sign_transaction()
transactions.append(t11)

#print the transactions 
for transaction in transactions:
   display_transaction(transaction)
   #file.write(str(transaction))
   #file.write("\n")
   #file.write("#################################")
   #file.write("\n")
   #print ('#################################')




block0 = Block()
block0.previous_block_hash = None
Nonce = None

block0.verified_transactions.append (t0)

digest = hash (block0)
last_block_hash = digest

TPCoins = []
def dump_blockchain (self):
   print ("Number of blocks in the chain: " + str(len (self)))


def dump_blockchain (self):
   #print ("Number of blocks in the chain: " + str(len (self)))
   for x in range (len(TPCoins)):
      block_temp = TPCoins[x]
      #print ("block # " + str(x))
      #file.write("block #")
      #file.write(str(x))
      #file.write("\n")
      for transaction in block_temp.verified_transactions:
         display_transaction (transaction)
         print ('--------------')
         file.write("--------------------------------------------------------")
         file.write("\n")
      print ('=====================================')
      file.write("==========================================================================")
      file.write("\n")
      print(Acceptor.identity)
      file.write("Acceptor")
      file.write(Acceptor.identity)
      file.write("\n")
      #************************Blood Group**********************
      #get the blood group, Age Group and the organ donated by the donor
      connection_blood_group = pymysql.connect(host="localhost",user="root",passwd="",database="multi_login" )
      cursor = connection_blood_group.cursor()
      #print (cursor)
      # queries for retrievint all rows
      retrive = "Select blood_group,age_group,organ from users where inprogress = 1 and user_type = 'Donor';"
      #executing the quires
      cursor.execute(retrive)
      rows = cursor.fetchall()
      #print(rows)
      for row in rows:
         blood_group = row[0]
         print("Blood Group")
         print(blood_group)
         file.write(blood_group)
         file.write("\n")
      #commiting the connection then closing it.
      connection_blood_group.commit()


      retrive_acceptor = "Select blood_group,age_group,organ from users where inprogress = 1 and user_type = 'Acceptor';"
      #executing the quires
      cursor.execute(retrive_acceptor)
      rows_acceptor = cursor.fetchall()
      print(rows_acceptor)
      for row_acceptor in rows_acceptor:
         acceptor = row_acceptor[0]
         #print(type(row))

      #commiting the connection then closing it.
      connection_blood_group.commit()
      # some other statements  with the help of cursor
      connection_blood_group.close()
      print(Donor.identity)
      file.write("Donor")
      file.write(Donor.identity)
      file.write("\n")
      file.write('=====================================')
      file.write("\n")
      print ('=====================================')
      
      


TPCoins.append (block0)
dump_blockchain(TPCoins)





file.close()




#change the in-progress to 1
connection_update = pymysql.connect(host="localhost", user="root", passwd="", database="multi_login")
cursor_update = connection_update.cursor()

updateSql = "UPDATE  users SET inprogress= 0  WHERE inprogress= 1 ;"
cursor_update.execute(updateSql)

connection_update.commit()
connection_update.close()




'''
signature = t.sign_transaction()
print("Signature for Signing the transaction")
print (signature)
UPDATE  users SET Complete= 0  WHERE Complete= 1 ;
'''
