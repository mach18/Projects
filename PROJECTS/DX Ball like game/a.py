import sys, pygame
pygame.init()
size = width, height = 1200, 700
speed = [1, 1]
black = 0, 0, 255
blue = 0,0,255

screen = pygame.display.set_mode(size)

ball = pygame.image.load("ball.bmp")
ballrect = ball.get_rect()
box = pygame.image.load("rectangle.jpg")
boxrect=[]
line = pygame.image.load("line.jpg")
line=pygame.transform.scale(line,(200,30))
linerect = line.get_rect()
for i in range(5):
	boxrect.append([])
	for j in range(5):	
		boxrect[i].append(box.get_rect())
left=300
top=150
for i in range(5):
	for j in range(5):	
		boxrect[i][j].top=top
		left=left+80
		boxrect[i][j].left=left
	top=top+50
	left=300
	
color_variable=0
repeat=0
linerect.top=600
while 1:
	x,y=pygame.mouse.get_pos()
	linerect.left=x
	if (ballrect.left + 30 > linerect.left and ballrect.left< linerect.left+200 and ballrect.bottom+20==linerect.bottom):
		speed[1]=-speed[1] 
	for event in pygame.event.get():
		if event.type == pygame.QUIT: sys.exit()
	ballrect = ballrect.move(speed)
	if ballrect.left < 0 or ballrect.right > width:
        	speed[0] = -speed[0]
    	if ballrect.top < 0:
        	speed[1] = -speed[1]
	if ballrect.bottom > height:
		sys.exit()
	if color_variable==0:
		screen.fill(black)
	else:
		screen.fill(blue)
	
	if repeat==500:
		repeat=0
		if color_variable==0:color_variable=1
		else: color_variable=0
	repeat=repeat+1
	for i in range(5):
		for j in range(5):
			screen.blit(box,boxrect[i][j])
	screen.blit(ball, ballrect)
	screen.blit(line, linerect)
	pygame.display.flip()
