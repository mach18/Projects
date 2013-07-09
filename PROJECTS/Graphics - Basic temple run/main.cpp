#include <iostream>
#include <cmath>
#include <GL/glut.h>
//#include "class.h"
#include "robot_class.h"
#include<stdio.h>
#include<string.h>
#include "imageloader.h"
//#include "Robot.cpp"
using namespace std;

#define PI 3.141592653589
#define DEG2RAD(deg) (deg * PI / 180)
#define rep(i,n) for(i=0;i<n;i++)
struct floor
{
	float x,y,z;
	int move;
	int r,g,b;
};
struct coin
{
	float x,y,z,angle;
	int type;
	int show;
	int r,g,b;
};
struct Nos
{
	float x,y,z,angle;
	int show;
};
struct magnet
{
	float x,y,z,angle;
	int show;
	int r,g,b;
};
// Function Declarations
void drawScene();
void update(int value);
void initRendering();
void handleResize(int w, int h);
void handleKeypress1(unsigned char key, int x, int y);
void handleKeypress2(int key, int x, int y);
void set_special_key_up(int key, int x, int y);
void handleMouseclick(int button, int state, int x, int y);
void handleMousemotion(int x, int y);
void handle_movement();
void drawCoins();
void drawNos();
void draw_Nos();
void drawMagnets();
void drawMagnet();
void detectCollision();
void initialiser();
void drawMenu();
void drawFloor();
void drawFlag();
void drawCuboid(float X,float Y,float Z,int move);
void drawBackground();


// Global Variables
int menu_mode=0;
int game=-1;
float initial_rotation=180;
int light_mode=-1;

//int swimming_mode=0;

int num_of_teleporter=2;
int cam=1;
int cam_count=5;
int cam3_once=0;
float cam3_angle=90;
int cam3_motion=0;
int cam3_flag=0;
int cam5_x=0;
int cam5_z=0;
float cam5_angle=90;
float initial_x,initial_y,final_x,final_y;
int mouse_x_max=0;
int mouse_y_max=0;


int num_of_boxes_x=10;
int num_of_boxes_z=400;
float box_len=10.0;
float box_width=10.0;
int floor_once=0;
int robot_motion=0;
int test=0;
int flag=1;
int lyf=5000;


int score_coin=0;
int score_time=0;

float position_x=0.0;
float position_y=10.0;
float position_z=10.00;

float position2_x=0.0;
float position2_y=10.0;
float position2_z=10.00;

float position1_x=0.0;
float position1_y=10.0;
float position1_z=10.00;

float tower_x=-1.00*num_of_boxes_x*box_width -120.00;
float tower_y=200.00;
float tower_z=+40.00;

float check_collision[4];

float rotation=0.00;
float factor=1.0;
struct floor boxes[100][400];
int once[100][400];
int level=1;

int types_of_coin=2;
int coin_once=0;
int num_of_coins=(num_of_boxes_x*num_of_boxes_z)/20.0+1;
int num_of_Noss=num_of_coins/20+1;
int num_of_magnets=num_of_coins/5.0+1;
struct coin coins[1000];
struct Nos Noss[1000];
struct magnet magnets[1000];
int has_magnet=0;
int boost=1;

float robot_x=-2*(num_of_boxes_x*box_width)/2 + box_width/2.0;
float robot_y=0.0;
float robot_z=0.0;
float speed_robot=0.0;

float max_speed=5;
float speed_x=speed_robot;
float speed_y=0.0;
float speed_z=speed_robot;
float gravity=0.098;

//int mode_jump=0;
int jump_counter=0;
int new_jump_counter=100;
float jump_robot_y=0.0;
float floor_robot_y=0.0;
float robot_angle=90.0;

int present_box_i=0,present_box_j=0;

int special_key[4];
// constants for arm and leg movement states
float mod(float a)
{
	return a<0?-1.0*a:a;
}
float min(float a,float b)
{
	return a<b?a:b;
}
float square(float a)
{
	return a*a;
}
GLuint loadTexture(Image* image) {
	GLuint textureId;
	glGenTextures(1, &textureId); //Make room for our texture
	glBindTexture(GL_TEXTURE_2D, textureId); //Tell OpenGL which texture to edit
	//Map the image to the texture
	glTexImage2D(GL_TEXTURE_2D,                //Always GL_TEXTURE_2D
			0,                            //0 for now
			GL_RGB,                       //Format OpenGL uses for image
			image->width, image->height,  //Width and height
			0,                            //The border of tee image
			GL_RGB, //GL_RGB, because pixels are stored in RGB format
			GL_UNSIGNED_BYTE, //GL_UNSIGNED_BYTE, because pixels are stored
			//as unsigned numbers
			image->pixels);               //The actual pixel data
	return textureId; //Returns the id of the texture
}

GLuint _textureId; //The id of the texture
GLuint _textureId1; //The id of the texture
GLuint _textureId2; //The id of the texture
GLuint _textureId3; //The id of the texture
GLuint _textureId4; //The id of the texture
GLuint _textureId5; //The id of the texture
GLuint _textureId6; //The id of the texture
GLuint _textureId7; //The id of the texture
GLuint _textureId8; //The id of the texture
GLuint _textureId9; //The id of the texture
GLuint _textureId10; //The id of the texture

GLUquadricObj *quadratic; 
//GLUquadricObj *quadratic1; 

Robot::Robot()
{
	armAngles[LEFT] = 0.0;
	armAngles[RIGHT] = 0.0;
	legAngles[LEFT] = 0.0;
	legAngles[RIGHT] = 0.0;
	armStates[LEFT] = FORWARD_STATE;
	armStates[RIGHT] = BACKWARD_STATE;
	legStates[LEFT] = FORWARD_STATE;
	legStates[RIGHT] = BACKWARD_STATE;
}
Robot::~Robot()
{
}
Robot robot;
#include "robot_function.h"

