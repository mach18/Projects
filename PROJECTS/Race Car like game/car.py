from curses import *
from random import randrange
import time
initscr();
key=KEY_UP
win=newwin(33,30,2,48)
win.border()
carx=27
cary=14
count=100
win.keypad(1);
#win.nodelay(1);
holex=randrange(5,13)
holey=randrange(5,29)
boostx=randrange(5,13)
boosty=randrange(5,29)
def initialisecar():
	win.addstr(carx,cary,"\\_/")
	win.addstr(carx+1,cary,"|||")
	win.addstr(carx+2,cary,"/_\\")
def erasecar():
	win.addstr(carx,cary,"   ")
	win.addstr(carx+1,cary,"   ")
	win.addstr(carx+2,cary,"   ")
def movboostdown():
	global boostx,boosty
	win.addch(boostx,boosty," ")
	win.addch(boostx+1,boosty,"B")
def movholedown():
	global holex,holey
	win.addch(holex,holey," ")
	win.addch(holex+1,holey,"o")
def wincheck():
	global count,boostx,boosty,holex,holey,cary,carx
	if(cary==2):
		cary=26
		initialisecar()
	else: 
	 	if(cary==26):	
			cary=2
			initialisecar()
	if(holex+1>=carx and  holex+1<=carx+2 and holey>=cary and holey<=cary+2):
		win.addch(holex+1,holey," ")
		holex=randrange(1,13)
		holey=randrange(1,29)
	if(boostx+1>=carx and  boostx+1<=carx+2 and boosty>=cary and boosty<=cary+2):
		win.addch(boostx+1,boosty," ")
		boostx=randrange(1,13)
		boosty=randrange(1,29)
		if count>50:
			count=(count*9)/10
	if(holex>=30):
		win.addch(holex+1,holey," ")
		holex=randrange(5,13)
		holey=randrange(5,29)
	if(boostx>=30):
		win.addch(boostx+1,boosty," ")
		boostx=randrange(5,13)
		boosty=randrange(5,29)
while(key!=27):
	initialisecar()
	win.timeout(count)
	getkey=win.getch()
	erasecar()
	if getkey!=-1:
		key=getkey
	if(carx>17):
		carx=carx-1
	else:
	 	boostx=boostx+1
	 	holex=holex+1
		movboostdown()
		movholedown()
	if(key==KEY_RIGHT):
		cary=cary+1
	if(key==KEY_LEFT):
		cary=cary-1
	wincheck()
	win.refresh()
endwin()
