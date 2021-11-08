import csv
import json
from json2xml import json2xml
from json2xml.utils import readfromjson

#read all csv files and create corresponding json files to insert in cloud mongo
def read_csv_files():
    #csv file list
    input_csv = ['PROJECT.csv','DEPARTMENT.csv','EMPLOYEE.csv','WORKS_ON.csv']
    output_json = ['PROJECT.json','DEPARTMENT.json','EMPLOYEE.json','WORKS_ON.json']

    for i,j in zip(input_csv,output_json):
        convert_csv_to_json(i,j)

def convert_csv_to_json(csvFile, jsonFile):
    jsonArray_output = []
    #read csv file
    with open(csvFile, encoding="utf-8") as c_f: 
        print("Reading ",csvFile,".....")
        #load csv file data using csv library's dictionary reader
        csv_read = csv.DictReader(c_f) 
        #convert each csv row into python dict
        for each_row in csv_read: 
            #add this python dict to json array
            jsonArray_output.append(each_row)
    #convert python jsonArray to JSON String and write to file
    with open(jsonFile, 'w', encoding="utf-8") as jsonf:
        print("Writing ",jsonFile,".....")
        jsonString = json.dumps(jsonArray_output, indent=4)
        jsonf.write(jsonString)

def get_database():
    from pymongo import MongoClient
    import pymongo

    # Provide the mongodb atlas url to connect python to mongodb using pymongo
    CONNECTION_STRING = "CONNECTIONSTRING HERE"

    # Create a connection using MongoClient. You can import MongoClient or use pymongo.MongoClient
    from pymongo import MongoClient
    client = MongoClient(CONNECTION_STRING)

    # Create the database.
    print("Database with name 'database2' Created in mongo cloud...")
    return client['database2']

def create_collection_mongo_cloud(dbname):
    json_list = ['PROJECT.json','DEPARTMENT.json','EMPLOYEE.json','WORKS_ON.json']
    collection_list = ['project','department','employee','work_on']
    for json_filename,collection_name in zip(json_list,collection_list):
        print(json_filename)
        with open(json_filename) as json_file:
            print("Reading ",json_filename," ....")
            data = json.load(json_file)
            temp_collection_name = dbname[collection_name]
            temp_collection_name.insert_many(data)
            print(collection_name," collection created in mongo cloud. and Data inserted using insert_many function.")

def projectQuery(dbname):
    #project query
    collection_document = dbname['project'] 
    collection_department = dbname['department']
    collection_employee = dbname['employee']
    collection_workon = dbname['work_on']
    department_pointer = collection_department.find()
    employee_pointer = collection_employee.find()
    work_on_pointer = collection_workon.find()
    item_info = collection_document.find()
    print("Running Project Query....")
    print("**********************")
    temp_dic = []
    temp_dname = ""
    temp_hours = ""
    temp_dic_emp = []
    for item in item_info:
        department_pointer = collection_department.find({'Dnumber': item['Dnum']})
        for each_departmentRecord in department_pointer:
            if item['Dnum'] == each_departmentRecord['Dnumber']:
                temp_dname = each_departmentRecord['Dname']
        work_on_pointer = collection_workon.find({'Pno':item['Pnumber']})
        for eachwork in work_on_pointer:
            temp_hours = eachwork['Hours']
            employee_pointer = collection_employee.find({'Ssn':eachwork['Essn']})
            for eachemp in employee_pointer:
                temp_dic_emp.append({'EMP_LNAME':eachemp['Lname'],'EMP_FNAME':eachemp['Fname'],'HOURS':temp_hours})
        temp_var = {'Pname':item['Pname'],'Pnumber':item['Pnumber'],'Dname':temp_dname,'EMPLOYEES':temp_dic_emp}
        temp_dic_emp = []
        temp_dic.append(temp_var)
    print("Creating proejctquery output....")
    jsonFile = 'projectquery.json' 
    with open(jsonFile, 'w', encoding="utf-8") as jsonf:
        print("Writing ",jsonFile,".....")
        jsonString = json.dumps(temp_dic, indent=4)
        jsonf.write(jsonString)
    print("Pushing project query json to cloud mongo....")
    temp_collection_projectQuery = dbname['projectDocument']
    temp_collection_projectQuery.insert_many(temp_dic)

