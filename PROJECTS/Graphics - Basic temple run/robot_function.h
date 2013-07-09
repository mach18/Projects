void Robot::DrawCube(float xPos, float yPos, float zPos)
{
	glPushMatrix();
	glTranslatef(xPos, yPos, zPos);
	glBegin(GL_POLYGON);
	glTexCoord2f(0.0f, 0.0f);
	glVertex3f(0.0f, 0.0f, 0.0f);	// top face
	glTexCoord2f(1.0f, 0.0f);
	glVertex3f(0.0f, 0.0f, -1.0f);
	glTexCoord2f(1.0f, 1.0f);
	glVertex3f(-1.0f, 0.0f, -1.0f);
	glTexCoord2f(0.0f, 1.0f);
	glVertex3f(-1.0f, 0.0f, 0.0f);
	
	glTexCoord2f(0.0f, 0.0f);
	glVertex3f(0.0f, 0.0f, 0.0f);	// front face
	glTexCoord2f(1.0f, 0.0f);
	glVertex3f(-1.0f, 0.0f, 0.0f);
	glTexCoord2f(1.0f, 1.0f);
	glVertex3f(-1.0f, -1.0f, 0.0f);
	glTexCoord2f(0.0f, 1.0f);
	glVertex3f(0.0f, -1.0f, 0.0f);
	
	glTexCoord2f(0.0f, 0.0f);
	glVertex3f(0.0f, 0.0f, 0.0f);	// right face
	glTexCoord2f(1.0f, 0.0f);
	glVertex3f(0.0f, -1.0f, 0.0f);
	glTexCoord2f(1.0f, 1.0f);
	glVertex3f(0.0f, -1.0f, -1.0f);
	glTexCoord2f(0.0f, 1.0f);
	glVertex3f(0.0f, 0.0f, -1.0f);
	
	glTexCoord2f(0.0f, 0.0f);
	glVertex3f(-1.0f, 0.0f, 0.0f);	// left face
	glTexCoord2f(1.0f, 0.0f);
	glVertex3f(-1.0f, 0.0f, -1.0f);
	glTexCoord2f(1.0f, 1.0f);
	glVertex3f(-1.0f, -1.0f, -1.0f);
	glTexCoord2f(0.0f, 1.0f);
	glVertex3f(-1.0f, -1.0f, 0.0f);
	
	glTexCoord2f(0.0f, 0.0f);
	glVertex3f(0.0f, 0.0f, 0.0f);	// bottom face
	glTexCoord2f(1.0f, 0.0f);
	glVertex3f(0.0f, -1.0f, -1.0f);
	glTexCoord2f(1.0f, 1.0f);
	glVertex3f(-1.0f, -1.0f, -1.0f);
	glTexCoord2f(0.0f, 1.0f);
	glVertex3f(-1.0f, -1.0f, 0.0f);
	
	glTexCoord2f(0.0f, 0.0f);
	glVertex3f(0.0f, 0.0f, 0.0f);	// back face
	glTexCoord2f(1.0f, 0.0f);
	glVertex3f(-1.0f, 0.0f, -1.0f);
	glTexCoord2f(1.0f, 1.0f);
	glVertex3f(-1.0f, -1.0f, -1.0f);
	glTexCoord2f(0.0f, 1.0f);
	glVertex3f(0.0f, -1.0f, -1.0f);
	glEnd();
	glPopMatrix();
}

