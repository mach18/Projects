#include <iostream>
#include <cmath>
#include <GL/glut.h>
#include<stdio.h>
#include<string.h>
#include<stdlib.h>
using namespace std;

#define PI 3.141592653589
#define DEG2RAD(deg) (deg * PI / 180.00)

// Function Declarations
float mod(float a)
{
	if(a<0) return -1.00*a;else return a;
}
void drawScene();
void update(int value);
void drawBox();
void drawInsects();
void drawTriangle();
void initRendering();
void handleResize(int w, int h);
void handleKeypress1(unsigned char key, int x, int y);
void handleKeypress2(int key, int x, int y);
void handleMouseclick(int button, int state, int x, int y);
void drawLine();
void drawProjector();
void drawMirror();
void drawBlock();
void drawRandom();
void drawMenu(float x,float y);
void new_function();
void mouse(int x,int y);

// Global Variables

FILE *pFile,*pFile2;
int game_counter=400;
int life=3;
int timer=30;
int mode[6]={0};
int except=-1;
int speed=0;
int multiple;
float box_width;
float box_height;
int num_of_projectors=1;
int num_of_mirrors=2;
int num_of_blocks=1;
float theta = 0.0; 
int global_count=0;
int num_of_outers=4;
int num_of_insects=3;
int stipple_var=0;
int screen_w;
int screen_l;
char s[1024];
int instruction=1;
float projectors[10][7];
float mirrors[10][7];
float blocks[10][7];
float outer[10][7];
float insects[5][3];
int present_object;
int selected=0;
int b_received=0;
int p_received=0;
int m_received=0;
char filename[1024];
float radius_insect=5.00;
int counter_1=1;
void findline();
void drawLife();
void findline()
{
	while(fgets(s,sizeof s,pFile))
	{
		if(strcmp(s,"\n")!=0&&s[0]!='#')
			break;
	}
}
/*projectors[0][0]=-10.0;
projectors[0][1]=-40.0;
projectors[0][2]=10.0;
projectors[0][3]=-40.0;*/

int main(int argc, char **argv) 
{
strcpy(filename,argv[1]);
pFile=fopen(filename,"r");
mode[1]=1;
findline();
sscanf(s,"%f %f",&box_width,&box_height);
findline();
sscanf(s,"%d",&num_of_projectors);
for(int i=0;i<num_of_projectors;i++)
{
	findline();
	sscanf(s,"%f %f %f %f",&projectors[i][0],&projectors[i][1],&projectors[i][2],&projectors[i][3]);
	//sscanf(s,"%f",&projectors[i][1]);
	//sscanf(s,"%f",&projectors[i][2]);
	//sscanf(s,"%f",&projectors[i][3]);
findline();
	sscanf(s,"%f",&projectors[i][4]);
findline();
	sscanf(s,"%f",&projectors[i][5]);
}
findline();
sscanf(s,"%d",&num_of_blocks);
for(int i=0;i<num_of_blocks;i++)
{
	findline();
	sscanf(s,"%f %f %f %f",&blocks[i][0],&blocks[i][1],&blocks[i][2],&blocks[i][3]);
}
findline();
sscanf(s,"%d",&num_of_mirrors);
for(int i=0;i<num_of_mirrors;i++)
{
	findline();
	sscanf(s,"%f %f %f %f",&mirrors[i][0],&mirrors[i][1],&mirrors[i][2],&mirrors[i][3]);
}
fclose(pFile);
int t=num_of_projectors;
projectors[t][0]=0.0;
projectors[t][1]=2*box_height/13;
projectors[t][2]=box_width/4;
projectors[t][3]=box_height/8;
projectors[t][4]=box_height/20;
projectors[t][5]=21;


t=num_of_mirrors;
mirrors[t][0]=0.0;
mirrors[t][1]=0.0;
mirrors[t][2]=-box_width/4;
mirrors[t][3]=box_height/4;

t=num_of_blocks;
blocks[t][0]=0.0;
blocks[t][1]=-box_height/8;
blocks[t][2]=box_width/4;
blocks[t][3]=box_height/4;
if(counter_1==1)
{
	counter_1++;
insects[0][0]=0.0;
insects[0][1]=25.0;
insects[0][2]=15.00;
insects[0][3]=1;

insects[1][0]=0.0;
insects[1][1]=0.0;
insects[1][2]=12.00;
insects[1][3]=1;

insects[2][0]=-25.0;
insects[2][1]=2.0;
insects[2][2]=25.00;
insects[2][3]=1;
}

float Box_height=box_width;
float Box_width=box_height;
outer[0][0]=-Box_height/2;
outer[0][1]=-Box_width/2;
outer[0][2]=-Box_height/2;
outer[0][3]=Box_width/2;

outer[1][0]=-Box_height/2;
outer[1][1]=Box_width/2;
outer[1][2]=Box_height/2;
outer[1][3]=Box_width/2;

outer[2][0]=Box_height/2;
outer[2][1]=Box_width/2;
outer[2][2]=Box_height/2;
outer[2][3]=-Box_width/2;

outer[3][0]=Box_height/2;
outer[3][1]=-Box_width/2;
outer[3][2]=-Box_height/2;
outer[3][3]=-Box_width/2;

	glutInit(&argc, argv);
	glutInitDisplayMode(GLUT_DOUBLE | GLUT_RGB);

	int w = glutGet(GLUT_SCREEN_WIDTH);
	int h = glutGet(GLUT_SCREEN_HEIGHT);
	int windowWidth = w;
	int windowHeight = h;

	glutInitWindowSize(windowWidth, windowHeight);
	glutInitWindowPosition((w - windowWidth) / 2, (h - windowHeight) / 2);
	screen_w=w;
	screen_l=h;

	glutCreateWindow("CSE251_sampleCode");  // Setup the window
	initRendering();

	// Register callbacks
	glutDisplayFunc(drawScene);
	glutIdleFunc(drawScene);
	glutKeyboardFunc(handleKeypress1);
	glutSpecialFunc(handleKeypress2);
	glutMouseFunc(handleMouseclick);
	glutReshapeFunc(handleResize);
	glutPassiveMotionFunc(mouse);
	glutTimerFunc(10, update, 0);
	glutMainLoop();
	return 0;
}


