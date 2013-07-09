#!/usr/bin/env python
import random
import time
from curses import * 
from random import randrange
robotlevel=3
dbomb=4
initscr();
win = newwin(300,125,5,5);
level=1
finalcount=0
key=KEY_RIGHT
start_color()
init_pair(1,COLOR_YELLOW,COLOR_BLACK)
init_pair(2,COLOR_CYAN,COLOR_BLACK)
init_pair(3,COLOR_BLUE,COLOR_BLACK)
init_pair(4,COLOR_RED,COLOR_BLACK)
init_pair(5,COLOR_GREEN,COLOR_BLACK)
init_pair(6,COLOR_BLUE,COLOR_GREEN)
init_pair(7,COLOR_GREEN,COLOR_BLUE)
win.keypad(1);
win.nodelay(1);
win.border();
curs_set(0);
class robo:
 def initialisewindow(self):
	self.b1=0
	self.b2=0
	self.foundbomb=0
	self.boundrybreak=0
	self.founddc=0
	self.foundhole=0
	self.founde=0
	self.foundgun=0
	self.count=0
	self.foundpipe=0
	self.robot=[]
	self.ld=[]
	self.ld1=[]
	self.hole=[]
	self.gun=6
	self.gun1=109
	self.calllevelwin=0
	self.callinstwin=0
 def decodes(self,dbomb):
	l1=random.sample(range(2,21),dbomb)
	l2=random.sample(range(2,40)+range(43,57)+range(60,100),dbomb)
	self.ld=map(lambda i: (l1[i],l2[i]),[x for x in range(dbomb)])
	for i in range(dbomb):
		win.addch(l1[i],l2[i],'D',color_pair(6))
 def initialrobot(self,robotlevel):
	self.robot=[]
	for i in range(robotlevel):
		for j in range(robotlevel):
			self.robot.append([])
			self.robot[i*robotlevel+j]=[10+i,10+j]
 def plantbomb(self):
	q=randrange(1,29)
	w=randrange(1,100)
	t=0
	while((win.inch(q,w)!=' ' and t==5) or q==23):
		q=randrange(1,29)
		w=randrange(1,100)
	win.addch(q,w,'B')	
	self.b1=q
	self.b2=w
 def robotmake(self,robotlevel):	
	if(robotlevel!=5):
		for i in range(len(self.robot)):
			win.addch(self.robot[i][0],self.robot[i][1],'X')
	else:
		e=randrange(1,100,1)
		t=randrange(1,100,1)
		win.addstr(self.robot[0][0],self.robot[0][1]," i_i ",color_pair((e+t)%5))
		win.addstr(self.robot[5][0],self.robot[5][1],"[@_@]",color_pair((e+t)%5))
		win.addstr(self.robot[10][0],self.robot[10][1],"/|_|\\",color_pair((e+t)%5))
		win.addstr(self.robot[15][0],self.robot[15][1]," i i ",color_pair((e+t)%5))
		win.addstr(self.robot[20][0],self.robot[20][1]," j j ",color_pair((e+t)%5))
 def eraserobot(self,robotlevel):
	for i in range(len(self.robot)):
		win.addch(self.robot[i][0],self.robot[i][1],' ')
 def movrobotleft(self,robotlevel):
	self.robot=map(lambda x:[self.robot[x][0],self.robot[x][1]-1],[i for i in range(len(self.robot))])
 def movrobotright(self,robotlevel):
	self.robot=map(lambda x:[self.robot[x][0],self.robot[x][1]+1],[i for i in range(len(self.robot))])
 def movrobotup(self,robotlevel):
	self.robot=map(lambda x:[self.robot[x][0]-1,self.robot[x][1]],[i for i in range(len(self.robot))])
 def movrobotdown(self,robotlevel):
	self.robot=map(lambda x:[self.robot[x][0]+1,self.robot[x][1]],[i for i in range(len(self.robot))])
 def plantpipes(self):
	e=randrange(1,200,1)
	for i in range(10,20):
		for j in [41,58]:
			win.addstr(i,j,'||',color_pair((i+j+e)%5+1));
			e=e+1
 def plantholes(self,holes):
	l1=random.sample(range(1,29),holes)
	l2=random.sample(range(1,40)+range(43,57)+range(57,118),holes)
	self.hole=map(lambda i: (l1[i],l2[i]),[x for x in range(holes)])
	for i in range(holes):
		win.addch(l1[i],l2[i],'H',color_pair(2))
 def enemyrobo1(self):
	e=randrange(1,100,1)
	win.addstr(23,1,"    ___",color_pair(((2+e)%5)+1))
	win.addstr(24,1,"   /__  ",color_pair(((3+e)%5)+1))
	win.addstr(25,1," _//\ \\",color_pair(((4+e)%5)+1))
	win.addstr(26,1,"|_| |_|",color_pair(((5+e)%5)+1))
 def enemyrobo2(self):
	e=5
	win.addstr(2,110,"___    ",color_pair(((2+e)%5)+1))
	win.addstr(3,110,"___\   ",color_pair(((3+e)%5)+1))
	win.addstr(4,110," _/\\\\  ",color_pair(((4+e)%5)+1))
	win.addstr(5,110,"|_| |_|",color_pair(((5+e)%5)+1))
 def check(self):
	checkedonce=0
	global level,finalcount
	for i in range(len(self.robot)):
		if (self.robot[i][0]==23 and self.gun==self.robot[i][1]) or (self.robot[i][0]==2 and self.gun1==self.robot[i][1]):
			self.foundgun=1
		if self.robot[i][0]==self.b1 and self.robot[i][1]==self.b2:
		 	self.foundbomb=1
		if ((self.robot[i][0],self.robot[i][1])) in self.ld and checkedonce==0 and ((self.robot[i][0],self.robot[i][1])) not in self.ld1:
			self.ld1.append((self.robot[i][0],self.robot[i][1]))
			self.founddc=1
			self.count=self.count+1
			finalcount=finalcount+1
			checkedonce=1
		if ((self.robot[i][0],self.robot[i][1])) in self.hole:
			self.foundhole=1
		if (self.robot[i][0] in [23,24,25,26] and self.robot[i][1] in [1,2,3,4,5,6,7] and level not in [1]):
			self.founde=1
		if (self.robot[i][0] in [2,3,4,5] and self.robot[i][1] in [] and level not in [110,111,112,113,114,115,116]):
			self.founde=1
		if self.foundhole==1 or self.founddc==1 or self.foundbomb==1 or self.founde==1:
			win.addch(self.robot[i][0],self.robot[i][1],' ')
		if level not in [1]:
			if self.robot[i][0] in range(10,20) and self.robot[i][1] in [41,42,58,59]:
			 	self.foundpipe=1
		if self.robot[i][0]  in [1,28] or self.robot[i][1] in [1,119]:
		  	self.boundrybreak=1
 def instructionwindow(self):
	global level
	win.addstr(4,15,"Here Are The Instructions To the Game::.....",color_pair(2))
	win.addstr(5,15,"--------------------------------------------",color_pair(4))
	win.addstr(8,15,"Press ESC To Directly EXIT The Game")
	win.addstr(10,15,"Press 'p' To Pause The Game",color_pair(4))
	win.addstr(12,15,"There Are Three Levels In The Game::.....")
	win.addstr(14,15,"There Are Defuse Codes (D) ,Bombs (B),Holes(H), and Walls(|)",color_pair(4))
	win.addstr(16,15,"Collecting All D's and Then going to B makes You win the game")
	win.addstr(18,15,"Colliding With any of Walls or \"Enemy robo\" or Holes results into you losing the level",color_pair(4))
	win.addstr(20,15,"But Losers's Don't Worry After every level you can again still play the next level if you want")
	win.addstr(22,15,"Also there are gun's with my \"enemy robo\"",color_pair(4))
	win.addstr(24,15,"Press The Corresponding Levelno. To Select The Level::.....")
	win.addstr(26,100,"copyright \"mach18\"",color_pair(2))
	c=-1
	while(c==-1):
		c=win.getch()
	if(c==ord('1')):
		level=1
		return
	if(c==ord('2')):
		level=2
		return
	if(c==ord('3')):
		level=3
		return
	endwin()
	quit()
 def levelchange(self):
	global level,dbomb
	if(self.count==dbomb and self.foundbomb==1):
		win.addstr(9,15,"You Won level no. "+str(level)+" ")
	else:
	 	win.addstr(9,15,"You Lost still..")
	win.addstr(11,15,"Press y to go to next level ")
	win.addstr(13,15,"Press n to stop the game ")
	c=-1
	while(c!=ord('y') and c!=ord('n')):
		c=win.getch()
		win.timeout(100)
	if(c==ord('y')):
		calllevelwin=1
		level=level+1
		return 
	else:
		endwin()
		quit()
 def clearwin(self):
	for i in range(1,29):
		for j in range(1,124):
			win.addch(i,j,' ')
 def finishwindow(self):
	obj.clearwin()
	global level,finalcount
	win.addstr(9,42,"Your Final Score Is "+str(finalcount)+" ")
	win.addstr(11,44,"The Game Finishes")
	win.addstr(13,41,"Press Esc or Enter To Exit")
	win.addstr(15,41,"Press r to Restart The Game")
	
	c=-1
	while(c!=10 and c!=27 and c!=ord('r')):
		c=win.getch()
	if(c==ord('r')):
		level=1
		finalcount=0
	else:
		endwin()
		quit()
 def placegun(self):
	global level
	if level in [2,3]:
		win.addstr(23,self.gun,'  ')
		if self.gun==122:
			self.gun=5
		else:
			self.gun=self.gun+1
		win.addstr(23,self.gun,'--')
	if level in [3]:
		win.addstr(2,self.gun1,'  ')
		if self.gun1==1:
			self.gun1=122
		else:
			self.gun1=self.gun1-1
		win.addstr(2,self.gun1,'--')
			