float screen_w,screen_h;
int main(int argc, char **argv) {

    // Initialize GLUT


    {
    glutInit(&argc, argv);
    glutInitDisplayMode(GLUT_DOUBLE | GLUT_RGB | GLUT_DEPTH);

    int w = glutGet(GLUT_SCREEN_WIDTH);
    int h = glutGet(GLUT_SCREEN_HEIGHT);
    int windowWidth = w * 2 / 3;
    int windowHeight = h * 2 / 3;
	
    screen_w=(float)w;
    screen_h=(float)h;

    glutInitWindowSize(windowWidth, windowHeight);
    glutInitWindowPosition((w - windowWidth) / 2, (h - windowHeight) / 2);

    glutCreateWindow("CSE251_sampleCode");  // Setup the window
    initRendering();
    glutDisplayFunc(drawScene);
    glutIdleFunc(drawScene);
    glutKeyboardFunc(handleKeypress1);
    glutSpecialFunc(handleKeypress2);
    glutSpecialUpFunc(set_special_key_up);
    glutMouseFunc(handleMouseclick);
    glutMotionFunc(handleMousemotion);
    glutReshapeFunc(handleResize);
    glutTimerFunc(0, update, 0);
    int i;
    rep(i,4)
	    special_key[i]=0;
    initialiser();
    glutMainLoop();
    }
    return 0;
}
void drawScene()
{

    glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);
    glMatrixMode(GL_MODELVIEW);
    glLoadIdentity();

	if(robot_x>20 && robot_x<40 && robot_z<-600 && robot_z>-620)
	{
		robot_x=-10;
		robot_z=-1050;
		speed_robot=0;
	}

    if(game==0)
    {
    GLfloat ambientColor[] = {0.3,0.3,0.3,1.0f}; //Color (0.2, 0.2, 0.2)
	    
    
    glLightModelfv(GL_LIGHT_MODEL_AMBIENT, ambientColor);

    //Add positioned light
    GLfloat lightColor0[] = {0.5f, 0.5f, 0.5f, 1.0f}; //Color (0.5, 0.5, 0.5)
    GLfloat lightPos0[] = {0.0f, 10.0f, -10.0f, 1.0f}; //Positioned at (4, 0, 8)
    
    
    glLightfv(GL_LIGHT0, GL_DIFFUSE, lightColor0);
    glLightfv(GL_LIGHT0, GL_POSITION, lightPos0);

    if(light_mode==1)
    {
	glEnable(GL_LIGHTING); //Enable lighting
	glEnable(GL_LIGHT0); //Enable light #0
	glEnable(GL_NORMALIZE);
    }

    score_time++;
   if(has_magnet>0)
	   has_magnet--;

   if(cam!=5)
   {
   cam5_x=present_box_i;
   cam5_z=present_box_j;
   }
   if(cam==1)
   {
	   cam3_once=0;
	position1_x=robot_x-40*cos(DEG2RAD(robot_angle));
	position1_y=robot_y+15.0;
	position1_z=robot_z+40*sin(DEG2RAD(robot_angle));

	position2_x=robot_x+20*cos(DEG2RAD(robot_angle));
	position2_y=robot_y+15.0;
	position2_z=robot_z-20*sin(DEG2RAD(robot_angle));
   
   }
   if(cam==2)
   {
	   cam3_once=0;
	position1_x=robot_x+11*cos(DEG2RAD(robot_angle));
	position1_y=robot_y+15.0;
	position1_z=robot_z-11*sin(DEG2RAD(robot_angle));
   
	position2_x=robot_x+12*cos(DEG2RAD(robot_angle));
	position2_y=robot_y+15.0;
	position2_z=robot_z-12*sin(DEG2RAD(robot_angle));
   }
    if(cam==3)
    {
	if(cam3_once==0)
	{
		cam3_once=1;
		position_x=robot_x-40*cos(DEG2RAD(robot_angle));
		position_y=robot_y+15.0;
		position_z=robot_z+40*sin(DEG2RAD(robot_angle));
	}
	position1_x=position_x;
	position1_y=position_y;
	position1_z=position_z;

	position2_x=robot_x;
	position2_y=robot_y+15.0;
	position2_z=robot_z;
    }
    if(cam==4)
    {
	   cam3_once=0;
    	position1_x=tower_x;
	position1_y=tower_y;
	position1_z=tower_z;
	position2_x=60.00;
	position2_y=0.00;
	position2_z=-60.00;
    }
    if(cam==5)
    {
	   cam3_once=0;
    	position1_x=2*boxes[cam5_x][cam5_z].x;
    	position1_y=2*boxes[cam5_x][cam5_z].y+2.0;
    	position1_z=2*boxes[cam5_x][cam5_z].z;
    	
	position2_x=2*boxes[cam5_x][cam5_z].x + 10*cos(DEG2RAD(cam5_angle));
    	position2_y=position1_y;
    	position2_z=2*boxes[cam5_x][cam5_z].z - 10*sin(DEG2RAD(cam5_angle));
    }
    gluLookAt(position1_x, position1_y,position1_z, position2_x, position2_y, position2_z, 0.0, 1.0, 0.0);
    glPushMatrix();
    
    
    lyf-=speed_robot;
    
//    glPushMatrix();
  //  glTranslatef(0.0,3.0,-10.0);
   // glutSolidSphere(-1.0,10,10);
    //glPopMatrix();

    if(present_box_j==num_of_boxes_z-1)
    {
//	    printf("yaha\n");
    	if(floor_robot_y==robot_y)
		game=1;
	else
		game=50;
    }

    if(lyf<=20)
	    game=50;
    speed_y-=gravity;
   // if(swimming_mode==0)
	    drawFloor();
    robot_x+=speed_robot*cos(DEG2RAD(robot_angle));
    robot_z-=speed_robot*sin(DEG2RAD(robot_angle));
    int i,j;
    rep(i,num_of_boxes_x)
    {
    	rep(j,num_of_boxes_z)
	{
		if(boxes[i][j].move==2)
		{
if(square(robot_x+2*speed_robot*cos(DEG2RAD(robot_angle))-boxes[i][j].x*2.0)+square(robot_z-2*speed_robot*sin(DEG2RAD(robot_angle))-boxes[i][j].z*2.0)<=200 && robot_y<boxes[i][j].y)
{
	if(lyf>5)
		lyf-=5;
    robot_x-=speed_robot*cos(DEG2RAD(robot_angle));
    robot_z+=speed_robot*sin(DEG2RAD(robot_angle));
}
		}

		if(boxes[i][j].move==1 || boxes[i][j].move==-1)
		{
if(square(robot_x+2*speed_robot*cos(DEG2RAD(robot_angle))-boxes[i][j].x*2.0)+square(robot_z-2*speed_robot*sin(DEG2RAD(robot_angle))-boxes[i][j].z*2.0)<=200 && robot_y<boxes[i][j].y)
{
	if(lyf>5)
		lyf-=5;
    robot_x-=speed_robot*cos(DEG2RAD(robot_angle));
    robot_z+=speed_robot*sin(DEG2RAD(robot_angle));
}
		}
	}
    }

if(boxes[present_box_i][present_box_j].move==-2 && robot_y==floor_robot_y)
{	
	game=50;
}
//	handleKeypress1(27,1,1);

if(robot_y>floor_robot_y+3.0 || speed_y>0)
{
	robot_y+=speed_y;
	if((speed_y)<-1.0 && robot_y<-0.5)
		game=50;
//	handleKeypress1(27,1,1);

	if(lyf>20)
		lyf-=20;
}
else
{
	if(-robot_y+floor_robot_y<=2.0)
	{
		if(boxes[present_box_i][present_box_j].move==3)
		{
			robot_y=3.01;
			speed_y=-speed_y;
		}
		else
		{
		robot_y=floor_robot_y;
		speed_y=0;
		}

	//	robot_y=3.01;
	//	speed_y=-speed_y;
	//	printf("here speed_y=%f\n",speed_y);
	}
	else
	{
		game=50;
	//	handleKeypress1(27,1,1);
	}
}
    if(floor_robot_y==robot_y)
	    robot_motion=1;
    else
	    robot_motion=0;
    glPushMatrix();
    robot.DrawRobot(robot_x,robot_y+12.0,robot_z);
    
    drawCoins();
    drawNos();
    drawBackground();
    drawMagnets();
    glPopMatrix();
    glPopMatrix();
    detectCollision();
    handle_movement();
    drawMenu();
    if(light_mode==1)
     {
	glDisable(GL_LIGHTING); //Enable lighting
	glDisable(GL_LIGHT0); //Enable light #0
	glDisable(GL_NORMALIZE);}
    }
   if(game<0)
	{
		glPushMatrix();
		glTranslatef(-10.0,5.0,-40.0);
		glRotatef(initial_rotation--,0,1,0);
    		robot.DrawRobot(0,0,0);
		glPopMatrix();
		drawMenu();
	}