void update(int value)
{
	screen_w = glutGet(GLUT_SCREEN_WIDTH);
 	screen_l = glutGet(GLUT_SCREEN_HEIGHT);
	glutTimerFunc(10, update, 0);
}
void drawScene() {
	glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);
	glMatrixMode(GL_MODELVIEW);
	glLoadIdentity();
	glPushMatrix();
	glColor3f(1.0f, 0.0f, 0.0f);
	drawRandom();
	if(instruction==0)
	{
	drawProjector();
	drawLine();
	drawMirror();
	drawBlock();
	drawInsects();
	drawLife();
	}
	else
	{
	drawMenu(-1*box_width/8.00f,box_height/2 -20.00);
	}
	glColor3f(1.0f, 0.0f, 0.0f);
	drawBox();
	glPopMatrix();
	glutSwapBuffers();
}

void drawBox() {

	//glPolygonMode(GL_FRONT_AND_BACK, GL_LINE);
for(int i=0;i<num_of_outers;i++)
{   
	//int random1=(random())%10;
	glLineWidth(5);
	glBegin(GL_LINES);
	glColor3f(1.0f,0.0f,0.0f);
	/*outer[i][0]+=random1;
	outer[i][1]+=random1;
	outer[i][2]+=random1;
	outer[i][3]+=random1;*/
	/*glVertex2f(outer[i][0]+random1,outer[i][1]+random1);
	glVertex2f(outer[i][2]+random1,outer[i][3]+random1);*/
	glVertex2f(outer[i][0],outer[i][1]);
	glVertex2f(outer[i][2],outer[i][3]);
	/*outer[i][0]-=random1;
	outer[i][1]-=random1;
	outer[i][2]-=random1;
	outer[i][3]-=random1;*/
	glEnd();
	glLineWidth(1);
}   

}
void drawMirror()
{
	int border=-1;
	if(selected>=num_of_projectors && selected<num_of_projectors+num_of_mirrors)
	{
		border=selected-num_of_projectors;
	}
	for(int i=0;i<num_of_mirrors;i++)
	{
		if(i!=border)glLineWidth(1.5);
		else glLineWidth(3);
		glBegin(GL_LINES);

		if(i==border)
		glColor3f(0.0f,1.0f,0.0f);
		else
		glColor3f(1.0f,0.5f,0.5f);

		glVertex2f(mirrors[i][0],mirrors[i][1]);
		glVertex2f(mirrors[i][2],mirrors[i][3]);

		float k=0.5;
		float s=sin(atan((mirrors[i][3]-mirrors[i][1])/(mirrors[i][2]-mirrors[i][0])));
		float c=cos(atan((mirrors[i][3]-mirrors[i][1])/(mirrors[i][2]-mirrors[i][0])));


		float x_var=(mirrors[i][2]+mirrors[i][0])/2;
		float y_var=(mirrors[i][1]+mirrors[i][3])/2;
		float previous_x=mirrors[i][0]-k*s;
		float previous_y=mirrors[i][1]+k*c;
		float mirror_x=mirrors[i][2];
		float mirror_y=mirrors[i][3];
		if(((mirror_y-y_var)*(x_var-previous_x))-((mirror_x-x_var)*(y_var-previous_y))<0)
		{
			if(i!=border)glColor3f(0.85f,0.85f,0.85f);
			else glColor3f(1.0f,0.5f,0.5f);
			glVertex2f(mirrors[i][0]-k*s,mirrors[i][1]+k*c);
			glVertex2f(mirrors[i][2]-k*s,mirrors[i][3]+k*c);
			if(i!=border)glColor3f(0.1f,0.5f,0.5f);
			else glColor3f(1.0f,0.5f,0.5f);
			glVertex2f(mirrors[i][0]+k*s,mirrors[i][1]-k*c);
			glVertex2f(mirrors[i][2]+k*s,mirrors[i][3]-k*c);
		}
		else
		{
			if(i!=border)glColor3f(0.1f,0.5f,0.5f);
			else glColor3f(1.0f,0.5f,0.5f);
			glVertex2f(mirrors[i][0]-k*s,mirrors[i][1]+k*c);
			glVertex2f(mirrors[i][2]-k*s,mirrors[i][3]+k*c);
			if(i!=border)glColor3f(0.85f,0.85f,0.85f);
			else glColor3f(1.0f,0.5f,0.5f);
			glVertex2f(mirrors[i][0]+k*s,mirrors[i][1]-k*c);
			glVertex2f(mirrors[i][2]+k*s,mirrors[i][3]-k*c);

		}

		glEnd();
		glLineWidth(1);
	}
}
void drawBlock()
{
	int border=-1,flag=0;
	if(selected>=num_of_mirrors+num_of_projectors)
	{
		border=selected-num_of_projectors-num_of_mirrors;
		flag=1;
	}
	for(int i=0;i<num_of_blocks;i++)
	{
		if(flag==1 && i==selected-num_of_projectors-num_of_mirrors)
		glLineWidth(5);
		glBegin(GL_LINES);

		if(i==border)
		glColor3f(0.0f,1.0f,0.0f);
		else
		glColor3f(0.5f,1.0f,1.0f);
		
		glVertex2f(blocks[i][0],blocks[i][1]);
		glVertex2f(blocks[i][2],blocks[i][3]);
		glEnd();
		glLineWidth(1);
	}
}
void drawProjector()
{
	int border=-1,flag=0;
	if(selected<num_of_projectors)
	{
		border=selected;
		flag=1;
	}
	for(int i=0;i<num_of_projectors;i++)
	{
		if(flag==1 && selected==i)
			glLineWidth(5);

		glBegin(GL_LINES);
		if(i==border)
		glColor3f(0.0f,1.0f,0.0f);
		else
		glColor3f(1.0f,0.0f,0.0f);
		glVertex2f(projectors[i][0],projectors[i][1]);
		glVertex2f(projectors[i][2],projectors[i][3]);
		glEnd();
		if(flag==1 && selected==i)
			glLineWidth(1);
	}
}