obj=robo()
obj.initialisewindow()
obj.instructionwindow()

while(level<4 and key!=27):
		obj.clearwin()
		obj.initialrobot(3)
		obj.robotmake(3)
		obj.decodes(4)
		win.refresh()
		win.timeout(1000)
		obj.plantbomb()
		win.refresh()
		win.timeout(1000)
		if(level in [2]):
			obj.plantpipes()
			obj.plantholes(5)
			obj.enemyrobo1()
			obj.initialrobot(5)
			obj.robotmake(5)
		if(level==3):
			obj.plantpipes()
			obj.plantholes(10)
			obj.enemyrobo1()
			obj.initialrobot(5)
			obj.robotmake(5)
			obj.enemyrobo2()
		
		while(key!=27):
			obj.placegun()
			win.addstr(0,40,' LEVEL SCORE : '+str(obj.count)+' FINAL SCORE : '+str(finalcount)+' ')
			timer=140-(5*(obj.count))
			if(timer<30):
				timer=30
			win.timeout(timer/2)
			getkey=win.getch()
			obj.check()
			t=key
			if(getkey==ord('p')):
				getkey=win.getch()
				while getkey!=ord('p'):
					getkey=win.getch()
					win.addstr(0,73,' ')
					if level in [2,3]:
						obj.robotmake(5)
					else:
						obj.robotmake(3)
				getkey=KEY_RIGHT
				win.addstr(0,73,' ')
			if getkey!=-1:key=getkey
			obj.eraserobot(robotlevel)
			if(key==KEY_DOWN):
				obj.movrobotdown(level)
			if(key==KEY_UP):
				obj.movrobotup(level)
			if(key==KEY_RIGHT):
				obj.movrobotright(level)
			if(key==KEY_LEFT):
				obj.movrobotleft(level)
			if obj.foundgun==1 or obj.founde==1 or obj.foundbomb==1 or obj.foundpipe==1 or obj.boundrybreak==1 or obj.foundhole==1:
				obj.clearwin()
				if(level<3):
					obj.levelchange()
				else:
					obj.finishwindow()
				obj.initialisewindow()
				break
			if(level in [2,3]):
				obj.robotmake(5)	
			else:
				obj.robotmake(robotlevel)
			win.refresh()
endwin()