if(game>0)
{glPushMatrix();
		glTranslatef(-10.0,5.0,-40.0);
		glRotatef(initial_rotation--,0,1,0);
    		robot.DrawRobot(0,0,0);
		glPopMatrix();
		drawMenu();
}
    glutSwapBuffers();
}
void drawBackground()
{
	
			glEnable(GL_TEXTURE_2D);
			glBindTexture(GL_TEXTURE_2D, _textureId1);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_NEAREST);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_NEAREST);
			int i,j;
			glColor3f(0.0,0.0,0.8);
			float h=-20.0;
			for(j=-10000;j<10000;j+=100)
			{
				for(i=2000;i>-10000;i-=100)
				{
				glBegin(GL_QUADS);
				glTexCoord2f(0.0f, 0.0f);
				glVertex3f(j,h,i);
				glTexCoord2f(1.0f, 0.0f);
				glVertex3f(j,h,i-100);
				glTexCoord2f(1.0f, 1.0f);
				glVertex3f(j+100,h,i-100);
				glTexCoord2f(0.0f, 1.0f);
				glVertex3f(j+100,h,i);
				glEnd();
			}
			}
			glDisable(GL_TEXTURE_2D);
}
char* itoa(int a)
{
	char string[100];
	int b=a,count=0,i;
	if(a==0)
	{
		string[0]='0';
		string[1]='\0';
		return string;
	}
	while(b!=0)
	{
		count++;
		b/=10;
	}
	rep(i,count)
	{
		string[i]=((int)(a/pow(10,count-1-i))%10)+'0';	
	}
	string[i]='\0';
	return string;
}
void setOrthographicProjection()
{
	int w=screen_w,h=screen_h;
	glMatrixMode(GL_PROJECTION);
	glPushMatrix();
	glLoadIdentity();
	gluOrtho2D(0, w, 0, h);
	glScalef(1, -1, 1);
	glTranslatef(0, -h, 0);
	glMatrixMode(GL_MODELVIEW);
}
void resetPerspectiveProjection()
{
	glMatrixMode(GL_PROJECTION);
	glPopMatrix();
	glMatrixMode(GL_MODELVIEW);
}
/*
void showText(void)
{
	frame++;
	timeOwn=glutGet(GLUT_ELAPSED_TIME);
	if (timeOwn - timebase > 1000)
	{
		sprintf(s,"FPS:%4.2f",frame*1000.0/(timeOwn-timebase));
		timebase = timeOwn;
		frame = 0;
	}
	glColor3f(0.0f,1.0f,1.0f);
	setOrthographicProjection();
	glPushMatrix();
	glLoadIdentity();
	renderBitmapString(30,15,(void *)font,"Arrow keys for camera");
	renderBitmapString(30,55,(void *)font,s);
	renderBitmapString(30,85,(void *)font,"w,a,s,d to drive the robot");
	renderBitmapString(30,125,(void *)font,"Esc - Quit");
	glPopMatrix();
	resetPerspectiveProjection();
}

void renderBitmapString(float x, float y, void *font,char *string)
{
	char *c;
	glRasterPos2f(x, y);
	for (c=string; *c != '\0'; c++) {
		glutBitmapCharacter(font, *c);
	}
}*/
void newgame()
{
initialiser();
initial_rotation=180;
light_mode=-1;
cam=1;
cam3_once=0;
cam3_angle=90;
cam3_motion=0;
cam3_flag=0;
cam5_x=0;
cam5_z=0;
cam5_angle=90;
mouse_x_max=0;
mouse_y_max=0;

floor_once=0;
robot_motion=0;
test=0;
flag=1;
lyf=5000;


score_coin=0;
score_time=0;

position_x=0.0;
position_y=10.0;
position_z=10.00;

position2_x=0.0;
position2_y=10.0;
position2_z=10.00;

position1_x=0.0;
position1_y=10.0;
position1_z=10.00;

rotation=0.00;
factor=1.0;
level=1;

coin_once=0;
has_magnet=0;
 boost=1;

robot_x=-2*(num_of_boxes_x*box_width)/2 + box_width/2.0;
robot_y=0.0;
robot_z=0.0;
speed_robot=0.0;

max_speed=5;
speed_x=speed_robot;
speed_y=0.0;
speed_z=speed_robot;
gravity=0.098;

//int mode_jump=0;
jump_counter=0;
new_jump_counter=100;
jump_robot_y=0.0;
floor_robot_y=0.0;
robot_angle=90.0;

present_box_i=0,present_box_j=0;

		
}
void drawMenu()
{
	
	glColor3f(0.0f,1.0f,1.0f);
	setOrthographicProjection();
	glPushMatrix();
	glLoadIdentity();
	glColor3f(0.85f,0.85f,0.85f);
	char string[100];
	char menu[50][100];
	int menu_counter=0;
		if(game==-1)
		{

		if(menu_mode==0)
		{
		menu_counter=5;
		strcpy(menu[0],"Resume");
		strcpy(menu[1],"Newgame");
		strcpy(menu[2],"Instructions");
		strcpy(menu[3],"Quit");
		strcpy(menu[4],"@mach18, @parin");
		int j;
		for(j=0;j<menu_counter;j++)
		{   
			if(j!=menu_counter-1)glRasterPos2f(700,90+40*j); 
			else glRasterPos2f(950,700);
			strcpy(string,menu[j]);
			int len,i;
			len = (int)strlen(menu[j]);
			for (i = 0; i < len; i++) {
				glutBitmapCharacter(GLUT_BITMAP_TIMES_ROMAN_24, menu[j][i]);
			}  
		}
		}
			
		//}
		if(menu_mode==3)
		{
		menu_counter=10;
		strcpy(menu[0],"Island Runner");
		strcpy(menu[1],"Instruction");
		strcpy(menu[2],"Robot-Arrow Keys");
		strcpy(menu[3],"Change Camera-c");
		strcpy(menu[4],"Jump-Space/j");
		strcpy(menu[5],"Helicopter Cam-Mouse/q,e,w,s,a,d");
		strcpy(menu[6],"Tile Cam-r,y,t,g,f,h");
		strcpy(menu[7],"Nos/Coins/Magnets-Move over them");
		strcpy(menu[8],"Press ENTER to START the game");
		strcpy(menu[9],"@mach18, @parin");
		int j;
		//strcpy(menu[1],itoa(score_coin));
		//strcpy(menu[2],itoa(score_time));
		//strcpy(menu[3],itoa((score_coin*10000)/score_time));
		for(j=0;j<menu_counter;j++)
		{   
			if(j!=menu_counter-1)glRasterPos2f(700,90+40*j); 
			else glRasterPos2f(950,700);
			strcpy(string,menu[j]);
			int len,i;
			len = (int)strlen(menu[j]);
			for (i = 0; i < len; i++) {
				glutBitmapCharacter(GLUT_BITMAP_TIMES_ROMAN_24, menu[j][i]);
			}  
		}
		}
		if(menu_mode==2)
		{

		}
		}
		if(game==0)
		{
			menu_counter=6;
			int j;
			strcpy(menu[0],"Coins - ");
			strcpy(menu[1],itoa(score_coin));
			strcpy(menu[2]," Score - ");
			strcpy(menu[3],itoa((int)(square((float)score_coin)*100000/score_time)+score_time));
			strcpy(menu[4]," Timer - ");
			strcpy(menu[5],itoa((int)score_time));
			//strcpy(menu[3],itoa((score_coin*10000)/score_time));
			for(j=0;j<menu_counter;j++)
			{    
				if(j==0)
					glRasterPos2f(30,35);
				if(j==menu_counter-2) 
					glRasterPos2f(1000,35);
				strcpy(string,menu[j]);
				int len,i;
				len = (int)strlen(menu[j]);
				for (i = 0; i < len; i++) {
					glutBitmapCharacter(GLUT_BITMAP_TIMES_ROMAN_24, menu[j][i]);
				}    
			}    

			glPushMatrix();
			glLineWidth(15.0f);
			float magnet_var;
			magnet_var=has_magnet>400?400.00:(float)has_magnet;
			glBegin(GL_LINES);
			glColor3f(1.0,0.0,0.0);
			glVertex3f(150.0f,700.0f-(float)magnet_var,1.0f);
			glVertex3f(150.0f,700.0f,1.0f);
			glEnd();
			glBegin(GL_LINES);
			glColor3f(0.0,0.0,0.0);
			glVertex3f(150.0f,300.0f,1.0f);
			glVertex3f(150.0f,700-(float)magnet_var,1.0f);
			glEnd();
			glPopMatrix();

			glPushMatrix();
			magnet_var=lyf>5000?5000.00:(float)lyf;
			magnet_var=(magnet_var*400)/5000;
			glBegin(GL_LINES);
			glColor3f(0.0,1.0,0.0);
			glVertex3f(120.0f,700.0f-(float)magnet_var,1.0f);
			glVertex3f(120.0f,700.0f,1.0f);
			glEnd();
			glBegin(GL_LINES);
			glColor3f(0.0,0.0,0.0);
			glVertex3f(120.0f,300.0f,1.0f);
			glVertex3f(120.0f,700-(float)magnet_var,1.0f);
			glEnd();
			glPopMatrix();

			glPushMatrix();
			glScalef(0.5f,0.5f,0.5f);
			glTranslatef(670.0f,0.0f,0.0f);
			glPushMatrix();
			glBegin(GL_LINES);
			float angle_speedometer=(9.0-speed_robot)*40.0;
			angle_speedometer=((360.0-angle_speedometer)/1.5)-40.0;
			glColor3f(1.0,1.0,0.0);
			glVertex3f(670.0f-100*cos(DEG2RAD(angle_speedometer)),150.0f-100*sin(DEG2RAD(angle_speedometer)),1.0f);
			glVertex3f(670.0f,150.0f,1.0f);
			glEnd();
			glPopMatrix();


			glEnable(GL_TEXTURE_2D);
			glBindTexture(GL_TEXTURE_2D, _textureId9);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_NEAREST);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_NEAREST);
			glBegin(GL_QUADS);
			glColor3f(1.0,1.0,1.0);
			glTexCoord2f(0.0f, 0.0f);
			glVertex3f(500.0f,280.0f,1.0f);
			glTexCoord2f(1.0f, 0.0f);
			glVertex3f(840.0f,280.0f,1.0f);
			glTexCoord2f(1.0f, 1.0f);
			glVertex3f(840.0f,30.0f,1.0f);
			glTexCoord2f(0.0f, 1.0f);
			glVertex3f(500.0f,30.0f,1.0f);
			glEnd();
			glDisable(GL_TEXTURE_2D);

			glPopMatrix();


			glPushMatrix();
			glTranslatef(685.0f,300.0f,1.0f);
			glScalef(10,15,15);
			glColor3f(0.64,0.39,0.92);
			glRotatef(robot_angle-90,0,0,1);
			glBegin(GL_TRIANGLE_FAN);
			glVertex3f(0,-2,0);
			glVertex3f(-2,0,0);
			glVertex3f(-1,0,0);
			glVertex3f(-1,2,0);
			glVertex3f(1,2,0);
			glVertex3f(1,0,0);
			glVertex3f(2,0,0);
			glEnd();
			glPopMatrix();


			glLineWidth(1.0f);

		}
		if(game>0)
		{
			menu_counter=8;
			strcpy(menu[0],"GAME OVER");
			if(game==1)
			{
				strcpy(menu[1],"Congrates");
				strcpy(menu[2],"Finished LEVEL1");
				strcpy(menu[3],"LEVEL2 In progress");
				strcpy(menu[4],"Coins-");
				strcat(menu[4],itoa(score_coin));
				strcpy(menu[5],"Score-");
				strcat(menu[5],itoa((int)(square((float)score_coin)*100000/score_time)+score_time));
				strcpy(menu[6],"Timer-");
				strcat(menu[6],itoa((int)score_time));
				strcpy(menu[7],"@mach18, @parin");
			}
			else
			{
				strcpy(menu[1],"You Lost");
				strcpy(menu[2],"complete LEVEL1");
				strcpy(menu[3],"LEVEL2 In progress");
				strcpy(menu[4],"Coins-");
				strcat(menu[4],itoa(score_coin));
				strcpy(menu[5],"Score-");
				strcat(menu[5],itoa((int)(square((float)score_coin)*100000/score_time)+score_time));
				strcpy(menu[6],"Timer-");
				strcat(menu[6],itoa((int)score_time));
				strcpy(menu[7],"@mach18, @parin");
			}
			int j;
			//strcpy(menu[1],itoa(score_coin));
			//strcpy(menu[2],itoa(score_time));
			//strcpy(menu[3],itoa((score_coin*10000)/score_time));
			for(j=0;j<menu_counter;j++)
			{
				if(j!=menu_counter-1)glRasterPos2f(700,90+40*j);
				else glRasterPos2f(950,700);
				strcpy(string,menu[j]);
				int len,i;
				len = (int)strlen(menu[j]);
				for (i = 0; i < len; i++) {
					glutBitmapCharacter(GLUT_BITMAP_TIMES_ROMAN_24, menu[j][i]);
				}
			}

		
		}
	glPopMatrix();
	resetPerspectiveProjection();
}
void initialiser()  
{
//
int i;
	int j;
	rep(i,num_of_coins)
	{
		float x=(rand()%(int)((num_of_boxes_x*box_width))-(num_of_boxes_x*box_width/2));
		float z=2*(rand()%(int)(num_of_boxes_z*box_len));
		float angle=rand()%360;
		coins[i].type=rand()%types_of_coin;
		coins[i].x=x;
		coins[i].z=-z;
		coins[i].y=0.0;
		coins[i].angle=angle;
		coins[i].show=1;

	}
	rep(i,num_of_Noss)
	{
		float x=(rand()%(int)((num_of_boxes_x*box_width))-(num_of_boxes_x*box_width/2));
		float z=2*(rand()%(int)(num_of_boxes_z*box_len));
		float angle=rand()%360;
		Noss[i].x=x;
		Noss[i].z=-z;
		Noss[i].y=0.0;
		Noss[i].angle=angle;
		Noss[i].show=1;
	}
	rep(i,num_of_magnets)
	{
		float x=2*(rand()%(int)((num_of_boxes_x*box_width))-(num_of_boxes_x*box_width/2));
		float z=2*(rand()%(int)(num_of_boxes_z*box_len));
		float angle=rand()%360;
		magnets[i].x=x;
		magnets[i].z=-z;
		magnets[i].y=0.0;
		magnets[i].angle=angle;
		magnets[i].show=1;
	}
//	rep(i)
	rep(i,num_of_boxes_x)
	{
		rep(j,num_of_boxes_z)
		{
			once[i][j]=0;
			int decide=rand()%60;
			if(j<3)
				decide=0;

			boxes[i][j].move=0;
			if(decide==30)
			boxes[i][j].move=1;
			if(decide==31 )
			boxes[i][j].move=-1;
			if(decide==32 || decide==34)
			boxes[i][j].move=-2;
			if(decide==33 || decide==35)
			boxes[i][j].move=2;
			if(decide==36)
			{
				boxes[i][j].move=3;
				//printf("%d %d\n",i,j);
			}
			if(decide==37)
			{
				boxes[i][j].move=4;
			}


			//float shift=0.0;
				
			boxes[i][j].x=(float)(box_width*(i-num_of_boxes_x/2.00)+box_width/2.0);
			if(boxes[i][j].move==0 || boxes[i][j].move==3 || boxes[i][j].move==4)
			{
				boxes[i][j].y=0;
			}
			else
			{
				if(boxes[i][j].move==-2 || boxes[i][j].move==2)
					boxes[i][j].y=(5.0*boxes[i][j].move)/2.0;
				else
				{
					float initial_height=rand()%21;
					boxes[i][j].y=(initial_height-10.00)*0.5;
				}
			}
			boxes[i][j].z=(float)(-1.0*(box_len*j+box_len/2.0));
//	printf("initialise %d %d %f %f \n",i,j,boxes[i][j].x,boxes[i][j].z);

		}
	}

}
void detectCollision()
{


	present_box_i=((robot_x + (box_width*num_of_boxes_x))/box_width)/2;
	present_box_j=-1*((robot_z/box_len)/2);
	once[present_box_i][present_box_j]=1;
	
	//printf("%d %d\n",present_box_i,present_box_j);
if((robot_x<-(num_of_boxes_x*box_width) || robot_x>(num_of_boxes_x*box_width))||((robot_z<-2*(num_of_boxes_z*box_len) || robot_z>5)))
	{	
		handleKeypress1(27,1,1);
		game=50;
		//swimming_mode=1;
	}
	int i;
	rep(i,num_of_coins)
	{
		if(coins[i].show==1)
		{
		if(has_magnet>0)
		{
		if((square(coins[i].x-robot_x)+square(coins[i].z-robot_z))<625)
		{
			coins[i].show=0;
			lyf+=500;
		}
		}
		else
		{
		if((square(coins[i].x-robot_x)+square(coins[i].z-robot_z))<25)
		{
			coins[i].show=0;
			lyf+=500;
		}
		}
		}

	}
	rep(i,num_of_Noss)
	{
		if(Noss[i].show==1)
		{
		if((square(Noss[i].x-robot_x)+square(Noss[i].z-robot_z))<25)
		{
			Noss[i].show=0;
			speed_robot+=4;
			if(speed_robot>9.0)
				speed_robot=9.0;
		}	
		}
	}
	rep(i,num_of_magnets)
	{
		if(magnets[i].show==1)
		{
		if((square(magnets[i].x-robot_x)+square(magnets[i].z-robot_z))<25)
		{
			magnets[i].show=0;
			has_magnet+=400;
		}	
		}
	}
}
void drawFlag()
{
	int i,j;
	glPushMatrix();
	glTranslatef(box_width*num_of_boxes_x/2,10,-10);
//	glTranslatef(0,10,-10);
	for(j=10;j<100;j+=3)
	{
	float prev=-1;
	for(i=0;i<200;i+=30)
	{
			float next=(float)i;
			glBegin(GL_LINES);
			glVertex3f(prev/10.0,(float)j/10.0,sin(DEG2RAD(prev*2)));
			glVertex3f(next/10.0,(float)j/10.0,sin(DEG2RAD(next*2)));
			glEnd();
			prev=next;
		
	}
	}
	glPopMatrix();
}
void drawCircle(int type_of_coin)
{
			glEnable(GL_TEXTURE_2D);
			glColor3f(1.0,1.0,1.0);
			if(type_of_coin==0)
				glBindTexture(GL_TEXTURE_2D, _textureId4);
			if(type_of_coin==1)
				glBindTexture(GL_TEXTURE_2D, _textureId5);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_NEAREST);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_NEAREST);
		glPushMatrix();
		gluDisk(quadratic,0.0f,2.0f,100,100);
		gluCylinder(quadratic,2.0f,2.0f,0.8,100,100);
		glTranslatef(0.0,0.0,0.8);
		gluDisk(quadratic,0.0f,2.0f,100,100);
		glPopMatrix();
		glDisable(GL_TEXTURE_2D);
}
void drawMagnet()
{
	glBegin(GL_POLYGON);
	glVertex3f(0.0f, 0.0f, 0.0f);	// top face
	glVertex3f(0.0f, 0.0f, -1.0f);
	glVertex3f(-1.0f, 0.0f, -1.0f);
	glVertex3f(-1.0f, 0.0f, 0.0f);
	glVertex3f(0.0f, 0.0f, 0.0f);	// front face
	glVertex3f(-1.0f, 0.0f, 0.0f);
	glVertex3f(-1.0f, -1.0f, 0.0f);
	glVertex3f(0.0f, -1.0f, 0.0f);
	glVertex3f(0.0f, 0.0f, 0.0f);	// right face
	glVertex3f(0.0f, -1.0f, 0.0f);
	glVertex3f(0.0f, -1.0f, -1.0f);
	glVertex3f(0.0f, 0.0f, -1.0f);
	glVertex3f(-1.0f, 0.0f, 0.0f);	// left face
	glVertex3f(-1.0f, 0.0f, -1.0f);
	glVertex3f(-1.0f, -1.0f, -1.0f);
	glVertex3f(-1.0f, -1.0f, 0.0f);
	glVertex3f(0.0f, 0.0f, 0.0f);	// bottom face
	glVertex3f(0.0f, -1.0f, -1.0f);
	glVertex3f(-1.0f, -1.0f, -1.0f);
	glVertex3f(-1.0f, -1.0f, 0.0f);
	glVertex3f(0.0f, 0.0f, 0.0f);	// back face
	glVertex3f(-1.0f, 0.0f, -1.0f);
	glVertex3f(-1.0f, -1.0f, -1.0f);
	glVertex3f(0.0f, -1.0f, -1.0f);
	glEnd();
	
}
void drawMagnets()
{
	int i;
	rep(i,num_of_magnets)
	{
		if(magnets[i].show==1)
		{
		
		float x=magnets[i].x;
		float y=magnets[i].y;
		float z=magnets[i].z;
		float angle=magnets[i].angle;
		magnets[i].angle+=5;
		if(z-20*box_len < robot_z && robot_z<z+20*box_len)
		{
		glPushMatrix();
		glTranslatef(x,y+6.0,z);
		glRotatef(angle,0,1,0);
			
			glPushMatrix();
			glColor3f(1,0,0);
			glTranslatef(-1.0,0.0,0.0);
			glScalef(1.5,2.5,1.5);
			drawMagnet();

			glPopMatrix();
			
			glPushMatrix();
			glTranslatef(-1.0,-2.5,0.0);
			glColor3f(0,0,0);
			glScalef(1.5,2,1.5);
			drawMagnet();
			glPopMatrix();
			

			glPushMatrix();
			glColor3f(1,0,0);
			glTranslatef(1.0,1.0,0.0);
			glScalef(3.5,1,1.5);
			drawMagnet();
			glPopMatrix();

			glPushMatrix();
			glColor3f(1,0,0);
			glTranslatef(1.0,0.0,0.0);
			glScalef(1.5,2.5,1.5);
			drawMagnet();
			glPopMatrix();
			
			glPushMatrix();
			glTranslatef(1.0,-2.5,0.0);
			glColor3f(0,0,0);
			glScalef(1.5,2,1.5);
			drawMagnet();
			glPopMatrix();
		glPopMatrix();
		}
		}
	}
}
void draw_Nos()
{
	//glEnable(GL_TEXTURE_2D);
	glColor3f(1.0,1.0,1.0);
	
		glPushMatrix();
		glRotatef(-90.0,1.0f,0.0f,0.0f);
		gluDisk(quadratic,0.0f,2.0f,100,100);
	glEnable(GL_TEXTURE_2D);
	glBindTexture(GL_TEXTURE_2D, _textureId6);
	glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_NEAREST);
	glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_NEAREST);
		gluCylinder(quadratic,2.0f,2.0f,6.0,100,100);
	glDisable(GL_TEXTURE_2D);
		glTranslatef(0.0,0.0,6.0);
		gluDisk(quadratic,0.0f,2.0f,100,100);
		glPopMatrix();
	
}
void drawNos()
{
	int i;
	//int count=0;
	rep(i,num_of_Noss)
	{
		if(Noss[i].show==1)
		{
		float x=Noss[i].x;
		float y=Noss[i].y;
		float z=Noss[i].z;
		float angle=Noss[i].angle;
		Noss[i].angle+=5;
		
		if(z-20*box_len < robot_z && robot_z<z+20*box_len)
		{
		glPushMatrix();
		glTranslatef(x,y+4.0,z);
		glRotatef(angle,0,1,0);
		draw_Nos();
		glPopMatrix();
		}
		}
	}
}
void drawCoins()
{
	int i;
	int count=0;
	rep(i,num_of_coins)
	{
		if(coins[i].show==1)
		{
		count++;
		float x=coins[i].x;
		float y=coins[i].y;
		float z=coins[i].z;
		float angle=coins[i].angle;
		coins[i].angle+=5;
		
		if(z-20*box_len < robot_z && robot_z<z+20*box_len)
		{
		glPushMatrix();
		glTranslatef(x,y+4.0,z);
		glRotatef(angle,0,1,0);
		drawCircle(coins[i].type);
		glPopMatrix();
		}
		}
	}
	score_coin=num_of_coins-count;
	//printf("%d %d\n",score_coin,score_time);
}
void drawCuboid(float X,float Y,float Z,int move)
{

			/*if(X>-(num_of_boxes_x*box_width)/3.0 && X<(box_width*num_of_boxes_x)/3.0)
			{	
				if(mod((robot_x)/2.0-X)<box_width/2 && mod((robot_z)/2.0-Z)<box_len/2)
					floor_robot_y=-20.0;
				//floor_robot_y=2*boxes[present_box_i][present_box_j].y;
				return;
			}
			*/
			float shift_x=box_width*1.0;
			float shift_z=box_len*1.0;

			if(mod((robot_x)/2.0-X)<box_width/2 && mod((robot_z)/2.0-Z)<box_len/2)
			{
			floor_robot_y=2*boxes[present_box_i][present_box_j].y;
		//		floor_robot_y=2*Y;			
			}
			float var=10.0+2*Y;
			glColor3f(0.0,0.0,0.0);
			glPushMatrix();
			glTranslatef(0.0,0.1,0.0);
			if(2*Z-20*box_len < robot_z && robot_z<2*Z+20*box_len)
			{
		//	if(boxes[cam5_x][cam5_z].x==X && boxes[cam5_x][cam5_z].z==Z)
			
			{
		/*	glLineWidth(1.00);
			glBegin(GL_LINES);
			glVertex3f(X-shift_x,Y,Z+shift_z);
			glVertex3f(X-shift_x,Y,Z-shift_z);
			
			glVertex3f(X-shift_x,Y,Z-shift_z);
			glVertex3f(X+shift_x,Y,Z-shift_z);
			
			glVertex3f(X+shift_x,Y,Z-shift_z);
			glVertex3f(X+shift_x,Y,Z+shift_z);
			
			glVertex3f(X+shift_x,Y,Z+shift_z);
			glVertex3f(X-shift_x,Y,Z+shift_z);
			glEnd();
		*/	glLineWidth(1.00);
			}
			}
			glPopMatrix();
		

			int loop_i=((2*X+ (box_width*num_of_boxes_x))/box_width)/2;
			int loop_j=-1*((2*Z/box_len)/2);


			glEnable(GL_TEXTURE_2D);
		if(boxes[loop_i][loop_j].x>10 && boxes[loop_i][loop_j].x<20 && boxes[loop_i][loop_j].z<-300 && boxes[loop_i][loop_j].z>-310)
				glBindTexture(GL_TEXTURE_2D, _textureId10);

		else
		{
			if(boxes[loop_i][loop_j].move==3)
			glBindTexture(GL_TEXTURE_2D, _textureId7);
			else
			{

				
				if(boxes[loop_i][loop_j].move==4)
				glBindTexture(GL_TEXTURE_2D, _textureId8);
				else
				glBindTexture(GL_TEXTURE_2D, _textureId);

			}
		}
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_NEAREST);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_NEAREST);

			if((2*Z-20*box_len < robot_z && robot_z<2*Z+20*box_len) || cam==4)
			{
			if(move==-2)
			glColor3f(0.0,1.0,1.0);
			else
			glColor3f(1.0,1.0,1.0);

			glBegin(GL_QUADS);


			glTexCoord2f(0.0f, 0.0f);
			glVertex3f(X-shift_x,Y,Z-shift_z);
			glTexCoord2f(1.0f, 0.0f);
			glVertex3f(X+shift_x,Y,Z-shift_z);
			glTexCoord2f(1.0f, 1.0f);
			glVertex3f(X+shift_x,Y,Z+shift_z);
			glTexCoord2f(0.0f, 1.0f);
			glVertex3f(X-shift_x,Y,Z+shift_z);
			glEnd();
			
			//glEnable(GL_TEXTURE_2D);
			glBindTexture(GL_TEXTURE_2D, _textureId2);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_NEAREST);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_NEAREST);


			glBegin(GL_QUADS);
			glNormal3f(0.0,1.0,0.0);
			glTexCoord2f(0.0f, 0.0f);
			glVertex3f(X-shift_x,Y-var,Z-shift_z);
			glTexCoord2f(1.0f, 0.0f);
			glVertex3f(X+shift_x,Y-var,Z-shift_z);
			glTexCoord2f(1.0f, 1.0f);
			glVertex3f(X+shift_x,Y-var,Z+shift_z);
			glTexCoord2f(0.0f, 1.0f);
			glVertex3f(X-shift_x,Y-var,Z+shift_z);

			glTexCoord2f(0.0f, 0.0f);
			glVertex3f(X-shift_x,Y,Z+shift_z);
			glTexCoord2f(1.0f, 0.0f);
			glVertex3f(X-shift_x,Y-var,Z+shift_z);
			glTexCoord2f(1.0f, 1.0f);
			glVertex3f(X-shift_x,Y-var,Z-shift_z);
			glTexCoord2f(0.0f, 1.0f);
			glVertex3f(X-shift_x,Y,Z-shift_z);


			glTexCoord2f(0.0f, 0.0f);
			glVertex3f(X+shift_x,Y,Z+shift_z);
			glTexCoord2f(1.0f, 0.0f);
			glVertex3f(X+shift_x,Y-var,Z+shift_z);
			glTexCoord2f(1.0f, 1.0f);
			glVertex3f(X+shift_x,Y-var,Z-shift_z);
			glTexCoord2f(0.0f, 1.0f);
			glVertex3f(X+shift_x,Y,Z-shift_z);
			
			
			glTexCoord2f(0.0f, 0.0f);
			glVertex3f(X-shift_x,Y,Z+shift_z);
			glTexCoord2f(1.0f, 0.0f);
			glVertex3f(X-shift_x,Y-var,Z+shift_z);
			glTexCoord2f(1.0f, 1.0f);
			glVertex3f(X+shift_x,Y-var,Z+shift_z);
			glTexCoord2f(0.0f, 1.0f);
			glVertex3f(X+shift_x,Y,Z+shift_z);
			
			glTexCoord2f(0.0f, 0.0f);
			glVertex3f(X-shift_x,Y,Z-shift_z);
			glTexCoord2f(1.0f, 0.0f);
			glVertex3f(X-shift_x,Y-var,Z-shift_z);
			glTexCoord2f(1.0f, 1.0f);
			glVertex3f(X+shift_x,Y-var,Z-shift_z);
			glTexCoord2f(0.0f, 1.0f);
			glVertex3f(X+shift_x,Y,Z-shift_z);
			}
			glEnd();

			glDisable(GL_TEXTURE_2D);

}
void drawFloor()
{
	int i,j;
	rep(i,num_of_boxes_x)
	{
		rep(j,num_of_boxes_z)
		{
			//printf("final %d %d %f %f\n",i,j,boxes[i][j].x,boxes[i][j].z);
			if(boxes[i][j].move==1 || boxes[i][j].move==-1)
			{
				if(boxes[i][j].y>5.0)
				{	
					boxes[i][j].move=-1;
				}
				if(boxes[i][j].y<-5.0)
				{	
					boxes[i][j].move=+1;
				}
			
				if(boxes[i][j].move==1)
					boxes[i][j].y+=0.25;
				else
					boxes[i][j].y-=0.25;
			}
			if(boxes[i][j].move==4 && once[i][j]==1)
			{
				if(boxes[i][j].y>-5.0)
				boxes[i][j].y-=0.05;
			}

			float X=boxes[i][j].x;
			float Y=boxes[i][j].y;
			float Z=boxes[i][j].z;
			glPushMatrix();
			glTranslatef(X,Y,Z);
if(i==present_box_i && j==present_box_j && light_mode==1)
{
	glDisable(GL_LIGHTING); //Enable lighting
	glDisable(GL_LIGHT0); //Enable light #0
	glDisable(GL_NORMALIZE);
}
			drawCuboid(X,Y,Z,boxes[i][j].move);
if(i==present_box_i && j==present_box_j && light_mode==1)
{
	glEnable(GL_LIGHTING); //Enable lighting
	glEnable(GL_LIGHT0); //Enable light #0
	glEnable(GL_NORMALIZE);
}
			glColor3f(1.0,1.0,1.0);
			glPopMatrix();
		}
	}

}
void update(int value) {
robot.Prepare(0.1*speed_robot);
glutPostRedisplay();
}
void initRendering() {

	glEnable(GL_DEPTH_TEST);        // Enable objects to be drawn ahead/behind one another
	glEnable(GL_COLOR_MATERIAL);    // Enable coloring
	glClearColor(0.0f, 0.0f, 0.95f, 1.0f);   // Setting a background color

	quadratic=gluNewQuadric();          // Create A Pointer To The Quadric Object ( NEW )
	//quadratic1=gluNewQuadric();          // Create A Pointer To The Quadric Object ( NEW )
	gluQuadricNormals(quadratic, GLU_SMOOTH);   // Create Smooth Normals ( NEW )
	gluQuadricTexture(quadratic, GL_TRUE);  

	Image* image = loadBMP("m.bmp");
	_textureId = loadTexture(image);
	delete image;
	
	Image* image1 = loadBMP("water.bmp");
	_textureId1 = loadTexture(image1);
	delete image1;

	Image* image2 = loadBMP("m1.bmp");
	_textureId2 = loadTexture(image2);
	delete image2;

	Image* image3 = loadBMP("torso.bmp");
	_textureId3 = loadTexture(image3);
	delete image3;
	
	Image* image4 = loadBMP("coin0.bmp");
	_textureId4 = loadTexture(image4);
	delete image4;
	
	Image* image5 = loadBMP("coin1.bmp");
	_textureId5 = loadTexture(image5);
	delete image5;
	
	Image* image6 = loadBMP("Nos.bmp");
	_textureId6 = loadTexture(image6);
	delete image6;
	
	Image* image7 = loadBMP("Spring.bmp");
	_textureId7 = loadTexture(image7);
	delete image7;


	Image* image8 = loadBMP("Crack.bmp");
	_textureId8 = loadTexture(image8);
	delete image8;


	Image* image9 = loadBMP("speedometer.bmp");
	_textureId9 = loadTexture(image9);
	delete image9;
	
	Image* image10 = loadBMP("teleporter.bmp");
	_textureId10 = loadTexture(image10);
	delete image10;
}
void handleResize(int w, int h) {

	glMatrixMode(GL_PROJECTION);
	glViewport(0, 0, w, h);
	glLoadIdentity();
	gluPerspective(45.0f, (float)w / (float)h, 0.1f, -4000.0f);
	glMatrixMode(GL_MODELVIEW);
	glLoadIdentity();
}