void drawInsects()
{
	float x,y;
	int j;
	if(mode[5]==1)
	{
	for(j=0;j<num_of_insects;j++)
	{
		if(insects[j][3]==1)
		{
		float rad=insects[j][2];
		if(rad>0)
		{
		glColor3f(0.85f,0.85f,0.85f);
		x=insects[j][0],y=insects[j][1];
		glPushMatrix();
		glTranslatef(x,y,0.0f);
		glBegin(GL_TRIANGLE_FAN);
		for(int i=0 ; i<360 ; i++) {
			glVertex2f(rad * cos(DEG2RAD(i)), rad * sin(DEG2RAD(i)));
		}   
		glEnd();
		glPopMatrix();
		}
		}
	}
	}
}
float position_x,position_y;
void mouse(int mouse_x, int mouse_y)
{
	float var_x=screen_w/2;
	float var_y=screen_l/2;
	if(mode[4]==1)
	{
	position_x=float(float(((mouse_x-var_x)*1.00))/(float(var_x/(box_width/2+12.00))));
	position_y=-1.00*float(float(((mouse_y-var_y)*1.00))/(float(var_y/(box_height/2+12.00))));
	new_function();
	}
//	float position_x=mouse/,position_y=mouse_y-screen_l/2;
}

void new_function()
{
	if(selected<num_of_projectors)
	{
		int i=selected;
		float x1=projectors[i][0];
		float y1=projectors[i][1];
		float x2=projectors[i][2];
		float y2=projectors[i][3];
		float d=projectors[i][4];
		float angle1=((atan((y2-y1)/(x2-x1)))*180.00)/PI;
		int set_variable;
		if(x2<x1)set_variable=1;else set_variable=-1;
		float y=(y1+y2)/2 + set_variable*(d*cos(angle1));
		float x=(x1+x2)/2 - set_variable*(d*sin(angle1));
		float angle2=(atan((position_y-y)/(position_x-x))*180.00)/PI;
		
		float angle=90.00-(angle1-angle2);
		if(angle>90.00 && angle<270.00)
		{
			angle+=180;
		}
		projectors[i][2]=x1+((((x2-x1)*cos(DEG2RAD(angle))))-((y2-y1)*sin(DEG2RAD(angle))));
		projectors[i][3]=y1+((((y2-y1)*cos(DEG2RAD(angle))))+((x2-x1)*sin(DEG2RAD(angle))));
		
				
		
	}
	
}
float function_end_point(float x11,float y11,float x12,float y12,float var1,float var2)
{
	//float array[num_of_mirrors+num_of_blocks+1+num_of_outers];
	//int array_counter=0;
	int i;
	float min=1000.00;
	present_object=-1;
	for(i=0;i<num_of_mirrors;i++)
	{
		if(i==except)
			continue;

		float x21=mirrors[i][0]-var1;
		float y21=mirrors[i][1]-var2;
		float x22=mirrors[i][2]-var1;
		float y22=mirrors[i][3]-var2;

		float c1=y12 -(((y12-y11)*x12)/(x12-x11));
		float c2=y22 -(((y22-y21)*x22)/(x22-x21));
		float m1=((y12-y11)*1.00)/(x12-x11);
		float m2=((y22-y21)*1.00)/(x22-x21);
		float x=((c2-c1)*1.00)/(1.00*(m1-m2));

		//float y=m1*x22+c1;
	/*	if( (x22==x21) && ((x12>=x11 && x22>=x11)||(x12<=x11 && x22<=x11)) && ((y<=y22 && y>=y21)||(y>=y22 && y<=y21)))
		{		
			if(mod(x22-x11)<mod(min-x11))
			{
				min=x22;
				present_object=i;
				printf("%d value-m%f\n",i,x);
			}
		}
		else*/
		{
		if(((x<=x21 && x>=x22 )||(x>=x21 && x<=x22)) && ((x12>=x11 && x>=x11)||(x12<=x11 && x<=x11)))
		{
			if(mod(x-x11)<mod(min-x11))
			{	
				min=x;
				present_object=i;
			}
		}
		}

	}
	for(i=0;i<num_of_blocks;i++)
	{
		float x21=blocks[i][0]-var1;
		float y21=blocks[i][1]-var2;
		float x22=blocks[i][2]-var1;
		float y22=blocks[i][3]-var2;

		float c1=y12 -(((y12-y11)*x12)/(x12-x11));
		
		float c2=y22 -(((y22-y21)*x22)/(x22-x21));
		float m1=((y12-y11)*1.00)/(x12-x11);
		float m2=((y22-y21)*1.00)/(x22-x21);
		float x=((c2-c1)*1.00)/(1.00*(m1-m2));
		float y=m1*x22+c1;
		if( ((x21-.25<x22 &&  x22<x21+.25)) && ((x12>=x11 && x22>=x11)||(x12<=x11 && x22<=x11)) && ((y<=y22 && y>=y21)||(y>=y22 && y<=y21)))
		{		
			if(mod(x22-x11)<mod(min-x11))
			{
				min=x22;
				present_object=-1;
				glBegin(GL_LINES);
				glVertex2f(x22,y22);
				glVertex2f(x21,y21);
				glEnd();
			}
		}
		else
		{
			if(((x<=x21 && x>=x22 )||(x>=x21 && x<=x22)) && ((x12>=x11 && x>=x11)||(x12<=x11 && x<=x11)))
		{
			if(mod(x-x11)<mod(min-x11))
			{	
				min=x;
				present_object=-1;
			}
		}
		}

	}

	for(i=0;i<num_of_outers;i++)
	{   
		float x21=outer[i][0]-var1;
		float y21=outer[i][1]-var2;
		float x22=outer[i][2]-var1;
		float y22=outer[i][3]-var2;

		float c1=y12 -(((y12-y11)*x12)/(x12-x11));
		float c2=y22 -(((y22-y21)*x22)/(x22-x21));
		float m1=((y12-y11)*1.00)/(x12-x11);
		float m2=((y22-y21)*1.00)/(x22-x21);
		float x=((c2-c1)*1.00)/(1.00*(m1-m2));
		if( x22==x21 && ((x12>=x11 && x22>=x11)||(x12<=x11 && x22<=x11)))
		{		
			if(mod(x22-x11)<mod(min-x11))
			{
				min=x22;
				present_object=-1;
			}
		}
		else
		{
		if(((x<=x21 && x>=x22 )||(x>=x21 && x<=x22)) && ((x12>=x11 && x>=x11)||(x12<=x11 && x<=x11)))
			{
				if(mod(x-x11)<mod(min-x11))
				{
					min=x;present_object=-1;
				}
			}

		}
	}
	except=-1;
	if(mode[5]==1)
	{
	if(life>0)
	{
	for(i=0;i<num_of_insects;i++)
	{
		
		float x21=insects[i][0]-var1;
		float y21=insects[i][1]-var2;
		float m1=(float)(y12*1.00)/(x12*1.00);
		float m2=-1.000000/m1;
		float c1=0;
		float c2=y21-m2*x21;
		float new_x=((c2-c1)*1.00)/(1.00*(m1-m2));
		float new_y=m1*new_x;
		float d=sqrt((pow(new_x-x21,2))+(pow(new_y-y21,2)));
		
		if( mod(d)<=mod(insects[i][2]) && ((new_x>=x11 && new_x<=min)||(new_x<=x11 && new_x>=min)))
		{
			if(insects[i][2]>0.5)
			{
				insects[i][2]-=0.1;	
			}
			else 
			{
				if(insects[i][3]==1)
					life--;
				insects[i][3]=0;
			}
		}
		else
		{
			if(insects[i][2]<60.00)insects[i][2]+=0.01;
		}
	}
	}
	}

	return min;
}