def employeeQuery(dbname):
    #employee query
    collection_employee = dbname['employee']
    collection_department = dbname['department']
    collection_project = dbname['project']
    collection_workon = dbname['work_on']
    department_pointer = collection_department.find()
    project_pointer = collection_project.find()
    work_on_pointer = collection_workon.find()
    emp_info = collection_employee.find()
    # print("item info: ",item_info)
    print("**********************")
    temp_dic = []
    temp_dname = ""
    temp_hours = ""
    temp_dic_project = []

    for each_emp in emp_info:
        department_pointer = collection_department.find({'Dnumber': each_emp['Dno']})
        for each_dept in department_pointer:
            if each_dept['Dnumber'] == each_emp['Dno']:
                temp_dname = each_dept['Dname']
                break
        project_pointer = collection_project.find({'Dnum': each_emp['Dno']})
        for eachprojectRecord in project_pointer:
            if eachprojectRecord['Dnum'] == each_emp['Dno']:
                work_on_pointer = collection_workon.find({'Essn':each_emp['Ssn']})
                for eachworkonRecord in work_on_pointer:
                    if each_emp['Ssn'] == eachworkonRecord['Essn']:
                        temp_hours = eachworkonRecord['Hours']
                temp_dic_project.append({'PNAME':eachprojectRecord['Pname'],'PNUMBER':eachprojectRecord['Pnumber'],'HOURS':temp_hours})
        temp_var = {'EMP_LNAME':each_emp['Lname'],'EMP_FNAME':each_emp['Fname'],'DNAME':temp_dname,'PROJECT':temp_dic_project}
        temp_dic_project = []
        temp_dic.append(temp_var)
    # print(temp_dic)
    jsonFile = 'employeequery.json' 
    with open(jsonFile, 'w', encoding="utf-8") as jsonf:
        print("Writing ",jsonFile,".....")
        jsonString = json.dumps(temp_dic, indent=4)
        jsonf.write(jsonString)
    temp_collection_employeeQuery = dbname['employeeDocument']
    temp_collection_employeeQuery.insert_many(temp_dic)

def departmentQuery(dbname):
    #department query
    collection_document = dbname['project']
    collection_department = dbname['department']
    collection_employee = dbname['employee']
    collection_workon = dbname['work_on']
    # department_pointer = collection_department.find()
    employee_pointer = collection_employee.find()
    work_on_pointer = collection_workon.find()
    department_pointer = collection_department.find()
    # print("item info: ",item_info)
    print("**********************")
    temp_dic = []
    temp_M_Lname = ""
    temp_dic_dept = []
    for each_department in department_pointer:
        employee_pointer = collection_employee.find({'Ssn':each_department['Mgr_ssn']})
        for each_emp in employee_pointer:
            if each_department['Mgr_ssn'] == each_emp['Ssn']:
                temp_M_Lname = each_emp['Lname']
                break
        employee_pointer = collection_employee.find({'Dno':each_department['Dnumber']})
        for each_emp in employee_pointer:
            if each_department['Dnumber'] == each_emp['Dno']:
                temp_dic_dept.append({'E_LNAME':each_emp['Lname'],'E_FNAME':each_emp['Fname'],'SALARY':each_emp['Salary']})
        temp_var = {'DNAME':each_department['Dname'],'MANAGER_LNAME':temp_M_Lname,'MGR_START_DATE':each_department['Mgr_start_date'],'EMPLOYEE':temp_dic_dept}
        temp_dic_dept = []
        temp_dic.append(temp_var)
    jsonFile = 'departmentquery.json' 
    with open(jsonFile, 'w', encoding="utf-8") as jsonf:
        print("Writing ",jsonFile,".....")
        jsonString = json.dumps(temp_dic, indent=4)
        jsonf.write(jsonString)
    temp_collection_projectQuery = dbname['departmentDocument']
    temp_collection_projectQuery.insert_many(temp_dic)

def remove_collections_mongo_cloud(dbname):
    for each_collection in dbname.list_collection_names():
        dbname[each_collection].drop()

def save_in_XML():
    data = readfromjson("projectquery.json")
    with open('PROJECTS.xml', 'w') as file:
        file.write(json2xml.Json2xml(data, wrapper="PROJECTS", pretty=True, attr_type=False).to_xml())

if __name__ == "__main__":
    #read csv files and save them as json to upload in mongo cloud
    read_csv_files()
    # Get the database
    dbname = get_database()
    #remove existing collections from mongo cloud
    remove_collections_mongo_cloud(dbname)
    #create a collection
    create_collection_mongo_cloud(dbname)
    #project query
    projectQuery(dbname)
    #employee query
    employeeQuery(dbname)
    #department query
    departmentQuery(dbname)
    #Save products in XML
    save_in_XML()