void Robot::DrawupArm(float xPos, float yPos, float zPos)
{
	glPushMatrix();
	glColor3f(1.0f, 0.25f, 0.75f);	// red
	glTranslatef(xPos, yPos, zPos);
	glScalef(1.5f, 1.6f, 1.0f);		// arm is a 1x4x1 cube
glColor3f(1.0,1.0,1.0);
	DrawCube(0.0f, 0.0f, 0.0f);
	glPopMatrix();
}
void Robot::DrawMagnet(float xpos,float ypos,float zpos)
{
	if(game==0)
	{
	glPushMatrix();
	glTranslatef(xpos,ypos,zpos);
	
	glRotatef(30,0,0,1);
	glPushMatrix();
	glColor3f(1,0,0);
	glTranslatef(-1.0,0.0,0.0);
	glScalef(1.5,2.5,1.5);
	DrawCube(0.0,0.0,0.0);
	glPopMatrix();

	glPushMatrix();
	glTranslatef(-1.0,-2.5,0.0);
	glColor3f(0,0,0);
	glScalef(1.5,2,1.5);
	DrawCube(0.0,0.0,0.0);
	glPopMatrix();


	glPushMatrix();
	glColor3f(1,0,0);
	glTranslatef(1.0,1.0,0.0);
	glScalef(3.5,1,1.5);
	DrawCube(0.0,0.0,0.0);
	glPopMatrix();

	glPushMatrix();
	glColor3f(1,0,0);
	glTranslatef(1.0,0.0,0.0);
	glScalef(1.5,2.5,1.5);
	DrawCube(0.0,0.0,0.0);
	glPopMatrix();

	glPushMatrix();
	glTranslatef(1.0,-2.5,0.0);
	glColor3f(0,0,0);
	glScalef(1.5,2,1.5);
	DrawCube(0.0,0.0,0.0);
	glPopMatrix();
	
	glPopMatrix();
	}
}
void Robot::DrawArm(float xPos, float yPos, float zPos,int isRight)
{
	glPushMatrix();
	glColor3f(1.0f, 1.0f, 0.5f);	// red
	glTranslatef(xPos, yPos, zPos);
	glScalef(1.0f, 4.0f, 1.0f);		// arm is a 1x4x1 cube
glColor3f(1.0,1.0,1.0);
	DrawCube(0.0f, 0.0f, 0.0f);
	glScalef(1.0f, 0.1f, 1.0f);
	if(isRight==1 && has_magnet>0)
	{
	glDisable(GL_TEXTURE_2D);
		DrawMagnet(0.0,-10.0,-0.2);
	glEnable(GL_TEXTURE_2D);
	}
	glPopMatrix();
}
void Robot::DrawHead(float xPos, float yPos, float zPos)
{

	glPushMatrix();
	glColor3f(0.6f, 0.7f, 0.9f);	// white
	glTranslatef(xPos, yPos, zPos-1.0);
	glScalef(1.5f, 2.0f, 2.0f);		// head is a 2x2x2 cube
	//DrawCube(0.0f, 0.0f, 0.0f);
//	glutSolidSphere(-1.0,100.0,100.0);
glColor3f(1.0,1.0,1.0);
	gluSphere(quadratic,1.0f,100,100);
	
	glPushMatrix();
	glTranslatef(0.0,0.0,0.1);
	glColor3f(0.5f, 0.5f, 0.5f);	// white
glColor3f(1.0,1.0,1.0);
//	glutSolidSphere(-1.0,100.0,100.0);
	gluSphere(quadratic,1.0f,100,100);
	glPopMatrix();

	glColor3f(0.0f, 0.0f, 1.0f);	// white
	glTranslatef(-0.2, 0.0, -1.0);
	glutSolidSphere(-0.1,100.0,100.0);
//	gluSphere(quadratic,-0.4f,100,100);
	glTranslatef(+0.4, 0.0,0.0);
//glColor3f(1.0,1.0,1.0);
//	gluSphere(quadratic,-0.4f,100,100);
	glutSolidSphere(-0.1,100.0,100.0);
	glPopMatrix();
}
void Robot::DrawTorso(float xPos, float yPos, float zPos)
{
	glPushMatrix();
	glColor3f(0.5f, 0.25f, 0.75f);	// blue
	glTranslatef(xPos, yPos, zPos);
	glScalef(3.0f, 5.0f, 2.0f);		// torso is a 3x5x2 cube
glColor3f(1.0,1.0,1.0);
	DrawCube(0.0f, 0.0f, 0.0f);
	glPopMatrix();
}
void Robot::DrawLeg(float xPos, float yPos, float zPos)
{
	glPushMatrix();
	glTranslatef(xPos, yPos, zPos);
	// draw the foot
	glPushMatrix();
	glTranslatef(0.0f, -0.5f, 0.0f);
	DrawFoot(0.0f, -5.0f, 0.0f);
	glPopMatrix();		
	glScalef(1.0f, 2.5f, 1.0f);		// leg is a 1x5x1 cube
	glTranslatef(-0.5f, -0.8f, 0.0f);
glColor3f(1.0,1.0,1.0);
//glDisable(GL_TEXTURE_2D);
//	glutSolidSphere(1,4,2);
	gluSphere(quadratic,1,4,2);
//	glEnable(GL_TEXTURE_2D);
	glColor3f(1.0f, 1.0f, 0.0f);	// yellow
	glPopMatrix();
}