void drawLife()
{
	if(mode[5]==1)
	{
	char menu1[4][10]={"0","1","2","3"};
	

	glRasterPos2f(-1*box_width/8.00f,box_height/2 -20.00);
	glutBitmapCharacter(GLUT_BITMAP_TIMES_ROMAN_24, menu1[life][0]);

	if(game_counter==0)
	{
	char menu2[1][5]={"Over"};
	glRasterPos2f(-1*box_width + 7.0/8.00f,box_height/2 -20.00);

		int len = (int)strlen(menu2[1]);
		for (int i = 0; i < len; i++) {
			glutBitmapCharacter(GLUT_BITMAP_TIMES_ROMAN_24, menu2[0][i]);
		}
	}
	}
}
void drawMenu(float x,float y)
{
	glColor3f(0.85f,0.85f,0.85f);
	if(instruction==1)
	{
	char string[100];
	char menu[50][50]={"INSTRUCTIONS","Keys","Speed ","Fast  - f","Slow  - s","Normal  - n","Mode" ,"Static - Default","Random  - z","Light  - t","Gaze Mode  - g","Game Play  - P" ,"Translate  - arrow keys","Select Next  - c","Quit   - ESC/q","New Element(1 each)","Block - b","Mirror  - m","Projector  - p","back to instructions  -i ","Press Enter To Start The Game"};
	int menu_counter=21;
	int j;
	float var=box_height/25.00;
	for(j=0;j<menu_counter;j++)
	{
		strcpy(string,menu[j]);

		glRasterPos2f(x, y-var*j);
		int len, i;
		len = (int)strlen(menu[j]);
		for (i = 0; i < len; i++) {
			glutBitmapCharacter(GLUT_BITMAP_TIMES_ROMAN_24, menu[j][i]);
		}
		glutBitmapCharacter(GLUT_BITMAP_HELVETICA_18,'\n');
	}
	}
}
void drawLine() 
{
	if(mode[3]==1)
	{
	if(stipple_var==16)
		stipple_var=0;
	glEnable( GL_LINE_STIPPLE );
	glLineStipple( 3, 0x00ff << stipple_var++ );
	}
	int i;
	for(i=0;i<num_of_projectors;i++)
	{
		float x1=projectors[i][0];
		float y1=projectors[i][1];
		float x2=projectors[i][2];
		float y2=projectors[i][3];
		float d=projectors[i][4];
		float n=projectors[i][5];
		float angle1=atan((y2-y1)/(x2-x1));
		int set_variable;
		if(x2<x1)set_variable=1;else set_variable=-1;
		float y=(y1+y2)/2 + set_variable*(d*cos(angle1));
		float x=(x1+x2)/2 - set_variable*(d*sin(angle1));
		float angle2=atan(d/sqrt(((x2-x1)*(x2-x1)/4)+((y2-y1)*(y2-y1)/4)));
		float start=(angle1+angle2)*180.00/PI;
		float end=180+((angle1-angle2)*180.00/PI);
		glPushMatrix();
		glTranslatef(x,y,0.0f);
		float color_var=1;
		float factor_x=0.00,factor_y=0.0,factor_z=1.00;
		for(float angle=start;angle<=end+1;angle=angle+(end-start)/(n-1))
		{
			{
				glColor3f(factor_x,factor_y,factor_z);
				if(color_var>n/2)factor_x+=2.0000/(n);
				if(color_var<n/2)factor_z-=2.0000/(n);
				if(color_var>n/2)factor_y-=2.0000/(n);
				if(color_var<n/2)factor_y+=2.0000/(n);

			}

			if(set_variable==1)
				angle-=180;
			color_var++;
		float x_var=function_end_point(0,0,10.00*cos(DEG2RAD(angle)),10.00*sin(DEG2RAD(angle)),x,y);
			float y_var=tan(DEG2RAD(angle))*x_var;
			//if(color_var>=n/2+1.0 && color_var<=n/2+2.0)
			{
			glBegin(GL_LINES);
			glVertex2f(0,0);
			glVertex2f(x_var,y_var);
			glEnd();
			}
			float new_x_var,theta1,theta2=angle,new_y_var;
			int counter=0;
			float previous_x=0.00,previous_y=0.00;
			while(present_object!=-1 && counter<9 )
			{
				except=present_object;
				int j=present_object;
				float mirror_y=mirrors[j][3]-y;
				float mirror_x=mirrors[j][2]-x;
				float new_angle;
				if(((mirror_y-y_var)*(x_var-previous_x))-((mirror_x-x_var)*(y_var-previous_y))<0)
				{
		glPushMatrix();
		theta1=atan((mirrors[j][3]-mirrors[j][1])/(mirrors[j][2]-mirrors[j][0]))*(180.00/PI);
		glTranslatef(x_var,y_var,0.0f);
	//	printf("%f  %f\n",theta1,theta2);
	//	printf("%f\n",360.00-theta2);
		float var_angle=360.0000-theta2+2*theta1;
		
		/*		glBegin(GL_LINES);
				glColor3f(1.00,0.00,0.00);
				glVertex2f(0,0);
				glVertex2f(30.00*cos(DEG2RAD(var_angle)),30.00*sin(DEG2RAD(var_angle)));
				glEnd();
		*/		
		new_x_var=function_end_point(0,0,10.00*cos(DEG2RAD(var_angle)),10.00*sin(DEG2RAD(var_angle)),x_var+x,y_var+y);
		new_angle=360+2*theta1-theta2;
		glPopMatrix();
		new_x_var+=x_var;
		new_y_var=new_x_var*tan(DEG2RAD(var_angle))+y_var-tan(DEG2RAD(var_angle))*x_var;
				glBegin(GL_LINES);
				glVertex2f(x_var,y_var);
				glVertex2f(new_x_var,new_y_var);
				glEnd();
				}
				else
				{
					break;
				}
				previous_x=x_var;
				previous_y=y_var;
				x_var=new_x_var;
				y_var=new_y_var;
				theta2=new_angle;
				counter++;
			}
			except=-1;
			if(set_variable==1)
				angle+=180;
		}	
		glPopMatrix();
	}
	if(mode[3]==1)
	glDisable( GL_LINE_STIPPLE );
}

