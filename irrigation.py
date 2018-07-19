import MySQLdb
import serial
import datetime
import time

conn=MySQLdb.connect("localhost","root","","project")
cursor=conn.cursor()
obj=serial.Serial('COM5',9600)
while obj.isOpen():
    ts = time.time()
    st = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d %H:%M:%S')
    y=obj.readline()
    x=obj.readline()
    #manually on-off
    cursor.execute("select * from button")
    row =cursor.fetchone()
    if(row is not None):
        if(row[0]==1):
            obj.write('1')
            w=1
        else:
            obj.write('0')
            w=0
        cursor.execute("insert into irrigation(moisture,time,status) values('%s','%s','%s')"%(y,st,w))
        #cursor.execute("insert into button(onoff) values('%s')"%(w))
    else:
        #reading from arduino
        cursor.execute("insert into irrigation(moisture,time,status) values('%s','%s','%s')"%(y,st,x))
    conn.commit()    
obj.close()