void Robot::DrawFoot(float xPos, float yPos, float zPos)
{
	glPushMatrix();
	glColor3f(0.1f, 0.2f, 0.3f);
	glTranslatef(xPos, yPos, zPos);
	
	
	glPushMatrix();
	glScalef(1.0f, 0.5f, 3.0f);
glColor3f(1.0,1.0,1.0);
	DrawCube(0.0f, 0.0f, 0.0f);
	glPopMatrix();
	
	
	glPushMatrix();
	glColor3f(1.0f, 0.24f, 0.4f);
	glTranslatef(-0.3, 0.0,-1.5);
//glColor3f(1.0,1.0,1.0);
	glutSolidSphere(0.2,10,10);
//	gluSphere(quadratic,0.2f,100,100);
	glPopMatrix();
	
	
	glPopMatrix();
}



void Robot::DrawRobot(float xPos, float yPos, float zPos)


{

	//printf("here");ble(GL_TEXTURE_2D);
	 glEnable(GL_TEXTURE_2D);

		
	
	glPushMatrix();	

	glTranslatef(xPos, yPos, zPos);	// draw robot at desired coordinates

        glRotatef(rotation,0.0,1.0,0.0); 
        //if(swimming_mode==1)
//	{
//	glPushMatrix();	
//	glTranslatef(0.0,-30.0,0.0);
//	glRotatef(90,-1.0,0.0,0.0); 
//	}


	// draw head and torso parts
	glBindTexture(GL_TEXTURE_2D, _textureId3);
	glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_NEAREST);
	glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_NEAREST);

	DrawHead(0.3f, 2.0f, 0.0f);		

glColor3f(1.0,1.0,1.0);
	DrawTorso(1.5f, 0.0f, 0.0f);



	// move the left arm away from the torso and rotate it to give "walking" effect

	glPushMatrix();

	glTranslatef(0.0f, -0.5f, 0.0f);

	//nnprintf("angle %d\n",(int)armAngles[LEFT]);
	glRotatef(armAngles[LEFT], 1.0f, 0.0f, 0.0f);
	DrawupArm(3.1f,0.5,-0.5f);
	DrawArm(3.0f, -1.0f, -0.5f,1);

	glPopMatrix();



	// move the right arm away from the torso and rotate it to give "walking" effect

	glPushMatrix();

	glTranslatef(0.0f, -0.5f, 0.0f);

	glRotatef(armAngles[RIGHT], 1.0f, 0.0f, 0.0f);

	DrawupArm(-1.7f,0.5,-0.5f);
	DrawArm(-2.0f, -1.0f, -0.5f,0);

	glPopMatrix();



	// move the left leg away from the torso and rotate it to give "walking" effect

	glPushMatrix();					

	glTranslatef(0.0f, -0.5f, 0.0f);

	glRotatef(legAngles[LEFT], 1.0f, 0.0f, 0.0f);

	DrawLeg(-0.5f, -5.0f, -0.5f);

	glPopMatrix();



	// move the right leg away from the torso and rotate it to give "walking" effect

	glPushMatrix();

	glTranslatef(0.0f, -0.5f, 0.0f);

	glRotatef(legAngles[RIGHT], 1.0f, 0.0f, 0.0f);

	DrawLeg(1.5f, -5.0f, -0.5f);

	glPopMatrix();

    

	
	glPopMatrix();	// pop back to original coordinate system
//	if(swimming_mode==1)
//	glPopMatrix();

 
	glDisable(GL_TEXTURE_2D);

}



void Robot::Prepare(float dt)
{

	// if leg is moving forward, increase angle, else decrease angle

//	robot_motion=1;
	if(robot_motion==1)
	{
	//printf("m here\n");
	for (int side = 0; side < 2; side++)
	{
		
		// arms
		//printf("%d mhere\n",side,armAngles[side]);

		if (armStates[side] == FORWARD_STATE)

		{

			//printf("believe\n");

			armAngles[side] += 20.0f * dt;

		}else

			armAngles[side] -= 20.0f * dt;



		// change state if exceeding angles

		if (armAngles[side] >= 15.0f)

			armStates[side] = BACKWARD_STATE;

		else if (armAngles[side] <= -15.0f)

			armStates[side] = FORWARD_STATE;



		// legs

		if (legStates[side] == FORWARD_STATE)

			legAngles[side] += 20.0f * dt;

		else

			legAngles[side] -= 20.0f * dt;



		// change state if exceeding angles

		if (legAngles[side] >= 15.0f)

			legStates[side] = BACKWARD_STATE;

		else if (legAngles[side] <= -15.0f)

			legStates[side] = FORWARD_STATE;		

	}
	}

}