void handleKeypress1(unsigned char key, int x, int y) {

	if (key == 27 )
	{
		if(game<=0) 
		{
		game=-1;
		menu_mode=0;
		}
		else
		{
		exit(0);
		}
	}
	if(key=='m')
		has_magnet=20;
	if(key=='c')
	{
		cam++;
		if(cam>cam_count)
			cam=1;
	}
	if(key=='w')
		position_z--;
	if(key=='s')
		position_z++;
	if(key=='d')
		position_x++;
	if(key=='a')
		position_x--;
	if(key=='q')
		position_y--;
	if(key=='e')
		position_y++;
	if(key==32 || key=='j')
	{
		if(speed_y==0)
			speed_y=2.0;


	}
//	if(key==13 && game<0)
//		game=0;
	if(key=='t' && cam5_z<num_of_boxes_z-1)
		cam5_z++;
	if(key=='g' && cam5_z>0)
		cam5_z--;
	if(key=='f' && cam5_x>0)
		cam5_x--;
	if(key=='h' && cam5_x < num_of_boxes_x-1)
		cam5_x++;
	if(key=='r')
		cam5_angle+=5;
	if(key=='y')
		cam5_angle-=5;

	if(key=='l')
	{
		light_mode=-light_mode;
	}


}
void set_special_key_up(int key,int x,int y)
{
if(key==GLUT_KEY_LEFT)special_key[0]=0;
if(key==GLUT_KEY_RIGHT)special_key[1]=0;
if(key==GLUT_KEY_UP)special_key[2]=0;
if(key==GLUT_KEY_DOWN)special_key[3]=0;
}
void handleKeypress2(int key, int x, int y) 
{
if(key==GLUT_KEY_LEFT)special_key[0]=1;
if(key==GLUT_KEY_RIGHT)special_key[1]=1;
if(key==GLUT_KEY_UP)special_key[2]=1;
if(key==GLUT_KEY_DOWN)special_key[3]=1;
}
void handle_movement()
{
update(1.00);
	rotation+=90.0;
	//float s=speed_robot;
	if (special_key[0]==1)
	{
			rotation+=4.0;
			robot_angle+=4.0;
	}
	if (special_key[1]==1)
	{
		rotation-=4.0;
		robot_angle-=4.0;
	}
	if (special_key[2]==1)
	{
		if(speed_robot<max_speed)
			speed_robot+=0.01;
	}
	else
	{
		if(speed_robot>0.0)
			speed_robot-=0.03;
		else
			speed_robot=0;
	}
	if (special_key[3]==1)
	{
		if(speed_robot>0)
		speed_robot-=0.10;
		else
			speed_robot=0;
	}
	rotation-=90.0;
}
void handleMousemotion(int x,int y)
{
	if(cam==3)
	{
	if(cam3_motion%2==1)
	{
	if(cam3_flag==0)
	{
		initial_x=x;
		initial_y=y;
		cam3_flag=1;
	}
	else
	{
		final_x=x;
		final_y=y;
	}
	}
	}

	
}
void handleMouseclick(int button, int state, int x, int y) 
{
	if(button==3 || button==4 || button==5 || button==6)
	{
	if(cam==3)
	{
	if(button==3)
	{	
		position_x+=cos(DEG2RAD(cam3_angle));
		position_z-=sin(DEG2RAD(cam3_angle));
	}
	if(button==4)
	{	position_x-=cos(DEG2RAD(cam3_angle));

		position_z+=sin(DEG2RAD(cam3_angle));
	}	
	}
	}
	else
	{
	if(cam==3)
	{
		if(cam3_motion%2==1)
		{
		if(cam3_flag==1)	
			cam3_angle+=((final_x-initial_x)/1310.00)*90;
		}
		cam3_motion++;
		cam3_flag=0;
	}
	}
	position2_x=position1_x+100*cos(DEG2RAD(cam3_angle));
	position2_z=position1_z-100*sin(DEG2RAD(cam3_angle));	
	if(game==-1 && menu_mode==0)
	{
	if(x<760 && x> 660 && y<90 && y>71)
		{
			game=0;
		}
	if(x<760 && x> 660 && y<130 && y>90)
		{
			newgame();
			game=0;
		}
	if(x<760 && x> 660 && y<170 && y>130)
		{
			game=-1;
			menu_mode=3;
		}
	if(x<760 && x> 660 && y<210 && y>170)
		{
			game=1;
		}
	}
}