// Initializing some openGL 3D rendering options
void initRendering() {

	glEnable(GL_DEPTH_TEST);        // Enable objects to be drawn ahead/behind one another
	   glEnable(GL_COLOR_MATERIAL);    // Enable coloring
	glClearColor(0.0f, 0.0f, 0.0f, 1.0f);   // Setting a background color
}

// Function called when the window is resized
void handleResize(int w, int h) {

	glViewport(0, 0, w, h);
	glMatrixMode(GL_PROJECTION);
	glLoadIdentity();
	gluOrtho2D(-(box_width/2+12.00),(box_width/2+12.00),-(box_height/2+12.00),(box_height/2+12.00));
	//gluPerspective(45.0f, (float)w / (float)h, 0.1f, 400.0f);
	glMatrixMode(GL_MODELVIEW);
	glLoadIdentity();
}
void drawRandom()
{
	int i,j;
	if(mode[2]==1)
	{
		for(i=0;i<num_of_projectors;i++)
		{
			int rand=(random()%9-4)*(random()%5);
			if(rand%2==0)rand=-1*rand;
			int r=rand/10;
			float x1=projectors[i][0]+r;
			float y1=projectors[i][1]+r;
			float x2=projectors[i][2]+r;
			float y2=projectors[i][3]+r;
			float w=box_width/2,h=box_height;
		if(x1>-w && x2>-w && x1<w && x2<w && y1<h/2 && y2<h/2 && y1>-h/2 && y2>-h/2)
		{
			for(j=0;j<4;j++)
			{
				projectors[i][j]+=rand/10;
			}
		}
		}

		for(i=0;i<num_of_mirrors;i++)
		{
			int rand=(random()%9-4)*(random()%4);
			if(rand%2==0)rand=-1*rand;
			int r=rand/10;
			float x1=mirrors[i][0]+r;
			float y1=mirrors[i][1]+r;
			float x2=mirrors[i][2]+r;
			float y2=mirrors[i][3]+r;
			float w=box_width/2,h=box_height;
		if(x1>-w && x2>-w && x1<w && x2<w && y1<h/2 && y2<h/2 && y1>-h/2 && y2>-h/2)
			{
			for(j=0;j<4;j++)
			{
				mirrors[i][j]+=rand/10;
			}
			}

		}
		for(i=0;i<num_of_blocks;i++)
		{
			int rand=(random()%9-4)*(random()%6);
			if(rand%2==0)rand=-1*rand;
			int r=rand/10;
			float x1=blocks[i][0]+r;
			float y1=blocks[i][1]+r;
			float x2=blocks[i][2]+r;
			float y2=blocks[i][3]+r;
			float w=box_width/2,h=box_height;
		if(x1>-w && x2>-w && x1<w && x2<w && y1<h/2 && y2<h/2 && y1>-h/2 && y2>-h/2)
		{	for(j=0;j<4;j++)
			{
				blocks[i][j]+=rand/10;
			}
		}
		}
	}
		for(i=0;i<num_of_insects;i++)
		{
			int rand=(random()%9-4)*(random()%5);
			for(j=0;j<2;j++)
			{
				int positive=1;
				int newrand=random()%2;
				if(newrand==0)positive=-1;
				insects[i][j]+=positive*rand/10;
			}
		}

}
void handleKeypress1(unsigned char key, int x, int y) {
	if(key==127)
	{int i,j;
		if(selected<num_of_projectors)
		{
			for(i=selected;i<num_of_projectors-1;i++)
			{
				for(j=0;j<6;j++)
					projectors[i][j]=projectors[i+1][j];
			}
		if(num_of_projectors>0)num_of_projectors--;
		}
		else
		{
			if(selected<num_of_projectors+num_of_mirrors)
			{
			for(i=selected-num_of_projectors;i<num_of_projectors+num_of_mirrors-1;i++)
			{
				for(j=0;j<4;j++)
					mirrors[i][j]=mirrors[i+1][j];
			}
			if(num_of_mirrors>0)num_of_mirrors--;
			}
			else
			{
			for(i=selected-num_of_projectors-num_of_mirrors;i<num_of_projectors+num_of_mirrors+num_of_blocks-1;i++)
			{
				for(j=0;j<4;j++)
					blocks[i][j]=blocks[i+1][j];
			}
			if(num_of_blocks>0)num_of_blocks--;
			}
		}
	}
	if (key == 'c')
	{
		if(selected==num_of_projectors+num_of_mirrors+num_of_blocks-1)
		{
			selected=0;
		}
		else
		{
			selected++;
		}	
	}
	if(key=='f')
		speed=1;
	if(key=='s')
		speed=-1;
	if(key=='n')
		speed=0;
	/*
	if(mode[1]==1)
	{
	if(key=='z')mode[2]=1;
	if(key=='t')mode[3]=1;
	if(key=='g')mode[4]=1;
	}
	if(mode[2]==1)
	{
	if(key=='z')mode[2]=0;
	if(key=='t')mode[3]=1;
	if(key=='g')mode[4]=1;
	}
	if(mode[3]==1)
	{
	if(key=='z')mode[2]=1;
	if(key=='t')mode[3]=0;
	if(key=='g')mode[4]=1;
	}
	if(mode[4]==1)
	{
	if(key=='z')mode[2]=1;
	if(key=='t')mode[3]=1;
	if(key=='g')mode[4]=0;
	}*/
	if(key=='z')
	{
		if(mode[2]==0)mode[2]=1;else mode[2]=0;
	}
	if(key=='t')
	{	
		if(mode[3]==0)mode[3]=1;else mode[3]=0;
	}
	if(key=='g')
	{
		if(mode[4]==0)mode[4]=1;else mode[4]=0;
	}
	if(key=='P')
	{
		if(mode[5]==0){mode[5]=1;life=3;game_counter=400;}else mode[5]=0;
	}
	if(key=='b'&&b_received==0){num_of_blocks++;b_received=1;selected=num_of_projectors+num_of_mirrors+num_of_blocks-1;}
	if(key=='m'&&m_received==0){num_of_mirrors++;m_received=1;selected=num_of_projectors+num_of_mirrors-1;}
	if(key=='p'&&p_received==0){num_of_projectors++;p_received=1;selected=num_of_projectors-1;}
	if(key==13)
	{
		if(instruction==1)
			instruction=0;
	}
	if(key=='i')
	{
		instruction=1;
	}
	if (key == 27 || key=='q') 
	{
		int i=0;
		pFile2=fopen(filename,"w");
		fprintf(pFile2,"# All numbers are in floating point except for number of items\n");
		fprintf(pFile2,"%.1f %.1f\n",box_width,box_height);
		fprintf(pFile2,"# width (x) and height (y) of the world\n");
		fprintf(pFile2,"%d\n",num_of_projectors);
		fprintf(pFile2,"# number of Projectors\n");
		for(i=0;i<num_of_projectors;i++)
		{
	fprintf(pFile2,"%.1f %.1f %.1f %.1f\n",projectors[i][0],projectors[i][1],projectors[i][2],projectors[i][3]);
fprintf(pFile2,"# Project %d line: x1 y1 x2 y2\n",i+1);
		fprintf(pFile2,"%.1f\n",projectors[i][4]);
		fprintf(pFile2,"# Distance(d) to the point light source\n");
		fprintf(pFile2,"%d\n",(int)projectors[i][5]);
		fprintf(pFile2,"# Number of pixels in the Projector\n");
		}
		fprintf(pFile2,"%d\n",num_of_blocks);
		fprintf(pFile2,"# number of Blocks\n");
		for(i=0;i<num_of_blocks;i++)
		{
	fprintf(pFile2,"%.1f %.1f %.1f %.1f\n",blocks[i][0],blocks[i][1],blocks[i][2],blocks[i][3]);
		fprintf(pFile2,"# Block %d: x1 y1 x2 y2\n",i+1);
		}
		fprintf(pFile2,"%d\n",num_of_mirrors);
		fprintf(pFile2,"# number of Mirrors\n");
		for(i=0;i<num_of_mirrors;i++)
		{
	fprintf(pFile2,"%.1f %.1f %.1f %.1f\n",mirrors[i][0],mirrors[i][1],mirrors[i][2],mirrors[i][3]);
		fprintf(pFile2,"# Mirror %d: x1 y1 x2 y2\n",i+1);
		}
		fclose(pFile2);
		exit(0);     // escape key is pressed
	}
}

