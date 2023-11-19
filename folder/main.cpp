#include<stdio.h>
#include<GL/glut.h>
#include<math.h>
#include<windows.h>




void display(void)
{
glClear(GL_COLOR_BUFFER_BIT);
int h=40;
glColor3f(0.0,0.0,0.0);

glBegin(GL_LINES);
glVertex2f(0.0,440.0);
glVertex2f(639.0,440.0);
//=============================Ist tower========================//
//============================IIst tower============================//
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%TOWER%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
int l=-20;
glVertex2f(28+l,400+h);
glVertex2f(33+l,333+h);
glVertex2f(86+l,400+h);
glVertex2f(80+l,333+h);
//||||||||||||||||||||||||||||||Ist stage|||||||||||||||||||||||||||||||//
glVertex2f(23+l,328+h);
glVertex2f(32+l,334+h);
glVertex2f(88+l,328+h);
glVertex2f(80+l,334+h);

glVertex2f(83+l,323+h);
glVertex2f(75+l,334+h);
glVertex2f(75+l,323+h);
glVertex2f(70+l,332+h);

glVertex2f(66+l,323+h);
glVertex2f(65+l,332+h);
glVertex2f(57+l,323+h);
glVertex2f(57+l,332+h);

glVertex2f(30+l,323+h);
glVertex2f(39+l,334+h);
glVertex2f(38+l,323+h);
glVertex2f(45+l,332+h);

glVertex2f(48+l,323+h);
glVertex2f(51+l,332+h);
 //3 eclipse

 glVertex2f(22+l,320+h);
glVertex2f(22+l,328+h);
glVertex2f(91+l,320+h);
glVertex2f(91+l,327+h);

//4 lines left
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||//
//+++++++++++++++++++++++++++++++++++2nd tower+++++++++++++++++++++//

 glVertex2f(35+l,315+h);
glVertex2f(38+l,242+h);
glVertex2f(80+l,315+h);
glVertex2f(75+l,242+h);
//||||||||||||||||||||||||||||||2nd stage|||||||||||||||||||||||||||//

int t=-93;
 glVertex2f(23+4+l,328+t+3+h);
glVertex2f(32+5+l,334+t+h);
glVertex2f(88+l,328+t+2+h);
glVertex2f(76+l,334+t+h);

glVertex2f(78+l,323+t+3+h);
glVertex2f(71+l,332+t+h);
glVertex2f(66+l,323+t+2+h);
glVertex2f(65+l,332+t+h);
glVertex2f(57+l,323+t+2+h);
glVertex2f(57+l,332+t-2+h);

glVertex2f(35+l,323+t+3+h);
glVertex2f(45-3+l,332+t+h);
glVertex2f(48+l,323+t+2+h);
glVertex2f(51+l,332+t-2+h);

//eclipse 3

glVertex2f(26+l,320+t+3+h);
glVertex2f(26+l,328+t+2+h);
glVertex2f(88+l,320+3+t+h);
glVertex2f(88+l,327+t+3+h);
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||//
//4 lines left

//||||||||||||||||||||||||||||||3rdstage||||||||||||||||||||||||||||||||//
glVertex2f(38+l,225+h);
glVertex2f(41+l,152+h);
glVertex2f(75+l,225+h);
glVertex2f(72+l,152+h);
t=-182;
glVertex2f(32+l,328+t+4+h);
glVertex2f(32+7+l,334+t+h);
glVertex2f(80+l,328+t+4+h);
glVertex2f(73+l,334+t+h);

glVertex2f(76+l,323+t+5+h);
glVertex2f(71+l,332+t+h);
glVertex2f(66+l,323+t+4+h);
glVertex2f(65+l,332+t+h);

glVertex2f(57+l,323+t+4+h);
glVertex2f(57+l,332+t-2+h);
glVertex2f(39+l,323+t+6+h);
glVertex2f(45+l,332+t+1+h);

glVertex2f(48+l,323+t+4+h);
glVertex2f(51+l,332+t+h);

//ellipse 3
glVertex2f(32+l,320+t+6+h);
glVertex2f(32+l,328+t+3+h);
glVertex2f(81+l,320+t+6+h);
glVertex2f(81+l,327+t+3+h);

//5 lines lefft

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%TOWER%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
//5 eclipse left

glVertex2f(40+l,107+h);
glVertex2f(40+l,140+h);
glVertex2f(75+l,107+h);
glVertex2f(75+l,140+h);


glVertex2f(34+l,107+h);
glVertex2f(40+l,107+h);
glVertex2f(75+l,107+h);
glVertex2f(81+l,107+h);

glVertex2f(34+l,107+h);
glVertex2f(28+l,102+h);
glVertex2f(81+l,107+h);
glVertex2f(87+l,102+h);

glVertex2f(28+l,102+h);
glVertex2f(34+l,98+h);
glVertex2f(87+l,102+h);
glVertex2f(81+l,98+h);

glVertex2f(34+l,98+h);
glVertex2f(58+l,95+h);
glVertex2f(58+l,95+h);
glVertex2f(81+l,98+h);

//2 eclipse left

glVertex2f(58+l,61+h);
glVertex2f(58+l,63+h);
//circle

glVertex2f(58+l,55+h);
glVertex2f(58+l,53+h);
//circle
glVertex2f(58+l,48+h);
glVertex2f(58+l,47+h);
//circle

glVertex2f(58+l,44+h);
glVertex2f(58+l,41+h);

//left 4 lines

//141






glEnd();

glFlush();
}



int main(int argc,char **argv)
{
printf("hello");
glutInit(&argc,argv);
glutInitDisplayMode(GLUT_SINGLE|GLUT_RGB);
glutInitWindowSize(800,800);
glutInitWindowPosition(10,20);
glutCreateWindow("first cg program");
glClearColor(1,1,1,0);
glMatrixMode(GL_PROJECTION);
glLoadIdentity();
gluOrtho2D(0.0,500.0,0.0,500.0);
glutDisplayFunc(display);

glutMainLoop();
}
