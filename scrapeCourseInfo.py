import requests

classesAndTheirGrades={}

def extractSISdata():
	url = "https://sisuva.admin.virginia.edu/psc/ihprd/UVSS/SA/s/WEBLIB_HCX_CM.H_CLASS_SEARCH.FieldFormula.IScript_ClassSearch?institution=UVA01&term=1198&date_from=01%2F01%2F1971&date_thru=12%2F31%2F2200&subject=&catalog_nbr=&time_range=0%2C23.5&days=&campus=&location=&acad_career=&acad_group=&rqmnt_designtn=&instruction_mode=&keyword=&class_nbr=&acad_org=CS&enrl_stat=&crse_attr=&crse_attr_value=&instructor_name=&session_code=&units=&page=1"

	r=requests.get(url=url)
	data = r.json()
	listOfCourses=[]
	for i in data:
		if (returnClassRoom(i) != "TBA"):
			listOfCourses.append([returnClassAcrAndNumber(i),returnClassDescription(i),returnClassRoom(i),returnClassTimes(i),returnClassMeetingDays(i),returnClassCredit(i),returnSectionID(i),getGradeForClass(returnClassAcrAndNumber(i))])

	return (listOfCourses)

def returnClassRoom(data):
	return (data.get('class_meeting_patterns')[0].get("room_descr"))

def returnClassTimes(data): #(start, end) tuple result
	return ((data.get('class_meeting_patterns')[0].get("meeting_time_start")),(data.get('class_meeting_patterns')[0].get("meeting_time_end")))

def getGradeForClass(className):
	if (className not in classesAndTheirGrades.keys()):
		url = "https://vagrades.com/api/uvaclass/"+className

		r=requests.get(url=url)
		data = r.json()
		
		if ("course" in data.keys()):
			classesAndTheirGrades[className]=data["course"].get('avg')
			return (classesAndTheirGrades[className])
		else:
			return (0)

	else:
		return (classesAndTheirGrades[className])

	
def returnClassMeetingDays(data): #[list, of, day, numbers]
	listOfDays=[]
	jsonListOfDays=['mon','tues','wed','thurs','fri','sat','sun']
	for i in jsonListOfDays:
		if (data.get('class_meeting_patterns')[0].get(i)=='Y'):
			listOfDays.append(jsonListOfDays.index(i)+1)
	return (listOfDays)
	
def returnClassCredit(data):
	return (data.get('units'))
	
def returnSectionID(data):
	return (data.get('class_nbr'))
	
def returnClassAcrAndNumber(data):
	return (data.get('subject')+data.get('catalog_nbr'))

def returnClassDescription(data):
	return (data.get('descr'))

	