void handleKeypress2(int key, int x, int y) 
{
	int i=selected;
	if(speed==1)multiple=5;
	if(speed==0)multiple=3;
	if(speed==-1)multiple=1;
	int m=multiple;
	if(selected<num_of_projectors)
	{
	i=selected;
	if (key == GLUT_KEY_LEFT)
	{projectors[i][0] -= 0.1*m;projectors[i][2] -= 0.1*m;}
	if (key == GLUT_KEY_RIGHT)
	{projectors[i][0] += 0.1*m;projectors[i][2] += 0.1*m;}
	if (key == GLUT_KEY_UP)
	{projectors[i][1] += 0.1*m;projectors[i][3] += 0.1*m;}
	if (key == GLUT_KEY_DOWN)
	{projectors[i][1] -= 0.1*m;projectors[i][3] -= 0.1*m;}
	}
	else
	{
		i-=num_of_projectors;
		if(i<num_of_mirrors)
		{
			if (key == GLUT_KEY_LEFT)
			{mirrors[i][0] -= 0.1*m;mirrors[i][2] -= 0.1*m;}
			if (key == GLUT_KEY_RIGHT)
			{mirrors[i][0] += 0.1*m;mirrors[i][2] += 0.1*m;}
			if (key == GLUT_KEY_UP)
			{mirrors[i][1] += 0.1*m;mirrors[i][3] += 0.1*m;}
			if (key == GLUT_KEY_DOWN)
			{mirrors[i][1] -= 0.1*m;mirrors[i][3] -= 0.1*m;}

		}
		else
		{
		i-=num_of_mirrors;
		if(i<num_of_blocks)
		{
			if (key == GLUT_KEY_LEFT)
			{blocks[i][0] -= 0.1*m;blocks[i][2] -= 0.1*m;}
			if (key == GLUT_KEY_RIGHT)
			{blocks[i][0] += 0.1*m;blocks[i][2] += 0.1*m;}
			if (key == GLUT_KEY_UP)
			{blocks[i][1] += 0.1*m;blocks[i][3] += 0.1*m;}
			if (key == GLUT_KEY_DOWN)
			{blocks[i][1] -= 0.1*m;blocks[i][3] -= 0.1*m;}

		}
		}
	}
}

