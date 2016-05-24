#!/usr/bin/python
print("Code Running")
import MySQLdb

# Load the library to process JSON
import simplejson

# Open database connection
db = MySQLdb.connect(host="127.0.0.1",user="root", passwd="mypassword",db="pokemon",port=5432)
print("Connected")


# prepare a cursor object using cursor() method
cursor = db.cursor()
#put stuff above

'''
create a table
cursor.execute("create table test(ayy Integer Primary key);")

fill in a row
cursor.execute("insert into test (ayy) values (%s)",(54))
'''


#drop table to make it again
cursor.execute("drop table test;");
cursor.execute("drop table test2;");

#create table test
cursor.execute("CREATE TABLE test (pokemonNumber Int, name varchar(32), weight decimal(16,2), heightFeet Int, heightInches Int, pokeType varchar(32), ability varchar(32), description varchar(32), evolutionStatus Int, familyNumber Int, type1 varchar(16), type2 varchar(16));") 

#make a test table
cursor.execute("create table test2 (ayy Int);")


#ass a test line into the table I just made
#cursor.execute("INSERT INTO test (pokemonNumber,name,weight,heightFeet,heightInches,pokeType,ability,description,evolutionStatus,familyNumber) values(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",(1,"test",5.4,3,3,"testType","testAbility","testDesc",9,8))

#allow reading of csv's
import csv


csvfile = open('PokemonData.csv')
datareader = csv.DictReader(csvfile, delimiter=',')
count = 0
for line in datareader:
	#poke = simplejson.loads(line)
	count = count + 1
	#print(count)
	
	cursor.execute("INSERT INTO test (pokemonNumber,name,weight,heightFeet,heightInches,pokeType,ability,description,evolutionStatus,familyNumber,type1,type2) values(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",(line['PokemonNumber'], line['PokemonName'], line['Height'], line['Feet'], line['Inches'], line['PokeType'], line['Ability'], line['Description'], line['EvoNumber'], line['FamilyNumber'], line['Type1'], line['Type2']))
	#name = poke['PokemonNumber']
	#jid = row['Job ID']
	
	
	#name= row['PokemonName']
	#cursor.execute("insert into test2 (ayy) values (%s)",(name))
	



#put stuff above
print("Disconnecting")
# disconnect from server
db.close()
print("Code Finished")
print("Winrar")

#congrats to myself for connecting!



