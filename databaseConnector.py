import mysql.connector
import scrapeCourseInfo

cnx = mysql.connector.connect(user='rm4mp', password='Niw6ogha',
                              host='cs4750.cs.virginia.edu',
                              database='rm4mp')
cursor = cnx.cursor()

addCourse = ("INSERT INTO Class "
               "(grade, roomN, className, startTime, endTime, sectionID, day, credit) "
               "VALUES (%s, %s, %s, %s, %s, %s, %s, %s)")

for i in scrapeCourseInfo.extractSISdata(): #each list of course data
    for x in i[4]:
        data = ( i[7] , i[2] , i[0]+" "+i[1] , int(i[3][0].replace(":","")) , int(i[3][1].replace(":","")) , int(i[6]) , int(x) , int(i[5]) )
        print (data)
        cursor.execute(addCourse,data)

cnx.commit()

cursor.close()
cnx.close()