void handleMouseclick(int button, int state, int x, int y) {
	float mouse_x=x,mouse_y=y;
	float new_var_x=screen_w/2,new_var_y=screen_l/2;
	position_x=float(float(((mouse_x-new_var_x)*1.00))/(float((new_var_x)/(box_width/2+12.00))));
	position_y=-1.00*float(float(((mouse_y-new_var_y)*1.00))/(float((new_var_y)/(box_height/2+12.00))));
	x=position_x;
	y=position_y;
	if(state==GLUT_DOWN)
	{
		int i;
		for(i=0;i<num_of_projectors;i++)
		{
if(((projectors[i][0]<=x && projectors[i][2]>=x) ||( projectors[i][0]>=x && projectors[i][2]<=x))&& ((projectors[i][1]<=y && projectors[i][3]>=y) ||(projectors[i][1]>=y && projectors[i][3]<=y)))
{
	selected=i;
	return;
}
		}
		for(i=0;i<num_of_mirrors;i++)
		{
if(((mirrors[i][0]<=x && mirrors[i][2]>=x) ||( mirrors[i][0]>=x && mirrors[i][2]<=x))&& ((mirrors[i][1]<=y && mirrors[i][3]>=y) ||(mirrors[i][1]>=y && mirrors[i][3]<=y)))
{
	selected=num_of_projectors+i;
	return;
}
		}
		for(i=0;i<num_of_blocks;i++)
		{
if(((blocks[i][0]<=x && blocks[i][2]>=x) ||( blocks[i][0]>=x && blocks[i][2]<=x))&& ((blocks[i][1]<=y && blocks[i][3]>=y) ||(blocks[i][1]>=y && blocks[i][3]<=y))){
	selected=num_of_projectors+num_of_mirrors+i;
	return;
	}
		}
	}


	float angle;
	if(speed==1)
		angle=29.00;
	if(speed==0)
		angle=19.00;
	if(speed==-1)
		angle=9.00;
	int i=selected;
	if(selected<num_of_projectors)
	{
		i=selected;
		float x1=projectors[i][0];
		float y1=projectors[i][1];
		float x2=projectors[i][2];
		float y2=projectors[i][3];
		if (state == GLUT_DOWN)
		{
			if (button == GLUT_LEFT_BUTTON)
			{
				projectors[i][2]=x1+((((x2-x1)*cos(DEG2RAD(angle))))-((y2-y1)*sin(DEG2RAD(angle))));
				projectors[i][3]=y1+((((y2-y1)*cos(DEG2RAD(angle))))+((x2-x1)*sin(DEG2RAD(angle))));
			}
			else if (button == GLUT_RIGHT_BUTTON)
			{
				projectors[i][2]=x1+((((x2-x1)*cos(DEG2RAD(angle))))+((y2-y1)*sin(DEG2RAD(angle))));
				projectors[i][3]=y1+((((y2-y1)*cos(DEG2RAD(angle))))-((x2-x1)*sin(DEG2RAD(angle))));
			}
		}
	}
	else
	{
		i-=num_of_projectors;
		if(i<num_of_mirrors)
		{
			float x1=mirrors[i][0];
			float y1=mirrors[i][1];
			float x2=mirrors[i][2];
			float y2=mirrors[i][3];
			if (state == GLUT_DOWN)
			{
				if (button == GLUT_LEFT_BUTTON)
				{
				mirrors[i][2]=x1+((((x2-x1)*cos(DEG2RAD(angle))))-((y2-y1)*sin(DEG2RAD(angle))));
				mirrors[i][3]=y1+((((y2-y1)*cos(DEG2RAD(angle))))+((x2-x1)*sin(DEG2RAD(angle))));
				}
				else if (button == GLUT_RIGHT_BUTTON)
				{
				mirrors[i][2]=x1+((((x2-x1)*cos(DEG2RAD(angle))))+((y2-y1)*sin(DEG2RAD(angle))));
				mirrors[i][3]=y1+((((y2-y1)*cos(DEG2RAD(angle))))-((x2-x1)*sin(DEG2RAD(angle))));
				}
			}
		}
		else
		{
			i-=num_of_mirrors;
			if(i<num_of_blocks)
			{
				float x1=blocks[i][0];
				float y1=blocks[i][1];
				float x2=blocks[i][2];
				float y2=blocks[i][3];
				if (state == GLUT_DOWN)
				{
					if (button == GLUT_LEFT_BUTTON)
					{
				blocks[i][2]=x1+((((x2-x1)*cos(DEG2RAD(angle))))-((y2-y1)*sin(DEG2RAD(angle))));
				blocks[i][3]=y1+((((y2-y1)*cos(DEG2RAD(angle))))+((x2-x1)*sin(DEG2RAD(angle))));
					}
					else if (button == GLUT_RIGHT_BUTTON)
					{
				blocks[i][2]=x1+((((x2-x1)*cos(DEG2RAD(angle))))+((y2-y1)*sin(DEG2RAD(angle))));
				blocks[i][3]=y1+((((y2-y1)*cos(DEG2RAD(angle))))-((x2-x1)*sin(DEG2RAD(angle))));
					}
				}

			}
		}
	}
}
